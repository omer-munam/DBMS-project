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
    include('../includes/header.php');
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

                <div class="col-lg-12 bg-light rounded my-2 py-2">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th> Product Name</th>
                                <th> Customer Name</th>
                                <th> Adrress</th>
                                <th> Contact</th>
                                <th> Quantity</th>
                                <th> Total</th>
                                <th> Order Date</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                mysqli_set_charset($conn, 'utf8');
                                $seller_id =  $_SESSION['id'];
                                $query = "SELECT o.o_id, o.ordered_at, o.confirmed, p.p_id, p.p_name, p.p_price, p.stock, o.qty, u.fname, u.contact, u.address  FROM seller_prod_rel spr INNER JOIN ord_prod_rel opr ON spr.p_id = opr.p_id AND spr.s_id = $seller_id INNER JOIN product p ON spr.p_id = p.p_id  INNER JOIN orders o ON opr.o_id = o.o_id INNER JOIN users u ON o.cust_id = u.id";

                                $result = mysqli_query($conn, $query);
                                $row_cnt = $result->num_rows;
                                    if ($row_cnt>0) {
                                        while ($row=$result->fetch_assoc()) {
                                            $ord_id = $row["o_id"];
                                            $prod_id =  $row['p_id'];
                                            $prod_name =  $row['p_name'];
                                            $qty =  $row['qty'];
                                            $prod_price =  $row['p_price'] * $row['qty'];
                                            $cust_name =  $row['fname'];
                                            $cust_addr = $row['address'];
                                            $cust_contact = $row['contact'];
                                            $ord_date = $row['ordered_at'];
                                            $status = $row['confirmed'];
                                            $new_stock = $row['stock'] + $qty;
                            ?>
                            <tr>
                                <td style="background-color: #ffffff"><?php echo  $prod_name ?></td>                                
                                <td style="background-color: #ffffff"><?php echo  $cust_name ?></td>
                                <td style="background-color: #ffffff"><?php echo  $cust_addr ?></td>
                                <td style="background-color: #ffffff"><?php echo  $cust_contact ?></td>
                                <td style="background-color: #ffffff"><?php echo  $qty ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_price ?></td>
                                <td style="background-color: #ffffff"><?php echo  $ord_date ?></td>
                                <td style="background-color: #ffffff">
                                    <?php if($status == 'pending') {?>
                                        <a class="btn btn-primary btn-xs" href="confirm.php?id='<?php echo $ord_id ?>'">Confirm</a>
                                        <a class="btn btn-danger btn-xs" href="delOrder.php?id='<?php echo $ord_id?>'&p_id='<?php echo $prod_id?>'&new_stock='<?php echo $new_stock?>'">Cancel</a>
                                    <?php } else if ($status == 'confirmed') { ?>
                                        <a class="btn btn-danger btn-xs" href="delOrder.php?id='<?php echo $ord_id?>'">Cancel</a>
                                    <?php } else if ($status == 'received') { ?>
                                        <p>No Action</p>
                                    <?php } ?>
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
