<?php
  session_start();
  include("includes/connection.php");
  require_once 'vendor/autoload.php';

  if (!isset($_SESSION['loggedin'])) {
      header('location:login.php');
      die();
  }

  $tax = 0;
  $taxB = 0;
  $taxS = 0;
  $total_amountS = 0;
  $total_amountB = 0;

  mysqli_set_charset($conn, 'utf8');
  $user_id =  $_SESSION['id'];
  $query = "SELECT * FROM invoices WHERE user_id='$user_id' AND inv_type='Selling' AND inv_date >= DATE_FORMAT(CURDATE(), '%Y-%m-%d') - INTERVAL 3 MONTH";

  $result=mysqli_query($conn, $query);
  if ($result) {
      $row_cnt = $result->num_rows;
      if ($row_cnt>0) {
          while ($row=$result->fetch_assoc()) {
              $id = $row["id"];
              $inv_num =  $row['inv_number'];
              $prod_name =  $row['prod_name'];
              $prod_price =  $row['prod_price'];
              $prod_qty =  $row['prod_qty'];
              $inv_type =  $row['inv_type'];
              $inv_date = $row['inv_date'];

              $total_amountS += ($prod_price * $prod_qty);
          }
          $taxS = $total_amountS * 0.19;
          // echo "<p class=\"h6\">No. of products sold: ". $row_cnt ."</p>";
          // echo "<p class=\"h6\">Total Amount: ". $total_amountS ."</p>";
          // echo "<p class=\"h6\">Tax to be paid: ". $taxS ."</p>";
      }
  }

  mysqli_set_charset($conn, 'utf8');
  $user_id =  $_SESSION['id'];
  $query = "SELECT * FROM invoices WHERE user_id='$user_id' AND inv_type='Buying' AND inv_date >= DATE_FORMAT(CURDATE(), '%Y-%m-%d') - INTERVAL 3 MONTH";

  $result=mysqli_query($conn, $query);
  if ($result) {
      $row_cnt = $result->num_rows;
      if ($row_cnt>0) {
          while ($row=$result->fetch_assoc()) {
              $id = $row["id"];
              $inv_num =  $row['inv_number'];
              $prod_name =  $row['prod_name'];
              $prod_price =  $row['prod_price'];
              $prod_qty =  $row['prod_qty'];
              $inv_type =  $row['inv_type'];
              $inv_date = $row['inv_date'];

              $total_amountB += ($prod_price * $prod_qty);
          }
          $taxB = $total_amountB * 0.19;
          // echo "<p class=\"h6\">No. of products sold: ". $row_cnt ."</p>";
          // echo "<p class=\"h6\">Total Amount: ". $total_amountB ."</p>";
          // echo "<p class=\"h6\">Tax to be received: ". $taxB ."</p>";
      }
  }

  $tax = $taxS - $taxB;
  $total_amount = $total_amountB + $total_amountS;
  

  $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('TAX_DECLARATION_FORM.docx');
  $templateProcessor->setValue('start_date', date('Y-m-d', strtotime("-3 Months")));
  $templateProcessor->setValue('end_date', date('Y-m-d'));
  $templateProcessor->setValue('current_date', date('Y-m-d'));
  $templateProcessor->setValue('tot_s', $total_amountS);
  $templateProcessor->setValue('tot_b', $total_amountB);
  $templateProcessor->setValue('t_sb', ($total_amountS - $total_amountB));
  $templateProcessor->setValue('tax', $tax);
  $templateProcessor->setValue('VAT_pin', $_SESSION['VAT_pin']);
  $templateProcessor->setValue('VAT_Account', $_SESSION['id']);

  $file = $_SESSION['name'].'-TAX_DECLARATION_FORM-'.date('Y-m-d').'.docx';
  $templateProcessor->saveAs($file);

  include('includes/header.php');
