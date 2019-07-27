<?php
namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

final class PingAction
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        return $response->withJson(['success' => true]);
    }
}