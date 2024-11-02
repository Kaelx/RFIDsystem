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
            <!-- Left Form (Carousel) - Hidden on Mobile -->
            <div class="col-md-6 d-none d-md-flex justify-content-center p-3">
                <div class="container">
                    <div id="carouselExample" class="carousel slide w-100" data-ride="carousel">
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

            <!-- Right Form (Login Form) -->
            <div class="col-12 col-md-6 p-3">
                <div class="container p-4">
                    <h1 class="mb-4 text-center" style="color: #a91414; font-weight:bold; font-size: 54px;">LOGIN</h1>
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
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <hr>
                        <div class="login-footer mt-3 text-center">
                            <a href="index.php?page=forgotpass">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
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
                url: 'ajax.php?action=login',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {

                    if (resp == 1) {
                        location.href = 'index';
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
                        alert_toast('An error occured', 'danger')
                        setTimeout(function() {
                            end_load();
                        }, 1000)
                    }
                }
            })
        })
    });
</script>