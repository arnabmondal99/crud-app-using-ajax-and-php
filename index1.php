<?php
/*include "server/db.php";
$sql = "SELECT * FROM profile";
$result = $conn->query($sql);
*/
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .con{
            background-color:black;
            color:red;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
</head>

<body>

    <div class="container">
        <h2>Table</h2>
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add User</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                        <div class="form-group">
                                <label for="email">name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="email">age :</label>
                                <input type="text" class="form-control" id="age" placeholder="Enter age" name="age">
                            </div>
                            
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Image:</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Address:</label>
                                <textarea class="form-control" id="address" name="address"></textarea>

                            </div>

                            <button type="button" class="btn btn-success" onclick="addData();">Submit</button>
                        </form>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div> -->
                </div>

            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>AGE</th>
                        <th>PASSWORD</th>
                        <th>ADDRESS</th>
                        <th>IMAGE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody id="alldata">
                </tbody>
            </table>
             <!-- Modal -->
             <div class="modal fade" id="editModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit User Details</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <input type="hidden" name="id" id="id" value="">
                                <div class="form-group">
                                    <label for="email">name :</label>
                                    <input type="text" class="form-control" id="editname" placeholder="Enter name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">age</label>
                                    <input type="text" class="form-control" id="editage" placeholder="Enter age" name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">password:</label>
                                    <input type="password" class="form-control" id="editpass" name="pass">
                                </div>
                                <div class="form-group">
                                <label for="pwd">Image:</label>
                                <input type="file" class="form-control" id="editimage" name="image">
                            </div>
                                <div class="form-group">
                                    <img src="" id="previewimage" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Address:</label>
                                    <textarea class="form-control" id="editaddress" name="address"></textarea>

                                </div>

                                <button type="button" class="btn btn-success" onclick="EditUserdata();">update</button>
                            </form>
                        </div>
                        <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div> -->
                    </div>
             </div>
                </div>
                <div class="modal fade" id="deleteModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">delete data</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <input type="hidden" name="id" id="deleteid" value="">
                           <h1 class="con"> Do you Want To Delete?</h1>
                                <button type="button" class="btn btn-danger" onclick="DeleteDataUser();">Yes</button>
                                <button type="button" class="btn btn-success" onclick="hide()">NO</button>
                            </form>
                        </div>
                        <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div> -->
                    </div>

                </div>
            </div>
       
            </div>




        <script>
        function  addData(){
            var name = $('#name').val();
            var age = $('#age').val();
            var pass = $('#pwd').val();
            var image = document.getElementById('image').files[0];
            var address = $('#address').val();

            var form_data = new FormData();

            form_data.append("name",name);
            form_data.append("age",age);
            form_data.append("pass",pass);
            form_data.append("image",image);
            form_data.append("address",address);




            $.ajax({
               type:"POST",
               url:"operation/add.php",
               data: form_data,
               contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                   console.log(result);
                    // when call is sucessfull
                    //result will be  javascript object using JSON.parse.
                    var result = JSON.parse(result);
                    console.log(result);
                    fetchdata();
                    swal("Good job!", result.msg, "success");
                    $("#myModal").modal('hide');

                   
                },
                error: function(err) {
                    // check the err for error details
                    console.log(err);
                }
            });
       

        }
        fetchdata();
       

        function fetchdata(){
            $.ajax({
               url:"operation/fetchdata.php",
               type:"GET",
               datatype:'json',
               success:function(res){
                   var st="";
                   //console.log(JSON.parse(res)[0].id);

                   //console.log(typeof(res));
                   res=JSON.parse(res);
                  $.each(res,function(key,val){
                      st+=`<tr>
                      <td>${val.id}</td>
                      <td>${val.name}</td>
                      <td>${val.age}</td>
                      <td>${val.password}</td>
                      <td>${val.address}</td>
                      <td><img src="uploads/${val.image}" width="100"></td>
                      <input type="hidden" id="data-${val.id}" value="${val.name}~${val.age}~${val.password}~${val.address}~${val.image}">
                      <td> <button type="button" class="btn btn-info btn-lg" onclick="EditUser(${val.id})" >Edit</button> <button type="button" class="btn btn-info btn-lg"  onclick="DeleteUser(${val.id})" >Delete</button></td>
                         <tr>`;
                  });
                 // console.log(st);
                  $("#alldata").html(st);
                    swal("Good job!", "Fetched", "success");

               }
            });

        }

        function EditUser(id){

            var data=$("#data-"+id).val().split("~");
            //console.log(typeof(data));
            //console.log(data);
           // console.log(data[0]);
           var name=data[0];
           var age=data[1];
           var password=data[2];
           var address=data[3];
           var img=data[4];

           $('#editname').val(name);
           $('#editage').val(age);
           $('#editpass').val(password);
           $('#editaddress').val(address);
           $('#id').val(id);

           $("#previewimage").attr("src","uploads/"+img);
           $('#editModal').modal('show');




        }

        function EditUserdata(){
          var name=$('#editname').val();
          var age=$('#editage').val();
          var password=$('#editpass').val();

          var address=$('#editaddress').val();

         var id= $('#id').val();
         var image= document.getElementById('editimage').files[0];

         var form_data = new FormData();
         form_data.append('name',name);
         form_data.append('age',age);
         form_data.append('password',password);
         form_data.append('address',address);
         form_data.append('id',id);
         form_data.append('image',image);

         $.ajax({
                type: "POST",
                url: "operation/update.php",
                data: form_data,
                // dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    console.log(result);
                    // when call is sucessfull
                    var result=JSON.parse(result);
                    swal("Good job!", result.msg, "success");
                    $("#editModal").modal('hide');
                    fetchdata();
                  //  $("#editModal").modal('hide');
                },
                error: function(err) {
                    // check the err for error details
                    console.log(err);
                }


            });

        }

        function DeleteUser(id){
           // console.log(id);
            $("#deleteid").val(id);
            $("#deleteModal").modal('show');
        }
      
      function hide(){
        $("#deleteModal").modal('hide');
      }
       
       function DeleteDataUser(){
           var id=$("#deleteid").val();

           var data={
               "id":id
           }

           $.ajax({
                type: "POST",
                url: "operation/delete.php",
                data: data,
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    // when call is sucessfull
                    swal("Good job!", result.msg, "success");
                    fetchUser();
                    $("#deleteModal").modal('hide');
                },
                error: function(err) {
                    // check the err for error details
                    console.log(err);
                }


            });

       }




            </script>