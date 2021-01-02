<?php
session_start();


class vendor
{
  public function login()
  {
    include("includes/connection.php");

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
      if ($_SESSION['is_seller']){
        header("location: seller/index.php");
      }
      else {
        header("location: customer/index.php");
      }
    }

  
    if (isset($_POST["signin"])) {
        $emailaddress =$_POST["emailaddress"];
        $password = md5($_POST["password"]);

        $query = "SELECT * FROM users WHERE email = '$emailaddress' && password = '$password' ";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_array($result);

        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['fname'];
        $_SESSION['acc_type'] = $user['accountType'];

        if ($_SESSION['acc_type'] == 'seller'){
          header("location: seller/index.php");
        }
        else {
          header("location: customer/index.php");
        }
        

        // if ($result) {
        //     if (mysqli_num_rows($result)==1) {
        //         while ($row = mysqli_fetch_array($result)) {
        //             $_SESSION['loggedin'] = true;
        //             $_SESSION['id'] = $row['id'];
        //             $_SESSION['name'] = $row['fname'] . " " . $row['lname'];
        //             $_SESSION['VAT_pin'] = $row['vat_pin'];

        //             header("location: index.php");
        //           }
        //     } else {
        //         echo "<script>
        //             setTimeout(function() {
        //                 $.bootstrapGrowl('Incorrect Email Or Password', {
        //                     type: 'danger',
        //                     align: 'right',
        //                     width: 400,
        //                     stackup_spacing: 30
        //                 });
        //             }, 3000);
        //                     </script>";
        //     }
        // }
    }


    if (isset($_POST['signup'])) {
      header('location:signup.php');
    }
  }
}


$O = new vendor;
$O->login();



?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Login | E-Commerce</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" />
  <link rel="shortcut icon" type="image/png" href="assets/images/gikieats_teal.png">


  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.js"></script>




  <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/metisMenu.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/slicknav.min.css">
  <!-- amchart css -->
  <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
  <!-- others css -->
  <link rel="stylesheet" href="assets/css/typography.css">
  <link rel="stylesheet" href="assets/css/default-css.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <!-- modernizr css -->
  <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>

  <div id="preloader">
    <div class="loader"></div>
  </div>
  <!-- preloader area end -->
  <!-- login area start -->
  <div class="login-area">
    <div class="container">
      <div class="login-box ptb--100">
        <form action="" method="POST" name="bform" onsubmit="return Validate()">
          <div class="login-form-head">
            <div>
              <img src="assets/images/ecommerce.jpg" width="400" height="150">
            </div>

          </div>
          <div class="login-form-body">
            <div id="Email_div">
              <div class="form-gp">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="emailaddress" id="Eamil">
                <i class="ti-email"></i>
                <div id="emailaddress_error"></div>

              </div>
            </div>



            <div id="Password_div">
              <div class="form-gp">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" id="Password">
                <i class="ti-lock"></i>

                <div id="password_error"></div>
              </div>
            </div>
            <div class="submit-btn-area">
              <button id="form_submit" name="signin" type="submit">SIGN IN<i class="ti-arrow-right"></i></button><br>
              <!-- <button id="form_submit" name="signup" type="submit"><a href="signup.php">SIGN UP</a><i class="ti-arrow-right"></i></button><br> -->
              <div>


              </div>

            </div>
            <div class="form-footer text-center mt-5">
              <p class="text">Don't have an account? <a href="signup.php" style="color:#9f685c">Sign up</a></p>
            </div>

          </div>
        </form>
      </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
<script type="text/javascript">
  var emailaddress = document.forms['bform']['emailaddress'];
  var password = document.forms['bform']['password'];


  var emailaddress_error = document.getElementById('emailaddress_error');
  var password_error = document.getElementById('password_error');

  emailaddress.addEventListener('blur', emailaddressVerify, true);
  password.addEventListener('blur', passwordVerify, true);


  function Validate() {



    if (emailaddress.value == "") {
      // emailaddress.style.border = "1px solid red";
      document.getElementById('Email_div').style.color = "red";
      emailaddress_error.textContent = "Email Is Required";
      emailaddress.focus();
      return false;
    }

    if (password.value == "") {
      // password.style.border = "1px solid red";
      document.getElementById('Password_div').style.color = "red";
      password_error.textContent = "Password Is Required";
      password.focus();
      return false;
    }
  }





  function emailaddressVerify() {
    if (emailaddress.value != "") {
      // emailaddress.style.border = "1px solid #5cd3b4";
      document.getElementById('Email_div').style.color = "#5cd3b4";
      emailaddress_error.innerHTML = "";
      return true;
    }
  }

  function PasswordVerify() {
    if (password.value != "") {
      // password.style.border = "1px solid #5cd3b4";
      document.getElementById('Password_div').style.color = "#5cd3b4";
      password_error.innerHTML = "";
      return true;
    }
  }
</script>