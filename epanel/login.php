<?php
session_start();


class vendor
{
    public function login()
    {
        include("../includes/connection.php");

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
            header('location:index.php');
        }

  
        if (isset($_POST["signin"])) {
            $emailaddress =$_POST["emailaddress"];
            $password = md5($_POST["password"]);

            $query = "SELECT * FROM users WHERE email = '$emailaddress' && password = '$password' ";
            $result=mysqli_query($conn, $query);

            if ($result) {
                if (mysqli_num_rows($result)==1) {
                    while ($row = mysqli_fetch_array($result)) {
                      if( $row['is_admin'] ) {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['name'] = $row['fname'] . " " . $row['lname'];
                        $_SESSION['VAT_pin'] = $row['vat_pin'];
                        $_SESSION['is_admin'] = true;

                        header("location: index.php");
                      } else {
                        echo "<script>

                 setTimeout(function() {
        $.bootstrapGrowl('Login with admin credentials', {
            type: 'danger',
            align: 'right',
            width: 400,
            stackup_spacing: 30
        });
    }, 3000);
            </script>";
            header("location: ../403.html");
                      }
                    }
                } else {
                    echo "<script>

                 setTimeout(function() {
        $.bootstrapGrowl('Incorrect Email Or Password', {
            type: 'danger',
            align: 'right',
            width: 400,
            stackup_spacing: 30
        });
    }, 3000);
            </script>";
                }
            }
        }
        if (isset($_POST['ResetPassword'])) {
            $Email = $_POST["Email"];
            $query="SELECT * FROM users WHERE emailaddress ='$Email'";
            $run =mysqli_query($conn, $query);
            $check_c=mysqli_num_rows($run);
            $row_c=mysqli_fetch_array($run);
            $Name=$row_c['Name'];
            if ($check_c==0) {
                echo "<script>  setTimeout(function() {
        $.bootstrapGrowl('Email does not exist', {
            type: 'danger',
            align: 'right',
            width: 400,
            stackup_spacing: 30
        });
    }, 1000);</script>";
            } else {
                $to = $Email;
                $subject = 'Recently '.$Name;
                $message = mt_rand(1000, 9999);
                $emailmsg ='<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    @media screen and (max-width: 720px) {
      body .c-v84rpm {
        width: 100% !important;
        max-width: 720px !important;
      }
      body .c-v84rpm .c-7bgiy1 .c-1c86scm {
        display: none !important;
      }
      body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-pekv9n .c-1qv5bbj,
      body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-1c9o9ex .c-1qv5bbj,
      body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-90qmnj .c-1qv5bbj {
        border-width: 1px 0 0 !important;
      }
      body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-183lp8j .c-1qv5bbj {
        border-width: 1px 0 !important;
      }
      body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-pekv9n .c-1qv5bbj {
        padding-left: 12px !important;
        padding-right: 12px !important;
      }
      body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-1c9o9ex .c-1qv5bbj,
      body .c-v84rpm .c-7bgiy1 .c-f1bud4 .c-90qmnj .c-1qv5bbj {
        padding-left: 8px !important;
        padding-right: 8px !important;
      }
      body .c-v84rpm .c-ry4gth .c-1dhsbqv {
        display: none !important;
      }
    }


    @media screen and (max-width: 720px) {
      body .c-v84rpm .c-ry4gth .c-1vld4cz {
        padding-bottom: 10px !important;
      }
    }
  </style>
  <title>Recover your Crisp password</title>
</head>

