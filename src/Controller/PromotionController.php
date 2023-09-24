<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use App\Repository\PromotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    #[Route('/promotion', name: 'app_promotion_index')]
    public function index(PromotionRepository $promotionRepository): Response
    {
        $listePromotion = $promotionRepository -> findAll();
//        $nombreEleves = count($listePromotion);
        return $this -> render('promotion/index.html.twig', [
            'promotions' => $listePromotion
        ]);
    }

    #[Route('/promotion/{id}', name: 'app_promotion_fiche', requirements: ['id' => '\d+'])]
    public function fiche(PromotionRepository $promotionRepository, EtudiantRepository $etudiantRepository, $id): Response
    {
        $Promotion = $promotionRepository -> find($id);
        $ListEtudiant = $etudiantRepository -> findByPromotion($id);
        $nombreEleves = count($ListEtudiant);
        return
            $this -> render('promotion/fiche.html.twig', [
                'promotion' => $Promotion,
                'liste' => $ListEtudiant,
                "nombreEleves" => $nombreEleves
        ]);
    }
}
