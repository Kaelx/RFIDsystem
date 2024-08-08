<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page</title>

    <?php
    include 'header.php';

    if (!isset($_SESSION['login_id'])) {
        header('Location: ../');
    }
    ?>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=about">About</a>
                    </li>
            </div>
        </div>

        <div class="position-fixed top-0 end-0 m-3">
            <div id="screenIcon" class="fa fa-maximize fa-2x"></div>
        </div>
    </nav>



    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : "home";

    $allowed_pages = ['home', 'about'];
    if (in_array($page, $allowed_pages)) {
        include $page . '.php';
    } else {
        header('Location: index?page=home');
    }
    ?>

</body>

<?php
include 'footer.php';
?>



<script>
    window.onload = function() {
        start_load();

        end_load();
    };
</script>

</html>