<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Add New admin User</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-4 "></div>
        <div class="col-md-4 p-2 ">
            <!-- add new cat -->
            <div class="card">
                <div class="card-body p-3">
                    <form method="post" action="<?= base_url('admin/addadminprofile')?>">
                        <div class="form-group">
                            <label for="catname">Name</label>
                            <input type="text" name="uname" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="catname">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter Username" required >
                        </div>
                        <div class="form-group">
                            <label for="catname">Password</label>
                            <input type="text" name="password" class="form-control" placeholder="Enter password" required>
                        </div>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
        </div>
        
    </div>
        <div class="col-md-4"></div>
    </div>
<?php 
    include_once('includes/footer.php');
?>