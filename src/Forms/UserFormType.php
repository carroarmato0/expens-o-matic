<?php


namespace App\Forms;

use App\Entity\User;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options) {

    // If the form doesn't container a User already, default role choice to ROLE_USER
    if (empty($builder->getData())) {
      $userRole = "ROLE_USER";
    } else {
      // Extract the role of the user to be set as default choice
      $userRole = $builder->getData()->getRoles()[0];
    }

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
        'empty_data'  => '',
      ])
      ->add("roles", ChoiceType::class, [
          'label'   => 'Role',
          'label_attr' => [
            'class'         => 'font-weight-bold',
          ],
          'choices' => array(
            'Admin'       => 'ROLE_ADMIN',
            'Approver'    => 'ROLE_APPROVER',
            'Accountant'  => 'ROLE_ACCOUNTANT',
            'User'        => 'ROLE_USER',
          ),
          'data' => $userRole,
        ]
      )
      ->add("submit", SubmitType::class, [
        'attr'       => [
          'class' => 'btn btn-primary'
        ],
      ])
    ;

    $builder
      ->get('roles')
      ->addModelTransformer(new CallbackTransformer(
        function ($rolesAsArray) {
          // Transform the Array to a String
          return $rolesAsArray;
        },

        function ($rolesAsString) {
          // Transform the String back to Array
          return array($rolesAsString);
        }
      ))
    ;

  }

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefault('data_class',User::class);
  }

}