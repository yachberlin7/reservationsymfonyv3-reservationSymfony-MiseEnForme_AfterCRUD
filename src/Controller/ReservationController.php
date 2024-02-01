<?php

namespace App\Controller;

use App\Entity\Promo;
use App\Entity\Section;
use App\Entity\Reservation;
use App\Entity\Utilisateur;
use App\Form\ReservationType;
use App\Repository\PromoRepository;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/reservation')]
class ReservationController extends AbstractController
{
    #[Route('/', name: 'app_reservation_index', methods: ['GET'])]
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }

    #[Route('/section/{id}', name: 'app_reservation_section')]
    public function filtreSection(EntityManagerInterface $entityManager, int $id): Response
    {
        $sections = $entityManager->getRepository(Section::class)->find($id);
        $promo = $entityManager ->getRepository(Promo::class)->findBy(['section'=>$sections]);
        $utilisateur = $entityManager ->getRepository(Utilisateur::class)->findBy(['promo'=>$promo]);
        $reservations = $entityManager ->getRepository(Reservation::class)->findBy(['utilisateur'=>$utilisateur]);
        
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/mesReservations/{id}', name: 'app_reservation_user')]
    public function reservationUser(EntityManagerInterface $entityManager, $id): Response
    {
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($id);
        $reservation = $entityManager->getRepository(Reservation::class)->findBy(['utilisateur'=>$utilisateur]);
        return $this->render('reservation/reservationUser.html.twig', [
                'reservations'=>$reservation,
                'utilisateur'=>$utilisateur,
        ]);
    }

    
    #[Route('/new', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Route('/new/{userId}', name: 'app_reservation_newuser', methods: ['GET', 'POST'])]
    public function newForUser(Request $request, EntityManagerInterface $entityManager, UtilisateurRepository $userRepository, $userId): Response
    {
        $reservation = new Reservation();
    
        // Récupérer l'utilisateur à partir de l'ID
        $user = $userRepository->find($userId);
        if (!$user) {
            throw $this->createNotFoundException('No user found for id '.$userId);
        }
    
        // Préremplir le formulaire avec l'utilisateur
        $reservation->setUtilisateur($user);
    
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('reservation/newForUser.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }
    

/* ----------------------------------------------------------------------------------------------------------------------------------------------------

*/
    #[Route('/{id}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
