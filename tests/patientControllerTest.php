<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class patientControllerTest extends TestCase
{
    
    private function patientMock()
    {
        $operator = [0, 1];
        $faker = Faker\Factory::create();
        $patientMock = [
            'name' => $faker->name(),
            'email' =>$faker->email,
            'password' => $faker->password,
            'username' => wordwrap($faker->userName, 13),
            'operator' => $operator[$faker->numberBetween(0,1)],
        ];
        return $patientMock;
    }

    public function testRetrievePatientList()
    {
        $this->WithoutMiddleware();
        $this->visit('api/patient')
        ->seeJsonStructure([
        		'status',
        		'patients'
        	]);
    }

    public function testStorePatient()
    {
        $this->WithoutMiddleware();
        $patient = $this->patientMock();
        $this->json('post', '/api/patient', $patient)
        ->seeJson(['status'=>'success']);
    }  

    public function testShowPatient()
    {
       $this->WithoutMiddleware();
        $patient = $this->patientMock();
        $this->visit('/api/patient/1')
        ->seeJson(['status'=>'success']); 
    }

    public function testUpdatePatient()
    {
        $this->WithoutMiddleware();
        $patient = $this->patientMock();
        $this->json('put', '/api/patient/2', $patient)
        ->seeJson(['status'=>'success']);
    }

    public function testDeletePatient()
    {
        $this->WithoutMiddleware();
        $this->json('delete', '/api/patient/0')
        ->seeJson(['status'=>'success']);
    }
}
?>