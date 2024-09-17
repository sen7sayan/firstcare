<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Slider Setting</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-12 p-2 ">
            <!-- add new slide -->
            <a href="<?= base_url('index.php/admin/add_slide')?>" class="btn btn-success btn-sm float-right" >Add New slide</a>
            <br><hr>
            <!-- add new slide -->
            <div class="table-responsive">
                <table class="table table-hovered table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Featured Image</th>
                            <th>Device</th>
                            <th>Sequence</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (!empty($slides)) {
                                $i=1;      
                                foreach ($slides as $sliders) {
                                    ?>
                                        <tr>
                                           <td> <?= $i++  ?></td> 
                                           <td>
                                                 <img src=" <?= base_url($sliders->imgPath)?>" style="width:auto; height:100px">
                                           </td>
                                           <td>
                                               <?php if ($sliders->device == 1): ?>
                                                    <i style="font-size: 25px;" class="text-primary fa fa-laptop"></i>
                                                <?php elseif ($sliders->device == 2): ?>
                                                    <i style="font-size: 25px;" class="text-info fa fa-mobile"></i>
                                                <?php else: ?>
                                                    <i style="font-size: 25px;" class="text-success fa fa-globe"></i>
                                                <?php endif ?>
                                           </td>
                                           <td><?=  $sliders->sortNum   ?></td>
                                           <td><?=  $sliders->link   ?></td>
                                           <td>
                                            <?php 
                                                if ($sliders->status == 1) {
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
                                                    <a href="<?= base_url('index.php/admin/edit_slide/'.$sliders->id)?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="<?= base_url('index.php/admin/changestatusSlide/'.$sliders->id)?>" onclick="return confirm('Are you sure? you want to change slide status!')"class="btn btn-success btn-sm">Change Status</a>
                                                    <a href="<?= base_url('index.php/admin/deleteslide/'.$sliders->id)?>" onclick="return confirm('Are you sure you want to delete this slide?')"class="btn btn-danger btn-sm">Delete</a>
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