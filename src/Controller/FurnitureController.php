<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Furniture;
use App\Entity\Material;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    /**
     * @Route("/furniture_add", name="furniture_add")
     */
    public function add()
    {
        $form = $this->createFormBuilder(null, ['data_class' => Furniture::class])
            ->add('name', TextType::class, [
                'label' => 'Nom du meuble : '
            ])
            ->add('craft_number', IntegerType::class, [
                'label' => 'Nombre de fois fabriqué : '
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie du meuble : ',
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('materials', EntityType::class, [
                'label' => 'Matériau du meuble : ',
                'class' => Material::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->getForm();
        
        return $this->render("furniture/add.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
