<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
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
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RoleAssignment", mappedBy="role_id", orphanRemoval=true)
     */
    private $roleAssignments;

    public function __construct()
    {
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
            $roleAssignment->setRoleId($this);
        }

        return $this;
    }

    public function removeRoleAssignment(RoleAssignment $roleAssignment): self
    {
        if ($this->roleAssignments->contains($roleAssignment)) {
            $this->roleAssignments->removeElement($roleAssignment);
            // set the owning side to null (unless already changed)
            if ($roleAssignment->getRoleId() === $this) {
                $roleAssignment->setRoleId(null);
            }
        }

        return $this;
    }
}
