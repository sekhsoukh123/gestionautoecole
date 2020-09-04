<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\Entity\Monitor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\MonitorType;


/**
 * Monitor controller.
 *
 * @Route("/admin/monitor")
 */
class MonitorController extends AbstractController
{
    /**
     * @Route("/", name="admin_monitor_index")s
     */
    public function index(Request $request)
    {

      $repo = $this->getDoctrine()->getManager()->getRepository(Monitor::class);
        $monitors = $repo->findBy(array('deleted' => 0));

        return $this->render('monitor/index.html.twig', array(
            'monitors' => $monitors,
        ));
    }


    /**
         * @Route("/new", name="admin_monitor_new")
         * @Method({"GET", "POST"})
         */
        public function newAction(Request $request)
        {
            $monitor = new Monitor();
            $form = $this->createForm(MonitorType::class, $monitor);
            $form->handleRequest($request);
            $monitor->setCreated(new \DateTime());
            $monitor->setUpdated(new \DateTime());

            if ($form->isSubmitted() && $form->isValid()) {
              $monitor->uploadFile($this->getParameter('monitor_images_dir'));

                $em = $this->getDoctrine()->getManager();
                $em->persist($monitor);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'Monitor.added.success');

                return $this->redirectToRoute('admin_monitor_index');
            }

            return $this->render('monitor/new.html.twig', array(
                'monitor' => $monitor,
                'form' => $form->createView(),
            ));
        }



        /**
           * @Route("/{id}", name="admin_monitor_show")
           * @Method("GET")
           */
          public function showAction(Monitor $monitor)
          {


               return $this->render('monitor/show.html.twig', array(
                  'monitor' => $monitor,
              ));
          }

          /**
           * @Route("/{id}/edit", name="admin_monitor_edit")
           * @Method({"GET", "POST"})
           */
          public function editAction(Request $request, Monitor $monitor)
          {
            $form = $this->createForm(MonitorType::class, $monitor);

              $form->handleRequest($request);
              $oldFile = $monitor->getPhoto();
              var_dump($oldFile);
              $monitor->setUpdated(new \DateTime());

              if ($form->isSubmitted() && $form->isValid()) {

                $monitor->uploadFile($this->getParameter('monitor_images_dir'),$oldFile);

                  $em = $this->getDoctrine()->getManager();
                  $em->persist($monitor);
                  $em->flush();
                  // dump($service);die();
                  $request->getSession()->getFlashBag()->add('success', 'Monitor.updated.success');

                  return $this->redirectToRoute('admin_monitor_show', array('id' => $monitor->getId()));
              }

              return $this->render('monitor/edit.html.twig', array(
                  'monitor' => $monitor,
                  'form' => $form->createView(),
              ));
          }

          /**
           * @Route("/{id}/delete", name="admin_monitor_delete")
           * @Method("GET")
           */
          public function deleteAction(Request $request, Monitor $monitor)
          {

              if (!$monitor) {
                  throw $this->createNotFoundException('Monitor not found ' . $id);
              }
              $em = $this->getDoctrine()->getManager();
              $monitor->setDeleted(true);
        //      dump($monitor);die();
              $em->flush();
              $request->getSession()->getFlashBag()->add('info', 'Monitor.deleted.success');

              return $this->redirectToRoute('admin_monitor_index');
          }










}
