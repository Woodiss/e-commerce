<?php

namespace App\Controller;

use App\Entity\DeliveryAdresse;
use App\Form\DeliveryAdresseType;
use App\Repository\DeliveryAdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/delivery/adresse')]
class DeliveryAdresseController extends AbstractController
{
    #[Route('/', name: 'app_delivery_adresse_index', methods: ['GET'])]
    public function index(DeliveryAdresseRepository $deliveryAdresseRepository): Response
    {
        return $this->render('delivery_adresse/index.html.twig', [
            'delivery_adresses' => $deliveryAdresseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_delivery_adresse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $deliveryAdresse = new DeliveryAdresse();
        $form = $this->createForm(DeliveryAdresseType::class, $deliveryAdresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($deliveryAdresse);
            $entityManager->flush();

            return $this->redirectToRoute('app_delivery_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('delivery_adresse/new.html.twig', [
            'delivery_adresse' => $deliveryAdresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_delivery_adresse_show', methods: ['GET'])]
    public function show(DeliveryAdresse $deliveryAdresse): Response
    {
        return $this->render('delivery_adresse/show.html.twig', [
            'delivery_adresse' => $deliveryAdresse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_delivery_adresse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DeliveryAdresse $deliveryAdresse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DeliveryAdresseType::class, $deliveryAdresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_delivery_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('delivery_adresse/edit.html.twig', [
            'delivery_adresse' => $deliveryAdresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_delivery_adresse_delete', methods: ['POST'])]
    public function delete(Request $request, DeliveryAdresse $deliveryAdresse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deliveryAdresse->getId(), $request->request->get('_token'))) {
            $entityManager->remove($deliveryAdresse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_delivery_adresse_index', [], Response::HTTP_SEE_OTHER);
    }
}
