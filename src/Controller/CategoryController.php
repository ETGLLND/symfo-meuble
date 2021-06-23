<?php

namespace App\Controller;

use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}/edit", name="edit_category")
     */
    public function edit(Request $request, EntityManagerInterface $em, CategoryRepository $categoryRepository, int $id)
    {
        $category = $categoryRepository->find($id);

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/category/new", name="new_category")
     */
    public function new(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CategoryType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($form->getData());
            $em->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('category/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/category/{id}/delete", name="delete_category")
     */
    public function delete(Request $request, EntityManagerInterface $em, CategoryRepository $categoryRepository, int $id)
    {
        $category = $categoryRepository->find($id);

        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('home');
    }
}
