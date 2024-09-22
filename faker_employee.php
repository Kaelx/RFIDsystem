<?php

require_once 'admin/db_connect.php';
require_once 'vendor/autoload.php';

$faker = \Faker\Factory::create();

$fname = $faker->firstName();
$mname = $faker->firstName();
$lname = $faker->lastName();
$bdate = $faker->date('Y-m-d');
$gender = $faker->randomElement(['male', 'female']);
$civil_stat = $faker->randomElement(['single', 'married', 'widowed', 'separated']);
$blood_type = $faker->randomElement(['A', 'B', 'AB', 'O', 'A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-']);
$height = $faker->randomFloat(2, 140, 200);
$weight = $faker->randomFloat(2, 40, 150);
$address = substr($faker->address(), 0, 20); 
$cellnum = '09' . $faker->numerify('#########'); 
$email = $faker->unique()->safeEmail();
$tin_num = $faker->numerify('#########');
$gsis_num = $faker->numerify('#########');
$phil_num = $faker->numerify('#########');
$pagibig_num = $faker->numerify('#########');
$sss_num = $faker->numerify('#########');

$parent_name = $faker->name();
$parent_num = '09' . $faker->numerify('#########');
$parent_address = substr($faker->address(), 0, 20);  

$role_id = 1;
$year = $faker->numberBetween(2021, 2024);
$randomNumber = $faker->unique()->numberBetween(10000, 99999);
$school_id = $year . '-' . $randomNumber;

$sql = "INSERT INTO employees (fname, mname, lname, bdate, gender, civil_stat, blood_type, height, weight, address, cellnum, email, tin_num, gsis_num, phil_num, pagibig_num, sss_num, parent_name, parent_num, parent_address, role_id, school_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssssssssis", $fname, $mname, $lname, $bdate, $gender, $civil_stat, $blood_type, $height, $weight, $address, $cellnum, $email, $tin_num, $gsis_num, $phil_num, $pagibig_num, $sss_num, $parent_name, $parent_num, $parent_address, $role_id, $school_id);

if ($stmt->execute()) {
    echo "Random member data inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>