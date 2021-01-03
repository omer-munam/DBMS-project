<?php
    include("../includes/connection.php");
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "UPDATE orders SET confirmed = 'confirmed' WHERE o_id = $id";

        if ($conn->query($query)===true) {
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