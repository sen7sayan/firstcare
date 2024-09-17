<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Shipping Setting</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        
        <div class="col-md-12 p-2 ">
            <div class="card">
                <div class="card-body p-3">
                    <h5>Cod(Cash On delivery) Setting</h5>
                   <form action="<?= base_url('index.php/admin/codSettingData')?>" method="post"  class="mt-3">
                    
                     <div class="row">

                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <?php 
                                     if ($codInfo->status == 1){
                                            $checkcod = "checked";
                                            $showtext = "Enabled";
                                            $btntext = "Disable";
                                        }
                                        else{
                                            $checkcod = "";
                                            $showtext = "Disabled";
                                            $btntext = "Enable";
                                        }
                                     ?>

                                     <input <?= $checkcod ?> type="checkbox" class="custom-control-input" value="enable" id="customCheck" name="enabled">    
                                    <label class="custom-control-label" for="customCheck"> COD is <?= $showtext ?></label>   

                                        <button type="submit" class="btn btn-primary"><?= $btntext ?> Now</button>  
                                
                              </div>
                              <hr>
                            
                        
                        </div>
                     </div> 
                     
                   </form> 
                </div>
            </div>

            <br>
            <div class="card ">
                <div class="card-body p-3">
                    <a href="<?= base_url('admin/add_new_ship')?>" class="btn btn-success btn-sm float-right" >Add New Shipping</a>
            <br><hr>
                    
                    <h5>Shipping Setting</h5>
                   <form action="<?= base_url('index.php/admin/freeshipSettingData')?>" method="post" class="mt-3">
                    
                     <div class="row">

                        <div class="col-md-12">
                           <table class="table table-hovered table-bordered">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Status</th>
                                       <th>Default</th>
                                       <th>Name</th>
                                       <th>Ship Type</th>
                                       <th>Min Cart Value</th>
                                       <th>Ship charges <br>(<small class="text-danger">In case cart has less than min cart valu</small>)</th>
                                       <th>Ship charges <br>(<small class="text-success">In case cart has greater than min cart valu</small>)</th>
                                       <th>Area</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                               <tbody>

                                   <?php 
                                        $i = 1;
                                    foreach ($shipList as $shipInfo): ?>
                                       <tr>
                                           <td><?= $i++ ?></td>
                                           <td>
                                               <?php if ($shipInfo->status ==1): ?>
                                                    <span class="badge badge-success">Active</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Disbaled</span>
                                                <?php endif ?>
                                           </td>
                                            <td>
                                               <?php if ($shipInfo->default_ship == 1): ?>
                                                    <span class="badge badge-success">Default Ship</span>
                                                <?php else: ?>
                                                    <span class="badge badge-info">Defined</span>
                                                <?php endif ?>
                                           </td>
                                           <td>
                                               <h4><strong><?= $shipInfo->name ?></strong></h4>
                                           </td>
                                           <td>
                                               <?php if ($shipInfo->type == 0): ?>
                                                    <span class="badge badge-success">Free</span>
                                                <?php else: ?>
                                                    <span class="badge badge-primary">Min Cart Based</span>
                                                <?php endif ?>
                                           </td>
                                           <td>
                                               <h3><?= price_symbol($shipInfo->cartvalues) ?></h3>
                                           </td>
                                           <td>
                                               <h3 class="text-danger"><?= price_symbol($shipInfo->shipcharge) ?></h3>
                                           </td>
                                           <td>
                                               <h3 class="text-success"><?= price_symbol($shipInfo->after_shipcharge) ?></h3>
                                           </td>
                                           <td>
                                               <?php 
                                                $states = explode(",", $shipInfo->states);
                                                ?>
                                                <?php foreach ($states as $stateInfo): ?>
                                                     <small class="badge badge-secondary"><?= $stateInfo ?></small>
                                                <?php endforeach ?>
                                           </td>
                                           <td>
                                               <div class="dropdown">
                                                  <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    Action
                                                  </button>
                                                  <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('admin/edit_new_ship/'.$shipInfo->id)?>">Edit</a>
                                                    <a  onclick="return confirm('Are you sure you want to change status of this shipping ?')" class="dropdown-item" href="<?= base_url('admin/changeshipStatus/'.$shipInfo->id.'/'.$shipInfo->status)?>">Change status </a>
                                                    <a onclick="return confirm('Are you sure you want to make this shipping default?')" class="dropdown-item" href="<?= base_url('admin/makeshipdefault/'.$shipInfo->id)?>">Make It default</a>
                                                    <a onclick="return confirm('Are you sure you want to delete this shipping?')" class="dropdown-item" href="<?= base_url('admin/deleteshiping/'.$shipInfo->id)?>">Delete</a>
                                                  </div>
                                                </div>
                                           </td>
                                       </tr>
                                   <?php endforeach ?>
                               </tbody>
                           </table>
                        
                        </div>
                     </div> 
                     
                   </form> 
                </div>
            </div>
        </div>
        
    </div>

<?php 
    include_once('includes/footer.php');
?>