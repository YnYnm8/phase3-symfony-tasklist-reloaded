<?php

namespace App\Form;

use App\Entity\Folder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FolderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>'Nom de dossier',
                'attr' =>['placeholder','Ex Travil']
            ])

->add('color', ChoiceType::class, [
    'choices' => [
        '#EF4444' => '#EF4444',
        '#F97316' => '#F97316',
        '#F59E0B' => '#F59E0B',
        '#EAB308' => '#EAB308',
        '#84CC16' => '#84CC16',
        '#22C55E' => '#22C55E',
        '#10B981' => '#10B981',
        '#14B8A6' => '#14B8A6',
        '#06B6D4' => '#06B6D4',
        '#0EA5E9' => '#0EA5E9',
        '#3B82F6' => '#3B82F6',
        '#6366F1' => '#6366F1',
        '#8B5CF6' => '#8B5CF6',
        '#A855F7' => '#A855F7',
        '#D946EF' => '#D946EF',
        '#EC4899' => '#EC4899',
    ],
    'expanded' => true,  // ← radioボタンにする
    'multiple' => false, // ← 1つだけ選ぶ
    'label' => 'Couleur',
])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Folder::class,
        ]);
    }
}
