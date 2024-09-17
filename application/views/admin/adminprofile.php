<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Update profile</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-4 "></div>
        <div class="col-md-4 p-2 ">
            <!-- add new cat -->
            <a href="<?= base_url('admin/adminUserSetting')?>" class="btn btn-primary btn-sm float-right" >Admin User Setting</a>
            <!-- add new cat -->
            <br><hr>
            <div class="card">
                <div class="card-body p-3">
                    <form method="post" action="<?= base_url('admin/updateadminprofile')?>">

                        <input type="hidden" name="userId" value="<?= $this->session->userdata('adminId'); ?>" >
                        <div class="form-group">
                            <label for="catname">Name</label>
                            <input type="text" name="uname" class="form-control" placeholder="Enter Name" required value="<?= $adminInfo->name?>" >
                        </div>
                        <div class="form-group">
                            <label for="catname">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter Username" required value="<?= $adminInfo->username?>" >
                        </div>
                        <div class="form-group">
                            <label for="catname">Password</label>
                            <input type="text" name="password" class="form-control" placeholder="Enter password">
                            <small class="text-danger">Note : Password is hidden for security purpose. If you dont want to change the password then leave password field blank</small>
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