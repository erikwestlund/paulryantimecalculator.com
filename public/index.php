
<html>
<head>
<title>The Original Paul Ryan Time Calculator</title>
<link rel="stylesheet" href="/style.css" type="text/css" />
<link rel="image_src" href="https://paulryantimecalculator.com/square_logo.png" />
<link rel="icon" type="image/png" href="https://paulryantimecalculator.com/favicon.png" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34543355-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=216114531780782";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>




<div class="header"><a href="https://www.paulryantimecalculator.com/"><img src="/logo.png" style="border: 0px;" /></a></div>

<div class="time_output">
<?php

$submitted = $_GET['submitted'] ?? null;
$time = trim($_GET['time']) ?? null;
$distance= $_GET['distance'] ?? null;
$gender = $_GET['gender'] ?? null;

$event = $distance . $gender;

if($submitted=='yes' && $distance=='ironman'){
	
	echo 'Your Ironman time cannot be calculated. <br /><br />';
	echo 'Paul Ryan doesn\'t do Ironmans. <strong>He is an Ironman!</strong><br /><br />';
	echo ' Here is a picture of him when he was 20:<br /><br />';
	echo '<img src="ironman.jpg" style="padding: 30px;" />';

} elseif($submitted=='yes') {
	$parsed_time = parse_time($time, $distance);
	$parsed_distance = parse_distance($distance);
	
	
	$world_record = get_wr($event);
	$parsed_wr = parse_time($world_record, $distance);
	$parsed_prc = parse_time($parsed_time['paulryan_display'], $distance, 'not');
	
	$wr_set = false;

	
	if($parsed_prc['total_seconds'] < $parsed_wr['total_seconds']) {
			$wr_set = true;
	} else {
		$wr_set = false;
		$diff =  ($parsed_prc['total_seconds'] - $parsed_wr['total_seconds']);

		if ($diff <= 1) {
			$time_differential = $parsed_prc['total_seconds'] - $parsed_wr['total_seconds'];
		} else {		
			$time_differential = sec2hms($parsed_prc['total_seconds'] - $parsed_wr['total_seconds']);			
		}

	}
	
	if($parsed_time != FALSE){


		echo '<strong>Your ' . $parsed_distance . ' time:</strong> ' . $parsed_time['actual_display']  . '<br />' . "\n";
		echo '<strong>Your Paul Ryan-adjusted ' . $parsed_distance . '  time:</strong> ' . $parsed_time['paulryan_display']  . '<br /><br /><br />' . "\n";

		if($gender == 'm') {
			$parsed_gender = 'Men';
		} elseif($gender == 'f') {
			$parsed_gender = 'Women';			
		}
		
		if($distance != 'other') {
			if($wr_set == true) {
				echo '<h3>Congratulations, you have set a new Paul Ryan-certified World Record!</h3><br /> Your time beats the past ' . $parsed_gender . '\'s World Record for ' . $parsed_distance . '  of ' . $world_record . '.<br /><br/ ></div><br /><br />' . "\n";			
				
			} else {
				echo 'The current ' . $parsed_gender . '\'s World Record for ' . $parsed_distance . '  is ' . $world_record . '.<br /><br /> Your Paul Ryan-adjusted time is only ' . $time_differential . ' away from a new Paul Ryan-certified world record!';
				
			}

		}

		
	} else {
		
		echo "Oops! Please enter a valid time.";
	}
	

	
}

?>
</div>

<div id="stylized" class="myform">
<form id="form" name="form" method="get" action="">
<input type="hidden" name="submitted" value="yes">
<label>Your Time
<span class="small">e.g., 4:01:25</span>
</label>
<input type="text" name="time" id="time" />

<label>Distance
<span class="small">Enter your race distance</span>
</label>

<select type="text" name="distance" id="distance">
<option value="100">100m</option>
<option value="200">200m</option>
<option value="400">400m</option>
<option value="800">800m</option>
<option value="1500">1,500m</option>
<option value="mile">1 Mile</option>
<option value="3000">3k</option>
<option value="2mile">2 Mile</option>
<option value="5000">5k</option>
<option value="10000">10k</option>
<option value="15k">15k</option>
<option value="10mile">10 mile</option>
<option value="20k">20k</option>
<option value="half">Half marathon</option>
<option value="marathon" selected>Marathon</option>
<option value="50k">50k</option>
<option value="50mile">50 Mile</option>
<option value="100k">100k</option>
<option value="100mile">100 Mile</option>
<option value="ironman">Ironman</option>
<option value="other">Other</option>
</select>


