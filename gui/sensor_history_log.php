<?php
$GS_phueServiceBypass = true;
$GS_wemoServiceBypass = true;
$GS_mqttServiceBypass = true;
$GS_emailServiceBypass = false;
$GS_weatherServiceBypass = true;
$GS_squeezeBoxServiceBypass = true;
$GS_webIncludesIncluded = true;

require_once(realpath(__DIR__ ."/../System/API/SmartHome_API/DBConn.php"));

################## AUTOLOAD ####################
if($_GET['autoload']=="true"){
	$GS_phueServiceBypass = true;
	$GS_wemoServiceBypass = true;
	$GS_mqttServiceBypass = true;
	$GS_emailServiceBypass = true;
	$GS_squeezeBoxServiceBypass = true;
	$GS_webIncludesIncluded = false;
	
	$upParrentDir = '/../../..';
	require_once(realpath(__DIR__ ."/../System/API/SmartHome_API/IOTIncludes.php"));
	
	include("Autoload/AutoLoad_DataStates.php");
	include("Autoload/AutoLoad_SHAlerts.php");
	include("Autoload/Autoload_checkTempEncode.php");
	exit;	
}
################################################

#################### API #######################
$page_title="History Log - Sensors";
$upParrentDir = '/../../..';
require_once(realpath(__DIR__ ."/../System/API/SmartHome_API/IOTIncludes.php"));

################################################

	function getTimeDiffrence($date,$start,$end){
		$to_time = strtotime($date." ".$end);
		$from_time = strtotime($date." ".$start);
		return ((abs($to_time - $from_time) / 60)/60);
	}
	
?>

