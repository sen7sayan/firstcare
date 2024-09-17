<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Home Category Setting</h3>
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
                     <form action="<?= base_url('admin/add_cat_slide_data')?>" method="post" >
                    
                         <div class="row">
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Category Title Name</label>
                                    <input type="text" name="catName" id="catname" class="form-control" placeholder="Enter Category name" required>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Preference</label>
                                    <input type="number" name="preference" id="catname" class="form-control" placeholder="Enter Preference">
                                </div>
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="parentcat">Select Categories</label>
                                    <select class="nameofcats form-control" name="otherCats[]" multiple="multiple" >
                                        <?php 
                                            if(!empty($allcats)) {
                                                foreach ($allcats as $category) {
                                                    ?>
                                                       <option value="<?= $category->id ?>"><?= $category->name ?></option> 
                                                    <?php
                                                }
                                            }
                                         ?>
                                        
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-6 px-2">
                                <div class="form-group">
                                    <label for="catname">Choose Image(Req.)(W X H : 330px X 755px)</label>
                                     <?php 
                                        // $imgurl = "Hello";
                                        include('includes/imageBox.php');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-12 px-2">
                                <div class="form-group">
                                    <label for="moreLink">Feature Image Link </label>
                                    <input type="text" name="moreLink" id="moreLink" class="form-control" placeholder="Feature Image Link">
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