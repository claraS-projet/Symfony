<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OverviewController extends AbstractController
{
    #[Route('/sandbox/overview', name: 'sandbox_overview')]
    public function indexAction(): Response
    {
        return new Response('Hello world');
    }
}
