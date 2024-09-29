<?php 

if(!isset($_SESSION['otp']) && !isset($_SESSION['mail'])){
    header('location:index.php?page=login');
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
        filter: blur(6px);
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
                <h1 class="mb-4 text-center">Update your password</h1>
                <form accept="#" id="updatepass">
                    <div class="mb-3">
                        <label for="otpcode" class="form-label">OTP Code</label>
                        <input type="number" class="form-control" name="otpcode" id="otpcode" placeholder="Enter your OTP Code" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="newpass" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="newpass" id="newpass" placeholder="Enter your new password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmpass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmpass" id="confirmpass" placeholder="Confirm you password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    <hr>
                    <div class="login-footer mt-3">
                        <a href="index.php?page=login">Go back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#updatepass').submit(function(e) {
            e.preventDefault()

            //regex validation
            if (!validateForm(this)) {
                return;
            }

            start_load()
            $.ajax({
                url: 'ajax.php?action=updatepass',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    end_load()

                    console.log(resp);
                    if (resp == 1) {
                        alert_toast('Password successfully updated', 'success')
                        setTimeout(function() {
                            location.replace('index.php?page=login')
                        }, 2000)
                    } else if (resp == 2) {
                        alert_toast('Something went wrong', 'danger')
                    } else if (resp == 3) {
                        alert_toast('Password did not match', 'danger')
                    } else if (resp == 4) {
                        alert_toast('OTP Code did not match', 'danger')
                    } else {
                        alert_toast('An error occured', 'danger')
                    }
                }
            })
        })
    });
</script>