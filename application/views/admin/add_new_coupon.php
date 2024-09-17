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
                     <form action="<?= base_url('admin/add_new_coupon_data')?>" method="post" >
                    
                         <div class="row">
                            <div class="col-md-4 px-2">
                                <div class="form-group">
                                    <label for="catname">Coupon Code(Please enter Uppercase)</label>
                                    <input type="text" name="couponcode"  class="form-control" placeholder="Enter coupon code" required>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-4 px-2">
                                <div class="form-group">
                                    <label for="catname">Price Off Type</label>
                                    <select class="form-control" name="offtype">
                                        <option value="1">Percentage</option>
                                        <option value="2">Fixed Amaount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 px-2">
                                <div class="form-group">
                                    <label for="catname">Enter Off Price</label>
                                    <input type="text" name="offprice"  class="form-control" placeholder="Enter Off Price" required >
                                </div>
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">How many times can be use?<strong>(empty =infinite)</strong></label>
                                    <input type="text" name="maxuse"  class="form-control" placeholder="How many times can be use?">
                                </div>
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Coupon Applies on</label>
                                    <select class="form-control coupontype" name="coupontype" >
                                        <option value="0">All Products</option>
                                        <option value="3">On Minimum Cart Price</option>
                                        <option value="5">On Maximum Cart Price</option>
                                        <option value="2">On Selected Products</option>
                                        <option selected value="4">On Selected Categories</option>
                                        <option value="1">Only for login Users</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 px-2">
                                <div class="coupnarea">
                                    <div class="form-group">
                                        <label id="input-text">Select Categories</label>
                                        <div id="changeInput">
                                            <select id="couponTypeListInfo" class="nameofcats form-control" name="couponapplies[]" multiple="multiple" >
                                                <?php 
                                                    if(!empty($catList)) {
                                                        foreach ($catList as $category) {
                                                            ?>
                                                               <option value="<?= $category->id ?>"><?= $category->name ?></option> 
                                                            <?php
                                                        }
                                                    }
                                                 ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Coupon start date</label>
                                     <input type="date" name="startdate" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Coupon end date</label>
                                     <input type="date" name="enddate" class="form-control">
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
            tags: true
        });

        $(document.body).on("change",".coupontype",function() {
            $("#loader").css("display","block");
            let coupType = $(this).val();
            
            // console.log(coupType);

            const formdata = new FormData();
            formdata.append("coupontype",coupType); 
            axios.post("<?= base_url('admin/getcouponTypeInput')?>", formdata).then(function (response) {
                // console.log(response.data);
                if (coupType == 3 || coupType == 5) {
                    $("#changeInput").html(response.data.dataType)
                }
                else{
                    $("#couponTypeListInfo").find('option').remove();
                    $("#couponTypeListInfo").append(response.data.dataType)
                }
                
                $("#input-text").html(response.data.text)
                $("#loader").css("display","none");
              })
              .catch((error) => console.log(error));

        });
        
    });
</script>
<?php 
    include_once('includes/footer.php');
?>