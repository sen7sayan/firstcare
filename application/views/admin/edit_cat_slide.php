<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Edit Home <?= $singslideInfo->name ?></h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 p-2 ">
            <!-- add new slide -->
            <a href="<?= base_url('admin/homecatlist')?>" class="btn btn-success btn-sm float-right" >Home Cat List</a>
            <br><hr>
            <!-- add new slide -->
             <div class="card">
                 <div class="card-body p-3 border border-primary">
                     <form action="<?= base_url('admin/edit_cat_slide_data')?>" method="post" >
                         <input type="hidden" name="catslideId" value="<?= $singslideInfo->id ?>">
                         <div class="row">
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Category title Name</label>
                                    <input type="text" name="catName" id="catname" class="form-control" placeholder="Enter Category name" required value="<?= $singslideInfo->name ?>">
                                </div>
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Preference</label>
                                    <input type="number" name="preference" id="catname" class="form-control" placeholder="Enter Preference" value="<?= $singslideInfo->preference ?>">
                                </div>
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="parentcat">Select Categories</label>
                                    <select class="nameofcats form-control" name="otherCats[]" multiple="multiple" >
                                        <?php 
                                            $catArray = array();
                                            if (!empty($singslideInfo->cats) || $singslideInfo->cats != null) {

                                                   $catArray = explode(',', $singslideInfo->cats);

                                                }
                                            if(!empty($allcats)) {
                                                foreach ($allcats as $category) {
                                                    if (in_array("$category->id", $catArray)) {
                                                        $selCat ="selected";
                                                    }
                                                    else{
                                                        $selCat ="";
                                                    }
                                                    ?>
                                                       <option <?= $selCat ?> value="<?= $category->id ?>"><?= $category->name ?></option> 
                                                    <?php
                                                }
                                            }
                                         ?>
                                        
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Choose Slide Image(Required)(Width X Heigh : 330px X 755px)</label>
                                     <?php 
                                        $imgurl = $singslideInfo->features_img;
                                        include('includes/imageBox.php');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-12 px-2">
                                <div class="form-group">
                                    <label for="moreLink">Feature Image Link </label>
                                    <input type="text" name="moreLink" id="moreLink" class="form-control" placeholder="Feature Image Link" value="<?= $singslideInfo->more_pro_link ?>">
                                </div>
                            </div>


                         </div> 
                         
                         <button type="submit" class="btn btn-primary">Submit</button>  
                       </form>
                 </div>
             </div>   
        </div>
        <div class="col-md-3"></div>
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