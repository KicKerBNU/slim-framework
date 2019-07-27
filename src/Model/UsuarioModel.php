<?php

namespace App\Model;

final class UsuarioModel{
    private $id;
    private $nome;
    private $email;
    private $senha;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
     
    public function getNome()
    {
        return $this->nome;
    }
 
    public function setNome($nome) :self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email) :self
    {
        $this->email = $email;

        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha) :self
    {
        $this->senha = $senha;

        return $this;
    }
    

}