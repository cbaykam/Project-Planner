<?php
class timecalc{

	var $endY		= "1976";		//	default end date is my birthday (oh, it will shows my real age!!)
	var $endM		= "9";
	var $endD		= "21";
	var $endH		= "0";			//	it's not accurate while using time
	var $endMn		= "0";
	var $endS		= "0";
	var $ended = false ; 
	//	LANGUAGES
	var $yearsT			= "Y";
	var $daysT			= "D";
	var $hoursT			= "H";
	var $minutesT		= "M";
	var $secondsT		= "S";
        var $t1=0;
        var $t2=0;

	//	Set language for the texts
	//	@public
	function setLangTxt($yearsT="yr",$daysT="day",$hoursT="hr",$minutesT="m",$secondsT="s")	{
		$this->yearsT	= $yearsT;
		$this->daysT	= $daysT;
		$this->hoursT	= $hoursT;
		$this->minutesT	= $minutesT;
		$this->secondsT	= $secondsT;
	}

	//	Set the ending date
	//	@public
	function setEnd($endYear,$endMonth,$endDay,$endHours=0,$endMinutes=0,$endSeconds=0)	{
		$this->endY		= (isset($endYear)		&& $endYear != "")		? $endYear		: date("Y");
		$this->endM		= (isset($endMonth)		&& $endMonth != "")		? $endMonth		: date("m");
		$this->endD		= (isset($endDay)		&& $endDay != "")		? $endDay		: date("Y");
		$this->endH		= (isset($endHours)		&& $endHours != "")		? $endHours		: 0;
		$this->endMn	= (isset($endMinutes)	&& $endMinutes != "")	? $endMinutes 	: 0;
		$this->endS		= (isset($endSeconds)	&& $endSeconds != "")	? $endSeconds 	: 0;
	}

	//	Useful function to get human readable format
	//	@private
	Function GetDateFormat($data,$dFormat="Y-M-D",$format="%e %B %Y")	{
		//	Format a Data by given format (default= Day MonthName Year)
		//	dFormat is how the data is given: possible value are: Y-M-D, D-M-Y
		$Alldata		= Split("-",$data);
		$Year			= (StrtoLower($dFormat) == "y-m-d")	? $Alldata[0] : $Alldata[2];
		$Month			= $Alldata[1];
		$Day			= (StrtoLower($dFormat) == "y-m-d")	? $Alldata[2] : $Alldata[0];
		$DataFinish		= strftime($format, mktime(0,0,0,$Month,$Day,$Year));
		return $DataFinish;
	}

	//	Show the Count Down
	//	@public
	//	#return the string
	//	$appendMsgStart01 is the text before the DateCountdown when isn't passed
	//	$appendMsgStart02 is the text after the DateCountdown when isn't passed
	//	$appendMsgEnd01 is the text before the DateCountdown when is passed
	//	$appendMsgEnd02 is the text after the DateCountdown when is passed
	//	
	//	$appendMsgStart01 COUNTDOWN $appendMsgStart02 => Still COUNTDOWN for the event
	function showCountDown($appendMsgStart01="",$appendMsgStart02="",$appendMsgEnd1="",$appendMsgEnd2="",$display=1)	{

		//	Human readable format
		$endDate	= $this->GetDateFormat($this->endY."-".$this->endM."-".$this->endD);
		$year_until		= (int)((mktime ($this->endH,$this->endMn,$this->endS,$this->endM,$this->endD,$this->endY) - time())/31536000);
		$days_until		= (int)((mktime ($this->endH,$this->endMn,$this->endS,$this->endM,$this->endD,$this->endY) - time())/86400);
		$hours_until	= (int)((mktime ($this->endH,$this->endMn,$this->endS,$this->endM,$this->endD,$this->endY) - time())/3600);
		$minutes_until	= (int)((mktime ($this->endH,$this->endMn,$this->endS,$this->endM,$this->endD,$this->endY) - time())/60);
		$seconds_until	= (int)((mktime ($this->endH,$this->endMn,$this->endS,$this->endM,$this->endD,$this->endY) - time())/1);

		$hour_offset	= $hours_until;
		$minute_offset	= $minutes_until;

		//$year_until		= ($year_until < 0)	? 0 : $year_until;
		//$days_until		= $days_until + 1;
		$days_until -= $year_until * 365 ; 
		$hours_until	-= $days_until * 24;
		$minutes_until	-= $hour_offset * 60;
		$seconds_until	-= $minute_offset * 60;

		$before_since	= (int)((mktime ($this->endH,$this->endMn,$this->endS,$this->endM,$this->endD,$this->endY) - time())/1);
		$factor			= ($before_since < 0)	? -1 : 1;
		//echo $before_since."<br>".$factor."<br>";

		//	DISPLAY ONLY NECESSARY
		$yearTXT	= (abs($year_until) <= 0)		? "" : "".abs($year_until)." ".$this->yearsT.", ";
		$dayTXT		= (abs($days_until) <= 0)		? "" : "".abs($days_until)." ".$this->daysT.", ";
		$hoursTXT	= (abs($hours_until) <= 0)		? "" : "".abs($hours_until)." ".$this->hoursT.", ";
		$minTXT		= (abs($minutes_until) <= 0)	? "" : "".abs($minutes_until)." ".$this->minutesT;
		$secTXT		= (abs($seconds_until) <= 0)	? "" : "".abs($seconds_until)." ".$this->secondsT.", ";
    
		 $forMeYear = explode(' ' , $yearTXT) ; 
		 
		If ($forMeYear[0] > 1 )	{
			
			$msg = "Ended" ; 
			
		} 
		else if ($factor != -1){
			
			$msg	= " 
							".$yearTXT." 
							".$dayTXT." 
							".$hoursTXT." 
							".$minTXT."  
						";
			
		}
		else {
			$msg	= "Time Up";
		    $this->ended = true;
		}
		return $msg;
	}
	function diffDate ($date1, $date2=NULL) {
        // Returns diff between two dates in days // By JM, www.Timehole.com
        // If date2 is not set, diff is calculated from "now"
       $t1 = strtotime($date1);
       if ($date2==NULL) { $t2 = $t1; $t1 = time(); }
       else                $t2 = strtotime($date2);
    return ($t2-$t1)/86400; // difference of dates in days
    }

    function addDays ($days, $fmt="Y-m-d", $date=NULL) {
    // Adds days to date or from now  // By JM, www.Timehole.com
       if ($date==NULL) { $t1 = time(); }
       else               $t1 = strtotime($date);
       $t2 = $days * 86400; // make days to seconds
    return date($fmt,($t2+$t1));
    }

    function subtractDays ($days, $fmt="Y-m-d", $date=NULL) {
    // Subtracts days from date or from now
    return $this->addDays(-($days),$fmt,$date);
    }
}
?>
