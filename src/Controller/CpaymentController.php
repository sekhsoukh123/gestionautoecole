<?php

namespace App\Controller;

use App\Entity\Cpayment;
use App\Entity\Candidat;
use App\Entity\Revenue;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\CpaymentType;

/**
 * Cpayment controller.
 *
 * @Route("/admin/cpayment")
 */
class CpaymentController extends AbstractController
{

  /**
   * @Route("/", name="admin_cpayment_index")s
   */
  public function index(Request $request)
  {

    $repo = $this->getDoctrine()->getManager()->getRepository(Cpayment::class);
      $cpayments = $repo->findBy(array('deleted' => 0));

      return $this->render('cpayment/index.html.twig', array(
          'cpayments' => $cpayments,
      ));
  }


    /**
     * @Route("/new/{candidat_id}", name="admin_cpayment_new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request, $candidat_id)
    {
        $repository = $this->getDoctrine()->getRepository(Candidat::class);

        $candidat = $repository->find($candidat_id);


        if (!$candidat) {
            throw $this->createNotFoundException('candidat not found');
        }
        $cpayment = new Cpayment();
        $cpayment->setCandidat($candidat);
        $cpayment->setDatePaiement(new \DateTime());
        $form = $this->createForm(CpaymentType::class, $cpayment);
      //  $cpayment->setCreator($this->getUser());

        $cpayment->setCreated(new \DateTime());
        $cpayment->setUpdated(new \DateTime());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cpayment);
            $em->flush();
            // $repository = $this->getDoctrine()->getRepository(Cpayment::class);
            //  $total = $repository->getRest($candidat->getId());
            //  $prix = $cpayment->getCandidat()->getPrix();
            // if($total === $prix){
            $revenue = new Revenue();
            $revenue->setMontant($cpayment->getMontant());
            $revenue->setCreated(new \DateTime());
            $revenue->setUpdated(new \DateTime());
            $revenue->setCandidat($cpayment->getCandidat());
             $em = $this->getDoctrine()->getManager();
             $em->persist($revenue);
             $em->flush();
          // }


            $request->getSession()->getFlashBag()->add('success', 'cpayment.added.success');
            return $this->redirectToRoute('admin_candidat_show', array('id' => $candidat->getId()));
        }

        return $this->render('Cpayment/new.html.twig', array(
            'candidat' => $candidat,
            'cpayment' => $cpayment,
            'form'   => $form->createView(),
        ));
    }

   /**
     * @Route("/{id}", name="admin_cpayment_show")
     * @Method("GET")
     */
    public function show(Cpayment $cpayment)
    {

        return $this->render('Cpayment/show.html.twig', array(
            'cpayment' => $cpayment,
        ));
    }

    /**
     * @Route("/{id}/edit/{candidat_id}", name="admin_cpayment_edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Cpayment $cpayment, $candidat_id)
    {
        $repository = $this->getDoctrine()->getRepository(Candidat::class);
        $candidat = $repository->find($candidat_id);
        if (!$candidat) {
            throw $this->createNotFoundException('candidat not found');
        }

        $form = $this->createForm(CpaymentType::class, $cpayment);
        $cpayment->setUpdated(new \DateTime());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cpayment);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'cpayment.updated.success');

            return $this->redirectToRoute('admin_cpayment_show', array('id' => $cpayment->getId()));
        }

        return $this->render('Cpayment/edit.html.twig', array(
            'cpayment' => $cpayment,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name="admin_cpayment_delete")
     * @Method("GET")
     */
    public function delete(Request $request, Cpayment $cpayment)
    {

        if (!$cpayment) {
            throw $this->createNotFoundException('cpayment not found ' . $id);
        }
        $em = $this->getDoctrine()->getManager();
        $cpayment->setDeleted(true);
        $em->flush();
        $request->getSession()->getFlashBag()->add('info', 'cpayment.deleted.success');
        $candidat = $cpayment->getCandidat();
        return $this->redirectToRoute('admin_candidat_show', array('id' => $candidat->getId()));
    }




}
