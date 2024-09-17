 <?php 
    $userIdLoginId = login_user(); // Helper function;
    $userInfo = user_info();
    $navcatList = $this->db->select("id,name,seo_url")->order_by("name","asc")->where("status",1)->get("categories")->result();
 ?>
 <style type="text/css">
     #category option, .text-capitalize{
        text-transform: capitalize;
     }
     #search-sugeestion{
        position: absolute;
        padding: 20px;
        width: 100%;
        height: 350px;
        z-index: 9999;
        margin-top: 45px;
        background: #fff;
        border-radius: 4px;
        border-top: 1px solid #f7f7f7;
        box-shadow: 0 3px 5px rgba(0,0,0,.15);
        box-sizing: border-box;
        max-width: 100%;
        display: none;
        overflow-x: scroll;
     }
     .list-product-title{
        font-weight: 600;
        font-size: 12px;
     }
     #search-sugeestion .close-me{
           position: relative;
            margin-top: -49px;
            color: gray;
            float: right !important;
            font-size: 18px;
        }

    
        
 </style>
 <script type="text/javascript">
    function showbox() {
        document.getElementById("search-sugeestion").style.display = "block";
    }

    function hidebox() {
        document.getElementById("search-sugeestion").style.display = "none";
    }

    // var elem = document.getElementById('first');

    window.addEventListener('scroll', handler, false);
    window.addEventListener('click', handler, false);

    function handler(e) {
        if (document.getElementById('search-sugeestion').contains(e.target) || document.getElementById('searproduct').contains(e.target)) {
             document.getElementById("search-sugeestion").style.display = "block";
          } else{
            document.getElementById("search-sugeestion").style.display = "none";
          }
    }

    /*window.addEventListener('click', function(e){   
          if (document.getElementById('search-sugeestion').contains(e.target) || document.getElementById('searproduct').contains(e.target)) {
             document.getElementById("search-sugeestion").style.display = "block";
          } else{
            document.getElementById("search-sugeestion").style.display = "none";
          }
        });*/
    
