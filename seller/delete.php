<?php
    include("../includes/connection.php");
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        // echo $id;

        $query1 = "DELETE o FROM orders o INNER JOIN ord_prod_rel opr ON o.o_id = opr.o_id WHERE opr.p_id = $id";
        $query2 = "DELETE FROM product WHERE p_id = $id";

        if ($conn->query($query1)===true && $conn->query($query2)===true) {
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