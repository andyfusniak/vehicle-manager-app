CREATE TABLE IF NOT EXISTS `collections` (
  `collection_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(64) CHARACTER SET ascii NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`collection_id`),
  UNIQUE KEY `tagname` (`tagname`),
  KEY `modified` (`modified`),
  KEY `created` (`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
