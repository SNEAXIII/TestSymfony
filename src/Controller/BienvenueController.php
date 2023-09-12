<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienvenueController extends AbstractController
{
    #[Route('/bienvenue', name: 'app_bienvenue')]
    public function index(): Response
    {
    //  donnée simulée
        $prenom = "Pierre";
        return $this->render('bienvenue/index.html.twig',[
            "prenom" => "pierre"
        ]);

    }
}
