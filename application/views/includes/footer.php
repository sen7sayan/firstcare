
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script type="text/javascript">
     function searchproduct(e) {

            e.preventDefault();

            const formdata = new FormData(e.target);

            var searchKey = formdata.get('searchkey');
            // console.log(searchKey);
            window.location.href = "<?= base_url('search/key/')?>"+searchKey;

        }
        
    function addmetocart(e) {
          e.preventDefault();
          // console.log(e);
          var allVars ="";

          const formdata = new FormData(e.target);
          const prqty = formdata.get('productQTY')
          const proId =  formdata.get('productId')
          // console.log(proId);
          formdata.append("prId",proId); 
          formdata.append("prQty",prqty); 
          formdata.append("varComb",allVars);
          axios.post("<?= base_url('product/addToCart')?>", formdata).then(function (response) {
                // console.log(response.data)
                if (response.data.msgColor == "success") {
                    $("#side_cart_content").html(response.data.allitems)
                    $("#side_cart_subtotal").html("<?= price_symbol()?>"+response.data.carttotal)
                    $(".cart-dropdown").addClass("opened")
                    $('.cart-count').html(response.data.cartQty); 
                }

                Toastify({
                          text: "Product is added to cart!",
                          duration: 10000,
                          // destination: "https://github.com/apvarun/toastify-js",
                          // newWindow: true,
                          close: true,
                          gravity: "top", // `top` or `bottom`
                          position: "center", // `left`, `center` or `right`
                          stopOnFocus: true, // Prevents dismissing of toast on hover
                          style: {
                            background: "#28a745",
                          },
                          // onClick: function(){} // Callback after click
                        }).showToast();

        })

        .catch((error) => console.log(error));
      }

      // Coupon
            function applycoupon(e) {
                e.preventDefault();
                $('#loader').css('display',"block"); 
                 const formdata = new FormData(e.target);
                const code = formdata.get('couponcode');

                formdata.append("couponcode",code);
                  axios.post("<?= base_url('product/applycoupon')?>", formdata).then(function (response) {
                        console.log(response.data)
                        $(".cart-total").html(response.data.finalPrice)

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
                                
                                if (response.data.status == "success") {
                                        setTimeout(function(){
                                        location.reload();
                                    }, 500);
                                }
                                else{
                                    $('#loader').css('display',"none"); 
                                }
                                
                })

                .catch((error) => console.log(error));
            }
            function removecoupon_discount() {

                if (confirm("Are you sure want to remove this discount? ")) {
                    $('#loader').css('display',"block"); 
                    
                    axios.get("<?= base_url('product/removecoupon')?>").then(function (response) {
                        
                        Toastify({
                                  text: "Discount code is removed",
                                  duration: 10000,
                                  // destination: "https://github.com/apvarun/toastify-js",
                                  // newWindow: true,
                                  close: true,
                                  gravity: "top", // `top` or `bottom`
                                  position: "center", // `left`, `center` or `right`
                                  stopOnFocus: true, // Prevents dismissing of toast on hover
                                  style: {
                                    background: "#ec693e",
                                  },
                                  // onClick: function(){} // Callback after click
                                }).showToast();

                        setTimeout(function(){
                            location.reload();
                        }, 500);


                })

                .catch((error) => console.log(error));    
                }
                
            }
            // Coupon

      $(document).ready(function(){

         // search suggestion product
            $("#searproduct").on("keyup",function() {
                const searchKey = $(this).val(); 
                // console.log(searchKey);
                $("#search-sugeestion").html('Please wait...');
                axios.get("<?= base_url('search/suggestionSearch/')?>"+searchKey).then(function (response) {
                        // console.log(response.data);
                        $("#search-sugeestion").html(response.data);
                    })

                    .catch((error) => console.log(error));
            });
            // search suggestion product    


             // add to wishlist
             $(document.body).on("click","a.btn-wishlist",function() {
                var myself = $(this);
                myself.addClass("disabled");
                myself.attr("disabled",true);
                // myself.html('<div class="spinner-border text-secondary"></div>');
                var proid = $(this).data("id");
                
                // cart axios code
                    
                  const formdata = new FormData();

                  formdata.append("prId",proid); 

                  axios.post("<?= base_url('product/addwishlist')?>", formdata).then(function (response) {
                            // console.log(response.data)

                            $('.wishlist-num').html(response.data.wishQty); 

                                if (response.data.msgColor == "success") {
                                    Toastify({
                                          text: "Product is added to wishlist!",
                                          duration: 3000,
                                          // destination: "https://github.com/apvarun/toastify-js",
                                          // newWindow: true,
                                          close: true,
                                          gravity: "top", // `top` or `bottom`
                                          position: "center", // `left`, `center` or `right`
                                          stopOnFocus: true, // Prevents dismissing of toast on hover
                                          style: {
                                            background: "#28a745",
                                          },
                                          // onClick: function(){} // Callback after click
                                        }).showToast();
                                    
                                }
                                else
                                {
                                    Toastify({
                                          text: "Please login to your account before adding this product to wishlist",
                                          duration: 10000,
                                          // destination: "https://github.com/apvarun/toastify-js",
                                          // newWindow: true,
                                          close: true,
                                          gravity: "top", // `top` or `bottom`
                                          position: "center", // `left`, `center` or `right`
                                          stopOnFocus: true, // Prevents dismissing of toast on hover
                                          style: {
                                            background: "#dc3545",
                                          },
                                          // onClick: function(){} // Callback after click
                                        }).showToast();

                                    
                                }
                                
                                setTimeout(function() {
                                myself.attr("disabled",false);
                                myself.removeClass("disabled");
                            },2500)
                            

                    })

                    .catch((error) => console.log(error));

                // cart axios code

                

            });
            // add to wishlist

             // remove from wish list
             $(document.body).on("click",".rm-wish-item",function() {
                var mymsg;
                var myself = $(this);
                myself.addClass("disabled");
                myself.attr("disabled",true);
                myself.html('<div class="spinner-border text-warning"></div>');
                var wishId = $(this).data("wishid");
                
                // cart axios code
              // console.log(wishId);

                const formdata = new FormData();

                  formdata.append("wishId",wishId); 

                  axios.post("<?= base_url('product/removeFromWishList')?>", formdata).then(function (response) {
                        // console.log(response.data);

                        if (response.data.msgColor == "success") {

                                mymsg = "Product is removed from wishlist!";
                                
                            }
                            else{
                                mymsg = "Please login to your account before removing this product from wishlist";
                                
                            }

                            $("#wishbody").html(response.data.wishlist)

                        Toastify({
                              text: mymsg,
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

                            
                    })

                    .catch((error) => console.log(error));
            });
             // remove from wish list


            // Product Quick view
            
             
             $(document.body).on("click","a.btn-quickview",function() {
                var proid = $(this).data("proid");
                $(".popup_product").html("Please...")

                const formdata = new FormData();

                  formdata.append("prId",proid); 

                  axios.post("<?= base_url('product/pro_quickview')?>", formdata).then(function (response) {
                            // console.log(response.data)

                            $(".popup_product").html(response.data)

                    })

                    .catch((error) => console.log(error));


             });

            // Product Quick view


           $(document.body).on("click",".w-icon-plus",function() {

               var qtyInput = $(this).siblings()[0];
               console.log(qtyInput);
               const qtyval = parseInt(qtyInput.value)+1;
               const currurl = $(location).attr("href").split('/').pop();
                    if (currurl == "shopping-cart") {
                        qtyInput.value = qtyval
                    }
               
           }) 

           $(document.body).on("click",".w-icon-minus",function() {

               let qtyInput = $(this).siblings()[0];
               if (qtyInput.value > 1) {
                    const qtyval = parseInt(qtyInput.value) - 1;
                    
                    const currurl = $(location).attr("href").split('/').pop();
                    if (currurl == "shopping-cart") {
                        qtyInput.value = qtyval
                    }
                    
               }
               
               
           }) 


            // add to cart
            
            $('.btn-cart').on('click', function(e) {
                e.preventDefault();

                var proid = $(this).data("id");
                /*alert(proid);
                console.log(proid);*/
                // cart axios code

                    var allVars ="";

                  //console.log(allVars);

                const formdata = new FormData();

                  formdata.append("prId",proid); 

                  formdata.append("prQty",1); 

                  formdata.append("varComb",allVars);

                  axios.post("<?= base_url('product/addToCart')?>", formdata).then(function (response) {
                            // console.log(response.data)
                            $('.cart-count').html(response.data.cartQty); 
                            response.data.msgColor == "success"
                            if (response.data.msgColor == "success") {
                                $("#side_cart_content").html(response.data.allitems)
                                $("#side_cart_subtotal").html("<?= price_symbol()?>"+response.data.carttotal)
                                $(".cart-dropdown").addClass("opened")
                            }

                    })

                    .catch((error) => console.log(error));

                // cart axios code

                

            });

            // addto cart

            // remove from cart
            $(document.body).on("click",".rm-cart-item",function() {
                $('#loader').css('display',"block"); 
                var myself = $(this);
                myself.addClass("disabled");
                myself.attr("disabled",true);
                myself.html('<div class="spinner-border text-warning"></div>');
                var rowId = $(this).data("rowid");
                
                // cart axios code
                
                axios.get("<?= base_url('product/removeitemcart/')?>"+rowId).then(function (response){
                        // console.log(response.data.length);

                        $('.cart-item-list').html(response.data); 
                        myself.attr("disabled",false);
                        myself.removeClass("disabled");
                        
                        Toastify({
                          text: "Product is removed from cart!",
                          duration: 10000,
                          // destination: "https://github.com/apvarun/toastify-js",
                          // newWindow: true,
                          close: true,
                          gravity: "top", // `top` or `bottom`
                          position: "center", // `left`, `center` or `right`
                          stopOnFocus: true, // Prevents dismissing of toast on hover
                          style: {
                            background: "#28a745",
                          },
                          // onClick: function(){} // Callback after click
                        }).showToast();

                        setTimeout(function(){
                                location.reload();
                            }, 2000); 
                        
                        // location.reload()
                    })
                    .catch((error) => console.log(error));
            });
            // remove from cart

            // Review
                $(document.body).on("click",".rating-stars a",function() {
                      const stars = $(this);
                      let starval = stars.attr("class");
                      var rate=0;
                      if (starval == 'star-1') {
                            rate = 1;
                      }
                      else if(starval == 'star-2'){
                        rate = 2;
                      }
                      else if(starval == 'star-3'){
                        rate = 3;
                      }
                      else if(starval == 'star-4'){
                        rate = 4;
                      }
                      else if(starval == 'star-5'){
                        rate = 5;
                      }
                      else{
                        rate = 0;
                      }
                      
                      if (rate > 0 && rate < 6) {
                        $(".review-box").attr("disabled",false)
                        $(".review-box").css("backgroundColor","#fff")
                      }

                      $("#rating").val(rate)
                      // console.log($("#rating").val());
                })
            // Review

           // ship charge update using address
            $(document.body).on("click",".addresses",function() {
                    $('#loader').css('display',"block"); 
                     var stateName = $(this).data("statename");
                     const formdata = new FormData();
                     formdata.append("stateName",stateName); 
                     axios.post("<?= base_url('product/getshipcharge')?>", formdata).then(function (response) {
                        // console.log(response.data);
                        $('#shipprice').html(response.data.shipcharge); 
                        $('#couponprice').html(response.data.discounted); 
                        $('#totalprice').html(response.data.finalPrice); 
                        $('#loader').css('display',"none"); 
                     })
                     .catch((error) => console.log(error));
                })
            // ship charge update using address


        })

        function submitReview(e) {
          e.preventDefault();  
          const formdata = new FormData(e.target);
          let rate = formdata.get('rating')
          if (rate > 0 && rate < 6) {
            console.log(formdata.get('productId'));
              formdata.append("productId",formdata.get('productId')); 
              formdata.append("urating",rate); 
              formdata.append("uname",formdata.get('uname')); 
              formdata.append("uemail",formdata.get('uemail')); 
              formdata.append("uphone",formdata.get('uphone')); 
              formdata.append("ucomment",formdata.get('comment')); 

               axios.post("<?= base_url('product/submitReview')?>", formdata).then(function (response) {
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

                    
                    
            })
            .catch((error) => console.log(error));


          }
          else{
            alert("Please select rating star..");
          }
          
        }

      function login(e) {
          e.preventDefault();
          $('#loader').css('display',"block"); 
          
          const formdata = new FormData(e.target);
          let redirect = formdata.get('redirect')
          formdata.append("email",formdata.get('email')); 
          formdata.append("pass",formdata.get('password')); 

          $(".login-btn").html("Please Wait...");
          $(".login-btn").attr("disabled",true);
          $(".login-btn").addClass("disabled");
          
          axios.post("<?= base_url('account/logindata')?>", formdata).then(function (response) {
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
                    if (redirect == "user-checkout") {
                         window.location.href = "<?= base_url('user-checkout')?>";
                    }
                    else{
                        setTimeout(function(){
                            location.reload();
                        }, 2000);          
                    }
                    
                    
                }
                
                $(".login-btn").html("Login Now");
                $(".login-btn").attr("disabled",false);
                $(".login-btn").removeClass("disabled");
                    
                    
            })
            .catch((error) => console.log(error));
        }

        function registration(e) {
            
          e.preventDefault();

          $(".register-btn").html("Please Wait...");
          $(".register-btn").attr("disabled",true);
          $(".register-btn").addClass("disabled");

          $('#loader').css('display',"block"); 
          
          const formdata = new FormData(e.target);
          let redirect = formdata.get('redirect')

          formdata.append("cfname",formdata.get('fname')); 
          formdata.append("clname",formdata.get('lname')); 
          formdata.append("cemail",formdata.get('email')); 
          formdata.append("cphone",formdata.get('phone')); 
          formdata.append("cpass",formdata.get('password')); 
          
          axios.post("<?= base_url('account/registrationdata')?>", formdata).then(function (response) {
                    
                // pop cart message
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
                    if (redirect == "user-checkout") {
                         window.location.href = "<?= base_url('user-checkout')?>";
                    }
                    else{
                        setTimeout(function(){
                            location.reload();
                        }, 2000);          
                    }
                }
                
                $(".register-btn").html("Register Now");
                $(".register-btn").attr("disabled",false);
                $(".register-btn").removeClass("disabled");
            })
            .catch((error) => console.log(error));
            
        }
        function passwordreset(e) {
            e.preventDefault();
        }
 </script>


 <!-- Start of Footer -->
        <footer class="footer appear-animate" data-animation-options="{'name': 'fadeIn'}">
            <div class="footer-newsletter bg-primary">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-5 col-lg-6">
                            <div class="icon-box icon-box-side text-white">
                                <div class="icon-box-icon d-inline-flex">
                                    <i class="w-icon-envelop3"></i>
                                </div>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-white text-uppercase font-weight-bold">Subscribe To
                                        Our Newsletter</h4>
                                    <p class="text-white">Get all the latest information on Events, Sales and Offers.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
                            <form action="#" method="get"
                                class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                                <input type="email" class="form-control mr-2 bg-white" name="email" id="email"
                                    placeholder="Your E-mail Address" />
                                <button class="btn btn-dark btn-rounded" type="submit">Subscribe<i
                                        class="w-icon-long-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="widget widget-about">
                                <a href="demo1.html" class="logo-footer">
                                    <img src="<?= base_url('assets/') ?>/images/logo.png" alt="logo-footer" width="144"
                                        height="45" />
                                </a>
                                <div class="widget-body">
                                    <p class="widget-about-title">Got Question? Call us 24/7</p>
                                    <a href="tel:18005707777" class="widget-about-call">+91 8240 399 503</a>
                                    <p class="widget-about-desc">Register now to get updates on pronot get up icons
                                        & coupons ster now toon.
                                    </p>

                                    <div class="social-icons social-icons-colored">
                                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                        <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                        <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                        <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h3 class="widget-title">Company</h3>
                                <ul class="widget-body">
                                    <li><a href="<?= base_url('about-us')?>">About Us</a></li>
                                    <li><a href="<?= base_url('terms-and-conditions')?>">Terms and Conditions</a></li>
                                    <li><a href="<?= base_url('cancellation-and-refund-policy')?>">Cancellation & Refund Policy</a></li>
                                    <li><a href="<?= base_url('privacy-policy')?>">Privacy and Policy</li>
                                    <li><a href="<?= base_url('shipping-and-delivery_policy')?>">Shipping And Delivery Policy</a></li>
                                    <li><a href="<?= base_url('contact-us')?>">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4>
                                <ul class="widget-body">
                                    <li><a href="#">Track My Order</a></li>
                                    <li><a href="cart.html">View Cart</a></li>
                                    <li><a href="login.html">Sign In</a></li>
                                    <li><a href="#">Help</a></li>
                                    <li><a href="wishlist.html">My Wishlist</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Customer Service</h4>
                                <ul class="widget-body">
                                    <li><a href="#">Payment Methods</a></li>
                                    <li><a href="#">Money-back guarantee!</a></li>
                                    <li><a href="#">Product Returns</a></li>
                                    <li><a href="#">Support Center</a></li>
                                    <li><a href="#">Shipping</a></li>
                                    <li><a href="#">Term and Conditions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                     $midFooter= $this->db->where("id",1)->get("others_settings")->row();
                     if ($midFooter->status == 1) {
                         echo $midFooter->content;
                     }
                 ?>
                <div class="footer-bottom">
                    <div class="footer-left">
                        <p class="copyright">Copyright © 2021 Shop24u Store. All Rights Reserved.</p>
                    </div>
                    <div class="footer-right">
                        <span class="payment-label mr-lg-8">We're using safe payment for</span>
                        <figure class="payment">
                            <img src="<?= base_url('assets/') ?>/images/payment.png" alt="payment" width="159" height="25" />
                        </figure>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Page-wrapper --- starter is in header.php-->

    <!-- Start of Sticky Footer -->
    <div class="sticky-footer sticky-content fix-bottom">
        <a href="<?= base_url()?>" class="sticky-link active">
            <i class="w-icon-home"></i>
            <p>Home</p>
        </a>
        <a href="<?= base_url('collection')?>" class="sticky-link">
            <i class="w-icon-category"></i>
            <p>Shop</p>
        </a>
        <?php if ($this->session->has_userdata('userid')): ?>
            <a href="<?= base_url('my-account')?>" class="sticky-link">
                <i class="w-icon-account"></i>
                <p>Account</p>
            </a>    
        <?php else: ?>
            <a href="<?= base_url('account/loginForm')?>" class="sticky-link login sign-in">
                <i class="w-icon-account"></i>
                <p>Account</p>
            </a>
        <?php endif ?>
        
        <div class="cart-dropdown dir-up">
            <a href="javascript:void()" class="sticky-link">
                <i class="w-icon-cart">
                    <!-- <span class="cart-count" style="right: 8px;top: 3px;"><?= $this->cart->total_items(); ?></span> -->
                </i>
                <p>Cart</p>
            </a>
            <div class="dropdown-box">
               <!--  <div class="products">
                    <div class="product product-cart">
                        <div class="product-detail">
                            <h3 class="product-name">
                                <a href="product-default.html">Beige knitted elas<br>tic
                                    runner shoes</a>
                            </h3>
                            <div class="price-box">
                                <span class="product-quantity">1</span>
                                <span class="product-price">$25.68</span>
                            </div>
                        </div>
                        <figure class="product-media">
                            <a href="product-default.html">
                                <img src="<?= base_url('assets/') ?>/images/cart/product-1.jpg" alt="product" height="84" width="94" />
                            </a>
                        </figure>
                        <button class="btn btn-link btn-close" aria-label="button">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="product product-cart">
                        <div class="product-detail">
                            <h3 class="product-name">
                                <a href="product-default.html">Blue utility pina<br>fore
                                    denim dress</a>
                            </h3>
                            <div class="price-box">
                                <span class="product-quantity">1</span>
                                <span class="product-price">$32.99</span>
                            </div>
                        </div>
                        <figure class="product-media">
                            <a href="product-default.html">
                                <img src="<?= base_url('assets/') ?>/images/cart/product-2.jpg" alt="product" width="84" height="94" />
                            </a>
                        </figure>
                        <button class="btn btn-link btn-close" aria-label="button">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div> -->

                <div class="cart-total">
                    <label>Subtotal:</label>
                    <span class="price"><?= price_symbol($this->cart->total()) ?></span>
                </div>

                <div class="cart-action">
                    <a href="<?= base_url('shopping-cart')?>" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                    <a href="<?= base_url('user-checkout')?>" class="btn btn-primary  btn-rounded">Checkout</a>
                </div>
            </div>
            <!-- End of Dropdown Box -->
        </div>

        <div class="header-search hs-toggle dir-up">
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
        </div>
    </div>
    <!-- End of Sticky Footer -->

    <!-- Start of Scroll Top -->
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i> <svg
            version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
                r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
        </svg> </a>
    <!-- End of Scroll Top -->

    

    <!-- Start of Newsletter popup -->
    <div class="newsletter-popup mfp-hide">
        <div class="newsletter-content">
            <h4 class="text-uppercase font-weight-normal ls-25">Get Up to<span class="text-primary">25% Off</span></h4>
            <h2 class="ls-25">Sign up to Shop24u</h2>
            <p class="text-light ls-10">Subscribe to the Shop24u market newsletter to
                receive updates on special offers.</p>
            <form action="#" method="get" class="input-wrapper input-wrapper-inline input-wrapper-round">
                <input type="email" class="form-control email font-size-md" name="email" id="email2"
                    placeholder="Your email address" required="">
                <button class="btn btn-dark" type="submit">SUBMIT</button>
            </form>
            <div class="form-checkbox d-flex align-items-center">
                <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup"
                    required="">
                <label for="hide-newsletter-popup" class="font-size-sm text-light">Don't show this popup again.</label>
            </div>
        </div>
    </div>
    <!-- End of Newsletter popup -->

    <!-- Start of Quick View -->
    <div class="product product-single product-popup">
        <div class="popup_product">
            <?php 
                $this->load->view('includes/product-popup');
             ?>
        </div>
    </div>
    <!-- End of Quick view -->

    <!-- Plugin JS File -->
    
    <script src="<?= base_url('assets/') ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>/vendor/jquery.plugin/jquery.plugin.min.js"></script>
    <script src="<?= base_url('assets/') ?>/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url('assets/') ?>/vendor/zoom/jquery.zoom.js"></script>
    <script src="<?= base_url('assets/') ?>/vendor/jquery.countdown/jquery.countdown.min.js"></script>
    <script src="<?= base_url('assets/') ?>/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url('assets/') ?>/vendor/skrollr/skrollr.min.js"></script>
    <script src="<?= base_url()?>assets/vendor/sticky/sticky.min.js"></script>
    <!-- Swiper JS -->
    <script src="<?= base_url('assets/') ?>/vendor/swiper/swiper-bundle.min.js"></script>

    <script src="<?= base_url('assets/') ?>vendor/photoswipe/photoswipe.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/photoswipe/photoswipe-ui-default.min.js"></script>
    <!-- Main JS -->
    <script src="<?= base_url('assets/') ?>/js/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>



</html>