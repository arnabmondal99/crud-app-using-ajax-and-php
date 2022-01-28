<?php
include "connection.php";
$sql = "SELECT table1.*,userdetails.address,userdetails.image FROM table1 INNER JOIN userdetails ON table1.id=userdetails.profile_id";
$result = $conn->query($sql);
$data=[];
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        array_push($data,$row);
    }
    echo json_encode($data);
}else{
    $data=["msg"=>"No Data Found"];
    echo json_encode($data);
}


?>