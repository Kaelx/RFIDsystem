<?php

require_once 'admin/db_connect.php';  // Assuming this connects to the database
require_once 'vendor/autoload.php';  // Load the Faker autoloader

// Create a Faker instance
$faker = \Faker\Factory::create();

// Generate random data for the member
$fname = $faker->firstName();
$mname = $faker->firstName();
$lname = $faker->lastName();
$bdate = $faker->date('Y-m-d');
$address = $faker->address();
$cellnum = '09' . $faker->numerify('#########'); 
$email = $faker->unique()->safeEmail();

// Generate random data for the parent
$parent_name = $faker->name();
$parent_num = '09' . $faker->numerify('#########');
$parent_address = $faker->address();

// Additional random data
$role_id = 87;
$year = $faker->numberBetween(2021, 2024);
$randomNumber = $faker->unique()->numberBetween(10000, 99999);
$school_id = $year . '-' . $randomNumber;

// Prepare the SQL query to insert all fields
$sql = "INSERT INTO students (fname, mname, lname, bdate, address, cellnum, email, parent_name, parent_num, parent_address, role_id, school_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("ssssssssssss", $fname, $mname, $lname, $bdate, $address, $cellnum, $email, $parent_name, $parent_num, $parent_address, $role_id, $school_id);

// Execute the query
if ($stmt->execute()) {
    echo "Random member data inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();

?>
