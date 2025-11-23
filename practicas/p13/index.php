<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;

    require 'vendor/autoload.php';

    $app = AppFactory::create();

    $app->setBasePath("/tecweb/practicas/p13");

    $app->get('/', function (Request $request, Response $response) {
        
        $response->getBody()->write("Hola Mundo Slim!!");
        
        return $response;
    });

    $app->get("/hola[/{nombre}]", function(Request $request, Response $response, $args){
        $nombre = $args['nombre'] ?? 'Invitado'; 
        $response->getBody()->write("Hola, " . $nombre); 
        
        return $response; 
    });

    $app->run();
?>


