<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Media;
use AppBundle\Entity\Personne;
use AppBundle\Entity\Emploi;
use AppBundle\Entity\Adresse;
use AppBundle\Form\PersonneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class PersonneController
 * @package AppBundle\Controller
 * @Route("/personne")
 */
class PersonneController extends Controller
{
    /**
     * @Route("/ShowForm",name="ShowPersonne")
     */
    public function ShowFormAction()
    {
        $personne=new Personne();
        $form=$this->createForm(PersonneType::class,$personne,array(
            'action'=>$this->generateUrl('AddPersonne')
        ));
        return $this->render('@App/Personne/add.html.twig',array(
            'form'=>$form->createView()
        ));
    }
    /**
     * @Route("/Add",name="AddPersonne")
     */
    public function AddAction(Request $request)
    {
        $media=new Media();
        $personne=new Personne();
        $form=$this->createForm(PersonneType::class,$personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file=$form['image']->getData();
            $NewImageName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('Personne_images'),$NewImageName);
            $personne->setImage($NewImageName);
            $em=$this->getDoctrine()->getManager();
            $media->setPhoto($NewImageName);
            $personne->setMedia($media);
            $em->persist($media);
            $em->flush();
            $em=$this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();
            return $this->forward('AppBundle:Personne:List');
        }
        else{
            return $this->render('@App/Personne/add.html.twig',array(
                'form'=>$form->createView()
            ));
        }

    }


    /**
     * @Route("/Remove/{personne}",name="RemovePersonne")
     */
    public function RemoveAction(Request $request,Personne $personne=null)
    {  $session=$request->getSession();
        if(!$personne)
        {
            $session->getFlashBag()->add('error','personne inexistante');
        }
        else{
            $em=$this->getDoctrine()->getManager();
            $em->remove($personne);

            $em->flush();
        }
        return $this->forward('AppBundle:Personne:List');
    }


    /**
     * @Route("/List")
     */
    public function ListAction()
    {
        $doctrine= $this->getDoctrine();
        $repository=$doctrine->getRepository('AppBundle:Personne');
        $personnes= $repository->findAll();

        return $this->render('@App/Personne/list.html.twig', array(
            'personnes'=>$personnes
        ));
    }
    /**
     * @Route("/cv/{id}", name="cvpage")
     *
     */
    public function cvAction(Personne $personne)
    {

        return $this->render('@App/Personne/cv.html.twig', array(
            'personne'=>$personne));
    }




    /**
     * @Route("/Updateform/{personne}",name="Updateform")
     */
    public function UpdateAction(Request $request,Personne $personne)
    {
        $em = $this->getDoctrine()->getManager();
        $personne = $em->getRepository('AppBundle:Personne')->find($personne);
        $update=$this->createForm(PersonneType::class,$personne);
        $update->handleRequest($request);
          $media=new Media();
        if ($update->isSubmitted() && $update->isValid()) {
            $file=$update['image']->getData();
            $NewImageName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('Personne_images'),$NewImageName);
            $personne->setImage($NewImageName);
            $em=$this->getDoctrine()->getManager();
            $media->setPhoto($NewImageName);
            $personne->setMedia($media);
            $em->persist($media);
            $em->flush();
            $em=$this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();

            return $this->render('@App/Personne/cv.html.twig', array(
                'personne'=>$personne
            ));
        }
        else{
            return $this->render("@App/Personne/update.html.twig", array(
                'form' => $update->createView(),));        }


    }
}
