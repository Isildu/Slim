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
    // Simulamos datos para $words (reemplaza con datos reales si ya los tienes)
    $words = [
        [
            'item_id' => 1,
            'item_text' => 'Exemple',
            'elementos' => 'ABC',
            'meaning' => 'Significat',
            'tipo' => 'Nom'
        ]
    ];

    // Captura de salida con ob_start()
    ob_start();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Llista de Paraules</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Llista de Paraules</h1>
        <?php foreach ($words as $fila): ?>
            <div class="word-card">
                <p>
                    <strong>ID:</strong> <?= htmlspecialchars($fila['item_id']) ?><br>
                    <strong>Nom:</strong> <?= htmlspecialchars($fila['item_text']) ?><br>
                    <strong>Elements:</strong> <?= htmlspecialchars($fila['elementos']) ?><br>
                    <strong>Significat:</strong> <?= htmlspecialchars($fila['meaning']) ?><br>
                    <strong>Tipus:</strong> <?= htmlspecialchars($fila['tipo']) ?>
                </p>
            </div>
        <?php endforeach; ?>
    </body>
    </html>
    <?php

    $htmlContent = ob_get_clean(); // Guarda el HTML generado
    $response->getBody()->write($htmlContent);
    return $response->withHeader('Content-Type', 'text/html');
});

$app->run();
?>