<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


use App\Entity\TBase;
use App\Form\TBaseType;
use App\Repository\TBaseRepository;

use App\Entity\TCode;
use App\Form\TCodeType;
use App\Repository\TCodeRepository;

use App\Entity\TEmplacement;
use App\Form\TEmplacementType;
use App\Repository\TEmplacementRepository;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class InventController extends AbstractController
{
    /**
     * @Route("/" , name="principale")
     */
    public function dashboard()
    {
        $selectionCode=$this->getDoctrine()->getRepository(TCode::class) ; 
        $countCode=$selectionCode->findCountCode();

        $selectionBase=$this->getDoctrine()->getRepository(TBase::class) ; 
        $countBase=$selectionBase->findCountBase();

        $selectionEmplacement=$this->getDoctrine()->getRepository(TEmplacement::class) ; 
        $countEmplacement=$selectionEmplacement->findCountEmplacement();
        return $this->render('/invent/dashboard.html.twig' , [
            'CompteurCode' => $countCode , 
            'CompteurBase' => $countBase , 
            'CompteurEmplacement' => $countEmplacement
        ]) ; 
    }

    /**
     * @Route("/code", name="code")
     */
    public function code(ObjectManager $manager , Request $request , TCode $code=null)
    {
        if(!$code)
        {
            $code=new TCode();
        }
        $form=$this->createForm(TCodeType::class , $code);
        $form->handleRequest($request); 

        if($form->isSubmitted()  && $form->isValid())
        {
            $manager->persist($code) ; 
            $manager->flush();
            return $this->redirectToRoute('code');
        }
        $selection=$this->getDoctrine()->getRepository(TCode::Class) ; 
        $listes=$selection->findAll();
        return $this->render('invent/code/code.html.twig', [
            'controller_name' => 'InventController',
            'CodeView' => $form->createView() , 
            'ListeCode' => $listes , 
        ]);
    }

    /**
     * @Route("/code/supprimercode/{id}" , name="supprimer_code")
     */
    public function supprimercode(ObjectManager $manager , Request $request , TCode $code , $id)
    {
        $tirer=$this->getDoctrine()->getRepository(TCode::class) ;
        $supprimer=$tirer->findById($id) ; 

        $manager->remove($code) ; 
        $manager->flush();

        return $this->redirectToRoute('code');
    }



    /**
     * @Route("/emplacement" , name="emplacement")
     */
    public function emplacement(ObjectManager $manager , Request $request , TEmplacement $emplacement=null)
    {
        if(!$emplacement)
        {
            $emplacement=new TEmplacement();
        }
        $form=$this->createForm(TEmplacementType::class , $emplacement);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() )
        {
            $manager->persist($emplacement) ; 
            $manager->flush();
        }
        $tirer=$this->getDoctrine()->getRepository(TEmplacement::class) ; 
        $liste=$tirer->findAll();
        return $this->render('invent/emplacement/emplacement.html.twig' , [
            'EmplacementView' =>$form->createview() , 
            'ListeEmplacement' => $liste
        ]);
    }

    /**
     * @Route("/emplacement/suppimer/{id}" , name="supprimer_emplacement")
     */
    public function supprimerEmplacement(ObjectManager $manager , Request $request , TEmplacement $emplacement=null , $id)
    {
        $tirer=$this->getDoctrine()->getRepository(TEmplacement::class) ;
        $supprimer=$tirer->findById($id) ; 

        $manager->remove($emplacement) ; 
        $manager->flush();

        return $this->redirectToRoute('emplacement');

    }

    
    /**
     * @Route("/inventaire" , name="inventaire_list")
     */
    public function inventaire(ObjectManager $manager , Request $request , TBase $base=null)
    {
        if(!$base)
        {
            $base=new TBase();
        }
        $form=$this->createForm(TBaseType::class , $base) ;
        $form->handleRequest($request) ; 

        if($form->isSubmitted()  && $form->isValid() )
        {
            $manager->persist($base);  
            $manager->flush();
            return $this->redirectToRoute('inventaire_list') ; 
        }
        $tirer=$this->getDoctrine()->getRepository(TBase::class) ;  
        $liste=$tirer->findAll();
        return $this->render('invent/inventaire/invent.html.twig' , [
            'InventaireView' => $form->createView() , 
            'BaseCode' => $liste ,
        ] ) ;
    }

    /**
     * @Route("/inventaire/detail/{id}" , name="inventaire_detail")
     */
    public function inventaireDetail(Request $request , ObjectManager $manager , Tbase $base=null , $id)
    {
        $detail=$this->getDoctrine()->getRepository(Tbase::Class)->findById($id) ; 
        return $this->render("invent/inventaire/inventaire_detail.html.twig" , [
            'Details' => $detail,
        ]) ; 
    }

    /**
     * @Route("/inventaire/supprimer/{id}" , name="supprimer_inventaire")
    */
    public function supprimerInventaire(Request $request , ObjectManager $manager , TBase $base=null , $id)
    {
        if(!$base){$base=new TBase();}
        $supprimer=$this->getDoctrine()->getRepository(TBase::class)->findById($id) ; 
        $manager->remove($base) ; 
        $manager->flush();
        return $this->redirectToRoute('inventaire_list');
    }

    /**
     * @Route("inventaire/detail/modifier/{id}" , name="modifier_inventaire")
     */
    public function modifierInventaire(Request $request , ObjectManager $manager , TBase $base=null , $id)
    {
        if(!$base)
        {
            $base=new TBase();
        }
        $form=$this->createForm(TbaseType::class , $base); 
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($base);
            $manager->flush();
            return $this->redirectToRoute('inventaire_detail' , ['id'=>$id]);
        }

        return $this->render('invent/inventaire/modifier_inventaire.html.twig' ,[
            'ModificationInventaireView' => $form->createView(), 
        ] ) ; 
    }

    

}
