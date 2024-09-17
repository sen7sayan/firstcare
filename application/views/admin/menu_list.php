<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Menu List</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-12 p-2 ">
            <!-- add new slide -->
            
            <!-- add new slide -->
            <div class="table-responsive">
                <table class="table table-hovered table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Menu</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (!empty($menuInfo)) {
                                $i=1;      
                                foreach ($menuInfo as $menues) {
                                    ?>
                                        <tr>
                                           <td> <?= $i++  ?></td> 
                                           <td>
                                                <?php if ($menues->id == 1): ?>
                                                    <p>Main Menu</p>
                                                 <?php else: ?>
                                                    <p>Category Menu</p> 
                                                 <?php endif ?>
                                           </td>
                                           <td>
                                            <?php 
                                                if ($menues->status == 1) {
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
                                                    <a href="<?= base_url('admin/menu_setting/'.$menues->id)?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="<?= base_url('index.php/admin/changestatusSlide/'.$menues->id)?>" onclick="return confirm('Are you sure? you want to change slide status!')"class="btn btn-success btn-sm">Change Status</a>
                                                    
                                                </div>
                                           </td>
                                      </tr>  
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<h2>No slides found</h2>";
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