<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\DAO\LojasDAO;
use \App\Model\LojaModel;

final class LojaController{

    public function getLoja(Request $request, Response $response,array $args){
        $lojasDAO = new LojasDAO();
        $lojas = $lojasDAO->getAllLojas();
        $response = $response->withJson($lojas);
        
        return $response;
        //return (Twig::class)->render('layout.twig',$response);
        //$this->get(Twig::class)->render($response, 'layout.twig');
    }

    public function insertLoja(Request $request, Response $response,array $args){
        $data = $request->getParsedBody();
        
        $lojasDAO = new LojasDAO();
        $loja = new LojaModel();
        $loja->setNome($data['nome'])
             ->setEndereco($data['endereco'])
             ->setTelefone($data['telefone']);
        $lojasDAO->insereLoja($loja);

        $response = $response->withJson(['message' => 'Loja Inserida com sucesso!']);

        return $response;
    }
        
    public function updateLoja(Request $request, Response $response,array $args) :Response
    {
        $data = $request->getParsedBody();
        

        $lojasDAO = new LojasDAO();
        $loja = new LojaModel();   
        $loja->setId((int)$data['id'])
             ->setNome($data['nome'])
             ->setEndereco($data['endereco'])
             ->setTelefone($data['telefone']);
        $lojasDAO->updateLoja($loja);
        
            
        $response = $response->withJson(['message' => 'Loja Atualizada com sucesso!']);
        
        return $response;
    }

    public function deleteLoja(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        
        
        $lojasDAO = new LojasDAO();
        
        $lojasDAO->deleteLoja($data['id']);

        $response = $response->withJson([
            'message' => 'Loja excluída com sucesso! '
        ]);

        return $response;
    }
}
