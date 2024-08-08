<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>

</head>

<body>
    <?php
    if(!isset($_SESSION['login_id'])) {
        header('Location: login/');
    }else{
        header('Location: admin/');
    }
    ?>

</body>

</html>