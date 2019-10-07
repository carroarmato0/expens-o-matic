<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExpenseItemRepository")
 */
class ExpenseItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Expense", inversedBy="expenseItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $expense_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpenseId(): ?Expense
    {
        return $this->expense_id;
    }

    public function setExpenseId(?Expense $expense_id): self
    {
        $this->expense_id = $expense_id;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }
}
