<?php
    session_start();
    include("../includes/connection.php");


    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== 1) {
        header('location: ../index.php');
        die();
    }

    if (isset($_POST["confirmchanges"])) {
        $id = $row['id'];

        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $cat = $_POST['cat'];
        $color = $_POST['color'];
        $price = $_POST['price'];

        $query = "UPDATE ";

        if ($conn->query($query)==true) {
            echo "<script>
                            setTimeout(function() {
                $.bootstrapGrowl('Product Updated Successfully', {
                    type: 'success',
                    align: 'right',
                    width: 400,
                    stackup_spacing: 30
                });
            }, 3000);
                    </script>";
        } else {
            echo "error".$query."<br>".$conn->error;
        }
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
                            ?>
                            <tr>
                                <td style="background-color: #ffffff"><?php echo  $id ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_name ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_brand ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_cat ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_color ?></td>
                                <td style="background-color: #ffffff"><?php echo  $prod_price ?></td>

                                <td style="background-color: #ffffff"><!-- Button trigger modal -->
                                    <!-- <input type="submit"  name="actionbtndecline" class="btn btn-danger btn-xs" value="Delete"> -->
                                    <div data-toggle="modal" href="#myModal" data-userid="<?php echo $id; ?>" class="btn btn-primary btn-xs">Edit</div>
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


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST"  class="form-horizontal" enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm">
                <!-- <input type="hidden" name="user_id" value=""> -->
                <div class="modal-body">
                    <div class="form-group" align="center">
                        <div class="col-md-6">
                            <input type="text" name="name" placeholder="Name" value="" class="form-control" id="Name" required>
                            <div id="name_error"></div>
                        </div>
                        <div class="col-md-6 mt-1">
                            <input type="text" name="brand" placeholder="Brand" value="" class="form-control" id="Brand" required>
                            <div id="brand_error"></div>
                        </div>
                        <div class="col-md-6 mt-1">
                            <input type="text" name="cat" placeholder="Category" value="" class="form-control" id="Category" required>
                            <div id="cat_error"></div>
                        </div>
                        <div class="col-md-6 mt-1">
                            <input type="text" name="color" placeholder="Color" value="" class="form-control" id="Color" required>
                            <div id="color_error"></div>
                        </div>
                        <div class="col-md-6 mt-1">
                            <input type="Number" step="0.01" name="price" placeholder="Price" value="" class="form-control" id="Price" required>
                            <div id="price_error"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" name="confirmchanges" id="confirmchanges" class="btn btn-success">Confirm Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $('#myModal').on('show.bs.modal', function(e) {
        var userid = $(e.relatedTarget).data('userid');
        $(e.currentTarget).find('input[name="user_id"]').val(userid);
    });
</script>

<?php include('../includes/footer.php');?>
