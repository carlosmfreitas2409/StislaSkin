CREATE TABLE IF NOT EXISTS `phpvms_top_flights` (
  `id` mediumint(7) unsigned NOT NULL AUTO_INCREMENT,
  `pilot_id` smallint(5) unsigned NOT NULL,
  `flights` mediumint(5) unsigned NOT NULL,
  `hours` mediumint(5) unsigned NOT NULL,
  `miles` mediumint(7) unsigned NOT NULL DEFAULT '0',
  `month` tinyint(2) unsigned NOT NULL,
  `year` smallint(4) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;