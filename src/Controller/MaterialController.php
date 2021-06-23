<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use App\Repository\MaterialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{
    /**
     * @Route("/material/{id}/show", name="show_material")
     */
    public function index(MaterialRepository $materialRepository, int $id)
    {
        $material = $materialRepository->find($id);

        return $this->render('material/show.html.twig', [
            'material' => $material
        ]);
    }

    /**
     * @Route("/material/new", name="new_material")
     */
    public function new(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(MaterialType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($form->getData());
            $em->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('material/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
