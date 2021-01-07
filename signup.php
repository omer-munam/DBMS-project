<?php
session_start();
class Signup
{
    public function addUser()
    {
        include("includes/connection.php");

        if (isset($_POST['signup'])) {
            $fname=$_POST['fname'];
            $password=$_POST['password'];
            $password1=$_POST['password1'];
            $contact=$_POST['contact'];
            $email=$_POST['email'];
            $address = $_POST['address'];
            $accountType = $_POST['optradio'];


            $query_email ="SELECT email FROM users WHERE email='$email'";
            $result_email = mysqli_query($conn, $query_email);

            if (mysqli_num_rows($result_email) > 0) {
                // echo "<script>alert('Error email already exist!')</script>";
                echo "<script>

                 setTimeout(function() {
        $.bootstrapGrowl('Error email already exist', {
            type: 'danger',
            align: 'right',
            width: 400,
            stackup_spacing: 30
        });
    }, 1000);



            </script>";
            } elseif ($password!=$password1) {

                        // echo "<script>alert('password does not match')</script>";
                echo "<script>

                 setTimeout(function() {
        $.bootstrapGrowl('password does not match', {
            type: 'danger',
            align: 'right',
            width: 400,
            stackup_spacing: 30
        });
    }, 1000);



            </script>";
            } else {
                $password=md5($password);

                $query = "INSERT INTO users (fname, password, contact, email, address, accountType) VALUES ('$fname', '$password', '$contact', '$email', '$address', '$accountType')";

                if ($conn->query($query)===true) {
                    header('location:index.php');
                    echo "<script>

                                setTimeout(function() {
                        $.bootstrapGrowl('Sign Up Successfull', {
                            type: 'success',
                            align: 'right',
                            width: 400,
                            stackup_spacing: 30
                        });
                    }, 5000);



            </script>";
                } else {
                    echo "error".$query."<br>".$conn->error;
                }
            }


            if (isset($_POST['signin'])) {
                header('location:index.php');
            }
        }
    }
}
    $O = new Signup;
    $O->addUser();



?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SignUp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/gikieats_teal.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.js"></script>

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
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="signup.php" method="POST" name="bform" onsubmit="return Validate()">
                    <div class="login-form-head">
                        <div>
                            <img src="assets/images/ecommerce.jpg" width="400" height="150">
                        </div>

                    </div>
                    <div class="login-form-body">

                        <div id="Name_div">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="fname" id="exampleInputEmail1">
                            <i class=""></i>
                            <div id="Name_error"></div>
                           </div>
                        </div>

                        <div id="emailaddress_div">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" id="exampleInputEmail1">
                            <i class="ti-email"></i>
                            <div id="emailaddress_error"></div>
                        </div>
                        </div>

                        <div id="address_div">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Address </label>
                            <input type="text" name="address" id="exampleInputEmail1">
                            <i class=""></i>
                            <div id="address_error"></div>
                        </div>
                        </div>

                        <div id="password_div">
                            <div class="form-gp">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" id="exampleInputPassword1">
                                <i class="ti-lock"></i>
                                <div id="password_error"></div>
                            </div>
                        </div>

                        <div id="password1_div">
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" name="password1" id="exampleInputPassword1">
                            <i class="ti-lock"></i>
                             <div id="password1_error"></div>
                        </div>
                        </div>

                         <div id="contact_div">
                         <div class="form-gp">
                            <label for="exampleInputEmail1">Contact</label>
                            <input type="text" name="contact" id="exampleInputEmail1">
                            <i class=""></i>
                            <div id="contact_error"></div>
                        </div>
                        </div>

                        <div class="radio">
                            <label><input type="radio" name="optradio" value="seller"> Seller</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio" value="customer" checked> Customer</label>
                        </div>

                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                   <!--  <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember Me</label> -->
                                </div>
                            </div>
                         <!--    <div class="col-6 text-right">
                                <a href="#">Forgot Password?</a>
                            </div> -->
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" name="signup" type="submit">SIGN UP<i class="ti-arrow-right"></i></button>
                        <div>
                           <!--  <a href="">Signup</a> -->

                            </div>

                        </div>

                    </div>
                </form>
            </div>
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

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>

<script type="text/javascript">
     var Name = document.forms['bform']['fname'];
     var contact = document.forms['bform']['contact'];
     var address = document.forms['bform']['address'];
     var emailaddress = document.forms['bform']['emailaddress'];
     var password = document.forms['bform']['password'];
     var password1 = document.forms['bform']['password1'];


     // selecting all error display elements
     var Name_error = document.getElementById('Name_error');
      var contact_error = document.getElementById('contact_error');
      var emailaddress_error = document.getElementById('emailaddress_error');
      var password_error = document.getElementById('password_error');
      var password1_error = document.getElementById('password1_error');
      var address_error = document.getElementById('address_error');





       // SETTING ALL EVENT LISTENERS

    Name.addEventListener('blur', NameVerify, true);
    contact.addEventListener('blur', contactVerify, true);
    address.addEventListener('blur', addressVerify, true);
    emailaddress.addEventListener('blur', emailaddressVerify, true);
    password.addEventListener('blur', passwordVerify, true);
    password1.addEventListener('blur', password1Verify, true);





    function Validate() {

         if (Name.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('Name_div').style.color = "red";
    Name_error.textContent = "First Name Is Required";
    Name.focus();
    return false;
  }


  if (contact.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('contact_div').style.color = "red";
    contact_error.textContent = "Number Is Required";
    contact.focus();
    return false;
  }

  if (address.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('address_div').style.color = "red";
    address_error.textContent = "Address Is Required";
    address.focus();
    return false;
  }

   if (emailaddress.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('emailaddress_div').style.color = "red";
    emailaddress_error.textContent = "Email Is Required";
    emailaddress.focus();
    return false;
  }

   if (password.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('password_div').style.color = "red";
    password_error.textContent = "Password Is Required";
    password.focus();
    return false;
  }

   if (password1.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('password1_div').style.color = "red";
    password1_error.textContent = "ConfirmPassword Is Required";
    password1.focus();
    return false;
  }



    }

    function NameVerify() {

 if (Name.value != "") {
   // shop_name.style.border = "1px solid #5cd3b4";
   document.getElementById('Name_div').style.color = "#5cd3b4";
   Name_error.innerHTML = "";
   return true;
  }}


  function contactVerify() {

    if (contact.value != "") {
   // shop_name.style.border = "1px solid #5cd3b4";
   document.getElementById('contact_div').style.color = "#5cd3b4";
   contact_error.innerHTML = "";
   return true;
  }}

  function addressVerify() {

    if (address.value != "") {
   // shop_name.style.border = "1px solid #5cd3b4";
   document.getElementById('address_div').style.color = "#5cd3b4";
   address_error.innerHTML = "";
   return true;
  }}

  function emailaddressVerify(){
  if (emailaddress.value != "") {
   // shop_name.style.border = "1px solid #5cd3b4";
   document.getElementById('emailaddress_div').style.color = "#5cd3b4";
   emailaddress_error.innerHTML = "";
   return true;
  }}

   function passwordVerify(){
  if (password.value != "") {
   // shop_name.style.border = "1px solid #5cd3b4";
   document.getElementById('password_div').style.color = "#5cd3b4";
   password_error.innerHTML = "";
   return true;
  }}

   function password1Verify(){
  if (password1.value != "") {
   // shop_name.style.border = "1px solid #5cd3b4";
   document.getElementById('password1_div').style.color = "#5cd3b4";
   password1_error.innerHTML = "";
   return true;
  }}

</script>
