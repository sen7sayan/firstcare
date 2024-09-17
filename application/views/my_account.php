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
                    <h1 class="page-title mb-0">Account Details</h1>
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
                                            <i class="w-icon-user"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title text-capitalize ls-normal mb-0">Account Details and Setting</h4>
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
                                            <form class="form account-details-form" action="<?= base_url('users/updateuser_details')?>" method="post" >
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="firstname">First name *</label>
                                                            <input type="text" id="firstname" name="firstname" placeholder="John"
                                                                class="form-control form-control-md" value="<?= $userinfo->firstname ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="lastname">Last name *</label>
                                                            <input type="text" id="lastname" name="lastname" placeholder="Doe"
                                                                class="form-control form-control-md" value="<?= $userinfo->lastname ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="display-name">Phone Number *</label>
                                                            <input type="text" id="display-name" name="phonenumber" placeholder="Phone Number" class="form-control form-control-md mb-0" value="<?= $userinfo->phone ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-6">
                                                            <label for="email_1">Email address *</label>
                                                            <input type="email" id="email_1" name="email_1" class="form-control form-control-md" value="<?= $userinfo->email ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                              
                                                <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
                                                <div class="form-group">
                                                    <label class="text-dark" for="cur-password">Current Password leave blank to leave unchanged</label>
                                                    <input type="text" disabled class="form-control form-control-md disabled"
                                                        id="cur-password"  value="<?= $userinfo->password ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-dark" for="new-password">New Password leave blank to leave unchanged</label>
                                                    <input type="password" class="form-control form-control-md" id="new-password" name="new_password" value="<?= $userinfo->password ?>">
                                                </div>
                                                <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
                                            </form>
                                        </div>
                                        
                                    </div>
                                    
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