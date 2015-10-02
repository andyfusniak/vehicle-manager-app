CREATE TABLE `vehicles` (
  `vehicle_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `collection_id` INT UNSIGNED NOT NULL,
  `type` enum('caravans','motorhomes','awningrange','accessories','cars') CHARACTER SET ascii NOT NULL,
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `sold` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `meta_keywords` text NOT NULL,
  `meta_desc` text NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `markdown` text NOT NULL,
  `page_html` text,
  `features` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`vehicle_id`),
  UNIQUE KEY `url` (`url`),
  KEY `collection_id` (`collection_id`),
  KEY `price` (`price`),
  KEY `page_title` (`page_title`),
  KEY `type` (`type`),
  KEY `modified` (`modified`) USING BTREE,
  KEY `created` (`created`),
  KEY `visible` (`visible`),
  KEY `sold` (`sold`),
  CONSTRAINT `collection_id_fk`
    FOREIGN KEY (`collection_id`)
      REFERENCES `collections` (`collection_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
