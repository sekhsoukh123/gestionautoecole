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

class EmployeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('type', ChoiceType::class, [
              'choices'  => [
                'Directeur' => 'Directeur',
                'Moniteur' => 'Moniteur',
                'Employe' => 'Employé',
                'professeure' => 'professeure',
              ],
              'placeholder' => 'choisir...',
              'label' => 'ٍService'
          ])
        ->add('gender', ChoiceType::class, array(
            'choices' => array(
                'gender.mal' => 1,
                'gender.female' => 2,
            ),
            'expanded' => true,
            'required' => true,
            'label' => 'employe.label.gender',
            'data' => 1,
             'label_attr' => ['class' => 'radio-custom'],
        ))
        ->add('carte_identite', TextType::class,array(
            'label' => 'employe.label.carte_identite'
            ))
        ->add('first_name', TextType::class,array(
            'label' => 'employe.label.first_name'
            ))
        ->add('last_name', TextType::class,array(
            'label' => 'employe.label.last_name'
            ))

        ->add('date_naissance', DateType::class, [
            'widget' => 'single_text',
           'format' => 'yyyy-MM-dd',
           'label' => 'employe.label.date_naissance'
        ])
        ->add('lieu_naissance', TextType::class,array(
              'label' => 'employe.label.lieu_naissance'
              ))
        ->add('pays_naissance', TextType::class,array(
              'label' => 'employe.label.pays_naissance'
              ))
        ->add('address', TextType::class,array(
              'label' => 'employe.label.address'
              ))
        ->add('telephone1', TextType::class,array(
              'label' => 'employe.label.telephone1'
              ))
        ->add('telephone2', TextType::class,array(
              'label' => 'employe.label.telephone2'
              ))
        ->add('email', TextType::class,array(
            'label' => 'employe.label.email'
            ))

        ->add('photo', FileType::class, array(
          'label' => 'employe.label.photo',
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
            'data_class' => 'App\Entity\Employe',
            'translation_domain' => 'Employe',
        ));
    }
}
