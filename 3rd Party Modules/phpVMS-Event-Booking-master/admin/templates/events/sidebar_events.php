<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full icense text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2010, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/
?>
<h3>Events</h3>
<br />
<center>
<?php
if(PilotGroups::group_has_perm(Auth::$usergroups, MODERATE_PIREPS))
{
?>
<a href="<?php echo SITE_URL?>/admin/index.php/Events_admin">Events Main</a><br />
<a href="<?php echo SITE_URL?>/admin/index.php/Events_admin/new_event">Create New Event</a><br />
<?php
}
?>
</center>
<br />