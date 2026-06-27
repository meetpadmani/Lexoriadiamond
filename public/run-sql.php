<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "LEXORIA_DIAMOND");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$mysqli->query("DROP TABLE IF EXISTS `custom_orders`");

$sql = "CREATE TABLE `custom_orders` (
    `id` bigint unsigned not null auto_increment primary key,
    `name` varchar(255) not null,
    `email` varchar(255) not null,
    `phone` varchar(255) not null,
    `description` text not null,
    `images` text not null,
    `status` varchar(255) not null default 'pending',
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci'";

if ($mysqli->query($sql) === TRUE) {
    echo "Table recreated successfully!";
} else {
    echo "Error creating table: " . $mysqli->error;
}
$mysqli->close();
