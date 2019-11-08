<?php

namespace App\Form;

use App\Entity\Expense;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

      /** @var Expense $expense */
      $expense = $builder->getData();

      $approved_status = $expense->getApproved();

      // If the expense is pending enable all buttons
      if ($approved_status == null) {
        $builder
          ->add("accept", SubmitType::class, [
            'attr' => [
              'class' => 'btn btn-success btn-block btn-lg mb-2',
            ],
          ])
          ->add("reject", SubmitType::class, [
            'attr' => [
              'class' => 'btn btn-primary btn-block btn-lg mt-2',
            ],
          ])
        ;
      }
      // If it has been approved, disable the approved button
      elseif ($approved_status == 1) {
        $builder
          ->add("accept", SubmitType::class, [
            'attr' => [
              'class' => 'btn btn-success btn-block btn-lg mb-2',
            ],
            'disabled' => true,
          ])
          ->add("reject", SubmitType::class, [
            'attr' => [
              'class' => 'btn btn-primary btn-block btn-lg mt-2',
            ],
          ])
        ;
      }
      else {
        $builder
          ->add("accept", SubmitType::class, [
            'attr' => [
              'class' => 'btn btn-success btn-block btn-lg mb-2',
            ],
          ])
          ->add("reject", SubmitType::class, [
            'attr' => [
              'class' => 'btn btn-primary btn-block btn-lg mt-2 mb-2',
            ],
            'disabled' => true,
          ])
        ;
      }
    }

    public function configureOptions(OptionsResolver $resolver) {
      $resolver->setDefaults(['data_class' => Expense::class,]);
    }
}
