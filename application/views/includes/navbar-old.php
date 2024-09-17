<?php 
    $userIdLoginId = login_user(); // Helper function;
    $userInfo = user_info()
 ?>
<style type="text/css">
    
    .suggestion-box {
        position: absolute;
        padding: 20px;
        width: 100%;
        height: 500px;
        z-index: 9999;
        margin-top: 40px;
        background: #fff;
        border-radius: 4px;
        border-top: 1px solid #f7f7f7;
        box-shadow: 0 3px 5px rgba(0,0,0,.15);
        box-sizing: border-box;
        max-width: 100%;
        display: none;
        overflow-x: scroll;
    }
    .suggestion-box h4{
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        padding: 0;
        text-transform: uppercase;
    }
    .suggestion-box .close-me{
        position: relative;
        margin-top: -30px;
        color: gray;
    }
    .cart-msg {
        position: fixed;
        bottom: 0;
        right: 0;
        z-index: 999999;
    }
    .user-header .dropdown-toggle::after{
        display: none;
    }
    @media (max-width: 768px) {

     }
    

</style>
<script type="text/javascript">
    function showbox() {
        document.getElementById("suggestion-box").style.display = "block";
    }

    function hidebox() {
        document.getElementById("suggestion-box").style.display = "none";
    }
</script>
<header class="header">
    <div class="upper-header bg-dark desktop">
        <div class="container">
            <div class="d-flex">
                <div>
                    
                </div>
                <div class="ml-auto py-1">
                    <div class="d-flex">
                        <div class="text-white mr-3">
                            <a href="#"><p><i class="fa fa-map-marker mr-1"></i> Get In Touch</p></a>
                        </div>
                        <div class="text-white mr-3">
                            <a href="#"><p><i class="fa fa-truck mr-1"></i> Track your order </p></a>
                        </div>
                        <div class="text-white mr-3">
                            <a href="#"><p><i class="fa fa-phone mr-1"></i> +91 98105 34455 </p></a>
                        </div>
                    </div>    
                </div>
                
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-sm bg-yellow navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url()?>"><img src="<?= base_url('assets/images/logo.png')?>" class="img-fluid"></a>

            <form method="post" onsubmit="return searchproduct(event)">
                <div class="input-group mb-3 pt-3">
                  <input type="text" class="form-control" name="searchkey" placeholder="Search" id="searproduct" onfocusin="showbox()"  autocomplete="off">
                  <div class="input-group-append">
                    <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i></button>
                  </div>
                  <div class="suggestion-box" id="suggestion-box" onmouseenter="showbox()">
                      <h4>Top products</h4>
                      <a class="float-right close-me" href="javascript:void(0)" onclick="hidebox()">X</a>
                      <div class="row" id="ajaxresult">
                        
                        <?php 
                            $recentProduct  = $this->db->where("status",1)->order_by("id","desc")->limit(8)->get("products")->result();
                         ?>
                         <?php foreach ($recentProduct as $recProduct): ?>
                             <div class="col-md-3 col-sm-6">
                                  <div class="text-center p-2">
                                    <a href="<?= base_url('product-detail/'.$recProduct->seo_url)?>">
                                        <img src="<?= base_url($recProduct->featureImg)?>" class="img-fluid searchImg">
                                        <h3 class="list-product-title"><?= $recProduct->name ?></h3>
                                    </a>
                                  </div>
                              </div>
                         <?php endforeach ?>
                      </div>
                  </div>
                </div>
            </form>
            <div class="user-header">
                <div class="d-flex">
                    <div class="mr-4 dropdown">
                        <p class="dropdown-toggle d-flex" data-toggle="dropdown"><?php if ($userIdLoginId): ?>
                            <span class="desktop"><?= substr($userInfo->firstname." ".$userInfo->lastname, 0, 17)?> </span><i class="fa fa-user-o mobile"></i>
                        <?php else: ?>
                            <i class="fa fa-user-o"></i>
                        <?php endif ?></p>
                        <div class="dropdown-menu mt-n3" >
                            <?php if ($userIdLoginId): ?>
                                <a class="dropdown-item" href="#">My Account</a>
                                <a class="dropdown-item" href="<?= base_url('my-orders')?>">My Orders</a>
                                <a class="dropdown-item" href="<?= base_url('wishlist-products')?>">My Wishlist</a>
                                <a class="dropdown-item" href="<?= base_url('my-address-book')?>">My Address Book</a>
                                <a class="dropdown-item" href="<?= base_url('contact-us')?>">Help & Support</a>
                                <a class="dropdown-item" href="<?= base_url('user-logout')?>">Logout</a>
                            <?php else: ?>
                                <a class="dropdown-item authModal" href="javascript:void(0)" data-authtype="login" data-toggle="modal" data-target="#userAuthmodal">Login</a>
                                <a class="dropdown-item authModal" href="javascript:void(0)" data-authtype="register" data-toggle="modal" data-target="#userAuthmodal">Register</a>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="mr-4">
                        <?php 
                            if ($userIdLoginId) {
                                $wishQty = count($this->db->where('userId',$userIdLoginId)->where("deleted",0)->get("wishlist")->result());
                            }
                            else{
                                $wishQty = 0;
                            }   
                            
                         ?>
                        <a href="<?= base_url('wishlist-products')?>"><i class="fa fa-heart-o"><span class="icon-digit wishlist-num"><?= $wishQty ?></span></i></a>
                        
                    </div>
                    <div class="ml-1">
                        <a href="<?= base_url('shopping-cart')?>"><i class="fa fa-shopping-bag"><span class="icon-digit cart-num"><?= $this->cart->total_items(); ?></span></i></a>
                    </div>
                </div>
            </div>
        </div>     
    </nav>
    <div class="menu-header py-0">
        <nav class="navbar navbar-expand-sm bg-white p-0">
            <div class="container">
                 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- Links -->
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <?php 
                            $cont = $this->db->where("id",1)->get("menus")->row()->content;
                            $contArray = json_decode($cont, true);   
                            for ($i=0; $i < sizeof($contArray); $i++) { 
                                    if (isset($contArray[$i]["children"])) {
                                        $drpClass = "dropdown";
                                        $drpLinkClass = "dropdown-toggle";
                                        $toggleTrigger = 'data-toggle="dropdown"';
                                    }
                                    else{
                                        $drpClass = "";
                                        $drpLinkClass = "";
                                        $toggleTrigger = '';
                                    }
                                ?>
                                    <li class="nav-item <?= $drpClass ?>">
                                      <a class="nav-link <?= $drpLinkClass ?>" <?= $toggleTrigger ?> href="<?= $contArray[$i]["href"] ?>"><?= $contArray[$i]["text"] ?></a>
                                            <?php 
                                                 if (isset($contArray[$i]["children"])) {
                                                    ?>                          
                                                        <div class="dropdown-menu">
                                                            <?php 
                                                                for ($j=0; $j < sizeof($contArray[$i]["children"]) ; $j++) { 
                                                                    ?>
                                                                        <a class="dropdown-item" href="<?= $contArray[$i]["children"][$j]["href"] ?>"><?= $contArray[$i]["children"][$j]["text"] ?></a>
                                                                    <?php
                                                                }
                                                             ?>
                                                            
                                                          </div>
                                                    <?php
                                                 }
                                             ?>
                                    </li>        
                                <?php
                            } 
                         ?>
                      </ul>
                </div>
                <!-- Links -->
            </div>
        </nav>
    </div>  
</header>
<div class="toast cart-msg shadow-lg" data-delay="10000">
    <div class="toast-header">
        <strong class="mr-auto toast-bg text-white"></strong>
          <small class="text-white">Just Now</small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

    </div>
    <div class="toast-body bg-white ">
      
    </div>

</div>
<script type="text/javascript">
 $(document).ready(function(){
    var location = window.location.href;

    // remove active class from all
    $(".navbar .nav-item").removeClass('active');

    // add active class to div that matches active url
    $(".nav-item a[href='"+location+"']").addClass('active');
 });
</script>    