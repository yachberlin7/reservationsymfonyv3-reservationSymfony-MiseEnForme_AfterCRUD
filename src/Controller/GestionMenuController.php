<?php

namespace App\Controller;

use App\Entity\RepasMenu;
use App\Form\RepasMenuType;
use App\Repository\RepasMenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gestion/menu')]
class GestionMenuController extends AbstractController
{
    #[Route('/', name: 'app_gestion_menu_index', methods: ['GET'])]
    public function index(RepasMenuRepository $repasMenuRepository): Response
    {
        return $this->render('gestion_menu/index.html.twig', [
            'repas_menus' => $repasMenuRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_gestion_menu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $repasMenu = new RepasMenu();
        $form = $this->createForm(RepasMenuType::class, $repasMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($repasMenu);
            $entityManager->flush();

            return $this->redirectToRoute('app_gestion_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gestion_menu/new.html.twig', [
            'repas_menu' => $repasMenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gestion_menu_show', methods: ['GET'])]
    public function show(RepasMenu $repasMenu): Response
    {
        return $this->render('gestion_menu/show.html.twig', [
            'repas_menu' => $repasMenu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gestion_menu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RepasMenu $repasMenu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RepasMenuType::class, $repasMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_gestion_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gestion_menu/edit.html.twig', [
            'repas_menu' => $repasMenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gestion_menu_delete', methods: ['POST'])]
    public function delete(Request $request, RepasMenu $repasMenu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$repasMenu->getId(), $request->request->get('_token'))) {
            $entityManager->remove($repasMenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_gestion_menu_index', [], Response::HTTP_SEE_OTHER);
    }
}
