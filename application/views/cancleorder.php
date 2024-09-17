<?php 
    include_once("includes/header.php");
    include_once("includes/navbar.php");
 ?>
 
        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">Cancle Order</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?= base_url()?>">Home</a></li>
                        <li>Cancle Order</li>
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
                                <div class="tab-pane active in">
                                    <p class="mb-7">Order <b>#<?= $odrInfo->id ?></b> was placed on <?php 
                                                $odate=date_create($odrInfo->created_at);
                                                echo date_format($odate,"M d, Y");
                                             ?> and is <?php if ($odrInfo->ordstatus == 1): ?>
                                        <a href="javascript:void(0)" class="btn btn-warning btn-underline btn-link sm">Processing</a>
                                        
                                    <?php elseif ($odrInfo->ordstatus == 2): ?>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-underline btn-link sm">Cancled</a>
                                        
                                    <?php elseif ($odrInfo->ordstatus == 3): ?>
                                        <a href="javascript:void(0)" class="btn btn-info btn-underline btn-link sm">Dispatched</a>
                                    <?php elseif ($odrInfo->ordstatus == 4): ?>
                                        <a href="javascript:void(0)" class="btn btn-success btn-underline btn-link sm">Completed</a>
                                    <?php else: ?>
                                        <a href="javascript:void(0)" class="btn btn-warning btn-underline btn-link sm">Processing</a>
                                    <?php endif ?>.</p>
                                    
                                
                                <div class="order-details-wrapper mb-5">
                                    <h4 class="title text-uppercase ls-25 mb-5">Cancle order</h4>
                                    <?php if ($odrInfo->ordstatus == 2): ?>
                                        <div class="alert alert-error alert-bg alert-button alert-block show-code-action">
                                            <h4 class="alert-title">Order Status : Canceled!</h4>
                                            <p>
                                                <?php echo $odrInfo->description ?>
                                            </p>
                                            <br>
                                            <a href="<?= base_url('users/orders')?>" class="btn btn-secondary btn-ellipse">Back To Order List</a>
                                            <a href="<?= base_url('collection')?>" class="btn btn-secondary btn-outline btn-ellipse">Continue Shopping</a>
                                        </div>
                                    <?php else: ?>
                                        

                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                                <div class="card-items">
                                                    <!-- <form class="form checkout-form" method="post" onsubmit="return cancleOrder(event)"> -->
                                                    <form class="form checkout-form" method="post" onsubmit="return cancleOrder(event)">
                                                        
                                                        <input type="hidden" name="ordId" value="<?= $odrInfo->id ?>">
                                                            <div class="row mb-9">
                                                                <div class="col-lg-12 pr-lg-12 mb-4">
                                                                    
                                                                    <div class="form-group">
                                                                        <label>Please specify the reason to cancle this order *</label>
                                                                        <textarea id="message" name="message" cols="30" rows="3" class="form-control disabled"><?php echo $odrInfo->description ?></textarea>  
                                                                        
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary btn-outline btn-icon-left"> 
                                                                            <i class="w-icon-long-arrow-right"></i>Cancle my order
                                                                        </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endif ?>

                                    
                                </div>
                                <!-- End of Order Details -->
            
                             
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->

        <script type="text/javascript">
            function cancleOrder(e) {
              e.preventDefault();
               $('#loader').css('display',"block"); 
               
              

              const formdata = new FormData(e.target);
              formdata.append("orderId",formdata.get('ordId')); 
              formdata.append("description",formdata.get('message')); 
              
              
              axios.post("<?= base_url('users/cancleorderData')?>", formdata).then(function (response) {
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
                    
                    $('#loader').css('display',"none"); 

                    
                })
                .catch((error) => console.log(error));
            
          }
        </script>


<?php 
    include_once("includes/footer.php");
 ?>