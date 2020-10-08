<?php


namespace App\Form\Project;



use App\DTO\Form\ProjectAddDTO;
use App\DTO\Form\ProjectEditDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectEditType extends  AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('domain', TextType::class)
            ->add('client', TextType::class)
            ->add('type', TextType::class)
            ->add('status', CheckboxType::class)
            ->add('minuteTest', CheckboxType::class)
            ->add('dayTest', CheckboxType::class)
            ->add('updateTest', CheckboxType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProjectEditDTO::class
        ]);
    }

}