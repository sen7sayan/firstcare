<div class="login-popup">
    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
        <ul class="nav nav-tabs text-uppercase" role="tablist">
            <li class="nav-item">
                <a href="#sign-in" class="nav-link active">Sign In</a>
            </li>
            <li class="nav-item">
                <a href="#sign-up" class="nav-link">Sign Up</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="sign-in">
                <form method="post" onsubmit="return login(event)">
                    <div class="form-group">
                        <label>email address *</label>
                        <input type="hidden" class="form-control" name="redirect" value="<?= $redirect ?>" >
                        <input type="text" class="form-control" name="email" id="username" >
                    </div>
                    <div class="form-group mb-0">
                        <label>Password *</label>
                        <input type="text" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-checkbox" id="remember" name="remember" >
                        <label for="remember">Remember me</label>
                        <a href="#">Lost your password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary login-btn">Sign In</button>
                </form>
                <a href="<?= base_url('user-checkout/guest-checkout')?>" class="btn btn-dark btn-outline btn-rounded float-right">Guest Checkout</a>
            </div>
            <div class="tab-pane" id="sign-up">
                <form method="post" onsubmit="return registration(event)">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="redirect" value="<?= $redirect ?>" >
                                <input type="text" name="fname" class="form-control" placeholder="Enter First Name">
                            </div>              
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="lname" class="form-control" placeholder="Enter Last Name *">
                            </div>              
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Your Email address *">
                    </div>
                    <div class="form-group">
                        <input type="number" name="phone" class="form-control" min="10" placeholder="Enter Phone Number *">
                    </div>
                    <div class="form-group mb-5">
                        <input type="password" name="password" class="form-control" placeholder="Password *">
                    </div>
                    <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                        <label for="agree" class="font-size-md">While creating account, I agree to the <a  href="#" class="text-primary font-size-md">privacy policy</a></label>
                    </div>
                    <button type="submit" class="btn btn-primary register-btn">Sign Up</button>
                </form>
            </div>
        </div>
        <p class="text-center">Sign in with social account</p>
        <div class="social-icons social-icon-border-color d-flex justify-content-center">
            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
            <a href="#" class="social-icon social-google fab fa-google"></a>
        </div>
    </div>
</div>