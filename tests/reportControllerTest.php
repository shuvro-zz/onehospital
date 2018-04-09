<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class reportControllerTest extends TestCase
{
   	
   	private function reportMock()
   	{
   		$reportMock = [
   			'name'=>'mockReport',
   			'innerTests'=>[['id'=>1],['id'=>2],['id'=>3]],
   			'user_id'=>2
   		];

   		return $reportMock;
   	}

  
    public function testShowReportDetails()
    {
		$this->WithoutMiddleware();
    	$report = $this->reportMock();
        $this->visit('/api/reports/1', $report)
        ->seeJsonStructure(['status', 'report']);
    }
}
