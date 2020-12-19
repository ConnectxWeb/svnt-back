<?php

namespace App\Controller;

use App\Service\AccountMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home_index")
     */
    public function index()
    {
        return $this->render('home.html.twig', []);
    }
}
