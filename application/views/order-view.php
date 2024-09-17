<?php 
    include_once("includes/header.php");
    include_once("includes/navbar.php");
 ?>
 
        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">Order Info</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?= base_url()?>">Home</a></li>
                        <li>Order Info</li>
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
                                    <h4 class="title text-uppercase ls-25 mb-5">Order Details</h4>
                                    <table class="order-table">
                                        <thead>
                                            <tr>
                                                <th class="text-dark">Product</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $odrData = (unserialize($odrInfo->orderDetail));
                                                $j=1;
                                                    $totalQty = 0;
                                                    $totalAmt = 0;
                                                    $totaltax = 0;
                                             ?>
                                             <?php foreach ($odrData as $key => $odrData): ?>
                                                  <tr>
                                                    <?php 
                                                        $prId = $odrData["id"];
                                                        $proInfo = $this->db->where("id",$prId)->get("products")->row();
                                                     ?>
                                                        <td>
                                                            <a href="#"><?= $odrData["name"]?></a>&nbsp;<strong>x <?= $odrData["qty"]?></strong><br>
                                                            
                                                        </td>
                                                        
                                                        <?php 
                                                                $totalTaxPer = 0;

                                                                if (isset($odrData["options"]["tax"])){
                                                                $taxslab = $proInfo->taxSlab;
                                                                 $taxArr = explode(",", $taxslab);
                                                                 for ($k=0; $k < count($taxArr) ; $k++) { 
                                                                    $taxInfo= $this->db->where("id",$taxArr[$k])->get("taxes")->row();
                                                                    $totalTaxPer = $totalTaxPer + $taxInfo->taxpercent;
                                                                    
                                                                 }
                                                                 // echo $totalTaxPer;
                                                                }
                                                             ?>
                                                        <?php 

                                                            $taxPrice = ($odrData["subtotal"] * $totalTaxPer)/100;

                                                            if ($odrData["options"]["taxType"] == "included"){
                                                                $prWithTax = $odrData["subtotal"] ;
                                                                $taxShow = "Included in price";
                                                            }
                                                            else{
                                                                $prWithTax = $odrData["subtotal"] + $taxPrice; 
                                                                $taxShow = price_symbol($taxPrice);
                                                            }
                                                            $totaltax = $totaltax + $taxPrice;
                                                            $totalAmt = $totalAmt + $prWithTax;
                                                            ?>
                                                        <td>
                                                            <b><?= price_symbol($odrData["subtotal"]) ?></b>
                                                            <br>
                                                            Tax : <?= $taxShow." (GST - ".$totalTaxPer."%)" ?>
                                                        </td>
                                                    </tr>
                                             <?php endforeach ?>
                                           
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Tax:</th>
                                                <td><?= price_symbol($totaltax) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Subtotal:</th>
                                                <td><?= price_symbol($totalAmt) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td>Flat rate</td>
                                            </tr>
                                            <tr>
                                                <th>Payment method:</th>
                                                <td style="text-transform: capitalize;">
                                                    <?= $odrInfo->payment_method_name ?>
                                                    <?php if ($odrInfo->payment_method == 1): ?>
                                                        Payment Gateway
                                                    <?php endif ?>
                                                        
                                                    </td>
                                            </tr>
                                            <tr class="total">
                                                <th class="border-no">Total:</th>
                                                <td class="border-no"><?= price_symbol($totalAmt) ?> <?php /* add Shipping price */?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- End of Order Details -->
            
                               
                                <div id="billing-account-addresses">
                                    <div class="row">       
                                        <div class="col-sm-6 mb-8">
                                            <div class="ecommerce-address billing-address">
                                                <h4 class="title title-underline ls-25 font-weight-bold">Billing Address</h4>
                                                <address class="mb-4">
                                                    <table class="address-table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Address : <?= $odrInfo->billaddress ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>User Phone : <?= $odrInfo->userPhone ?></td>
                                                            </tr>
                                                            <tr class="email">
                                                                <td>User email : <?= $odrInfo->email ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </address>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-8">
                                            <div class="ecommerce-address shipping-address">
                                                <h4 class="title title-underline ls-25 font-weight-bold">Shipping Address</h4>
                                                <address class="mb-4">
                                                    <table class="address-table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Address : <?= $odrInfo->shipaddress ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>User Phone : <?= $odrInfo->userPhone ?></td>
                                                            </tr>
                                                            <tr class="email">
                                                                <td>User email : <?= $odrInfo->email ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Account Address -->
            
                                <a href="<?= base_url('users/orders')?>" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6 mb-6"><i class="w-icon-long-arrow-left"></i>Back To List</a>
                                <?php if ($odrInfo->ordstatus == 2): ?>
                                    <a href="javascript:void(0)" class="btn btn-secondary btn-underline btn-link lg float-right">Order Canceled</a>
                                <?php else: ?>
                                    <a onclick="return confirm('Are you sure want to cancle this order?')" href="<?= base_url('users/cancleorder/'.$odrInfo->id)?>" class="btn btn-secondary btn-underline btn-link lg float-right">Cancle Order</a>        
                                <?php endif ?>
                                
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