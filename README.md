### Installation commands  
-- install dependencies using composer  
php composer.phar install

-- start the symfony server  
php app/console server:run  
  
  
-- PHP APC caching needed (I used APCu Version - 4.0.7-5.5):  
  
sudo apt-get install php5-apcu  
sudo /etc/init.d/apache2 restart   
  
-- add to .ini file:  
  
[APCu] 
extension=php_apcu.dll  
apc.enabled=1  
apc.shm_size=32M  
apc.ttl=7200  
apc.enable_cli=1  
apc.serializer=php   
  
### Routing information  
Data initialisation - /   
Get all doctors - /all  
Single doctor - /doctor/{idnumber}  
Addition of new doctor - /add/{json: string}  
  
  
## API curl command examples:  
  
--get all doctors  
curl -H "Content-Type: application/json" http://localhost:8000/  
  
--view a single doctor  
curl -H "Content-Type: application/json" http://localhost:8000/doctor/1  
  
-- add doctor (this will not work via curl as the API is cache based due to having no database - this means you need something to store the cache data locally e.g https://www.getpostman.com/)   
curl -H "Content-Type: application/json" -X POST http://localhost:8000/add/{"name":"Dr Ben Jones","patients":{"1":"Tim Horton","2":"Wayne Rooney","3":"Jamie Vardy"}}  
  
--example of postman submission (you must set the submission type to POST data)  
localhost:8000/add/{"name":"Dr Ben Jones","patients":{"1":"Tim Horton","2":"Wayne Rooney","3":"Jamie Vardy"}}  
  
  
## IMPORTANT NOTICE FOR RUN TIME ##  
As i've not implemented any form of persistent data storage I have used the APCu php caching engine making use of the Symfony specifc methods. This means the data stored in the model MUST be loaded into the application by
visiting the index / page first before trying other API endpoints, this is to allow for full functionality of the spec.  
  
## Data example for submission to add a new doctor  
{  
  	"name": "Dr Ben Jones",  
  	"patients": {  
  		"1": "Tim Horton",   
  		"2": "Wayne Rooney",  
  		"3": "Jamie Vardy"  
  	}  
}  
  
## Unit tests  
-- tests are very basic but still effective, this was owing to the time constraints of the test  
To run all: phpunit -c app/  
  
A successful running of the tests should look like:  

PHPUnit 4.8.34 by Sebastian Bergmann and contributors.  
  
.  
  
Time: 1.72 seconds, Memory: 9.75MB  
  
OK (1 test, 8 assertions)  
    
  
 
## Lumeon Technical Test


### Overview

Thank you for your interest, the aim of this technical task is to gauge your understanding and approach to writing code. The test aims to mimic the the kind of code that you may comes across at Lumeon, which is a combination of modern Symfony code along with legacy code. Please do note that this is not an exact copy of the Lumeon environment.

We are looking for:

- Clean concise code
- Unit tests
- Testable programming techniques
- Understanding of existing code

### Test Instructions

The aim of the test is not to get you to concrete out existing repository classes to a specific DB/ORM, so please do not feel the need to add in SQL queries or other DB calls. Wireframe calls are acceptable for these purposes as long as it is made clear what the expected return is e.g.:
```
/** @return Entity */
public function selectById(){}
```

#### Question
Please answer the following question textually.

The file web/showhospitalpatients.php is intended to retrieve a list of patients for a given hospital and return that in json format. Are there any comments you would like to make? What could be improved about the code ?

#### Exercise

This is the coding portion of the test. Please write code as well as you can using existing entities/repositories where appropriate and adding classes/files where needed.

Please add a new endpoint which allows us to save a patient against a doctor, bearing in mind that a doctor can have multiple patients.
- The output should be JSON.
- We should receive the doctor and the patients associated with that doctor in the output.
- Return any messages in the 'msg' key as per the existing code. 

We are looking for:

- Best practice in coding
- Unit test(s)
- The code to be hosted via git (e.g. github.com has free accounts)

### Your code should target

- PHP 5.6
- Symfony 2.8

### Final Words
Thank you very much for considering Lumeon, we aim to look at all entries as soon as possible but due to business needs we would like to apologise for any delay in advance. Good luck!