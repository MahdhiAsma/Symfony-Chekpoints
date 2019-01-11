<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Adresse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdresseController
 * @package AppBundle\Controller
 * @Route("/adresse")
 */
class AdresseController extends Controller
{
    /**
     * @Route("/Add")
     */
    public function AddAction()
    {
        return $this->render('AppBundle:Adresse:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/Remove/{addresse}",name="RemoveAddresse")
     */
    public function RemoveAction(Request $request,Adresse $addresse)
    {
        $session=$request->getSession();
        if(!$addresse)
        {
            $session->getFlashBag()->add('error','Adresses inexistant');
        }
        else{
            $em=$this->getDoctrine()->getManager();
            $em->remove($addresse);

            $em->flush();
        }
        return $this->forward('AppBundle:Adresse:List');
    }

    /**
     * @Route("/Update")
     */
    public function UpdateAction()
    {
        return $this->render('AppBundle:Adresse:update.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/List")
     */
    public function ListAction()
    {
        $doctrine= $this->getDoctrine();
        $repository=$doctrine->getRepository('AppBundle:Adresse');
        $addresses= $repository->findAll();
        return $this->render('@App/Adresse/list.html.twig', array(
            'addresses'=>$addresses
        ));
    }

}
