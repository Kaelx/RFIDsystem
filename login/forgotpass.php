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
    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card shadow w-100">
            <div class="row">
                <!-- Left Image (Carousel) - Hidden on Mobile -->
                <div class="col-md-6 d-none d-md-flex justify-content-center p-3">
                    <div class="container">
                        <div id="carouselExample" class="carousel slide  w-100" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../assets/defaults/evsu.png" class="d-block w-100" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img src="../assets/defaults/elevatech.jpg" class="d-block w-100" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img src="../assets/defaults/rfid.png" class="d-block w-100" alt="Third slide">
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
                <!-- Right Form -->
                <div class="col-12 col-md-6 p-3">
                    <div class="container p-4">
                        <h1 class="mb-4 text-center" style="font-weight:bold; font-size: 48px;">Password Recovery</h1>
                        <form accept="#" id="submit-form">
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" autofocus autocomplete="on">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-50">Recover</button>
                            </div>
                            <hr>
                            <div class="login-footer mt-3 text-center">
                                <a href="index.php?page=login" style="text-decoration:underline;">Go back to Login</a>
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
            <p class="mb-2">
                EVSU-OC Entry & Exit Verification System. All Rights Reserved &copy; 2024-<span id="year"></span>
            </p>
            <p class="mb-2">
                A Capstone Project by <a href="https://github.com/Kaelx" target="_blank" rel="noopener noreferrer" style="text-decoration: underline; color: white;">Elevatech</a>
            </p>
        </div>
    </footer>
</div>


<script>
    $(document).ready(function() {
        document.getElementById('year').innerHTML = new Date().getFullYear();

        $('#submit-form').submit(function(e) {
            e.preventDefault()

            //regex validation
            if (!validateForm(this)) {
                return;
            }

            // Validate the form before AJAX submission
            if (!$(this).valid()) {
                return;
            }

            start_load()
            $.ajax({
                url: 'ajax.php?action=forgot_pass',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast('OTP CODE has been sent to your email', 'success');
                        setTimeout(function() {
                            location.href = 'index.php?page=update_password';
                        }, 1000)
                    } else if (resp == 2) {
                        alert_toast('Wrong password', 'danger');
                        setTimeout(function() {
                            end_load();
                        }, 1000)
                    } else if (resp == 3) {
                        alert_toast('No account found', 'danger');
                        setTimeout(function() {
                            end_load();
                        }, 1000)
                    } else {
                        alert_toast('An error occured. Please try again later', 'danger')
                        setTimeout(function() {
                            end_load();
                        }, 1000)
                    }
                }
            })
        })
    });
</script>