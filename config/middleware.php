<?php
use Slim\Http\Request;
use Slim\Http\Response;
use App\Controler\AuthController;
// Slim middleware

$mid01 = function(Request $request, Response $response, $next){

    $response->getBody()->write("Dentro do middleware 01<br>");
    $response = $next($request,$response);
    $response->getBody()->write("<br>Dentro do middleware 02");

    return $response;

};
