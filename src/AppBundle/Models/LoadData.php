<?php

namespace AppBundle\Models;

use Symfony\Component\HttpFoundation\Response;

class LoadData {	
	
	/*
	*	As a true database was not in the spec of this test - I felt the most effective way to deliver what was
	*	asked and still demonstrate MVC architectural style was to use the APCu caching engine and then 
	*	simulating the model calls just as if it were a real database. In hindsight this was harder to implement
	*	than first thought - hence the reason for some of the cache calls are in the controller and not methods in this model.
	*/
	protected $doctors;

	public function __construct() {

		// this is the default data array loaded into memory upon initialisation of the API
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