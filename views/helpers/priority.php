<?php  
	#doc
	#	classname:	PriorityHelper
	#	scope:		PUBLIC
	#
	#/doc
	
	class PriorityHelper extends AppHelper
	{
	
		function display($pri)
		{
			switch ($pri)
			{
				case 1:
					$return = 'High';
				break;
				
				case 2:
					$return = 'Mid';					
				break;
				
				case 3:
					$return = 'low';
				break;
			}
			return $this->output($return);
		}
			
	
	}
	
?>
