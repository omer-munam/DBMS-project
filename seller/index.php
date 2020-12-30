<?php
 session_start();
include("../includes/connection.php");

   if (!isset($_SESSION['loggedin'])) {
       header('location: ../index.php');
       die();
   }
    $id = $_SESSION['id'];
    if (isset($_POST['form1_submit'])) {
        mysqli_set_charset($conn, "utf8");
      
        $prod_name = $_POST['prod_name'];
        $prod_brand = $_POST['prod_brand'];
        $prod_cat = $_POST['prod_cat'];
        $prod_price = $_POST['prod_price'];
        $prod_color = $_POST['prod_color'];

            
        $query = "INSERT INTO ";

     
        if ($conn->query($query)===true) {
            echo "<script>setTimeout(function() {
          $.bootstrapGrowl('Product Added Successfuly!', {
              type: 'success',
              align: 'right',
              width: 400,
              stackup_spacing: 30
          });
      }, 3000);</script>";
        } else {
            echo "error".$query."<br>".$conn->error;
        }
    }

    include('../includes/header.php');
?>


    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Add Product</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="index.php">Home</a></li>
                        <li><span>Add Product</span></li>
                    </ul>
                   
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                <div class="user-profile pull-right">
                    <img class="avatar user-thumb" src="../assets/images/author/avatar.png" alt="avatar">
                    <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['name'] ?><i class="fa fa-angle-down"></i></h4>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="container">
      <form action="index.php" method="POST" class="form-horizontal"  enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm" >
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="single-report">
              <div class="s-report-inner pr--20 pt--30 mb-3">
                <div class="s-report-title d-flex justify-content-center">
                  <h4 class="header-title mb-0" style="font-size: 28px;">Add Product</h4>
                </div>
                      
            <!-- <div class="d-flex justify-content-center pb-2"> -->
                <!-- <h2><?php //echo $row_count3;?></h2> -->
                <div class="form-group">
                    <div class="form-group">
                      <div id="product_name_div">
                        <label class="col-xs-6">Product Name<span class="validatestar">*</span></label>
                        <div class="col-xs-6">
                          <input type="text" required class="form-control" name="prod_name" >
                          <div id="product_name_error"></div>
                        </div>
                      </div>          
                    </div>

                    <div class="form-group">
                      <div id="product_name_div">
                        <label class="col-xs-6">Product Brand<span class="validatestar">*</span></label>
                        <div class="col-xs-6">
                          <input type="text" required class="form-control" name="prod_brand" >
                          <div id="product_name_error"></div>
                        </div>
                      </div>          
                    </div>

                    <div class="form-group">
                      <div id="product_name_div">
                        <label class="col-xs-6">Product Category<span class="validatestar">*</span></label>
                        <div class="col-xs-6">
                          <input type="text" required class="form-control" name="prod_cat" >
                          <div id="product_name_error"></div>
                        </div>
                      </div>          
                    </div>

                    <div class="form-group">
                      <div id="product_name_div">
                        <label class="col-xs-6">Product Price<span class="validatestar">*</span></label>
                        <div class="col-xs-6">
                          <input type="Number" step="0.01" required class="form-control" name="prod_price" >
                          <div id="product_name_error"></div>
                        </div>
                      </div>          
                    </div>

                    <div class="form-group">
                        <div id="product_name_div">
                      <label class="col-xs-6">Product Color<span class="validatestar">*</span></label>
                      <div class="col-xs-6">
                            <input type="text" required class="form-control" name="prod_color" >
                          <div id="product_name_error"></div>
                        </div>
                      </div>          
                    </div>  
                    
                    <div style="text-align: center;">
                      <button type="submit" class="btn btn-success btn-md" name="form1_submit">Add Product</button>
                    </div>
                  </div>                  
                </div>
              </div>
              <canvas  height="100"></canvas>
            </div>
          </div>
        </div>
      </form>
    </div>  
  </div>
  </div>
</div>

<?php include('../includes/footer.php');?>