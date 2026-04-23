<?php

namespace App\Form;

use App\Entity\Priority;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PriorityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>'Ajoutez ou supprimez des niveauproprité personnalisés',
                'attr'=>['placeholder'=>'Ex Trés urgent']
            ])
            // ->add('importance',IntegerType::class,[
            //     'class'=>Priority::class,
            //   'label' => 'Importance',
            //     'attr' => ['placeholder' => '1']

            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Priority::class,
        ]);
    }
}
