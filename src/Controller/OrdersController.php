<?php

namespace App\Controller;

use Stripe;
use Stripe\Charge;
use Stripe\Customer;
use App\Entity\Orders;
use App\Form\OrdersType;
use App\Entity\OrdersDetails;
use App\Entity\BillingAdresse;
use App\Entity\DeliveryAdresse;
use Symfony\Component\Mime\Address;
use App\Repository\OrdersRepository;
use App\Repository\VoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OrdersDetailsRepository;
use App\Repository\BillingAdresseRepository;
use App\Repository\DeliveryAdresseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/commandes', name: 'orders_')]
class OrdersController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(OrdersDetailsRepository $ordersDetailsRepository)
    {
        $user = $this->getUser();
        if ($user == null) {
            $this->addFlash('message', 'Vous devez être connecté pour continuer');
            return $this->redirectToRoute('app_voyage_index');
        }

        $orders = $user->getOrders();


        // $ordersdetails = $ordersDetailsRepository->findBy(['orders' => 18]);
        // dd($ordersdetails);

        return $this->render('orders/index.html.twig', [
            'orders' => $orders,
        ]);
    }


    #[Route('/new', name: 'app_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session, VoyageRepository $voyageRepository): Response
    {
        // dd($this->getUser());
        $user = $this->getUser();
        if ($user == null) {
            $this->addFlash('message', 'Vous devez être connecté pour continuer');
            return $this->redirectToRoute('app_voyage_index');
        }

        $panier = $session->get('panier', []);
        // dd($panier);
        if ($panier === []) {
            $this->addFlash('message', 'Votre panier est vide');
            return $this->redirectToRoute('app_voyage_index');
        }

        $billingAdresses = $user->getBillingAdresses();
        $deliveryAdresses = $user->getDeliveryAdresses();
        // dd($billingAdresses);

        $order = new Orders();
        $form = $this->createForm(OrdersType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($request->request->get('stripeToken'));
            Stripe\Stripe::setApiKey($_ENV["STRIPE_SECRET"]);
            Stripe\Charge::create([
                "amount" => 5 * 100,
                "currency" => "eur",
                "source" => $request->request->get('stripeToken'),
                "description" => "Binaryboxtuts Payment Test"
            ]);

            // dd($deliveryOption);

            // boucle sur $panier
            $total = 0;
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

                $total += $price * $quantity;
            }
            // dd($total);

            $deliveryOption = $request->request->get('delivery_option');
            $billingOption = $request->request->get('billing_option');

            // Traitement de l'adresse de livraison
            if ($deliveryOption === 'existing') {
                $deliveryAddressId = $request->request->get('delivery_select');
                $deliveryAddress = $entityManager->getRepository(DeliveryAdresse::class)->find($deliveryAddressId);
                $order->setDeliveryAdresse($deliveryAddress);
            } else {
                $deliveryAddress = new DeliveryAdresse();
                $deliveryAddress->setUser($user);

                // dd($order->getDeliveryAdresse());
                $orderDelivery = $order->getDeliveryAdresse();
                $deliveryAddress->setCity($orderDelivery->getCity());
                $deliveryAddress->setPostalCode($orderDelivery->getPostalCode());
                $deliveryAddress->setFullName($orderDelivery->getFullName());
                $deliveryAddress->setPhoneNumber($orderDelivery->getPhoneNumber());
                $deliveryAddress->setAdresse($orderDelivery->getAdresse());
                $order->setDeliveryAdresse($deliveryAddress);

                $order->getDeliveryAdresse()->setUser($user);
            }

            // Traitement de l'adresse de facturation (similaire à la livraison)
            if ($billingOption === 'existing') {
                $billingAddressId = $request->request->get('billing_select');
                $billingAddress = $entityManager->getRepository(BillingAdresse::class)->find($billingAddressId);
                $order->setBillingAdresse($billingAddress);
            } else {
                $billingAddress = new BillingAdresse();
                $billingAddress->setUser($user);

                $orderBilling = $order->getDeliveryAdresse();
                $billingAddress->setCity($orderBilling->getCity());
                $billingAddress->setPostalCode($orderBilling->getPostalCode());
                $billingAddress->setFullName($orderBilling->getFullName());
                $billingAddress->setPhoneNumber($orderBilling->getPhoneNumber());
                $billingAddress->setAdresse($orderBilling->getAdresse());

                $order->setBillingAdresse($billingAddress);

                $order->getBillingAdresse()->setUser($user);
            }

            // set de user pour getBillingAdresse & getDeliveryAdresse

            // création de la réf
            $firstLetterFirstname = substr($user->getFirstname(), 0, 1);
            $firstLetterLastname = substr($user->getLastname(), 0, 1);
            $currentDate = date('dmy');
            $randomNumber = mt_rand(100, 999);
            $ref = $randomNumber . $firstLetterLastname . $firstLetterFirstname . $currentDate;
            $order->setUser($user);
            $order->setReference($ref);
            $order->setTotal($total);


            // Sauvegardez les entités dans la base de données
            $entityManager->persist($order);
            $entityManager->flush();

            // supp le panier avant de quitter
            $session->remove('panier');

            // Redirigez vers une autre page
            return $this->redirectToRoute('app_voyage_index');
        }

        return $this->render('orders/new.html.twig', [
            'stripe_key' => $_ENV["STRIPE_KEY"],
            'form' => $form->createView(),
            'billings' => $billingAdresses,
            'deliverys' => $deliveryAdresses
            // 'stripe_key' => $_ENV["STRIPE_KEY"],
        ]);
    }
}
