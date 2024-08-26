<?php

require_once 'admin/db_connect.php';
require_once 'vendor/autoload.php';

$faker = \Faker\Factory::create();

// Generate random data
$fname = $faker->firstName();
$lname = $faker->lastName();
$email = $faker->unique()->safeEmail();
$school_id = $faker->unique()->randomNumber(8);

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
