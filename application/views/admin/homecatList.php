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
        <div class="col-md-12 p-2 ">
            <!-- add new slide -->
            <a href="<?= base_url('index.php/admin/add_cat_slide')?>" class="btn btn-success btn-sm float-right" >Add New Cat List</a>
            <br><hr>
            <!-- add new slide -->
            <div class="table-responsive">
                <table class="table table-hovered table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Product Categories</th>
                            <th>Preference</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (!empty($clist)) {
                                $j=1;      
                                foreach ($clist as $list) {
                                    ?>
                                        <tr>
                                           <td> <?= $j++;  ?></td> 
                                           <td>
                                                 <p><?= $list->name ?></p>
                                           </td>
                                           <td><?php  
                                                $catArr = explode(",", $list->cats);
                                                if (count($catArr)) {
                                                    for ($i=0; $i < sizeof($catArr); $i++) { 
                                                        $singCatInfo = $this->Adminmodel->categoryInfo($catArr[$i]);
                                                        if ($singCatInfo) {
                                                            echo '<span class="badge badge-dark">'.$singCatInfo->name.'</span><br>';
                                                        }
                                                    }
                                                }
                                              ?></td>
                                           <td><?=  $list->preference   ?></td>
                                           <td>
                                            <?php 
                                                if ($list->status == 1) {
                                                    echo '<span class="badge badge-success">Active</span>';
                                                }
                                                else
                                                {
                                                    echo '<span class="badge badge-danger">De-Activated</span>';    
                                                }
                                             ?>
                                                
                                           </td>
                                           
                                           <td>
                                                <div class="btn-group">
                                                    <a href="<?= base_url('admin/edit_cat_slide/'.$list->id)?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="<?= base_url('admin/changestatuscatSlide/'.$list->id)?>" onclick="return confirm('Are you sure? you want to change category status!')"class="btn btn-success btn-sm">Change Status</a>
                                                    <a href="<?= base_url('admin/deletecatslide/'.$list->id)?>" onclick="return confirm('Are you sure you want to delete this slide?')"class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                           </td>
                                      </tr>  
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<h2>No Cat list found found</h2>";
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