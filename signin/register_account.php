<?php
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TourLISTA V1.50 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../cms/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../cms/dist/css/adminlte.min.css">

  <link rel="icon" href="../assets/images/tl.png">

  <script language = "javascript">

  // Simple password visibility toggle function
  function togglePasswordVisibility(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const eyeIcon = document.getElementById(fieldId + '-eye');
    
    if (passwordField && eyeIcon) {
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.className = 'fas fa-eye-slash';
      } else {
        passwordField.type = 'password';
        eyeIcon.className = 'fas fa-eye';
      }
    }
  }

  // Alternative jQuery implementation for better compatibility
  // This will be moved to the bottom after jQuery is loaded

  function showLocation (x){
    if(x==5){
      document.getElementById("province").style.display = "none";
      document.getElementById("citymun").style.display = "none";
    }
    if(x==4){
      document.getElementById("region").style.display = "block";
      document.getElementById("province").style.display = "block";
      document.getElementById("citymun").style.display = "none";
      $("#provinceData").attr("required", "true");
    }
    if(x<4){
        document.getElementById("region").style.display = "block";
        document.getElementById("province").style.display = "block";
        document.getElementById("citymun").style.display = "block";
        $("#citymunData").attr("required", "true");
        $("#provinceData").attr("required", "true");
    }
  }

  function showProvince(region_c){
     $("#citymunData").html("<option value=''>Select City / Municipality</option>");
      $.ajax({
        type: "GET",
        url: "crud/loadProvince.php",
        cache: false,
        data: {region_c},
        success: function(data){
          $("#provinceData").html(data);
        }
      });
    }

    function showCityMun(region_c, province_c){
        $.ajax({
          type: "GET",
          url: "crud/loadCityMun.php",
          cache: false,
          data: {region_c, province_c},
          success: function(data){
            $("#citymunData").html(data);
          }
        });
      }

  </script>


  <style>
      #body {
    background: url('../assets/images/bg.png') no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
    
    /* Password toggle button styling */
    .password-toggle-btn {
      position: absolute;
      right: 35px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6c757d;
      transition: all 0.3s ease;
      z-index: 15;
      font-size: 16px;
      padding: 8px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 4px;
      border: 1px solid #ddd;
      min-width: 32px;
      min-height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .password-toggle-btn:hover {
      color: #007bff !important;
      background: rgba(0, 123, 255, 0.1);
      border-color: #007bff;
      box-shadow: 0 2px 8px rgba(0,123,255,0.2);
    }
    
    .password-toggle-btn:active {
      transform: translateY(-50%) scale(0.95);
    }
    
    .password-toggle-btn i {
      font-size: 14px;
    }
    
    .form-group.has-feedback {
      position: relative;
    }
    
    .form-group.has-feedback .form-control {
      padding-right: 80px;
    }
  </style>
</head>
<body id="body" class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
  <img src="../assets/images/tourlista.png" alt="alternative" width="90%">
  </div>

  <?php

    if($_GET["stat"]=='1'){

    echo '

    <div class="alert alert-success" role="alert">
    <b>You have successfully registered an account.</b><br />We will send you an email once your account has been validated and approved by the LGU Web Administrator.
    </div>
    ';

    }
    if($_GET["stat"]=='0'){

    echo '
    <div class="alert alert-danger" role="alert">
    <b>Sorry!</b> Your account registration was not successful, please try again.
    </div>
    ';
    }

  ?>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register an Account</p>

      <form action="crud/registerAccount.php" method="post">

        <div class="form-group has-feedback">
          <select name="access_level"  class="form-control" onchange="showLocation(this.value)" required>
              <option value="">Select Account Type</option>
              <option value="1">Accommodation Establishment User</option>
              <option value="2">Tourist Attraction User</option>
              <option value="3">City/Municipality User</option>
              <option value="4">Provincial User</option>
              <option value="5">Regional User</option>
          </select>
        </div>

        <div id="region" class="form-group has-feedback">
          <select name="region_c" id="regionData" class="form-control" onchange="showProvince(this.value)" required>
              <option value="">Select Region</option>
              <?php
                include '../cms/connection/connection.php';
                $sql = "SELECT region_c, region_m FROM region order by region_sort asc";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<option class="form-control" value="'.$row["region_c"].'">'.$row["region_m"].'</option>';
                    }
                }
              ?>
          </select>
        </div>

        <div id="province" class="form-group has-feedback">
          <select name="province_c" id="provinceData"   class="form-control" onchange="showCityMun(regionData.value,this.value)">
              <option value="">Select Province</option>
          </select>
        </div>

        <div id="citymun" class="form-group has-feedback">
          <select name="citymun_c" id="citymunData"  class="form-control">
              <option value="">Select City / Municipality</option>
          </select>
        </div>

        <div class="form-group has-feedback">
        <input name="username" type="text" class="form-control" pattern="[A-Za-z0-9_]{5,40}" placeholder="Username" title="Letters, Numbers, and underscores only with 5 to 40 characters" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input name="email" type="email" class="form-control" placeholder="Email" autocomplete="off" required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
      <!-- //MOBILE NUMBER 
        <div class="form-group has-feedback">
          <input name="mobile" id="mobile" type="text" class="form-control" placeholder="Mobile" autocomplete="off" pattern="[0-9]{10,13}" title="Numbers only atleast 10 digits" required>
          <span class="glyphicon glyphicon-phone form-control-feedback"></span>
        </div> -->

        <div class="form-group has-feedback">
          <input name="password" id="password" type="password" class="form-control" placeholder="Password" autocomplete="off" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('password')">
            <i class="fas fa-eye" id="password-eye"></i>
          </button>
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="confirmPassword" class="form-control" placeholder="Retype password" autocomplete="off" required>
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('confirmPassword')">
            <i class="fas fa-eye" id="confirmPassword-eye"></i>
          </button>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="docs/Terms and Conditions of Use.pdf" download>terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
      </div>

      <a href="../signin" class="text-center">I already have an account</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../cms/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../cms/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../cms/dist/js/adminlte.min.js"></script>

<!-- Password Toggle Implementation -->
<script>
// Test function to verify elements are working
$(document).ready(function() {
  console.log('Password toggle buttons found:', $('.password-toggle-btn').length);
  console.log('Font Awesome loaded:', typeof $ !== 'undefined' && $('.fas').length > 0);
});
</script>
</body>
</html>
