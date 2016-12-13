<?php
session_start();
require 'connection_new.php';
require 'password_encryption.php';


if($_POST['user']!=null && $_POST['name']!=null)
{
$name=$_POST['name'];
$user=$_POST['user'];
$pass=$_POST['pass'];

//$pass=generateHash_sha1($pass);
$pass=generateHash_sha1($pass);
//$sql="INSERT INTO class VALUES('".$name."')";
      $sql="SELECT NEXT_VAL FROM user_seq";
      $result=mysqli_query($conect,$sql);
	  $row=mysqli_fetch_array($result);
	  $next_val=$row['NEXT_VAL'];
	  
	  
	  
      $sql="INSERT INTO user VALUES (LPAD( '".$next_val."', 10, '0' ),'".$user."','".$pass."',CURDATE(),'Y')";
      $result=mysqli_query($conect,$sql);


if ( $result == FALSE) {
   echo "User Already Exist";  
    
} 

else {
  $sql="UPDATE user_seq SET LAST_VAL=NEXT_VAL,NEXT_VAL=NEXT_VAL+1";
	  $result=mysqli_query($conect,$sql);
	  
    //echo "New Class created successfully";
	$_SESSION['user']=$user;
    $_SESSION['login']="1";
	header("Location: ../Home.php");
 
}

}



mysqli_close($conect);


?>






