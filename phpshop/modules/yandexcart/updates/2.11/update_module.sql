ALTER TABLE `phpshop_products` DROP `google_merchant`;
ALTER TABLE `phpshop_products` DROP `aliexpress`;
ALTER TABLE `phpshop_products` DROP `sbermarket`;
ALTER TABLE `phpshop_products` DROP `cdek`;
ALTER TABLE `phpshop_products` DROP `price_google`;
ALTER TABLE `phpshop_products` DROP `price_cdek`;
ALTER TABLE `phpshop_products` DROP `price_aliexpress`;
ALTER TABLE `phpshop_products` DROP `price_sbermarket`;

ALTER TABLE `phpshop_modules_yandexcart_system` ADD `stop` enum('0','1') DEFAULT '0';
ALTER TABLE `phpshop_products` ADD `yandex_service_life_days` VARCHAR(64) DEFAULT '';