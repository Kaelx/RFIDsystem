    <!-- <h1>Forgot Password</h1>
    <form action="#" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" autofocus required>
        </div>
        <button type="submit" class="btn btn-primary">Recover</button>
    </form>

    <hr>
    <a href="index.php?page=login">Login</a> -->




    <style>
    body {
        background-image: url('../assets/defaults/bg-elevatech.jpg');
        /* Replace with background image path */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
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
    <div class="card login-card" style="max-width: 900px;">
        <div class="row g-0">
            <!-- Left Image -->
            <div class="col-md-6">
                <img src="../assets/defaults/logo-img.png" alt="Login Image"> <!-- Replace with path to your image -->
            </div>
            <!-- Right Form -->
            <div class="col-md-6 p-5">
                <h1 class="mb-4">LOGIN</h1>
                <form accept="#" id="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Recover</button>
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

</script>