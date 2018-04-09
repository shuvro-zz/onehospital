<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class patientReportsController extends TestCase
{
    
    public function testRetrievePatientReportList()
    {
    	$this->WithoutMiddleware();
        $user = new StdClass();
        $user->username = 'shammes';

        Auth::shouldReceive('user')->once()->andreturn($user);
        $this->visit('/api/patientReports')
        ->seeJsonStructure([
        		'status',
        		'reports'
        	]);
    }

    public function testShowReportDetails()
    {
        $this->WithoutMiddleware();
        $this->visit('/api/patientReports/1')
        ->seeJsonStructure([
                'status',
                'tests'
            ]);
    }

    public function testRestrictUnauthorizedAccess()
    {
        $this->visit('/api/patientReports')
        ->see('Enter Credentials');
    }
}
