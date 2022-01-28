<?php
include "connection.php";
$name1=$_POST['name'];
$age=$_POST['age'];
$pass=$_POST['pass'];
$address=$_POST['address'];

//print_r($_FILES['image']);

if ($_FILES['image']['name'] != '') {
    $test = explode('.', $_FILES['image']['name']);
    $extension = end($test);
    $name = rand(100, 999) . '.' . $extension;
  
    $location = '../uploads/' . $name;
    move_uploaded_file($_FILES['image']['tmp_name'], $location);
  
    //echo '<img src="'.$location.'" height="100" width="100" />';
  }
  
  $sql="insert into table1 set name='$name1',age='$age',password='$pass'";

  if(mysqli_query($conn,$sql)){
    $profile_id= mysqli_insert_id($conn);
     if(isset($name)){
       $sql1="insert into userdetails SET profile_id='$profile_id',address='$address',image='$name'";
     }
     else{
       $sql1="insert into userdetails set profile_id='$profile_id',address='$address' ";
     }

     if (mysqli_query($conn, $sql1)) {
      $data = ["msg" => "New record created successfully"];
      echo json_encode($data);
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

  }
  else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

?>