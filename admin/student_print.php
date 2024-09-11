<?php
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    $query = $conn->query("SELECT s.*, d.dept_name, p.prog_name, r.role_name, g.gender
    FROM students s 
    LEFT JOIN department d ON s.dept_id = d.id 
    LEFT JOIN program p ON s.prog_id = p.id 
    LEFT JOIN gender g ON s.gender_id = g.id
    LEFT JOIN role r ON s.role_id = r.id 
    WHERE s.id = $uid 
    ORDER BY s.id ASC");

    $data = mysqli_fetch_assoc($query);
} else {
    header('location: index.php?page=student_data');
}
?>

<!-- Printable ID Layout -->
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="id-card-wrapper" style="width: 300px; height: 500px; border: 1px solid black; margin: 20px auto; padding: 10px; font-family: Arial, sans-serif; text-align: center;">

                <!-- ID Header -->
                <div class="id-header" style="margin-bottom: 20px;">
                    <h3 style="margin: 0; font-size: 18px;">Student ID</h3>
                </div>

                <!-- Profile Picture -->
                <div class="profile-picture" style="margin-bottom: 20px;">
                    <?php if (isset($data['img_path']) && !empty($data['img_path'])): ?>
                        <img src="<?= 'assets/img/' . $data['img_path'] ?>" alt="Profile Picture" style="width: 120px; height: 120px; border-radius: 50%; border: 2px solid #333;">
                    <?php else: ?>
                        <img src="assets/img/blank-img.png" alt="Default Profile Picture" style="width: 120px; height: 120px; border-radius: 50%; border: 2px solid #333;">
                    <?php endif; ?>
                </div>

                <!-- Student Information -->
                <div class="student-info">
                    <p style="margin: 5px 0; font-size: 14px;"><?= isset($data['school_id']) ? $data['school_id'] : '' ?></p>
                    <h4 style="margin: 0;"><?= isset($data['fname']) ? $data['fname'] : '' ?> <?= isset($data['mname']) ? $data['mname'] : '' ?> <?= isset($data['lname']) ? $data['lname'] : '' ?></h4>
                    <p style="font-size: 12px; margin: 5px 0;"><?= isset($data['gender']) ? $data['gender'] : '' ?></p>
                    <p style="margin: 5px 0; font-size: 14px;"><?= isset($data['prog_name']) ? $data['prog_name'] : '' ?> </p>
                    <p style="margin: 5px 0; font-size: 14px;"><?= isset($data['dept_name']) ? $data['dept_name'] : '' ?> </p>
                </div>

                <!-- Additional Info -->
                <div class="additional-info" style="margin-top: 20px;">
                    <p style="font-size: 12px; margin: 5px 0;">Birthdate: <?= isset($data['bdate']) ? $data['bdate'] : '' ?></p>
                </div>

            </div>

            <!-- Print Button -->
            <div class="no-print" style="text-align: center; margin-top: 20px;">
                <button onclick="window.print()" class="btn btn-primary">Print ID</button>
            </div>
        </div>
    </div>
</div>

<!-- Print Style -->
<style>
    @media print {
        .id-card-wrapper {
            page-break-after: avoid;
            width: 300px;
            height: 500px;
        }

        .no-print {
            display: none;
        }
    }
</style>