<label>Gender
<span class="small">Male or female?</span>
</label>

<select type="text" name="gender" id="gender">
<option value="m">Male</option>
<option value="f">Female</option>
</select>



<button type="submit">Calculate</button>
<div class="spacer"></div>

</form>
</div>

<?php

?>

<div style="text-align: center; padding-top: 40px;">


<a href="https://twitter.com/share" class="twitter-share-button" data-url="https://www.paulryantimecalculator.com/" data-hashtags="AreYouBetterOff">Tweet</a> 

<a href="http://pinterest.com/pin/create/button/?url=https%3A%2F%2Fwww.paulryantimecalculator.com&media=https%3A%2F%2Fwww.paulryantimecalculator.com%2Fsquare_logo.png" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>


</div>





<div style="text-align: center; padding: 30px 0px 40px 30px;">

<div class="fb-like" data-href="https://www.paulryantimecalculator.com/" data-send="true" data-width="450" data-show-faces="false"></div>



<div style="text-align: center; padding: 30px 0 50px 0">
<em>You ran that!</em><br /><br />
<a href="mailto:paulryantimecalculator@gmail.com">contact</a>
</div>


<div style="margin: auto; width: 950px; ">

<!--	<div style="float: left; width: 480px; padding: 0 20px 50px 0;"> -->
	
<a class="twitter-timeline" href="https://twitter.com/PaulRyanCalc" data-widget-id="243393735516364801">Tweets by @PaulRyanCalc</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

	
	<!--</div>
	
	
	<div style="float: right; width: 430px; padding-left: 20px;">


	
	</div>-->

</div>


</div>

</body>

</html>

<?php 

function parse_time($time, $distance = 'marathon', $submission = 'original'){
	
	$replace_array =array(':','.');
	$strip_colon_period = str_replace($replace_array, '', $time);
		
	if(!is_numeric($strip_colon_period)) {
		return FALSE;
	}	
	
	$exploded = explode(':', $time);
	$colon_count = count($exploded);
		
	if($colon_count > 3) {
		return FALSE;
	}			
		
	if(strlen($exploded[0]) == 1){
		$exploded[0] = '0' . $exploded[0];
	}	
	if(strlen($exploded[1]) == 1){
		$exploded[1] = '0' . $exploded[1];
	}	
	if(strlen($exploded[2]) == 1){
		$exploded[2] = '0' . $exploded[2];
	}	
	
	# hour:minute:second
	# minute:second
	
	if($colon_count==3) {
		$parsed_time['hours'] = $exploded[0];
		$parsed_time['minutes'] = $exploded[1];
		$parsed_time['seconds'] = $exploded[2];
		$parsed_time['actual_display'] = $exploded[0] . ':' . $exploded[1] . ':' . $exploded[2];
	} elseif ($colon_count==2) {
	
		if(($distance == 'marathon' || $distance == '50k' || $distance == '50mile' || $distance == '100k' || $distance == '100mile') && $submission == 'original') {
			$parsed_time['hours'] = $exploded[0];
			$parsed_time['minutes'] = $exploded[1];
			$parsed_time['seconds'] = 0;
			$parsed_time['actual_display'] = $exploded[0] . ':' . $exploded[1] . ':00';

		} else {
			$parsed_time['hours'] = 0;
			$parsed_time['minutes'] = $exploded[0];
			$parsed_time['seconds'] = $exploded[1];
			$parsed_time['actual_display'] = $exploded[0] . ':' . $exploded[1];							
		}

	} elseif($colon_count==1){
		$parsed_time['hours'] = 0;
		$parsed_time['minutes'] = 0;
		$parsed_time['seconds'] = $exploded[0];	
		$parsed_time['actual_display'] = $exploded[0];		
	} else {		
		return FALSE;
	}
	
	$hours_seconds = $parsed_time['hours'] * 60 * 60;
	$minutes_seconds = $parsed_time['minutes'] * 60;
		
	$parsed_time['total_seconds'] = $hours_seconds + $minutes_seconds + $parsed_time['seconds'];
		
	$paul_ryan_converted = $parsed_time['total_seconds'] * .725;

	
//	echo "ACTUAL: " . $parsed_time['total_seconds'] . " PRC: $paul_ryan_converted ";
	
	//echo "PRC LONG: $paul_ryan_converted";
	
	if($paul_ryan_converted <= 10) {
		$prc = round($paul_ryan_converted, 2);			
	} else {
		$prc = sec2hms($paul_ryan_converted);						
	}
	

	
	//echo "PRC: $prc";
	
	if($distance == 'marathon' || $distance == 'half' || $distance == '10mile' || $distance == '20k' ||  $distance == '50k' || $distance == '50mile' || $distance == '100k' || $distance == '100mile'){
		$explode_dot = explode('.', $prc);
		$return_time = $explode_dot[0];
	} else {
		$return_time = $prc;		
	}
	
	$parsed_time['paulryan_display'] = $return_time;

		
	//var_dump($parsed_time);
		
	return $parsed_time;
}

