<?php
    include("../includes/connection.php");
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $prod_id = $_GET['p_id'];
        $new_stock = $_GET['new_stock'];

        $query1 = "UPDATE product p SET p.stock = $new_stock WHERE p.p_id = $prod_id";
        $query2 = "DELETE FROM orders WHERE o_id = $id";

        if ($conn->query($query1)===true && $conn->query($query2)===true) {
            echo "<script>  setTimeout(function() {
                $.bootstrapGrowl('The Product Has Been Deleted Successfully', {
                    type: 'danger',
                    align: 'right',
                    width: 400,
                    stackup_spacing: 30
                });
            }, 1000);</script>";
            header('location:Orders.php');
        } else {
            echo "error".$query."<br>".$conn->error;
        }
    }
?>