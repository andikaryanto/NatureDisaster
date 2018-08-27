<div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <?php if($this->session->flashdata('success_msg')): ?>
                <p class="text-success"><?php echo $this->session->flashdata('success_msg'); ?></p>
            <?php endif; ?>
            <div class="logo text-uppercase"><span></span><strong class="text-primary">Sign Up</strong></div>
            <p>Create your account to login into the application. For more information cantact your administrator </p>
            <form method = "post" action = "<?php echo base_url('register/addsave');?>" class="text-left form-validate">
              <div class="form-group-material">
                <input id="register-username" type="text" name="registerUsername" required data-msg="Please enter your username" class="input-material">
                <label for="register-username" class="label-material">Username</label>
              </div>
              <div class="form-group-material">
                <input id="register-password" type="password" name="registerPassword" required data-msg="Please enter your password" class="input-material">
                <label for="register-password" class="label-material">Password </label>
              </div>
              <div class="form-group terms-conditions text-center">
                <input id="register-agree" name="registerAgree" type="checkbox" required value="1" data-msg="Your agreement is required" class="form-control-custom">
                <label for="register-agree">I agree with the terms and policy</label>
              </div>
              <div class="form-group text-center">
                <input id="register" type="submit" value="Register" class="btn btn-primary">
              </div>
            </form><small>Already have an account? </small><a href="<?php echo base_url('login');?>" class="signup">Login</a>
          </div>
          <div class="copyrights text-center">
            <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
          </div>
        </div>
      </div>
    </div>