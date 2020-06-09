<?php

namespace App\Entity;

use App\Repository\TodoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TodoRepository::class)
 */
class Todo {
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Provider", inversedBy="todos")
	 * @ORM\JoinColumn(name="provider_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $provider;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $todo_id;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $difficulty_level;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $duration;

	/**
	 * @return mixed
	 */
	public function getProvider() {
		return $this->provider;
	}

	/**
	 * @param mixed $provider
	 */
	public function setProvider( $provider ): void {
		$this->provider = $provider;
	}

	/**
	 * @return mixed
	 */
	public function getTodoId() {
		return $this->todo_id;
	}

	/**
	 * @param mixed $todo_id
	 */
	public function setTodoId( $todo_id ): void {
		$this->todo_id = $todo_id;
	}

	/**
	 * @return mixed
	 */
	public function getDifficultyLevel() {
		return $this->difficulty_level;
	}

	/**
	 * @param mixed $difficulty_level
	 */
	public function setDifficultyLevel( $difficulty_level ): void {
		$this->difficulty_level = $difficulty_level;
	}

	/**
	 * @return mixed
	 */
	public function getDuration() {
		return $this->duration;
	}

	/**
	 * @param mixed $duration
	 */
	public function setDuration( $duration ): void {
		$this->duration = $duration;
	}

	public function getId(): ?int {
		return $this->id;
	}
}
