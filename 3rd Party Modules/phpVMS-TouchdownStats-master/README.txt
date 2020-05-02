TouchdownStats

Module to extract and display landing rates from your PIREPS table

Developed by:
simpilot - David Clark
www.simpilotgroup.com
www.david-clark.net

----------------------------------------------
A visible link to http://www.simpilotgroup.com must be provided on any webpage utilizing this script for the license to be valid.
----------------------------------------------

Developed on:
phpVMS 2.1.935
php 5.2.11
mysql 5.0.51
apache 2.2.11

Install:

-Download the attached package.
-unzip the package and place the files as structured in your root phpVMS install.


To show all the landing stats currently in the datbase create a link to

www.yoursite.com/index.php/TouchdownStats

To show a limited number of stats from your database create a link to

www.yoursite.com/index.php/TouchdownStats/top_landings/10

The "10" can be changed to however many you would like to see

The most useful method of the data class would be to use

TouchdownStatsData::get_all_stats()
and
TouchdownStatsData::get_stats('10')

You can use these inside of one of your templates to bring back the data you want and display it as you wish.

An example to fill a variable with data for use in your template you can use

$this->set->('stats', TouchdownStatsData::get_stats('10'));

in your module to pass the data to the template within the $stats variable. Then in your template use the $stats variable to do what you wish with the display.

TouchDownStats Released under the following license: 
Creative Commons Attribution-Noncommercial-Share Alike 3.0 Unported License 