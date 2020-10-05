<?php

namespace App\Form\Client;

use App\DTO\Form\ClientAddDTO;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;



class ClientAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName', TextType::class )
            ->add('email',TextType::class )
            ->add('companyNipNumber',TextType::class )
            ->add('clientStatus',TextType::class )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClientAddDTO::class
        ]);
    }
}
