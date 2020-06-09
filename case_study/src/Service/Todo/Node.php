<?php


namespace App\Service\Todo;


class Node {

	private $id;
	private $difficultyLevel;
	private $duration;

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ): void {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getDifficultyLevel() {
		return $this->difficultyLevel;
	}

	/**
	 * @param mixed $difficultyLevel
	 */
	public function setDifficultyLevel( $difficultyLevel ): void {
		$this->difficultyLevel = $difficultyLevel;
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


}