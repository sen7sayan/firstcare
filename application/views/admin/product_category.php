<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Product Category</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-12 p-2 ">
            <!-- add new cat -->
            <a href="<?= base_url('index.php/admin/add_category')?>" class="btn btn-success btn-sm float-right" >Add New Category</a>
            <br><hr>
            <!-- add new cat -->
            <div class="table-responsive">
                <table class="table table-hovered table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Category Name</th>
                            <th>SEO URL</th>
                            <th>Parent Category</th>
                            <th>Category Status</th>
                            <th>Featured Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (!empty($allcats)) {
                                $i=1;      
                                foreach ($allcats as $category) {
                                    ?>
                                        <tr>
                                           <td> <?= $i++  ?></td> 
                                           <td> 
                                            <a href="<?= base_url('collection/'.$category->seo_url)?>" target="_blank"><?=  $category->name   ?></a>
                                           </td>
                                           <td> <?= $category->seo_url   ?></td>
                                           <td> 
                                            <?php if ($category->parentCat == 0): ?>
                                                No parent Category
                                            <?php else: ?>
                                                 <?= $category->parentCat   ?>   

                                            <?php endif ?>
                                           </td>
                                           <td>
                                            <?php 
                                                if ($category->status == 1) {
                                                    echo '<span class="badge badge-success">Active</span>';
                                                }
                                                else
                                                {
                                                    echo '<span class="badge badge-danger">De-Activated</span>';    
                                                }
                                             ?>
                                                
                                           </td>
                                           <td>
                                            <?php if (!empty($category->featureimage)): ?>
                                                    <img src=" <?= base_url($category->featureimage)?>" style="width:100px; height:100px">
                                                <?php else: ?>
                                                    No Image
                                            <?php endif ?>
                                                

                                           </td>
                                           <td>
                                                <div class="btn-group">
                                                    <a href="<?= base_url('index.php/admin/edit_category/'.$category->id)?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="<?= base_url('index.php/admin/changestatusCategory/'.$category->id)?>" onclick="return confirm('Are you sure? you want to change category status!')"class="btn btn-success btn-sm">Change Status</a>
                                                    <a href="<?= base_url('index.php/admin/deletecategory/'.$category->id)?>" onclick="return confirm('Are you sure you want to delete this category?')"class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                           </td>
                                      </tr>  
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<h2>No category found</h2>";
                            }
                         ?>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php 
    include_once('includes/footer.php');
?>