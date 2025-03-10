<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/produit', name: 'produit')]
class ProduitController extends AbstractController
{
    #[Route(
        '/list/{page}',
        name: '_list',
        requirements: ['page' => '[1-9]\d*'],
        defaults: [ 'page' => 0],        // la valeur par défaut ne respecte pas les contraintes
    )]
    public function listAction(int $page): Response
    {
        $args = array(
            'page' => $page,
            // pour simuler une requête à la base de données
            'produits' => array(
                ['id' => 2, 'denomination' => 'RAM',     'code' => '97558143', "actif" => false],
                ['id' => 5, 'denomination' => 'souris',  'code' => '35425785', "actif" => true],
                ['id' => 6, 'denomination' => 'clavier', 'code' => '33278214', "actif" => true],
            ),
        );
        return $this->render('Produit/list.html.twig', $args);
    }


    #[Route('', name: '')]
    public function indexAction(): Response
    {
        return $this->redirectToRoute('produit_list', ['page' => 1]);
    }



    #[Route('/view/{id}',
        name: '_list',
        requirements: ['nbPage' => '[1-9]\d*'],
    )]
    public function viewAction(int $id): Response
    {
        $args = array(
            'produit' => ['id' =>$id, 'denomination' => 'souris',  'code' => '35425785', "actif" => true],
        );
        $this->addFlash('info', 'L\'enregistrement a été supprimé (bis repetita)');
        return $this->render('Produit/view.html.twig', $args);
    }

    #[Route('/add',
        name: '_add',
    )]
    public function addAction(): Response
    {

        $this->addFlash('info', 'echec de l\'ajout');
        return $this->redirectToRoute('produit_view', ['id' => 3]);
    }

    #[Route('/edit/{id}',
        name: '_edit',
        requirements: ['nbPage' => '[1-9]\d*'],
    )]
    public function editAction(int $id): Response
    {
        $this->addFlash('info', 'echec de la modification' . $id);
        return $this->redirectToRoute('produit_view', ['id' => $id]);
    }

  /*  #[Route('/delete/{id2}',
        name: '_delete',
    )]
    public function deleteAction(): Response
    {
        $this->addFlash('info', 'echec de la suppression');
        return $this->redirectToRoute('sandbox_produit_list');
    }*/
}
