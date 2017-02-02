<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Models\LoadData;

class DefaultController extends Controller
{	
	/*
	*	One must load the index of the application first to load the data into memory
	*/	


	//cache doctor object

	protected $doctorsList;
	

    /**
     * @Route("/", name="homepage", defaults={"_format": "json"})
     */
    public function indexAction(){
	
    	$this->initialise();

        return new Response(
            $this->doctorsList->getDoctors()
        );
    }

    /**
     * @Route("/doctor/{id}", name="doctors", defaults={"_format": "json"})
     */
    public function getDoctorAction($id){
    	
    	
    	$docs = $this->loadCache();
    	
    	$i = 0;
    	//count number of doctors
    	foreach($docs as $doc){
    		$i++;
    	}

    	if($id > $i){
    		$error = $this->errorHandler(1);
    	}

    	if(isset($error)){
	    	return new Response(
	            json_encode($error)
	        );
    	}

		return new Response(
            json_encode($docs[$id])
        );
      
    }

	/**
	 * @Route("/add/{data}", name="add" ,defaults={"_format": "json"})
	 * @Method({"GET", "HEAD"})
	 */
    public function addDoctor($data){

        // ... return a JSON response with the post
        return new Response(
            json_encode($this->loadCache())
        );
    }

    private function loadCache(){
    	//loading from the cache like this directly is not really recommended for production - better to define and use model methods
    	return apcu_fetch('doctors');
    }


    private function initialise(){

    	//make the methods of the data object available in the controller
    	$this->doctorsList = new LoadData();

    	//instantiate the model the data and load into the cache
    	$this->doctorsList->initialise();
    }

    //add doctor

    //add patient

    //add both

    private function errorHandler($i){
    	$errors = array(
    		1 => 'No Doctors found',
    		2 => 'No patients found'
    	);

    	return json_encode($errors[$i]);
    }
    


    //load JSON from model/simulated db calls

    //process post input

    //error handling

    //do the addition and logic

    //construct responses


}