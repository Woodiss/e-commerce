<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\User;
use App\Entity\OrdersDetails;
use App\Repository\VoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
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
}
