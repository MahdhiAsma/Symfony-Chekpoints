<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
 * Class MediaController
 * @package AppBundle\Controller
 * @Route("/media")
 */
class MediaController extends Controller
{
    /**
     * @Route("/Add")
     */
    public function AddAction()
    {
        return $this->render('AppBundle:Media:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/Remove")
     */
    public function RemoveAction()
    {
        return $this->render('AppBundle:Media:remove.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/Update")
     */
    public function UpdateAction()
    {
        return $this->render('AppBundle:Media:update.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/List")
     */
    public function ListAction()
    {
        return $this->render('AppBundle:Media:list.html.twig', array(
            // ...
        ));
    }

}
