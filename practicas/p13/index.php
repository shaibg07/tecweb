<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;

    require 'vendor/autoload.php';

    $app = AppFactory::create();

    $app->setBasePath("/tecweb/practicas/p13");

    $app->get('/', function (Request $request, Response $response, $args) {
        
        $response->getBody()->write("Hola Mundo Slim!!");
        
        return $response;
    });

    $app->get("/hola[/{nombre}]", function(Request $request, Response $response, $args){
        $nombre = $args['nombre'] ?? 'Invitado'; 
        $response->getBody()->write("Hola, " . $nombre); 
        
        return $response; 
    });

    $app->post("/pruebapost", function(Request $request, Response $response, $args){
        $reqPost = $request->getParsedBody();
        
        $val1 = $reqPost["val1"];
        $val2 = $reqPost["val2"];

        $response->getBody()->write("Valores: " . $val1 . " " . $val2);
        
        return $response; 
    });

    $app->get("/testjson", function(Request $request, Response $response, $args){
        
        $data = [
            ["nombre" => "Shai", "apellidos" => "Banuelos Garcia"],
            ["nombre" => "Maru", "apellidos" => "Gonzales Palacios"]
        ];
        $payload = json_encode($data, JSON_PRETTY_PRINT);
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write($payload);
        
        return $response;
    });

    $app->run();
?>


