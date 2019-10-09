<?php

namespace App\Forms;

use App\Entity\Expense;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpenseFormType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add("name", TextType::class, [
        'label'      => 'Name',
        'attr'       => [
          'class'         => 'form-control',
          'autocomplete'  => 'off',
        ],
      ])
      ->add("description", TextType::class, [
        'label'      => 'Description',
        'attr'       => [
          'class'         => 'form-control',
          'autocomplete'  => 'off',
        ],
      ])
      ->add("amount", NumberType::class, [
        'label'      => 'Amount',
        'scale'      => 2,
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
        'attr'    => [
          'class'         => 'js-datepicker form-control',
          'autocomplete'  => 'off',
          'placeholder'   => date('d/m/Y'),
        ],
      ])
      /**->add("expenseItems", FileType::class, [
        'label'      => 'Attachments',
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