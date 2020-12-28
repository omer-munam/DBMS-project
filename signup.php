<?php
session_start();
class Signup
{
    public function addUser()
    {
        include("includes/connection.php");

        if (isset($_POST['signup'])) {
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $password=$_POST['password'];
            $password1=$_POST['password1'];
            $contact=$_POST['contact'];
            $email=$_POST['email'];
            $address = $_POST['address'];
            $dob = $_POST['dob'];
            $occupation = $_POST['occupation'];
            $earnings = $_POST['earnings'];
            $vatpin = $_POST['vatpin'];



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

                $query = "INSERT INTO users (fname , lname, email, address, dob, occupation, earnings, password, contact, vat_pin) VALUES ('$fname', '$lname', '$email','$address', STR_TO_DATE('$dob', '%Y-%m-%d'), '$occupation', $earnings,'$password', '$contact', '$vatpin')";

                if ($conn->query($query)===true) {
                    header('location:login.php');
                    echo "<script>

                 setTimeout(function() {
        $.bootstrapGrowl('Sign Up Successfully But your account is in pending needs admin approval', {
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
                header('location:login.php');
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
    <title>SignUp - VAT Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.png">
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
                            <img src="assets/images/icon/vat.png">
                        </div>

                    </div>
                    <div class="login-form-body">

                        <div id="Name_div">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" name="fname" id="exampleInputEmail1">
                            <i class=""></i>
                            <div id="Name_error"></div>
                           </div>
                        </div>


                          <div id="lName_div">
                         <div class="form-gp">
                           <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" name="lname" id="exampleInputEmail1">
                            <i class=""></i>
                            <div id="lname_error"></div>
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

                        <div id="dob_div">
                          <div class="form-gp">
                              <label for="exampleInputEmail1">DOB</label>
                              <input type="date" name="dob" id="exampleInputEmail1">
                              <i class=""></i>
                              <div id="dob_error"></div>
                          </div>
                        </div>

                        <div id="occupation_div">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Occupation </label>
                            <input type="text" name="occupation" id="exampleInputEmail1">
                            <i class=""></i>
                            <div id="occupation_error"></div>
                        </div>
                        </div>

                        <div id="earnings_div">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Yearly Earnings </label>
                            <input type="Number" name="earnings" id="exampleInputEmail1">
                            <i class=""></i>
                            <div id="earnings_error"></div>
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


                        <div id="pin_div">
                        <div class="form-gp">
                            <label for="exampleInputPassword1">VAT PIN (XXXX)</label>
                            <input type="text" name="vatpin" maxlength="4" pattern="[0-9]{4}$" id="exampleInputPassword1">
                            <i class="ti-lock"></i>
                             <div id="pin_error"></div>
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
                            <button id="form_submit" name="signup" type="submit">SIGN UP<i class="ti-arrow-right"></i></button><br>
                            <button id="form_submit" name="signin" type="submit"><a href="login.php">SIGN IN</a><i class="ti-arrow-right"></i></button><br>
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
     var lName = document.forms['bform']['lname'];
     var contact = document.forms['bform']['contact'];
     var earnings = document.forms['bform']['earnings'];
     var occupation = document.forms['bform']['occupation'];
     var address = document.forms['bform']['address'];
     var dob = document.forms['bform']['dob'];
     var emailaddress = document.forms['bform']['emailaddress'];
     var password = document.forms['bform']['password'];
     var password1 = document.forms['bform']['password1'];
     var vatpin = document.forms['bform']['vatpin'];



     // selecting all error display elements
     var Name_error = document.getElementById('Name_error');
     var lname_error = document.getElementById('lname_error');
      var contact_error = document.getElementById('contact_error');
      var emailaddress_error = document.getElementById('emailaddress_error');
      var password_error = document.getElementById('password_error');
      var password1_error = document.getElementById('password1_error');
      var earnings_error = document.getElementById('earnings_error');
      var occupation_error = document.getElementById('occupation_error');
      var dob_error = document.getElementById('dob_error');
      var address_error = document.getElementById('address_error');
      var vatpin_error = document.getElementById('vatpin_error');





       // SETTING ALL EVENT LISTENERS

    Name.addEventListener('blur', NameVerify, true);
    lName.addEventListener('blur', lNameVerify, true);
    contact.addEventListener('blur', contactVerify, true);
    earnings.addEventListener('blur', earningsVerify, true);
    occupation.addEventListener('blur', occupationVerify, true);
    address.addEventListener('blur', addressVerify, true);
    dob.addEventListener('blur', dobVerify, true);
    emailaddress.addEventListener('blur', emailaddressVerify, true);
    password.addEventListener('blur', passwordVerify, true);
    password1.addEventListener('blur', password1Verify, true);
    vatpin.addEventListener('blur', vatpinVerify, true);





    function Validate() {

         if (Name.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('Name_div').style.color = "red";
    Name_error.textContent = "First Name Is Required";
    Name.focus();
    return false;
  }

  if (lName.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('lName_div').style.color = "red";
    lname_error.textContent = "Last Name Is Required";
    lName.focus();
    return false;
  }

  if (vatpin.value == "") {
    document.getElementById('pin_div').style.color = "red";
    vatpin_error.textContent = "VAT PIN is Required";
    vatpin.focus();
    return false;
  }

  if (contact.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('contact_div').style.color = "red";
    contact_error.textContent = "Number Is Required";
    contact.focus();
    return false;
  }

if (earnings.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('earnings_div').style.color = "red";
    earnings_error.textContent = "Earnings Is Required";
    earnings.focus();
    return false;
  }

  if (occupation.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('occupation_div').style.color = "red";
    occupation_error.textContent = "Occupation Is Required";
    occupation.focus();
    return false;
  }

  if (address.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('address_div').style.color = "red";
    address_error.textContent = "Address Is Required";
    address.focus();
    return false;
  }

  if (dob.value == "") {
    // _Name.style.border = "1px solid red";
    document.getElementById('occupation_div').style.color = "red";
    dob_error.textContent = "DOB Is Required";
    dob.focus();
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

  function vatpinVerify(){
    document.getElementById('pin_div').style.color = "#5cd3b4";
   vatpin_error.innerHTML = "";
   return true;
  }

  function lNameVerify() {

 if (lName.value != "") {
   // shop_name.style.border = "1px solid #5cd3b4";
   document.getElementById('lName_div').style.color = "#5cd3b4";
   lName_error.innerHTML = "";
   return true;
  }}

  function contactVerify() {

    if (contact.value != "") {
   // shop_name.style.border = "1px solid #5cd3b4";
   document.getElementById('contact_div').style.color = "#5cd3b4";
   contact.innerHTML = "";
   return true;
  }}

  function addressVerify() {

    if (address.value != "") {
   // shop_name.style.border = "1px solid #5cd3b4";
   document.getElementById('address_div').style.color = "#5cd3b4";
   address_error.innerHTML = "";
   return true;
  }}

  function dobVerify() {

    if (dob.value != "") {
   // shop_name.style.border = "1px solid #5cd3b4";
   document.getElementById('dob_div').style.color = "#5cd3b4";
   dob_error.innerHTML = "";
   return true;
  }}

  function earningsVerify() {

    if (contact.value != "") {
   // shop_name.style.border = "1px solid #5cd3b4";
   document.getElementById('earnings_div').style.color = "#5cd3b4";
   earnings_error.innerHTML = "";
   return true;
  }}

  function occupationVerify() {

    if (occupation.value != "") {
   // shop_name.style.border = "1px solid #5cd3b4";
   document.getElementById('occupation_div').style.color = "#5cd3b4";
   occupation_error.innerHTML = "";
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
