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

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow w-100">
        <div class="row g-0">
            <!-- Left Image -->
            <div class="col-md-6 col-12 p-3">
                <div class="container">
                    <div id="carouselExample" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../assets/defaults/evsu.png" class="d-block w-100" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img src="../assets/defaults/evsu.png" class="d-block w-100" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img src="../assets/defaults/evsu.png" class="d-block w-100" alt="Third slide">
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
            <div class="col-md-6 col-12 p-3">
                <div class="container p-5">
                    <h1 class="mb-4 text-center">Password Recovery</h1>
                    <form accept="#" id="forgot-pass">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required autofocus>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Recover</button>
                        </div>
                        <hr>
                        <div class="login-footer mt-3 text-center">
                            <a href="index.php?page=login">Go back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#forgot-pass').submit(function(e) {
            e.preventDefault()

            //regex validation
            if (!validateForm(this)) {
                return;
            }

            start_load()
            $.ajax({
                url: 'ajax.php?action=forgot_pass',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    end_load()

                    console.log(resp);
                    if (resp == 1) {
                        alert_toast('OTP CODE has been sent to your email', 'success');
                        setTimeout(function() {
                            location.replace('index.php?page=update_password')
                        }, 2000)
                    } else if (resp == 2) {
                        alert_toast('Wrong password', 'danger');
                    } else if (resp == 3) {
                        alert_toast('No account found', 'danger');
                    } else {
                        alert_toast('An error occured. Please try again later', 'danger')
                    }
                }
            })
        })
    });
</script>