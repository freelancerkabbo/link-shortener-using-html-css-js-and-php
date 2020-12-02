<?php



 if (isset($_SESSION['email']))
 {
  $email =  $_SESSION['email'];
  $ssssssss = "SELECT * FROM link WHERE email='$email'";
  $res0001=mysqli_query($con,$ssssssss);


  if(mysqli_num_rows($res0001)>0){

    $i = 1;

    while($r=mysqli_fetch_array($res0001)){
  
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
    <input type='text' id='00".$i."' value='http://localhost/test/javascript/link shortar/s".$r['short_link']."'  class='short_link_00' >
    <a id='link_000' href='http://localhost/test/javascript/link shortar/s".$r['short_link']."' target='_blank' >";
    

    $string = "http://localhost/link shortar/s".$r['short_link'];
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