<?php

    // Table Users
$table_users = "CREATE TABLE `softsprint`.`users` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `last_name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `role_id` INT(10) NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)) ENGINE = InnoDB";

$users_val = "INSERT INTO `users` (`id`, `first_name`, `last_name`, `role_id`, `status`) VALUES
(NULL, 'Adam', 'Cotter', '3', '1'),
(NULL, 'Pauline', 'Noble', '2', '1'),
(NULL, 'Sherilyn', 'Metzel', '1', '0'),
(NULL, 'Terrie', 'Boaler', '1', '1'),
(NULL, 'Rutter', 'Pude', '2', '1')";



$table_role = "CREATE TABLE `softsprint`.`users_roles` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    PRIMARY KEY (`id`)) ENGINE = InnoDB";

$role_val = "INSERT INTO `users_roles` (`id`, `name`) VALUES (NULL, 'Admin'), (NULL, 'User'), (NULL, 'Active')";