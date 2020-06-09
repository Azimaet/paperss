<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaperssController extends AbstractController
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
     * @Route("/", name="home")
     */
    public function home(){
        $user = $this->security->getUser();

        return $this->render('paperss/home.html.twig' , [
            'user' => $user,
        ]);
    }
}
