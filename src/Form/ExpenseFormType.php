<?php

namespace App\Form;

use App\Entity\Expense;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Date;

class ExpenseFormType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add("name", TextType::class, [
        'label'      => 'Name',
        'label_attr' => [
          'class'         => 'font-weight-bold',
        ],
        'attr'       => [
          'class'         => 'form-control',
          'autocomplete'  => 'off',
        ],
      ])
      ->add("description", TextType::class, [
        'label'      => 'Description',
        'label_attr' => [
          'class'         => 'font-weight-bold',
        ],
        'attr'       => [
          'class'         => 'form-control',
          'autocomplete'  => 'off',
        ],
      ])
      ->add("amount", NumberType::class, [
        'label'      => 'Amount',
        'scale'      => 2,
        'label_attr' => [
          'class'         => 'font-weight-bold',
        ],
        'attr'       => [
          'class'         => 'form-control',
          'autocomplete'  => 'off',
        ],
      ])
      ->add("date", DateType::class, [
        'label'   => 'Date',
        'widget'  => 'single_text',
        'format'  => 'dd/MM/yyyy',
        'html5'   => false,
        'label_attr' => [
          'class'         => 'font-weight-bold',
        ],
        'attr'    => [
          'class'              => 'js-datepicker form-control',
          'autocomplete'       => 'off',
          'placeholder'        => date('d/m/Y'),
          'data-date-end-date' => '0d',
        ],
        'constraints' => [
          new NotBlank(),
          new Date(),
          new LessThanOrEqual('today'),
        ],
      ])
      /**->add("expenseItems", FileType::class, [
        'label'      => 'Attachments',
        'label_attr' => [
        'class'         => 'font-weight-bold',
        ],
        'attr'       => [
          'class' => 'form-control-file'
        ],
        'help'       => 'Add required receipts.'
      ])
       */
      ->add("submit", SubmitType::class, [
        'attr'       => [
          'class' => 'btn btn-primary'
        ],
      ])
    ;
  }

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefault('data_class',Expense::class);
  }


}