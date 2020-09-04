<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\Entity\Entreprise;
use App\Entity\Cpayment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\EntrepriseType;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use Dompdf\Options;



/**
 * Entreprise  controller.
 *
 * @Route("/admin/entreprise")
 */
class EntrepriseController extends AbstractController
{
    /**
     * @Route("/", name="admin_entreprise_index")s
     */
    public function index(Request $request)
    {

      $repo = $this->getDoctrine()->getManager()->getRepository(Entreprise::class);
      $entreprises = $repo->findBy(array('deleted' => 0));
        return $this->render('entreprise/index.html.twig', array(
            'entreprises' => $entreprises,
        ));
    }


    /**
         * @Route("/new", name="admin_entreprise_new")
         * @Method({"GET", "POST"})
         */
        public function newAction(Request $request)
        {
            $entreprise = new Entreprise ();
            $form = $this->createForm(EntrepriseType::class, $entreprise);
            $form->handleRequest($request);
            $entreprise->setCreated(new \DateTime());
            $entreprise->setUpdated(new \DateTime());

            if ($form->isSubmitted() && $form->isValid()) {
              // $entreprise->uploadFile($this->getParameter('entreprise_images_dir'));

                $em = $this->getDoctrine()->getManager();

              //  dd($form['photo']->getData());
                $em->persist($entreprise);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'entreprise.added.success');

                return $this->redirectToRoute('admin_entreprise_index');
            }

            return $this->render('entreprise/new.html.twig', array(
                'entreprise' => $entreprise,
                'form' => $form->createView(),
            ));
        }



        /**
           * @Route("/{id}", name="admin_entreprise_show")
           * @Method("GET")
           */
          public function showAction(Entreprise $entreprise)
          {


               return $this->render('entreprise/show.html.twig', array(
                  'entreprise' => $entreprise,
              ));
          }

          /**
           * @Route("/{id}/edit", name="admin_entreprise_edit")
           * @Method({"GET", "POST"})
           */
          public function editAction(Request $request, Entreprise  $entreprise)
          {
            $form = $this->createForm(EntrepriseType::class, $entreprise);

              $form->handleRequest($request);

             // $oldFile = $entreprise->getPhoto();
             $entreprise->setUpdated(new \DateTime());

              if ($form->isSubmitted() && $form->isValid()) {
                // $entreprise->uploadFile($this->getParameter('entreprise_images_dir'),$oldFile);
                 // dd($form->getData());

                  $em = $this->getDoctrine()->getManager();
                  $em->persist($entreprise);
                  $em->flush();
                  // dump($service);die();
                  $request->getSession()->getFlashBag()->add('success', 'entreprise.updated.success');

                  return $this->redirectToRoute('admin_entreprise_show', array('id' => $entreprise->getId()));
              }

              return $this->render('entreprise/edit.html.twig', array(
                  'entreprise' => $entreprise,
                  'form' => $form->createView(),
              ));
          }

          /**
           * @Route("/{id}/delete", name="admin_entreprise_delete")
           * @Method("GET")
           */
          public function deleteAction(Request $request, Entreprise  $entreprise)
          {

              if (!$entreprise) {
                  throw $this->createNotFoundException('entreprise not found ' . $id);
              }
              $em = $this->getDoctrine()->getManager();
              $entreprise->setDeleted(true);
            //  dump($entreprise);die();
              $em->flush();
              $request->getSession()->getFlashBag()->add('info', 'entreprise.deleted.success');

              return $this->redirectToRoute('admin_entreprise_index');
          }








}