</script>
 <!-- Start of Header -->
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <p class="welcome-msg">Welcome to Shop 24 U. </p>
                    </div>
                    <div class="header-right">
                        <div class="dropdown">
                            <a href="#language"><img src="<?= base_url('assets/') ?>images/user.png" alt="ENG Flag" width="14"
                                    height="8" class="dropdown-image" /> My Profile</a>
                            <div class="dropdown-box" style="width: 130px;">
                                <?php if ($this->session->has_userdata('userid')): ?>
                                    <a href="<?= base_url('my-account')?>">
                                        <img src="<?= base_url('assets/') ?>images/user.png" alt="ENG Flag" width="14" height="8"
                                            class="dropdown-image" />
                                        Profile Setting
                                    </a>
                                    <a href="<?= base_url('users/orders')?>">
                                        <img src="<?= base_url('assets/') ?>images/orders.png" alt="FRA Flag" width="14" height="8"
                                            class="dropdown-image" />
                                        Orders
                                    </a>
                                    <a href="<?= base_url('my-account')?>">
                                        <img src="<?= base_url('assets/') ?>images/password.png" alt="FRA Flag" width="14" height="8"
                                            class="dropdown-image" />
                                        Password Change
                                    </a>
                                    <a href="<?= base_url('wishlist-products')?>">
                                        <img src="<?= base_url('assets/') ?>images/wishlist.png" alt="FRA Flag" width="14" height="8"
                                            class="dropdown-image" />
                                        Wishlist
                                    </a>
                                    <a href="<?= base_url('users/user_addresses')?>">
                                        <img src="<?= base_url('assets/') ?>images/location.png" alt="FRA Flag" width="14" height="8"
                                            class="dropdown-image" />
                                        My Addresses
                                    </a>
                                    <a href="<?= base_url('my-account')?>">
                                        <img src="<?= base_url('assets/') ?>images/download.png" alt="FRA Flag" width="14" height="8"
                                            class="dropdown-image" />
                                        Downloads
                                    </a>
                                    <a href="<?= base_url('user-logout')?>">
                                        <img src="<?= base_url('assets/') ?>images/logout.png" alt="FRA Flag" width="14" height="8"
                                            class="dropdown-image" />
                                        Logout
                                    </a>
                                <?php else: ?>
                                     <a href="<?= base_url('account/loginForm')?>" class="login sign-in">
                                        <img src="<?= base_url('assets/') ?>images/login.png" alt="FRA Flag" width="14" height="8"
                                            class="dropdown-image" />
                                        Login
                                    </a>
                                    <a href="<?= base_url('account/loginForm')?>" class="login register">
                                        <img src="<?= base_url('assets/') ?>images/register.png" alt="FRA Flag" width="14" height="8"
                                            class="dropdown-image " />
                                        Register
                                    </a>
                                <?php endif ?>
                                
                            </div>
                        </div>
                        <!-- End of Dropdown Menu -->
                        <span class="divider d-lg-show"></span>
                        <a href="blog.html" class="d-lg-show">Blog</a>
                        <a href="contact-us.html" class="d-lg-show">Contact Us</a>
                        
                        <?php if ($this->session->has_userdata('userid')): ?>
                            <a href="<?= base_url('my-account')?>" class="d-lg-show">My Account</a>
                            <a href="javascript:void()">Hello <b class="ml-1"> <?= substr("$userInfo->firstname", 0,10) ?></b></a>
                        <?php else: ?>
                            <a href="<?= base_url('account/loginForm')?>" class="d-lg-show login sign-in">My Account</a>
                            <a href="<?= base_url('account/loginForm')?>" class="d-lg-show login sign-in"><i
                                class="w-icon-account"></i>Sign In</a>
                            <span class="delimiter d-lg-show">/</span>
                            <a href="<?= base_url('account/loginForm')?>" class="ml-0 d-lg-show login register">Register</a>    
                        <?php endif ?>
                        
                    </div>
                </div>
            </div>
            <!-- End of Header Top -->

            <div class="header-middle">
                <div class="container">
                    <div class="header-left mr-md-4">
                        <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
                        </a>
                        <a href="<?= base_url()?>" class="logo ml-lg-0">
                            <img src="<?= base_url('assets/') ?>images/logo.png" alt="logo" width="144" height="45" />
                        </a>
                        <form method="post" onsubmit="return searchproduct(event)" class="header-search hs-expanded hs-round  d-md-flex input-wrapper">
                            <div class="select-box">
                                <select id="category" name="category">
                                    <option value="">All Categories</option>
                                    <?php foreach ($navcatList as $key => $catInfo): ?>
                                        <option value="<?= $catInfo->id ?>"><?= $catInfo->name ?></option>    
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <input type="text" class="form-control" name="searchkey" id="searproduct" placeholder="Search in..."
                                required onfocusin="showbox()"  autocomplete="off" />
                                <div id="search-sugeestion">
                                    <h5>Products Search result</h5>
                                    <!-- <a class="float-right close-me" href="javascript:void(0)" onclick="hidebox()">X</a> -->
                                    <?php 
                                        $recentProduct  = $this->db->where("status",1)->order_by("id","desc")->limit(8)->get("products")->result();
                                     ?>
                                     <?php foreach ($recentProduct as $recProduct): ?>
                                         <div class="col-md-12 col-sm-6">
                                              <div class="p-2">
                                                <a href="<?= base_url('product-detail/'.$recProduct->seo_url)?>">
                                                    <p class="list-product-title"><i class="w-icon-search mr-2"></i><?= substr($recProduct->name, 0,70) ?>...</p>
                                                </a>
                                              </div>
                                          </div>
                                     <?php endforeach ?>
                                </div>
                            <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="header-right ml-4">
                        <div class="header-call d-xs-show d-lg-flex align-items-center">
                            <a href="tel:#" class="w-icon-call"></a>
                            <div class="call-info d-lg-show">
                                <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                                    <a href="https://portotheme.com/cdn-cgi/l/email-protection#4063" class="text-capitalize">Live Chat</a> or :</h4>
                                <a href="tel:#" class="phone-number font-weight-bolder ls-50">+91 82403 99503</a>
                            </div>
                        </div>
                        <a class="wishlist label-down link d-xs-show" href="<?= base_url('wishlist-products')?>">
                            <?php 
                                if ($userIdLoginId) {
                                    $wishQty = count($this->db->where('userId',$userIdLoginId)->where("deleted",0)->get("wishlist")->result());
                                }
                                else{
                                    $wishQty = 0;
                                }   
                                
                             ?>
                            <i class="w-icon-heart"></i>
                            <span class="wishlist-label d-lg-show">Wishlist</span>
                        </a>
                        <!-- <div class="header-search hs-toggle dir-up">
                            <a href="#" class="search-toggle sticky-link">
                                <i class="w-icon-search"></i>
                                <p>Search</p>
                            </a>
                            <form action="#" class="input-wrapper">
                                <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                                    required />
                                <button class="btn btn-search" type="submit">
                                    <i class="w-icon-search"></i>
                                </button>
                            </form>
                        </div> -->
                        <a class="compare label-down link " href="#">
                            <i class="w-icon-search"></i>
                            <span class="compare-label d-lg-show">search</span>
                        </a>
                        <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                            <div class="cart-overlay"></div>

                            <a href="#" class="cart-toggle label-down link">
                                <i class="w-icon-cart">
                                    <span class="cart-count"><?= $this->cart->total_items(); ?></span>
                                </i>
                                <span class="cart-label">Cart</span>
                            </a>
                            <div class="dropdown-box">
                                <div class="cart-header">
                                    <span>Shopping Cart</span>
                                    <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
                                </div>

                                <div class="products" id="side_cart_content">
                                    <?php foreach ($this->cart->contents() as $cartItem): ?>
                                            <?php 
                                                $this->load->view('includes/side_cart_item',["cartItem"=>$cartItem]);
                                             ?>   
                                    <?php endforeach ?>
                                  
                                </div>

                                <div class="cart-total">
                                    <label>Subtotal:</label>
                                    <span class="price" id="side_cart_subtotal"><?= price_symbol($this->cart->total()) ?></span>
                                </div>

                                <div class="cart-action">
                                    <a href="<?= base_url('shopping-cart')?>" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                                    
                                    <?php if ($userIdLoginId): ?>
                                        <a href="<?= base_url('user-checkout')?>" class="btn btn-primary  btn-rounded">Checkout</a>
                                    <?php else: ?>    
                                        <a href="<?= base_url('account/loginForm/user-checkout')?>" class="btn btn-primary  btn-rounded login sign-in">Checkout</a>
                                    <?php endif ?>
                                    
                                </div>
                            </div>
                            <!-- End of Dropdown Box -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Header Middle -->

            <div class="header-bottom sticky-content fix-top sticky-header has-dropdown">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="header-left">
                            <div class="dropdown category-dropdown has-border" data-visible="true">
                                <a href="#" class="category-toggle text-dark" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true" data-display="static"
                                    title="Browse Categories">
                                    <i class="w-icon-category"></i>
                                    <span>Browse Categories</span>
                                </a>

                                <div class="dropdown-box">
                                    <ul class="menu vertical-menu category-menu">
                                    	<?php 
                                    		$cont = $this->db->where("id",2)->get("menus")->row()->content;
                            				$contArray = json_decode($cont, true);   
                            				 for ($i=0; $i < sizeof($contArray); $i++) { 
				                                    if (isset($contArray[$i]["children"])) {
				                                        $plink = "#";
				                                    }
				                                    else{
				                                        
				                                        $plink = $contArray[$i]["href"];
				                                    }
				                                    ?>
				                                    <li>
			                                            <a href="<?= $plink ?>">
			                                                <i class="<?= $contArray[$i]["icon"] ?>"></i><?= $contArray[$i]["text"]?>
			                                            </a>
			                                            <?php 
			                                            	if (isset($contArray[$i]["children"])) {
			                                            		?>
			                                            		<ul class="megamenu">
			                                            			<?php 
			                                            				 for ($j=0; $j < sizeof($contArray[$i]["children"]) ; $j++) { 
			                                            				 	if (isset($contArray[$i]["children"][$j]["children"])) {
			                                            				 			?>
			                                            				 			<li>
			                                            				 				<h4 class="menu-title"><?= $contArray[$i]["children"][$j]["text"] ?></h4>
		                                                									<hr class="divider">
		                                                									<ul>
		                                                										<?php 
		                                                											for ($k=0; $k < sizeof($contArray[$i]["children"][$j]["children"]) ; $k++) { 
		                                                												?>
		                                                												<li><a href="<?= $contArray[$i]["children"][$j]["children"][$k]["href"]?>">	<?= $contArray[$i]["children"][$j]["children"][$k]["text"]?></a>
		                                                												</li>
		                                                												<?php
		                                                											}
		                                                										 ?>
		                                                									</ul>	
			                                            				 			</li>
			                                            				 			
			                                            				 			<?php
				                                            				 	}
				                                            				 	
				                                            				 	else{
			                                            				 	?>
			                                            				 	<li>
			                                            				 		<a  href="<?= $contArray[$i]["children"][$j]["href"] ?>"><?= $contArray[$i]["children"][$j]["text"] ?></a>
			                                            				 	</li>
			                                            				 	<?php
			                                            				 	}
			                                            				 }
			                                            			 ?>
			                                            		</ul>
			                                            		<?php
			                                            	}
			                                             ?>
			                                        </li>
				                                    <?php 
				                                }
                                    	 ?>
                                    </ul>
                                </div>
                            </div>
                            <nav class="main-nav">
                                <ul class="menu active-underline">
                                    <li class="active">
                                        <a href="<?= base_url()?>">Home</a>
                                    </li>
                                    <?php 
                                    		$cont2 = $this->db->where("id",1)->get("menus")->row()->content;
                            				$contArray2 = json_decode($cont2, true);   
                            				 for ($i=0; $i < sizeof($contArray2); $i++) { 
                            				 		if (isset($contArray2[$i]["children"])) {
				                                        ?>
				                                         <li>
					                                        <a href="#"><?= $contArray2[$i]["text"]?></a>
					                                        <ul>
					                                        	<?php 
					                                        		for ($j=0; $j < sizeof($contArray2[$i]["children"]) ; $j++) {
					                                        			if (isset($contArray2[$i]["children"][$j]["children"])) {

					                                        				?>
					                                        				<li>
								                                                <a href="#"><?= $contArray2[$i]["children"][$j]["text"]?></a>
								                                                <ul>
								                                                	<?php 
								                                                		for ($k=0; $k < sizeof($contArray2[$i]["children"][$j]["children"]) ; $k++) {

								                                                				?>
								                                                				<li><a href="<?= $contArray2[$i]["children"][$j]["children"][$k]["href"] ?>"><?= $contArray2[$i]["children"][$j]["children"][$k]["text"] ?></a></li>
								                                                				<?php
					                                        								}	
								                                                	 ?>
								                                                    
								                                                </ul>
								                                            </li>
					                                        				<?php
					                                        				
					                                        			}
					                                        			else{
					                                        				?>
					                                        					<li><a href="<?= $contArray2[$i]["children"][$j]["href"]?>"><?= $contArray2[$i]["children"][$j]["text"]?></a></li>			
					                                        				<?php
					                                        			}
					                                        			?>
					                                        				
					                                        			<?php		
					                                        		}
					                                        	 ?>
					                                        </ul>
					                                    </li>
				                                        <?php
				                                    }
				                                    else{
				                                    	?>
				                                    	<li>
					                                        <a href="<?= $contArray2[$i]['href'] ?>"><?= $contArray2[$i]['text'] ?></a>
					                                    </li>
				                                    	<?php
				                                        
				                                        
				                                    }
                            				 	}
                            				 ?>
                                    
                                </ul>
                            </nav>
                        </div>
                        <div class="header-right">
                            <a href="#" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track Order</a>	
                            <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End of Header -->

        <!-- Start of Mobile Menu -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay"></div>
        <!-- End of .mobile-menu-overlay -->

        <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
        <!-- End of .mobile-menu-close -->

        <div class="mobile-menu-container scrollable">
            <form action="#" method="get" class="input-wrapper">
                <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                    required />
                <button class="btn btn-search" type="submit">
                    <i class="w-icon-search"></i>
                </button>
            </form>
            <!-- End of Search Form -->
            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#main-menu" class="nav-link active">Main Menu</a>
                    </li>
                    <li class="nav-item">
                        <a href="#categories" class="nav-link">Categories</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="main-menu">
                    <ul class="mobile-menu">
                    	<li><a href="<?= base_url() ?>">Home</a></li>
                    	<?php 
	                		 for ($i=0; $i < sizeof($contArray2); $i++) { 
	        				 		if (isset($contArray2[$i]["children"])) {
	                                    ?>
	                                     <li>
	                                        <a href="<?= $contArray2[$i]["href"]?>"><?= $contArray2[$i]["text"]?></a>
	                                        <ul>
	                                        	<?php 
	                                        		for ($j=0; $j < sizeof($contArray2[$i]["children"]) ; $j++) {
	                                        			if (isset($contArray2[$i]["children"][$j]["children"])) {

	                                        				?>
	                                        				<li>
				                                                <a href="<?= $contArray2[$i]["children"][$j]["href"]?>"><?= $contArray2[$i]["children"][$j]["text"]?></a>
				                                                <ul>
				                                                	<?php 
				                                                		for ($k=0; $k < sizeof($contArray2[$i]["children"][$j]["children"]) ; $k++) {

				                                                				?>
				                                                				<li><a href="<?= $contArray2[$i]["children"][$j]["children"][$k]["href"] ?>"><?= $contArray2[$i]["children"][$j]["children"][$k]["text"] ?></a></li>
				                                                				<?php
	                                        								}	
				                                                	 ?>
				                                                    
				                                                </ul>
				                                            </li>
	                                        				<?php
	                                        				
	                                        			}
	                                        			else{
	                                        				?>
	                                        					<li><a href="<?= $contArray2[$i]["children"][$j]["href"]?>"><?= $contArray2[$i]["children"][$j]["text"]?></a></li>			
	                                        				<?php
	                                        			}
	                                        			?>
	                                        				
	                                        			<?php		
	                                        		}
	                                        	 ?>
	                                        </ul>
	                                    </li>
	                                    <?php
	                                }
	                                else{
	                                	?>
	                                	<li>
	                                        <a href="<?= $contArray2[$i]['href'] ?>"><?= $contArray2[$i]['text'] ?></a>
	                                    </li>
	                                	<?php
	                                    
	                                    
	                                }
	        				 	}
	        				 ?>
                        
                    </ul>
                </div>
                <div class="tab-pane" id="categories">
                    <ul class="mobile-menu">
                    	<?php 
                    		 for ($i=0; $i < sizeof($contArray); $i++) { 
                                    if (isset($contArray[$i]["children"])) {
                                        $plink = "#";
                                    }
                                    else{
                                        
                                        $plink = $contArray[$i]["href"];
                                    }
                                    ?>
                                    <li>
                                        <a href="<?= $plink ?>">
                                            <i class="<?= $contArray[$i]["icon"] ?>"></i><?= $contArray[$i]["text"]?>
                                        </a>
                                        <?php 
                                        	if (isset($contArray[$i]["children"])) {
                                        		?>
                                        		<ul>
                                        			<?php 
                                        				 for ($j=0; $j < sizeof($contArray[$i]["children"]) ; $j++) { 
                                        				 	if (isset($contArray[$i]["children"][$j]["children"])) {
                                        				 			?>
                                        				 			<li>
                                        				 				<a href="<?= $contArray[$i]["children"][$j]["href"] ?>"><?= $contArray[$i]["children"][$j]["text"] ?></a>
                                        									
                                        									<ul>
                                        										<?php 
                                        											for ($k=0; $k < sizeof($contArray[$i]["children"][$j]["children"]) ; $k++) { 
                                        												?>
                                        												<li><a href="<?= $contArray[$i]["children"][$j]["children"][$k]["href"]?>">	<?= $contArray[$i]["children"][$j]["children"][$k]["text"]?></a>
                                        												</li>
                                        												<?php
                                        											}
                                        										 ?>
                                        									</ul>	
                                        				 			</li>
                                        				 			
                                        				 			<?php
                                            				 	}
                                            				 	
                                            				 	else{
                                        				 	?>
                                        				 	<li>
                                        				 		<a  href="<?= $contArray[$i]["children"][$j]["href"] ?>"><?= $contArray[$i]["children"][$j]["text"] ?></a>
                                        				 	</li>
                                        				 	<?php
                                        				 	}
                                        				 }
                                        			 ?>
                                        		</ul>
                                        		<?php
                                        	}
                                         ?>
                                    </li>
                                    <?php 
                                }
                    	 ?>
                        <li>
                            <a href="shop-banner-sidebar.html"
                                class="font-weight-bold text-primary text-uppercase ls-25">
                                View All Categories<i class="w-icon-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Mobile Menu -->

