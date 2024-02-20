<?php

namespace App\Controller;

use App\Entity\BillingAdresse;
use App\Form\BillingAdresseType;
use App\Repository\BillingAdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/billing/adresse')]
class BillingAdresseController extends AbstractController
{
    #[Route('/', name: 'app_billing_adresse_index', methods: ['GET'])]
    public function index(BillingAdresseRepository $billingAdresseRepository): Response
    {
        return $this->render('billing_adresse/index.html.twig', [
            'billing_adresses' => $billingAdresseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_billing_adresse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $billingAdresse = new BillingAdresse();
        $form = $this->createForm(BillingAdresseType::class, $billingAdresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($billingAdresse);
            $entityManager->flush();

            return $this->redirectToRoute('app_billing_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('billing_adresse/new.html.twig', [
            'billing_adresse' => $billingAdresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_billing_adresse_show', methods: ['GET'])]
    public function show(BillingAdresse $billingAdresse): Response
    {
        return $this->render('billing_adresse/show.html.twig', [
            'billing_adresse' => $billingAdresse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_billing_adresse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BillingAdresse $billingAdresse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BillingAdresseType::class, $billingAdresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_billing_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('billing_adresse/edit.html.twig', [
            'billing_adresse' => $billingAdresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_billing_adresse_delete', methods: ['POST'])]
    public function delete(Request $request, BillingAdresse $billingAdresse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$billingAdresse->getId(), $request->request->get('_token'))) {
            $entityManager->remove($billingAdresse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_billing_adresse_index', [], Response::HTTP_SEE_OTHER);
    }
}
