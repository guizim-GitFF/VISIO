<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UsuarioModel;
use App\Models\SensorModel;
use App\Models\PerguntaModel;
use App\Models\AlternativaModel;
use App\Models\RespondeModel;

/**
 * AdminController
 * Painel administrativo. Todas as rotas são protegidas pelo filtro 'adminAuth'.
 */
class AdminController extends BaseController
{
    // ---------------------------------------------------------------
    // DASHBOARD — com dados reais do banco
    // ---------------------------------------------------------------

    public function dashboard(): string
    {
        $respondeModel = new RespondeModel();
        $totalRespostas = $respondeModel->countAllResults();
        $totalAcertos = 0;

        if ($totalRespostas > 0) {
            $row = $respondeModel->db->table('RESPONDE r')
                ->selectSum('a.IS_CORRETA', 'acertos')
                ->join('ALTERNATIVA a', 'a.ID_ALTERNATIVA = r.FK_ID_ALTERNATIVA')
                ->get()->getRow();
            $totalAcertos = $row ? (int) $row->acertos : 0;
        }

        $taxaAcerto = $totalRespostas > 0
            ? round(($totalAcertos / $totalRespostas) * 100)
            : 0;

        return view('sistema/admin/index', [
            'total_usuarios' => (new UsuarioModel())->countAllResults(),
            'total_sensores' => (new SensorModel())->countAllResults(),
            'total_perguntas' => (new PerguntaModel())->countAllResults(),
            'total_respostas' => $totalRespostas,
            'total_acertos' => $totalAcertos,
            'taxa_acerto' => $taxaAcerto,
        ]);
    }

    // ---------------------------------------------------------------
    // GESTÃO DE USUÁRIOS
    // ---------------------------------------------------------------

    public function usuarios(): string
    {
        return view('sistema/admin/usuarios/index', [
            'usuarios' => (new UsuarioModel())->findAll(),
        ]);
    }

    public function excluirUsuario(string $cpf)
    {
        (new UsuarioModel())->delete($cpf);
        return redirect()->to('/admin/usuarios')
            ->with('sucesso', 'Usuário removido com sucesso.');
    }

    // ---------------------------------------------------------------
    // GESTÃO DE SENSORES
    // ---------------------------------------------------------------

    public function sensores(): string
    {
        return view('sistema/admin/sensores/index', [
            'sensores' => (new SensorModel())->findAll(),
        ]);
    }

    public function novoSensorForm(): string
    {
        return view('sistema/admin/sensores/novo_sensor');
    }

    public function inserirSensor()
    {
        $foto = '';
        $arquivo = $this->request->getFile('foto');

        if ($arquivo && $arquivo->isValid() && !$arquivo->hasMoved()) {
            $novoNome = $arquivo->getRandomName();

            $arquivo->move(ROOTPATH . 'public/uploads/sensores', $novoNome);
            $foto = 'uploads/sensores/' . $novoNome;
        }

        (new SensorModel())->insert([
            'NOME' => $this->request->getPost('nome'),
            'DESCRICAO' => $this->request->getPost('descricao'),
            'CIRCUITO' => $this->request->getPost('circuito') ?? '',
            'FOTO' => $foto,
        ]);

        return redirect()->to('/admin/sensores')
            ->with('sucesso', 'Sensor cadastrado com sucesso.');
    }

    public function editarSensorForm(int $id): string
    {
        return view('sistema/admin/sensores/editar_sensor', [
            'sensor' => (new SensorModel())->find($id),
        ]);
    }

    public function atualizarSensor(int $id)
    {
        $model = new SensorModel();
        $sensor = $model->find($id);
        $foto = $sensor['FOTO'] ?? '';

        $arquivo = $this->request->getFile('foto');
        if ($arquivo && $arquivo->isValid() && !$arquivo->hasMoved()) {

            if (!empty($sensor['FOTO']) && file_exists(ROOTPATH . 'public/' . $sensor['FOTO'])) {
                unlink(ROOTPATH . 'public/' . $sensor['FOTO']);
            }

            $novoNome = $arquivo->getRandomName();
            $arquivo->move(ROOTPATH . 'public/uploads/sensores', $novoNome);
            $foto = 'uploads/sensores/' . $novoNome;
        }

        $model->update($id, [
            'NOME' => $this->request->getPost('nome'),
            'DESCRICAO' => $this->request->getPost('descricao'),
            'CIRCUITO' => $this->request->getPost('circuito') ?? '',
            'FOTO' => $foto,
        ]);

        return redirect()->to('/admin/sensores')
            ->with('sucesso', 'Sensor updated.');
    }

