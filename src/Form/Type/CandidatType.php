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
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class CandidatType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'gender.mal' => 1,
                    'gender.female' => 2,
                ),
                'label' => 'candidat.label.gender',
                'expanded' => true,
                'required' => true,
                'data' => 1,
                 'label_attr' => ['class' => 'radio-custom'],
            ))
            ->add('carte_identite', TextType::class,array(
                'label' => 'candidat.label.carte_identite'
                ))
            ->add('first_name', TextType::class,array(
                'label' => 'candidat.label.first_name'
                ))
            ->add('last_name', TextType::class,array(
                'label' => 'candidat.label.last_name'
                ))

              ->add('first_name_ar', TextType::class,array(
                  'label' => 'candidat.label.first_name_ar'
                  ))
              ->add('last_name_ar', TextType::class,array(
                  'label' => 'candidat.label.last_name_ar'
                  ))
                  ->add('address', TextType::class,array(
                      'label' => 'candidat.label.address'
                      ))
                  ->add('date_naissance', DateType::class, [
                        'widget' => 'single_text',
                       'format' => 'yyyy-MM-dd',
                       'label' => 'candidat.label.date_naissance'
                    ])
                  ->add('lieu_naissance', TextType::class,array(
                      'label' => 'candidat.label.lieu_naissance'
                      ))
                  ->add('pays_naissance', TextType::class,array(
                      'label' => 'candidat.label.pays_naissance'
                      ))
              ->add('lieu_naissance_ar', TextType::class,array(
                  'label' => 'candidat.label.lieu_naissance_ar'
                  ))
              ->add('address_ar', TextType::class,array(
                  'label' => 'candidat.label.address_ar'
                  ))

            ->add('email', EmailType::class,array(
                'label' => 'candidat.label.email'
                ))
            ->add('telephone1', TextType::class,array(
                'label' => 'candidat.label.telephone1'
                ))
            ->add('telephone2', TextType::class,array(
                'label' => 'candidat.label.telephone2'
                ))
            ->add('job', TextType::class,array(
                'label' => 'candidat.label.job'
                ))
            ->add('prix', TextType::class,array(
                'label' => 'candidat.label.prix'
                ))
            ->add('is_visite_medicale', CheckboxType::class, [
                  'label'    => 'Frais de la visite médicale 150Dh ?',
                   'label_attr' => ['class' => 'checkbox-custom'],
                  'required' => false,
              ])
              ->add('is_dossier', CheckboxType::class, [
                    'label'    => 'Frais de dossier 50 Dh?',
                       'label_attr' => ['class' => 'checkbox-custom'],
                    'required' => false,
                ])

                ->add('is_succeeded', CheckboxType::class, [
                      'label'    => 'At-il réussi?',
                         'label_attr' => ['class' => 'checkbox-custom'],
                      'required' => false,
                  ])
                  ->add('note', TextType::class,array(
                      'label' => 'candidat.label.note'
                      ))




            ->add('numero_inscription', TextType::class,array(
                'label' => 'candidat.label.numero_inscription'
                ))
            ->add('date_inscription', DateType::class, [
                  'widget' => 'single_text',
                 'format' => 'yyyy-MM-dd',
                   'label' => 'candidat.label.date_inscription'
              ])
              ->add('date_debut_theorique', DateType::class, [
                    'widget' => 'single_text',
                   'format' => 'yyyy-MM-dd',
                     'label' => 'candidat.label.date_debut_theorique'
                ])
              ->add('date_debut_pratique', DateType::class, [
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                      'label' => 'candidat.label.date_debut_pratique'
              ])
              ->add('date_examen_theorique', DateType::class, [
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                      'label' => 'candidat.label.date_examen_theorique'
              ])
              ->add('date_examen_pratique', DateType::class, [
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                      'label' => 'candidat.label.date_examen_pratique'
              ])
              ->add('date2_examen_theorique', DateType::class, [
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                      'label' => 'candidat.label.date2_examen_theorique'
              ])
              ->add('date2_examen_pratique', DateType::class, [
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                      'label' => 'candidat.label.date2_examen_pratique',

                ])
              ->add('type_permis', ChoiceType::class, [
                    'choices'  => [
                      'A' => 'A',
                      'B' => 'B',
                      'C' => 'C',
                      'D' => 'D',
                      'E' => 'E',
                    ],
                    'placeholder' => 'choisir...',
                ])

                ->add('photo', FileType::class, array(
                  'label' => 'candidat.label.photo',
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
            'data_class' => 'App\Entity\Candidat',
            'translation_domain' => 'Candidat',
        ));
    }
}
