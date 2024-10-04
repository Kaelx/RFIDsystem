<?php

require_once 'admin/db_connect.php';
require_once 'vendor/autoload.php';

$faker = \Faker\Factory::create();

$fname = $faker->firstName();
$mname = $faker->firstName();
$lname = $faker->lastName();
$bdate = $faker->date('Y-m-d');
$gender = $faker->randomElement(['male', 'female']);
$address = substr($faker->address(), 0, 20); 
$cellnum = '09' . $faker->numerify('#########'); 
$email = $faker->unique()->safeEmail();

$parent_name = $faker->name();
$parent_num = '09' . $faker->numerify('#########');
$parent_address = substr($faker->address(), 0, 20);  

$role_id = 2;
$year = $faker->numberBetween(2021, 2024);
$randomNumber = $faker->unique()->numberBetween(10000, 99999);
$school_id = $year . '-' . $randomNumber;

$sql = "INSERT INTO students (fname, mname, lname, bdate, gender, address, cellnum, email, parent_name, parent_num, parent_address, role_id, school_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssis", $fname, $mname, $lname, $bdate, $gender, $address, $cellnum, $email, $parent_name, $parent_num, $parent_address, $role_id, $school_id);

if ($stmt->execute()) {
    echo "Random member data inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>