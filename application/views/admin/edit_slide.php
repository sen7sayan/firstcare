<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Add New Slide</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-1 "></div>
        <div class="col-md-10 p-2 ">
            <!-- add new cat -->
            <a href="<?= base_url('index.php/admin/sliderList')?>" class="btn btn-success btn-sm float-right" >Back Slide List</a>
            <!-- add new cat -->
            <br><hr>
            <div class="card">
                <div class="card-body p-3">
                   <form action="<?= base_url('index.php/admin/edit_slideData')?>" method="post" >
                    
                     <div class="row">
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="catname">Choose Slide Image(Required)</label>
                                 <?php 
                                    $imgurl = $slideInfo->imgPath;
                                    include('includes/imageBox.php');
                                ?>
                                <input type="hidden" name="slideId" value="<?= $slideInfo->id ?>">
                            </div>
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="catname">Slide Link</label>
                                <input type="text" name="slideLink" id="catname" class="form-control" placeholder="Enter Category name" required value="<?= $slideInfo->link ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="catname">Alt Text</label>
                                <input type="text" name="altText" id="catname" class="form-control" placeholder="Enter Alt Text" value="<?= $slideInfo->alttext ?>">
                            </div>
                        </div>
                        <div class="col-md-3 px-2">
                            <div class="form-group">
                                <label for="catname">Sequence No</label>
                                <input type="number" name="sequence" id="catname" class="form-control" placeholder="Enter Sequence No" value="<?= $slideInfo->sortNum ?>">
                            </div>
                        </div>
                        <div class="col-md-3 px-2">
                            <?php 
                                if ($slideInfo->device == 1) {
                                        $destopV = "selected";
                                        $mobileV = "";
                                        $allV = "";
                                    }
                                elseif ($slideInfo->device == 2) {
                                    $destopV = "";
                                    $mobileV = "selected";
                                    $allV = "";
                                }
                                else{
                                    $destopV = "";
                                    $mobileV = "";
                                    $allV = "selected";
                                }
                             ?>
                            <label class="form-label">Slider Visibility:</label>
                            <select class="default-select  form-control wide" name="deviceSlide" required >
                                <option <?= $destopV ?> value="1">Visible in Desktop Only</option>
                                <option <?= $mobileV ?> value="2">Visible in Mobile Only</option>
                                <option <?= $allV ?> value="3">Visible in all Device</option>
                            </select>
                        </div>
                        
                     </div> 
                     <button type="submit" class="btn btn-primary">Submit</button>  
                   </form> 
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

<?php 
    include_once('includes/footer.php');
?>