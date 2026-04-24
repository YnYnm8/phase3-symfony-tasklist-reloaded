<?php

namespace App\Form;

use App\Entity\Folder;
use App\Entity\Priority;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
// use Symfony\Component\Form\Extension\Core\Type\CheckboxType; 
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'label'=>'Title de la tâche',
                'attr'=>['placeholder'=>'Faire les course']
            ])
            // ->add('status')
            // ->add('isPinned',CheckboxType::class,[
            //  'label'=>'Epingler',
            //  'required'=>false
            // ])
            ->add('priority', EntityType::class, [
                'class' => Priority::class,
                'choice_label' => 'name',
                'label' => 'Priorité',
                'placeholder'=>'Selectionez une priorité'
            ])
            ->add('folder', EntityType::class, [
                'class' => Folder::class,
                'choice_label' => 'name',
                'label'=>'Dossier(optionel)',
                'required'=>false,
                'placeholder'=>'Selectionez une dossier'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
