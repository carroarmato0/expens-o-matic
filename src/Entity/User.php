<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=90)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="smallint")
     */
    private $enabled = 1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Expense", mappedBy="user_id")
     */
    private $expenses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RoleAssignment", mappedBy="user_id", orphanRemoval=true)
     */
    private $roleAssignments;

    public function __construct()
    {
        $this->expenses = new ArrayCollection();
        $this->roleAssignments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEnabled(): ?int
    {
        return $this->enabled;
    }

    public function setEnabled(int $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return Collection|Expense[]
     */
    public function getExpenses(): Collection
    {
        return $this->expenses;
    }

    public function addExpense(Expense $expense): self
    {
        if (!$this->expenses->contains($expense)) {
            $this->expenses[] = $expense;
            $expense->setUserId($this);
        }

        return $this;
    }

    public function removeExpense(Expense $expense): self
    {
        if ($this->expenses->contains($expense)) {
            $this->expenses->removeElement($expense);
            // set the owning side to null (unless already changed)
            if ($expense->getUserId() === $this) {
                $expense->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RoleAssignment[]
     */
    public function getRoleAssignments(): Collection
    {
        return $this->roleAssignments;
    }

    public function addRoleAssignment(RoleAssignment $roleAssignment): self
    {
        if (!$this->roleAssignments->contains($roleAssignment)) {
            $this->roleAssignments[] = $roleAssignment;
            $roleAssignment->setUserId($this);
        }

        return $this;
    }

    public function removeRoleAssignment(RoleAssignment $roleAssignment): self
    {
        if ($this->roleAssignments->contains($roleAssignment)) {
            $this->roleAssignments->removeElement($roleAssignment);
            // set the owning side to null (unless already changed)
            if ($roleAssignment->getUserId() === $this) {
                $roleAssignment->setUserId(null);
            }
        }

        return $this;
    }

}
