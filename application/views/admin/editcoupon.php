<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Coupon Setting</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 p-3 ">
            <!-- add new slide -->
            <a href="<?= base_url('admin/coupon_setting')?>" class="btn btn-success btn-sm float-right" >Coupon Setting</a>
            <br><hr>
            <!-- add new slide -->
             <div class="card">
                 <div class="card-body p-3 shadow px-5">
                     <form action="<?= base_url('admin/edit_coupon_data')?>" method="post" >
                            <input type="hidden" name="coupId" value="<?= $coupon->id ?>">
                         <div class="row">
                            <div class="col-md-4 px-2">
                                <div class="form-group">
                                    <label for="catname">Coupon Code(Please enter Uppercase)</label>
                                    <input type="text" value="<?= $coupon->code ?>" name="couponcode"  class="form-control" placeholder="Enter coupon code" required>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-4 px-2">
                                <div class="form-group">
                                    <label for="catname">Price Off Type</label>
                                    <select class="form-control" name="offtype">
                                        <?php 
                                            if ($coupon->offType == 1) {
                                                $per = "selected";
                                                $flate = "";
                                            }
                                            else{
                                                $per = "";
                                                $flate = "selected";
                                            }
                                         ?>
                                        <option <?= $per ?> value="1">Percentage</option>
                                        <option <?= $flate ?> value="2">Fixed Amaount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 px-2">
                                <div class="form-group">
                                    <label for="catname">Enter Off Price</label>
                                    <input type="text" name="offprice" value="<?= $coupon->offPrice ?>" class="form-control" placeholder="Enter Off Price" required >
                                </div>
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">How many times can be use?<strong>(empty =infinite)</strong></label>
                                    <input type="text" name="maxuse" value="<?= $coupon->maxUse ?>" class="form-control" placeholder="How many times can be use?">
                                </div>
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Coupon Applies on</label>
                                    <br>
                                   <?php if ($coupon->type == 0): ?>
                                        <span class="badge badge-success">All Product</span>
                                    <?php elseif ($coupon->type == 1): ?>
                                        <span class="badge badge-info">Logged In User</span>
                                    <?php elseif ($coupon->type == 2): ?>
                                        <span class="badge badge-success">Selected Products</span>
                                        <br>
                                        <small>Product list: </small>
                                        <br>
                                        <?php 
                                            $itemsapp =  explode(",", $coupon->typeValue);
                                            $prolist = $this->db->select("name")->where_in("id",$itemsapp)->get("products")->result();
                                            foreach ($prolist as $key => $provalue) {
                                                $count = $key + 1;
                                                echo "<small>$count. $provalue->name</small> <br>";
                                            }
                                         ?>
                                    <?php elseif ($coupon->type == 3): ?>
                                        <span class="badge badge-warning">Min Cart Price</span>
                                    <?php elseif ($coupon->type == 4): ?>
                                        <span class="badge badge-secondary">Selected Category</span>
                                        <br>
                                        <small>Category list: </small>
                                        <br>
                                        <?php 
                                            $itemsapp2 =  explode(",", $coupon->typeValue);
                                            $catlist = $this->db->select("name")->where_in("id",$itemsapp2)->get("categories")->result();
                                            foreach ($catlist as $key => $provalue) {
                                                $count = $key + 1;
                                                echo "<small>$count. $provalue->name</small> <br>";
                                            }    
                                         ?>
                                    <?php elseif ($coupon->type == 5): ?>
                                        <span class="badge badge-danger">Max Cart Price</span>
                                    <?php else: ?>
                                        <span class="badge badge-success">All Product</span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <!-- <div class="col-md-12 px-2">
                                <div class="coupnarea">
                                    <div class="form-group">
                                        <label id="input-text">Coupons Applied on</label>
                                        
                                    </div>
                                </div>
                            </div> -->
                             <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Coupon start date</label>
                                     <input type="date" value="<?= $coupon->startDate ?>" name="startdate" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Coupon end date</label>
                                     <input type="date" value="<?= $coupon->endDate ?>" name="enddate" class="form-control">
                                </div>
                            </div>
                            
                         </div> 
                         <button type="submit" class="btn btn-primary">Submit</button>  
                       </form>
                 </div>
             </div>   
        </div>
      <div class="col-md-1"></div>
    </div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.nameofcats').select2({
            placeholder: 'Select categories',
            width: 'resolve',
            allowClear:true,
            dropdownAutoWidth:true,
            closeOnSelect:false,
        });
    });
</script>
<?php 
    include_once('includes/footer.php');
?>