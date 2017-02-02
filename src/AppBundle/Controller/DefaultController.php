<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use phpDocumentor\Reflection\DocBlock\Serializer;

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
            json_encode(array(
            	'doctors' => $this->loadCache(),
            	'msg'	  => 'API initialised Here are all the doctors. If you need to load all of the doctors again then please use the /all endpoint, loading this index will result in re initialisation of the data array back to default'
            ))
        );
    }

    /**
     * @Route("/all", name="all", defaults={"_format": "json"})
     */
    public function allAction(){
	
    	$this->initialise();

        return new Response(
            json_encode(array(
            	'doctors' => $this->loadCache(),
            	'msg'	  => 'Here are all the doctors.'
            ))
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
	        json_encode(array(
				'doctor' => $docs[$i],
				'msg' 	 => 'Here are the patients for '.$docs[$i]['name']
			)));
      
    }

	/**
	 * @Route("/add/{data}", name="add", defaults={"_format": "json"})
	 * @Method({"POST", "HEAD"})
	 */
    public function addDoctor($data){

    	$arr = json_decode($data, true);

    	

    	$doctors = $this->loadCache();  	

    	//add to end of doctors and increment array index
    	$doctors[] = $arr;

    	//save the new doctors list in place of the old one
    	$this->saveCache($doctors);

    	//load from cache again - just to make sure
    	$doctors = $this->loadCache();

		//$error = $this->errorHandler(1);
		if(isset($error)){
	    	return new Response(
	            json_encode($error)
	        );
    	}   

        // ... return a JSON response with the post
        return new Response(
            json_encode($doctors)
        );
    }

    private function saveCache($doctors){
    	//add the message to the output    	
    	apcu_store('doctors', $doctors);
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

    //add patient

    //add both

    private function errorHandler($i){
    	$errors = array(
    		1 => 'Error: No Doctors found',
    		2 => 'Error: No patients found',
    		3 => 'Error: Incorrect parameters'
    	);

    	return json_encode($errors[$i]);
    }    

}