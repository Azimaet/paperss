<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PaperssController extends AbstractController
{
    /**
     * @Route("/paperss", name="paperss")
     */
    public function index()
    {
        return $this->render('paperss/index.html.twig', [
            'controller_name' => 'PaperssController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('paperss/home.html.twig');
    }
}
