<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="show_category")
     */
    public function show(CategoryRepository $categoryRepository, int $id)
    {
        $category = $categoryRepository->find($id);

        return $this->render('category/show.html.twig', [
            'category' => $category
        ]);
    }
}
