<?php

namespace App\Controller;

use App\Entity\Vignette;
use App\Entity\Vehicule;
use App\Entity\Depense;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\VignetteType;

/**
 * Vignette controller.
 *
 * @Route("/admin/vignette")
 */
class VignetteController extends AbstractController
{



    /**
     * @Route("/new/{vehicule_id}", name="admin_vignette_new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request, $vehicule_id)
    {
        $repository = $this->getDoctrine()->getRepository(Vehicule::class);

        $vehicule = $repository->find($vehicule_id);

        if (!$vehicule) {
            throw $this->createNotFoundException('vehicule not found');
        }
        $vignette = new Vignette();
        $vignette->setVehicule($vehicule);
        $vignette->setDateDebut(new \DateTime());
        $form    = $this->createForm(VignetteType::class, $vignette);
      //  $vignette->setCreator($this->getUser());

      $vignette->setCreated(new \DateTime());
      $vignette->setUpdated(new \DateTime());
      $vignette ->setDateFin( new DateTime('+1 year'));


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vignette);
            $em->flush();

            // Ajouter depense
            $depense = new Depense();
            $depense->setMontant($vignette->getMontant());
            $depense->setCreated(new \DateTime());
            $depense->setUpdated(new \DateTime());
            $depense->setName('Vignette');
             $em = $this->getDoctrine()->getManager();
             $em->persist($depense);
             $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'vignette.added.success');

            return $this->redirectToRoute('admin_vehicule_show', array('id' => $vehicule->getId()));
        }

        return $this->render('vignette/new.html.twig', array(
            'vehicule' => $vehicule,
            'vignette' => $vignette,
            'form'   => $form->createView(),
        ));
    }



    /**
     * @Route("/{id}/edit/{vehicule_id}", name="admin_vignette_edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Vignette $vignette, $vehicule_id)
    {
        $repository = $this->getDoctrine()->getRepository(Vehicule::class);
        $vehicule = $repository->find($vehicule_id);
        if (!$vehicule) {
            throw $this->createNotFoundException('vehicule not found');
        }

        $form = $this->createForm(VignetteType::class, $vignette);
        $vignette->setUpdated(new \DateTime());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vignette);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'vignette.updated.success');

            return $this->redirectToRoute('admin_vignette_show', array('id' => $vignette->getId()));
        }

        return $this->render('vignette/edit.html.twig', array(
            'vignette' => $vignette,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name="admin_vignette_delete")
     * @Method("GET")
     */
    public function delete(Request $request, Vignette $vignette)
    {

        if (!$vignette) {
            throw $this->createNotFoundException('vignette not found ' . $id);
        }
        $em = $this->getDoctrine()->getManager();
        $vignette->setDeleted(true);
        $em->flush();
        $request->getSession()->getFlashBag()->add('info', 'vignette.deleted.success');
        $vehicule = $vignette->getVehicule();
        return $this->redirectToRoute('admin_vehicule_show', array('id' => $vehicule->getId()));
    }




}
