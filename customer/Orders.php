<?php
    session_start();
    include("../includes/connection.php");


    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== 1) {
        header('location: ../index.php');
        die();
    }

    // if (isset($_POST["actionbtndecline"])) {
    //     $id = $_POST['nameram'];
    //     echo $id;
    //     $query = "DELETE FROM invoices WHERE id='$id'";

    //     if ($conn->query($query)==true) {
    //         echo "<script>  setTimeout(function() {
    //             $.bootstrapGrowl('The Data Has Been Deleted Successfully', {
    //                 type: 'danger',
    //                 align: 'right',
    //                 width: 400,
    //                 stackup_spacing: 30
    //             });
    //         }, 1000);</script>";
    //     } else {
    //         echo "error".$query."<br>".$conn->error;
    //     }
    // }
    include('../includes/headerCust.php');
?>
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Orders</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="index.php">Home</a></li>
                    <li><span>Orders</span></li>
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

<form action="#" method="POST"  class="form-horizontal"  enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm">
    <div>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-10 bg-light rounded my-2 py-2">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="100px"> Order ID</th>
                                <th> Product Name</th>
                                <th> Product Brand</th>
                                <th> Product Color</th>
                                <th> Total</th>
                                <th> Order Date </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                mysqli_set_charset($conn, 'utf8');
                                $cust_id =  $_SESSION['id'];
                                $query = "SELECT o.*, p.* FROM orders o INNER JOIN ord_prod_rel opr ON o.cust_id = $cust_id AND o.o_id = opr.o_id INNER JOIN product p ON opr.p_id = p.p_id";

                                $result = mysqli_query($conn, $query);
                                $row_cnt = $result->num_rows;
                                    if ($row_cnt>0) {
                                        while ($row=$result->fetch_assoc()) {

                                            $ord_id = $row["o_id"];
                                            $prod_name =  $row['p_name'];
                                            $prod_price =  $row['p_price'] * $row['qty'];
                                            $prod_color =  $row['p_color'];
                                            $prod_brand =  $row['p_brand'];
                                            $date = $row['ordered_at'] 
                            ?>
                            <tr>
                                <td style="background-color: #ffffff"><?php echo  $ord_id ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_name ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_brand ?></td>                                
                                <td style="background-color: #ffffff"><?php echo  $prod_color ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_price ?></td>
                                <td style="background-color: #ffffff"><?php echo  $date ?></td>
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

<?php include('../includes/footer.php');?>
