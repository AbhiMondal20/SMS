<?php

$dbname = "sms";
$dbuser = "root";
$dbpass = "";
$dbhost = "localhost";

// Create a connection to the database
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("ERROR: Unable to connect to the database: " . $conn->connect_error);
}

// echo "<script>
//     alert('Connected to the database!');
// </script>";


?>
