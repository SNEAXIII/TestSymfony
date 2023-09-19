<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use phpDocumentor\Reflection\PseudoTypes\List_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/etudiants', name: 'app_etudiant_liste')]
    // Injection de dépendence
    public function list(EtudiantRepository $etudiantRepository): Response
    {
        // Appel du modèle --> va chercher les étudiants
        $etudiants = $etudiantRepository->findAll();

        // Appel de la vue
        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants,
        ]);
    }

    #[Route('/etudiants/{id}', name: 'app_etudiant_fiche', requirements: ['id' => '\d+'])]
    // Injection de dépendence
    public function fiche(EtudiantRepository $etudiantRepository, $id): Response
    {
        // Appel du modèle --> va chercher les étudiants
        $etudiant = $etudiantRepository->find($id);

        // Appel de la vue
        return $this->render('etudiant/ficheEtudiant.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }
    #[Route('/etudiants/mineurs', name: 'app_etudiant_mineurs_liste')]
    // Injection de dépendence
    public function listeMineur(EtudiantRepository $etudiantRepository): Response
    {
        $etudiants = $etudiantRepository->findMineurs();
        // Appel de la vue
        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants,
        ]);
    }

}
