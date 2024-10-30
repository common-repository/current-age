<?php
/*
Plugin Name: Current Age
Plugin URI: http://www.gregwhitehead.us/

Description: This plugin allows you to show current age using the shortcode <strong>[showcurrentage month="1" day="1" year="2000"]</strong> in the content area and dynamically updates based on current date.  Now has multiple templates with language customizations.

Author: Greg Whitehead
Version: 1.6
Author URI: http://www.gregwhitehead.us/
*/

include('functions.php');

// Add settings link on plugin page
function currentage_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=currentage-submenu-page">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$currentage_plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$currentage_plugin", 'currentage_settings_link' );

add_action('admin_menu', 'register_currentage_submenu_page');

function register_currentage_submenu_page() {

	add_submenu_page( 'options-general.php', "Current Age Settings", "Current Age Settings", 'manage_options', 'currentage-submenu-page', 'currentage_submenu_page_callback' ); 

}

function currentage_submenu_page_callback() {
	include('currentage_admin.php');
}


function showCurrentAge($atts) {
	
	extract( shortcode_atts( array(
		'month' => '1',
		'day' => '1',
		'year' => '2000',
		'template' => '1',
	), $atts ) );

	$calanguage = getcalanguage();
	
	$datetime1 = date_create($year.'-'.$month.'-'.$day);
	$datetime2 = date_create();
	$interval = date_diff($datetime1, $datetime2);
	$age = '';
		switch ($template) {
			case '9':
				$curSeconds = mktime() - mktime( 0, 0, 0, $month, $day, $year);
				$tmpYears = (int)$interval->format("%Y");
				$tmpMonths = (int)$interval->format("%M");
				$tmpDays = (int)$interval->format("%D");
				if ($tmpYears >0) {
					$age .= $tmpYears . ($tmpYears == 1 ? " " . $calanguage['year'] : " " . $calanguage['years'] );	
					if ($tmpDays > 0 && $tmpMonths > 0 ) 
						$age .= ", ";
					else if ($tmpDays > 0 || $tmpMonths > 0 )
						$age .= " ".$calanguage['and']." ";					
				}
				if ($tmpMonths > 0) {
					$age .= $tmpMonths . ($tmpMonths == 1 ? " " . $calanguage['month'] : " " . $calanguage['months'] );	
					if ($tmpDays > 0) 
						$age .= " ".$calanguage['and']." ";					
				}
				if ($tmpMonths == 0 || $tmpDays > 0)
					$age .= $tmpDays . ($tmpDays == 1 ? " " . $calanguage['day'] : " " . $calanguage['days'] );	
			break;
			case '8':
				$curSeconds = mktime() - mktime( 0, 0, 0, $month, $day, $year);
				$nrDays = (int)floor( ($curSeconds ) / 86400); 
				$age .= $nrDays . ($nrDays == 1 ? " " . $calanguage['day'] : " " . $calanguage['days'] );
			break;
			case '7':
				$curSeconds = mktime() - mktime( 0, 0, 0, $month, $day, $year);
				$tmpYears = (int)$interval->format("%Y");
				$tmpMonths = (int)$interval->format("%M");
				$tmpDays = (int)$interval->format("%D");
				$tmpWeeks = (int)($tmpDays /7);
				if ($tmpYears >0) {
					$age .= $tmpYears . ($tmpYears == 1 ? " " . $calanguage['year'] : " " . $calanguage['years'] );	
					if ($tmpWeeks > 0 && $tmpMonths > 0 ) 
						$age .= ", ";
					else if ($tmpWeeks > 0 || $tmpMonths > 0 )
						$age .= " ".$calanguage['and']." ";					
				}
				if ($tmpMonths > 0) {
					$age .= $tmpMonths . ($tmpMonths == 1 ? " " . $calanguage['month'] : " " . $calanguage['months'] );	
					if ($tmpWeeks > 0) 
						$age .= " ".$calanguage['and']." ";					
				}
				if ($tmpMonths == 0 || $tmpWeeks > 0)
					$age .= $tmpWeeks . ($tmpWeeks == 1 ? " " . $calanguage['week'] : " " . $calanguage['weeks'] );	
			break;
			case '6':
				$curSeconds = mktime() - mktime( 0, 0, 0, $month, $day, $year);
				$nrWeeksPassed = floor($curSeconds / 604800 ); 
				$nrYears = (int)($nrWeeksPassed /52);
				$nrWeeks = (int)($nrWeeksPassed % 52);
				$nrDays = (int)floor( ($curSeconds - ($nrWeeksPassed*604800) ) / 86400); 
				if ($nrYears != 0) {
					$age .= $nrYears . ($nrYears == 1 ? " " . $calanguage['year'] : " " . $calanguage['years'] );
					if ($nrWeeks != 0 && $nrDays != 0) 
						$age .= ", ";
					else if ($nrWeeks != 0 || $nrDays != 0)
						$age .= " ".$calanguage['and']." ";
				}
				if ($nrWeeks != 0) {
					$age .= $nrWeeks . ($nrWeeks == 1 ? " " . $calanguage['week'] : " " . $calanguage['weeks'] );
					if ($nrDays != 0) 
						$age .= " ".$calanguage['and']." ";
				}
				if ($nrDays != 0)
					$age .= $nrDays . ($nrDays == 1 ? " " . $calanguage['day'] : " " . $calanguage['days'] );
				
			break;
			case '5':
				$curSeconds = mktime() - mktime( 0, 0, 0, $month, $day, $year);
				$ageWeeks = (int)( ($curSeconds / ( 60*60*1*24 ))/7 ) ;
				$ageDays = (int)( ($curSeconds / ( 60*60*1*24 )) % 7 ) ;
				if ($ageWeeks > 0) 
					$age = (int)$ageWeeks . ( $ageWeeks == 1 ? " " . $calanguage['week'] : " " . $calanguage['weeks']  ) . ( $ageDays > 0 ?  " ".$calanguage['and']." " . (int)$ageDays . ( $ageDays == 1 ? " " . $calanguage['day'] :" " . $calanguage['days']  ) : '' );
				else
					$age = (int)$ageDays . ( $ageDays == 1 ? " " . $calanguage['day'] :" " . $calanguage['days']  ) ;
			break;
			case '4':
				$tmpYears = $interval->format("%Y");
				$tmpMonths = $interval->format("%M");
				$tmpDays = $interval->format("%D");
				$ageMonths = $tmpYears * 12 + $tmpMonths;
				if ($ageMonths > 0) 
					$age = (int)$ageMonths . ( $ageMonths == 1 ? " " . $calanguage['month'] : " " . $calanguage['months']) . " ".$calanguage['and']." " . (int)$tmpDays . ($tmpDays == 1 ? " " . $calanguage['day'] : " " . $calanguage['days'] ); 
				else
					$age = (int)$tmpDays . ($tmpDays == 1 ? " " . $calanguage['day'] : " " . $calanguage['days'] ); 
			break;
			case '3':
				$tmpYears = $interval->format("%Y");
				$tmpMonths = $interval->format("%M");
				$age = $tmpYears * 12 + $tmpMonths;
				$age = ( $age == 1 ? $age . " " . $calanguage['month'] : $age . " " . $calanguage['months']);
			break;
			case '2':
			 $age = (int)$interval->format("%Y");
			 $age = ( $age == 1 ? $age . " " . $calanguage['year'] : $age . " " . $calanguage['years']);
			break;
			case '1':
			default:
			 $age = (int)$interval->format("%Y");
			break;
		}
		
		return $age;
}

add_shortcode('showcurrentage','showCurrentAge');

function currentage_init() {
	if (! is_admin() ) {
		$currentage_settings = unserialize(get_option('currentage_settings'));
		if ($currentage_settings['run_in_widget'] == 'yes') {
			if (!has_filter('widget_text', 'do_shortcode')) add_filter('widget_text', 'do_shortcode');
		}
	}
	
}

add_filter('init','currentage_init');
