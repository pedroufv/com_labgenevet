CREATE TABLE IF NOT EXISTS `#__labgenevet_exams` (
  `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id`         INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `catid`            INT(11)          NOT NULL,
  `title`            VARCHAR(255)     NOT NULL,
  `code`             INT(11)          NOT NULL,
  `price`            DECIMAL(10,2)    NOT NULL,
  `ordering`         INT(11)          NOT NULL,
  `state`            TINYINT(1)       NOT NULL,
  `checked_out`      INT(11)          NOT NULL,
  `checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by`       INT(11)          NOT NULL,
  PRIMARY KEY (`id`)
)
  DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__labgenevet_requests` (
  `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `animalsid`        INT(11)          NOT NULL,
  `clinicsid`        INT(11)          NOT NULL,
  `situationsid`     INT(11)          NOT NULL,
  `filename`         VARCHAR(255)     NOT NULL,
  `internal_code`    VARCHAR(255)     NULL,
  `info`             TEXT             NOT NULL,
  `created`          DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
  `urgent`           BOOLEAN          NOT NULL DEFAULT FALSE,
  `total`            DECIMAL(10,2)    NOT NULL,
  `ordering`         INT(11)          NOT NULL,
  `state`            TINYINT(1)       NOT NULL,
  `checked_out`      INT(11)          NOT NULL,
  `checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by`       INT(11)          NOT NULL,
  PRIMARY KEY (`id`)
)
  DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__labgenevet_animals` (
  `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id`         INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `name`             VARCHAR(255)     NOT NULL,
  `age`              VARCHAR(255)     NOT NULL,
  `gender`           VARCHAR(255)     NOT NULL,
  `breed`            VARCHAR(255)     NOT NULL,
  `species`          VARCHAR(255)     NOT NULL,
  `owner`            VARCHAR(255)     NOT NULL,
  `ordering`         INT(11)          NOT NULL,
  `state`            TINYINT(1)       NOT NULL,
  `checked_out`      INT(11)          NOT NULL,
  `checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by`       INT(11)          NOT NULL,
  PRIMARY KEY (`id`)
)
  DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__labgenevet_containers` (
  `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id`         INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `title`            VARCHAR(255)     NOT NULL,
  `description`      VARCHAR(255)     NOT NULL,
  `ordering`         INT(11)          NOT NULL,
  `state`            TINYINT(1)       NOT NULL,
  `checked_out`      INT(11)          NOT NULL,
  `checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by`       INT(11)          NOT NULL,
  PRIMARY KEY (`id`)
)
  DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__labgenevet_situations` (
  `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id`         INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `title`            VARCHAR(255)     NOT NULL,
  `description`      VARCHAR(255)     NOT NULL,
  `ordering`         INT(11)          NOT NULL,
  `state`            TINYINT(1)       NOT NULL,
  `checked_out`      INT(11)          NOT NULL,
  `checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by`       INT(11)          NOT NULL,
  PRIMARY KEY (`id`)
)
  DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__labgenevet_species` (
  `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id`         INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `title`            VARCHAR(255)     NOT NULL,
  `description`      VARCHAR(255)     NOT NULL,
  `ordering`         INT(11)          NOT NULL,
  `state`            TINYINT(1)       NOT NULL,
  `checked_out`      INT(11)          NOT NULL,
  `checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by`       INT(11)          NOT NULL,
  PRIMARY KEY (`id`)
)
  DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__labgenevet_examslist` (
  `requestsid` INT(11) NOT NULL,
  `examsid`   INT(11) NOT NULL,
  PRIMARY KEY (`requestsid`, `examsid`)
)
  DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__labgenevet_containerslist` (
  `requestsid`    INT(11) NOT NULL,
  `containersid` INT(11) NOT NULL,
  PRIMARY KEY (`requestsid`, `containersid`)
)
  DEFAULT COLLATE = utf8_general_ci;

