EVENTBooking 2.0

phpVMS module to create and manage fly-in events for your phpVMS based virtual airline.

Developed by:
simpilot - David Clark
www.simpilotgroup.com
www.david-clark.net

Developed on:
phpVMS 2.1.921
php 5.2.11
mysql 5.0.51
apache 2.2.11

Install:

-Download the attached package.
-unzip the package and place the files as structured in your root phpVMS install.
-use the event.sql file to create the tables needed in your sql database using phpmyadmin or similar.


This is a VERY BASIC BETA version of this module. It only includes basic functionality and is currently under further development. It is only being released in this BETA form for community input on further options.

The Slot Limit determines how many open slots are available to pilots for signing up beyond the slots that are already reserved. - I would suggest not editing this after you have created the event and have signups.

The Slot Interval is how many minutes are between each Slot Reservation. This is not editable once you set the number in the creation of the event.

Bug tracker and feature requests here - http://bugs.phpvms.net/browse/EVB

Released under the following license:
Creative Commons Attribution-Noncommercial-Share Alike 3.0 Unported License

EVENTBooking beta 1.1 update

-removed datepicker calendar and added date dropdown to support all browsers
-added news post function during initial creation of event
-added function to delete an event and all signups associated with it
-changed sql field size for event description from 250 characters to 2000 characters

New Install

Same as 1.0 install above

Update

Overwrite existing files for EVENTBooking with the new 1.1 files
Run event_update.sql in your events table in your phpvms database

EVENTBooking beta 1.2 update - phpVMS ver 929

-fixed small date bug when editing event
-new function to automatically add the link in the admin panel for the events module. It should show up under addons->events. (only functional with build 929 and beyond) You no longer need to put the link in your header for the admin side and it will not get overwritten in updates.

New Install

Same as 1.0 install above

Update

Overwrite existing files for EVENTBooking with the new 1.2 files
If you are updateing from 1.0 -> Run event_update.sql in your events table in your phpvms database

EVENTBooking beta 1.3 update - phpVMS ver 930

-added pilot rankings for number of events attended.

New Install

Same as 1.0 install above

Update

Overwrite existing files for EVENTBooking with the new 1.3 files
If you are updating from 1.0 -> Run event_update_1.1.sql & event_update_1.3.sql in your events table in your phpvms database
If you are updating from 1.1 or 1.2 -> Run event_update_1.3.sql in your events table in your phpvms database