<div class="col-md-12" style="margin-bottom:30px;">	
	<h3 style="margin-bottom:10px;">Sensor History</h3>


	<?php
		// Find out how many items are in the table
		$total = mysqli_num_rows(mysqli_query($GS_DBCONN, 'SELECT * FROM  sensors'));
		// How many items to list per page
		$limit = 18;
		// How many pages will there be
		$pages = ceil($total / $limit);
		// What page are we currently on?
		$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array('options' => array('default'   => 1,'min_range' => 1))));
		// Calculate the offset for the query
		$offset = ($page - 1)  * $limit;
		// Some information to display to the user
		$start = $offset + 1;
		$end = min(($offset + $limit), $total);
		// The "back" link
		$prevlink = ($page > 1) ? "
		<a style='font-size:20px;color:#333;' href='?page=1' title='Next page'><i class='fa fa-step-backward'></i></a>&nbsp;
		<a style='font-size:25px;color:#333;' href='?page=".($page - 1)."' title='Last page'><i class='fa fa-caret-left'></i></a>"
		:"";
		// The "forward" link
		$nextlink = ($page < $pages) ? "
		<a style='font-size:25px;color:#333;' href='?page=".($page + 1)."' title='Next page'><i class='fa fa-caret-right'></i></a>&nbsp;
		<a style='font-size:20px;color:#333;' href='?page=".$pages."' title='Last page'><i class='fa fa-step-forward'></i></a>"
		:"";

	?>


	<form action="#" method="GET" style="width:100%;text-align:left;margin-bottom:20px;">
		<div class="input-group" style="width:100%;max-width:400px;display:inline-block;">
			<input style="max-width:300px;width:100%;" type="date" name="search" class="form-control1 input-search" placeholder="<?php echo date("m-d-Y");?>" value="<?php echo $_GET['search'];?>">
			<button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
		</div>
		<p style="text-align:center;"><b><?php echo $prevlink." Page ".$page." of ".$pages." ".$nextlink;?></b></p>
	</form>




	<div style="height: 811px;width:100%;margin-bottom:30px;overflow-x:auto;overflow-y:hidden;">
	   <div style="height: 100%;">
		  <svg height="811"  style="min-width:1500px;width:100%;">
			 <defs id="defs"></defs>
			 <g>
				<rect x="0" y="0" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#ffffff"></rect>
				<path d="M124,0L124,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,0L166.7877242476852,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,0L224.07939091435185,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,0L281.3710575810185,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,0L338.66272424768516,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,0L395.95439091435185,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,0L453.2460575810185,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,0L510.53772424768516,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,0L567.8293909143517,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,0L625.1210575810185,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,0L682.4127242476851,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,0L739.7043909143518,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,0L796.9960575810185,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,0L854.2877242476851,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,0L911.5793909143517,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,0L968.8710575810185,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,0L1026.1627242476852,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,0L1083.4543909143517,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,0L1140.7460575810185,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,0L1198.037724247685,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,0L1255.3293909143517,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,0L1312.6210575810185,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,0L1369.912724247685,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,0L1427.2043909143517,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,0L1484.4960575810185,40.992" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="40.992" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#e6e6e6"></rect>
				<path d="M124,40.992L124,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,40.992L166.7877242476852,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,40.992L224.07939091435185,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,40.992L281.3710575810185,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,40.992L338.66272424768516,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,40.992L395.95439091435185,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,40.992L453.2460575810185,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,40.992L510.53772424768516,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,40.992L567.8293909143517,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,40.992L625.1210575810185,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,40.992L682.4127242476851,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,40.992L739.7043909143518,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,40.992L796.9960575810185,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,40.992L854.2877242476851,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,40.992L911.5793909143517,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,40.992L968.8710575810185,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,40.992L1026.1627242476852,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,40.992L1083.4543909143517,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,40.992L1140.7460575810185,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,40.992L1198.037724247685,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,40.992L1255.3293909143517,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,40.992L1312.6210575810185,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,40.992L1369.912724247685,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,40.992L1427.2043909143517,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,40.992L1484.4960575810185,81.984" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="81.984" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#ffffff"></rect>
				<path d="M124,81.984L124,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,81.984L166.7877242476852,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,81.984L224.07939091435185,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,81.984L281.3710575810185,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,81.984L338.66272424768516,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,81.984L395.95439091435185,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,81.984L453.2460575810185,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,81.984L510.53772424768516,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,81.984L567.8293909143517,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,81.984L625.1210575810185,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,81.984L682.4127242476851,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,81.984L739.7043909143518,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,81.984L796.9960575810185,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,81.984L854.2877242476851,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,81.984L911.5793909143517,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,81.984L968.8710575810185,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,81.984L1026.1627242476852,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,81.984L1083.4543909143517,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,81.984L1140.7460575810185,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,81.984L1198.037724247685,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,81.984L1255.3293909143517,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,81.984L1312.6210575810185,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,81.984L1369.912724247685,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,81.984L1427.2043909143517,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,81.984L1484.4960575810185,122.976" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="122.976" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#e6e6e6"></rect>
				<path d="M124,122.976L124,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,122.976L166.7877242476852,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,122.976L224.07939091435185,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,122.976L281.3710575810185,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,122.976L338.66272424768516,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,122.976L395.95439091435185,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,122.976L453.2460575810185,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,122.976L510.53772424768516,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,122.976L567.8293909143517,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,122.976L625.1210575810185,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,122.976L682.4127242476851,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,122.976L739.7043909143518,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,122.976L796.9960575810185,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,122.976L854.2877242476851,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,122.976L911.5793909143517,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,122.976L968.8710575810185,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,122.976L1026.1627242476852,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,122.976L1083.4543909143517,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,122.976L1140.7460575810185,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,122.976L1198.037724247685,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,122.976L1255.3293909143517,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,122.976L1312.6210575810185,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,122.976L1369.912724247685,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,122.976L1427.2043909143517,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,122.976L1484.4960575810185,163.968" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="163.968" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#ffffff"></rect>
				<path d="M124,163.968L124,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,163.968L166.7877242476852,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,163.968L224.07939091435185,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,163.968L281.3710575810185,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,163.968L338.66272424768516,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,163.968L395.95439091435185,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,163.968L453.2460575810185,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,163.968L510.53772424768516,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,163.968L567.8293909143517,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,163.968L625.1210575810185,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,163.968L682.4127242476851,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,163.968L739.7043909143518,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,163.968L796.9960575810185,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,163.968L854.2877242476851,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,163.968L911.5793909143517,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,163.968L968.8710575810185,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,163.968L1026.1627242476852,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,163.968L1083.4543909143517,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,163.968L1140.7460575810185,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,163.968L1198.037724247685,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,163.968L1255.3293909143517,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,163.968L1312.6210575810185,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,163.968L1369.912724247685,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,163.968L1427.2043909143517,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,163.968L1484.4960575810185,204.95999999999998" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="204.95999999999998" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#e6e6e6"></rect>
				<path d="M124,204.95999999999998L124,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,204.95999999999998L166.7877242476852,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,204.95999999999998L224.07939091435185,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,204.95999999999998L281.3710575810185,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,204.95999999999998L338.66272424768516,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,204.95999999999998L395.95439091435185,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,204.95999999999998L453.2460575810185,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,204.95999999999998L510.53772424768516,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,204.95999999999998L567.8293909143517,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,204.95999999999998L625.1210575810185,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,204.95999999999998L682.4127242476851,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,204.95999999999998L739.7043909143518,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,204.95999999999998L796.9960575810185,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,204.95999999999998L854.2877242476851,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,204.95999999999998L911.5793909143517,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,204.95999999999998L968.8710575810185,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,204.95999999999998L1026.1627242476852,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,204.95999999999998L1083.4543909143517,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,204.95999999999998L1140.7460575810185,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,204.95999999999998L1198.037724247685,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,204.95999999999998L1255.3293909143517,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,204.95999999999998L1312.6210575810185,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,204.95999999999998L1369.912724247685,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,204.95999999999998L1427.2043909143517,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,204.95999999999998L1484.4960575810185,245.95199999999997" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="245.95199999999997" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#ffffff"></rect>
				<path d="M124,245.95199999999997L124,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,245.95199999999997L166.7877242476852,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,245.95199999999997L224.07939091435185,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,245.95199999999997L281.3710575810185,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,245.95199999999997L338.66272424768516,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,245.95199999999997L395.95439091435185,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,245.95199999999997L453.2460575810185,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,245.95199999999997L510.53772424768516,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,245.95199999999997L567.8293909143517,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,245.95199999999997L625.1210575810185,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,245.95199999999997L682.4127242476851,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,245.95199999999997L739.7043909143518,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,245.95199999999997L796.9960575810185,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,245.95199999999997L854.2877242476851,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,245.95199999999997L911.5793909143517,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,245.95199999999997L968.8710575810185,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,245.95199999999997L1026.1627242476852,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,245.95199999999997L1083.4543909143517,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,245.95199999999997L1140.7460575810185,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,245.95199999999997L1198.037724247685,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,245.95199999999997L1255.3293909143517,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,245.95199999999997L1312.6210575810185,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,245.95199999999997L1369.912724247685,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,245.95199999999997L1427.2043909143517,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,245.95199999999997L1484.4960575810185,286.94399999999996" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="286.94399999999996" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#e6e6e6"></rect>
				<path d="M124,286.94399999999996L124,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,286.94399999999996L166.7877242476852,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,286.94399999999996L224.07939091435185,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,286.94399999999996L281.3710575810185,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,286.94399999999996L338.66272424768516,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,286.94399999999996L395.95439091435185,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,286.94399999999996L453.2460575810185,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,286.94399999999996L510.53772424768516,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,286.94399999999996L567.8293909143517,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,286.94399999999996L625.1210575810185,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,286.94399999999996L682.4127242476851,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,286.94399999999996L739.7043909143518,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,286.94399999999996L796.9960575810185,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,286.94399999999996L854.2877242476851,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,286.94399999999996L911.5793909143517,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,286.94399999999996L968.8710575810185,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,286.94399999999996L1026.1627242476852,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,286.94399999999996L1083.4543909143517,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,286.94399999999996L1140.7460575810185,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,286.94399999999996L1198.037724247685,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,286.94399999999996L1255.3293909143517,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,286.94399999999996L1312.6210575810185,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,286.94399999999996L1369.912724247685,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,286.94399999999996L1427.2043909143517,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,286.94399999999996L1484.4960575810185,327.936" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="327.936" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#ffffff"></rect>
				<path d="M124,327.936L124,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,327.936L166.7877242476852,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,327.936L224.07939091435185,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,327.936L281.3710575810185,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,327.936L338.66272424768516,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,327.936L395.95439091435185,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,327.936L453.2460575810185,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,327.936L510.53772424768516,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,327.936L567.8293909143517,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,327.936L625.1210575810185,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,327.936L682.4127242476851,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,327.936L739.7043909143518,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,327.936L796.9960575810185,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,327.936L854.2877242476851,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,327.936L911.5793909143517,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,327.936L968.8710575810185,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,327.936L1026.1627242476852,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,327.936L1083.4543909143517,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,327.936L1140.7460575810185,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,327.936L1198.037724247685,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,327.936L1255.3293909143517,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,327.936L1312.6210575810185,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,327.936L1369.912724247685,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,327.936L1427.2043909143517,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,327.936L1484.4960575810185,368.928" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="368.928" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#e6e6e6"></rect>
				<path d="M124,368.928L124,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,368.928L166.7877242476852,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,368.928L224.07939091435185,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,368.928L281.3710575810185,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,368.928L338.66272424768516,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,368.928L395.95439091435185,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,368.928L453.2460575810185,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,368.928L510.53772424768516,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,368.928L567.8293909143517,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,368.928L625.1210575810185,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,368.928L682.4127242476851,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,368.928L739.7043909143518,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,368.928L796.9960575810185,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,368.928L854.2877242476851,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,368.928L911.5793909143517,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,368.928L968.8710575810185,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,368.928L1026.1627242476852,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,368.928L1083.4543909143517,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,368.928L1140.7460575810185,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,368.928L1198.037724247685,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,368.928L1255.3293909143517,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,368.928L1312.6210575810185,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,368.928L1369.912724247685,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,368.928L1427.2043909143517,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,368.928L1484.4960575810185,409.92" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="409.92" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#ffffff"></rect>
				<path d="M124,409.92L124,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,409.92L166.7877242476852,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,409.92L224.07939091435185,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,409.92L281.3710575810185,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,409.92L338.66272424768516,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,409.92L395.95439091435185,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,409.92L453.2460575810185,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,409.92L510.53772424768516,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,409.92L567.8293909143517,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,409.92L625.1210575810185,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,409.92L682.4127242476851,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,409.92L739.7043909143518,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,409.92L796.9960575810185,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,409.92L854.2877242476851,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,409.92L911.5793909143517,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,409.92L968.8710575810185,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,409.92L1026.1627242476852,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,409.92L1083.4543909143517,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,409.92L1140.7460575810185,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,409.92L1198.037724247685,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,409.92L1255.3293909143517,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,409.92L1312.6210575810185,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,409.92L1369.912724247685,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,409.92L1427.2043909143517,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,409.92L1484.4960575810185,450.91200000000003" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="450.91200000000003" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#e6e6e6"></rect>
				<path d="M124,450.91200000000003L124,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,450.91200000000003L166.7877242476852,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,450.91200000000003L224.07939091435185,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,450.91200000000003L281.3710575810185,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,450.91200000000003L338.66272424768516,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,450.91200000000003L395.95439091435185,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,450.91200000000003L453.2460575810185,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,450.91200000000003L510.53772424768516,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,450.91200000000003L567.8293909143517,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,450.91200000000003L625.1210575810185,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,450.91200000000003L682.4127242476851,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,450.91200000000003L739.7043909143518,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,450.91200000000003L796.9960575810185,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,450.91200000000003L854.2877242476851,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,450.91200000000003L911.5793909143517,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,450.91200000000003L968.8710575810185,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,450.91200000000003L1026.1627242476852,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,450.91200000000003L1083.4543909143517,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,450.91200000000003L1140.7460575810185,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,450.91200000000003L1198.037724247685,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,450.91200000000003L1255.3293909143517,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,450.91200000000003L1312.6210575810185,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,450.91200000000003L1369.912724247685,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,450.91200000000003L1427.2043909143517,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,450.91200000000003L1484.4960575810185,491.90400000000005" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="491.90400000000005" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#ffffff"></rect>
				<path d="M124,491.90400000000005L124,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,491.90400000000005L166.7877242476852,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,491.90400000000005L224.07939091435185,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,491.90400000000005L281.3710575810185,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,491.90400000000005L338.66272424768516,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,491.90400000000005L395.95439091435185,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,491.90400000000005L453.2460575810185,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,491.90400000000005L510.53772424768516,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,491.90400000000005L567.8293909143517,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,491.90400000000005L625.1210575810185,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,491.90400000000005L682.4127242476851,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,491.90400000000005L739.7043909143518,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,491.90400000000005L796.9960575810185,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,491.90400000000005L854.2877242476851,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,491.90400000000005L911.5793909143517,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,491.90400000000005L968.8710575810185,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,491.90400000000005L1026.1627242476852,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,491.90400000000005L1083.4543909143517,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,491.90400000000005L1140.7460575810185,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,491.90400000000005L1198.037724247685,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,491.90400000000005L1255.3293909143517,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,491.90400000000005L1312.6210575810185,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,491.90400000000005L1369.912724247685,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,491.90400000000005L1427.2043909143517,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,491.90400000000005L1484.4960575810185,532.8960000000001" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="532.8960000000001" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#e6e6e6"></rect>
				<path d="M124,532.8960000000001L124,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,532.8960000000001L166.7877242476852,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,532.8960000000001L224.07939091435185,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,532.8960000000001L281.3710575810185,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,532.8960000000001L338.66272424768516,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,532.8960000000001L395.95439091435185,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,532.8960000000001L453.2460575810185,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,532.8960000000001L510.53772424768516,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,532.8960000000001L567.8293909143517,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,532.8960000000001L625.1210575810185,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,532.8960000000001L682.4127242476851,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,532.8960000000001L739.7043909143518,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,532.8960000000001L796.9960575810185,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,532.8960000000001L854.2877242476851,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,532.8960000000001L911.5793909143517,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,532.8960000000001L968.8710575810185,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,532.8960000000001L1026.1627242476852,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,532.8960000000001L1083.4543909143517,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,532.8960000000001L1140.7460575810185,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,532.8960000000001L1198.037724247685,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,532.8960000000001L1255.3293909143517,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,532.8960000000001L1312.6210575810185,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,532.8960000000001L1369.912724247685,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,532.8960000000001L1427.2043909143517,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,532.8960000000001L1484.4960575810185,573.888" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="573.888" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#ffffff"></rect>
				<path d="M124,573.888L124,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,573.888L166.7877242476852,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,573.888L224.07939091435185,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,573.888L281.3710575810185,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,573.888L338.66272424768516,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,573.888L395.95439091435185,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,573.888L453.2460575810185,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,573.888L510.53772424768516,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,573.888L567.8293909143517,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,573.888L625.1210575810185,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,573.888L682.4127242476851,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,573.888L739.7043909143518,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,573.888L796.9960575810185,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,573.888L854.2877242476851,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,573.888L911.5793909143517,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,573.888L968.8710575810185,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,573.888L1026.1627242476852,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,573.888L1083.4543909143517,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,573.888L1140.7460575810185,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,573.888L1198.037724247685,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,573.888L1255.3293909143517,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,573.888L1312.6210575810185,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,573.888L1369.912724247685,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,573.888L1427.2043909143517,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,573.888L1484.4960575810185,614.88" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="614.88" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#e6e6e6"></rect>
				<path d="M124,614.88L124,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,614.88L166.7877242476852,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,614.88L224.07939091435185,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,614.88L281.3710575810185,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,614.88L338.66272424768516,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,614.88L395.95439091435185,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,614.88L453.2460575810185,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,614.88L510.53772424768516,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,614.88L567.8293909143517,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,614.88L625.1210575810185,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,614.88L682.4127242476851,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,614.88L739.7043909143518,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,614.88L796.9960575810185,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,614.88L854.2877242476851,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,614.88L911.5793909143517,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,614.88L968.8710575810185,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,614.88L1026.1627242476852,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,614.88L1083.4543909143517,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,614.88L1140.7460575810185,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,614.88L1198.037724247685,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,614.88L1255.3293909143517,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,614.88L1312.6210575810185,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,614.88L1369.912724247685,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,614.88L1427.2043909143517,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,614.88L1484.4960575810185,655.872" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<rect x="0" y="655.872" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#ffffff"></rect>
				<path d="M124,655.872L124,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,655.872L166.7877242476852,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,655.872L224.07939091435185,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,655.872L281.3710575810185,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,655.872L338.66272424768516,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,655.872L395.95439091435185,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,655.872L453.2460575810185,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,655.872L510.53772424768516,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,655.872L567.8293909143517,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,655.872L625.1210575810185,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,655.872L682.4127242476851,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,655.872L739.7043909143518,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,655.872L796.9960575810185,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,655.872L854.2877242476851,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,655.872L911.5793909143517,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,655.872L968.8710575810185,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,655.872L1026.1627242476852,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,655.872L1083.4543909143517,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,655.872L1140.7460575810185,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,655.872L1198.037724247685,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,655.872L1255.3293909143517,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,655.872L1312.6210575810185,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,655.872L1369.912724247685,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,655.872L1427.2043909143517,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,655.872L1484.4960575810185,696.8639999999999" stroke="#e6e6e6" stroke-width="1" fill-opacity="1" fill="none"></path>
				
				<rect x="0" y="696.8639999999999" width="1499" height="40.992" stroke="none" stroke-width="0" fill="#e6e6e6"></rect>
				<path d="M124,696.8639999999999L124,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M166.7877242476852,696.8639999999999L166.7877242476852,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M224.07939091435185,696.8639999999999L224.07939091435185,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M281.3710575810185,696.8639999999999L281.3710575810185,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M338.66272424768516,696.8639999999999L338.66272424768516,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M395.95439091435185,696.8639999999999L395.95439091435185,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M453.2460575810185,696.8639999999999L453.2460575810185,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M510.53772424768516,696.8639999999999L510.53772424768516,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M567.8293909143517,696.8639999999999L567.8293909143517,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M625.1210575810185,696.8639999999999L625.1210575810185,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M682.4127242476851,696.8639999999999L682.4127242476851,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M739.7043909143518,696.8639999999999L739.7043909143518,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M796.9960575810185,696.8639999999999L796.9960575810185,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M854.2877242476851,696.8639999999999L854.2877242476851,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M911.5793909143517,696.8639999999999L911.5793909143517,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M968.8710575810185,696.8639999999999L968.8710575810185,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1026.1627242476852,696.8639999999999L1026.1627242476852,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1083.4543909143517,696.8639999999999L1083.4543909143517,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1140.7460575810185,696.8639999999999L1140.7460575810185,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1198.037724247685,696.8639999999999L1198.037724247685,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1255.3293909143517,696.8639999999999L1255.3293909143517,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1312.6210575810185,696.8639999999999L1312.6210575810185,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1369.912724247685,696.8639999999999L1369.912724247685,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1427.2043909143517,696.8639999999999L1427.2043909143517,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M1484.4960575810185,696.8639999999999L1484.4960575810185,737.8559999999999" stroke="#ffffff" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,40.992L1499,40.992" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,81.984L1499,81.984" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,122.976L1499,122.976" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,163.968L1499,163.968" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,204.95999999999998L1499,204.95999999999998" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,245.95199999999997L1499,245.95199999999997" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,286.94399999999996L1499,286.94399999999996" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,327.936L1499,327.936" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,368.928L1499,368.928" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,409.92L1499,409.92" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,450.91200000000003L1499,450.91200000000003" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,491.90400000000005L1499,491.90400000000005" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,532.8960000000001L1499,532.8960000000001" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,573.888L1499,573.888" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,614.88L1499,614.88" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,655.872L1499,655.872" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				<path d="M0,696.8639999999999L1499,696.8639999999999" stroke="#b7b7b7" stroke-width="1" fill-opacity="1" fill="none"></path>
				
				
				
				
				
				<?php
					$count = 0;
					$query = "SELECT * FROM sensors ORDER BY room ASC LIMIT ".$limit." OFFSET ".$offset;
					$results = mysqli_query($GS_DBCONN, $query);
					while($sensor = mysqli_fetch_assoc($results)) { $count++;
				
						if ($count ==1){
							$y = 25.046;	
						}else{
							$y = 39.2 * $count;
						}
				?>
					 <text text-anchor="end" x="111" y="<?php echo $y;?>" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#4d4d4d"><?php echo $sensor['sensor_name'];?></text>
				<?php } if($count==0):?>
					<text text-anchor="end" x="120" y="25" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#4d4d4d">No Sensors Found</text>
				<?php endif;?>

				<rect x="0" y="0" width="1499" height="737.8559999999999" stroke="#9a9a9a" stroke-width="1" fill-opacity="1" fill="none"></rect>
			 </g>
			 <g>
				<text text-anchor="middle" x="166.7877242476852" y="1758.9059999999998" font-family="Arial" font-size="13" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">1:00a</text> 
				<text text-anchor="middle" x="224.07939091435185" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">2:00a</text>
				<text text-anchor="middle" x="281.3710575810185" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">3:00a</text>
				<text text-anchor="middle" x="338.66272424768516" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">4:00a</text>
				<text text-anchor="middle" x="395.95439091435185" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">5:00a</text>
				<text text-anchor="middle" x="453.2460575810185" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">6:00a</text>
				<text text-anchor="middle" x="510.53772424768516" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">7:00a</text>
				<text text-anchor="middle" x="567.8293909143517" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">8:00a</text>
				<text text-anchor="middle" x="625.1210575810185" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">9:00a</text>
				<text text-anchor="middle" x="682.4127242476851" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">10:00a</text>
				<text text-anchor="middle" x="739.7043909143518" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">11:00a</text>
				<text text-anchor="middle" x="796.9960575810185" y="758.9059999999998" font-family="Arial" font-size="13" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">12:00a</text>
				<text text-anchor="middle" x="854.2877242476851" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">1:00p</text>
				<text text-anchor="middle" x="911.5793909143517" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">2:00p</text>
				<text text-anchor="middle" x="968.8710575810185" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">3:00p</text>
				<text text-anchor="middle" x="1026.1627242476852" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">4:00p</text>
				<text text-anchor="middle" x="1083.4543909143517" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">5:00p</text>
				<text text-anchor="middle" x="1140.7460575810185" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">6:00p</text>
				<text text-anchor="middle" x="1198.037724247685" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">7:00p</text>
				<text text-anchor="middle" x="1255.3293909143517" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">8:00p</text>
				<text text-anchor="middle" x="1312.6210575810185" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">9:00p</text>
				<text text-anchor="middle" x="1369.912724247685" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">10:00p</text>
				<text text-anchor="middle" x="1427.2043909143517" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" stroke-width="0" fill="#000000">11:00p</text>
				<text text-anchor="end" x="1500.4960575810185" y="758.9059999999998" font-family="Arial" font-size="13" stroke="none" font-weight="bold" stroke-width="0" fill="#000000">12:00p</text>
			 </g>
			 <g></g>
			 <g>
				<?php if($_GET['search']!=""){

						$date = date("Y-m-d", strtotime(str_replace("-","/",$_GET['search'])));
					}else{
						$date = date("Y-m-d");
					}
				?>
				
				<!--- 57.3 * (x-1) )+40 = x = # of hours -->
				<?php
					$count = 0;
					$query = "SELECT * FROM sensors ORDER BY room ASC LIMIT ".$limit." OFFSET ".$offset;
					$results = mysqli_query($GS_DBCONN, $query);
					while($device = mysqli_fetch_assoc($results)) { $count++;
						
						if($count == 1){
							$prev1 = 9;
							$prev2 = 24.695999999999998;
						}else{
							$prev1 = 9 + (40.992 * ($count-1));
							$prev2 = 24.695999999999998 + (40.992 * ($count-1));
						}
						
						$logCount = 0;
						$query    = "SELECT * FROM history_log WHERE device_id='".$device['ID']."' AND date_added='".$date."' AND device_type='sensor' ORDER BY ID ASC ";
						$logs = mysqli_query($GS_DBCONN, $query);
						while ($log = mysqli_fetch_assoc($logs)) { 
							
							//get off times
							$query    = "SELECT * FROM history_log WHERE device_id='".$device['ID']."' AND date_added='".$date."' AND ID < '".$log['ID']."' AND device_type='sensor' ORDER BY ID DESC LIMIT 1";
							$prevLogs = mysqli_query($GS_DBCONN, $query);
							$prevLogCount = mysqli_num_rows($prevLogs);
							$prevLog = mysqli_fetch_assoc($prevLogs);
							
							if($prevLogCount>0){
								$startTimeOff = $prevLog['endTime'];
								$endTimeOff = $log['startTime'];
								$showOff = "1";
							}else{
								$startTimeOff = "00:00:00";
								$endTimeOff = $log['startTime'];
								$showOff = "1";	
							}
							
							
					
							
							$startTimeOn = $log['startTime'];
							if($log['endTime']!=""){
								$endTimeOn = $log['endTime'];
							}else{
								//only show time if on todats date
								if($date == date("Y-m-d")){
									$endTimeOn = date("H:i:s");
								}else{
									$endTimeOn = "24:00:00";
								}	
							}
							
							
							
						
							$hoursOn = getTimeDiffrence($date,$startTimeOn,$endTimeOn);
							$hoursOff = getTimeDiffrence($date,$startTimeOff,$endTimeOff);
							//lastest Off time
							if($date == date("Y-m-d")){
								$hoursLatestOff = getTimeDiffrence($date,$log['endTime'],date("H:i:s"));
							}else{
								$hoursLatestOff = getTimeDiffrence($date,$log['endTime'],"24:00:00");
							}
							$widthLatestOff = (57.3 * ($hoursLatestOff));
							if($widthLatestOff<35){ $hideTextLatest = true;}else{$hideTextLatest = false;}
							
							//on
							if($logCount==0) {
								$widthOn =  (57.3 * ($hoursOn));
							}else{
								$widthOn = (57.3 * ($hoursOn));
							}
							//off
							if($logCount==0) {
								$widthOff =  41+ (57.3 * ($hoursOff-1));
							}else{
								$widthOff = (57.3 * ($hoursOff));
							}
							
							
							if($widthOn<25){ $hideTextOn = true;}else{$hideTextOn = false;}
							if($widthOff<25){ $hideTextOff = true;}else{$hideTextOff = false;}
							if($logCount==0){$x ="125";} //align the first entry to the orgin
							?>
								<?php if ($showOff == "1") :?>
									<rect x="<?php echo $x;?>" y="<?php echo $prev1;?>" width="<?php echo $widthOff;?>" height="22.991999999999997" stroke="none" stroke-width="0" fill="<?php echo $GS_Config['themeColorSub'];?>"></rect>
									<text text-anchor="start" x="<?php echo $x+10;?>" y="<?php echo $prev2;?>" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff"><?php if($hideTextOff==false):?>inactive<?php endif;?></text>
									<?php $x=$x + ($widthOff);?>
								<?php endif;?>
								
								<rect x="<?php echo $x;?>" y="<?php echo $prev1;?>" width="<?php echo $widthOn;?>" height="22.991999999999997" stroke="none" stroke-width="0" fill="#ef553a"></rect>
								<text text-anchor="start" x="<?php echo $x+10;?>" y="<?php echo $prev2;?>" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff"><?php if($hideTextOn==false):?>active<?php endif;?></text>
								<?php $x=$x + ($widthOn);$logCount++;?>
								
								<?php if ($log['endTime']!=""){$showLatestOff = true;}else{$showLatestOff = false;}?>
					<?php }?>
						<?php if($showLatestOff == true):?>
						  <rect x="<?php echo $x;?>" y="<?php echo $prev1;?>" width="<?php echo $widthLatestOff;?>" height="22.991999999999997" stroke="none" stroke-width="0" fill="<?php echo $GS_Config['themeColorSub'];?>"></rect>
						  <text text-anchor="start" x="<?php echo $x+10;?>" y="<?php echo $prev2;?>" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#ffffff"><?php if($hideTextLatest==false):?>inactive<?php endif;?></text>
						<?php endif;?>
				<?php }?>
				

		
			  </g>
			 <g></g>
			 <g></g>
			 <g></g>
			 <g></g>
			 
		  </svg>
	   </div>
    </div>

    <?php include("includes/footer.php");?>
