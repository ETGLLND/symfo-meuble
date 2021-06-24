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
     * @Route("/material/{id<\d+>}", name="material", )
     */
    public function index(int $id)
    {
        $repository = $this->getDoctrine()->getRepository(Material::class);
        $material = $repository->find($id);
        return $this->render('material/index.html.twig', [
            'material' => $material,
        ]);
    }

    /**
     * @Route("/material/{id}/edit", name="edit_material")
     */
    public function edit(Request $request, EntityManagerInterface $em, MaterialRepository $materialRepository, int $id)
    {
        $material = $materialRepository->find($id);

        $form = $this->createForm(MaterialType::class, $material);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('material', ['id' => $id]);
        }

        return $this->render("material/edit.html.twig", [
            'material' => $material,
            'form' => $form->createView()
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

    /**
     * @Route("/material/{id}/delete", name="delete_material")
     */
    public function delete(EntityManagerInterface $em, MaterialRepository $materialRepository, int $id)
    {
        $material = $materialRepository->find($id);

        $em->remove($material);
        $em->flush();

        return $this->redirectToRoute('home');
    }
}
