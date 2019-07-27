<?php

namespace App\DAO;

abstract class Conexao
{
/**
 * @var PDO
 */
protected $pdo;

    public function __construct()
    {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbname = 'codeeasy_gerenciador_de_lojas';

       
        $dsn = "mysql:host={$host};dbname{$dbname};";
    
    $this->pdo = new \PDO($dsn,$user,$pass);
    $this->pdo->setAttribute(
        \PDO::ATTR_ERRMODE,
        \PDO::ERRMODE_EXCEPTION
    );
    
    }   

}