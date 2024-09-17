<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Admin User permission setting for <span class="text-info"><?= $userInfo->name ?></span></h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-1 "></div>
        <div class="col-md-10 p-2 ">
            <!-- add new cat -->
            <div class="card">
                <div class="card-body p-3">
                    <?php 
                        $permissionList = array(
                            array(
                                'child' => "yes", 
                                'name' =>"Company Setting",
                                'options' => [
                                    array(
                                    'name' => "Company Details", 
                                    'key' => "company_details", 
                                    )
                                ]
                            ),
                            array(
                                'child' => "no", 
                                'name' =>"Main Slider Setting",
                                'key' => "main_slider", 
                            ),
                            array(
                                'child' => "yes", 
                                'name' =>"Product Setting",
                                'options' => [
                                    array(
                                    'name' => "Product Categories Set.", 
                                    'key' => "product_categories", 
                                    ),
                                    array(
                                    'name' => "Product List", 
                                    'key' => "product_list", 
                                    ),
                                    array(
                                    'name' => "Add new Product", 
                                    'key' => "add_new_product", 
                                    ),
                                    array(
                                    'name' => "Product Variable Set.", 
                                    'key' => "product_variable_set", 
                                    ),
                                    array(
                                    'name' => "Product Review Set.", 
                                    'key' => "product_review_set", 
                                    ),
                                ]
                            ),
                            array(
                                'child' => "no", 
                                'name' =>"Image Setting",
                                'key' => "image_setting", 
                            ),
                            array(
                                'child' => "no", 
                                'name' =>"Coupon Setting",
                                'key' => "coupon_setting", 
                            ),
                            array(
                                'child' => "no", 
                                'name' =>"Tax Setting",
                                'key' => "tax_setting", 
                            ),
                            array(
                                'child' => "no", 
                                'name' =>"Buyer User Setting",
                                'key' => "buyer_user_setting", 
                            ),
                            array(
                                'child' => "no", 
                                'name' =>"Menu Setting",
                                'key' => "menu_setting", 
                            ),
                            array(
                                'child' => "no", 
                                'name' =>"Orders",
                                'key' => "orders", 
                            ),
                            array(
                                'child' => "yes", 
                                'name' =>"Home Page Settings",
                                'options' => [
                                    array(
                                    'name' => "Home Product Offers", 
                                    'key' => "home_product_offers", 
                                    ),
                                    array(
                                    'name' => "Home Banners Setting", 
                                    'key' => "home_banners_setting", 
                                    ),
                                    array(
                                    'name' => "Home Cats Setting", 
                                    'key' => "home_cats_setting", 
                                    )
                                ]
                            ),
                            array(
                                'child' => "yes", 
                                'name' =>"Page Seting",
                                'options' => [
                                    array(
                                    'name' => "About Page", 
                                    'key' => "about_page", 
                                    ),
                                    array(
                                    'name' => "Terms and Conditions", 
                                    'key' => "terms_and_conditions", 
                                    ),
                                    array(
                                    'name' => "Privacy Policy", 
                                    'key' => "privacy_policy", 
                                    ),
                                    array(
                                    'name' => "Cancellation & Refund", 
                                    'key' => "cancellation_and_refund", 
                                    ),
                                    array(
                                    'name' => "Shipping & Delivery Policy", 
                                    'key' => "shipping_and_delivery_policy", 
                                    ),
                                    array(
                                    'name' => "Other Pages", 
                                    'key' => "other_pages", 
                                    )
                                ]
                            ),
                            array(
                                'child' => "yes", 
                                'name' =>"Other Setting",
                                'options' => [
                                    array(
                                    'name' => "Footer Setting", 
                                    'key' => "footer_setting", 
                                    ),
                                    array(
                                    'name' => "Shipping Setting", 
                                    'key' => "shipping_setting", 
                                    )
                                ]
                            ),
                            array(
                                'child' => "yes", 
                                'name' =>"Admin Setting",
                                'options' => [
                                    array(
                                    'name' => "Profile setting", 
                                    'key' => "profile_setting", 
                                    ),
                                    array(
                                    'name' => "Admin Users Setting", 
                                    'key' => "admin_users_setting", 
                                    )
                                ]
                            ),
                        );
                     ?>
                    <form method="post" action="<?= base_url('admin/updateadminpermission')?>">
                        <?php 
                            $perArr = explode(",", $userInfo->permissions);
                         ?>
                        <input type="hidden" name="userid" value="<?= $userInfo->id ?>">
                        <select class="js-example-basic-multiple form-control" name="permissions[]" multiple="multiple" style="width: 100%">
                            
                            <?php foreach ($permissionList as $key => $peritems): ?>
                                <?php if ($peritems["child"] == "yes"): ?>
                                        <optgroup label="Company Setting">
                                            <?php foreach ($peritems["options"] as $key => $opt_value): ?>
                                                <?php 
                                                    if (in_array($opt_value["key"], $perArr)) {
                                                        $selected = "selected";
                                                    }
                                                    else{
                                                        $selected = "";
                                                    }
                                                 ?>
                                                <option <?= $selected ?> value="<?= $opt_value["key"]?>"><?= $opt_value["name"]?></option>
                                            <?php endforeach ?>
                                          </optgroup>      
                                <?php else: ?>
                                    <?php 
                                        if (in_array($peritems["key"], $perArr)) {
                                            $selected = "selected";
                                        }
                                        else{
                                            $selected = "";
                                        }
                                     ?>
                                    <option <?= $selected ?>  style="color: red;" value="<?= $peritems["key"]?>"><?= $peritems["name"]?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <br><br>
                        <button class="btn btn-success" type="submit">Update Permissions</button>
                    </form>
                    
                </div>
        </div>
        
    </div>
        <div class="col-md-1"></div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                 placeholder: "Select Permissions",
                 closeOnSelect: false,
            });
        });
    </script>
<?php 
    include_once('includes/footer.php');
?>