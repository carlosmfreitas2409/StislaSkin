# Fltbook-System
A redesigned phpVMS Module modified to allow pilots to select their own aircraft prior to booking a flight.

--------------------
NOTICE: Some of the code has been derived from it's owners on the phpVMS forums and has been compiled by Web541

	FrontSchedules - Simpilot
    RealScheduleLite - Simpilot
    FlightBookingSystem - Parkho
    
    
I do not own any code from the above authors and all code provided by them belongs to their respective owners.

----------------------
Simple Instructions
----------------------
1. To work the airlines, please go into all your aircraft and select an airline from the dropdown then click save.

2. For all schedules that need to be imported, add a fake aircraft with the registration of the following format AIRCRAFTICAOAIRLINE
So for all schedules with American Airlines B738, you would make a dummy aircraft called B738AAL and then when importing schedules from your CSV, put B738AAL for your aircraft column.

3. If you wish to turn off features such as the Jumpseat, auto-pagination and searching from Current Location functions, then you can do so via the settings panel.

----------------------
 Installation
----------------------
1. Make sure you have phpVMS version 5.5.x (located here https://github.com/DavidJClark/phpvms_5.5.x) (NOT NECESSERY TO phpVMS 5.5.7.2)
2. Backup all necessary files. I take no responsibility for you losing your files.
3. Place all the files in their respective directory.
4. Upload the fltbook.sql file to your sql database via phpmyadmin or similar

---------------------
Settings
----------------------
All settings can now be managed from the admin panel
Each one has a description of what they can do.

----------------------
Changelog
----------------------
	v2.0.0 - Version 2 Update - Includes added functionality + complete settings panel
	v1.0.0 - Inital Release

----------------------
Additional Information
----------------------
If you would like to show each airline image on the results page, save an image in the directory of lib/images/airlinelogos/ICAO.png
The ICAO is the $airline->code. 
If you want to remove it, go into Fltbook/schedule_results and find these lines

	<th>Airline</th>
	<td width="16.5%" align="left" valign="middle"><img src="<?php echo SITE_URL?>/lib/images/airlinelogos/<?php echo $route->code;?>.png" alt="<?php echo $route->code;?>"></td>

And simply delete them

If you are getting the dreaded 'No route passed' error, then check the javascript source layout on your skin as this module works perfectly on a fresh phpVMS installation with the crystal skin.
