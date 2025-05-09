<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$app->get('/', function (Request $request, Response $response) {
    $htmlContent = "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Llista de Paraules</title>
            <meta charset='UTF-8'>
        </head>
        <body>
            <h1>Llista de Paraules</h1>
            {% for fila in words %}
                <div class='word-card'>
                    <p>
                        <strong>ID:</strong> {{ fila.item_id }}<br>
                        <strong>Nom:</strong> {{ fila.item_text }}<br>
                        <strong>Elements:</strong> {{ fila.elementos }}<br>
                        <strong>Significat:</strong> {{ fila.meaning }}<br>
                        <strong>Tipus:</strong> {{ fila.tipo }}
                    </p>
                    <div class='buttons'>
                        <a class='modify-btn' href='../controller/modificarSiglas.php?id={{ fila.item_id }}'>Modificar</a>
                        <a class='delete-btn' href='../controller/delete.php?id={{ fila.item_id }}'>Eliminar</a>
                    </div>
                </div>
            {% endfor %}
        </body>
        </html>
    ";

    $response->getBody()->write($htmlContent);
    return $response->withHeader('Content-Type', 'text/html');
});

$app->run();
?>