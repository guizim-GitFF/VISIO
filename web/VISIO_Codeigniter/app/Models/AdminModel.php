<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * AdminModel
 * Responsável por todas as operações da tabela ADMIN no MySQL.
 * Chave primária: CNPJ (string, sem auto-incremento).
 * CORREÇÃO: campo NOME removido de allowedFields — não existe na tabela ADMIN do banco.
 */
class AdminModel extends Model
{
    protected $table            = 'ADMIN';
    protected $primaryKey       = 'CNPJ';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'CNPJ',
        'EMAIL',
        'TELEFONE',
        'SENHA',
    ];

    /**
     * Busca um administrador pelo e-mail para o sistema de login.
     */
    public function buscarPorEmail(string $email): array|null
    {
        return $this->where('EMAIL', $email)->first();
    }
}
