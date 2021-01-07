<?php
    session_start();
    include("../includes/connection.php");


    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== 1) {
        header('location: ../index.php');
        die();
    }

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
                    <li><span>Available Products</span></li>
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
                                $query = "SELECT * FROM product";

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
                                            $stock = $row['stock'];
                                            $imgURL = $row['imgURL'];
                            ?>
                            
                                <div class="col-md-4">
                                    <div class="card d-flex align-items-center pt-1" style="width: 18rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                        <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <img src="<?php echo  $imgURL ?>" alt="Card image cap" style="height: auto; width: 180px;">
                                        </div>
                                        <div class="card-body w-100">
                                            <h5 class="card-title" style="display: inline-block;"><?php echo  $prod_name ?></h5> <p style="display: inline-block;">(<?php echo  $prod_brand ?>)</p>
                                            <p class="card-text">Rs <?php echo  $prod_price ?>/-</p>
                                            <a class="btn btn-success btn-xs" href="buy.php?id=<?php echo $id?>&name=<?php echo $prod_name?>&error=">Buy</a>
                                            <a class="btn btn-primary btn-xs" href="product.php?id='<?php echo $id?>'">Details</a>
                                        </div>
                                    </div>
                                </div>
                            
                            <!-- <tr>
                                <td style="background-color: #ffffff"></td>
                                <td style="background-color: #ffffff"></td>
                                <td style="background-color: #ffffff"></td>
                                <td style="background-color: #ffffff"></td>
                                <td style="background-color: #ffffff"></td>
                                <td style="background-color: #ffffff"></td>
                                <td style="background-color: #ffffff"></td>

                                <td style="background-color: #ffffff">
                                    
                                </td>
                            </tr> -->
                            <?php }} ?>
                            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<?php include('../includes/footer.php');?>
