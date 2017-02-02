<?php

namespace AppBundle\Models;

use Symfony\Component\HttpFoundation\Response;

class LoadData {
	//make 1 function to initialise the app and load the initial data into cache

	//make one then to get the data

	//make one to append to the data
	
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

	public function getDoctors(){
		//pull the list from the cache and encode as json
		return apcu_fetch('doctors');
	}


}