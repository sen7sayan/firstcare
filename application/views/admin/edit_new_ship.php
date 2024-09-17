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
            <a href="<?= base_url('admin/shippingSetting')?>" class="btn btn-success btn-sm float-right" >Shipping Setting</a>
            <br><hr>
            <!-- add new slide -->
             <div class="card">
                 <div class="card-body p-3 shadow px-5">
                     <form action="<?= base_url('admin/edit_new_ship_data')?>" method="post" >
                    
                         <div class="row">
                            <div class="col-md-12 px-2">
                                <div class="form-group">
                                    <input type="hidden" name="shipId" value="<?= $shipInfo->id ?>">
                                    <label for="catname">Name <small>(Example : Metro Cities )</small></label>
                                    <input type="text" name="shipname"  class="form-control" placeholder="Enter Shipping Name" required value="<?= $shipInfo->name ?>">
                                </div>
                            </div>
                            <div class="col-md-4 px-2">
                                <div class="form-group">
                                    <label for="catname">Shipping Type</label>
                                    <select class="form-control" name="shiptype" >
                                        <?php 
                                            if ($shipInfo->type == 0) {
                                                $frees = "selected";
                                                $cartVal = "";
                                            }
                                            else{
                                                $frees = "";
                                                $cartVal = "selected";
                                            }
                                         ?>
                                        <option <?= $frees ?> value="0">Free</option>
                                        <option <?= $cartVal ?> value="1">On Minimum Cart Price</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 px-2">
                                <div class="form-group">
                                    <label for="catname">Enter Cart Value</label>
                                    <input type="text" name="shipcart"  class="form-control" placeholder="Enter cart value" value="<?= $shipInfo->cartvalues ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-4 px-2">
                               
                                    <div class="form-group">
                                        <label id="input-text">Select Categories</label>
                                        <div id="changeInput">
                                            <?php 
                                                $states = state_list(); // From custom helper
                                                $selectedStates = explode(",", $shipInfo->states);

                                             ?>
                                            <select id="couponTypeListInfo" class="nameofcats form-control" name="shipstate[]" multiple="multiple" >
                                                <?php 
                                                    
                                                        foreach ($states as $statename) {
                                                            if (in_array($statename, $selectedStates)) {
                                                                $seleState = "selected";
                                                            }
                                                            else{
                                                                $seleState = "";
                                                            }
                                                            ?>
                                                               <option <?= $seleState ?> value="<?= $statename; ?>"><?= $statename; ?></option> 
                                                            <?php
                                                        }
                                                    
                                                 ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Enter Shipping Charge <small class="text-danger">(if order value is less than min cart value)</small></label>
                                    <input type="text" name="shipprice"  class="form-control" placeholder="Enter Off Price"  value="<?= $shipInfo->shipcharge ?>">
                                </div>
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Enter Shipping Charge <small class="text-success">(if order value is greater than min cart value)</small></label>
                                    <input type="text" name="aftershipprice"  class="form-control" placeholder="Enter Off Price"  value="<?= $shipInfo->after_shipcharge ?>">
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
    });
</script>
<?php 
    include_once('includes/footer.php');
?>