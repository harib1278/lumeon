<?php

namespace AppBundle\Models;

use Symfony\Component\HttpFoundation\Response;

class LoadData {	
	
	protected $doctors;

	public function __construct() {
		// Hardcodethe data for now
		$this->doctors = array(
			1 => array(
				'name' => 'Dr John Smith',
				'patients' => array(
					1 => 'Jim Agar',
					2 => 'Bill Jones',
					3 => 'Julie Murphy'
				)
			),
			2 => array(
				'name' => 'Dr Michael Kasmir',
				'patients' => array(
					1 => 'Ben Agar',
					2 => 'Charlie Smith',
					3 => 'Sally Southers'
				)
			),
		);
	}

	public function initialise(){		
		//write the above list to the cache
		apcu_store('doctors', $this->doctors);
	}
	
}