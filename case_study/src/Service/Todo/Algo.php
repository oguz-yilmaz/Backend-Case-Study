<?php


namespace App\Service\Todo;


class Algo {

	private $remainingHours = 0;
	private $completedWeek = 0;
	private $totalTaskHours = 0;
	private $levelHours = [ 0, 0, 0, 0, 0 ];
	private $lastWeekDevHours = [ 0, 0, 0, 0, 0 ];
	private $perWeekTotal = 45 * 5 + 45 * 4 + 45 * 3 + 45 * 2 + 45;

	public function __construct( $todos ) {
		$this->todos = $todos;
		$this->_total();
		$this->_totalTaskHours();
		$this->_completeWeek();
	}

	private function _total() {
		foreach ( $this->todos as $todo ) {
			$this->levelHours[ $todo->getDifficultyLevel() - 1 ] += ( $todo->getDuration() * $todo->getDifficultyLevel() );
		}

	}

	private function _totalTaskHours() {
		$this->totalTaskHours = array_reduce( $this->levelHours, function ( $carry, $item ) {
			$carry += $item;

			return $carry;
		} );
	}

	/*
		ALGORITHM FOR LAST WEEK
		15 -> 1 hour = 15 (all+)
		4 3 2 1 -> 1 hour = 10 (4321+)
		3 2 1 -> 1 hour = 6 (321+)
		2 1 -> 1 hour = 3 (21+)
		1 -> 1 hour = 1 (1+)

		only calculate the last week
		cuz for the previous weeks all devs have to work full hours
	*/
	public function lastWeekDevHours() {
		if ( ! $this->remainingHours ) {
			return;
		}

		$i        = 0;
		$devWorks = [ 5, 4, 3, 2, 1 ];

		$remainingHours = $this->remainingHours;

		$rem = $remainingHours - $devWorks[ $i ];
		$this->lastWeekDevHours[ $i ] ++;

		while ( $rem > 0 ) {
			$i ++;
			if ( $i > 4 ) {
				$i = 0;
			}
			if ( $rem - $devWorks[ $i ] >= 0 ) {
				$rem -= $devWorks[ $i ];
				$this->lastWeekDevHours[ $i ] ++;
			}
		}

		return $this->lastWeekDevHours;

	}

	private function _completeWeek() {
		$this->completedWeek  = (int) floor( $this->totalTaskHours / $this->perWeekTotal );
		$this->remainingHours = $this->totalTaskHours % $this->perWeekTotal;
	}

	public function completedWeek() {
		return $this->completedWeek;
	}

}