ALTER TABLE `phpshop_modules_visualcart_memory` ADD `tel` VARCHAR(64), ADD `mail` VARCHAR(64), ADD `name` VARCHAR(64), `sum` FLOAT ;
ALTER TABLE `phpshop_modules_visualcart_memory` ADD `sendmail` ENUM('0','1') DEFAULT '0', ADD `server` INT(11);
ALTER TABLE `phpshop_modules_visualcart_system` ADD `sendmail` INT(11) DEFAULT '10';
ALTER TABLE `phpshop_modules_visualcart_system` ADD `day` INT(11) DEFAULT 10;