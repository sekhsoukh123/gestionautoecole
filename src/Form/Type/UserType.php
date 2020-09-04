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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('username', TextType::class,array(
                'label' => 'user.label.username'
              ))
            ->add('email', TextType::class,array(
                'label' => 'user.label.email'
              ))
            ->add('password', RepeatedType::class, [
                  'type' => PasswordType::class,
                  'invalid_message' => 'The password fields must match.',
                  'options' => ['attr' => ['class' => 'password-field']],
                  'required' => true,
                  'first_options'  => ['label' => 'user.label.password'],
                  'second_options' => ['label' => 'user.label.repeatepassword'],
              ])



            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' =>'App\Entity\User',
            'translation_domain' => 'User',
        ));
    }
}
