<?php 
	class ColorHelper extends AppHelper {
		function select($clr) {
			$option = array(
					0 =>array(
						'code'=>'#ff94fa',
						'name'=>'Purple'
					),
					1 =>array(
						'code'=>'#ff94ab',
						'name'=>'Red'
					),
					2 =>array(
						'code'=>'#ffc194',
						'name'=>'Orange'
					),
					3 =>array(
						'code'=>'#fff694',
						'name'=>'Yellow'
					),
					4 =>array(
						'code'=>'#d7ff94',
						'name'=>'Light Green'
					),
					5 =>array(
						'code'=>'#d7ff94',
						'name'=>'Light Blue'
					),
					6 =>array(
						'code'=>'#94abff',
						'name'=>'Navy Blue'
					),
					7 =>array(
						'code'=>'#00db0b',
						'name'=>'Green'
					),
					8 =>array(
						'code'=>'#ff94fa',
						'name'=>'Pink'
					)				
			);
			$txt = '<div class="input select">
					<label for="MilestoneColor">Color</label>
					<select id="MilestoneColor" name="data[Milestone][color]">';
			foreach ($option as $opt){
				if($opt["code"] == $clr){
					$txt .= '<option value="'. $opt["code"] .'" selected="selected">'. $opt["name"] .'</option>';
				}
				else{
					$txt .= '<option value="'. $opt["code"] .'">'. $opt["name"] .'</option>';
				}
			}	
			$txt .= '</select></div>';
			return $this->output($txt);
		}
		
		function st($clr) {
			$option = array(
					0 =>array(
						'code'=>'#ff94fa',
						'name'=>'Purple'
					),
					1 =>array(
						'code'=>'#ff94ab',
						'name'=>'Red'
					),
					2 =>array(
						'code'=>'#ffc194',
						'name'=>'Orange'
					),
					3 =>array(
						'code'=>'#fff694',
						'name'=>'Yellow'
					),
					4 =>array(
						'code'=>'#d7ff94',
						'name'=>'Light Green'
					),
					5 =>array(
						'code'=>'#d7ff94',
						'name'=>'Light Blue'
					),
					6 =>array(
						'code'=>'#94abff',
						'name'=>'Navy Blue'
					),
					7 =>array(
						'code'=>'#00db0b',
						'name'=>'Green'
					),
					8 =>array(
						'code'=>'#ff94fa',
						'name'=>'Pink'
					)				
			);
			$txt = '<div class="input select">
					<label for="StandartColor">Color</label>
					<select id="StandartColor" name="data[Standart][color]">';
			foreach ($option as $opt){
				if($opt["code"] == $clr){
					$txt .= '<option value="'. $opt["code"] .'" selected="selected">'. $opt["name"] .'</option>';
				}
				else{
					$txt .= '<option value="'. $opt["code"] .'">'. $opt["name"] .'</option>';
				}
			}	
			$txt .= '</select></div>';
			return $this->output($txt);
		}
		
		function __eq($color , $color2){
			
			 if($color == $color2){
			 
			 }
			
		}
	}
?>