<?php
    session_start();
    include("../includes/connection.php");


    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== 1) {
        header('location: ../index.php');
        die();
    }

    include('../includes/header.php');
?>
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">My Products</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#"><span>Products</span></a></li>
                    <li><span>Product</span></li>
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
                        <div class="row">
                            <?php
                                mysqli_set_charset($conn, 'utf8');
                                $user_id =  $_SESSION['id'];
                                $id = $_GET['id'];
                                $query = "SELECT * FROM product p WHERE p.p_id=$id";

                                $result = mysqli_query($conn, $query);
                                    
                                        if ($row=$result->fetch_assoc()) {
                                            $prod_id =  $row['p_id'];
                                            $prod_name =  $row['p_name'];
                                            $prod_price =  $row['p_price'];
                                            $prod_color =  $row['p_color'];
                                            $prod_brand =  $row['p_brand'];
                                            $prod_cat = $row['p_cat'];
                                            $stock = $row['stock'];
                                            $imgURL = $row['imgURL'];
                            ?>
                            
                                <div class="col-md-6 text-center">
                                    <img src="<?php echo  $imgURL ?>" alt="prod-image" style="height: auto; width: 300px;">
                                </div>
                                <div class="col-md-6" style="color: teal;">
                                    <h1><?php echo $prod_name ?></h1>
                                    <h4><?php echo $prod_brand ?></h4><br>
                                    <h5>Rs <?php echo $prod_price ?> /-</h5><br>
                                    <p style="color: teal;">Color: <?php echo $prod_color ?></p>
                                    <p style="color: teal;">Stock: <?php echo $stock ?></p><br><br><br>
                                    <a class="btn btn-primary btn-xs" href="edit.php?id='<?php echo $prod_id?>'">Edit Details</a>
                                </div>
                            
                            <?php } ?>
                            </div>
        </div>
    </div>
</form>

<?php include('../includes/footer.php');?>
