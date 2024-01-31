<?php
namespace App\Controller;


use App\Entity\Voyage;
use App\Repository\VoyageRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cart', name: 'cart_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, VoyageRepository $voyageRepository)
    {
        $panier = $session->get('panier', []);
        // dd($panier);
        // créer les varibles
        $data = [];
        $total = 0;

        // dd($panier);

        foreach($panier as $id => $quantity){
            $voyage = $voyageRepository->find($id);

            if($voyage){
                $data[] = [
                    'voyage' => $voyage,
                    'quantity' => $quantity
                    
                ];
            }
            // $total += $voyage->getPrice() * $quantity;
        }
        // dd($data);
        return $this->render('cart/index.html.twig', [
            'data' => $data,
            'total' => $total
        ]);
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(Voyage $voyage, SessionInterface $session)
    {
        // récup id voyage
        $id = $voyage->getId();

        // récup panier si y'en n'as un (si y'en n'as pas je le créer)
        $panier = $session->get('panier', []);

        // add du voyage select dans le panier si y'en n'as pas sinon ou add +1
        if(empty($panier[$id])){
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        }

        $session->set('panier', $panier);

        // dd($session);
        // headerlocation vers page panier
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Voyage $voyage, SessionInterface $session)
    {
        // récup id voyage
        $id = $voyage->getId();

        // récup panier si y'en n'as un (si y'en n'as pas je le créer)
        $panier = $session->get('panier', []);

        // remove du voyage select dans le panier si y'en n'as qu'une, sinon - 1
        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);

        // dd($session);
        // headerlocation vers page panier
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Voyage $voyage, SessionInterface $session)
    {
        // récup id voyage
        $id = $voyage->getId();

        // récup panier si y'en n'as un (si y'en n'as pas je le créer)
        $panier = $session->get('panier', []);

        // remove du voyage select dans le panier
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        // dd($session);
        // headerlocation vers page panier
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/empty', name: 'empty')]
    public function empty(SessionInterface $session)
    {
        $session->remove('panier');
        return $this->redirectToRoute('cart_index');
    }
}