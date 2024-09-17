<?php 
    include_once("includes/header.php");
    include_once("includes/navbar.php");
    $discountprice = 0;
    $coupontype = "''";
    $couponcode = "";
    $offtype = "''";
    $couponoffvalue = "''";
    $shipCharge = 0;
     $shipstate = "";
 ?>
 
        <!-- Start of Main -->
        <main class="main checkout">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="passed"><a href="<?= base_url('shopping-cart')?>">Shopping Cart</a></li>
                        <li class="active"><a href="<?= base_url('user-checkout')?>">Checkout</a></li>
                        <li><a href="javascript:void()">Order Complete</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->
            <style type="text/css">
                .addresses{

                }
                .addresses .add-title{
                    font-size: 17px;
                    font-weight: 700;
                }
                .addresses .add-title2{
                    font-size: 16px;
                    
                }
                .addresses .addr
                {
                    font-size: 16px;
                    font-weight: 700;
                    color: #000;
                }
                
            </style>
            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                     <a href="<?= base_url('shopping-cart')?>"><i class="w-icon-gift"></i>Have Coupon code?</a>
                     <br>
                     <h1>
                         
                         <?php 
                            // print_r(shipping_charge_helper_fun("Delhi"));
                          ?>
                     </h1>
                    <form class="form checkout-form" method="post" onsubmit="return orderCheckout(event)">
                        <div class="row mb-9">
                            <div class="col-lg-7 pr-lg-4 mb-4">

                                <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                    Billing Details
                                </h3>
                                <div class="row" id="addresslist">
                                    <?php foreach ($addressList as $addres): ?>
                                        <?php 
                                         if ($addres->last_used == 1) {
                                                $shipstate = $addres->state;
                                            }
                                            $this->load->view("includes/addressview",["addres"=>$addres]);
                                         ?>    
                                    <?php endforeach ?>
                                    
                                    <a href="<?= base_url('users/addressForm')?>" class="sign-in btn btn-primary btn-outline btn-icon-left">
                                            
                                            <i class="w-icon-long-arrow-right"></i>Add Another Address
                                        </a>
                                </div> 
                                 <div class="row gutter-sm">
                                     <div class="col-md-12">
                                         <div class="accordion accordion-icon accordion-simple show-code-action">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <a href="#collapse3-1" class="collapse"><i class="w-icon-orders"></i>Add Tax details</a>
                                                    </div>
                                                    <div class="card-body collapsed" id="collapse3-1">
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <div class="form-group">
                                                                    <label>Company name (optional)</label>
                                                                    <input type="text" class="form-control form-control-md" name="coCompany_name" value="<?= $userInfo->company_name ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <div class="form-group">
                                                                    <label>GST Number (optional)</label>
                                                                    <input type="text" class="form-control form-control-md" name="cogstnumber"  value="<?= $userInfo->gstnum ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                     </div>
                                </div>
                              
                            </div>
                            <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                                <div class="order-summary-wrapper sticky-sidebar">
                                    <h3 class="title text-uppercase ls-10">Your Order</h3>
                                    <div class="order-summary">
                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        <b>Product</b>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- <tr class="bb-no">
                                                    <td class="product-name">Palm Print Jacket <i
                                                            class="fas fa-times"></i> <span
                                                            class="product-quantity">1</span></td>
                                                    <td class="product-total">$40.00</td>
                                                </tr>
                                                <tr class="bb-no">
                                                    <td class="product-name">Brown Backpack <i class="fas fa-times"></i>
                                                        <span class="product-quantity">1</span></td>
                                                    <td class="product-total">$60.00</td>
                                                </tr> -->
                                                <tr class="cart-subtotal bb-no">
                                                    <td>
                                                        <b>Subtotal</b>
                                                    </td>
                                                    <td>
                                                        <b><?= price_symbol($this->cart->total() + 0) ?></b>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="shipping-methods">
                                                    <td colspan="2" class="text-left">
                                                        <h4 class="title title-simple bb-no mb-1 pb-0 pt-3">Shipping Charges 
                                                        </h4>
                                                        
                                                        <ul id="shipping-method" class="mb-4">

                                                            <?php 
                                                                $shipInfo = $this->db->where("status",1)->like("states",$shipstate)->get("shipping")->row();
                                                                if ($shipInfo) {
                                                                    if ($shipInfo->type == 0) {
                                                                        $shipCharge = 0;
                                                                    }
                                                                    else{
                                                                            if ($shipInfo->cartvalues < $this->cart->total()) {
                                                                                $shipCharge = $shipInfo->after_shipcharge;

                                                                             }
                                                                             else{
                                                                                    $shipCharge = $shipInfo->shipcharge;
                                                                                }    
                                                                    }
                                                                    
                                                                }
                                                                else{
                                                                    $shipCharge = 0;
                                                                }
                                                                
                                                                    ?>
                                                                    <li>
                                                                        <div class="custom-radio">
                                                                            <input checked type="radio" id="flat-rate"
                                                                                class="custom-control-input" name="shipping">
                                                                            <label for="flat-rate"
                                                                                class="custom-control-label color-dark">Shipping : <span id="shipprice"><?php
                                                                                if ($shipCharge == 0) {
                                                                                    echo "<b>Free</b>";
                                                                                }
                                                                                else{

                                                                                 echo price_symbol($shipCharge) ;
                                                                                }
                                                                             ?></span></label>
                                                                        </div>
                                                                    </li>
                                                                    
                                                            
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <?php if ($this->session->tempdata('discountprice')): ?>
                                                    <tr >
                                                        <th>
                                                            <b class="text-success">Discount Code Applied</b>
                                                        </th>
                                                        <td>
                                                              <?php 
                                                                   $discountprice =  $this->session->tempdata('discountprice');
                                                                   $coupontype =  $this->session->tempdata('coupontype');
                                                                   $couponcode =  $this->session->tempdata('couponcode');
                                                                   $offtype =  $this->session->tempdata('offtype');
                                                                   $couponoffvalue =  $this->session->tempdata('couponoffvalue');
                                                                    
                                                                 ?>
                                                            <b id="couponprice" class="text-success">-<?= price_symbol($discountprice) ?></b>
                                                        </td>    
                                                    </tr> 
                                                
                                                <?php endif ?>
                                                
                                                <tr class="order-total">
                                                    <th>
                                                        <b>Total</b>
                                                    </th>
                                                    <td>
                                                        <b id="totalprice"><?= price_symbol($this->cart->total() + $shipCharge - $discountprice) ?></b>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        <div class="payment-methods" id="payment_method">
                                            <h4 class="title font-weight-bold ls-25 pb-0 mb-1">Payment Methods</h4>

                                            <div class="form-check mb-4 mt-3">
                                                <label for="flat-rate" class="form-check-label color-dark d-flex"><input checked name="paymentmethod" type="radio" class="form-check-input mr-2" value="phonepe"> Pay Now <img src="<?= base_url('assets/images/phonepe.png')?>" style="height: 20px; widows: auto;" class="ml-auto"></label>
                                            </div>
                                            <?php 
                                                $codInfo = $this->db->where("id",2)->get("others_settings")->row();
                                             ?>
                                            <?php if ($codInfo->status == 1): ?>
                                                <hr>
                                                <div class="form-check mb-3">
                                                    <label for="flat-rate" class="form-check-label color-dark"><input name="paymentmethod" type="radio" class="form-check-input mr-2" value="cod"> COD(Cash On Delivery)</label>
                                                </div>    
                                            <?php endif ?>
                                            
                                        </div>

                                        <div class="form-group place-order pt-6">
                                            <button type="submit" class="btn btn-dark btn-block btn-rounded">Place Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->

        <script type="text/javascript">
            function orderCheckout(e) {
              e.preventDefault();
               $('#loader').css('display',"block"); 
               $(".place-order").attr("disabled",true);
                $(".place-order").addClass("disabled");      
              //console.log(allVars);

              const formdata = new FormData(e.target);
              formdata.append("ucountry",formdata.get('coCountry')); 
              formdata.append("ufname",formdata.get('cofname')); 
              formdata.append("ulname",formdata.get('colname')); 
              formdata.append("ufulladdress",formdata.get('cofulladdress')); 
              formdata.append("ufulladdress2",formdata.get('cofulladdress2')); 
              formdata.append("ucity",formdata.get('cocity')); 
              formdata.append("ustate",formdata.get('costate')); 
              formdata.append("upincode",formdata.get('copincode')); 
              formdata.append("uphone",formdata.get('cophone')); 
              formdata.append("uemail",formdata.get('coemail')); 
              formdata.append("ugstnumber",formdata.get('cogstnumber')); 
              formdata.append("uCompany_name",formdata.get('coCompany_name')); 
              formdata.append("paymentmethod",formdata.get('paymentmethod'));
              formdata.append("discountprice",<?= $discountprice ?>);
              formdata.append("coupontype",<?= $coupontype ?>);
              formdata.append("couponcode",'<?= $couponcode ?>');
              formdata.append("offtype",<?= $offtype ?>);
              formdata.append("couponoffvalue",<?= $couponoffvalue ?>);
              
              axios.post("<?= base_url('product/orderConfirm')?>", formdata).then(function (response) {
                    console.log(response.data);
                    // pop cart message
                    Toastify({
                      text: response.data.msg,
                      duration: 10000,
                      // destination: "https://github.com/apvarun/toastify-js",
                      // newWindow: true,
                      close: true,
                      gravity: "top", // `top` or `bottom`
                      position: "center", // `left`, `center` or `right`
                      stopOnFocus: true, // Prevents dismissing of toast on hover
                      style: {
                        background: response.data.msgColor,
                      },
                      // onClick: function(){} // Callback after click
                    }).showToast();     
                    // pop cart message
                if (response.data.status == "success") {
                    
                    if (response.data.pm) {
                        $('#loader').css('display',"block"); 
                            setTimeout(function(){
                            // location.reload();
                            window.location.href="<?= base_url('Payment/order_payment/');?>";
                        }, 2000);    
                    }
                    else{
                        setTimeout(function(){
                            // location.reload();
                            window.location.href="<?= base_url('my-orders/');?>" + response.data.orderId + '/thank-you';
                        }, 2000);    
                    }
                          
                    
                }
                else{
                    $('#loader').css('display',"none");     
                }

                $(".place-order").attr("disabled",false);
                $(".place-order").removeClass("disabled");      
                      
                    
                    
                })
                .catch((error) => console.log(error));
            
          }
        </script>
        <script type="text/javascript">
            function addAddress(e) {
              e.preventDefault();
               $('#loader').css('display',"block"); 
               $(".place-order").attr("disabled",true);
                $(".place-order").addClass("disabled");      
              //console.log(allVars);

              const formdata = new FormData(e.target);
              formdata.append("ucountry",formdata.get('coCountry')); 
              formdata.append("ufname",formdata.get('cofname')); 
              formdata.append("ulname",formdata.get('colname')); 
              formdata.append("ufulladdress",formdata.get('cofulladdress')); 
              formdata.append("ufulladdress2",formdata.get('cofulladdress2')); 
              formdata.append("ucity",formdata.get('cocity')); 
              formdata.append("ustate",formdata.get('costate')); 
              formdata.append("upincode",formdata.get('copincode')); 
              formdata.append("uphone",formdata.get('cophone')); 
              formdata.append("uemail",formdata.get('coemail')); 
              
              
              axios.post("<?= base_url('product/add_new_address')?>", formdata).then(function (response) {
                 // console.log(response.data);
                    // pop cart message
                    Toastify({
                      text: response.data.msg,
                      duration: 10000,
                      // destination: "https://github.com/apvarun/toastify-js",
                      // newWindow: true,
                      close: true,
                      gravity: "top", // `top` or `bottom`
                      position: "center", // `left`, `center` or `right`
                      stopOnFocus: true, // Prevents dismissing of toast on hover
                      style: {
                        background: response.data.msgColor,
                      },
                      // onClick: function(){} // Callback after click
                    }).showToast();     
                    // pop cart message
                if (response.data.status == "success") {
                    
                    $("#addresslist").html(response.data.adList)
                    $('#shipprice').html(response.data.shipcharge); 
                    $('#couponprice').html(response.data.discounted); 
                    $('#totalprice').html(response.data.finalPrice); 
                    $(".mfp-close").click();
                    $('#loader').css('display',"none"); 
                }
                else{
                    $('#loader').css('display',"none");     
                }

                $(".place-order").attr("disabled",false);
                $(".place-order").removeClass("disabled");      
                      
                    
                    
                })
                .catch((error) => console.log(error));
            
          }
        </script>
<?php 
    include_once("includes/footer.php");
 ?>