?>


    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h5 class="page-title pull-left">TAX DECLARATION FORM</h5>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="index.php">Home</a></li>
                        <li><span>Tax Declaration Form</span></li>
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
      <div class="single-report">
        <div class="s-report-inner pr--20 pt--30 mb-5">

          <!-- Images container starts -->
          <div class="row d-flex justify-content-between">
            <div class="col-3 align-self-center d-flex justify-content-center"><img src="assets/images/icon/left_logo.png" alt=""></div>
            <div class="col-3 align-self-start d-flex justify-content-center"><img src="assets/images/icon/center_logo.png" alt=""></div>
            <div class="col-3 align-self-center d-flex justify-content-center"><img src="assets/images/icon/right_logo.jpg" alt=""></div>
          </div>
          <!-- Images container ends -->

          <!-- Heading container starts -->
          <div class="s-report-title d-flex justify-content-center mt-3">
            <h4 class="header-title font-weight-bold mb-0 " style="font-size: 28px;"><u>TAX DECLARATION FORM</u></h4>
          </div>
          <!-- Heading container ends -->

          <!-- date container starts -->
          <div class="row">
            <div class="col-8 p-4">
              <div class="row justify-content-center">
                <p class="mr-2">For the period of</p>
                <span class="text_box d-flex justify-content-center"><?php echo date('Y-m-d', strtotime("-3 Months")) ?></span>
                <p class="ml-2 mr-2">to</p>
                <span class="text_box d-flex justify-content-center"><?php echo date('Y-m-d') ?></span>
              </div>
              <div class="row mt-5 justify-content-end">
                <p class="mr-2">VTA REG. NUMBER</p>
                <span class="text_box"></span>
              </div>
              <div class="row mt-1 justify-content-end">
                <p class="mr-2">DATE</p>
                <span class="text_box d-flex justify-content-center"><?php echo date('Y-m-d') ?></span>
              </div>
            </div>
            <div class="col-4">
              <div class="receipt-stamp w-50 h-100">
                <p class="d-flex justify-content-center">Receipt Stamp</p>
              </div>
            </div>
          </div>
          <!-- date container ends -->
          
          <!-- deadline container starts -->
          <div class="row container justify-content-center">
            <div class="col-12 mt-3 p-3 row" style="background: #4472C4;">
              <p class="text-white text-center">
                This form must be completed and give to the Tax Officer until
                <span class="text_box ml-2 mr-2">
                  <span class="invisible"><?php echo date('Y-m-d') ?></span>
                </span>
                otherwise you will receive a financial incentive. By this date, all taxable VAT must be paid, otherwise you will be charged an additional tax equal to ten percent (10%) 
                of the VAT payable.
              </p>
            </div>
          </div>
          <!-- deadline container ends -->

          <!-- table container starts -->
          <div class="row container justify-content-center">
            <div class="col-12 mt-3 p-3">
              <div class="row">
                <div class="col-3 p-0">
                  <div class="office-use w-100 h-100 d-flex p-3">
                    <p class="align-self-center"><small>FOR OFFICE USE ONLY</small></p>
                  </div>
                </div>
                <div class="col-9 p-0">
                  <table class="table table-bordered m-0">
                    <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">&euro;</th>
                        <th scope="col">cents</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>VAT due at this time on the outflows</td>
                        <td>1</td>
                        <td><?php echo $total_amountS ?></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>VAT due at this time on acquisitions relating to other Member States of the European Union</td>
                        <td>2</td>
                        <td>0</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td><b>Total VAT due (THE SUMMARY OF SQUARES 1 AND 2)</b></td>
                        <td>3</td>
                        <td><?php echo $total_amountS ?></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>VAT currently deductible on purchases and other inputs (including acquisitions by other Member States of the European Union)</td>
                        <td>4</td>
                        <td><?php echo $total_amountB ?></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td class="text-white" style="background: #4472C4;">VAT Payable or refundable (Subtraction between boxes 3 and 4)</td>
                        <td>5</td>
                        <td><?php echo ($total_amountS - $total_amountB) ?></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Total value of outputs (Excluding VAT)<b> (Including tde amount of squares 8A + 8B, 9 AND 11B)</b></td>
                        <td>6</td>
                        <td><?php echo $total_amountS ?></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Total value of inputs (Excluding VAT) <b>(Including the amount of squares 11A + 11B)</b></td>
                        <td>7</td>
                        <td><?php echo $total_amountB ?></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Total value of all deliveries of goods and related services (Excluding VAT) to other Member States of the European Union</td>
                        <td>8A</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Total value of services provided to other members of the European Union</td>
                        <td>8B</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Total value of outputs charged at a rate of 0% (other than those listed in box 8A)</td>
                        <td>9</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Total value of off-sale sales with the right to deduct input tax. (other than those in box 8B)</td>
                        <td>10</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Total value of all acquisitions of goods and related services (excluding VAT)</td>
                        <td>11A</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Total value of services received from subdivisions of other Member States</td>
                        <td>11B</td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- table container ends -->

          <!-- deadline container starts -->
          <div class="row container justify-content-center">
            <div class="col-12 mt-3 p-3" style="background: #4472C4;">
              <div class="row pl-3 d-flex">
                <span class="bg-dark py-2 px-3">
                  <p class="text-dark bg-white">DECLARATION</p>
                </span>
                <p class="text-white ml-2 align-self-end">Ι declare that the information contained in this form is complete and true.</p>
              </div>
              <p class="text-white">Name: …………………………………………………………………………………………………………</p>
              <p class="text-white">Status of signatory: INDEPENDENT EMPLOYEE</p>
              <div class="row px-3 justify-content-between">
                <p class="text-white">Signature: …………………………………………………..</p>
                <p class="text-white">Date………/………/…………..</p>
              </div>
            </div>
          </div>
          <!-- deadline container ends -->

          <!-- payment receipt container starts -->
          <div class="row container">
            <div class="col-10 mt-3 p-3" style="background: #4472C4;">
              <div class="s-report-title">
                <h4 class="header-title mb-0 text-white" style="font-size: 24px;">PAYMENT RECEIPT</h4>
              </div>
              <div class="row pl-3 mb-3">
                <h4 class="header-title mb-0 mr-2 text-white" style="font-size: 22px;">Amount to be paid: </h4>
                <span class="text_box d-flex justify-content-center">&euro; <?php echo $tax ?></span>
              </div>
              <div class="row">
                <div class="col-4">
                  <h4 class="header-title text-white" style="font-size: 22px;">For internal use only</h4>
                  <div class="bg-white w-100" style="border: 1px solid greenyellow;">
                    <div class="h-100 p-2">
                      <p class="font-weight-bold">Payment Date:</p>
                      <span class="text_box2 d-block text-white"></span> 
                      <p class="font-weight-bold mt-1">Pass Pin:</p>
                      <span class="text_box2 d-block text-white"></span>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-center mt-4">
                    <h4 class="header-title mb-0 text-white" style="font-size: 22px;">VAT PIN</h4>
                  </div>
                  <div class="d-flex justify-content-center">
                    <span class="text_box d-flex justify-content-center" style="height: 30px;"><?php echo $_SESSION['VAT_pin']; ?></span>
                  </div>
                  <div class="d-flex justify-content-center">
                    <h4 class="header-title mb-0 mt-1  text-white" style="font-size: 22px;">VAT ACC. NUMBER</h4>
                  </div>
                  <div class="d-flex justify-content-center">
                    <span class="text_box d-flex justify-content-center" style="height: 30px; width: 200px"><?php echo $_SESSION['id']; ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- payment receipt container ends -->

        </div>

        <div class="container mt-3 mb-4 d-flex justify-content-center">
          <a href="<?php echo $file ?>" class="btn btn-secondary">Download TAX Declaration Form</a>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>

<?php include('includes/footer.php');?>