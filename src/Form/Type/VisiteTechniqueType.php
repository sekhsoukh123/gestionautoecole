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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VisiteTechniqueType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('montant', TextType::class,array(
                'label' => 'visite_technique.label.montant'
                ))

              ->add('date_debut', DateTimeType::class, array(
              'input' => 'datetime',
              'widget' => 'single_text',
              'label' => 'visite_technique.label.date_debut',
              'attr' => array(
                  'class' => 'datetimepicker',
                  'placeholder' => 'Date de paiement',
              ),
          ))

            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' =>'App\Entity\VisiteTechnique',
            'translation_domain' => 'VisiteTechnique',
        ));
    }
}
