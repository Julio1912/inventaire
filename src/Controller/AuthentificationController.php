<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;

/**
 * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
 */
class AuthentificationController extends AbstractController
{
    /**
     * @Route("/authentification", name="authentification")
     */
    public function index(AuthenticationUtils $authenticationUtils ) : Response
    {
        $error=$authenticationUtils->getLastAuthenticationError();
        $lastUsername=$authenticationUtils->getLastUsername();
        return $this->render('authentification/index.html.twig', [
            'controller_name' => 'AuthentificationController',
            'last_username' => $lastUsername , 
            'error' => $error
        ]);
    }

    /**
     * @Route("/inscription" , name="inscription")
     */
    public function inscription(Utilisateur $utilisateur=null , Request $request , ObjectManager $manager , UserPasswordEncoderInterface $encoder)
    {
        if(!$utilisateur)
        {
            $utilisateur=new Utilisateur();
        }
        $form=$this->createForm(UtilisateurType::class , $utilisateur) ; 
        $form->handleRequest($request); 

        if($form->isSubmitted() && $form->isValid())
        {
            $hash=$encoder->encodePassword($utilisateur , $utilisateur->getPassword());
            $utilisateur->setPassword($hash);
            // $utilisateur->setRoles("ROLE_ADMIN");
            $utilisateur->addRole("ROLE_ADMIN");
            $manager->persist($utilisateur); 
            $manager->flush();
            return $this->redirectToRoute('authentification') ; 
        }

        return $this->render('authentification/inscription.html.twig', [
            'InscriptionView' => $form->createView(),
        ]);
    }
    /**
     * @Route("/deconnexion" , name="deconnexion")
     */
    public function deconnexion()
    {
        return null;
        // throw new \Exception('This should never be reached!');
    }
}
