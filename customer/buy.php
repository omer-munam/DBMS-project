<?php
    session_start();
    include("../includes/connection.php");


    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== 1) {
        header('location: ../index.php');
        die();
    }

    if (isset($_POST["order"])) {
        $prod_id = $_POST['id'];
        $cust_id = $_SESSION['id'];
        $qty = $_POST['qty'];
        $key = uniqid();

        $query1 = "INSERT INTO orders (o_id, cust_id, qty) VALUES ('$key', '$cust_id', '$qty')";
        $query2 = "INSERT INTO ord_prod_rel (o_id, p_id) VALUES ('$key', '$prod_id')";

        if ($conn->query($query1)==true && $conn->query($query2)==true) {
            header('location: ./Orders.php');
        } else {
            echo "error".$query."<br>".$conn->error;
        }
    }

    $prod_id = $_GET['id'];
    $prod_name = $_GET['name'];

    include('../includes/headerCust.php');
?>
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Available Products</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="index.php">Home</a></li>
                    <li><span>Order Product</span></li>
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
    <form action="buy.php" method="POST" class="form-horizontal"  enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm" >
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="single-report">
                <div class="s-report-inner pr--20 pt--30 mb-3">
                <div class="s-report-title d-flex justify-content-center">
                    <h4 class="header-title mb-0" style="font-size: 28px;">Order <?php echo $prod_name?></h4>
                </div>
                        
            <!-- <div class="d-flex justify-content-center pb-2"> -->
                <!-- <h2><?php //echo $row_count3;?></h2> -->
                <div class="form-group">
                    <div class="form-group">
                        <div id="product_name_div">
                        <label class="col-xs-6">Please Enter Quantity<span class="validatestar">*</span></label>
                        <div class="col-xs-6">
                            <input type="number" required class="form-control" name="qty" >
                            <div id="product_name_error"></div>
                        </div>
                        </div>          
                    </div>
                    <div style="text-align: center;">
                        <input type="hidden" name="id" value="<?php echo $prod_id; ?>">
                        <button type="submit" class="btn btn-success btn-md" name="order">Order</button>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<?php include('../includes/footer.php');?>
