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
     * @Route("/category/{id}/edit", name="show_category")
     */
    public function show(CategoryRepository $categoryRepository, int $id)
    {
        $category = $categoryRepository->find($id);

        return $this->render('category/show.html.twig', [
            'category' => $category
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
}
