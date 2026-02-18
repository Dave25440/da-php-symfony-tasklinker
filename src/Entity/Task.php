<?php

namespace App\Entity;

use App\Enum\TaskStatus;
use App\Repository\TaskRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[Assert\Length(min: 10)]
    #[Assert\NotBlank()]
    #[ORM\Column(name: 'title', length: 255)]
    private ?string $title = null;

    #[Assert\Length(min: 20)]
    #[ORM\Column(name: 'description', length: 255, type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[Assert\GreaterThanOrEqual('today')]
    #[ORM\Column(name: 'deadline', type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $deadline = null;

    #[Assert\NotBlank()]
    #[ORM\Column(name: 'status', length: 255)]
    private ?TaskStatus $status = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    #[ORM\JoinColumn(name: 'employee_id')]
    private ?Employee $employee = null;

    #[Assert\NotNull()]
    #[ORM\ManyToOne(inversedBy: 'tasks')]
    #[ORM\JoinColumn(name: 'project_id', nullable: false)]
    private ?Project $project = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDeadline(): ?\DateTimeImmutable
    {
        return $this->deadline;
    }

    public function setDeadline(?\DateTimeImmutable $deadline): static
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getStatus(): ?TaskStatus
    {
        return $this->status;
    }

    public function setStatus(TaskStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): static
    {
        $this->project = $project;

        return $this;
    }
}
