<?php

namespace App\DAO;

use \App\DAO\Conexao;
use \App\Model\ProdutoModel;

class ProdutosDAO extends Conexao
{
    public function __construct(){
        parent::__construct();

        
    }

    public function getAllProdutos(): array{
        $produtos = $this->pdo
        ->query('SELECT
                id,
                loja_id,
                nome,
                preco,
                quantidade
            FROM codeeasy_gerenciador_de_lojas.produtos;')
        ->fetchAll(\PDO::FETCH_ASSOC);

        return $produtos;
    }

    public function insereProdutos(ProdutoModel $produto): void{
        
        $stmt = $this->pdo
        ->prepare('INSERT INTO codeeasy_gerenciador_de_lojas.produtos VALUES(
            null,
            :loja_id,
            :nome,
            :preco,
            :quantidade
            );');
        $stmt->execute([
            'loja_id' => $produto->getLojaId(),
            'nome' => $produto->getNome(),
            'preco' => $produto->getPreco(),
            'quantidade' => $produto->getQuantidade()
            ]);
    }
    
}