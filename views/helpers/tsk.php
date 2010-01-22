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
		}

?>
