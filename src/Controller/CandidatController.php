<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\Entity\Candidat;
use App\Entity\Cpayment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\CandidatType;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use Dompdf\Options;



/**
 * Candidat controller.
 *
 * @Route("/admin/candidat")
 */
class CandidatController extends AbstractController
{
    /**
     * @Route("/", name="admin_candidat_index")s
     */
    public function index(Request $request)
    {

      $repo = $this->getDoctrine()->getManager()->getRepository(Candidat::class);
        $candidats = $repo->findBy(array('deleted' => 0));

        return $this->render('Candidat/index.html.twig', array(
            'candidats' => $candidats,
        ));
    }


    /**
         * @Route("/new", name="admin_candidat_new")
         * @Method({"GET", "POST"})
         */
        public function newAction(Request $request)
        {
            $candidat = new Candidat();
            $form = $this->createForm(CandidatType::class, $candidat);
            $form->handleRequest($request);
            $candidat->setCreated(new \DateTime());
            $candidat->setUpdated(new \DateTime());

            if ($form->isSubmitted() && $form->isValid()) {
                $candidat->uploadFile($this->getParameter('candidat_images_dir'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($candidat);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'Candidat.added.success');

                return $this->redirectToRoute('admin_candidat_index');
            }

            return $this->render('candidat/new.html.twig', array(
                'candidat' => $candidat,
                'form' => $form->createView(),
            ));
        }



        /**
           * @Route("/{id}", name="admin_candidat_show")
           * @Method("GET")
           */
          public function showAction(Candidat $candidat)
          {

          $repository = $this->getDoctrine()->getRepository(Cpayment::class);

                $total = $repository->getRest($candidat->getId());

                     return $this->render('Candidat/show.html.twig', array(
                        'candidat' => $candidat,
                        'total'=>$total,
              ));
          }

          /**
           * @Route("/{id}/edit", name="admin_candidat_edit")
           * @Method({"GET", "POST"})
           */
          public function editAction(Request $request, Candidat $candidat)
          {
            $form = $this->createForm(CandidatType::class, $candidat);
              $form->handleRequest($request);
              $oldFile = $candidat->getPhoto();
              $candidat->setUpdated(new \DateTime());
              if ($form->isSubmitted() && $form->isValid()) {
                $candidat->uploadFile($this->getParameter('candidat_images_dir'),$oldFile);
                 // dd($form->getData());

                  $em = $this->getDoctrine()->getManager();
                  $em->persist($candidat);
                  $em->flush();
                  $request->getSession()->getFlashBag()->add('success', 'candidat.updated.success');
                  return $this->redirectToRoute('admin_candidat_show', array('id' => $candidat->getId()));
              }


              return $this->render('Candidat/edit.html.twig', array(
                  'candidat' => $candidat,
                  'form' => $form->createView(),
              ));
          }

          /**
           * @Route("/{id}/delete", name="admin_candidat_delete")
           * @Method("GET")
           */
          public function deleteAction(Request $request, Candidat $candidat)
          {

              if (!$candidat) {
                  throw $this->createNotFoundException('Candidat not found ' . $id);
              }
              $em = $this->getDoctrine()->getManager();
              $candidat->setDeleted(true);
              // dump($candidat);die();
              $em->flush();
              $request->getSession()->getFlashBag()->add('info', 'candidat.deleted.success');

              return $this->redirectToRoute('admin_candidat_index');
          }

          /**
           * @Route("/pdf/{id}", name="admin_candidat_pdf")
           * @Method("GET")
           */
          public function pdfAction(Candidat $candidat)
          {


            // // Configure Dompdf according to your needs
            //        $pdfOptions = new Options();
            //        $pdfOptions->set('defaultFont', 'Arial');
            //
            //        // Instantiate Dompdf with our options
            //        $dompdf = new Dompdf($pdfOptions);
            //
            //        // Retrieve the HTML generated in our twig file
            //        $html = $this->renderView('candidat/pdf.html.twig', [
            //            'candidat' => $candidat
            //        ]);
            //
            //        // Load HTML to Dompdf
            //        $dompdf->loadHtml($html);
            //
            //        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
            //        $dompdf->setPaper('A4', 'portrait');
            //
            //        // Render the HTML as PDF
            //        $dompdf->render();
            //
            //        // Store PDF Binary Data
            //        $output = $dompdf->output();
            //
            //        // In this case, we want to write the file in the public directory
            //       $publicDirectory = $this->getParameter('kernel.project_dir') . '/public';
            //        // e.g /var/www/project/public/mypdf.pdf
            //        $pdfFilepath =  $publicDirectory . '/contrat'.$candidat->getId().'.pdf';
            //
            //        // Write file to the desired path
            //        file_put_contents($pdfFilepath, $output);
            //
            //        // Send some text response
            //        return new Response("The PDF file has been succesfully generated !");
          $datenow = new \DateTime();

            return $this->render('Candidat/pdf.html.twig', array(
               'candidat' => $candidat,
               'datenow' => $datenow,

           ));
            //
            // $html = $this->renderView('candidat/pdf.html.twig', [
            //           'candidat' => $candidat
            //       ]);
            //        $dompdf = new Dompdf();
          	// 	//  On  ajoute le texte à afficher
          	// 	$dompdf->loadHtml($html);
          	// 	// On fait générer le pdf  à Dompdf ...
          	// 	$dompdf->render();
          	// 	//  et on l'affiche dans un   objet Response
          	// 	return new Response ($dompdf->stream());
          }


          /**
          * @Route("/contrat/{id}", name="admin_candidat_contrat")
          * @Method("GET")
          */
          public function contratAction(Candidat $candidat)
          {


          $datenow = new \DateTime();

          return $this->render('Candidat/imprime.html.twig', array(
          'candidat' => $candidat,
          'datenow' => $datenow,

          ));

          }











          }
