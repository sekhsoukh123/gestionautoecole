<?php

namespace App\Form\Type;

use AppBundle\Form\DocumentHandlerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VehiculeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('immatriculation', TextType::class,array(
                'label' => 'vehicule.label.immatriculation'
                ))
            ->add('marque', TextType::class,array(
                'label' => 'vehicule.label.marque'
                ))

            ->add('model', TextType::class,array(
                'label' => 'vehicule.label.model'
                ))
                ->add('photo', FileType::class, array(
                  'label' => 'vehicule.label.photo',
                  //'mapped'=>false;
                  'required' => false,
                  'data_class' => null,
                ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
              'data_class' => 'App\Entity\Vehicule',
            'translation_domain' => 'Vehicule',
        ));
    }
}
