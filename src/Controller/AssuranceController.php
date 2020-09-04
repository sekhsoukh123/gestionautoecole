<?php

namespace App\Controller;

use App\Entity\Assurance;
use App\Entity\Vehicule;
use App\Entity\Depense;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\AssuranceType;

/**
 * Assurance controller.
 *
 * @Route("/admin/Assurance")
 */
class AssuranceController extends AbstractController
{



    /**
     * @Route("/new/{vehicule_id}", name="admin_assurance_new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request, $vehicule_id)
    {
        $repository = $this->getDoctrine()->getRepository(Vehicule::class);

        $vehicule = $repository->find($vehicule_id);

        if (!$vehicule) {
            throw $this->createNotFoundException('vehicule not found');
        }
        $assurance = new Assurance();
        $assurance->setVehicule($vehicule);
        $assurance->setDateDebut(new \DateTime());
        $form    = $this->createForm(AssuranceType::class, $assurance);
      //  $assurance->setCreator($this->getUser());

      $assurance->setCreated(new \DateTime());
      $assurance->setUpdated(new \DateTime());
      $assurance->setDateFin(new \DateTime('+1 year'));


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($assurance);
            $em->flush();


            // Ajouter depense
            $depense = new Depense();
            $depense->setMontant($assurance->getMontant());
            $depense->setCreated(new \DateTime());
            $depense->setUpdated(new \DateTime());
            $depense->setName('Assurance');
             $em = $this->getDoctrine()->getManager();
             $em->persist($depense);
             $em->flush();




            $request->getSession()->getFlashBag()->add('success', 'assurance.added.success');

            return $this->redirectToRoute('admin_vehicule_show', array('id' => $vehicule->getId()));
        }

        return $this->render('assurance/new.html.twig', array(
            'vehicule' => $vehicule,
            'assurance' => $assurance,
            'form'   => $form->createView(),
        ));
    }



    /**
     * @Route("/{id}/edit/{vehicule_id}", name="admin_assurance_edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Assurance $assurance, $vehicule_id)
    {
        $repository = $this->getDoctrine()->getRepository(Vehicule::class);
        $vehicule = $repository->find($vehicule_id);
        if (!$vehicule) {
            throw $this->createNotFoundException('vehicule not found');
        }

        $form = $this->createForm(AssuranceType::class, $assurance);
        $assurance->setUpdated(new \DateTime());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($assurance);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'assurance.updated.success');

            return $this->redirectToRoute('admin_assurance_show', array('id' => $assurance->getId()));
        }

        return $this->render('assurance/edit.html.twig', array(
            'assurance' => $assurance,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name="admin_assurance_delete")
     * @Method("GET")
     */
    public function delete(Request $request, Assurance $assurance)
    {

        if (!$assurance) {
            throw $this->createNotFoundException('assurance not found ' . $id);
        }
        $em = $this->getDoctrine()->getManager();
        $assurance->setDeleted(true);
        $em->flush();
        $request->getSession()->getFlashBag()->add('info', 'assurance.deleted.success');
        $vehicule = $assurance->getVehicule();
        return $this->redirectToRoute('admin_vehicule_show', array('id' => $vehicule->getId()));
    }




}
