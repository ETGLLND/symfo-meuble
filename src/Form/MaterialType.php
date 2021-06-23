<?php

namespace App\Form;

use App\Entity\Material;
use App\Entity\Supplier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MaterialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Nom du matériau'
                ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Déscription du matériau'
                ]
            ])
            ->add('supplier', EntityType::class, [
                'label' => 'Fournisseur',
                'class' => Supplier::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Material::class
        ]);
    }
}
