<?php

namespace App\Controllers;

use App\Models\RespondeModel;

/**
 * RespostaController
 * Gerencia o histórico de respostas da área do usuário logado.
 * Rotas protegidas pelo filtro 'userAuth' definido em Routes.php.
 *
 * Rotas:
 *   GET  /historico              → historico() — lista respostas do usuário logado
 *   GET  /resposta/excluir/(:num) → excluir($id) — remove uma resposta própria
 */
class RespostaController extends BaseController
{
    public function historico(): string
    {
        $cpf   = session()->get('usuario_cpf');
        $model = new RespondeModel();

        $respostas     = $model->historicoPorUsuario($cpf);
        $total         = $model->totalPorUsuario($cpf);
        $total_acertos = $model->totalAcertosPorUsuario($cpf);

        return view('sistema/usuario/questoes/historico', compact(
            'respostas',
            'total',
            'total_acertos'
        ));
    }

    public function excluir(int $id)
    {
        $cpf   = session()->get('usuario_cpf');
        $model = new RespondeModel();

        $registro = $model->find($id);

        // Segurança: só permite excluir registros do próprio usuário
        if (!$registro || $registro['FK_CPF_USUARIO'] !== $cpf) {
            return redirect()->to('/historico')
                ->with('erro', 'Registro não encontrado ou sem permissão para excluir.');
        }

        $model->excluir($id);

        return redirect()->to('/historico')
            ->with('sucesso', 'Resposta removida do histórico.');
    }
}
