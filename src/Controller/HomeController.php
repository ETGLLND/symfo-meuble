<?php

namespace App\Controller;

use App\Repository\FurnitureRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(FurnitureRepository $furnitureRepository)
    {
        $furnitures = $furnitureRepository->findAll();

        return $this->render('home/index.html.twig', [
            'furnitures' => $furnitures
        ]);
    }
}
