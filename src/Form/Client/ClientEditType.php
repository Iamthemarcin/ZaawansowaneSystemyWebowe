<?php


namespace App\Form\Client;


use App\DTO\Form\ClientEditDTO;
use http\Client;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\DTO\Form\ClientAddDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class ClientEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName', TextType::class)
            ->add('companyNipNumber', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClientEditDTO::class

        ]);
    }
}
