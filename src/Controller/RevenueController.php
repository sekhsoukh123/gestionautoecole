<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\Entity\Revenue;
use App\Entity\Cpayment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\RevenueType;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use Dompdf\Options;



/**
 * Revenue  controller.
 *
 * @Route("/admin/revenue")
 */
class RevenueController extends AbstractController
{
    /**
     * @Route("/", name="admin_revenue_index")s
     */
    public function index(Request $request)
    {

      $repo = $this->getDoctrine()->getManager()->getRepository(Revenue::class);
      $revenues = $repo->findBy(array('deleted' => 0));
        return $this->render('revenue/index.html.twig', array(
            'revenues' => $revenues,
        ));
    }


    /**
         * @Route("/new", name="admin_revenue_new")
         * @Method({"GET", "POST"})
         */
        public function newAction(Request $request)
        {
            $revenue = new Revenue ();
            $form = $this->createForm(RevenueType::class, $revenue);
            $form->handleRequest($request);
            $revenue->setCreated(new \DateTime());
            $revenue->setUpdated(new \DateTime());

            if ($form->isSubmitted() && $form->isValid()) {
              // $revenue->uploadFile($this->getParameter('revenue_images_dir'));

                $em = $this->getDoctrine()->getManager();

              //  dd($form['photo']->getData());
                $em->persist($revenue);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'revenue.added.success');

                return $this->redirectToRoute('admin_revenue_index');
            }

            return $this->render('revenue/new.html.twig', array(
                'revenue' => $revenue,
                'form' => $form->createView(),
            ));
        }



        /**
           * @Route("/{id}", name="admin_revenue_show")
           * @Method("GET")
           */
          public function showAction(Revenue $revenue)
          {


               return $this->render('revenue/show.html.twig', array(
                  'revenue' => $revenue,
              ));
          }

          /**
           * @Route("/{id}/edit", name="admin_revenue_edit")
           * @Method({"GET", "POST"})
           */
          public function editAction(Request $request, Revenue  $revenue)
          {
            $form = $this->createForm(RevenueType::class, $revenue);

              $form->handleRequest($request);

             // $oldFile = $revenue->getPhoto();
             $revenue->setUpdated(new \DateTime());

              if ($form->isSubmitted() && $form->isValid()) {
                // $revenue->uploadFile($this->getParameter('revenue_images_dir'),$oldFile);
                 // dd($form->getData());

                  $em = $this->getDoctrine()->getManager();
                  $em->persist($revenue);
                  $em->flush();
                  // dump($service);die();
                  $request->getSession()->getFlashBag()->add('success', 'revenue.updated.success');

                  return $this->redirectToRoute('admin_revenue_show', array('id' => $revenue->getId()));
              }

              return $this->render('revenue/edit.html.twig', array(
                  'revenue' => $revenue,
                  'form' => $form->createView(),
              ));
          }

          /**
           * @Route("/{id}/delete", name="admin_revenue_delete")
           * @Method("GET")
           */
          public function deleteAction(Request $request, Revenue  $revenue)
          {

              if (!$revenue) {
                  throw $this->createNotFoundException('revenue not found ' . $id);
              }
              $em = $this->getDoctrine()->getManager();
              $revenue->setDeleted(true);
            //  dump($revenue);die();
              $em->flush();
              $request->getSession()->getFlashBag()->add('info', 'revenue.deleted.success');

              return $this->redirectToRoute('admin_revenue_index');
          }








}
