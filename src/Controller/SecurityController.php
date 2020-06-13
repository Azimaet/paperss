<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    /** 
     * @Route("/register", name="security_registration") 
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder ){
        $user = $this->security->getUser();

        if(!is_null($user)){
            throw new \RuntimeException('You are already logged!');
        }

        $newUser = new User();

        $form = $this->createForm(RegistrationType::class, $newUser);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($newUser, $newUser->getPassword());

            $newUser->setPassword($hash);
            
            $manager->persist($newUser);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /** 
     * @Route("/login", name="security_login") 
     */
    public function login(){
        $user = $this->security->getUser();

        if(!is_null($user)){
            throw new \RuntimeException('You are already logged!');
        }

        return $this->render('security/login.html.twig');
    }

    /** 
     * @Route("/logout", name="security_logout") 
     */
    public function logout(){}
}
