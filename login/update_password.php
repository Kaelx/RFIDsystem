<?php

if (!isset($_SESSION['otp']) && !isset($_SESSION['mail'])) {
    header('location:?p=login');
}

?>


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

    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;


    }

    .login-card img {
        width: 100%;
        object-fit: cover;
    }

    .form-control {
        margin-bottom: 1rem;
    }

    .login-footer {
        text-align: center;
        margin-top: 1rem;
    }
</style>

<div class="login-container">
    <div class="card shadow login-card" style="width: 600px;">
        <div>
            <div class="p-5">
                <h1 class="mb-4 text-center" style="font-weight:bold; font-size: 48px;">Password Update</h1>
                <form accept="#" id="submit-form">
                    <div class="form-group mb-3">
                        <label for="otpcode" class="form-label">OTP Code</label>
                        <input type="number" class="form-control" name="otpcode" id="otpcode" placeholder="Enter your OTP Code" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <label for="newpass" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="newpass" id="newpass" placeholder="Enter your new password" minlength="8">
                    </div>
                    <div class="form-group mb-3">
                        <label for="confirmpass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmpass" id="confirmpass" placeholder="Confirm you password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-50">Update</button>
                    </div>
                    <hr>
                    <div class="login-footer mt-3">
                        <a href="?p=login" style="text-decoration:underline;">Go back to Login</a>
                    </div>
                </form>
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
                url: 'ajax.php?action=updatepass',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {

                    if (resp == 1) {
                        alert_toast('Password successfully updated', 'success')
                        setTimeout(function() {
                            location.href = '?p=login';
                        }, 1000)
                    } else if (resp == 2) {
                        alert_toast('Something went wrong', 'danger')
                        setTimeout(function() {
                            end_load();
                        }, 1000)
                    } else if (resp == 3) {
                        alert_toast('Password did not match', 'danger')
                        setTimeout(function() {
                            end_load();
                        }, 1000)
                    } else if (resp == 4) {
                        alert_toast('OTP Code did not match', 'danger')
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