CREATE TABLE IF NOT EXISTS `fltbook_location`
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pilot_id` int(11) NOT NULL,
  `arricao` varchar(4) NOT NULL,
  `jumpseats` int(11) NOT NULL DEFAULT '0',
  `total_jumpseat_pay` float NOT NULL DEFAULT '0',
  `last_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `fltbook_settings`
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `fltbook_settings` (name, value) VALUES ('disabled_ac_allow_book', '1');
INSERT INTO `fltbook_settings` (name, value) VALUES ('disabled_ac_sched_show', '0');
INSERT INTO `fltbook_settings` (name, value) VALUES ('show_ac_if_booked', '1');
INSERT INTO `fltbook_settings` (name, value) VALUES ('lock_aircraft_location', '0');
INSERT INTO `fltbook_settings` (name, value) VALUES ('search_from_current_location', '1');
INSERT INTO `fltbook_settings` (name, value) VALUES ('jumpseat_cost', '0.4');
INSERT INTO `fltbook_settings` (name, value) VALUES ('pagination_enabled', '0');
INSERT INTO `fltbook_settings` (name, value) VALUES ('show_details_button', '0');

ALTER TABLE `phpvms_aircraft` ADD `airline` varchar(255) NOT NULL AFTER `icao`;
ALTER TABLE `phpvms_aircraft` ADD `location` varchar(255) NOT NULL AFTER `airline`;
ALTER TABLE `phpvms_bids` ADD `aircraftid` int(11) NOT NULL AFTER `routeid`;
