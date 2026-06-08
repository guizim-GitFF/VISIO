<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

/**
 * UsuarioController
 * Gerencia o cadastro e perfil dos usuários comuns integrado ao MySQL.
 */
class UsuarioController extends BaseController
{
    // ---------------------------------------------------------------
    // CADASTRO PÚBLICO
    // ---------------------------------------------------------------

    public function cadastroForm(): string
    {
        return view('sistema/usuario/cadastro/index');
    }

    public function cadastrar()
    {
        $cpf = $this->request->getPost('cpf');
        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');
        $cartao = $this->request->getPost('cartao') ?? '';
        $data = $this->request->getPost('data_nascimento');
        $tel = $this->request->getPost('telefone');

        if (empty($cpf) || empty($email) || empty($senha)) {
            return redirect()->to('/usuario/cadastro')
                ->with('erro', 'CPF, e-mail e senha são obrigatórios.');
        }

        $model = new UsuarioModel();

        if ($model->where('CPF', $cpf)->first()) {
            return redirect()->to('/usuario/cadastro')
                ->with('erro', 'CPF já cadastrado.');
        }

        if ($model->where('EMAIL', $email)->first()) {
            return redirect()->to('/usuario/cadastro')
                ->with('erro', 'Este e-mail já está em uso.');
        }

        $model->insert([
            'CPF' => $cpf,
            'EMAIL' => $email,
            'SENHA' => password_hash($senha, PASSWORD_BCRYPT),
            'CARTAO' => $cartao,
            'DATA_NASCIMENTO' => $data,
            'TELEFONE' => $tel,
        ]);

        return redirect()->to('/login')
            ->with('sucesso', 'Cadastro realizado com sucesso! Faça login para continuar.');
    }

    // ---------------------------------------------------------------
    // INÍCIO DO USUÁRIO LOGADO — CORRIGIDO: caminho de view correto
    // ---------------------------------------------------------------

    public function inicio(): string
    {
        return view('sistema/usuario/inicio/index');
    }

    // ---------------------------------------------------------------
    // PERFIL DO USUÁRIO LOGADO
    // ---------------------------------------------------------------

    public function perfil(): string
    {
        $cpf = session()->get('usuario_cpf');
        $model = new UsuarioModel();

        return view('sistema/usuario_logado/perfil/index', [
            'usuario' => $model->where('CPF', $cpf)->first(),
        ]);
    }

    public function atualizarPerfil()
    {
        $cpf = session()->get('usuario_cpf');
        $model = new UsuarioModel();
        $email = $this->request->getPost('email');

        $emailExistente = $model->where('EMAIL', $email)->where('CPF !=', $cpf)->first();
        if ($emailExistente) {
            return redirect()->to('/perfil')
                ->with('erro', 'Este e-mail já está em uso por outra conta.');
        }

        $dados = [
            'EMAIL' => $email,
            'CARTAO' => $this->request->getPost('cartao') ?? '',
            'DATA_NASCIMENTO' => $this->request->getPost('data_nascimento'),
            'TELEFONE' => $this->request->getPost('telefone'),
        ];

        $novaSenha = $this->request->getPost('senha');
        if (!empty($novaSenha)) {
            $dados['SENHA'] = password_hash($novaSenha, PASSWORD_BCRYPT);
        }

        $model->update($cpf, $dados);

        return redirect()->to('/perfil')
            ->with('sucesso', 'Perfil atualizado com sucesso!');
    }

    // ---------------------------------------------------------------
    // HISTÓRICO DE RESPOSTAS DO USUÁRIO LOGADO
    // ---------------------------------------------------------------

    public function historico(): string
    {
        $cpf = session()->get('usuario_cpf');
        $model = new UsuarioModel();

        return view('sistema/usuario/questoes/historico', [
            'historico' => $model->historicoPorCpf($cpf),
            'respostas' => $model->historicoPorCpf($cpf),
            'total' => count($model->historicoPorCpf($cpf)),
            'total_acertos' => 0, // será calculado na view
        ]);
    }

    //TENTANDO FZR O RECUPERAR SENHA
    public function esqueceu_senha(): string
    {
        return view('sistema/usuario/esqueceu_senha/index');
    }
}
