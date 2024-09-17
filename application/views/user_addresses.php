<?php 
    include_once("includes/header.php");
    include_once("includes/navbar.php");
 ?>
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
        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">My Addresses</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?= base_url()?>">Home</a></li>
                        <li>My Addresses</li>
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
                                            <i class="w-icon-map-marker"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title text-capitalize ls-normal mb-0">My Addresses</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            

                                           <?php if ($this->session->flashdata('messages')): ?>
                                            <div class="alert alert-icon <?= $this->session->flashdata('alrt_cls')?> alert-bg alert-inline show-code-action">
                                                <h4 class="alert-title">
                                                    <i class="fas fa-check"></i></h4> <?php echo $this->session->flashdata('messages') ?>
                                            </div>
                                                
                                           <?php endif ?>


                                            <?php foreach ($addressList as $key => $addres): ?>
                                                <?php 
                                                    $this->load->view("includes/addressview2",["addres"=>$addres]);
                                                 ?>
                                                
                                            <?php endforeach ?>
                                            
                                        </div>
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