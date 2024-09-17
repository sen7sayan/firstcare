<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>All Pages Setting</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-1 "></div>
        <div class="col-md-10 p-2 ">
            <!-- add new cat -->
            <a href="<?= base_url('index.php/admin/add_new_page')?>" class="btn btn-success btn-sm float-right" >Add New Page</a>
            <!-- add new cat -->
            <br><hr>
            <div class="card">
                <div class="card-body p-3">
                   <table class="table table-hovered table-bordered ">
                       <thead>
                           <tr>
                               <th>#</th>
                               <th>Page Name</th>
                               <th>Status</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php foreach ($allpages as $key => $pageInfo): ?>
                               <tr>
                                   <td><?= $key + 1?></td>
                                   <td><?= $pageInfo->name ?></td>
                                   <td>
                                       <?php if ($pageInfo->status == 1): ?>
                                           <span class="badge badge-success">Active</span>
                                       <?php else: ?>
                                            <span class="badge badge-danger">Disabled</span>
                                       <?php endif ?>
                                   </td>
                                   <td>
                                       <div class="btn-group">
                                                <a href="<?= base_url('index.php/admin/page_setting/'.$pageInfo->id."/other")?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit Page"><i class="fa fa-pencil"></i></a>
                                                <a href="<?= base_url('index.php/admin/deletepage/'.$pageInfo->id)?>" onclick="return confirm('Are you sure you want to delete this page?')"class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Page"><i class="fa fa-trash"></i></a>
                                               

                                               
                                            </div>
                                   </td>
                               </tr>
                           <?php endforeach ?>
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

<?php 
    include_once('includes/footer.php');
?>