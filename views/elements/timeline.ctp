<!--Timeline Helper .-->
<?php if ($timeline): ?>
	
	<script language="javascript" type="text/javascript"> 
	
	function getDateText(y, m, d){
		if (m < 10){
			m = '0'+m;
		}
		if (d < 10){
			d = '0'+d;
		}
		return ''+y+m+d;
	}
	function getCalcDate(y, m, d, r, t){
		switch(t){
			case 'month':
				m += parseInt(r);
			break;
			default:
				d += parseInt(r);
			break;
		}
		var o = new Date(y, m-1, d);
		return getDateText(o.getFullYear(), o.getMonth()+1, o.getDate());
	}
	$(function(){
		var dateObj = new Date();
		var nowY = dateObj.getFullYear();
		var nowM = dateObj.getMonth()+1;
		var nowD = dateObj.getDate();
	
		$("#gantt").gantt({
			'range' : 20,
			'tasks':[
				<?php echo $timell; ?>
			]
		});
		$('a.GNT_now').click(function(){
			$('#gantt').setPeriod();
			return false;
		});
		$('a.GNT_next').click(function(){
			$('#gantt').setPeriod('+');
			return false;
		});
		$('a.GNT_next2').click(function(){
			$('#gantt').setPeriod('+7');
			return false;
		});
		$('a.GNT_prev').click(function(){
			$('#gantt').setPeriod('-');
			return false;
		});
		$('a.GNT_prev2').click(function(){
			$('#gantt').setPeriod('-7');
			return false;
		});
		$('a.GNT_type_date').click(function(){
			$('#gantt').setType('date');
			return false;
		});
		$('a.GNT_type_month').click(function(){
			$('#gantt').setType('month');
			return false;
		});
	
    <?php if ($duotime): ?>
		$("#gantt2").gantt({
			'range' : 20,
			'tasks':[
				<?php echo $ganttconsumer; ?>
			]
		});
		$('a.GNT_now3').click(function(){
			$('#gantt2').setPeriod();
			return false;
		});
		$('a.GNT_next3').click(function(){
			$('#gantt2').setPeriod('+');
			return false;
		});
		$('a.GNT_next4').click(function(){
			$('#gantt2').setPeriod('+7');
			return false;
		});
		$('a.GNT_prev3').click(function(){
			$('#gantt2').setPeriod('-');
			return false;
		});
		$('a.GNT_prev4').click(function(){
			$('#gantt2').setPeriod('-7');
			return false;
		});
		$('a.GNT_type_date2').click(function(){
			$('#gantt2').setType('date');
			return false;
		});
		$('a.GNT_type_month2').click(function(){
			$('#gantt2').setType('month');
			return false;
		});
	<?php endif; ?> 
	});
	
</script>
<?php endif; ?> 

