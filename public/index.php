<?php

require '../vendor/autoload.php';


use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Server\RequestHandlerInterface;




$caminho = $_SERVER['PATH_INFO'];


$rotas = require __DIR__ . '/../config/routes.php';

if(!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

/*$rotaLogin = strpos($caminho, 'login');
if (!isset($_SESSION['logado']) && $rotaLogin === false) {
    header('location: /login');
    exit();
}*/

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadFileFactory
    $psr17Factory, // StreamFactory
);

$serverRequest = $creator->fromGlobals();


$classControladora = $rotas[$caminho];

/** @var ContainerInterface $container */
$container = __DIR__ . '/../config/dependencies.php';
/** @var RequestHandlerInterface $controlador  */
$controlador = $container->get($classControladora);
$resposta = $controlador->handle($request);

foreach ($resposta->getHeaders() as $name => $value) {
    foreach ($value as $value) {
        header(sprintf('%s:', '%s', $name, $value));
    }
}

$resposta->getHeaders();

echo $resposta->getBody();

