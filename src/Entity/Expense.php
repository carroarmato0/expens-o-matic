<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExpenseRepository")
 */
class Expense
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $submit_date;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $approved;

    /**
     * @ORM\Column(type="smallint")
     */
    private $reimbursed = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExpenseItem", mappedBy="expense_id", orphanRemoval=true)
     */
    private $expenseItems;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="expenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    public function __construct()
    {
        $this->expenseItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubmitDate(): ?\DateTimeInterface
    {
        return $this->submit_date;
    }

    public function setSubmitDate(\DateTimeInterface $submit_date): self
    {
        $this->submit_date = $submit_date;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getApproved(): ?int
    {
        return $this->approved;
    }

    public function setApproved(?int $approved): self
    {
        $this->approved = $approved;

        return $this;
    }

    public function getReimbursed(): ?int
    {
        return $this->reimbursed;
    }

    public function setReimbursed(?int $reimbursed): self
    {
        $this->reimbursed = $reimbursed;

        return $this;
    }

    /**
     * @return Collection|ExpenseItem[]
     */
    public function getExpenseItems(): Collection
    {
        return $this->expenseItems;
    }

    public function addExpenseItem(ExpenseItem $expenseItem): self
    {
        if (!$this->expenseItems->contains($expenseItem)) {
            $this->expenseItems[] = $expenseItem;
            $expenseItem->setExpenseId($this);
        }

        return $this;
    }

    public function removeExpenseItem(ExpenseItem $expenseItem): self
    {
        if ($this->expenseItems->contains($expenseItem)) {
            $this->expenseItems->removeElement($expenseItem);
            // set the owning side to null (unless already changed)
            if ($expenseItem->getExpenseId() === $this) {
                $expenseItem->setExpenseId(null);
            }
        }

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
