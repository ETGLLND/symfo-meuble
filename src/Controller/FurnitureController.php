<?php

namespace App\Controller;

use App\Entity\Furniture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FurnitureController extends AbstractController
{
    /**
     * @Route("/furniture/{id}", name="furniture")
     */
    public function index(int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Furniture::class);
        $furniture = $repository->find($id);
        return $this->render("furniture/index.html.twig", [
            "furniture" => $furniture
        ]);
    }
}
