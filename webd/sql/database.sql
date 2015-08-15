CREATE TABLE `ユーザー情報` (
  `ユニークID` INT AUTO_INCREMENT,
  `ユーザーID` VARCHAR(20),
  `パスワード` VARCHAR(20),
  `メールアドレス` VARCHAR(60),
  `ユーザー名` VARCHAR(60),
  `マシンID` VARCHAR(60),
  PRIMARY KEY (`ユニークID`)
);
CREATE TABLE `マシン情報` (
  `マシンID` INT AUTO_INCREMENT,
  `マシン名` VARCHAR(20),
  `last_name` VARCHAR(20),
  `email` VARCHAR(60),
  PRIMARY KEY (`id`)
);
CREATE TABLE `パッケージ管理システム情報` (
  `id` INT AUTO_INCREMENT,
  `first_name` VARCHAR(20),
  `last_name` VARCHAR(20),
  `email` VARCHAR(60),
  PRIMARY KEY (`id`)
);
CREATE TABLE `インストール済みパッケージ` (
  `id` INT AUTO_INCREMENT,
  `first_name` VARCHAR(20),
  `last_name` VARCHAR(20),
  `email` VARCHAR(60),
  PRIMARY KEY (`id`)
);
CREATE TABLE `パッケージ情報` (
  `id` INT AUTO_INCREMENT,
  `first_name` VARCHAR(20),
  `last_name` VARCHAR(20),
  `email` VARCHAR(60),
  PRIMARY KEY (`id`)
);
CREATE TABLE `最新パッケージ情報` (
  `id` INT AUTO_INCREMENT,
  `first_name` VARCHAR(20),
  `last_name` VARCHAR(20),
  `email` VARCHAR(60),
  PRIMARY KEY (`id`)
);
CREATE TABLE `マシンステータス情報` (
  `id` INT AUTO_INCREMENT,
  `first_name` VARCHAR(20),
  `last_name` VARCHAR(20),
  `email` VARCHAR(60),
  PRIMARY KEY (`id`)
);
CREATE TABLE `ステータス` (
  `id` INT AUTO_INCREMENT,
  `first_name` VARCHAR(20),
  `last_name` VARCHAR(20),
  `email` VARCHAR(60),
  PRIMARY KEY (`id`)
);
