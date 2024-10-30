=== Current Age Plugin ===
Contributors: billiardgreg
Donate link: http://www.billiardgreg.com/
Tags: 
Requires at least: 3.0.1
Tested up to: 4.5.3
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin shows the current age based upon date passed through shortcode . Language and template capable.

== Description ==

This plugin allows you to show current age using the shortcode [showcurrentage month="1" day="1" year="2000" template="1"] in the content area and dynamically updates based on current date. Default template is number one if none is specified.

Templates:

Number 1: This template just outputs the number of years.
Number 2: This template outputs the number of years with matching language.
Number 3: This template outputs the number of months with matching language.
Number 4: This template outputs the number of months and days with matching language.
Number 5: This template outputs the number of weeks and days with matching language.
Number 6: This template outputs the number of years, weeks and days with matching language.
Number 7: This template outputs the number of months and weeks with matching language
Number 8: This template outputs the number of days with matching language
Number 9: This template outputs the number of years, months and days with matching language

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the `CurrentAge` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use [showcurrentage month="1" day="1" year="2000" tamplate="1"] in content to show current age in number or by one of the templates.
4. If for some reason it is not working in the widgets area, you can then check the settings area for a fix.

== Frequently Asked Questions ==

= Where can I get answers to questions? =

You can email greg@billiardgreg.com to receive answers or go to http://www.gregwhitehead.us


== Screenshots ==

1. No Screenshot

== Changelog ==

= 1.6 =
* Added shortcode in widget option in settings area. Checks to see if filter has already been added before it does it.

= 1.5 =
* Added if function does not exist for date_diff functionality for previous versions of PHP.

= 1.4 =
* Added another template.

= 1.3 =
* Removed ads from admin area.

= 1.2 =
* Added settings link to plugins page.

= 1.1 =
* Added language capabilities with more template capabilities.

= 1.0 =
* Initial Release of Plugin

== Upgrade Notice ==

= 1.6 = 
* Added shortcode in widget functionality.

= 1.0 =
* Initial Release of Plugin