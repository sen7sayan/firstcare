<?php 
    include_once('includes/header.php');
?>


<div class="col-md-10 px-4">
    <div class="text-center">
        <h3 class="px-md-5 px-lg-5 px-sm-2 mx-md-5 mx-lg-5 mx-sm-2">Add More Image to <span class="text-info"><?= $singProInfo->name; ?></span></h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-1 "></div>
        <div class="col-md-10 p-2 ">
            <!-- add new cat -->
            <a href="<?= base_url('index.php/admin/edit_products/'.$singProInfo->id)?>" data-toggle="tooltip" title="Go to edit page of This product"   class="btn btn-primary btn-sm float-right" ><i class="fa fa-pencil"></i> Back To Edit Product</a>

            <a href="<?= base_url('index.php/admin/product_list')?>" class="btn btn-success btn-sm float-right mr-2" data-toggle="tooltip" title="Back Product List"><i class="fa fa-list-ol mr-2"></i>  Back Product List</a>
            <!-- add new cat -->
            <br><hr>
            <div class="card">
                <div class="card-body p-3">
                   <form action="<?= base_url('index.php/admin/addmoreImagesData')?>" method="post" >
                    
                     <div class="row">
                        <div class="col-md-12 px-2">
                            <div class="form-group">
                                <label for="catname">Choose Image for Product</label>
                                <?php 
                                    include('includes/imageBox.php');
                                ?>
                                <br>
                                <br>
                                <hr>
                                
                            </div>
                        </div>

                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="catname">Image Alt Text</label>
                                <input type="text" name="altText" id="catname" class="form-control" placeholder="Enter image alt text" required>
                                <input type="hidden" name="productId" value="<?= $singProInfo->id ?>">
                            </div>
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="catname">Image Position</label>
                                <input type="number" name="sorted" id="catname" class="form-control" placeholder="Image Position">
                            </div>
                        </div>
                     </div> 
                     <button type="submit" class="btn btn-primary">Add</button>  
                   </form> 
                   <hr>
                   <div class="row">
                       <?php 
                            $i =1;    
                            if (count($proImages)) {
                                  foreach ($proImages as $allImages) {
                                        ?>
                                           <div class="col-md-6 px-2 p-1">
                                               <div class="card">
                                                   <div class="card-body p-1">
                                                        <!-- delete -->
                                                        <a href="<?= base_url('index.php/admin/deleteproImage/'.$allImages->id.'/'.$allImages->proId)?>" class="float-right btn btn-danger circle" onclick="return confirm('Are you sure to delete this image?')" title="Delete Image"><i class="fa fa-trash fa-2x"></i> </a>
                                                        <!-- delete -->

                                                        <img src="<?= base_url($allImages->imagepath)?>" height="400" width="400">
                                                        <br>
                                                        <!-- change position form -->
                                                        <h4>Img Position : <?= $allImages->sorting?> <button class="float-right btn btn-outline-primary btn-sm" data-toggle="collapse" data-target="#demo<?= $i ?>">Edit Position</button></h4>
                                                        <div id="demo<?= $i ?>" class="collapse">
                                                            <form class="form-inline" action="<?= base_url('index.php/admin/updateImgPosition')?>" method="post">
                                                                <input type="number" name="imgPos" value="<?= $allImages->sorting ?>" class="form-control">
                                                                <input type="hidden" name="proid" value="<?= $allImages->proId ?>">
                                                                <input type="hidden" name="imgId" value="<?= $allImages->id ?>">
                                                                <button class="btn btn-success btn-sm" type="submit">Update</button>
                                                            </form>
                                                        </div>
                                                        <!-- change position form -->
                                                        

                                                   </div>
                                               </div>
                                           </div> 
                                        <?php
                                        $i++;
                                    }  
                            }
                            else
                            {
                                echo "No images added yet";
                            }
                        ?>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

<?php 
    include_once('includes/footer.php');
?>