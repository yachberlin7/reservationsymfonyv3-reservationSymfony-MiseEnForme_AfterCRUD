<?php

namespace App\Controller;

use App\Entity\Promo;
use App\Entity\Section;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route('/choixSection', name: 'app_user_section')]
    public function choixSection(EntityManagerInterface $entityManager): Response
    {
            $sections = $entityManager->getRepository(Section::class)->findAll();

        return $this->render('accueil/choixSection.html.twig', [
            'controller_name' => 'AccueilController',
            'section'=> $sections
        ]);
    }

    #[Route('/choixUtilisateur/{id}', name: 'app_user_user')]
    public function choixUtilisateur(EntityManagerInterface $entityManager,int $id): Response
    {
            $sections = $entityManager->getRepository(Section::class)->find($id);
            $promo = $entityManager ->getRepository(Promo::class)->findBy(['section'=>$sections]);
            $utilisateur = $entityManager ->getRepository(Utilisateur::class)->findBy(['promo'=>$promo]);
            
        return $this->render('accueil/choixUtilisateur.html.twig', [
            'controller_name' => 'AccueilController',
            'section'=> $sections,
            'promo'=>$promo,
            'utilisateur'=>$utilisateur,
        ]);
    }
}
