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

	// Return a list of patients along with the original hospital and a message showing success
	return new \Symfony\Component\HttpFoundation\JsonResponse(array(
		'patients' => $patients,
		'hospital' => $hospital,
		'msg' => 'Here are the patients for '.$hospital->getName()
	));
}

return getHospitalPatients();