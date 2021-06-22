<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FurnitureController extends AbstractController
{
    /**
     * @Route("/furniture", name="furniture")
     */
    public function index(): Response
    {
        return $this->render("furniture/show.html.twig");
    }
}
