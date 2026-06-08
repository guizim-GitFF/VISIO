<?php

namespace App\Controllers;

use App\Models\PerguntaModel;
use App\Models\AlternativaModel;
use App\Models\RespondeModel;

/**
 * QuizController
 * Fluxo completo do quiz para o usuário logado, integrado ao MySQL.
 * Rotas protegidas pelo filtro 'userAuth' definido em Routes.php.
 *
 * Rotas:
 *   GET  /quiz           → index()    — inicia o quiz
 *   GET  /quiz/pergunta  → pergunta() — exibe pergunta atual
 *   POST /quiz/responder → responder() — registra resposta e avança
 *   GET  /quiz/resultado → resultado() — exibe resultado final
 */
class QuizController extends BaseController
{
    // ---------------------------------------------------------------
    // INICIAR QUIZ
    // ---------------------------------------------------------------

    public function index()
    {
        $model    = new PerguntaModel();
        $perguntas = $model->listarAleatorio(10);

        if (empty($perguntas)) {
            return redirect()->to('/inicio')
                ->with('erro', 'Ainda não há perguntas suficientes cadastradas para iniciar o quiz.');
        }

        $ids = array_column($perguntas, 'ID_PERGUNTA');

        session()->set([
            'quiz_ids'     => $ids,
            'quiz_indice'  => 0,
            'quiz_acertos' => 0,
            'quiz_total'   => count($ids),
        ]);

        return redirect()->to('/quiz/pergunta');
    }

    // ---------------------------------------------------------------
    // EXIBIR PERGUNTA ATUAL
    // ---------------------------------------------------------------

    public function pergunta()
    {
        $ids    = session()->get('quiz_ids') ?? [];
        $indice = session()->get('quiz_indice') ?? 0;

        if (empty($ids) || $indice >= count($ids)) {
            return redirect()->to('/quiz/resultado');
        }

        $idAtual  = $ids[$indice];
        $model    = new PerguntaModel();
        $pergunta = $model->buscarComAlternativas($idAtual);

        if (!$pergunta) {
            return redirect()->to('/quiz/resultado');
        }

        return view('sistema/usuario/questoes/pergunta', [
            'pergunta' => $pergunta,
            'indice'   => $indice + 1,
            'total'    => session()->get('quiz_total'),
        ]);
    }

    // ---------------------------------------------------------------
    // REGISTRAR RESPOSTA
    // ---------------------------------------------------------------

    public function responder()
    {
        $idAlternativa = (int) $this->request->getPost('id_alternativa');
        $cpf           = session()->get('usuario_cpf');

        if (!$idAlternativa) {
            return redirect()->to('/quiz/pergunta')
                ->with('erro', 'Selecione uma alternativa antes de avançar.');
        }

        // Registra no banco
        (new RespondeModel())->registrar($cpf, $idAlternativa);

        // Verifica acerto usando IS_CORRETA (coluna correta do banco)
        $alternativa = (new AlternativaModel())->find($idAlternativa);

        if ($alternativa && (int) $alternativa['IS_CORRETA'] === 1) {
            session()->set('quiz_acertos', session()->get('quiz_acertos') + 1);
        }

        $indice = session()->get('quiz_indice') + 1;
        session()->set('quiz_indice', $indice);

        if ($indice >= session()->get('quiz_total')) {
            return redirect()->to('/quiz/resultado');
        }

        return redirect()->to('/quiz/pergunta');
    }

    // ---------------------------------------------------------------
    // RESULTADO FINAL
    // ---------------------------------------------------------------

    public function resultado()
    {
        $dados = [
            'acertos' => session()->get('quiz_acertos') ?? 0,
            'total'   => session()->get('quiz_total')   ?? 0,
        ];

        session()->remove(['quiz_ids', 'quiz_indice', 'quiz_acertos', 'quiz_total']);

        return view('sistema/usuario/questoes/resultado', $dados);
    }
}
