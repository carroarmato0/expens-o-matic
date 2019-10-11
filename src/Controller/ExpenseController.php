<?php

  namespace App\Controller;

  use App\Forms\ExpenseFormType;

  use Exception;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

  use App\Entity\Expense;
  use App\Entity\User;

  class ExpenseController extends AbstractController {

    /**
     * @Route("/", name="expense_overview")
     * @param Request $request
     * @return Response
     * @throws Exception
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
        /** @var Expense $expense */
        $expense = $expenseForm->getData();
        $expense->setUserId($admin);
        $expense->setSubmitDate(new \DateTime("now"));

        // Get the Entity Manager
        $entityManager = $this->getDoctrine()->getManager();
        // Prepare entity to be save
        $entityManager->persist($expense);
        // Perform the insert statements
        $entityManager->flush();

        return $this->redirectToRoute('expense_overview');
      }

      return $this->render('expenses/index.html.twig', array(
        'expenses'    => $my_expenses,
        'expenseForm' => $expenseForm->createView()));
    }

    /**
     * @Route("/expense/{id}", name="expense_show")
     * @param $id
     * @return Response
     */
    public function show($id) {
      // Get expense repository
      $expense_repository = $this->getDoctrine()->getRepository(Expense::class);
      // Fetch expense by id
      $my_expense = $expense_repository->find($id);

      if (empty($my_expense)) {
        return $this->redirectToRoute('expense_overview');
      }

      return $this->render("expenses/show.html.twig", array(
        'expense' => $my_expense
      ));
    }

    /**
     * @Route("/expense/{id}/edit", name="expense_edit")
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Exception
     */
    public function edit(Request $request, $id) {
      // Get expense repository
      $expense_repository = $this->getDoctrine()->getRepository(Expense::class);
      // Fetch expense by id
      $my_expense = $expense_repository->find($id);

      // Load form to edit an expense
      $expenseForm = $this->createForm(ExpenseFormType::class, $my_expense);

      // Load Request information
      $expenseForm->handleRequest($request);

      // Check if the Expense Form was submitted and is valid
      if ($expenseForm->isSubmitted() && $expenseForm->isValid()) {
        /** @var Expense $expense */
        $expense = $expenseForm->getData();

        // Get the Entity Manager
        $entityManager = $this->getDoctrine()->getManager();
        // Prepare entity to be save
        $entityManager->persist($expense);
        // Perform the insert statements
        $entityManager->flush();

        return $this->redirectToRoute('expense_show', array('id' => $id));
      }

      return $this->render("expenses/edit.html.twig", array(
        'expenseForm' => $expenseForm->createView(),
      ));
    }

    /**
     * @Route("/expense/{id}/delete", methods={"DELETE"}, name = "expense_delete")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Request $request, $id) {
      // Fetch expense by id
      $my_expense = $this->getDoctrine()->getRepository(Expense::class)->find($id);

      // Get the Entity Manager
      $entityManager = $this->getDoctrine()->getManager();
      // Prepare entity to be deleted
      $entityManager->remove($my_expense);
      // Perform the delete statements
      $entityManager->flush();

      return $this->redirectToRoute('expense_overview');
    }

  }
