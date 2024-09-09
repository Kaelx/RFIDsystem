    <h1>Login</h1>
    <form action="#" id="login-form">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" autofocus required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <hr>
    <a href="index.php?page=forgotpass">Forgot Password</a>


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
                            alert_toast('Login success', 'success');
                            setTimeout(function() {
                                location.href = 'index.php?page=home';
                            }, 1200);
                        } else if (resp == 2) {
                            alert_toast('Wrong password', 'warning');
                        } else if (resp == 3) {
                            alert_toast('No account found','warning');
                        } else {
                            alert_toast('An error occured','danger')
                        }
                    }
                })
            })
        })
    </script>