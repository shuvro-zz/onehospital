<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class viewsTest extends TestCase
{
    
    public function testLoginView()
    {    	
        $this->visit('/')
        	->see('Enter Credentials');
    }

    public function testPatientView()
    {
    	$this->WithoutMiddleware();
        $user = new StdClass();
        $user->username = 'shammes';

        Auth::shouldReceive('user')->once()->andreturn($user);
    	$this->visit('patient')
    	->see('Patient Reports');
    }

    public function testOperatorView(){
        $this->WithoutMiddleware();
        $this->visit('operator')
        ->see('Operator Platform');   
    }

    public function testRestrictPublicAccess()
    {
        $this->visit('operator')
        ->see('Enter Credentials');

        $this->visit('patient')
        ->see('Enter Credentials');
    }

}
