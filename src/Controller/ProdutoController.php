<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\DAO\ProdutosDAO;
use \App\Model\ProdutoModel;


final class ProdutoController{
    
    public function getProduto(Request $request, Response $response,array $args){
        $produtosDAO = new ProdutosDAO();
        $produtos = $produtosDAO->getAllProdutos();
        $response = $response->withJson($produtos);
        
        return $response;
    }
    
    public function insertProduto(Request $request, Response $response,array $args){
        $data = $request->getParsedBody();
        
        $produtoDAO = new ProdutosDAO();
        $produto = new ProdutoModel();
        $produto
             ->setLojaId($data['loja_id'])
             ->setNome($data['nome'])
             ->setQuantidade($data['quantidade'])
             ->setPreco($data['preco']);
        $produtoDAO->insereProdutos($produto);

        $response = $response->withJson(['message' => 'Produto Inserida com sucesso!']);

        return $response;
    }

    public function updateProduto(Request $request, Response $response,array $args){
        
        return $response;
    }
    
    public function deleteProduto(Request $request, Response $response,array $args){
        
        return $response;
    }
    
}