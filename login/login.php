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
    <div class="card login-card shadow" style="max-width: 900px;">
        <div class="row g-0">
            <!-- Left Image -->
            <div class="col-md-6">
                <img class="m-4" src="../assets/defaults/evsu.png" alt="Login Image"> <!-- Replace with path to your image -->
            </div>
            <!-- Right Form -->
            <div class="col-md-6 p-5">
                <h1 class="mb-4">LOGIN</h1>
                <form accept="#" id="login-form">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <hr>
                    <div class="login-footer mt-3">
                        <a href="index.php?page=forgotpass">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#login-form').submit(function(e) {
            e.preventDefault()

            //regex validation
            if (!validateForm(this)) {
                return;
            }

            start_load()
            $.ajax({
                url: 'ajax.php?action=login',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    end_load()

                    console.log(resp);
                    if (resp == 1) {
                        location.href = 'index.php?page=home';
                    } else if (resp == 2) {
                        alert_toast('Wrong password', 'danger');
                    } else if (resp == 3) {
                        alert_toast('No account found', 'danger');
                    } else {
                        alert_toast('An error occured', 'danger')
                    }
                }
            })
        })
    })
</script>