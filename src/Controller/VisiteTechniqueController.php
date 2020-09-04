<?php

namespace App\Controller;

use App\Entity\VisiteTechnique;
use App\Entity\Vehicule;
use App\Entity\Depense;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\VisiteTechniqueType;

/**
 * VisiteTechnique controller.
 *
 * @Route("/admin/VisiteTechnique")
 */
class VisiteTechniqueController extends AbstractController
{



    /**
     * @Route("/new/{vehicule_id}", name="admin_visite_technique_new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request, $vehicule_id)
    {
        $repository = $this->getDoctrine()->getRepository(Vehicule::class);

        $vehicule = $repository->find($vehicule_id);

        if (!$vehicule) {
            throw $this->createNotFoundException('vehicule not found');
        }
        $visite_technique = new VisiteTechnique();
        $visite_technique->setVehicule($vehicule);
        $visite_technique->setDateDebut(new \DateTime());
        $form    = $this->createForm(VisiteTechniqueType::class, $visite_technique);
      //  $visite_technique->setCreator($this->getUser());

      $visite_technique->setCreated(new \DateTime());
      $visite_technique->setUpdated(new \DateTime());
      $visite_technique ->setDateFin( new DateTime('+1 year'));


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($visite_technique);
            $em->flush();

            // Ajouter depense
            $depense = new Depense();
            $depense->setMontant($visite_technique->getMontant());
            $depense->setCreated(new \DateTime());
            $depense->setUpdated(new \DateTime());
            $depense->setName('Visite Technique');
             $em = $this->getDoctrine()->getManager();
             $em->persist($depense);
             $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'visite_technique.added.success');

            return $this->redirectToRoute('admin_vehicule_show', array('id' => $vehicule->getId()));
        }

        return $this->render('visite_technique/new.html.twig', array(
            'vehicule' => $vehicule,
            'visite_technique' => $visite_technique,
            'form'   => $form->createView(),
        ));
    }



    /**
     * @Route("/{id}/edit/{vehicule_id}", name="admin_visite_technique_edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, VisiteTechnique $visite_technique, $vehicule_id)
    {
        $repository = $this->getDoctrine()->getRepository(Vehicule::class);
        $vehicule = $repository->find($vehicule_id);
        if (!$vehicule) {
            throw $this->createNotFoundException('vehicule not found');
        }

        $form = $this->createForm(VisiteTechniqueType::class, $visite_technique);
        $visite_technique->setUpdated(new \DateTime());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($visite_technique);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'visite_technique.updated.success');

            return $this->redirectToRoute('admin_visite_technique_show', array('id' => $visite_technique->getId()));
        }

        return $this->render('visite_technique/edit.html.twig', array(
            'visite_technique' => $visite_technique,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name="admin_visite_technique_delete")
     * @Method("GET")
     */
    public function delete(Request $request, VisiteTechnique $visite_technique)
    {

        if (!$visite_technique) {
            throw $this->createNotFoundException('visite_technique not found ' . $id);
        }
        $em = $this->getDoctrine()->getManager();
        $visite_technique->setDeleted(true);
        $em->flush();
        $request->getSession()->getFlashBag()->add('info', 'visite_technique.deleted.success');
        $vehicule = $visite_technique->getVehicule();
        return $this->redirectToRoute('admin_vehicule_show', array('id' => $vehicule->getId()));
    }




}
