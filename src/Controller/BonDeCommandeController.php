<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BonDeCommandeController extends AbstractController
{
    /**
     * @Route("/bon_de_commande", name="bon_de_commande")
     */
    public function index()
    {
        return $this->render('bon_de_commande/index.html.twig', [
            'controller_name' => 'BonDeCommandeController',
        ]);
    }
}
