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

class EntrepriseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name', TextType::class,array(
                'label' => 'entreprise.label.name'
                ))
            ->add('directeur_name', TextType::class,array(
                'label' => 'entreprise.label.directeur_name'
                ))
            ->add('num_licence', TextType::class,array(
                'label' => 'entreprise.label.num_licence'
                ))
            ->add('date_licence', DateType::class, [
                  'widget' => 'single_text',
                 'format' => 'yyyy-MM-dd',
                 'label' => 'entreprise.label.date_licence'
              ])
              ->add('num_fiscal_pro', TextType::class,array(
                  'label' => 'entreprise.label.num_fiscal_pro'
                  ))

              ->add('num_enregistrement_commercial', TextType::class,array(
                  'label' => 'entreprise.label.num_enregistrement_commercial'
                  ))
              ->add('ville_commercial', TextType::class,array(
                  'label' => 'entreprise.label.ville_commercial'
                  ))
              ->add('ice', TextType::class,array(
                  'label' => 'entreprise.label.ice'
                  ))
              ->add('telephone1', TextType::class,array(
                  'label' => 'entreprise.label.telephone1'
                  ))
              ->add('fax', TextType::class,array(
                  'label' => 'entreprise.label.fax'
                  ))
              ->add('email', TextType::class,array(
                  'label' => 'entreprise.label.email'
                  ))
              ->add('ville', TextType::class,array(
                  'label' => 'entreprise.label.ville'
                  ))
              ->add('pays', TextType::class,array(
                  'label' => 'entreprise.label.pays'
                  ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Entreprise',
            'translation_domain' => 'Entreprise',
        ));
    }
}
