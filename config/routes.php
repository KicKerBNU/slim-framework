<?php

use Slim\Container;
use Slim\Views\Twig;
use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Log\LoggerInterface;
use App\Controler\AuthController;







//==================================================================================
$app->get('/', function (Request $request, Response $response) {
     $response->getBody()->write("It works! This is the default welcome page.");

     return $response;
})->setName('root');

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});


$app->get('/time', function (Request $request, Response $response) {
    $viewData = [
        'now' => date('Y-m-d H:i:s')
    ];

    return $this->get(Twig::class)->render($response, 'time.twig', $viewData);
});



$app->get('/logger-test', function (Request $request, Response $response) {
    /** @var Container $this */
    /** @var LoggerInterface $logger */

    $logger = $this->get(LoggerInterface::class);
    $logger->error('My error message!');

    $response->getBody()->write("Success");

    return $response;
});

//Get All Customers
$app->get('/customers', function(Request $request, Response $resposse){
    $sql = "SELECT * from customers";
    try {
        
        //get DB Object
        $db = new db();
        //Connect
        $db = $db->connect();
        $stmt =  $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customers);
        
    } catch (PDOException $e) {
        echo '{"error": {"text":'.$e->getMessage().'}';
    }
    
});

//Get a Single Customer
$app->get('/customers/{id}', function(Request $request, Response $resposse){
    $id = $request->getAttribute('id');
    
    $sql = "SELECT * FROM customers WHERE id = $id";
    try {
        //get DB Object
        $db = new db();
        //Connect
        $db = $db->connect();
        $stmt =  $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        echo json_encode($customer);
    } catch (PDOException $e) {
        echo '{"error": {"text":'.$e->getMessage().'}';
    }
});
//Add Customer
$app->post('/customers/add', function(Request $request, Response $resposse){
    $name = $request->getParam('name') ?? '';
    $email = $request->getParam('email') ?? '';
    $phone = $request->getParam('phone') ?? '';
    
    $sql = "INSERT INTO customers (name,email,phone) 
    VALUES(:name,:email,:phone)";
    try {
        //get DB Object
        $db = new db();
        //Connect
        $db = $db->connect();
        $stmt =  $db->prepare($sql);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':phone',$phone);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $stmt->execute();
        echo '{"notice": {"text": "Customer Added"}';
        
    } catch (PDOException $e) {
        echo '{"error": {"text":'.$e->getMessage().'}';
    }
});
//Update Customer
$app->put('/customers/update/{id}', function(Request $request, Response $resposse){
    $id = $request->getAttribute('id');
    $name = $request->getParam('name');
    $email = $request->getParam('email');
    $phone = $request->getParam('phone');

    $sql = "UPDATE customers SET
                name = :name,
                email = :email,
                phone = :phone
            WHERE id = $id";
    try {
        //get DB Object
        $db = new db();
        //Connect
        $db = $db->connect();
        $stmt =  $db->prepare($sql);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':phone',$phone);
        
        
        $stmt->execute();
        echo '{"notice": {"text": "Customer Update"}';
        
    } catch (PDOException $e) {
        echo '{"error": {"text":'.$e->getMessage().'}';
    }
});
//Delete a Single Customer
$app->delete('/customers/delete/{id}', function(Request $request, Response $resposse){
    $id = $request->getAttribute('id');
    
    $sql = "DELETE FROM customers WHERE id = $id";
    try {
        //get DB Object
        $db = new db();
        //Connect
        $db = $db->connect();
        $stmt =  $db->prepare($sql);
        $stmt->execute();
        $db = null;
        
        echo '{"notice": {"text": "Customer Deleted"}';
        
    } catch (PDOException $e) {
        echo '{"error": {"text":'.$e->getMessage().'}';
    }
});

$app->any('/ping', \App\Action\PingAction::class);

//Testes de API com o mesmo nome de ROTA

$app->get('/produtos', function (Request $request, Response $response, $args) {
    $limit = $request->getQueryParams()['limit'] ?? 10;
    
    $nome = $args['nome'] ?? 'mouse';
    return $response->getBody()->write("{$limit}produtos do banco de dados com o nome {$nome} (GET)");
});
$app->post('/produtos', function (Request $request, Response $response, $args) {
    $limit = $request->getQueryParams()['limit'] ?? 10;
    
    $nome = $args['nome'] ?? 'mouse';
    return $response->getBody()->write("{$limit}produtos do banco de dados com o nome {$nome} (POST)");
})->add($mid01);
$app->put('/produtos', function (Request $request, Response $response, $args) {
    $limit = $request->getQueryParams()['limit'] ?? 10;
    
    $nome = $args['nome'] ?? 'mouse';
    return $response->getBody()->write("{$limit}produtos do banco de dados com o nome {$nome} (PUT)");
});
$app->delete('/produtos', function (Request $request, Response $response, $args) {
    $limit = $request->getQueryParams()['limit'] ?? 10;
    
    $nome = $args['nome'] ?? 'mouse';
    return $response->getBody()->write("{$limit}produtos do banco de dados com o nome {$nome} (DELETE)");
});
//=========================================================================================

//LOGIN
$app->post('/login',\App\Controller\AuthController::class.':login');
//Exceptions
$app->get('/exception-test', \App\Controller\ExceptionController::class . ':test');

//Tabela Loja
$app->get('/loja',\App\Controller\LojaController::class.':getLoja');
    
$app->post('/loja',\App\Controller\LojaController::class.':insertLoja');
$app->put('/loja',\App\Controller\LojaController::class.':updateLoja');
$app->delete('/loja',\App\Controller\LojaController::class.':deleteLoja');

//Tabela Produtos
$app->get('/produto',\App\Controller\ProdutoController::class.':getProduto');
$app->post('/produto',\App\Controller\ProdutoController::class.':insertProduto');
$app->put('/produto',\App\Controller\ProdutoController::class.':updateProduto');
$app->delete('/produto',\App\Controller\ProdutoController::class.':deleteProduto');

$app->get('/hellow/{name}', function ($request, $response, $args) {
    return $this->view->render($response, 'Hello Mustache, {{name}}', [
        'name' => $args['name']
    ]);
});

$app->get('/lojas', function (Request $request, Response $response) {
    $loader = new  Mustache_Loader_FilesystemLoader
    ('../src/View',['extension' => '.html']);
    $result = $loader->load('home');
    $o_mustache = new Mustache_Engine();
    $template = $o_mustache->render($result);
    
    
    return $template;
});








