<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Add New Product Category</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-1 "></div>
        <div class="col-md-10 p-2 ">
            <!-- add new cat -->
            <a href="<?= base_url('index.php/admin/categorySetting')?>" class="btn btn-success btn-sm float-right" >Back Category List</a>
            <!-- add new cat -->
            <br><hr>
            <div class="card">
                <div class="card-body p-3">
                   
                    
                     <div class="row">
                        <div class="col-md-6 px-2">
                            <div class="border border-secondary p-2 rounded m-3">
                                <form method="post" action="<?= base_url('admin/updateCompany_name')?>">
                                    <div class="form-group">
                                        <label for="catname">Company Name</label>

                                        <?php 
                                        $comName ="";

                                            if (isset($comp_name) && !empty($comp_name->content)){
                                                $comName = $comp_name->content;
                                            }
                                            else{
                                                $comName = "Techidata Solutions";
                                            }
                                         ?>
                                        
                                        <input type="text" name="companyName" value="<?= $comName ?>" class="form-control" placeholder="Enter Company Name" required>
                                        <input type="hidden" name="settingid" value="4">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Update </button>
                                </form>    
                            </div>
                            
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="border border-secondary p-2 rounded m-3">
                                <form method="post" action="<?= base_url('admin/updateCompany_gst')?>">
                                    <div class="form-group">
                                        <label for="catname">Company GST</label>

                                        <?php 
                                        $comName ="";

                                            if (isset($comp_gst) && !empty($comp_gst->content)){
                                                $comName = $comp_gst->content;
                                            }
                                            else{
                                                $comName = "GST";
                                            }
                                         ?>
                                        
                                        <input type="text" name="companyGst" value="<?= $comName ?>" class="form-control" placeholder="Enter Company Gst" required>
                                        <input type="hidden" name="settingid" value="7">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Update </button>
                                </form>    
                            </div>
                            
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="border border-secondary p-2 rounded m-3">   

                                        <?php 
                                        $comlogo ="";

                                            if (isset($comp_logo) && !empty($comp_logo->content)){
                                                $imgurl = $comp_logo->content;
                                            }
                                            else{
                                                $imgurl = "uploads/dummy/dummy.jpg";
                                            }
                                         ?>
                                <form method="post" action="<?= base_url('admin/updateCompany_logo')?>">
                                    <label for="catname">Company logo</label>
                                    <br>
                                         <?php 
                                            $imageSetboxFlag = "modalboximage";
                                            include('includes/imageBox.php');
                                        ?>
                                        <input type="hidden" name="settingid" value="5">
                                        <br><br>
                                    <button type="submit" class="btn btn-primary btn-sm">Update </button>
                                </form>    
                            </div>
                            
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="border border-secondary p-2 rounded m-3">
                                <?php 
                                    $comlogo ="";

                                            if (isset($comp_favicon) && !empty($comp_favicon->content)){
                                                $imgurl = $comp_favicon->content;
                                            }
                                            else{
                                                $imgurl = "uploads/dummy/dummy.jpg";
                                            }
                                         ?>

                                 
                                <form method="post" action="<?= base_url('admin/updateCompany_favicon')?>">
                                    <label for="catname">Company Favicon</label>
                                    <br>
                                         <?php 
                                            $imageSetboxFlag = "companyFavIcon";
                                            include('includes/imageBox.php');
                                        ?>
                                        <input type="hidden" name="settingid" value="6">
                                        <br><br>
                                    <button type="submit" class="btn btn-primary btn-sm">Update </button>
                                </form>    
                            </div>
                            
                        </div>


                        <div class="col-md-12 px-2">
                            <div class="border border-secondary p-2 rounded m-3">
                                <form method="post" action="<?= base_url('admin/updateCompany_address')?>">
                                    <div class="form-group">
                                        <label for="catname">Company Address</label>

                                        <?php 
                                        $comName ="";

                                            if (isset($comp_address) && !empty($comp_address->content)){
                                                $comName = $comp_address->content;
                                            }
                                            else{
                                                $comName = "Address";
                                            }
                                         ?>
                                        <textarea name="companyaddr" class="form-control" placeholder="Enter Company Address" required><?php echo $comName ?></textarea>
                                        <input type="hidden" name="settingid" value="8">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Update </button>
                                </form>    
                            </div>
                            
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="border border-secondary p-2 rounded m-3">
                                <form method="post" action="<?= base_url('admin/updateCompany_priPhone')?>">
                                    <div class="form-group">
                                        <label for="catname">Company Primary Phone Number </label>

                                        <?php 
                                        $comName ="";

                                            if (isset($comp_prim_phone) && !empty($comp_prim_phone->content)){
                                                $comName = $comp_prim_phone->content;
                                            }
                                            else{
                                                $comName = "9876543210";
                                            }
                                         ?>
                                         <input value="<?=$comName ?>" name="companypriPhone" class="form-control" placeholder="Enter Company Address" required type="text">
                                        
                                        <input type="hidden" name="settingid" value="9">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Update </button>
                                </form>    
                            </div>
                            
                        </div>

                        <div class="col-md-6 px-2">
                            <div class="border border-secondary p-2 rounded m-3">
                                <form method="post" action="<?= base_url('admin/updateCompany_secPhone')?>">
                                    <div class="form-group">
                                        <label for="catname">Company Secondary Phone Number </label>

                                        <?php 
                                        $comName ="";

                                            if (isset($comp_sec_phone) && !empty($comp_sec_phone->content)){
                                                $comName = $comp_sec_phone->content;
                                            }
                                            else{
                                                $comName = "9876543210";
                                            }
                                         ?>
                                         <input value="<?=$comName ?>" name="companysecPhone" class="form-control" placeholder="Enter Company Address" required type="text">
                                        
                                        <input type="hidden" name="settingid" value="10">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Update </button>
                                </form>    
                            </div>
                        </div>


                        <div class="col-md-6 px-2">
                            <div class="border border-secondary p-2 rounded m-3">
                                <form method="post" action="<?= base_url('admin/updateCompany_priEmail')?>">
                                    <div class="form-group">
                                        <label for="catname">Company Primary Email </label>

                                        <?php 
                                        $comName ="";

                                            if (isset($comp_prim_email) && !empty($comp_prim_email->content)){
                                                $comName = $comp_prim_email->content;
                                            }
                                            else{
                                                $comName = "abc@yourdomain.com";
                                            }
                                         ?>
                                         <input value="<?=$comName ?>" name="companypriemail" class="form-control" placeholder="Enter Company primary meail" required type="text">
                                        
                                        <input type="hidden" name="settingid" value="11">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Update </button>
                                </form>    
                            </div>
                            
                        </div>

                        <div class="col-md-6 px-2">
                            <div class="border border-secondary p-2 rounded m-3">
                                <form method="post" action="<?= base_url('admin/updateCompany_secEmail')?>">
                                    <div class="form-group">
                                        <label for="catname">Company Secondary Phone Number </label>

                                        <?php 
                                        $comName ="";

                                            if (isset($comp_sec_email) && !empty($comp_sec_email->content)){
                                                $comName = $comp_sec_email->content;
                                            }
                                            else{
                                                $comName = "abc@yourdomain.com";
                                            }
                                         ?>
                                         <input value="<?=$comName ?>" name="companysecEmail" class="form-control" placeholder="Enter Company secondary email" required type="text">
                                        <input type="hidden" name="settingid" value="12">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Update </button>
                                </form>    
                            </div>
                        </div>



                     </div> 
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

<?php 
    include_once('includes/footer.php');
?>