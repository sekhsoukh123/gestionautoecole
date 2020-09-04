<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\Entity\Employe;
use App\Entity\Cpayment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\EmployeType;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use Dompdf\Options;



/**
 * Employe  controller.
 *
 * @Route("/admin/employe")
 */
class EmployeController extends AbstractController
{
    /**
     * @Route("/", name="admin_employe_index")s
     */
    public function index(Request $request)
    {

      $repo = $this->getDoctrine()->getManager()->getRepository(Employe::class);
        $employes = $repo->findBy(array('deleted' => 0));
        return $this->render('employe/index.html.twig', array(
            'employes' => $employes,
        ));
    }


    /**
         * @Route("/new", name="admin_employe_new")
         * @Method({"GET", "POST"})
         */
        public function newAction(Request $request)
        {
            $employe = new Employe ();
            $form = $this->createForm(EmployeType::class, $employe);
            $form->handleRequest($request);
            $employe->setCreated(new \DateTime());
            $employe->setUpdated(new \DateTime());

            if ($form->isSubmitted() && $form->isValid()) {
              $employe->uploadFile($this->getParameter('employe_images_dir'));

                $em = $this->getDoctrine()->getManager();

              //  dd($form['photo']->getData());
                $em->persist($employe);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'employe.added.success');

                return $this->redirectToRoute('admin_employe_index');
            }

            return $this->render('employe/new.html.twig', array(
                'employe' => $employe,
                'form' => $form->createView(),
            ));
        }



        /**
           * @Route("/{id}", name="admin_employe_show")
           * @Method("GET")
           */
          public function showAction(Employe $employe)
          {


               return $this->render('employe/show.html.twig', array(
                  'employe' => $employe,
              ));
          }

          /**
           * @Route("/{id}/edit", name="admin_employe_edit")
           * @Method({"GET", "POST"})
           */
          public function editAction(Request $request, Employe  $employe)
          {
            $form = $this->createForm(EmployeType::class, $employe);

              $form->handleRequest($request);

             $oldFile = $employe->getPhoto();
             $employe->setUpdated(new \DateTime());

              if ($form->isSubmitted() && $form->isValid()) {
                $employe->uploadFile($this->getParameter('employe_images_dir'),$oldFile);
                 // dd($form->getData());

                  $em = $this->getDoctrine()->getManager();
                  $em->persist($employe);
                  $em->flush();
                  // dump($service);die();
                  $request->getSession()->getFlashBag()->add('success', 'employe.updated.success');

                  return $this->redirectToRoute('admin_employe_show', array('id' => $employe->getId()));
              }

              return $this->render('employe/edit.html.twig', array(
                  'employe' => $employe,
                  'form' => $form->createView(),
              ));
          }

          /**
           * @Route("/{id}/delete", name="admin_employe_delete")
           * @Method("GET")
           */
          public function deleteAction(Request $request, Employe  $employe)
          {

              if (!$employe) {
                  throw $this->createNotFoundException('employe not found ' . $id);
              }
              $em = $this->getDoctrine()->getManager();
              $employe->setDeleted(true);
            //  dump($employe);die();
              $em->flush();
              $request->getSession()->getFlashBag()->add('info', 'employe.deleted.success');

              return $this->redirectToRoute('admin_employe_index');
          }








}