    public function excluirSensor(int $id)
    {
        $model = new SensorModel();
        $sensor = $model->find($id);

        if ($sensor && !empty($sensor['FOTO']) && file_exists(ROOTPATH . 'public/' . $sensor['FOTO'])) {
            unlink(ROOTPATH . 'public/' . $sensor['FOTO']);
        }

        $model->delete($id);
        return redirect()->to('/admin/sensores')
            ->with('sucesso', 'Sensor removido.');
    }

    // ---------------------------------------------------------------
    // GESTÃO DE PERGUNTAS E ALTERNATIVAS
    // ---------------------------------------------------------------

    public function perguntas(): string
    {
        return view('sistema/admin/quiz/index', [
            'perguntas' => (new PerguntaModel())->listarComAlternativas(),
        ]);
    }

    public function novaPerguntaForm(): string
    {
        return view('sistema/admin/quiz/nova_pergunta');
    }
    public function inserirPergunta()
    {
        $perguntaModel = new PerguntaModel();
        $alternativaModel = new AlternativaModel();

        $idPergunta = $perguntaModel->insert([
            'DESCRICAO' => $this->request->getPost('descricao'),
            'NIVEL_DIFICULDADE' => $this->request->getPost('nivel'),
        ]);

        if ($idPergunta) {
            $correta = $this->request->getPost('correta');
            $alternativas = [
                ['letra' => 'a', 'texto' => $this->request->getPost('alt_a')],
                ['letra' => 'b', 'texto' => $this->request->getPost('alt_b')],
                ['letra' => 'c', 'texto' => $this->request->getPost('alt_c')],
                ['letra' => 'd', 'texto' => $this->request->getPost('alt_d')],
            ];

            $lote = [];
            foreach ($alternativas as $alt) {
                $lote[] = [
                    'DESCRICAO' => $alt['texto'],
                    'IS_CORRETA' => ($alt['letra'] === $correta) ? 1 : 0,
                    'FK_ID_PERGUNTA' => $idPergunta,
                ];
            }

            $alternativaModel->insertBatch($lote);
        }

        return redirect()->to('/admin/perguntas')
            ->with('sucesso', 'Pergunta e alternativas cadastradas com sucesso.');
    }

    public function editarPerguntaForm(int $id): string
    {
        return view('sistema/admin/quiz/editar_questao', [
            'pergunta' => (new PerguntaModel())->buscarComAlternativas($id),
        ]);
    }

    public function atualizarPergunta(int $id)
    {
        $perguntaModel = new PerguntaModel();
        $alternativaModel = new AlternativaModel();

        $perguntaModel->update($id, [
            'DESCRICAO' => $this->request->getPost('descricao'),
            'NIVEL_DIFICULDADE' => $this->request->getPost('nivel'),
        ]);

        $idsAlternativas = $this->request->getPost('id_alternativa');
        $textos = $this->request->getPost('alternativa');
        $correta = $this->request->getPost('correta');

        if (is_array($idsAlternativas)) {
            foreach ($idsAlternativas as $i => $idAlt) {
                $alternativaModel->update((int) $idAlt, [
                    'DESCRICAO' => $textos[$i],
                    'IS_CORRETA' => ($idAlt == $correta) ? 1 : 0,
                ]);
            }
        }

        return redirect()->to('/admin/perguntas')
            ->with('sucesso', 'Pergunta atualizada com sucesso.');
    }

    public function excluirPergunta(int $id)
    {
        (new PerguntaModel())->delete($id); // CASCADE apaga as alternativas
        return redirect()->to('/admin/perguntas')
            ->with('sucesso', 'Pergunta e alternativas removidas com sucesso.');
    }

    // ---------------------------------------------------------------
    // HISTÓRICO GERAL DE RESPOSTAS — CORRIGIDO: view dedicada
    // ---------------------------------------------------------------

    public function respostas(): string
    {
        return view('sistema/admin/respostas/index', [
            'respostas' => (new RespondeModel())->listarComDetalhes(),
        ]);
    }

    // ---------------------------------------------------------------
    // PERFIL DO ADMINISTRADOR
    // ---------------------------------------------------------------

    public function perfil(): string
    {
        $cnpj = session()->get('admin_cnpj');
        $model = new AdminModel();
        return view('sistema/admin/perfil_adm', [
            'admin' => $model->find($cnpj),
        ]);
    }
}
