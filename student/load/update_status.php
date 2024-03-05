<?php
include('../../db_conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $chatId = $_POST["chatId"];
    
    // Retrieve the current status from the database
    $sql = "SELECT status FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $chatId);
    $stmt->execute();
    $stmt->bind_result($currentStatus);
    $stmt->fetch();
    $stmt->close();

    // Toggle the status and update it in the database
    $newStatus = ($currentStatus == 1) ? 0 : 1;
    $sql = "UPDATE user SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $newStatus, $chatId);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}
?>
