<?php

	#doc
		#	classname:	TaskHelper
		#	description :		PUBLIC
		#
		#/doc
		
		class TskHelper extends AppHelper
		{
			var $helpers = array("Timecal");
			
			function duration($acti)
			{
				if (count($acti) == 0)
				{
					return $this->output('00:00');
					
				}else{
					$sum = 0 ; 
					foreach ($acti as $act)
					{
						$sum = $sum + $act['duration'];
					}
				
					return $this->output($this->Timecal->show($sum));
				}
				
			}
			
			function overdue($date){
				if(strtotime($date) < time())
				 {
				 	return $this->output($this->Timecal->format($date) . " (Overdue)");				 	
				 }else
				 {
				 	return $this->output($this->Timecal->format($date));
				 }
			}
			
			function done($date){
				if ($date == '0000-00-00')
				{
					return $this->output('-');	
				}else{
					return $this->output($this->Timecal->format($date));
				}
			}
			
			function approved($app){
				switch ($app){
					case 0:
						return $this->output('No');
					break;
					case 1:
						return $this->output('Yes');
					break;
				}
			}
			
			function dispProj($project , $taskType){
				if(isset($project["Project"])){
					if($project["Project"]["redalto"] == 0){
						$out = $project["Project"]["customer"] . ':' . $project["Project"]["name"];
					}else{
						$out = $project["Project"]["name"];
					}
				}else{
					if($taskType =='customer'){
						$out = 'Customer Jobs';
					}else if($taskType == 'redalto'){
						$out = 'Redalto Jobs';
					}
				}
				
				
				return $this->output($out);
			}
		}

?>