</div>
</div>
<?php include("includes/modals.php");?>

</body>
</html>


<!--

      <state-history-chart-line class="style-scope state-history-charts" style="display: block;">
         <div style="position: relative;">
            <div dir="ltr" style="position: relative; width: 1484px; height: 200px;">
               <div aria-label="A chart." style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;">
                  <svg width="1484" height="200" aria-label="A chart." style="overflow: hidden;">
                     <defs id="defs">
                        <clipPath id="_ABSTRACT_RENDERER_ID_0">
                           <rect x="60" y="38" width="1410" height="124"></rect>
                        </clipPath>
                     </defs>
                     <rect x="0" y="0" width="1484" height="200" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                     <g>
                        <rect x="60" y="15" width="557" height="15" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                        <g>
                           <rect x="60" y="15" width="117" height="15" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                           <g>
                              <text text-anchor="start" x="96" y="27.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#222222">temperature</text>
                           </g>
                           <path d="M60,22.5L90,22.5" stroke="#3366cc" stroke-width="2" fill-opacity="1" fill="none"></path>
                        </g>
                        <g>
                           <rect x="201" y="15" width="200" height="15" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                           <g>
                              <text text-anchor="start" x="237" y="27.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#222222">nest current temperature</text>
                           </g>
                           <path d="M201,22.5L231,22.5" stroke="#dc3912" stroke-width="2" fill-opacity="1" fill="none"></path>
                        </g>
                        <g>
                           <rect x="425" y="15" width="192" height="15" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                           <g>
                              <text text-anchor="start" x="461" y="27.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#222222">nest target temperature</text>
                           </g>
                           <path d="M425,22.5L455,22.5" stroke="#ff9900" stroke-width="2" fill-opacity="1" fill="none"></path>
                        </g>
                     </g>
                     <g>
                        <rect x="60" y="38" width="1410" height="124" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                        <g >
                           <g>
                              <rect x="163" y="38" width="1" height="124" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="397" y="38" width="1" height="124" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="632" y="38" width="1" height="124" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="867" y="38" width="1" height="124" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="1102" y="38" width="1" height="124" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="1337" y="38" width="1" height="124" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="60" y="161" width="1410" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="60" y="130" width="1410" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="60" y="100" width="1410" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="60" y="69" width="1410" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="60" y="38" width="1410" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                           </g>
                           <g>
							  <!-- blue --
                              <path d="M60.5,110.25L276.2157799768519,69.25L474.0377818055556,89.75L590.7545309837964,110.25L780.7067948842594,100L1469.5000000000002,100" stroke="#3366cc" stroke-width="2" fill-opacity="1" fill="none"></path>
                              <!-- yellow --
							  <path d="M60.50001630787037,141L250.896098900463,120.5L350.7846098726852,130.75L563.0351793981482,141L843.7421117708334,151.25L1469.5000000000002,151.25" stroke="#dc3912" stroke-width="2" fill-opacity="1" fill="none"></path>
							  <!-- red --                          
							  <path d="M60.50001630787037,110.25L250.896098900463,110.25L250.896098900463,110.25L350.7846098726852,110.25L350.7846098726852,141L563.0351793981482,141L563.0351793981482,141L843.7421117708334,141L843.7421117708334,141L1469.5000000000002,141" stroke="#ff9900" stroke-width="2" fill-opacity="1" fill="none"></path>
                           </g>
                        </g>
                        <g></g>
                        <g>
                           <g>
                              <text text-anchor="middle" x="163.05409761574074" y="183.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">12:00</text>
                           </g>
                           <g>
                              <text text-anchor="middle" x="397.8874309490741" y="183.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">16:00</text>
                           </g>
                           <g>
                              <text text-anchor="middle" x="632.7207642824075" y="183.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">20:00</text>
                           </g>
                           <g>
                              <text text-anchor="middle" x="867.5540976157408" y="183.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">0:00</text>
                           </g>
                           <g>
                              <text text-anchor="middle" x="1102.387430949074" y="183.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">4:00</text>
                           </g>
                           <g>
                              <text text-anchor="middle" x="1337.2207642824076" y="183.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">8:00</text>
                           </g>
                           <g>
                              <text text-anchor="end" x="50.666666666666664" y="166.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">18</text>
                           </g>
                           <g>
                              <text text-anchor="end" x="50.666666666666664" y="136" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">21</text>
                           </g>
                           <g>
                              <text text-anchor="end" x="50.666666666666664" y="105.25" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">24</text>
                           </g>
                           <g>
                              <text text-anchor="end" x="50.666666666666664" y="74.5" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">27</text>
                           </g>
                           <g>
                              <text text-anchor="end" x="50.666666666666664" y="43.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">30</text>
                           </g>
                        </g>
                     </g>
                     <g>
                        <g>
                           <text text-anchor="middle" x="22.083333333333332" y="100" font-family="Arial" font-size="15" font-style="italic" transform="rotate(-90 22.083333333333332 100)" stroke="none" stroke-width="0" fill="#222222">°C</text>
                           <path d="M9.333333333333329,162L9.333333333333337,38L24.333333333333336,38L24.33333333333333,162Z" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></path>
                        </g>
                     </g>
                     <g></g>
                  </svg>
                  <div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;">
                     <table>
                        <thead>
                           <tr>
                              <th>Time</th>
                              <th>temperature</th>
                              <th>nest current temperature</th>
                              <th>nest target temperature</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Nov 18, 2016, 10:15:11 AM</td>
                              <td>23</td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 10:15:11 AM</td>
                              <td></td>
                              <td>20</td>
                              <td>23</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 1:29:46 PM</td>
                              <td></td>
                              <td></td>
                              <td>23</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 1:29:46 PM</td>
                              <td></td>
                              <td>22</td>
                              <td>23</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 1:55:39 PM</td>
                              <td>27</td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 3:11:51 PM</td>
                              <td></td>
                              <td></td>
                              <td>23</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 3:11:51 PM</td>
                              <td></td>
                              <td>21</td>
                              <td>20</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 5:17:49 PM</td>
                              <td>25</td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 6:48:46 PM</td>
                              <td></td>
                              <td></td>
                              <td>20</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 6:48:46 PM</td>
                              <td></td>
                              <td>20</td>
                              <td>20</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 7:17:06 PM</td>
                              <td>23</td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 10:31:14 PM</td>
                              <td>24</td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 11:35:39 PM</td>
                              <td></td>
                              <td></td>
                              <td>20</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 11:35:39 PM</td>
                              <td></td>
                              <td>19</td>
                              <td>20</td>
                           </tr>
                           <tr>
                              <td>Nov 19, 2016, 10:15:11 AM</td>
                              <td>24</td>
                              <td>19</td>
                              <td>20</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div aria-hidden="true" style="display: none; position: absolute; top: 210px; left: 1494px; white-space: nowrap; font-family: Arial; font-size: 15px;">nest target temperature</div>
            <div></div>
         </div>
      </state-history-chart-line>
      <state-history-chart-line class="style-scope state-history-charts" style="display: block;">
         <div style="position: relative;">
            <div dir="ltr" style="position: relative; width: 1484px; height: 200px;">
               <div aria-label="A chart." style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;">
                  <svg width="1484" height="200" aria-label="A chart." style="overflow: hidden;">
                     <defs id="defs">
                        <clipPath id="_ABSTRACT_RENDERER_ID_1">
                           <rect x="60" y="38" width="1410" height="124"></rect>
                        </clipPath>
                     </defs>
                     <rect x="0" y="0" width="1484" height="200" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                     <g>
                        <rect x="60" y="15" width="92" height="15" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                        <g>
                           <rect x="60" y="15" width="92" height="15" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                           <g>
                              <text text-anchor="start" x="96" y="27.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#222222">humidity</text>
                           </g>
                           <path d="M60,22.5L90,22.5" stroke="#3366cc" stroke-width="2" fill-opacity="1" fill="none"></path>
                        </g>
                     </g>
                     <g>
                        <rect x="60" y="38" width="1410" height="124" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                        <g clip-path="">
                           <g>
                              <rect x="163" y="38" width="1" height="124" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="397" y="38" width="1" height="124" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="632" y="38" width="1" height="124" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="867" y="38" width="1" height="124" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="1102" y="38" width="1" height="124" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="1337" y="38" width="1" height="124" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="60" y="161" width="1410" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="60" y="130" width="1410" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="60" y="100" width="1410" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="60" y="69" width="1410" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                              <rect x="60" y="38" width="1410" height="1" stroke="none" stroke-width="0" fill="#cccccc"></rect>
                           </g>
                           <g>
							<!-- Blue --
                              <path d="M60.5
							  ,123.0625L211.2943763425926
							  ,92.3125L312.2865061342593
							  ,69.25L425.52989092592594
							  ,92.3125L542.9334786805556
							  ,69.25L585.3333545601853
							  ,92.3125L695.9367397569445
							  ,123.0625L799.1812473726852
							  ,146.125L1469.5000000000002
							  ,146.125
							  " stroke="#3366cc" stroke-width="2" fill-opacity="1" fill="none"></path>
                           </g>
                        </g>
                        <g></g>
                        <g>
                           <g>
                              <text text-anchor="middle" x="163.05409761574074" y="183.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">12:00</text>
                           </g>
                           <g>
                              <text text-anchor="middle" x="397.8874309490741" y="183.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">16:00</text>
                           </g>
                           <g>
                              <text text-anchor="middle" x="632.7207642824075" y="183.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">20:00</text>
                           </g>
                           <g>
                              <text text-anchor="middle" x="867.5540976157408" y="183.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">0:00</text>
                           </g>
                           <g>
                              <text text-anchor="middle" x="1102.387430949074" y="183.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">4:00</text>
                           </g>
                           <g>
                              <text text-anchor="middle" x="1337.2207642824076" y="183.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">8:00</text>
                           </g>
                           <g>
                              <text text-anchor="end" x="50.666666666666664" y="166.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">40</text>
                           </g>
                           <g>
                              <text text-anchor="end" x="50.666666666666664" y="136" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">44</text>
                           </g>
                           <g>
                              <text text-anchor="end" x="50.666666666666664" y="105.25" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">48</text>
                           </g>
                           <g>
                              <text text-anchor="end" x="50.666666666666664" y="74.5" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">52</text>
                           </g>
                           <g>
                              <text text-anchor="end" x="50.666666666666664" y="43.75" font-family="Arial" font-size="15" stroke="none" stroke-width="0" fill="#444444">56</text>
                           </g>
                        </g>
                     </g>
                     <g>
                        <g>
                           <text text-anchor="middle" x="22.083333333333332" y="100" font-family="Arial" font-size="15" font-style="italic" transform="rotate(-90 22.083333333333332 100)" stroke="none" stroke-width="0" fill="#222222">%</text>
                           <path d="M9.333333333333329,162L9.333333333333337,38L24.333333333333336,38L24.33333333333333,162Z" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></path>
                        </g>
                     </g>
                     <g></g>
                  </svg>
                  <div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;">
                     <table>
                        <thead>
                           <tr>
                              <th>Time</th>
                              <th>humidity</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Nov 18, 2016, 10:15:11 AM</td>
                              <td>45</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 12:49:18 PM</td>
                              <td>49</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 2:32:30 PM</td>
                              <td>52</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 4:28:15 PM</td>
                              <td>49</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 6:28:14 PM</td>
                              <td>52</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 7:11:34 PM</td>
                              <td>49</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 9:04:36 PM</td>
                              <td>45</td>
                           </tr>
                           <tr>
                              <td>Nov 18, 2016, 10:50:07 PM</td>
                              <td>42</td>
                           </tr>
                           <tr>
                              <td>Nov 19, 2016, 10:15:11 AM</td>
                              <td>42</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>

         </div>
      </state-history-chart-line>
	  
-->