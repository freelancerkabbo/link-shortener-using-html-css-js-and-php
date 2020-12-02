<?php


if(isset($_GET['link'])){

include "data.php";

$link = $_GET['link'];
$sql = "SELECT * FROM link WHERE short_link='$link'";
$res=mysqli_query($con,$sql);



if(mysqli_num_rows($res)>0){

    while($r=mysqli_fetch_array($res)){
 
    $e = $r['email']; 
    $l = $r['link']; 
 
    $s = "SELECT * FROM user WHERE email='$e'";
    $rs = mysqli_query($con,$s);  

    while($rf=mysqli_fetch_array($rs)){


    if($rf['action'] == '1'){

    header("location:".$l."");

    }else{

        echo "link expaer";

    }

    }

   
    
    }
    
     if(!isset($_COOKIE['visit'])){
         setCookie('visit','yes',time()+(60*60*24));
         mysqli_query($con,"update link set real_view=real_view+1 WHERE short_link='$link'");
     }
    
    mysqli_query($con,"update link set page_view=page_view+1 WHERE short_link='$link'");
    
    
    }

 }else{

    echo"not found";

}



?>