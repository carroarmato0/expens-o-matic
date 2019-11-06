<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Expense;

/**
 * @IsGranted("ROLE_ACCOUNTANT")
 */
class ManagementController extends AbstractController
{
    /**
     * @Route("/management", name="management")
     */
    public function index()
    {
      // Get expense repository
      $expense_repository = $this->getDoctrine()->getRepository(Expense::class);
      // Fetch pending expenses
      $pending_expenses = $expense_repository->findBy(
        ['approved'     => null],
        ['submit_date'  => 'DESC']
      );

      // Get this year's total pending expenses per month
      $pending_expenses_stats = $expense_repository->getMonthlyPendingExpenses(date("Y"));

      // Get this year's total approved expenses per month
      $approved_expenses_stats = $expense_repository->getMonthlyApprovedExpenses(date("Y"));

      return $this->render('management/index.html.twig', [
        'pending_expenses_stats'  => $pending_expenses_stats,
        'approved_expenses_stats' => $approved_expenses_stats,
        'pending_expenses'        => $pending_expenses,
      ]);
    }
}
