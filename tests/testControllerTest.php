<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testControllerTest extends TestCase
{
    
    private function mockTest()
    {
    	$mockTest = [
    		'name'=>'mockTest',
    		'created_at'=>'2016-01-01',
    		'type'=>'blood',
    		'result'=>'result',
    		'comments'=>'comments',
    		'user_id'=>2
    	];

    	return $mockTest;
    }

    public function testCreatesTest()
    {
        $this->WithoutMiddleware();
        $test = $this->mockTest();
        $this->json('post', '/api/tests', $test)
        ->seeJson(['status'=>'success']);
    }

    public function testPreventUnauthorizedAccess(){
    	$test = [];
    	$this->json('post', '/api/tests', $test)
    	->seeJsonStructure(['error']);
    }
}
