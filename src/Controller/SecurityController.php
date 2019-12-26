<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/register", name="register")
     */

    public function show_register_form()
    {
        return $this->render('security/register.html.twig', [
            'form' => $this->get_registerform()->createView()
        ]);
    }

    private function get_registerform()
    {
        return $this->createFormBuilder()
        ->add('email', EmailType::class)
        ->add('password', PasswordType::class, [])
        ->add('display_name', TextType::class,[])
        ->add('save', SubmitType::class)
        ->getForm();

    }

    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form =  $this->get_registerform();
        $form->handleRequest($request);


    }

}
