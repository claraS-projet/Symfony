<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sandbox/prefix', name: 'sandbox_prefix')]
class Prefix extends AbstractController
{
    #[Route('', name: '')]
    public function indexAction(): Response
    {
        return new Response('<body>Hello World!</body>');
    }

    #[Route('/hello', name: '_hello')]
    public function helloAction(): Response
    {
        return $this->render('Sandbox/Prefix/hello.html.twig');
    }
}