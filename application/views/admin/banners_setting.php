<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Home Banner Setting</h3>
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
                            <th>Image(Width X Height)</th>

                            <th>Level</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (!empty($banList)) {
                                
                                foreach ($banList as $key => $sliders) {
                                    ?>
                                        <tr>
                                           <td> <?= $key+1  ?></td> 
                                           <td>
                                                 <img src=" <?= base_url($sliders->image)?>" style="width:auto; height:100px">
                                                <?php if ($sliders->level == 1 || $sliders->level == 2): ?>
                                                    <h5 class="text-primary mt-2">(Dimension : 610 px X 200 px)</h5>
                                                <?php else: ?>
                                                    <h5 class="text-success mt-2">(Dimension : 1240 px X 200 px)</h5>
                                                <?php endif ?>  
                                           </td>
                                           <td>
                                               <?php if ($sliders->level == 1): ?>
                                                    <span class="badge badge-success">Top</span>
                                                <?php elseif ($sliders->level == 2): ?>
                                                    <span class="badge badge-primary">Middle</span>
                                                <?php else: ?>
                                                    <span class="badge badge-warning">Bottom</span>
                                                <?php endif ?>
                                           </td>
                                           <td>
                                            <?php if ($sliders->status == 1): ?>
                                                <span class="badge badge-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">De-Activated</span>
                                            <?php endif ?>
                                           </td>
                                           
                                           <td>
                                                <div class="btn-group">
                                                    <a href="<?= base_url('index.php/admin/edit_banner/'.$sliders->id)?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="<?= base_url('index.php/admin/changestatusbanner/'.$sliders->id)?>" onclick="return confirm('Are you sure? you want to change this banner status!')"class="btn btn-success btn-sm">Change Status</a>
                                                    
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