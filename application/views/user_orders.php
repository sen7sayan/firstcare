<?php 
    include_once("includes/header.php");
    include_once("includes/navbar.php");
 ?>
 <style type="text/css">
    .text-secondary2{
        color: #6c757d!important;
    }
    .list-border{
      border-right: 2px solid #f2f2f5;
    }
    .order-amt{
      font-size: 13px;
    }
    .order-list .card-items{
      border-left: 5px solid #00ff13;
      border-radius: 20px;
    }
    .order-date p{
         font-size: 10px !important;
      }
    .mt-n3{
        margin-top: -20px;
    }
    @media only screen and (max-width: 699px){
      .order-date p{
         font-size: 12px;
      }
    }
 </style> 
        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">My Orders</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?= base_url()?>">Home</a></li>
                        <li>My account</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content pt-2">
                <div class="container">
                    <div class="my-account">
                        <div class="tab tab-vertical row gutter-lg">
                            <?php 
                                include_once('includes/user-left-sidebar.php')
                             ?>
                            <div class="tab-content mb-6">
                                <div class="tab-pane active in" id="account-orders">
                                    <div class="icon-box icon-box-side icon-box-light">
                                        <span class="icon-box-icon icon-orders">
                                            <i class="w-icon-orders"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="btn-group">
                                                <div class="btn-wrap show-code-action">
                                                    <a href="<?= base_url('users/orders') ?>" class="btn btn-xm btn-primary btn-outline btn-ellipse">All</a>
                                                </div>
                                                <div class="btn-wrap show-code-action">
                                                    <a href="<?= base_url('users/orders/processing-orders') ?>" class="btn btn-xm btn-primary btn-outline btn-ellipse">Processing Orders</a>
                                                </div>
                                                <div class="btn-wrap show-code-action">
                                                    <a href="<?= base_url('users/orders/completed-orders') ?>" class="btn btn-xm btn-success btn-outline btn-ellipse">Completed Orders</a>
                                                </div>
                                                <div class="btn-wrap show-code-action">
                                                    <a href="<?= base_url('users/orders/canceled-orders') ?>" class="btn btn-xm btn-secondary btn-outline btn-ellipse">Canceled Orders</a>
                                                </div>
                                                <div class="btn-wrap show-code-action">
                                                    <a href="<?= base_url('users/orders/dispatched-orders') ?>" class="btn btn-xm btn-primary btn-outline btn-ellipse">Dispatched Orders</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (count($orderlist)): ?>
                                            <?php foreach ($orderlist as $key => $orders): ?>
                                                <div class="col-md-12 p-2">
                                                     <div class="order-list">
                                                           <div class="card-items p-2 rounded">
                                                              <div class="row">
                                                                 <div class="col-md-6 pr-2 list-border">
                                                                    <h5 class="text-gray">Order # : <?= $orders->id; ?> </h5>
                                                                    <p class="text-secondary2 mt-n3">Order Date : <?=  date("d-M-Y h:i:a", strtotime($orders->created_at)) ?></p>      
                                                                    
                                                                    <h5 class="mt-4"><?= $orders->user_name; ?></h5>
                                                                    <p class="text-secondary mt-n3">Phone : <?= $orders->userPhone; ?></p>
                                                                    <p class="text-secondary mt-n4">Email : <?= $orders->email; ?></p>
                                                                    <h6 class="order-amt">Order Qty : <?= $orders->totalItems ?> <span class="text-success ml-2">Amount : <i class="font-weight-bold"> ₹<?= $orders->amount ?> </i></span></h6>
                                                                    
                                                                 </div>
                                                                 <div class="col-md-6">
                                                                    <div>
                                                                        <b>Order Status :</b><?php if ($orders->ordstatus == 1): ?>
                                                                            <span class="badge badge-warning"> Processing</span>
                                                                        <?php elseif ($orders->ordstatus == 2): ?>
                                                                            <span class="badge badge-danger"> Canceled</span>
                                                                        <?php elseif ($orders->ordstatus == 3): ?>
                                                                            <span class="badge badge-info"> Dispatched</span>
                                                                        <?php elseif ($orders->ordstatus == 4): ?>
                                                                            <span class="badge badge-success"> Completed</span>
                                                                        <?php endif ?>     
                                                                    </div>
                                                                    <?php if ($orders->ordstatus != 2): ?>
                                                                        <div>
                                                                            <?php if ($orders->payment_method == 1): ?>
                                                                                <span class="badge badge-success ">Payment : Online</span>
                                                                            <?php else: ?>    
                                                                                <span class="badge badge-warning ">Payment : COD</span>
                                                                            <?php endif ?>
                                                                        </div>    
                                                                    <?php endif ?>
                                                                    
                                                                    <h5 class="text-secondary mt-2">Address</h5>
                                                                    <p class="mt-n3"><?= $orders->billaddress ?></p>
                                                                    <div class="btn-group ml-1">
                                                                        <a href="<?= base_url('users/ordersinfo/'.$orders->id)?>" class="mt-3 btn btn-xm btn-primary btn-ellipse">View order Detail</a>
                                                                        <?php if ($orders->ordstatus == 2): ?>
                                                                            <a href="<?= base_url('product/paycancled_order/'.$orders->id)?>" class="btn btn-xm btn-success btn-ellipse btn-outline btn-icon-left mt-3 ml-2">
                                                                                <i class="w-icon-long-arrow-right"></i>Pay Now to Place Order
                                                                            </a>        
                                                                        <?php endif ?>
                                                                        
                                                                    </div>
                                                                    
                                                                 </div>
                                                              </div>
                                                           
                                                        </div>
                                                     </div>
                                                  </div> 
                                            <?php endforeach ?>
                                        <?php else: ?>
                                            <h4>No Order found</h4>
                                        <?php endif ?>
                                    </div>
                                    

                                    <a href="<?= base_url('collection')?>" class="btn btn-dark btn-rounded btn-icon-right">Go
                                        Shop<i class="w-icon-long-arrow-right"></i></a>
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