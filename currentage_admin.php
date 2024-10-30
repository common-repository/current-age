<?php
$updates = "";

if (isset($_POST['currentage_language_process']) && $_POST['currentage_language_process'] == 'y') {
	$tmp_lang = $_POST['calanguage'];
	foreach ($tmp_lang as $key => $value) {
		$tmp_lang[$key] = strip_tags($value);	
	}
	update_option('calanguage',serialize($tmp_lang));
	$updates .= "Language has been updated.<br>\n";
}

if (isset($_POST['currentage_settings_process']) && $_POST['currentage_settings_process'] == 'y') {
	$currentage_settings = $_POST['currentage_settings'];
	foreach ($currentage_settings as $key => $value) {
		$currentage_settings[$key] = strip_tags($value);
	}
	update_option('currentage_settings', serialize( $currentage_settings));

}
	
	
	$calanguage = getcalanguage();
	$currentage_settings = unserialize( get_option('currentage_settings') );


?>
<h1>Current Age Plugin</h1>
<?php 

if ($updates != '') {
?>

<div class="updated">
				<p><strong><?php _e($updates ); ?></strong></p>
			</div>
<?php } ?>
<h2>Instructions</h2>
<p>This plugin allows you to show current age using the shortcode <strong>[showcurrentage month="1" day="1" year="2000" template="1"]</strong> in the content area and dynamically updates based on current date. Default template is number one if none is specified.</p>
<p>
Templates:
<ol>
<li>This template just outputs the number of years.</li>
<li>This template outputs the number of years with matching language.</li>
<li>This template outputs the number of months with matching language.</li>
<li>This template outputs the number of months and days with matching language.</li>
<li>This template outputs the number of weeks and days with matching language.</li>
<li>This template outputs the number of years, weeks and days with matching language.</li>
<li>This template outputs the number of months and weeks with matching language</li>
<li>This template outputs the number of days with matching language</li>
<li>This template outputs the number of years, months, and days with matching language</li>
</ol>

<h2>Global Settings</h2>
<p>
<form  name="currentage_settings_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="currentage_settings_process" value="y">
If shortcode is not working in widget area change this to yes.<br>
Run Shortcodes in Widget: <select name="currentage_settings[run_in_widget]">
<option value="no" <?php echo ( $currentage_settings['run_in_widget'] == 'no' ? ' selected="selected" ' : ''); ?>>No</option>
<option value="yes" <?php echo ( $currentage_settings['run_in_widget'] == 'yes' ? ' selected="selected" ' : ''); ?>>Yes</option>
</select><br>
<input type="submit" name="currentage_settings_submit" value="Save Settings">
</form>
</p>
<h2>Language Settings</h2>
 <p>
<i>Below language settings you will see sample outputs of the above templates.</i>
</p>
   <form name="currentage_language_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="currentage_language_process" value="y">
    <h3>And</h3>
    <strong>And Usage: </strong><input type="text" name="calanguage[and]" value="<?php echo $calanguage['and']; ?>" />
<h3>Years</h3>
<strong>Singular:</strong> <input type="text" name="calanguage[year]" value="<?php echo $calanguage['year']; ?>" /> <strong>Plural:</strong> <input type="text" name="calanguage[years]" value="<?php echo $calanguage['years'];?>" /><br>
<h3>Months</h3>
<strong>Singular:</strong> <input type="text" name="calanguage[month]" value="<?php echo $calanguage['month']; ?>" /> <strong>Plural:</strong> <input type="text" name="calanguage[months]" value="<?php echo $calanguage['months'];?>" /><br>
<h3>Weeks</h3>
<strong>Singular:</strong> <input type="text" name="calanguage[week]" value="<?php echo $calanguage['week']; ?>" /> <strong>Plural:</strong> <input type="text" name="calanguage[weeks]" value="<?php echo $calanguage['weeks'];?>" /><br>
<h3>Days</h3>
<strong>Singular:</strong> <input type="text" name="calanguage[day]" value="<?php echo $calanguage['day']; ?>" /> <strong>Plural:</strong> <input type="text" name="calanguage[days]" value="<?php echo $calanguage['days'];?>" /><br>
<input type="submit" name="update_language" value="Update Language" />
</form>

<br/>
<br/>

<?php

$shortCodeSample = '';
$month1 = '2';
$month2 = '2';
$month3 = '5';
$day1 = '16';
$day2 = '1';
$day3 = '16';
$year1 = '2014';
$year2 = '2013';
$year3 = '1980';

for ($x = 1; $x <= 9; $x++) {
	for ($y = 1; $y <= 3; $y++) {
		$tmpM = "month".$y;
		$tmpD = "day".$y;
		$tmpY = "year".$y;
	$shortCodeSample .= "<tr><td align='center'>".$x."</td><td align='center'>".$$tmpM."-".$$tmpD."-".$$tmpY."</td><td align='center'>[showcurrentage ".'month="'.$$tmpM.'" day="'.$$tmpD.'" year="'.$$tmpY.'" template="'.$x.'"]'."</td></tr>\n";
	}
}

echo do_shortcode('<table>
<tr><th>Template Number</th><th>Date Used in Shortcode</th><th>Output</th></tr>
'.$shortCodeSample .'
</table>'."\n");

