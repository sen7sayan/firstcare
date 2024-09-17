<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Review Setting</h3>
        <hr>
    </div>
    
    <div class="row">
        
        <div class="col-md-12 pt-0 p-2 ">
            <!-- add new slide -->
            <a href="<?= base_url('admin/add_new_review')?>" class="btn btn-success btn-sm float-right" >Add New Review</a>
            <br><hr>
            <!-- add new slide -->
             <div class="card">
                 <div class="card-body p-3 shadow">
                       <table class="table table-hovered table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Product</th>
                                    <th>Star</th>
                                    <th>Comment</th>
                                    <th>User Type</th>
                                    <th>User Info</th>
                                    <th>Date and Time </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($allReviews as $key => $review): ?>
                                    <tr>
                                        <td><?= $key + 1?></td>
                                        <td>
                                            <?php if ($review->status == 1): ?>
                                                <span class="badge badge-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Hidden</span>
                                            <?php endif ?>
                                        </td>
                                        <td width="200px">
                                            <?php 
                                                $proInfo = $this->db->where("id",$review->productId)->get("products")->row();
                                             ?>
                                             <img src="<?= base_url($proInfo->featureImg)?>" height="70" width="70">
                                             <br>
                                             <small><?= $proInfo->name ?></small>
                                        </td>
                                        <td>
                                            <?= $review->urating ?>
                                        </td>
                                        <td>
                                            <?= $review->comment ?>
                                        </td>
                                        <td>
                                            <?php if ($review->type == 1): ?>
                                                <span class="badge badge-success">Existed User</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Guest User</span>
                                            <?php endif ?>
                                        </td>    
                                        <td>
                                            Name : <?= $review->name ?>
                                            <br>
                                            Email : <?= $review->email ?>
                                            <br>
                                            Phone : <?= $review->phone ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $d=strtotime($review->created_at);
                                                echo date("d-M-Y h:i:sa", $d);
                                             ?>
                                            
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?= base_url('admin/editcoupon/'.$review->id)?>" class="btn btn-link text-primary">Edit </a>
                                                <a onclick="return confirm('Are you sure want to change status of this review?')" href="<?= base_url('admin/changeReviewStatus/'.$review->id.'/'.$review->status)?>" class="btn btn-link text-warning">
                                                    <?php if ($review->status == 1): ?>
                                                        Hide 
                                                    <?php else: ?>
                                                        Approve
                                                    <?php endif ?>
                                                 </a>
                                                <a onclick="return confirm('Are you sure want to delete this review?')" href="<?= base_url('admin/deleteReview/'.$review->id)?>" class="btn btn-link text-danger">Delete </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                 </div>
             </div>   
        </div>
    </div>
<?php 
    include_once('includes/footer.php');
?>