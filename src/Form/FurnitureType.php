<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Material;
use App\Entity\Furniture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class FurnitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('material', EntityType::class, [
                'label' => 'Matériau du meuble : ',
                'class' => Material::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Furniture::class,
        ]);
    }
}
