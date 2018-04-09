<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class pdfControllerTest extends TestCase
{
    public function testDisplaysAsPDF()
    {
    	$this->WithoutMiddleware();
    	$user = new StdClass();
    	$user->username = 'shammes';
    	Auth::shouldReceive('user')->once()->andreturn($user);
        $this->visit('/reports/page/1/pdf')
        ->assertResponseStatus(200);
    }

    public function testDisplayAsPage()
    {
		$this->WithoutMiddleware();
    	$user = new StdClass();
    	$user->username = 'shammes';
    	Auth::shouldReceive('user')->once()->andreturn($user);
        $this->visit('/reports/page/1')
        ->assertResponseStatus(200);
    }

    public function testSendsEmail()
    {
        $this->WithoutMiddleware();
        $user = new StdClass();
        $user->username = 'shammes';
        Auth::shouldReceive('user')->once()->andreturn($user);
        $this->visit('/reports/page/1/email')
        ->seeJson(['status'=>'success']);
    }
}
