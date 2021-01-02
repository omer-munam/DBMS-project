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
                    <li><span>My Products</span></li>
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
                                <th width="100px"> Product ID</th>
                                <th> Product Name</th>
                                <th> Product Brand</th>
                                <th> Product Category</th>
                                <th> Product Color</th>
                                <th> Product Price</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                mysqli_set_charset($conn, 'utf8');
                                $user_id =  $_SESSION['id'];
                                $query = "SELECT * FROM seller_prod_rel spr INNER JOIN product p ON spr.s_id = $user_id and spr.p_id = p.p_id";

                                $result = mysqli_query($conn, $query);
                                $row_cnt = $result->num_rows;
                                    if ($row_cnt>0) {
                                        while ($row=$result->fetch_assoc()) {
                                            $id = $row["p_id"];
                                            $prod_name =  $row['p_name'];
                                            $prod_price =  $row['p_price'];
                                            $prod_color =  $row['p_color'];
                                            $prod_brand =  $row['p_brand'];
                                            $prod_cat = $row['p_cat'];
                            ?>
                            <tr>
                                <td style="background-color: #ffffff"><?php echo  $id ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_name ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_brand ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_cat ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_color ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_price ?></td>

                                <td style="background-color: #ffffff">
                                    <a class="btn btn-primary btn-xs" href="edit.php?id='<?php echo $id?>'">Edit</a>
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
</form>

<?php include('../includes/footer.php');?>
