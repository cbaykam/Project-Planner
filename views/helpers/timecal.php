<?php

	#doc
	#	classname:	TimecalHelper
	#	scope:		Displays the given minutes in HH:MM format
	#
	#/doc
	
	class TimecalHelper extends AppHelper
	{
	
		function show($duration)
		{
			$minute = $duration % 60;
			$duration = $duration - $minute; 
			$hour = $duration / 60 ; 
			if ($minute == 0)
			{
			    $minute = "00";
			}else if($minute < 10){
				$minute = "0" . $minute;
			}
			if ($hour == 0)
			{
			    $hour = "00";
			}else if($hour < 10){
				$hour = "0" . $hour;
			}
			
			$output = $hour . ':' . $minute;
			
			return $this->output($output);
		}
		
		function hour($time){
			$remain = $time % 60 ; 
			$time = $time - $remain ;
			$hour = $time / 60;
			return $this->output($hour);
		}
		
		function minute($time){
			$minute = $time % 60 ; 
			return $this->output($minute);
		}
			
	
	}


?>
