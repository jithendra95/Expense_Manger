<?php 
session_start();
if(isset($_SESSION['login'])){
if ($_SESSION['login']=="1") {
header ("Location: Home.php");
}}
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
#sign_up_button{

background-color:#00ff00;
margin-left:-10px;
color:#000;
width: 120px;
height: 50px;
font-family: 'Ubuntu', 'Lato', sans-serif;
border-radius: 5px;



}

#sign_up_button:hover{
background-color:#7fff00;
color:#ffffff;
}

#cancel_button{

background-color:#dc143c;
margin-left:60px;
color:#000;
width: 120px;
height: 50px;
font-family: 'Ubuntu', 'Lato', sans-serif;
border-radius: 5px;


}

#cancel_button:hover{
background-color:#ff0000;
color:#ffffff;
}


#log_tab{

background-color:#FFFFFF;
width:420px;
border-radius: 5px;
align:center;
}

#sign_section{
margin-top:10%;
}

.loading_img{
margin-left:43%;
}

.sign_up_field {
    background: #c0c0c0;
    background: -moz-linear-gradient(#c0c0c0, #dcdcdc);
    background: -ms-linear-gradient(#c0c0c0, #dcdcdc);
    background: -o-linear-gradient(#c0c0c0, #dcdcdc);
    background: -webkit-gradient(linear, 0 0, 0 100%, from(#c0c0c0), to(#dcdcdc));
    background: -webkit-linear-gradient(#c0c0c0, #dcdcdc);
    background: linear-gradient(#c0c0c0, #dcdcdc);
    border: 1px solid #dcdcdc;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1);
    border-radius: 5px;
    font-family: 'Ubuntu', 'Lato', sans-serif;
    color: #FFF;
    width: 270px;
    height: 50px;
	padding:8px;
	
}

.sign_up_field:focus {
    box-shadow: inset 0 0 2px #000;
    background: #A9A9A9;
    border-color: #c0c0c0;
    outline: none;
}

.sign_up_field:disabled {
    box-shadow: inset 0 0 2px #000;
    background: #696969;
    border-color: #c0c0c0;
    outline: none;
}




</style>

<script>
$(document).ready(function(){

$(".sign_up_field").blur(function(){
if(this.value==""){
alert("Please Enter "+this.placeholder);
}
})
});

$(document).ready(function(){
$("#cancel_button").click(function(){
location.reload();

})
});



$(document).ready(function(){
$("#login_button").click(function(){
$(".loading_img").css('display','block');
})

});





</script>

<title>Expense Manager-Registration</title>

</head>

<body >
<form action="PHP/User_creation.php" method="POST" name='login' ">
<div class="container-fluid">
<div class="row" id='sign_section'>
  <div class="col-sm-4"></div>
  <div class="col-sm-8"  id='log_tab'>
  
<!--table   class='log_tab' -->

<div height='60px' align='center' class='row'> 
<div class='col-*-*' ><h3 color='#000' ><b>Registration</b></h3></div>
</div>

<div height='60px' align='center' class='row'> 
<br/>
<div class='col-*-*'><input type='text' class='sign_up_field'  name='name' placeholder='Name' ></div>
</div>

<div height='60px' align='center' class='row'> 
<br/>
<div class='col-*-*'><input type='text' class='sign_up_field'  name='user' placeholder='Email' ></div>
</div>

<br/>

<div height='60px' align='center' class='row'> 
<div class='col-*-*'><input type='password' class='sign_up_field'  name='pass' placeholder='Password' ></div>
</div>
<br/>

<div height='60px' align='center' class='row'> 
<div class='col-*-*'><input type='password' class='sign_up_field'  name='repass' placeholder='Re-Type Password' ></div>
</div>
<br/>


<div height='60px' align='center' class='row'> 

<div class='col-sm-6'><input type='button' value='Cancel' id='cancel_button'  ></div>
<div class='col-sm-6'><input type='submit' value='Sign Up' id='sign_up_button'  ></div>

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