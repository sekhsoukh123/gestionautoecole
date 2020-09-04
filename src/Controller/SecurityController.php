<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Entity\Employe;
use App\Form\Type\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController {

    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils) {

          // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();

         // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();

    //     dump($error);

         return $this->render('security/login.html.twig', [
             'last_username' => $lastUsername,
               'error'         => $error,
         ]);

    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout() {


    }


    /**
     * @Route("/registration/{employe_id}", name="admin_user_new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request, $employe_id ,UserPasswordEncoderInterface $passwordEncoder)
    {
        $repository = $this->getDoctrine()->getRepository(Employe::class);

        $employe = $repository->find($employe_id);


        if (!$employe) {
            throw $this->createNotFoundException('employe not found');
        }

        $user = new User();
        $user->setemploye($employe);
        $form = $this->createForm(UserType::class, $user);
      //  $user->setCreator($this->getUser());

        $user->setCreated(new \DateTime());
        $user->setUpdated(new \DateTime());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $password = $passwordEncoder->encodePassword($user,$user->getPassword());
          $user->setRealpassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
   $employe->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($employe);
            $em->flush();




            $request->getSession()->getFlashBag()->add('success', 'User.added.success');
            return $this->redirectToRoute('admin_employe_show', array('id' => $employe->getId()));
        }

        return $this->render('security/register.html.twig', array(
            'employe' => $employe,
            'user' => $user,
            'form'   => $form->createView(),
        ));
    }



}












 ?>
