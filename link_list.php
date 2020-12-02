<?php

session_start();



if (isset($_SESSION['email']))
{

 include 'data.php';

 $email =  $_SESSION['email'];
 $sql = "SELECT * FROM link WHERE email='$email'";
 $res=mysqli_query($con,$sql);


 if(mysqli_num_rows($res)>0){

   $i = 1;

   while($r=mysqli_fetch_array($res)){
 
   echo"<ol id='list_st'>
   <li>";
   $st = $r['link'];
   if (strlen($st) > 35) {
   $tr = substr($st, 0, 35). '...';
   } else {
   $tr = $st;
   }
   echo $tr;
   
   echo"
   <span id='show_links_short'>
   <span id='short_link_style' >
   <input type='text' id='00".$i."' value='".$website_main_url.$r['short_link']."'  class='short_link_00' >
   <a id='link_000' href='".$website_main_url.$r['short_link']."' target='_blank' >";
   

   $string = $website_main_url.$r['short_link'];
   if (strlen($string) > 25) {
   $trimstring = substr($string, 0, 25). '...';
   } else {
   $trimstring = $string;
   }
   echo $trimstring;

   echo"</a>
   </span>
   <span>
   <button onclick='linkcopy".$i."() ' class='copy' >copy</button>
   </span>
   </span></li>
   </ol>
   <script>

    function linkcopy".$i."() {
           var copyText = document.getElementById('00".$i."');
           copyText.select();
           document.execCommand('copy');
           alert('Copy url: ' + copyText.value);
         }

    </script>";

   $i++;
   
   }
   

 }else{ echo"no links found"; }

}else{

   echo"<p>No links found</p>";

}

echo"<br>";





?>