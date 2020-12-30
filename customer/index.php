<?php
    session_start();
    include("../includes/connection.php");


    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== 1) {
        header('location: ../index.php');
        die();
    }

    if (isset($_POST["actionbtnbuy"])) {
        $id = $_POST['nameram'];
        echo $id;
        $query = ""; //add to ordeers

        if ($conn->query($query)==true) {
            echo "<script>  setTimeout(function() {
                $.bootstrapGrowl('Item Purchased', {
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
            <div class="row justify-content-center">

                <div class="col-lg-10 bg-light rounded my-2 py-2">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="100px"> ID</th>
                                <th> Name</th>
                                <th> Brand</th>
                                <th> Category</th>
                                <th> Color</th>
                                <th> Price</th>
                                <th> Seller</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                mysqli_set_charset($conn, 'utf8');
                                $user_id =  $_SESSION['id'];
                                $query = "SELECT * FROM";

                                $result = mysqli_query($conn, $query);
                                $row_cnt = $result->num_rows;
                                    if ($row_cnt>0) {
                                        while ($row=$result->fetch_assoc()) {
                                            $id = $row["prod_id"];
                                            $prod_name =  $row['prod_name'];
                                            $prod_price =  $row['prod_price'];
                                            $prod_color =  $row['prod_color'];
                                            $prod_brand =  $row['prod_brand'];
                                            $prod_cat = $row['prod_cat'];
                                            $prod_seller = $row[''];
                            ?>
                            <tr>
                                <td style="background-color: #ffffff"><?php echo  $id ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_name ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_brand ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_cat ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_color ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_price ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_seller ?></td>
                                <td style="background-color: #ffffff"><!-- Button trigger modal -->
                                    <input type="submit"  name="actionbtnbuy" class="btn btn-success btn-xs" value="Buy">
                                    <!-- <a class="btn btn-success btn-xs" >Buy</a> -->
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

<?php include('../includes/footer.php');?>
