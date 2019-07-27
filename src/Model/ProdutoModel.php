<?php
namespace App\Model;

final class ProdutoModel{
    private $id;
    private $loja_id;
    private $nome;
    private $preco;
    private $quantidade;

    public function getId():id {
        return $this->id;
    }

    public function setLojaId(int $loja_id): ProdutoModel{
        $this->loja_id = $loja_id;

        return $this;
    }

    public function getLojaId():int {
        return $this->loja_id;
    }

    public function getNome():string{
        return $this->nome;
    }

    public function setNome(string $nome): ProdutoModel{
        $this->nome = $nome;

        return $this;
    }

    public function getpreco():string{
        return $this->preco;
    }

    public function setPreco(string $preco): ProdutoModel{
        $this->preco = $preco;
        return $this;
    }

    public function getQuantidade():string{
        return $this->quantidade;
    }

    public function setQuantidade(string $quantidade): ProdutoModel{
        $this->quantidade = $quantidade;
        return $this;
    }
    
}