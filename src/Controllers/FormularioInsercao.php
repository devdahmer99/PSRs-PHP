<?php

namespace Alura\Cursos\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class FormularioInsersao implements RequestHandlerInterface
{
    /** @var EntityManagerInterface*/

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->entityManager->persist();
        $html = 'teste';
        return new Response (200, [], $html);
    }
}