<?php 

session_start();

include "data.php";

  

$mag="";

if(isset($_POST['sub'])){
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$pass =mysqli_real_escape_string($con,$_POST['pass']);

	$res=mysqli_query($con,"select * from user where email='$email' and pass='$pass'");
	
	if(mysqli_num_rows($res)>0){
		$_SESSION['email'] = $email;
	}else{
		
		$mag="Please enter valid login details";
		
	}
		
}


if(isset($_POST['sing_up_sub'])){
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$pass =mysqli_real_escape_string($con,$_POST['pass']);

  $qu_000 = "INSERT INTO user ( email , pass , time , action ) VALUES( '$email' ,'$pass', '12-2-2040' , '1' )";  
  mysqli_query($con, $qu_000);
	$_SESSION['email'] = $email;
	
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>link shortar</title>
  <link rel="stylesheet" href="main.css">
</head>
<body>

<?php 

if (isset($_SESSION['email']))
{

$elll = $_SESSION['email'] ;
$t = "SELECT * FROM user WHERE email='$elll'";
$timeres = mysqli_query($con,$t);

while($timer=mysqli_fetch_array($timeres)){

  $time = $timer['time'];

}
	
}else{
?>
  
  <br>
  <br>
  <br>
  
<div id="login">

<div id="login_tap_01">
<h2 id="top_text_01">Log in</h2>
<form method='post'  >
<input type='text' name='email' id='inputfild1'  placeholder='Email'>
<br>
<br>
<br>
<input type='password' name='pass' id='inputfild1' placeholder='Password'>
<?php echo $mag;?>
<input type="submit" name='sub' value="Log in" id='submit1'>
</form>
<p id="tesxt_011">No account?<button onclick="sing_up_123()" id="singup_tap_0222">Sign up here</button></p>
</div>

<div id="singup_tap_01">
<h2 id="top_text_01">Sing up</h2>
<form method='post'  >
<input type='text' name='email' id='inputfild1'  placeholder='Email'>
<br>
<br>
<br>
<input type='password' name='pass' id='inputfild1' placeholder='Password'>
<input type="submit" name='sing_up_sub' value="Sing up" id='submit1'>
</form>
<p id="tesxt_011">Have account?<button onclick="log_in_123()" id="singup_tap_0222">login here</button></p>
</div>



</div>

<script>

function sing_up_123(){

document.getElementById('singup_tap_01').style="display:block";
document.getElementById('login_tap_01').style="display:none";

}

function log_in_123(){

document.getElementById('singup_tap_01').style="display:none";
document.getElementById('login_tap_01').style="display:block";

}

</script>

<?php die(); }?>
  
<div id='topbar_0012' >
<span id='top_name_text' >link shortener</span>
<a href="logout.php" id='link_22200' >Logout</a>
</div>

<br>
<br>
<br>

<div id="miancon">
<input type="text" name="link" id="link" placeholder="Inter your url" >
<input type="submit" name="sub" id="btn" onclick="link_show_01()">
<input type="text" id="shorten_link" style="display:none;" >
<button id="copy" onclick="copy()" style="display:none;" >copy</button>
<div id="linkshow" >

<?php


 if (isset($_SESSION['email']))
 {
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

</div>
<div id="traffic" >Total link - <?php echo  mysqli_num_rows($res); ?></div>
<div id="time"></div>
</div>


<script>

function link_show_01(){

var x001 = new XMLHttpRequest();
x001.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       document.getElementById("linkshow").innerHTML = x001.responseText;
    }
};
x001.open("GET", "link_list.php", true);
x001.send();

}


const btnSend = document.getElementById("btn");
const chat = document.getElementById("link");
const shortlink = document.getElementById("shorten_link");

function copy() {
  var copyText = document.getElementById("shorten_link");
  copyText.select();
  document.execCommand("copy");
  document.getElementById("btn").style.display = "block";
  document.getElementById("link").style.display = "block";
  shortlink.style.display = "none";
  document.getElementById("copy").style.display = "none";
  alert("Copy url: " + copyText.value);
}

const getMessage = (msg) => {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      shortlink.value = this.responseText;
      shortlink.style.display = "block";
      document.getElementById("btn").style.display = "none";
      document.getElementById("link").style.display = "none";
      document.getElementById("copy").style.display = "block";

    }
  };
  xhttp.open("GET", "urlget.php?msg=" + msg , true);
  xhttp.send();

}

btnSend.addEventListener("click", (e) => {
  e.preventDefault();
  if (chat.value == "") {
		
  } else {
    getMessage(chat.value);
    chat.value = "";
  }
});




//time 
var countDownDate = new Date("<?php echo $time ;?>").getTime();


var x = setInterval(function() {

  var now = new Date().getTime();
    

  var distance = countDownDate - now;
    

  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    

  document.getElementById("time").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  if (distance < 0) {
    clearInterval(x);
    document.getElementById("time").innerHTML = 'EXPIRED';
    }



}, 100);



</script>


</body>
</html>
















