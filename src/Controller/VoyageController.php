<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Form\Voyage1Type;
use App\Repository\VoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class VoyageController extends AbstractController
{
    #[Route('/', name: 'app_voyage_index', methods: ['GET'])]
    public function index(VoyageRepository $voyageRepository): Response
    {
        $voyages = $voyageRepository->findAll();

        // dd($voyage);
        return $this->render('voyage/index.html.twig', [
            'voyages' => $voyages,
        ]);
    }


    #[Route('/{id}', name: 'app_voyage_show', methods: ['GET'])]
    public function show(Voyage $voyage): Response
    {
        // $voyage->getImages()->initialize();
        // dd($voyage->getImages());
        return $this->render('voyage/show.html.twig', [
            'voyage' => $voyage,
        ]);
    }
}
