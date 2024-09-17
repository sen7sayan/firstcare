<?php 
    include_once("includes/header.php");
    include_once("includes/navbar.php");
 ?>
<style type="text/css">
  .success-check{
    color: white;
    background: #f41414;
    font-size: 35px;
    padding: 24px;
    border-radius: 50%;
  }
</style>
        <!-- Start of Main -->
        <main class="main cart">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li ><a href="<?= base_url('shopping-cart')?>">Shopping Cart</a></li>
                        <li ><a href="#">Checkout</a></li>
                        <li class="active"><a href="#">Try again</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg mb-10">
                        <div class="col-lg-12 pr-lg-4 mb-6">
                            <div class="text-center">
                              <i class="w-icon-times-solid success-check"></i>
                              <h1 class="text-success mt-5">Order Payment is not done!</h1>
                              <a href="<?= base_url('payment/order_payment/')?>" class="btn btn-success btn-outline btn-ellipse">Try Again for payment</a>
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