<?php

namespace AppBundle\Form;

use AppBundle\Entity\Sailor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('crew', EntityType::class, [
                    'class' => Sailor::class,
                    'choice_label' => 'describe',
                    'expanded' => false,
                    'multiple' => true,
                ])
        ->add('weapons', CollectionType::class, [
            'entry_type' => WeaponType::class,
            'entry_options' => [
                'label' => false
            ],
            'allow_add' => true,
            'by_reference' => false,
        ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Boat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_boat';
    }


}
