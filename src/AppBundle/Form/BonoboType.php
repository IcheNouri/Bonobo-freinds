<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;


class BonoboType extends AbstractType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder->add("nom", TextType::class);
        $builder->add("age", IntegerType::class);
        $builder->add("famille", TextType::class);
        $builder->add("race", TextType::class);
        $builder->add("nourriture", TextType::class);
        $builder->add('save', SubmitType::class, array('label' => 'Valider'));
    }

    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Bonobo',
            'csrf_protection' => true
        ]);
    }
}