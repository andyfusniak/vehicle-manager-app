CREATE TABLE `admins` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `passwd` char(60) CHARACTER SET ascii NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL,
  KEY `admin_id` (`admin_id`),
  UNIQUE KEY `username` (`username`),
  KEY `passwd` (`passwd`),
  KEY `created` (`created`),
  KEY `modified` (`modified`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
