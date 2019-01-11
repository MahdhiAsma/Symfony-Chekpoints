<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Emploi;
use AppBundle\Form\EmploiType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class EmploiController
 * @package AppBundle\Controller
 * @Route("/emploi")
 */
class EmploiController extends Controller
{
    /**
     * @Route("/List")
     */
    public function ListAction()
    {
        $doctrine= $this->getDoctrine();
        $repository=$doctrine->getRepository('AppBundle:Emploi');
        $emplois= $repository->findAll();
        return $this->render('@App/Emploi/list.html.twig', array(
            'emplois'=>$emplois
        ));
    }
    /**
     * @Route("/ShowForm",name="ShowEmploi")
     */
    public function ShowFormAction()
    {
        $emploi=new Emploi();
        $form=$this->createForm(EmploiType::class,$emploi,array(
            'action'=>$this->generateUrl('Addemploi')
        ));
        return $this->render('@App/Personne/add.html.twig',array(
            'form'=>$form->createView()
        ));
    }
    /**
     * @Route("/Add",name="Addemploi")
     */
    public function AddAction(Request $request)
    {
        $emploi=new Emploi();
        $form=$this->createForm(EmploiType::class,$emploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->persist($emploi);
            $em->flush();
            return $this->forward('AppBundle:Emploi:List');

        }
        else{
            return $this->render('@App/Emploi/add.html.twig',array(
                'form'=>$form->createView()
            ));
        }

    }

    /**
     * @Route("/Remove/{emploi}",name="RemoveEmploi")
     */
    public function RemoveAction(Request $request,Emploi $emploi=null)
    {
        $session=$request->getSession();
        if(!$emploi)
        {
            $session->getFlashBag()->add('error','emploi inexistant');
        }
        else{
            $em=$this->getDoctrine()->getManager();
            $em->remove($emploi);

            $em->flush();
        }
        return $this->forward('AppBundle:Emploi:List');
    }

    /**
     * @Route("/Update")
     */
    public function UpdateAction()
    {
        return $this->render('AppBundle:Emploi:update.html.twig', array(
            // ...
        ));
    }

}
