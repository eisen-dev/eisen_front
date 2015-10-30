CREATE TABLE installed_package
(
    installed_pack_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    installed_pack_category VARCHAR(20),
    installed_pack_name VARCHAR(20),
    installed_pack_version VARCHAR(60),
    installed_pack_summary VARCHAR(60),
    pack_sys_id INT NOT NULL
);
CREATE TABLE machine_information
(
    machine_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    machine_name VARCHAR(20),
    ipaddress VARCHAR(20),
    port VARCHAR(60),
    os VARCHAR(60),
    status_id VARCHAR(60),
    user_id INT NOT NULL
);
CREATE TABLE pack_info
(
    pack_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    pack_category VARCHAR(20),
    pack_name VARCHAR(20),
    pack_version VARCHAR(60),
    pack_summary VARCHAR(60),
    pack_sys_id INT NOT NULL
);
CREATE TABLE pack_management_system
(
    pack_sys_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    pack_sys_name VARCHAR(20),
    pack_sys_version VARCHAR(20),
    all_sys_pack_hash VARCHAR(60),
    installed_sys_pack_hash VARCHAR(60),
    machine_id INT NOT NULL
);
CREATE UNIQUE INDEX unique_pack_sys_id ON pack_management_system (pack_sys_id);
CREATE TABLE status
(
    status_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    status_info VARCHAR(20)
);
CREATE UNIQUE INDEX unique_status_id ON status (status_id);
CREATE TABLE user_info
(
    user_id VARCHAR(75) PRIMARY KEY NOT NULL,
    password VARCHAR(40),
    mail_address VARCHAR(60)
);
CREATE UNIQUE INDEX unique_user_id ON user_info (user_id);
