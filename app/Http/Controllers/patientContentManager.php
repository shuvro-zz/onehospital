<?php
	namespace patholab\Http\Controllers;

	use patholab\Report;
	use patholab\Test;

	trait patientContentManager
	{
		public function deleteReport($id)
		{			
			try
			{
				$report = Report::find($id);
				if(!empty($report))
				{
					$report->delete();
				}
				else
				{
					throw New \Exception('report_id invalid');
				}
			}
			catch(\Exception $e)
			{
				return false;
			}
			finally
			{
				return true;
			}
				
		}

		public function deleteTest($test_id)
		{
			try
			{
				$test = Test::find($test_id);
				if(!empty($test))
				{
					/** 
					 * Delete test from all reports it's contained in
					 */	
					$reports = Report::where(['user_id'=>$test['user_id']])->select('innerTests', 'id')->get();
					foreach($reports as $report)
					{
						$innerTests = json_decode($report['innerTests']);
						$shallDelete = -1;
						foreach($innerTests as $key => $value)
						{
							if($value == $test_id)
							{
								$shallDelete = $key;
							}
						}
						if($shallDelete !== -1)
						{
							array_splice($innerTests, $key-1, 1);							
							if(count($innerTests) == 0)
							{								
								Report::find($report['id'])->delete();
							}else
							{
								Report::find($report['id'])->update(['innerTests'=>json_encode($innerTests)]);
							}
									
						}
					}
					$test->delete();
				}
				else
				{
					throw new \Exception ('failed to load test');
				}
			}
			catch(\Exception $e)
			{				
				return false;
			}
			finally
			{
				return true;
			}	
		}
	}

?>