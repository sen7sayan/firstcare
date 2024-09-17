<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Coupon Setting</h3>
        <hr>
    </div>
    
    <div class="row">
        
        <div class="col-md-12 pt-0 p-2 ">
            <!-- add new slide -->
            <a href="<?= base_url('admin/add_new_coupon')?>" class="btn btn-success btn-sm float-right" >Add New Coupon</a>
            <br><hr>
            <!-- add new slide -->
             <div class="card">
                 <div class="card-body p-3 shadow">
                       <table class="table table-hovered table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Coupon Code</th>
                                    <th>Off Type</th>
                                    <th>Off Price</th>
                                    <th>Max Usage </th>
                                    <th>Total Used</th>
                                    <th>Applied On</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($coupList as $key => $coupon): ?>
                                    <tr>
                                        <td><?= $key + 1?></td>
                                        <td>
                                            <?php if ($coupon->status == 1): ?>
                                                <span class="badge badge-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Disbaled</span>
                                            <?php endif ?>
                                        </td>
                                        <td><h5 class="text-dark text-uppercase font-weight-bold"><?= $coupon->code ?></h5></td>
                                        <td>
                                            <?php if ($coupon->offType == 1): ?>
                                                <span class="badge badge-primary">Percentage</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Flat Off</span>
                                            <?php endif ?>
                                        </td>
                                        <td><?= $coupon->offPrice ?></td>
                                        <td><?php
                                            if (!empty($coupon->maxUse)) {
                                                echo $coupon->maxUse;
                                            }
                                            else{
                                                echo "No limit";
                                            }
                                          ?></td>
                                        <td><?= $coupon->countings ?></td>
                                        <td>
                                            <?php if ($coupon->type == 0): ?>
                                                <span class="badge badge-success">All Product</span>
                                            <?php elseif ($coupon->type == 1): ?>
                                                <span class="badge badge-info">Logged In User</span>
                                            <?php elseif ($coupon->type == 2): ?>
                                                <span class="badge badge-success">Selected Products</span>
                                            <?php elseif ($coupon->type == 3): ?>
                                                <span class="badge badge-warning">Min Cart Price</span>
                                            <?php elseif ($coupon->type == 4): ?>
                                                <span class="badge badge-secondary">Selected Category</span>
                                            <?php elseif ($coupon->type == 5): ?>
                                                <span class="badge badge-danger">Max Cart Price</span>
                                            <?php else: ?>
                                                <span class="badge badge-success">All Product</span>
                                            <?php endif ?>
                                        </td>
                                        
                                        <td><?= date("d-M-Y", strtotime($coupon->startDate)) ?></td>
                                        <td><?= date("d-M-Y", strtotime($coupon->endDate)) ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?= base_url('admin/editcoupon/'.$coupon->id)?>" class="btn btn-link text-primary">Edit/View </a>
                                                <a onclick="return confirm('Are you sure want to change status of this coupon?')" href="<?= base_url('admin/changeCouponStatus/'.$coupon->id.'/'.$coupon->status)?>" class="btn btn-link text-warning">
                                                    <?php if ($coupon->status == 1): ?>
                                                        Disable
                                                    <?php else: ?>
                                                        Enable
                                                    <?php endif ?>
                                                 </a>
                                                <a onclick="return confirm('Are you sure want to delete this coupon?')" href="<?= base_url('admin/deleteCoupon/'.$coupon->id)?>" class="btn btn-link text-danger">Delete </a>
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