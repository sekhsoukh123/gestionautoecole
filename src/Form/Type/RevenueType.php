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
use App\Entity\Candidat;

class RevenueType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('candidat', EntityType::class, array(
                      'class' => Candidat::class,
                      'placeholder' => 'Choisir ...',
                      'label' => 'revenue.label.candidat',
                      'attr' => array(
                          'class' => 'select2',
                      ),
                  ))
          ->add('montant', TextType::class,array(
                'label' => 'revenue.label.montant',
                ))


            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' =>'App\Entity\Revenue',
            'translation_domain' => 'Revenue',
        ));
    }
}
