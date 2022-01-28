<?php

include "connection.php";

$name1=$_POST['name'];
$age=$_POST['age'];
//echo $age;
$password=$_POST['password'];
$address=$_POST['address'];
$id=$_POST['id'];

if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != '')) {
    $test = explode('.', $_FILES['image']['name']);
    $extension = end($test);
    $name = rand(100, 999) . '.' . $extension;
  
    $location = '../uploads/' . $name;
    move_uploaded_file($_FILES['image']['tmp_name'], $location);
  
    //echo '<img src="'.$location.'" height="100" width="100" />';
  }

  $sql="update table1 set name='$name1',age='$age',password='$password' where id='$id'";

  if(mysqli_query($conn,$sql)){
      if(isset($name)){
          $sql1="update userdetails SET address='$address',image='$name' WHERE profile_id='$id'";
      }
      else{
          $sql1="update userdetails SET address='$address' WHERE profile_id='$id'";
      }

      if(mysqli_query($conn,$sql1)){
        $data=["msg"=>" record updated successfully"];
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