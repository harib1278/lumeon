<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

require('vendor/autoload.php');

class DefaultControllerTest extends WebTestCase{

	public function testStatus(){
        $client = static::createClient();

        /**
        *	/ index API initialisation
        */

        $crawler = $client->request('GET', '/');

        //check status 200 is returned by api
        $this->assertEquals(
		    200,
		    $client->getResponse()->getStatusCode()
		);

        //check for the initialised successfully message
		$this->assertContains('API initialised', $client->getResponse()->getContent());

		/**
        *	/all all doctors are returned
        */

		//check /all
		$crawler = $client->request('GET', '/all');

		//check status 200 is returned by /all
        $this->assertEquals(
		    200,
		    $client->getResponse()->getStatusCode()
		);

        //check for the doctors loaded successfully message
		$this->assertContains('Here are all the doctors', $client->getResponse()->getContent());

		/**
        *	/doctor/1 check a single doctor is returned
        */

        //get a single doctor
		$crawler = $client->request('GET', '/doctor/1');

		//check status 200 is returned by /doctor/1 single doctor call
        $this->assertEquals(
		    200,
		    $client->getResponse()->getStatusCode()
		);

		//check the default data doctor patients have loaded
		$this->assertContains('Here are the patients for', $client->getResponse()->getContent());


		/**
		*	/add/{json} Check the add endpoint works
		*/
		$data = array(
			'name' => 'Dr Test-Name',
			'patients' => array(
				1 => 'Jim Agar',
				2 => 'Bill Jones',
				3 => 'Julie Murphy'
		));

		$crawler = $client->request('POST', '/add/'.json_encode($data));

		$this->assertEquals(
		    200,
		    $client->getResponse()->getStatusCode()
		);

		//see if the newly entered test name is printed in the response indicating everything was ok
		$this->assertContains('Test-Name', $client->getResponse()->getContent());

    }



}