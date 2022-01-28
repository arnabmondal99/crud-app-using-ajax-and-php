<?php
include "connection.php";

$id=$_POST['id'];

$sql="delete from userdetails where profile_id='$id'";

if(mysqli_query($conn,$sql)){
    $sql1="delete from table1 where id='$id'";
    if(mysqli_query($conn,$sql1)){
        $data=["msg"=>"record deleted successfully"];
        echo json_encode($data);
    }
    else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>