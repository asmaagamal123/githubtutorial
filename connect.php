<?php

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "smart_bracelet_db";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$heart_rate = 80;


$sql = "INSERT INTO bracelet_data (heart_rate) VALUES ('$heart_rate')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}




$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$start_time = $_GET['start_time'];
$end_time = $_GET['end_time'];


$sql = "SELECT * FROM bracelet_data WHERE timestamp BETWEEN '$start_date $start_time' AND '$end_date $end_time'";


$result = $conn->query($sql);


if ($result->num_rows > 0) {
   
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    echo json_encode($data);
} else {
    echo "No data found";
}
$conn->close();
?>
