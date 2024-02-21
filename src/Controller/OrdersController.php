<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Orders;
use App\Form\OrdersType;
use App\Entity\OrdersDetails;
use App\Entity\BillingAdresse;
use App\Entity\DeliveryAdresse;
use App\Repository\VoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/commandes', name: 'orders_')]
class OrdersController extends AbstractController
{
    #[Route('/ajout', name: 'add')]
    public function add(SessionInterface $session, VoyageRepository $voyageRepository, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $session->get('panier', []);
        // dd($panier);

        if ($panier === []) {
            $this->addFlash('message', 'Votre panier est vide');
            return $this->redirectToRoute('app_voyage_index');
        }

        // création de la commande
        $order = new Orders();

        // on remplit la commande
        $user = $this->getUser();

        $firstLetterFirstname = substr($user->getFirstname(), 0, 1);
        $firstLetterLastname = substr($user->getLastname(), 0, 1);
        $currentDate = date('dmy');
        $randomNumber = mt_rand(100, 999);
        $ref = $randomNumber . $firstLetterLastname . $firstLetterFirstname . $currentDate;
        $order->setUser($this->getUser());
        $order->setReference($ref);
        // dd($ref);

        // boucle sur $panier
        foreach ($panier as $item => $quantity) {
            $orderDetails = new OrdersDetails();

            // récup le voyage (find = récup par l'id)
            $voyage = $voyageRepository->find($item);

            $price = $voyage->getPrice();

            // add chaque details
            $orderDetails->setVoyagesId($voyage);
            $orderDetails->setPrice($price);
            $orderDetails->setQuantity($quantity);

            // add de la ref
            $order->addOrdersDetail($orderDetails);
        }

        // persiste + flush
        $em->persist($order);
        $em->flush();

        // suppréssion du panier contenue dans $session
        $session->remove('panier');

        // message a afficher sur la page
        $this->addFlash('message', 'Commande créée avec succès');

        return $this->render('orders/index.html.twig', [
            'controller_name' => 'OrdersController',
        ]);
    }

    #[Route('/new', name: 'app_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // dd($this->getUser());
        $user = $this->getUser();
        if($user == null) {
            return $this->redirectToRoute('app_voyage_index');
        }

        $order = new Orders();

        $deliveryAdresse = new DeliveryAdresse();
        $deliveryAdresse->setUser($user);

        $billingAdresse = new BillingAdresse();
        $billingAdresse->setUser($user);

        $form = $this->createForm(OrdersType::class, $order);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // on remplit la commande

            $firstLetterFirstname = substr($user->getFirstname(), 0, 1);
            $firstLetterLastname = substr($user->getLastname(), 0, 1);
            $currentDate = date('dmy');
            $randomNumber = mt_rand(100, 999);
            $ref = $randomNumber . $firstLetterLastname . $firstLetterFirstname . $currentDate;
            $order->setUser($user);
            $order->setReference($ref);
            // dd($ref);
            
            // Sauvegardez les entités dans la base de données
            // $entityManager->persist($deliveryAdresse);
            // $entityManager->persist($billingAdresse);
            $entityManager->persist($order);
            $entityManager->flush();

            // Redirigez vers une autre page ou effectuez une autre action
            return $this->redirectToRoute('app_voyage_index'); // Remplacez ... par le nom de la route souhaitée
        }

        return $this->render('orders/new.html.twig', [
            'form' => $form->createView(),
            // 'stripe_key' => $_ENV["STRIPE_KEY"],
        ]);
    }
}
