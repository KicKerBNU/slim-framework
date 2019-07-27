<?php

namespace APP\DAO;

use \App\DAO\Conexao;
use App\Model\LojaModel;


class LojasDAO extends Conexao
{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function getAllLojas(): array{
        $lojas = $this->pdo
        ->query('SELECT
                id,
                nome,
                telefone,
                endereco
            FROM codeeasy_gerenciador_de_lojas.lojas;')
        ->fetchAll(\PDO::FETCH_ASSOC);

        return $lojas;
    }

    public function insereLoja(LojaModel $loja): void{
        
        $stmt = $this->pdo
        ->prepare('INSERT INTO codeeasy_gerenciador_de_lojas.lojas VALUES(
            null,
            :nome,
            :telefone,
            :endereco
            );');
        $stmt->execute([
            'nome' => $loja->getNome(),
            'telefone' => $loja->getTelefone(),
            'endereco' => $loja->getEndereco()
            ]);
    }

    public function updateLoja(LojaModel $loja): void{
        
        $stmt = $this->pdo
            ->prepare('UPDATE codeeasy_gerenciador_de_lojas.lojas SET
                nome = :nome,
                telefone = :telefone,
                endereco = :endereco
                WHERE
                id = :id
                ;');
        $stmt->execute([
            'nome' => $loja->getNome(),
            'telefone' => $loja->getTelefone(),
            'endereco' => $loja->getEndereco(),
            'id' => $loja->getId()
            ]);   
            
    }

    public function deleteLoja($id): void
    {
        $stmt = $this->pdo
            ->prepare('DELETE FROM codeeasy_gerenciador_de_lojas.lojas 
                       WHERE id = :id;');
        $stmt->execute([
            'id' => $id
        ]);
    }


    
}