<?php

namespace App\Controller;

use App\Entity\Furniture;
use App\Form\FurnitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FurnitureController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

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

    /**
     * @Route("/furniture_add", name="furniture_add")
     */
    public function add(Request $request)
    {
        $form = $this->createForm(FurnitureType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $furniture = $form->getData();
            $this->em->persist($furniture);
            $this->em->flush();

            return $this->redirectToRoute("home");
        }
        
        return $this->render("furniture/add.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
