<?php

require_once 'admin/db_connect.php';
require_once 'vendor/autoload.php';

$faker = \Faker\Factory::create();


$fname = $faker->firstName();
$lname = $faker->lastName();
$email = $faker->unique()->safeEmail();

$year = $faker->numberBetween(2021, 2024);
$randomNumber = $faker->unique()->numberBetween(10000, 99999);
$school_id = $year . '-' . $randomNumber;

$sql = "INSERT INTO member (fname, lname, school_id, email) 
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $fname, $lname, $school_id, $email);

if ($stmt->execute()) {
    echo "Random member data inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
