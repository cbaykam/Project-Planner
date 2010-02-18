<?php 
	class UsrHelper extends AppHelper {
		function rights($admin) {
			if($admin == 1){
				return $this->output('Super Admin');
			}else{
				return $this->output('Resource');
			}
		}
	}
?>