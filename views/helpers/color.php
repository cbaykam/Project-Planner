<?php 
	class ColorHelper extends AppHelper {
		function select() {
			echo '<div class="input select">
					<label for="MilestoneColor">Color</label>
					<select id="MilestoneColor" name="data[Milestone][color]">
						<option value="#ff94fa">Purple</option>
						<option value="#ff94ab">Red</option>
						<option value="#ffc194">Orange</option>
						<option value="#fff694">Yellow</option>
						<option value="#d7ff94">Light Green</option>
						<option value="#94fff7">Light Blue</option>
						<option value="#94abff">Navy Blue</option>
						<option value="#00db0b">Green</option>
						<option value="#ff0ff7">Pink</option>
					</select></div>';
		}
	}
?>