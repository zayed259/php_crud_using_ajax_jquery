<?php
$connection = new mysqli(
    'localhost',
    'root',
    '',
    'php_crud'
) or die("Connection failed: " . $connection->connect_error);
$connection->set_charset("utf8");