function parse_seconds($seconds){
	$exploded = explode('.', $time);
	$dot_count = count($exploded);

	if($dot_count==2) {
		$seconds = $exploded[1];
		$decimal = $exploded[0];
		
	} else {		
		return $seconds;
	}
	
}

function sec2hms ($sec, $padHours = false) 
{

// start with a blank string
$hms = "";

// do the hours first: there are 3600 seconds in an hour, so if we divide
// the total number of seconds by 3600 and throw away the remainder, we're
// left with the number of hours in those seconds
$hours = intval(intval($sec) / 3600); 

// add hours to $hms (with a leading 0 if asked for)
$hms .= ($padHours) 
      ? str_pad($hours, 2, "0", STR_PAD_LEFT). ":"
      : $hours. ":";

// dividing the total seconds by 60 will give us the number of minutes
// in total, but we're interested in *minutes past the hour* and to get
// this, we have to divide by 60 again and then use the remainder
$minutes = intval(($sec / 60) % 60); 

// add minutes to $hms (with a leading 0 if needed)
$hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";

// seconds past the minute are found by dividing the total number of seconds
// by 60 and using the remainder

$remainder = ($sec % 60);
$full = $sec - $remainder;
$seconds = round($sec - round($full), 2); 


if($seconds<10){
	$seconds = '0';	
}

// add seconds to $hms (with a leading 0 if needed)
$hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

$exploded = explode(':', $hms);

if($exploded[0] == 0) {

	if($exploded[1] == 0 ){
    	$hms = floatval($exploded[2]);
	} else {
    	$hms = intval($exploded[1]) . ':' . $exploded[2];	    
    }
    	
}

// done!
return $hms;

}

function parse_distance($distance) {
	
	
	$distance_value['100'] = '100m';
	$distance_value['200'] = '200m';
	$distance_value['400'] = '400m';		
	$distance_value['800'] = '800m';
	$distance_value['1500'] = '1,500m';
	$distance_value['mile'] = '1 Mile';		
	$distance_value['300'] = '3k';
	$distance_value['2mile'] = '2 Mile';		
	$distance_value['5000'] = '5k';
	$distance_value['10000'] = '10k';
	$distance_value['15k'] = '15k';
	$distance_value['20k'] = '20k';	
	$distance_value['10mile'] = '10 Mile';
	$distance_value['half'] = 'Half Marathon';
	$distance_value['marathon'] = 'Marathon';
	$distance_value['50k'] = '50k';	
	$distance_value['50mile'] = '50 Mile';
	$distance_value['100k'] = '100k';	
	$distance_value['100mile'] = '100 Mile';	
	$distance_value['other'] = '';	
	
	return $distance_value[$distance];
	
}

function get_wr($event){

	$world_records = array(
		'100m' => '9.58',
		'200m' => '19.19',
		'400m' => '43.03',
		'800m' => '1:40.91',
		'1500m' => '3:26.00',
		'milem' => '3:43.13',
		'3000m' => '7:20.67',
		'5000m' => '12:37.35',
		'10km' => '26:17.53',	
		'15km' => '41:13',
		'10milem' => '44:23',
		'20km' => '55:21',
		'halfm' => '58:23',
		'marathonm' => '2:02:57',
		'50km' => '2:43:38',
		'50milem' => '4:50:51',
		'100km' => '6:13:33',
		'100milem' => '11:46:37',		
		'100f' => '10.49',
		'200f' => '21.34',
		'400f' => '47.60',
		'800f' => '1:53.28',
		'1500f' => '3:50.07',
		'milef' => '4:12.56',
		'3000f' => '8:06.11',
		'5000f' => '14:11.15',
		'10kf' => '29:31.78',		
		'15kf' => '46:28',
		'10milef' => '50:05',
		'20kf' => '1:02:36',	
		'halff' => '1:05:50',
		'marathonf' => '2:15:25',
		'50kf' => '3:08:39',
		'50milef' => '5:40:18',
		'100kf' => '6:31:11',
		'100milef' => '13:47:41'	
	);

	return $world_records[$event];
	
}


?>