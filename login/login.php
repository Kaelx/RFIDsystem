<style>
    body {
        position: relative;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('../assets/defaults/EVSU-v2.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        filter: blur(5px);
        z-index: -1;
    }

    body::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.3);
        z-index: -1;
    }
</style>


<div class="d-flex flex-column min-vh-100">
    <!-- Main Content -->
    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card w-100 shadow">
            <div class="row">
                <!-- Left Form (Carousel) - Hidden on Mobile -->
                <div class="col-md-6 d-none d-md-flex justify-content-center p-3">
                    <div class="container">
                        <div id="carouselExample" class="carousel slide w-100" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../assets/defaults/evsu.png" class="d-block w-100" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img src="../assets/defaults/elevatech.jpg" class="d-block w-100" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img src="../assets/defaults/rfid.jpg" class="d-block w-100" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Form (Login Form) -->
                <div class="col-12 col-md-6 p-3">
                    <div class="container p-4">
                        <h1 class="mb-4 text-center" style="font-weight:bold; font-size: 48px;">LOGIN</h1>
                        <form action="#" id="submit-form">
                            <div class="form-group mb-4">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username" autofocus autocomplete="on">
                            </div>
                            <div class="form-group mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" autocomplete="on">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-50">Login</button>
                            </div>
                            <hr>
                            <div class="login-footer mt-3 text-center">
                                <a href="index.php?page=forgotpass" style="text-decoration:underline;">Forgot Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-auto text-white py-4">
        <div class="container text-center">
            <p class="mb-2">EVSU-OC Verification Entry & Exit System. All Rights Reserved 2024-<span id="year"></span></p>
            <p class="mb-2">A Capstone Project of <strong style="text-decoration: underline;">Elevatech Company</strong></p>

            <!-- Social Media Icons (Optional) -->
            <div>
                <a href="#" class="text-white mx-2">
                    <i class="bi bi-facebook" style="font-size: 24px;"></i>
                </a>
                <a href="#" class="text-white mx-2">
                    <i class="bi bi-twitter" style="font-size: 24px;"></i>
                </a>
                <a href="#" class="text-white mx-2">
                    <i class="bi bi-linkedin" style="font-size: 24px;"></i>
                </a>
            </div>
        </div>
    </footer>

</div>


<script>
    $(document).ready(function() {
        document.getElementById('year').innerHTML = new Date().getFullYear();

        const cooldownTime = 60 * 1000;

        $('#submit-form').submit(function(e) {
            e.preventDefault();

            // Form validation
            if (!validateForm(this) || !$(this).valid()) {
                return;
            }

            const cooldownEnd = parseInt(localStorage.getItem('cooldownEnd'), 10);

            const currentTime = new Date().getTime();
            if (cooldownEnd && currentTime < cooldownEnd) {
                const remainingTime = Math.ceil((cooldownEnd - currentTime) / 1000);
                alert_toast(`Too many failed attempts. Please wait ${remainingTime} seconds before trying again `, 'danger');
                return;
            }

            if (cooldownEnd && currentTime >= cooldownEnd) {
                localStorage.removeItem('cooldownEnd');
                localStorage.setItem('failedAttempts', '0');
            }

            start_load();
            $.ajax({
                url: 'ajax.php?action=login',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp == 1) {
                        localStorage.setItem('failedAttempts', '0');
                        location.href = 'index';
                    } else {
                        handleFailedLogin(resp);
                    }
                },
                error: function() {
                    alert_toast('An error occurred', 'danger');
                    setTimeout(end_load, 1000);
                }
            });
        });

        function handleFailedLogin(resp) {
            let failedAttempts = parseInt(localStorage.getItem('failedAttempts'), 10) || 0;
            failedAttempts += 1;
            localStorage.setItem('failedAttempts', failedAttempts);

            if (failedAttempts >= 3) {
                const newCooldownEnd = new Date().getTime() + cooldownTime; // Set cooldown for 60 seconds
                localStorage.setItem('cooldownEnd', newCooldownEnd);
                alert_toast('Too many failed attempts. Please wait 60 seconds before trying again ', 'danger');
            } else {
                // Display specific error messages based on response
                switch (resp) {
                    case '2':
                        alert_toast('Invalid Credentials ', 'danger');
                        break;
                    case '3':
                        alert_toast('Invalid Credentials ', 'danger');
                        break;
                    default:
                        alert_toast('An error occurred ', 'danger');
                        break;
                }
            }
            setTimeout(end_load, 1000);
        }
    });
</script>