<?php
include('../../db_conn.php');

$id = $_GET["monthly_fees_id"];

$sql = "UPDATE monthly_fees SET pay_status = 1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>
            window.location.href= 'counter-collection';
          </script>";
} else {
    echo "error";
}

$stmt->close();
?>
