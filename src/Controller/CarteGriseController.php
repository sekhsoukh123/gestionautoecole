<?php

namespace App\Controller;

use App\Entity\CarteGrise;
use App\Entity\Vehicule;
use App\Entity\Depense;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\CarteGriseType;

/**
 * CarteGrise controller.
 *
 * @Route("/admin/CarteGrise")
 */
class CarteGriseController extends AbstractController
{



    /**
     * @Route("/new/{vehicule_id}", name="admin_carte_grise_new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request, $vehicule_id)
    {
        $repository = $this->getDoctrine()->getRepository(Vehicule::class);

        $vehicule = $repository->find($vehicule_id);

        if (!$vehicule) {
            throw $this->createNotFoundException('vehicule not found');
        }
        $carte_grise = new CarteGrise();
        $carte_grise->setVehicule($vehicule);
        $carte_grise->setDateDebut(new \DateTime());
        $form    = $this->createForm(CarteGriseType::class, $carte_grise);
      //  $carte_grise->setCreator($this->getUser());

      $carte_grise->setCreated(new \DateTime());
      $carte_grise->setUpdated(new \DateTime());
      $carte_grise ->setDateFin( new DateTime('+1 year'));


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carte_grise);
            $em->flush();

            // Ajouter depense
            $depense = new Depense();
            $depense->setMontant($carte_grise->getMontant());
            $depense->setCreated(new \DateTime());
            $depense->setUpdated(new \DateTime());
            $depense->setName('Carte Grise');
             $em = $this->getDoctrine()->getManager();
             $em->persist($depense);
             $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'carte_grise.added.success');

            return $this->redirectToRoute('admin_vehicule_show', array('id' => $vehicule->getId()));
        }

        return $this->render('carte_grise/new.html.twig', array(
            'vehicule' => $vehicule,
            'carte_grise' => $carte_grise,
            'form'   => $form->createView(),
        ));
    }



    /**
     * @Route("/{id}/edit/{vehicule_id}", name="admin_carte_grise_edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, CarteGrise $carte_grise, $vehicule_id)
    {
        $repository = $this->getDoctrine()->getRepository(Vehicule::class);
        $vehicule = $repository->find($vehicule_id);
        if (!$vehicule) {
            throw $this->createNotFoundException('vehicule not found');
        }

        $form = $this->createForm(CarteGriseType::class, $carte_grise);
        $carte_grise->setUpdated(new \DateTime());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carte_grise);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'carte_grise.updated.success');

            return $this->redirectToRoute('admin_carte_grise_show', array('id' => $carte_grise->getId()));
        }

        return $this->render('carte_grise/edit.html.twig', array(
            'carte_grise' => $carte_grise,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name="admin_carte_grise_delete")
     * @Method("GET")
     */
    public function delete(Request $request, CarteGrise $carte_grise)
    {

        if (!$carte_grise) {
            throw $this->createNotFoundException('carte_grise not found ' . $id);
        }
        $em = $this->getDoctrine()->getManager();
        $carte_grise->setDeleted(true);
        $em->flush();
        $request->getSession()->getFlashBag()->add('info', 'carte_grise.deleted.success');
        $vehicule = $carte_grise->getVehicule();
        return $this->redirectToRoute('admin_vehicule_show', array('id' => $vehicule->getId()));
    }




}
