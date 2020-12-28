<?php
    session_start();
    include("../includes/connection.php");

    if ( !isset($_SESSION['loggedin']) && !isset($_SESSION['is_admin']) ) {
        header('location:login.php');
        die();
    }
    
    if (isset($_POST["ResetPassword"])) {
        $email = $_POST['email'];
        $password = md5($_POST["password"]);
        
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result=mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result)==1) {
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['id'];
                    $query = "UPDATE users SET password = '$password' WHERE id = '$id';";

                    if ($conn->query($query)==true) {
                        echo "<script>

                                        setTimeout(function() {
                            $.bootstrapGrowl('Password change successfully', {
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
            } else {
                echo "<script>

                                setTimeout(function() {
                    $.bootstrapGrowl('Incorrect Email', {
                        type: 'danger',
                        align: 'right',
                        width: 400,
                        stackup_spacing: 30
                    });
                }, 3000);
                        </script>";
            }
        }
    }

include('includes/header.php');
?>

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Manage Users</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="index.php">ePanel</a></li>
                    <li><span>Manage Users</span></li>
                    
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

<!-- <form action="#" method="POST"  class="form-horizontal" enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm"> -->
    <div>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-10 bg-light rounded my-2 py-2">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th> ID</th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Address </th>
                                <th> Date of Birth </th>
                                <th> Occupation </th>
                                <th> Earning </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                mysqli_set_charset($conn, 'utf8');
                                $user_id =  $_SESSION['id'];
                                $query = "SELECT * FROM users";

                                $result = mysqli_query($conn, $query);
                                $row_cnt = $result->num_rows;
                                    if ($row_cnt>0) {
                                        while ($row=$result->fetch_assoc()) {
                                            $id = $row["id"];
                                            $fname =  $row['fname'];
                                            $lname =  $row['lname'];
                                            $email =  $row['email'];
                                            $address =  $row['address'];
                                            $dob =  $row['dob'];
                                            $occupation = $row['occupation'];
                                            $earnings = $row['earnings'];
                            ?>
                            <tr>
                                <td style="background-color: #ffffff"><?php echo  $id ?></td>
                                <td style="background-color: #ffffff"><?php echo  $fname . ' ' . $lname ?></td>
                                <td style="background-color: #ffffff"><?php echo  $email ?></td>
                                <td style="background-color: #ffffff"><?php echo  $address ?></td>
                                <td style="background-color: #ffffff"><?php echo  $dob ?></td>
                                <td style="background-color: #ffffff"><?php echo  $occupation ?></td>
                                <td style="background-color: #ffffff"><?php echo  $earnings ?></td>
                                <!-- <td style="background-color: #ffffff"><!-- Button trigger modal -->
                                    
                                    <!-- <input type="submit"  name="actionbtndecline" class="btn btn-danger btn-xs" value="Delete"> 
                                    <a class="btn btn-danger btn-xs" href="deleteUser.php?id='?php echo $id?>'">Delete</a>
                                </td> -->

                                <td style="background-color: #ffffff"><!-- Button trigger modal -->
                                    <div data-toggle="modal" href="#myModal" data-userid="<?php echo $id; ?>" class="btn btn-primary btn-xs">Change Password</div>
                                    <!-- <input type="hidden" name="user_id" value="<?php echo $id; ?>"> -->
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
<!-- </form> -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST"  class="form-horizontal" enctype="multipart/form-data" onsubmit="return Validate()" name="bform" id="uploadForm">
                <!-- <input type="hidden" name="user_id" value=""> -->
                <div class="modal-body">
                    <div class="form-group" align="center">
                        <div class="col-md-6">
                            <input type="email" name="email" placeholder="Email" value="" class="form-control" id="Email">
                            <div id="email_error"></div>
                        </div>
                        <div class="col-md-6 mt-1">
                            <input type="password" name="password" placeholder="New Password" value="" class="form-control" id="Email">
                            <div id="password_error"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" name="ResetPassword" id="ResetPassword" class="btn btn-primary">Change Password</button>
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

</div>
</div>
</div>

<?php include('includes/footer.php');?>