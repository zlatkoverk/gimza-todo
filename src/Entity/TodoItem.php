<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class TodoItem
 *
 * @ORM\Entity()
 * @package App\Entity
 */
class TodoItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @var User
     */
    private $user;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $label;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime|null
     */
    private $dueDate;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getDueDate(): ?\DateTime
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime|null $dueDate
     */
    public function setDueDate(?\DateTime $dueDate): void
    {
        $this->dueDate = $dueDate;
    }
}