<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-2">
    <div class="text-center">
        <h3>Admin User Setting</h3>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-1 "></div>
        <div class="col-md-10 p-2 ">
            <!-- add new cat -->
            <a href="<?= base_url('admin/addnew_admin_user')?>" class="btn btn-primary btn-sm float-right" >Add New admin User</a>
            <!-- add new cat -->
            <br><hr>
            <div class="card">
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-hovered table-bordered ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User name </th>
                                    <th>Login Username </th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($adminuserList as $key => $uinfo): ?>
                                    <tr>
                                        <th>#</th>
                                        <th><?= $uinfo->name ?></th>
                                        <th><?= $uinfo->username ?></th>
                                        <th>
                                            <a href="<?= base_url('admin/edit_admin_user_permission/'.$uinfo->id)?>" class="btn btn-link btn-sm" data-toggle="tooltip" title="Add Permissions">Permissions Setting</a>
                                        </th>
                                        <th>
                                                <div class="btn-group">
                                                    <a href="<?= base_url('admin/edit_admin_user/'.$uinfo->id)?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit Product"><i class="fa fa-pencil"></i></a>
                                                    <a href="<?= base_url('admin/deleteproduct/'.$uinfo->id)?>" onclick="return confirm('Are you sure you want to delete this admin user?')"class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Product"><i class="fa fa-trash"></i></a>
                                                </div>

                                        </th>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>        
                </div>
            </div>
        
    </div>
        <div class="col-md-1"></div>
    </div>
<?php 
    include_once('includes/footer.php');
?>