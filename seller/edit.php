<?php
    session_start();
    include("../includes/connection.php");
    require_once "../vendor/autoload.php";


    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== 1) {
        header('location: ../index.php');
        die();
    }

    \Cloudinary::config(array( 
        "cloud_name" => 'dzmhafzdk', 
        "api_key" => '691945255776953', 
        "api_secret" => 'Z8DlmlIEhunlqxf_oL7Wt9eyk3Q'
    ));
    
    $target_dir = "./uploads/";
    

    if (isset($_POST["confirmchanges"])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $cat = $_POST['cat'];
        $color = $_POST['color'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $img = $_FILES["img"]["name"];
        $oldURL = $_POST['url'];
        
        if($img !== '') {
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
        
            $arr_result = \Cloudinary\Uploader::upload(__DIR__.$target_file);
            // print_r($arr_result['secure_url']);
            $imgURL = $arr_result['secure_url'];
        } else {
            $imgURL = $oldURL;
        }
        

        $query = "UPDATE product SET p_name = '$name', p_brand = '$brand', p_cat = '$cat', p_color = '$color', p_price = '$price', stock = '$stock', imgURL = '$imgURL' WHERE p_id = '$id'";

        if ($conn->query($query)==true) {
            header('location: ./MyProducts.php');
        } else {
            echo "error".$query."<br>".$conn->error;
        }
    }

    $prod_id = $_GET['id'];

    mysqli_set_charset($conn, 'utf8');
    $user_id =  $_SESSION['id'];
    $query = "SELECT * FROM product WHERE p_id = $prod_id";
    $result = mysqli_query($conn, $query);
    $product = $result->fetch_assoc();
    $oldURL = $product['imgURL'];

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
                    <li><span>Edit Product</span></li>
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
    <form action="edit.php" method="POST" class="form-horizontal"  enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm" >
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="single-report">
                <div class="s-report-inner pr--20 pt--30 mb-3">
                <div class="s-report-title d-flex justify-content-center">
                    <h4 class="header-title mb-0" style="font-size: 28px;">Add Product</h4>
                </div>
                        
            <!-- <div class="d-flex justify-content-center pb-2"> -->
                <!-- <h2><?php //echo $row_count3;?></h2> -->
                <div class="form-group">
                    <div class="form-group">
                        <div id="product_name_div">
                        <label class="col-xs-6">Product Name<span class="validatestar">*</span></label>
                        <div class="col-xs-6">
                            <input type="text" required class="form-control" name="name" value="<?php echo $product['p_name'] ?>">
                            <div id="product_name_error"></div>
                        </div>
                        </div>          
                    </div>

                    <div class="form-group">
                        <div id="product_name_div">
                        <label class="col-xs-6">Product Brand<span class="validatestar">*</span></label>
                        <div class="col-xs-6">
                            <input type="text" required class="form-control" name="brand" value="<?php echo $product['p_brand'] ?>">
                            <div id="product_name_error"></div>
                        </div>
                        </div>          
                    </div>

                    <div class="form-group">
                        <div id="product_name_div">
                        <label class="col-xs-6">Product Category<span class="validatestar">*</span></label>
                        <div class="col-xs-6">
                            <input type="text" required class="form-control" name="cat" value="<?php echo $product['p_cat'] ?>">
                            <div id="product_name_error"></div>
                        </div>
                        </div>          
                    </div>

                    <div class="form-group">
                        <div id="product_name_div">
                        <label class="col-xs-6">Product Price<span class="validatestar">*</span></label>
                        <div class="col-xs-6">
                            <input type="Number" step="0.01" required class="form-control" name="price" value="<?php echo $product['p_price'] ?>">
                            <div id="product_name_error"></div>
                        </div>
                        </div>          
                    </div>

                    <div class="form-group">
                        <div id="product_name_div">
                        <label class="col-xs-6">Product Color<span class="validatestar">*</span></label>
                        <div class="col-xs-6">
                            <input type="text" required class="form-control" name="color" value="<?php echo $product['p_color'] ?>">
                            <div id="product_name_error"></div>
                        </div>
                        </div>          
                    </div>

                    <div class="form-group">
                        <div id="stock_div">
                      <label class="col-xs-6">Stock<span class="validatestar">*</span></label>
                      <div class="col-xs-6">
                            <input type="number" required class="form-control" name="stock" value="<?php echo $product['stock'] ?>">
                          <div id="stock_error"></div>
                        </div>
                      </div>          
                    </div>

                    <div class="form-group">
                        <div id="img_div">
                      <label class="col-xs-6">Upload Image</label>
                      <div class="col-xs-6">
                            <input type="file" class="form-control-file" name="img" id="img">
                          <div id="image_error"></div>
                        </div>
                      </div>          
                    </div> 
                    
                    <div style="text-align: center;">
                        <input type="hidden" name="id" value="<?php echo $product['p_id']; ?>">
                        <input type="hidden" name="url" value="<?php echo $oldURL; ?>">
                        <button type="submit" class="btn btn-success btn-md" name="confirmchanges">Confirm Changes</button>
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

<?php include('../includes/footer.php');?>