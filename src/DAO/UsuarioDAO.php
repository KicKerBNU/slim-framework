<?php

namespace App\DAO;

use App\Model\UsuarioModel;

class UsuarioDAO extends conexao{
    
    public function getUserByEmail(string $email): ?UsuarioModel
    {
        $stmt = $this->pdo
        ->prepare('SELECT 
                id,
                nome,
                email,
                senha
                FROM codeeasy_gerenciador_de_lojas.usuarios
                WHERE email = :email
                ');
        $stmt->bindParam('email',$email);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if(count($usuarios) === 0)
        return null;
        $usuario = new UsuarioModel();
        $usuario->setId($usuarios[0]['id'])
                ->setNome($usuarios[0]['nome'])
                ->setEmail($usuarios[0]['email'])
                ->setSenha($usuarios[0]['senha']);  
        return $usuario;
        
    }
}