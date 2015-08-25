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
  `IPアドレス` VARCHAR(20),
  `ポート番号` VARCHAR(20),
  `OS種類` VARCHAR(20),
  `パッケージ管理システムID` VARCHAR(20),
  `マシンステータスID` VARCHAR(20),
  PRIMARY KEY (`マシンID`)
);
CREATE TABLE `パッケージ管理システム情報` (
  `パッケージ管理システムID` INT AUTO_INCREMENT,
  `パッケージ管理システム名` VARCHAR(20),
  PRIMARY KEY (`パッケージ管理システムID`)
);
CREATE TABLE `インストール済みパッケージ` (
  `マシンID` INT AUTO_INCREMENT,
  `パッケージ管理システムID` VARCHAR(20),
  `パッケージID` VARCHAR(20),
  `現在のパッケージバージョン` VARCHAR(60),
  PRIMARY KEY (`パッケージID`)
);
CREATE TABLE `パッケージ情報` (
  `パッケージID` INT AUTO_INCREMENT,
  `パッケージ名` VARCHAR(20),
  `パッケージの説明` VARCHAR(60),
  PRIMARY KEY (`パッケージID`)
);
CREATE TABLE `最新パッケージ情報` (
  `時刻情報` INT AUTO_INCREMENT,
  `パッケージID` VARCHAR(20),
  `パッケージ管理システムID` VARCHAR(20),
  `バージョン情報` VARCHAR(60),
  `更新情報` VARCHAR(60),
  PRIMARY KEY (`パッケージ管理システムID`)
);
CREATE TABLE `マシンステータス情報` (
  `時刻情報` INT AUTO_INCREMENT,
  `マシンID` VARCHAR(20),
  `ステータスID` VARCHAR(20),
  PRIMARY KEY (`ステータスID`)
);
CREATE TABLE `ステータス` (
  `ステータスID` INT AUTO_INCREMENT,
  `ステータス表示` VARCHAR(20),
  PRIMARY KEY (`ステータスID`)
);
