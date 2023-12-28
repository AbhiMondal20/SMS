<?php
include('../../db_conn.php');

if (isset($_POST['batch'])) {
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);
    $sql = "SELECT * FROM batches WHERE batches_name = '$batch'";
    $res = mysqli_query($conn, $sql);

    $years = array(); // Array to store years

    while ($row = mysqli_fetch_assoc($res)) {
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];
        $id = $row['id'];

        $start_year = date('Y', strtotime($start_date));
        $end_year = date('Y', strtotime($end_date));

        for ($year = $start_year; $year <= $end_year; $year++) {
            $years[] = array('id' => $id, 'name' => $year);
        }
    }

    echo json_encode($years);
    exit;
} else {
    echo json_encode(array('error' => 'Invalid request'));
    exit;
}
?>
