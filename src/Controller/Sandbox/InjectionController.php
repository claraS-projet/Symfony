<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\Session;

#[Route('/sandbox/injection', name: 'sandbox_injection')]
class InjectionController extends AbstractController
{
    #[Route('/un', name: '_un')]
    public function unAction(Request $request): Response
    {
        dump($request->getMethod());               // méthode HTTP
        dump($request->query->get('foo'));         // $_GET['foo']
        dump($request->query->all());              // $_GET
        dump($request->cookies->all());

        return new Response('<body>Injection::un</body>');
    }

    #[Route('/deux', name: '_deux')]
    public function deuxAction(Request $request, Session $session): Response
    {
        // note : on peut aussi récupérer la session avec : $request->getSession();
        if ($request->query->has('compteur'))
            $session->set('compteur', $request->query->get('compteur'));
        elseif (! is_null($request->query->get('inc')))
            $session->set('compteur', $session->get('compteur') + 1);
        elseif ($request->query->get('supp') !== null)
            $session->remove('compteur');

        dump($session->all());
        dump($_SESSION);

        return new Response('<body>Injection::deux</body>');
    }

    #[Route('/create-flash', name: '_create_flash')]
    public function createFlashAction(Session $session): Response
    {
        // par exemple cette action supprime une entrée dans la base de données
        $session->getFlashBag()->add('info', 'L\'enregistrement a été supprimé');
        $this->addFlash('info', 'L\'enregistrement a été supprimé (bis repetita)');
        $this->addFlash('error', 'Il pourrait y avoir une erreur');
        $this->addFlash('error', 'Il pourrait y avoir une erreur(bis)');
        return $this->redirectToRoute('sandbox_injection_display_flash');
    }

    #[Route('/display-flash', name: '_display_flash')]
    public function displayFlashAction(): Response
    {
        return $this->render('Sandbox/Injection/displayFlash.html.twig');
    }


}
