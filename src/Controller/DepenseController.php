<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\Entity\Depense;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\DepenseType;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use Dompdf\Options;



/**
 * Depense  controller.
 *
 * @Route("/admin/depense")
 */
class DepenseController extends AbstractController
{
    /**
     * @Route("/", name="admin_depense_index")s
     */
    public function index(Request $request)
    {

      $repo = $this->getDoctrine()->getManager()->getRepository(Depense::class);
      $depenses = $repo->findBy(array('deleted' => 0));
        return $this->render('depense/index.html.twig', array(
            'depenses' => $depenses,
        ));
    }


    /**
         * @Route("/new", name="admin_depense_new")
         * @Method({"GET", "POST"})
         */
        public function newAction(Request $request)
        {
            $depense = new Depense ();
            $form = $this->createForm(DepenseType::class, $depense);
            $form->handleRequest($request);
            $depense->setCreated(new \DateTime());
            $depense->setUpdated(new \DateTime());

            if ($form->isSubmitted() && $form->isValid()) {
              // $depense->uploadFile($this->getParameter('depense_images_dir'));

                $em = $this->getDoctrine()->getManager();

              //  dd($form['photo']->getData());
                $em->persist($depense);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'depense.added.success');

                return $this->redirectToRoute('admin_depense_index');
            }

            return $this->render('depense/new.html.twig', array(
                'depense' => $depense,
                'form' => $form->createView(),
            ));
        }



        /**
           * @Route("/{id}", name="admin_depense_show")
           * @Method("GET")
           */
          public function showAction(Depense $depense)
          {


               return $this->render('depense/show.html.twig', array(
                  'depense' => $depense,
              ));
          }

          /**
           * @Route("/{id}/edit", name="admin_depense_edit")
           * @Method({"GET", "POST"})
           */
          public function editAction(Request $request, Depense  $depense)
          {
            $form = $this->createForm(DepenseType::class, $depense);

              $form->handleRequest($request);

             // $oldFile = $depense->getPhoto();
             $depense->setUpdated(new \DateTime());

              if ($form->isSubmitted() && $form->isValid()) {
                // $depense->uploadFile($this->getParameter('depense_images_dir'),$oldFile);
                 // dd($form->getData());

                  $em = $this->getDoctrine()->getManager();
                  $em->persist($depense);
                  $em->flush();
                  // dump($service);die();
                  $request->getSession()->getFlashBag()->add('success', 'depense.updated.success');

                  return $this->redirectToRoute('admin_depense_show', array('id' => $depense->getId()));
              }

              return $this->render('depense/edit.html.twig', array(
                  'depense' => $depense,
                  'form' => $form->createView(),
              ));
          }

          /**
           * @Route("/{id}/delete", name="admin_depense_delete")
           * @Method("GET")
           */
          public function deleteAction(Request $request, Depense  $depense)
          {

              if (!$depense) {
                  throw $this->createNotFoundException('depense not found ' . $id);
              }
              $em = $this->getDoctrine()->getManager();
              $depense->setDeleted(true);
            //  dump($depense);die();
              $em->flush();
              $request->getSession()->getFlashBag()->add('info', 'depense.deleted.success');

              return $this->redirectToRoute('admin_depense_index');
          }








}
