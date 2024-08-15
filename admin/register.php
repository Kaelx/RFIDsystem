<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Register</h1>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="#">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname">
                    </div>
                </div>

                <div class="form-group">
                    <label for="studentid">Student ID</label>
                    <input type="text" class="form-control" id="studentid" name="studentid">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="email">
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="department">School Department</label>
                        <input type="text" class="form-control" id="department" name="department">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="program">School Program</label>
                        <input type="text" class="form-control" id="program" name="program">
                    </div>
                </div>

                <div class="form-group">
                    <label for="rfid">RFID</label>
                    <input type="text" class="form-control" id="rfid" name="rfid">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="index.php?page=data" class="btn btn-secondary">Cancel</a>
            </form>


        </div>
    </section>

</div>