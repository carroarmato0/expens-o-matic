<?php


namespace App\Forms;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options) {

    $builder
      ->add('name', TextType::class, [
        'label'      => 'Name',
        'label_attr' => [
          'class'         => 'font-weight-bold',
        ],
        'attr'       => [
          'class'         => 'form-control',
          'autocomplete'  => 'off',
        ],
      ])
      ->add('surname', TextType::class, [
        'label'      => 'Surname',
        'label_attr' => [
          'class'         => 'font-weight-bold',
        ],
        'attr'       => [
          'class'         => 'form-control',
          'autocomplete'  => 'off',
        ],
      ])
      ->add('email', EmailType::class, [
        'label'      => 'Email',
        'label_attr' => [
          'class'         => 'font-weight-bold',
        ],
        'attr'       => [
          'class'         => 'form-control',
          'autocomplete'  => 'off',
        ],
      ])
      ->add('password', PasswordType::class, [
        'label'      => 'Password',
        'label_attr' => [
          'class'         => 'font-weight-bold',
        ],
        'attr'       => [
          'class'         => 'form-control',
          'autocomplete'  => 'off',
        ],
      ])
      ->add("submit", SubmitType::class, [
        'attr'       => [
          'class' => 'btn btn-primary'
        ],
      ])
    ;

  }

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefault('data_class',User::class);
  }

}