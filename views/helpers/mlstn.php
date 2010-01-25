<?php 
	class MlstnHelper extends AppHelper {
		function completed($tasks) {
			$completed = true;
			foreach($task as $tsk){
					if($tsk["Task"]["completed"] != 1){
						$completed = false;					
					}
			}
		}
	}
?>