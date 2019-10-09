<?php

  namespace App\Controller;

  use App\Forms\ExpenseFormType;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

  use App\Entity\Expense;
  use App\Entity\User;

  class ExpenseController extends AbstractController {

    /**
     * @Route("/")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {

      // Create my User object, we assume we are Admin for now
      $admin = $this->getDoctrine()->getRepository(User::class)->find(1);

      // Get expense repository
      $expense_repository = $this->getDoctrine()->getRepository(Expense::class);
      // Fetch user expenses ordered by date
      $my_expenses = $expense_repository->findBy(
        [ 'user_id' => $admin->getId() ],
        [ 'date'    => 'DESC'          ]
      );

      // Load form to submit an expense
      $expenseForm = $this->createForm(ExpenseFormType::class);

      // Load Request information
      $expenseForm->handleRequest($request);
      // Check if the Expense Form was submitted and is valid
      if ($expenseForm->isSubmitted() && $expenseForm->isValid()) {
        //dump($expenseForm->getData());
      }
      
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
        'expenses'    => $my_expenses,
        'expenseForm' => $expenseForm->createView()));
    }

  }
