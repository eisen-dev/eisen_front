CREATE TABLE `user_info` (
  `unique_id` INT AUTO_INCREMENT,
  `user_id` VARCHAR(20),
  `password` VARCHAR(20),
  `mailaddress` VARCHAR(60),
  `user_name` VARCHAR(60),
  PRIMARY KEY (`unique_id`)
);
CREATE TABLE `machine_information` (
  `machine_id` INT AUTO_INCREMENT,
  `machine_name` VARCHAR(20),
  `ipaddress` VARCHAR(20),
  `port` VARCHAR(20),
  `os` VARCHAR(20),
  `machine_status_id` VARCHAR(20),
  PRIMARY KEY (`machine_id`)
);
CREATE TABLE `pack_management_system` (
  `pack_sys_id` INT AUTO_INCREMENT,
  `pack_sys_name` VARCHAR(20),
  `pack_sys_version` VARCHAR(20),
  `all_sys_pack_hash` VARCHAR(20),
  `installed_sys_pack_hash` VARCHAR(20),
  PRIMARY KEY (`pack_sys_id`)
);
CREATE TABLE `installed_package` (
  `installed_pack_id` INT AUTO_INCREMENT,
  `installed_pack_category` VARCHAR(20),
  `installed_pack_name` VARCHAR(20),
  `installed_pack_version` VARCHAR(20),
  `installed_pack_summary` VARCHAR(20),
  PRIMARY KEY (`installed_pack_id`)
);
CREATE TABLE `pack_info` (
  `pack_id` INT AUTO_INCREMENT,
  `pack_category` VARCHAR(20),
  `pack_name` VARCHAR(20),
  `pack_version` VARCHAR(20),
  `pack_summary` VARCHAR(20),
  PRIMARY KEY (`pack_id`)
);
CREATE TABLE `machine_info` (
  `machine_status_id` INT AUTO_INCREMENT,
  `machine_id` VARCHAR(20),
  PRIMARY KEY (`machine_status_id`)
);
CREATE TABLE `status` (
  `status_id` INT AUTO_INCREMENT,
  `status_info` VARCHAR(20),
  PRIMARY KEY (`status_id`)
);