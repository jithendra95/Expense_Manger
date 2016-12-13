<?php
session_start();
require 'connection_new.php';




$chkBox=$_POST['chk_trn'];
$chksql=$_POST['chk_sql'];

$sql="";
if($chksql=="income"){
	 foreach($chkBox as $selected){
	 
	 $sql3="SELECT NEXT_VAL FROM trn_seq";
      $result3=mysqli_query($conect,$sql3);
	  $row=mysqli_fetch_array($result3);
	  $next_val=$row['NEXT_VAL'];
	  
	 //echo $selected;
	  $sql="INSERT INTO main_trn(TRN_CODE,TRN_TYPE,TRN_AMOUNT, TRN_DESC, TRN_DATE, ENT_DATE, INC_CODE,ENT_USER) 
	        VALUES (CONCAT('TR',LPAD( '".$next_val."', 8, '0' )),'CR',
           (SELECT AMOUNT from income_trn WHERE INC_CODE='".$selected."'),
            (SELECT INC_DESC from income_trn WHERE INC_CODE='".$selected."'), 
            CURDATE(),CURDATE(),       
            (SELECT INC_CODE from income_trn WHERE INC_CODE='".$selected."'),        
            '".$_SESSION['user']."')";
			
	   $sql2="UPDATE trn_seq SET LAST_VAL=NEXT_VAL,NEXT_VAL=NEXT_VAL+1";
	   $result2=mysqli_query($conect,$sql2);		
	
	   $result=mysqli_query($conect,$sql);
       
	}
	  
	
     header("Location: ../Income.php");
			
	}else{
	
	 foreach($chkBox as $selected){
	 
	 $sql3="SELECT NEXT_VAL FROM trn_seq";
      $result3=mysqli_query($conect,$sql3);
	  $row=mysqli_fetch_array($result3);
	  $next_val=$row['NEXT_VAL'];
	  
	 //echo $selected;
	  $sql="INSERT INTO main_trn(TRN_CODE,TRN_TYPE,TRN_AMOUNT, TRN_DESC, TRN_DATE, ENT_DATE, INC_CODE,ENT_USER,PAYEE_DESC,EXP_TYPE_CODE) 
	        VALUES (CONCAT('TR',LPAD( '".$next_val."', 8, '0' )),'DR',
           (SELECT AMOUNT from expense_trn WHERE EXP_CODE='".$selected."'),
            (SELECT EXP_DESC from expense_trn WHERE EXP_CODE='".$selected."'), 
            CURDATE(),CURDATE(),       
            (SELECT EXP_CODE from expense_trn WHERE EXP_CODE='".$selected."'),        
            '".$_SESSION['user']."',
		  (SELECT PAYEE_DESC from expense_trn WHERE EXP_CODE='".$selected."'),
          (SELECT EXP_TYPE_CODE from expense_trn WHERE EXP_CODE='".$selected."')   		  
			)";
			
	   $sql2="UPDATE trn_seq SET LAST_VAL=NEXT_VAL,NEXT_VAL=NEXT_VAL+1";
	   $result2=mysqli_query($conect,$sql2);		
	
	   $result=mysqli_query($conect,$sql);
       
	}
	  
	
     header("Location: ../Expense.php");
		
	}	
			
			
			
  
 // echo $_SESSION['user'].$_SESSION['login'];
//$_SESSION['user']=$user;

mysqli_close($conect);




?>






