<?php
    include("../includes/connection.php");
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        // echo $id;
        $query = "DELETE FROM invoices WHERE id=$id";

        if ($conn->query($query)==true) {
            echo "<script>  setTimeout(function() {
                $.bootstrapGrowl('The Data Has Been Deleted Successfully', {
                    type: 'danger',
                    align: 'right',
                    width: 400,
                    stackup_spacing: 30
                });
            }, 1000);</script>";
            header('location:SellingInvoices.php');
        } else {
            echo "error".$query."<br>".$conn->error;
        }
    }
?>