<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\Entity\Vehicule;
use App\Entity\Cpayment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\VehiculeType;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use Dompdf\Options;



/**
 * Vehicule controller.
 *
 * @Route("/admin/vehicule")
 */
class VehiculeController extends AbstractController
{
    /**
     * @Route("/", name="admin_vehicule_index")s
     */
    public function index(Request $request)
    {

      $repo = $this->getDoctrine()->getManager()->getRepository(Vehicule::class);
        $vehicules = $repo->findBy(array('deleted' => 0));

        return $this->render('vehicule/index.html.twig', array(
            'vehicules' => $vehicules,
        ));
    }


    /**
         * @Route("/new", name="admin_vehicule_new")
         * @Method({"GET", "POST"})
         */
        public function newAction(Request $request)
        {
            $vehicule = new Vehicule();
            $form = $this->createForm(VehiculeType::class, $vehicule);
            $form->handleRequest($request);
            $vehicule->setCreated(new \DateTime());
            $vehicule->setUpdated(new \DateTime());

            if ($form->isSubmitted() && $form->isValid()) {
              $vehicule->uploadFile($this->getParameter('vehicule_images_dir'));

                $em = $this->getDoctrine()->getManager();
                $em->persist($vehicule);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'vehicule.added.success');

                return $this->redirectToRoute('admin_vehicule_index');
            }

            return $this->render('vehicule/new.html.twig', array(
                'vehicule' => $vehicule,
                'form' => $form->createView(),
            ));
        }



        /**
           * @Route("/{id}", name="admin_vehicule_show")
           * @Method("GET")
           */
          public function showAction(Vehicule $vehicule)
          {
          // dump($vehicule->getCpayments()); die();
      //    dump(get_class($vehicule->getCpayments()));
//die();
        // $arrayValues = $vehicule->getCpayments()->getValues();
        // dump($arrayValues);
  // /    die();

          // $repository = $this->getDoctrine()->getRepository(Cpayment::class);
          //
          // $total = $repository->getRest($vehicule->getId());
          //dump($rest);
          //die();


               return $this->render('vehicule/show.html.twig', array(
                  'vehicule' => $vehicule,

              ));
          }

          /**
           * @Route("/{id}/edit", name="admin_vehicule_edit")
           * @Method({"GET", "POST"})
           */
          public function editAction(Request $request,Vehicule $vehicule)
          {
            $form = $this->createForm(VehiculeType::class, $vehicule);

              $form->handleRequest($request);
              $oldFile = $vehicule->getPhoto();

              $vehicule->setUpdated(new \DateTime());

              if ($form->isSubmitted() && $form->isValid()) {
                $vehicule->uploadFile($this->getParameter('vehicule_images_dir'),$oldFile);

                  $em = $this->getDoctrine()->getManager();
                  $em->persist($vehicule);
                  $em->flush();
                  // dump($service);die();
                  $request->getSession()->getFlashBag()->add('success', 'vehicule.updated.success');

                  return $this->redirectToRoute('admin_vehicule_show', array('id' => $vehicule->getId()));
              }

              return $this->render('vehicule/edit.html.twig', array(
                  'vehicule' => $vehicule,
                  'form' => $form->createView(),
              ));
          }

          /**
           * @Route("/{id}/delete", name="admin_vehicule_delete")
           * @Method("GET")
           */
          public function deleteAction(Request $request,Vehicule $vehicule)
          {

              if (!$vehicule) {
                  throw $this->createNotFoundException('vehicule not found ' . $id);
              }
              $em = $this->getDoctrine()->getManager();
              $vehicule->setDeleted(true);
          //    dump($vehicule);die();
              $em->flush();
              $request->getSession()->getFlashBag()->add('info', 'vehicule.deleted.success');

              return $this->redirectToRoute('admin_vehicule_index');
          }













}
