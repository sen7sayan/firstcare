<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>User Setting</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-12 p-2 ">
            <!-- add new slide -->
            <button  class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#myModal">Add New User</button>
            <!-- Add User Modal -->
            <div class="modal" id="myModal">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Add Nre User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <form class="theme-form" method="post" action="<?= base_url('users/registrationdata')?>" >
                        <input type="hidden" name="adminonly" value="1">
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" name="cfname" id="fname" placeholder="First Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="clname" placeholder="Last Name" name="lname" >
                            </div>

                        </div>
                        <div class="form-row row">
                            <div class="col-md-3">
                                <label for="email">email</label>
                                <input type="email" class="form-control" id="email" name="cemail" placeholder="Email" required>
                            </div>
                            <div class="col-md-3">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="cphone" placeholder="Phone" required>
                            </div>
                            <div class="col-md-3">
                                <label for="pass">Password</label>
                                <input type="text" name="cpass" class="form-control" id="pass" placeholder="Enter your password" required>
                            </div>
                            <div class="col-md-3">
                                <label for="gst">GST Number</label>
                                <input type="text" class="form-control" name="cgstnumber" id="gst" placeholder="GST Number">
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-12">
                                <label for="comapny">Comapny Name</label>
                                <input type="text" class="form-control" name="ccompany" id="comapny" placeholder="Company Name" >
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary">create Account</button>
                    </form>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>

                </div>
              </div>
            </div>
            <!-- Add User Modal -->
            <br><hr>
            <!-- add new slide -->
            <div class="table-responsive">
                <table class="table table-hovered table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>GST</th>
                            <th>Password</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (!empty($allUsers)) {
                                $i=1;      
                                foreach ($allUsers as $users) {
                                    ?>
                                        <tr>
                                           <td> <?= $i++  ?></td> 
                                           <td><?= $users->firstname.' '.$users->lastname ?></td>
                                           <td><?= $users->email ?></td>
                                           <td><?= $users->phone ?></td>
                                           <td><?= $users->gstnum ?></td>
                                           <td><?= $users->password ?></td>
                                           <td>
                                            <?php 
                                                if ($users->status == 1) {
                                                    echo '<span class="badge badge-success">Approved</span>';
                                                }
                                                else
                                                {
                                                    echo '<span class="badge badge-danger">Not Approved</span>';    
                                                }
                                             ?>
                                             <br>
                                             <a href="<?= base_url('admin/changeuserStatus/'.$users->id)?>" class="btn btn-link">Change Status</a>
                                                
                                           </td>
                                           
                                           <td>
                                                <div class="btn-group">
                                                    <a href="<?= base_url('admin/edit_slide/'.$users->id)?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="<?= base_url('orders/index/'.$users->id)?>" class="btn btn-success btn-sm">Check Orders</a>
                                                    <a href="<?= base_url('admin/deleteUser/'.$users->id)?>" onclick="return confirm('Are you sure you want to delete this slide?')"class="btn btn-danger btn-sm">Delete</a>
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