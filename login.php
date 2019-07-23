<?php

session_start();
session_destroy();
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="http://localhost/camping/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" >
    Email: <br>
        <input type="text" name="email"> <br>
    Sifre: <br>
     <input type="password" name="password"> <br><br>
     <input type=submit value="Kaydet" name="Kaydet">

</form>
     </body>

   <?php 
 
    
    $conn = ( "host=localhost port=5432 dbname=KampSepeti user=pizza password=Test01" );
    $dbconn = pg_connect($conn);


if(isset($_POST)){
    if(isset($_POST['email'])) {$email=$_POST['email'];}
    if(isset($_POST['password'])) { $password=md5($_POST['password']); }
    //echo $password;
    
    

    //echo $password; 
    
     if(isset($_POST['email'])!='' && isset($_POST['password'])!=''){

         $pass=pg_query($dbconn, "SELECT password from public.user where email = '".$email."' ");
         $pass1=pg_fetch_assoc($pass);

         //echo $pass1['password']; 
         

        if($pass1['password']!= $password) { 
            echo "hata!"; 
            die; } 
       
      $result=pg_query($dbconn , " SELECT email , password , user_id from public.user where email = '".$email."' " );      
      $row=pg_fetch_assoc($result); 
      $_SESSION['email'] = $row['email']; // store username
      $_SESSION['password'] = $row['password']; // store password
      $_SESSION['user_id'] = $row['user_id'];
      header("Location:index.php");
    } }


      print_r($row);
     
    
   ?> 


</html>