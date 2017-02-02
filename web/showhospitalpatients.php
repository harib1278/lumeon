<?php

use Symfony\Component\HttpFoundation\Request;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../app/autoload.php';
$request = Request::createFromGlobals();

function getHospitalPatients() {
	global $request;

	$hospitalId = $request->get('hospitalId');

	// Let's check to see if we have received the hospital id
	if (empty($hospitalId)) {
		return new \Symfony\Component\HttpFoundation\JsonResponse(array(
			'msg' => 'No hospital information received'
		));
	}

	$hospitalRepository = new \AppBundle\Repository\HospitalRepository();
	$patientRepository = new \AppBundle\Repository\PatientRepository();

	$hospital = $hospitalRepository->selectById($hospitalId);
	$patients = $patientRepository->selectByHospital($hospital);

	var_dump($hospital);
	var_dump($patientRepository);
	die();

	// Return a list of patients along with the original hospital and a message showing success
	return new \Symfony\Component\HttpFoundation\JsonResponse(array(
		'patients' => $patients,
		'hospital' => $hospital,
		'msg' => 'Here are the patients for '.$hospital->getName()
	));
}

return getHospitalPatients();


/*
1. No routing therefor urls are ugly - showhospitalpatients.php?hospitalId vs /patients/show/11
	- Accessing the php script like this is considered an example of bad practice
	- Routing should be set up that will point to a specific controller class and function
	- The business logic should live inside of these interlinked OO controller classes.
2. Params should be set via the route like /this/route/11 rather than using ?param=11 via get data
3. Why is there a return statement calling the main function outside the body of a function?
4. Use of global variables like this is not good, if you want to retrieve get data like this, then use the php variable: $_GET['param'] or use the symfony component correctly 
5. You do not need to pass in methods like this into the class. You are pulling in far too many super globals that are not needed for this simple snippet of code.
6. namespaecs should be used, the return statements shouldnt be giving the full namespace path to the jsonresponse function you want to use, same for the obbject instantiation e.g \AppBundle\Repository\HospitalRepository()
7. Theres no access modifier on the main function e.g public/ private or protected.
8. Its not in a proper class, its more of a badly written psuedo class, attribute setting outside of any large class structure or function.


*/