<?php 
session_start();
require 'PHP/password_encryption.php';


if(isset($_SESSION['login'])){
if ($_SESSION['login']=="1") {
header ("Location: Home.php");
}else{$_SESSION['login_msg']="Invalid";}
}else{$_SESSION['login_msg']="";}



if($_SERVER["REQUEST_METHOD"] == "POST") {
require  'PHP/connection_new.php';


$result=mysqli_query($conect,"SELECT USER_NAME,PASSWORD,USER_ID FROM `user` where USER_NAME='".$_POST["user"]."'  AND ACTIVE_STATUS='Y' ");
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}
 if(isset(  $_POST["user"])&& isset( $_POST["pass"])  )
{

if($row=mysqli_fetch_array($result)){

  if(verify($_POST["pass"],$row["PASSWORD"])){
  
  $_SESSION['user']=$row["USER_ID"];
  $_SESSION['login']="1";
  header("Location: Home.php");
  
}
else{
$error="Invalid Username or Password ";
}


}else{
$error="Invalid Username or Password ";
//header("Location: Index.php");
}

}else{

$_SESSION['login']="0";
//header("Location: Index.php");
$error="Invalid Username or Password";
}



mysqli_close($conect);}
?>


<!DOCTYPE HTML>
<html lang='en'>

<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="CSS/Style.css">

<link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
<!-- Latest compiled JavaScript -->
<script src="jquery-1.11.2.min.js"></script>
<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

<!--
<script language="JavaScript" type = "text/javascript"  src = "JS/CreateClass.js" ></script>
<script language="JavaScript" type = "text/javascript"  src = "JS/ClassDetails.js" ></script>
-->

<style>
#login_button{

background-color:#4169E1;
color:#fff;
width: 270px;
height: 30px;
font-family: 'Ubuntu', 'Lato', sans-serif;
border-radius: 5px;


}

#login_button:hover{
background-color:#6495ED;
}

#log_tab{

background-color:#2F4F4F;
width:420px;
border-radius: 5px;
align:center;
}
#login_section{
margin-top:15%;


}

.loading_img{
margin-left:43%;
}





</style>

<script>
$(document).ready(function(){

$(".input_field").focus(function(){
})
});

$(document).ready(function(){

$(".input_field").blur(function(){
})
});

$(document).ready(function(){
$("#login_button").click(function(){
$(".loading_img").css('display','block');
})

});



</script>

<title>Expense Manager-Login</title>

</head>

<body >
<form action="" method="POST" name='login' ">
<div class="container-fluid">
<div class="row" id='login_section'>
  <div class="col-sm-4"></div>
  <div class="col-sm-8"  id='log_tab'>
  
<!--table   class='log_tab' -->

<div height='60px' align='center' class='row'> 
<div class='col-*-*' ><h3 color='#fff' class='header'><b>Sign In</b></h3></div>
</div>


<div height='60px' align='center' class='row'> 
<br/>
<div class='col-*-*'><input type='text' class='log_input_field'  name='user' placeholder='Email' ></div>
</div>

<br/>

<div height='60px' align='center' class='row'> 
<div class='col-*-*'><input type='password' class='log_input_field'  name='pass' placeholder='Password' ></div>
</div>
<br/>
<div style = "font-size:12px; color:#cc0000; margin-left:115px;"><?php if($_SERVER["REQUEST_METHOD"] == "POST"){echo $error;}?></div>
<br/>
<div height='60px' align='center' class='row'> 
<div class='col-*-*'><input type='submit' value='Login' id='login_button'  ></div>
<br/>
</div>

<div height='60px' align='center' class='row'> 
<div class='col-sm-6'>
  <a class='link' href="Sign_In.php" >Register</a>
</div>

<div class='col-sm-6'>
  <a class='link' href="#">Forgot Password?</a>
</div>
</div>

<br/>




<!--/table-->
</div>

</div>
</div>
</form>

<div >
<img class='loading_img' src='loading.gif'>
</div>


</body>