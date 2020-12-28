<?php
    session_start();
    include("includes/connection.php");


   if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== 1) {
       header('location:login.php');
       die();
   }

 if (isset($_POST["actionbtndecline"])) {
     $id = $_POST["nameram"];

     $query = "DELETE FROM invoices WHERE id='$id'";

     if ($conn->query($query)==true) {
         echo "<script>  setTimeout(function() {
        $.bootstrapGrowl('The Data Has Been Deleted Successfully', {
            type: 'danger',
            align: 'right',
            width: 400,
            stackup_spacing: 30
        });
    }, 1000);</script>";
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
                            <h4 class="page-title pull-left">Buying Invoices</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="#"><span>Invoices</span></a></li>
                                <li><span>Buying</span></li>
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






            <form action="#" method="POST"  class="form-horizontal"  enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm">
                <div>
     <div class="container">
         <div class="row justify-content-center">

                 <div class="col-lg-10 bg-light rounded my-2 py-2">
                     <table id="example" class="table table-striped table-bordered">
       <thead>
           <tr>
                               <th width="100px"> Invoice Number</th>
                           <th> Product Name </th>
                           <th> Product Price </th>

                           <th> Product Quantity</th>
                           <th> Invoice Type </th>
                           <th> Invoice Date </th>
                           <th> Action </th>
                           </tr>
       </thead>
       <tbody>
           <?php
                        mysqli_set_charset($conn, 'utf8');
                        $user_id =  $_SESSION['id'];
                        $query = "SELECT * FROM invoices WHERE user_id='$user_id' AND inv_type='Buying'";

                        $result=mysqli_query($conn, $query);
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

                            ?>
                         <tr>
                           <td style="background-color: #ffffff"><?php echo  $inv_num ?></td>
                           <td style="background-color: #ffffff"><?php echo  $prod_name ?></td>
                           <td style="background-color: #ffffff"><?php echo  $prod_price ?></td>
                           <td style="background-color: #ffffff"><?php echo  $prod_qty ?></td>
                           <td style="background-color: #ffffff"><?php echo  $inv_type ?></td>
                           <td style="background-color: #ffffff"><?php echo  $inv_date ?></td>

                            <td style="background-color: #ffffff"><!-- Button trigger modal -->
                              <!-- <input type="submit"  name="actionbtndecline" class="btn btn-danger btn-xs" value="Delete"> -->
                              <a class="btn btn-danger btn-xs" href="delete.php?id='<?php echo $id?>'">Delete</a>
                            </td>
                        </tr>
<?php }} ?>
       </tbody>

   </table>
                 </div>

         </div>
     </div>

     </div>

     <input type="hidden" id="ram" name="nameram" value="<?php echo $id; ?>">
   </form>
<script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
<?php include('includes/footer.php');?>
