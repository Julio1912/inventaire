<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Form\ModifierUtilisateurType;
use App\Repository\UtilisateurRepository;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index(Request $request , ObjectManager $manager , Utilisateur $utilisateur=null )
    {
        if(!$utilisateur)
        {
            $utilisateur=new Utilisateur();
        }
        $liste=$this->getDoctrine()->getRepository(Utilisateur::class)->findAll();
        return $this->render('utilisateur/ListeUtilisateur.html.twig', [
            'controller_name' => 'UtilisateurController',
            'ListeUtilisateur' => $liste
        ]);
    }

    /**
     * @Route("/utilisateur/modifier/{id}" , name="modifier_utilisateur")
     */
    public function ModifierUtilisateur(ObjectManager $manager , Request $request , $id , Utilisateur $utilisateur=null)
    {
        if(!$utilisateur)
        {
            $utilisateur=new Utilisateur();
        }
        $form=$this->createForm(ModifierUtilisateurType::class , $utilisateur) ;
        $form->handleRequest($request) ; 

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($utilisateur) ; 
            $manager->flush() ;
            return $this->redirectToRoute('utilisateur' , ['id'=>$id]);
        }

        return $this->render('utilisateur/ModifierUtilisateur.html.twig' , [
            'formUtilisateur' =>$form->createView()
        ]) ; 
    }

    /**
     * @Route("/utilisateur/supprimer/{id}" , name="supprimer_utilisateur")
     */
    public function SupprimerUtilsateur(Request $request , ObjectManager $manager , Utilisateur $utilisateur=null , $id)
    {
        $select=$this->getDoctrine()->getRepository(Utilisateur::class) ;
        $supprimer=$select->findById($id) ; 
        $manager->remove($utilisateur) ; 
        $manager->flush();
        return $this->redirectToRoute('utilisateur');
        // return $this->render('utilisateur/SupprimerUtilisateur.html.twig');
    }


}
