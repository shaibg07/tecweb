<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use TECWEB\BACKEND\Read\Read;
use TECWEB\BACKEND\Create\Create;
require '../vendor/autoload.php';
$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->setBasepath("/tecweb/actividades/a09/product_app/backend");

$app->get('/product/{id}', function(Request $request, Response $response, $args) {
    $productos = new Read('marketzone');
    $productos->single($args['id']);
    $response->getBody()->write($productos->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

//para listar
$app->get('/products', function(Request $request, Response $response) {
    $productos = new Read('marketzone');
    $productos->list();
    $response->getBody()->write($productos->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

//para buscar
$app->get('/products/{search}', function(Request $request, Response $response, $args) {
    $productos = new Read('marketzone');
    $productos->search($args['search']);
    return $response->withHeader('Content-Type', 'application/json');
});

// para agregar un producto
$app->post('/product', function(Request $request, Response $response) {
    $data = json_decode(json_encode($request->getParsedBody()));
    $productos = new Create('marketzone');
    $productos->add($data);
    $response->getBody()->write($productos->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
?>