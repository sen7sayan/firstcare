<?php 
    include_once("includes/header.php");
    include_once("includes/navbar.php");
 ?>

        <!-- Start of Main -->
        <main class="main cart">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="active"><a href="<?= base_url('shopping-cart')?>">Shopping Cart</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg mb-10">
                        <div class="col-lg-8 pr-lg-4 mb-6">
                            <form method="post" action="<?= base_url('product/updatecart')?>">
                                <table class="shop-table cart-table">
                                    <thead>
                                        <tr>
                                            <th class="product-name"><span>Product</span></th>
                                            <th></th>
                                            <th class="product-price"><span>Unit Price</span></th>
                                            <th class="product-quantity"><span>Quantity</span></th>
                                            <th class="product-subtotal"><span>Subtotal</span></th>
                                        </tr>
                                    </thead>
                                    <tbody class="cart-item-list">
                                        <?php
                                        $cartitems = count($this->cart->contents());
                                        ?> 
                                            <?php if ($cartitems > 0){
                                                $i=0;
                                                 foreach ($this->cart->contents() as $cartItem){
                                                    $this->load->view('includes/cart-items',["cartItem"=>$cartItem,"iteration"=>$i]);
                                                        $i++;
                                                }
                                            }else{
                                                ?>
                                                <tr>
                                                    <td colspan="4"><h3>Cart is empty</h3></td>
                                                </tr>
                                                <?php
                                            }

                                             ?>
                                                    
                                        
                                    </tbody>
                                </table>

                                <div class="cart-action mb-6">
                                    <a href="<?= base_url('collection')?>" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                                    <a href="<?= base_url('product/emptycart')?>" class="btn btn-rounded btn-default btn-clear" name="clear_cart" value="Clear Cart">Clear Cart</a> 
                                    <button type="submit" class="btn btn-dark btn-rounded btn-shopping" name="update_cart" >Update Cart</button>
                                </div>
                            </form>
                            <?php if ($this->cart->total() > 0): ?>
                                <form method="post" onsubmit="return applycoupon(event)">
                                    <!-- <form method="post" action="<?= base_url('product/applycoupon')?>"> -->
                                    <h5 class="title coupon-title font-weight-bold text-uppercase">Coupon Discount</h5>
                                    <input type="text" name="couponcode" class="form-control mb-4" placeholder="Enter coupon code here..." required />
                                    <button type="submit" class="btn btn-dark btn-outline btn-rounded">Apply Coupon</button>
                                </form>    
                            <?php endif ?>
                            
                        </div>
                        <div class="col-lg-4 sticky-sidebar-wrapper">
                            <div class="sticky-sidebar">
                                <div class="cart-summary mb-4">
                                    <h3 class="cart-title text-uppercase">Cart Totals</h3>
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                        <label class="ls-25">Subtotal</label>
                                        <?php 
                                            if ($this->session->tempdata('discountprice')){
                                                   $discountprice =  $this->session->tempdata('discountprice');
                                            }
                                            else{
                                                $discountprice = 0;
                                            }
                                         ?>
                                        
                                        <span class="cart-total"><?= price_symbol($this->cart->total())?></span>
                                    </div>

                                    <hr class="divider">

                                    <!-- <ul class="shipping-methods mb-2">
                                        <li>
                                            <label
                                                class="shipping-title text-dark font-weight-bold">Shipping</label>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input checked type="radio" id="free-shipping" class="custom-control-input" name="shipping">
                                                <label for="free-shipping" class="custom-control-label color-dark">Shipping Charge : <b class="float-right ml-5"><small>Address Based </small></b></label>
                                            </div>
                                        </li>
                                       
                                    </ul> -->
                                    <?php if ($this->session->tempdata('discountprice')): ?>
                                        <ul class="shipping-methods mb-2">
                                            <li>
                                                <label
                                                    class="shipping-title text-dark font-weight-bold">Discount applied</label>
                                            </li>
                                            <li>
                                                <div class="custom-radio">
                                                    <input checked type="radio" id="free-shipping" class="custom-control-input">
                                                    <label for="free-shipping" class="custom-control-label color-dark">Coupon Code (<a href="#" onclick="removecoupon_discount()" class="text-primary"><small>Remove Discount</small></a>) : <b class="float-right ml-5">-<?= price_symbol($this->session->tempdata('discountprice')) ?></b></label>
                                                </div>
                                            </li>
                                           
                                        </ul>
                                    <?php endif ?>

                                    <hr class="divider mb-6">
                                    <div class="order-total d-flex justify-content-between align-items-center">
                                        <label>Total</label>
                                        <span class="ls-50 cart-total"><?= price_symbol($this->cart->total() - $discountprice) ?></span>
                                    </div>
                                    <?php if ($userIdLoginId): ?>
                                        <a href="<?= base_url('user-checkout')?>" class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                        Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
                                    <?php else: ?>
                                        <a href="<?= base_url('account/loginForm/user-checkout')?>" class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout login sign-in">
                                        Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
<?php 
    include_once("includes/footer.php");
 ?>