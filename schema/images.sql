CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `collection_id` int(10) unsigned NOT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `size` int(10) unsigned DEFAULT NULL,
  `mime_type` varchar(255) CHARACTER SET ascii DEFAULT NULL,
  `extension` varchar(32) CHARACTER SET ascii DEFAULT NULL,
  `checksum` char(40) CHARACTER SET ascii DEFAULT NULL,
  `width` int(10) unsigned DEFAULT NULL,
  `height` int(10) unsigned DEFAULT NULL,
  `aspect` enum('4:3','3:2','16:9','') CHARACTER SET ascii DEFAULT NULL,
  `is_portrait` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`image_id`),
  KEY `collection_id` (`collection_id`),
  KEY `original_name` (`original_name`),
  KEY `size` (`size`),
  KEY `mime_type` (`mime_type`),
  KEY `extension` (`extension`),
  KEY `checksum` (`checksum`),
  KEY `width` (`width`),
  KEY `height` (`height`),
  KEY `aspect` (`aspect`),
  KEY `is_portrait` (`is_portrait`),
  KEY `created` (`created`),
  KEY `modified` (`modified`),
  CONSTRAINT `collection_id`
    FOREIGN KEY (`collection_id`)
    REFERENCES `collections` (`collection_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

