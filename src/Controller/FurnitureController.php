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

    /**
     * @Route("/furniture/{id}/edit", name="furniture_edit")
     */
    public function edit(int $id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Furniture::class);
        $furniture = $repository->find($id);

        $form = $this->createForm(FurnitureType::class, $furniture);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $newFurniture = $form->getData();
            $this->em->persist($newFurniture);
            $this->em->flush();

            return $this->redirectToRoute("furniture", ['id' => $id]);
        }

        return $this->render("furniture/edit.html.twig", [
            "form" => $form->createView(),
            "furniture" => $furniture
        ]);
    }

    /**
     * @Route("/furniture/{id}/delete", name="furniture_delete")
     */
    public function delete(int $id)
    {
        $repository = $this->getDoctrine()->getRepository(Furniture::class);
        $furniture = $repository->find($id);

        $this->em->remove($furniture);
        $this->em->flush();

        return $this->redirectToRoute('home');
    }
}
