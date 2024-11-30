<?php

$conn = new mysqli('localhost', 'u260856940_root', 'rK9HlcUjK=', 'u260856940_rfidsystem_db') or die("Could not connect to mysql" . mysqli_error($conn));
$conn->query("SET time_zone = '+08:00'");
