<?php

  namespace App\Controller;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

  use App\Entity\Expense;
  use App\Entity\User;

  class ExpenseController extends AbstractController {

    /**
     * @Route("/")
     */
    public function index() {

      // Create my User object, we assume we are Admin for now
      $admin = $this->getDoctrine()->getRepository(User::class)->find(1);

      // Get expens repository
      $expense_repository = $this->getDoctrine()->getRepository(Expense::class);
      // Fetch user expenses ordered by date
      $my_expenses = $expense_repository->findBy(
        [ 'user_id' => $admin->getId() ],
        [ 'date'    => 'DESC'          ]
      );



      /**
      $entityManager = $this->getDoctrine()->getManager();
      $admin_user = $this->getDoctrine()
        ->getRepository(User::class)
        ->find(1);
      $expense = new Expense();
      $expense->setUserId($admin_user);
      $expense->setSubmitDate( new \DateTime() );
      $expense->setName('Total');
      $expense->setDescription('Tankbeurt');
      $expense->setDate( new \DateTime());
      $expense->setAmount( 60.45 );
      $expense->setReimbursed(0);
      $entityManager->persist($expense);
      $entityManager->flush();
      */

      return $this->render('expenses/index.html.twig', array(
        'expenses' => $my_expenses));
    }

  }
