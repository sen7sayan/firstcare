<div class="add-address-popup">
    <form class="form checkout-form" method="post" onsubmit="return addAddress(event)">
        <div class="row mb-9">
            <div class="col-lg-12 pr-lg-12 mb-4">

                <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                    Billing Details
                </h3>
                <div class="row gutter-sm">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>First name *</label>
                            <input type="text" class="form-control form-control-md" name="cofname" placeholder="First name *" value="">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Last name *</label>
                            <input type="text" class="form-control form-control-md" name="colname" placeholder="Last name *" value="">
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label>Street address *</label>
                    <input type="text" placeholder="House number and street name" class="form-control form-control-md mb-2" name="cofulladdress"  value="">
                    <input type="text" placeholder="Apartment, suite, unit, etc. (optional)" class="form-control form-control-md" name="cofulladdress2"  value="">
                </div>
                <div class="row gutter-sm">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Town / City *</label>
                            <input type="text" class="form-control form-control-md" name="cocity" placeholder="Town / City *"  value="">
                        </div>
                        <div class="form-group">
                            <label>Pincode *</label>
                            <input type="text" class="form-control form-control-md" name="copincode" placeholder="Pincode *" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="select-box">
                                <?php 
                                        $states = state_list(); // From custom helper
                                 ?>
                                
                                <label>Select State</label>
                                <select class="form-control form-control-md" name="costate">
                                    <?php foreach ($states as $statename): ?>
                                        <option  value="<?= $statename; ?>"><?= $statename; ?></option>
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
                            <input type="text" class="form-control form-control-md" name="cophone" placeholder="Phone *" value="">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group mb-7">
                            <label>Email address *</label>
                            <input type="email" class="form-control form-control-md" name="coemail" placeholder="Email address *" value="">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-outline btn-icon-left"> 
                    <i class="w-icon-long-arrow-right"></i>Add New Address
                </button>
            </div>
        </div>
    </form>
</div>