<?php
 session_start();
include("includes/connection.php");

   if (!isset($_SESSION['loggedin'])) {
       header('location:login.php');
       die();
   }
    $id = $_SESSION['id'];
    if (isset($_POST['form1_submit'])) {
        mysqli_set_charset($conn, "utf8");
      
        $inv_num = $_POST['invoice_num'];
        $prod_name = $_POST['prod_name'];
        $prod_price = $_POST['prod_price'];
        $prod_qty = $_POST['prod_qty'];
        $invoice_type = $_POST['invoice_type'];
        $invoice_date = $_POST['invoice_date'];
            
        $query = "INSERT INTO invoices(user_id,inv_number, prod_name, prod_price,prod_qty,inv_type, inv_date) VALUES('$id', '$inv_num', '$prod_name','$prod_price','$prod_qty','$invoice_type',STR_TO_DATE('$invoice_date', '%Y-%m-%d'))";

     
        if ($conn->query($query)===true) {
            echo "<script>setTimeout(function() {
          $.bootstrapGrowl('Invoice Added Successfuly!', {
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

    include('includes/header.php');
?>


    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Form 1</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="index.php">Home</a></li>
                        <li><span>Form 1</span></li>
                    </ul>
                   
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                <div class="user-profile pull-right">
                    <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
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
                  <h4 class="header-title mb-0" style="font-size: 28px;">Form 1</h4>
                </div>
                      
            <!-- <div class="d-flex justify-content-center pb-2"> -->
                <!-- <h2><?php //echo $row_count3;?></h2> -->
                <div class="form-group">
                  <div id="product_name_div">
                    <div class="form-group">
                      <div id="product_name_div">
                          <label class="col-xs-6">Invoice Number<span class="validatestar">*</span></label>
                          <div class="col-xs-6">
                            <input type="text" required class="form-control" name="invoice_num" >
                          <div id="product_name_error"></div>
                        </div>
                      </div>          
                    </div>
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
                        <label class="col-xs-6">Product Price<span class="validatestar">*</span></label>
                        <div class="col-xs-6">
                          <input type="Number" step="0.01" required class="form-control" name="prod_price" >
                          <div id="product_name_error"></div>
                        </div>
                      </div>          
                    </div>

                    <div class="form-group">
                        <div id="product_name_div">
                      <label class="col-xs-6">Product Quantity<span class="validatestar">*</span></label>
                      <div class="col-xs-6">
                            <input type="Number" required class="form-control" name="prod_qty" >
                          <div id="product_name_error"></div>
                        </div>
                      </div>          
                    </div>  
                    
                    <div class="form-group">
                      <div id="product_name_div">
                          <label class="col-xs-6">Invoice Type<span class="validatestar">*</span></label>
                          <div class="col-xs-6">
                            <select name="invoice_type" required id="invoice_type" style="height: 40px" class="form-control">
                              <option value="Buying">Buying Invoice</option>
                              <option value="Selling">Selling Invoice</option>
                            </select>
                            <div id="product_name_error"></div>
                        </div>
                      </div>          
                    </div>

                    <div class="form-group">
                      <div id="product_name_div">
                        <label class="col-xs-6">Invoice Date<span class="validatestar">*</span></label>
                        <div class="col-xs-6">
                          <input type="Date" required class="form-control" name="invoice_date" >
                          <div id="product_name_error"></div>
                        </div>
                      </div>          
                    </div>
                    
                    <div style="text-align: center;">
                      <button type="submit" class="btn btn-secondary btn-md" name="form1_submit">Submit</button>
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

<?php include('includes/footer.php');?>