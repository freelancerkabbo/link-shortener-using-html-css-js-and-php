<?php 

session_start();

if(isset($_GET['msg'])){


   $email =  $_SESSION['email'];

  $msg = $_GET['msg'];

  include "data.php";

  $n= "10"; 
  
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
      $randomString = ''; 
    
      for ($i = 0; $i < $n; $i++) { 
          $index = rand(0, strlen($characters) - 1); 
          $randomString .= $characters[$index]; 
      } 
    

  $qu = "INSERT INTO link ( email , link , short_link ) VALUES( '$email' ,'$msg', '$randomString')";  
  mysqli_query($con, $qu);

  $addlink  = $website_main_url.$randomString;
  
  echo $addlink;

}else{

  echo"No url";

}


?>