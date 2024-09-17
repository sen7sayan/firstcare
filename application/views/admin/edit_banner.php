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
                   <form action="<?= base_url('index.php/admin/edit_bannerData')?>" method="post" >
                    
                     <div class="row">
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="catname">Choose Slide Image(Required)</label>
                                 <?php 
                                    $imgurl = $slideInfo->image;
                                    include('includes/imageBox.php');
                                ?>
                                <input type="hidden" name="banId" value="<?= $slideInfo->id ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-12 px-2">
                            <div class="form-group">
                                <label for="catname">Banner Link</label>
                                <input type="text" name="banLink" id="catname" class="form-control" placeholder="Enter Category name" required value="<?= $slideInfo->imagelink ?>">
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

<?php 
    include_once('includes/footer.php');
?>