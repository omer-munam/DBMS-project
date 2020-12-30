<?php
    include("../includes/connection.php");
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        // echo $id;
        $query = "DELETE FROM products WHERE id=$id";

        if ($conn->query($query)==true) {
            echo "<script>  setTimeout(function() {
                $.bootstrapGrowl('The Product Has Been Deleted Successfully', {
                    type: 'danger',
                    align: 'right',
                    width: 400,
                    stackup_spacing: 30
                });
            }, 1000);</script>";
            header('location:MyProducts.php');
        } else {
            echo "error".$query."<br>".$conn->error;
        }
    }
?>