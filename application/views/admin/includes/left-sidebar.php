<?php 
    $per_adminId = $this->session->userdata('adminId');
    $adminInfo = admin_info($per_adminId);
    $adminpermissions = explode(",", $adminInfo->permissions);
 ?>
<div class="col-md-2 border border-left-0 border-top-0 border-bottom-0 ">
            <div class="text-center">
                <div class="text-center px-4 mb-2">
                    <img src="<?= base_url('assets/images/logo.png')?>" class="img-fluid" width="100">
                </div>
                <h6 class="text-success"><?= $adminInfo->name ?><br>(<span class="text-danger"><?php if ($adminInfo->id == 1): ?>
                    Super Admin
                <?php endif ?></span>)</h6>
            </div>
            
             <!-- <p><?php print_r($adminpermissions) ?></p> -->
            <ul class="list-group">
                <li class="list-group-item"><a href="<?= base_url('admin')?>">DashBoard</a></li>
                
                <?php if (in_array("company_details", $adminpermissions) || $per_adminId == 1): ?>
                    <li class="list-group-item">
                        <a href="#"  data-toggle="collapse" data-target="#company">Company Setting <i class="fa fa-chevron-right float-right"></i></a>   
                        <ul class="list-group collapse mt-2" id="company" >
                            <?php if (in_array("company_details", $adminpermissions) || $per_adminId == 1): ?>
                                <li class="list-group-item "><a href="<?= base_url('admin/company_setting')?>">Company Details</a>  </li>    
                            <?php endif ?>
                            
                        </ul>
                    </li>    
                <?php endif ?>
                
                <?php if (in_array("main_slider",$adminpermissions) || $per_adminId == 1): ?>
                    <li class="list-group-item"><a href="<?= base_url('admin/sliderList')?>">Main Slider Setting</a></li>    
                <?php endif ?>
                
                <?php if (in_array("product_categories",$adminpermissions) || in_array("product_list",$adminpermissions) || in_array("add_new_product",$adminpermissions) || in_array("product_variable_set",$adminpermissions)  || in_array("product_review_set",$adminpermissions)  || $per_adminId == 1): ?>
                    <li class="list-group-item">
                        <a href="#"  data-toggle="collapse" data-target="#product">Product Setting <i class="fa fa-chevron-right float-right"></i></a>   
                        <ul class="list-group collapse mt-2" id="product" >
                            <?php if (in_array("product_categories",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item "><a href="<?= base_url('admin/categorySetting')?>">Product Categories Set.</a>  </li>    
                            <?php endif ?>
                            
                            <?php if (in_array("product_list",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"><a href="<?= base_url('admin/product_list')?>">Product List</a></li>    
                            <?php endif ?>

                            <?php if (in_array("add_new_product",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"> <a href="<?= base_url('admin/add_products')?>" >Add new Product</a></li>    
                            <?php endif ?>

                            <?php if (in_array("product_variable_set",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"> <a href="<?= base_url('admin/variableSetting')?>" >Product Variable Set.</a></li>    
                            <?php endif ?>

                            <?php if (in_array("product_review_set",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"> <a href="<?= base_url('admin/review_setting')?>" >Product Review Set.</a></li>    
                            <?php endif ?>
                        </ul>
                        
                    </li>    
                <?php endif ?>

                <?php if (in_array("image_setting",$adminpermissions) || $per_adminId ==1): ?>
                    <li class="list-group-item"><a href="<?= base_url('admin/imageSetting')?>">Image Setting</a></li>    
                <?php endif ?>
                
                <?php if (in_array("coupon_setting",$adminpermissions) || $per_adminId ==1): ?>
                    <li class="list-group-item"><a href="<?= base_url('admin/coupon_setting')?>">Coupon Setting</a></li>
                <?php endif ?>

                <?php if (in_array("tax_setting",$adminpermissions) || $per_adminId ==1): ?>
                    <li class="list-group-item"><a href="<?= base_url('admin/taxSetting')?>">Tax Setting</a></li>
                <?php endif ?>

                <?php if (in_array("buyer_user_setting",$adminpermissions) || $per_adminId ==1): ?>
                    <li class="list-group-item"><a href="<?= base_url('admin/user_setting')?>">Buyer User Setting</a></li>
                <?php endif ?>

                <?php if (in_array("menu_setting",$adminpermissions) || $per_adminId ==1): ?>
                    <li class="list-group-item"><a href="<?= base_url('admin/menulist')?>">Menu Setting</a></li>
                <?php endif ?>

                <?php if (in_array("orders",$adminpermissions) || $per_adminId ==1): ?>
                    <li class="list-group-item"><a href="<?= base_url('orders')?>">Orders</a></li>
                <?php endif ?>

                <?php if (in_array("home_product_offers",$adminpermissions) || in_array("home_banners_setting",$adminpermissions) || in_array("home_cats_setting",$adminpermissions) || $per_adminId ==1): ?>
                    <li class="list-group-item">
                        <a href="#"  data-toggle="collapse" data-target="#homeset">Home Page Settings <i class="fa fa-chevron-right float-right"></i></a>   
                        <ul class="list-group collapse mt-2" id="homeset" >
                            <?php if (in_array("home_product_offers",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"><a href="<?= base_url('admin/home_product_offers')?>">Home Product Offers</a></li>    
                            <?php endif ?>

                            <?php if (in_array("home_banners_setting",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"><a href="<?= base_url('admin/banners_setting')?>">Home Banners Setting</a></li>    
                            <?php endif ?>

                            <?php if (in_array("home_cats_setting",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"><a href="<?= base_url('admin/homecatlist')?>">Home Cats Setting</a></li>    
                            <?php endif ?>
                        </ul>
                    </li>    
                <?php endif ?>
                <?php if (in_array("about_page",$adminpermissions) || in_array("terms_and_conditions",$adminpermissions)|| in_array("privacy_policy",$adminpermissions)|| in_array("cancellation_and_refund",$adminpermissions) || in_array("shipping_and_delivery_policy",$adminpermissions) || in_array("other_pages",$adminpermissions) || $per_adminId ==1): ?>
                    <li class="list-group-item">
                        <a href="#"  data-toggle="collapse" data-target="#pageset">Page Seting <i class="fa fa-chevron-right float-right"></i></a>   
                        <ul class="list-group collapse mt-2" id="pageset" >
                            <?php if (in_array("about_page",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"><a href="<?= base_url('admin/page_setting/1')?>">About Page</a></li>    
                            <?php endif ?>

                            <?php if (in_array("terms_and_conditions",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"><a href="<?= base_url('admin/page_setting/4')?>">Terms and Conditions </a></li>
                            
                            <?php endif ?>

                            <?php if (in_array("privacy_policy",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"><a href="<?= base_url('admin/page_setting/2')?>">Privacy Policy</a></li>
                            
                            <?php endif ?>

                            <?php if (in_array("cancellation_and_refund",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"><a href="<?= base_url('admin/page_setting/3')?>">Cancellation & Refund</a></li>
                            
                            <?php endif ?>

                            <?php if (in_array("shipping_and_delivery_policy",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"><a href="<?= base_url('admin/page_setting/5')?>">Shipping & Delivery Policy</a></li>
                            <?php endif ?>

                            <?php if (in_array("other_pages",$adminpermissions) || $per_adminId ==1): ?>
                                <li class="list-group-item"><a href="<?= base_url('admin/pageList')?>">Other Pages</a></li>                    
                            <?php endif ?>
                            
                            
                        </ul>
                    </li>    
                <?php endif ?>
                
                <li class="list-group-item">
                    <a href="#"  data-toggle="collapse" data-target="#othersetting">Other Setting <i class="fa fa-chevron-right float-right"></i></a>   
                    <ul class="list-group collapse mt-2" id="othersetting" >
                        <li class="list-group-item"><a href="<?= base_url('admin/footersetting')?>">Footer Setting</a></li>
                        <li class="list-group-item"><a href="<?= base_url('admin/shippingSetting')?>">Shipping Setting</a></li>
                    </ul>
                </li>
                <li class="list-group-item">
                    <a href="#"  data-toggle="collapse" data-target="#adminsetting">Admin Setting<i class="fa fa-chevron-right float-right"></i></a>   
                    <ul class="list-group collapse mt-2" id="adminsetting" >
                        <li class="list-group-item"><a href="<?= base_url('admin/adminprofile')?>">Profile setting</a></li>
                        <li class="list-group-item"><a href="<?= base_url('admin/adminUserSetting')?>">Admin Users Setting</a></li>
                    </ul>
                </li>
                <li class="list-group-item"><a href="<?= base_url('account/adminlogout')?>">Logout</a></li>
                
            </ul>
        </div>