<?php
    include('db_conn.php');

    $id = $_GET['delete_id'];
    $sql = "DELETE FROM `user` WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);
    if($res){
        echo "<script>
            alert('Data Deleted ');
        </script>";
    }
?>