<body style="margin: 0; padding: 0; font-family: &quot; HelveticaNeueLight&quot;,&quot;HelveticaNeue-Light&quot;,&quot;HelveticaNeueLight&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 300; font-stretch: normal; font-size: 14px; letter-spacing: .35px; background: #EFF3F6; color: #333333;">
  <table border="1" cellpadding="0" cellspacing="0" align="center" class="c-v84rpm" style="border: 0 none; border-collapse: separate; width: 720px;" width="720">
    <tbody>
      <tr class="c-1syf3pb" style="border: 0 none; border-collapse: separate; height: 114px;">
        <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
          <table align="center" border="1" cellpadding="0" cellspacing="0" class="c-f1bud4" style="border: 0 none; border-collapse: separate;">
            <tbody>
              <tr align="center" class="c-1p7a68j" style="border: 0 none; border-collapse: separate; padding: 16px 0 15px;">
                <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle"><img alt="" src="http://http://dalilalqahwa.com\Coffee\Coffeeadminpanel\../assets\images\icon\logo.png" class="c-1shuxio" style="border: 0 none; line-height: 100%; outline: none; text-decoration: none; height: 100px; width: 300px;" width="120" height="33"></td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr class="c-7bgiy1" style="border: 0 none; border-collapse: separate; -webkit-box-shadow: 0 3px 5px rgba(0,0,0,0.04); -moz-box-shadow: 0 3px 5px rgba(0,0,0,0.04); box-shadow: 0 3px 5px rgba(0,0,0,0.04);">
        <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
          <table align="center" border="1" cellpadding="0" cellspacing="0" class="c-f1bud4" style="border: 0 none; border-collapse: separate; width: 100%;" width="100%">
            <tbody>
              <tr class="c-pekv9n" style="border: 0 none; border-collapse: separate; text-align: center;" align="center">
                <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                  <table border="1" cellpadding="0" cellspacing="0" width="100%" class="c-1qv5bbj" style="border: 0 none; border-collapse: separate; border-color: #E3E3E3; border-style: solid; width: 100%; border-width: 1px 1px 0; background: #FBFCFC; padding: 40px 54px 42px;">
                    <tbody>
                      <tr style="border: 0 none; border-collapse: separate;">
                        <td class="c-1m9emfx c-zjwfhk" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueLight&quot;,&quot;HelveticaNeue-Light&quot;,&quot;HelveticaNeueLight&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 300; color: #1D2531; font-size: 25.45455px;"
                          valign="middle">Hi '.$Name.' ,</td>
                      </tr>
                      <tr style="border: 0 none; border-collapse: separate;">
                        <td class="c-46vhq4 c-4w6eli" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeueRoman&quot;,&quot;HelveticaNeue-Roman&quot;,&quot;HelveticaNeueRoman&quot;,&quot;HelveticaNeue-Regular&quot;,&quot;HelveticaNeueRegular&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 400; color: #7F8FA4; font-size: 15.45455px; padding-top: 20px;"
                          valign="middle">This is to inform you that your password has been changed.</td>
                      </tr>
                      <tr style="border: 0 none; border-collapse: separate;">
                        <td class="c-eitm3s c-16v5f34" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueMedium&quot;,&quot;HelveticaNeue-Medium&quot;,&quot;HelveticaNeueMedium&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,sans-serif;font-weight: 500; font-size: 13.63636px; padding-top: 12px;"
                          valign="middle">Your new password is '.$message.' .</td>
                      </tr>
                      <tr style="border: 0 none; border-collapse: separate;">
                        <td class="c-ryskht c-zjwfhk" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueLight&quot;,&quot;HelveticaNeue-Light&quot;,&quot;HelveticaNeueLight&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 300; font-size: 12.72727px; font-style: italic; padding-top: 20px;"
                          valign="middle">Kindly login change your password of your desired list.</td>
                      </tr>
                      <tr style="border: 0 none; border-collapse: separate;">
                        <td class="c-ryskht c-zjwfhk" style="border: 0 none; border-collapse: separate; vertical-align: middle; font-family: &quot; HelveticaNeueLight&quot;,&quot;HelveticaNeue-Light&quot;,&quot;HelveticaNeueLight&quot;,&quot;HelveticaNeue&quot;,&quot;HelveticaNeue&quot;,Helvetica,Arial,&quot;LucidaGrande&quot;,sans-serif;font-weight: 300; font-size: 12.72727px; padding-top: 100px;"
                          valign="middle">SUPPORT <a href="dalilalqahwa.com">Darzi house</a></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
                </tbody>
                </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
      </tr>
      <tr class="c-ry4gth" style="border: 0 none; border-collapse: separate;">
        <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
          <table border="1" cellpadding="0" cellspacing="0" width="100%" class="c-1vld4cz" style="border: 0 none; border-collapse: separate; padding-top: 26px; padding-bottom: 26px;">
            <tbody>
              <tr style="border: 0 none; border-collapse: separate;">
                <td style="border: 0 none; border-collapse: separate; vertical-align: middle;" valign="middle">
                </td>
              </tr>
            </tbody>
          </table>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>

        </td>
      </tr>
    </tbody>
  </table>
</body>';



                $headers = 'From: no-reply@icesketch.com' . "\r\n" .
       'Reply-To: <no-reply@icesketch.com>' . "\r\n" .
       'X-Mailer: PHP/' . phpversion();
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                if (mail($to, $subject, $emailmsg, $headers)) {
                    $query = "UPDATE users SET Password='$message',Approval='1' WHERE Email='$Email'";
                    if ($conn->query($query)===true) {
                        echo "Fayyaz";
                        echo "<script>  setTimeout(function() {
        $.bootstrapGrowl('The Password Has Been Sent Successfully', {
            type: 'info',
            align: 'right',
            width: 400,
            stackup_spacing: 30
        });
    }, 1000);</script>";
                    } else {
                        echo "error".$query."<br>".$conn->error;
                    }
                }
            }
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
    <title>Login - VAT ePanel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.png">
    

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.js"></script>
    


    
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
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
                            <img src="../assets/images/icon/vat.png">
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
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <!-- <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                </div> -->
                            </div>
                            <div class="col-6 text-right">
                                <a data-toggle="modal" href="#myModal" style="color: #e67c36">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" name="signin" type="submit">SIGN IN<i class="ti-arrow-right"></i></button><br>
                          <!-- <button id="form_submit" name="signup" type="submit"><a href="signup.php">SIGN UP</a><i class="ti-arrow-right"></i></button><br> -->
                            <div>
                          
                                
                            </div>
                          
                        </div>
                       
                    </div>
                </form>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Forgot Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="" method="POST">
                          <div class="modal-body">
                        <div class="form-group" align="center">
                            <div class="col-md-6">
                            <p align="left">Email Address</p>
                            <input type="text" name="Email" placeholder="Enter your Email Address" value="" class="form-control" id="Email">
                        </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="Submit" name="ResetPassword" id="ResetPassword" class="btn btn-primary">Reset Password</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>

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
    <script src="../assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="../assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
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