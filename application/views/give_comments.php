<?php $base_url = $base_url;
$i = 0;
foreach ($user_details_comment as $comDetails): $i++; ?>
	<div class="pupplestoredivRelative">
		<div class="icon_bg"></div>
		<div class="img_details"> <?php $arr = get_time_difference($comDetails->comments_time);?>
			<div class="names"><?php echo $comDetails->full_name;?><span class="timing"><?php echo $arr['days']?>
					days <?php echo $arr['hours']?> Hours <?php echo $arr['minutes']?>
					Minutes <?php echo $arr['seconds']?> Seconds</span></div>
			<div class="img_about">
				<div><?php echo $comDetails->comments;?></div>
			</div>
		</div>
		<div class="floatright">
			<div class="vertical_separator" style="height:77px;"></div>
			<div class="pupplestore_icon"></div>
			<div class="vertical_separator" style="height:77px;"></div>
			<div class="pupplestore_close"></div>
		</div>
	</div> <?php endforeach;
/** * Function to calculate date or time difference. * * Function to calculate date or time difference. Returns an array or * false on error. * * @author J de Silva <giddomains@gmail.com> * @copyright Copyright &copy; 2005, J de Silva * @link http://www.gidnetwork.com/b-16.html Get the date / time difference with PHP * @param string $start * @param string $end * @return array */
function get_time_difference($time)
{
	$uts['start'] = strtotime($time);
	$uts['end'] = strtotime(date("Y-m-d G:i:s", time()));
	if ($uts['start'] !== -1 && $uts['end'] !== -1) {
		if ($uts['end'] >= $uts['start']) {
			$diff = $uts['end'] - $uts['start'];
			if ($days = intval((floor($diff / 86400)))) $diff = $diff % 86400;
			if ($hours = intval((floor($diff / 3600)))) $diff = $diff % 3600;
			if ($minutes = intval((floor($diff / 60)))) $diff = $diff % 60;
			$diff = intval($diff);
			return (array('days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $diff));
		} else {
			trigger_error("Ending date/time is earlier than the start date/time", E_USER_WARNING);
		}
	} else {
		trigger_error("Invalid date/time data detected", E_USER_WARNING);
	}
	return (false);
} ?>