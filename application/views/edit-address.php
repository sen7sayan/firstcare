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
                    <h1 class="page-title mb-0">My Account</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?= base_url()?>">Home</a></li>
                        <li>Edit Address</li>
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
                                            
                                            <div class="card-items">
                                                <form class="form checkout-form" method="post" onsubmit="return updateAddress(event)">
                                                    <input type="hidden" name="addressId" value="<?= $addressinfo->id ?>">
                                                        <div class="row mb-9">
                                                            <div class="col-lg-12 pr-lg-12 mb-4">
                                                                <div class="row gutter-sm">
                                                                    <div class="col-xs-6">
                                                                        <div class="form-group">
                                                                            <label>First name *</label>
                                                                            <input type="text" class="form-control form-control-md" name="cofname" placeholder="First name *" value="<?= $addressinfo->firstname ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <div class="form-group">
                                                                            <label>Last name *</label>
                                                                            <input type="text" class="form-control form-control-md" name="colname" placeholder="Last name *" value="<?= $addressinfo->lastname ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="form-group">
                                                                    <label>Street address *</label>
                                                                    <input type="text" placeholder="House number and street name" class="form-control form-control-md mb-2" name="cofulladdress"  value="<?= $addressinfo->address ?>">
                                                                    <input type="text" placeholder="Apartment, suite, unit, etc. (optional)" class="form-control form-control-md" name="cofulladdress2"  value="<?= $addressinfo->address2 ?>">
                                                                </div>
                                                                <div class="row gutter-sm">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Town / City *</label>
                                                                            <input type="text" class="form-control form-control-md" name="cocity" placeholder="Town / City *"  value="<?= $addressinfo->city ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Pincode *</label>
                                                                            <input type="text" class="form-control form-control-md" name="copincode" placeholder="Pincode *" value="<?= $addressinfo->pincode ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <div class="select-box">
                                                                                <?php 
                                                                                        $states = ["Andhra Pradesh","Andaman and Nicobar Islands","Arunachal Pradesh","Assam","Bihar","Chandigarh","Chhattisgarh","Dadar and Nagar Haveli","Daman and Diu","Delhi","Lakshadweep","Puducherry","Goa","Gujarat","Haryana","Himachal Pradesh","Jammu and Kashmir","Jharkhand","Karnataka","Kerala","Madhya Pradesh","Maharashtra","Manipur","Meghalaya","Mizoram","Nagaland","Odisha","Punjab","Rajasthan","Sikkim","Tamil Nadu","Telangana","Tripura","Uttar Pradesh","Uttarakhand","West Bengal",]
                                                                                 ?>
                                                                                
                                                                                <label>Select State</label>
                                                                                <select class="form-control form-control-md" name="costate">
                                                                                    <?php foreach ($states as $statename): ?>
                                                                                        <?php 
                                                                                        if ($statename == $addressinfo->state) {
                                                                                            $selSate = "selected";
                                                                                        }
                                                                                        else{
                                                                                            $selSate = "";
                                                                                        }

                                                                                         ?>
                                                                                        <option <?= $selSate ?>  value="<?= $statename; ?>"><?= $statename; ?></option><?= $statename; ?>
                                                                                    <?php endforeach ?>        
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="select-box">
                                                                                <label>Country *</label>
                                                                                <select name="coCountry" class="form-control form-control-md">
                                                                                    <option value="india" selected="selected">India
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="row gutter-sm">
                                                                    <div class="col-xs-6">
                                                                        <div class="form-group">
                                                                            <label>Phone *</label>
                                                                            <input type="text" class="form-control form-control-md" name="cophone" placeholder="Phone *" value="<?= $addressinfo->phone ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <div class="form-group mb-7">
                                                                            <label>Email address *</label>
                                                                            <input type="email" class="form-control form-control-md" name="coemail" placeholder="Email address *" value="<?= $addressinfo->email ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary btn-outline btn-icon-left"> 
                                                                    <i class="w-icon-long-arrow-right"></i>Update Address
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="<?= base_url('users/user_addresses')?>" class="btn btn-dark btn-rounded btn-icon-right">Go
                                        Back<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->

        <script type="text/javascript">
            function updateAddress(e) {
              e.preventDefault();
               $('#loader').css('display',"block"); 
               
              

              const formdata = new FormData(e.target);
              formdata.append("uaddressId",formdata.get('addressId')); 
              formdata.append("ucountry",formdata.get('coCountry')); 
              formdata.append("ufname",formdata.get('cofname')); 
              formdata.append("ulname",formdata.get('colname')); 
              formdata.append("ufulladdress",formdata.get('cofulladdress')); 
              formdata.append("ufulladdress2",formdata.get('cofulladdress2')); 
              formdata.append("ucity",formdata.get('cocity')); 
              formdata.append("ustate",formdata.get('costate')); 
              formdata.append("upincode",formdata.get('copincode')); 
              formdata.append("uphone",formdata.get('cophone')); 
              formdata.append("uemail",formdata.get('coemail')); 
              
              
              axios.post("<?= base_url('users/updateaddress')?>", formdata).then(function (response) {
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