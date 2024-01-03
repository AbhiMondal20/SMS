<?php
include('../../db_conn.php');

// Fetch doctors data based on the selected department
if (isset($_POST['batch'])) {
  $batch = mysqli_real_escape_string($conn, $_POST['batch']);
  $sql = "SELECT * FROM `batches`WHERE id = '$batch'";
  $res = mysqli_query($conn, $sql);

  $batch = array();
  while ($batch = mysqli_fetch_assoc($res)) {
    $batch[] = array('id' => $batch['id'], 'name' => $batch['batches_name']);
  }
  echo json_encode($batch);
  exit;
}

?>
