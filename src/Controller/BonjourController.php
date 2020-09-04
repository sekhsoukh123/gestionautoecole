<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Bonjour controller.
 *
 * @Route("/bonjour")
 */
class BonjourController extends AbstractController{


  /**
   * @Route("/", name="admin_bonjour_index")
   * @Method("GET")
   */
    function index(){

        //return new Response ("bonjour tout le monde");
        $vari = 'vari';
        return $this->render('Bonjour/index.html.twig',[
          'vari' =>$vari
        ]);
    }

    /**
     * @Route("/add", name="admin_bonjour_add")
     * @Method("GET")
     */
      function add(){

          return new Response ("Add ");
      }
}
