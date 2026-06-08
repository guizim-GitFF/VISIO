<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * RespondeModel
 * Responsável por todas as operações da tabela RESPONDE.
 * Registra o histórico de respostas dos usuários no quiz.
 */
class RespondeModel extends Model
{
    protected $table            = 'RESPONDE';
    protected $primaryKey       = 'ID_RESPONDE';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'FK_CPF_USUARIO',
        'FK_ID_ALTERNATIVA',
        // RESPONDIDO_EM é preenchido automaticamente pelo DEFAULT CURRENT_TIMESTAMP do banco
    ];

    // ---------------------------------------------------------------
    // REGISTRAR RESPOSTA
    // Usado no QuizController::responder()
    // ---------------------------------------------------------------
    public function registrar(string $cpf, int $idAlternativa): int|bool
    {
        return $this->insert([
            'FK_CPF_USUARIO'    => $cpf,
            'FK_ID_ALTERNATIVA' => $idAlternativa,
        ]);
    }

    // ---------------------------------------------------------------
    // HISTÓRICO POR USUÁRIO (com JOIN)
    // Usado no RespostaController::historico()
    // ---------------------------------------------------------------
    public function historicoPorUsuario(string $cpf): array
    {
        return $this->db->table('RESPONDE r')
            ->select('
                r.ID_RESPONDE,
                r.RESPONDIDO_EM,
                p.DESCRICAO  AS PERGUNTA_TEXTO,
                p.NIVEL_DIFICULDADE,
                a.DESCRICAO  AS ALTERNATIVA_TEXTO,
                a.IS_CORRETA
            ')
            ->join('ALTERNATIVA a', 'a.ID_ALTERNATIVA = r.FK_ID_ALTERNATIVA')
            ->join('PERGUNTA p',    'p.ID_PERGUNTA    = a.FK_ID_PERGUNTA')
            ->where('r.FK_CPF_USUARIO', $cpf)
            ->orderBy('r.RESPONDIDO_EM', 'DESC')
            ->get()
            ->getResultArray();
    }

    // ---------------------------------------------------------------
    // TOTAL DE RESPOSTAS DO USUÁRIO
    // Usado no RespostaController::historico()
    // ---------------------------------------------------------------
    public function totalPorUsuario(string $cpf): int
    {
        return $this->where('FK_CPF_USUARIO', $cpf)->countAllResults();
    }

    // ---------------------------------------------------------------
    // TOTAL DE ACERTOS DO USUÁRIO
    // Usado no RespostaController::historico()
    // ---------------------------------------------------------------
    public function totalAcertosPorUsuario(string $cpf): int
    {
        return (int) $this->db->table('RESPONDE r')
            ->selectSum('a.IS_CORRETA', 'acertos')
            ->join('ALTERNATIVA a', 'a.ID_ALTERNATIVA = r.FK_ID_ALTERNATIVA')
            ->where('r.FK_CPF_USUARIO', $cpf)
            ->get()
            ->getRow()
            ->acertos;
    }

    // ---------------------------------------------------------------
    // EXCLUIR RESPOSTA PELO ID
    // Usado no RespostaController::excluir()
    // ---------------------------------------------------------------
    public function excluir(int $id): bool
    {
        return $this->delete($id);
    }

    // ---------------------------------------------------------------
    // HISTÓRICO COMPLETO COM DETALHES (admin)
    // Usado no AdminController::respostas()
    // ---------------------------------------------------------------
    public function listarComDetalhes(): array
    {
        return $this->db->table('RESPONDE r')
            ->select('
                r.ID_RESPONDE,
                r.RESPONDIDO_EM,
                u.CPF          AS USUARIO_CPF,
                u.EMAIL        AS USUARIO_EMAIL,
                p.DESCRICAO    AS PERGUNTA_TEXTO,
                a.DESCRICAO    AS ALTERNATIVA_TEXTO,
                a.IS_CORRETA
            ')
            ->join('USUARIO u',    'u.CPF           = r.FK_CPF_USUARIO')
            ->join('ALTERNATIVA a', 'a.ID_ALTERNATIVA = r.FK_ID_ALTERNATIVA')
            ->join('PERGUNTA p',    'p.ID_PERGUNTA    = a.FK_ID_PERGUNTA')
            ->orderBy('r.RESPONDIDO_EM', 'DESC')
            ->get()
            ->getResultArray();
    }
}
