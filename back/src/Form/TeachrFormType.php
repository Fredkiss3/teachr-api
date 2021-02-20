<?php

namespace App\Form;

use App\Entity\Teachr;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeachrFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class, [
                'trim' => true,
            ])
            ->add('description', TextareaType::class, [
                'trim' => true,
            ])
            ->add('formation', TextType::class, [
                'trim' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Teachr::class,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
