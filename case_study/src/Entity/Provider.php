<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProviderRepository::class)
 */
class Provider
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Todo", mappedBy="provider")
	 */
	private $todos;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	private $name;

	/**
	 * @return mixed
	 */
	public function getTodos() {
		return $this->todos;
	}

	/**
	 * @param mixed $todos
	 */
	public function setTodos( $todos ): void {
		$this->todos = $todos;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName( $name ): void {
		$this->name = $name;
	}

    public function getId(): ?int
    {
        return $this->id;
    }
}
