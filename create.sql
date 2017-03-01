DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,

    `email` VARCHAR(255) NOT NULL,
    `email_token` VARCHAR(255),

    `register_at` DATETIME NOT NULL,
    `connection_at` DATETIME,
    `rank` TINYINT UNSIGNED,

    PRIMARY KEY (`id`)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `sorted` SMALLINT,

    PRIMARY KEY (`id`)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS `forums`;
CREATE TABLE `forums` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category_id` INT UNSIGNED NOT NULL,

    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255) NOT NULL,

    `topic_count` BIGINT UNSIGNED NOT NULL,
    `post_count` BIGINT UNSIGNED NOT NULL,
    `last_post_id` BIGINT UNSIGNED,

    PRIMARY KEY (`id`)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `forum_id` BIGINT UNSIGNED NOT NULL,
    `user_id` BIGINT UNSIGNED NOT NULL,

    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(50) NOT NULL,
    `reply_count` INT NOT NULL,

    `resolved` TINYINT UNSIGNED,
    `locked` TINYINT UNSIGNED,

    `first_post_id` BIGINT UNSIGNED NOT NULL,
    `last_post_id` BIGINT UNSIGNED NOT NULL,

    PRIMARY KEY (`id`)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `topic_id` BIGINT UNSIGNED NOT NULL,
    `user_id` BIGINT UNSIGNED NOT NULL,

    `content` LONGTEXT NOT NULL,
    `posted_at` DATETIME NOT NULL,
    `updated_at` DATETIME,
    `resolved` TINYINT UNSIGNED NOT NULL,

    PRIMARY KEY (`id`)
)ENGINE=InnoDB;
