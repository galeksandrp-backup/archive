/*627*/
ALTER TABLE `phpshop_categories` ADD `length` varchar(64) DEFAULT '';
ALTER TABLE `phpshop_categories` ADD `width` varchar(64) DEFAULT '';
ALTER TABLE `phpshop_categories` ADD `height` varchar(64) DEFAULT '';
ALTER TABLE `phpshop_categories` ADD `weight` float DEFAULT '0';
ALTER TABLE `phpshop_categories` ADD `ed_izm` varchar(64) DEFAULT '';
ALTER TABLE `phpshop_slider` ADD `color` varchar(64) DEFAULT '';
ALTER TABLE `phpshop_baners` ADD `color` varchar(64) DEFAULT '';
ALTER TABLE `phpshop_categories` ADD `color` varchar(64) DEFAULT '';
ALTER TABLE `phpshop_jurnal` CHANGE `ip` `ip` VARCHAR(64) DEFAULT '';
ALTER TABLE `phpshop_system` CHANGE `num_vitrina` `num_vitrina` ENUM('1','2','3','4','5','6') DEFAULT '3';
ALTER TABLE `phpshop_categories` CHANGE `num_row` `num_row` ENUM('1','2','3','4','5','6') DEFAULT '3';
