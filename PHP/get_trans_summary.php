<?php

require  'connection_new.php';

$cr_balance=0.00;
$dr_balance=0.00;
$opening_balance=0.00;
$opening_balance_color="";
$closing_balance_color="";
$closing_balance=0.00;
$total_cr_balance=0.00;
$total_dr_balance=0.00;


						
$get_monthly_balance="SELECT 
    
					(SELECT SUM(TRN_AMOUNT) 
					FROM main_trn 
					WHERE TRN_TYPE='CR' 
					AND ENT_USER='".$_SESSION['user']."' 
					AND MONTH(VALUE_DATE)=MONTH(CURDATE()) 
					AND YEAR(VALUE_DATE)=YEAR(CURDATE()))INCOME,
						
					(SELECT SUM(TRN_AMOUNT) 
					FROM main_trn 
					WHERE TRN_TYPE='DR' 
					AND ENT_USER='".$_SESSION['user']."'  
					AND MONTH(VALUE_DATE)=MONTH(CURDATE()) 
					AND YEAR(VALUE_DATE)=YEAR(CURDATE()))EXPENSE

					FROM DUAL";	

$get_total_balance="SELECT 
    
					(SELECT SUM(TRN_AMOUNT) 
					FROM main_trn 
					WHERE TRN_TYPE='CR' 
					AND ENT_USER='".$_SESSION['user']."'
					AND VALUE_DATE<=CURDATE()
					 )INCOME,
						
					(SELECT SUM(TRN_AMOUNT) 
					FROM main_trn 
					WHERE TRN_TYPE='DR' 
					AND ENT_USER='".$_SESSION['user']."' 
					AND VALUE_DATE<=CURDATE() 
					)EXPENSE

					FROM DUAL";							

					
						

$result=mysqli_query($conect,$get_monthly_balance);						
if (!$result) {
   die('Invalid query: ' . mysql_error());
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
if($row=mysqli_fetch_array($result)){

     $cr_balance=$row["0"];
	 $dr_balance=$row["1"];
	 }
	 
}	


$result=mysqli_query($conect,$get_total_balance);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
if($row=mysqli_fetch_array($result)){

     $total_cr_balance=$row["0"];
	 $total_dr_balance=$row["1"];
	 
	 
	 }
	 $opening_balance=($total_cr_balance-$cr_balance)-($total_dr_balance-$dr_balance);
	 if($opening_balance>0){
	 $opening_balance_color="color:#32CD32";
	 }else{
	 $opening_balance_color="color:#DC143C";
	 
	 }
	 
	 
} 
	
	 
	 
   $closing_balance=$opening_balance+($cr_balance)-($dr_balance);
if($closing_balance>=0){
	 $closing_balance_color="color:#32CD32";
	 }else{
	 $closing_balance_color="color:#DC143C";
	 
	 }
mysqli_close($conect);



function get_monthly_trn(){
require  'connection_new.php';

$get_month_trn="SELECT C.DESCR,C.DAY,C.AMOUNT,TYPE
                FROM(


                    SELECT (INC_DESC)DESCR,AMOUNT,(TRN_DAY)DAY,'CR' TYPE 
					FROM income_trn A
					WHERE USER='".$_SESSION['user']."'
                    
                 UNION ALL


                    SELECT (EXP_DESC)DESCR,AMOUNT ,(TRN_DAY)DAY,'DR' TYPE
					FROM expense_trn B
					WHERE USER='".$_SESSION['user']."'
                ) C ORDER BY TYPE,DAY";
	$result=mysqli_query($conect,$get_month_trn);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
while($row=mysqli_fetch_array($result)){

      
	  if($row["3"]=='CR')	{
		echo "<tr id='mon_trn_cr' >
              <td>".$row["0"]."</td><td>".$row["1"]."</td><td  align='right'>".number_format($row["2"],2)."</td>
	          </tr>";
		
		}else{
				
              echo "<tr id='mon_trn_dr' >
              <td>".$row["0"]."</td><td>".$row["1"]."</td><td  align='right'>".number_format($row["2"],2)."</td>
	          </tr>";
			  }
			  
	 }
	 
}	
		
mysqli_close($conect);
}


function get_trn_history(){

require  'connection_new.php';

$get_month_trn="SELECT TRN_DESC,TRN_TYPE,VALUE_DATE,TRN_AMOUNT
				FROM main_trn
				WHERE ENT_USER='".$_SESSION['user']."'
				ORDER BY TRN_DATE DESC
				LIMIT 07";


	$result=mysqli_query($conect,$get_month_trn);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
while($row=mysqli_fetch_array($result)){

      if($row["1"]=='CR'){
	    echo "<tr id='mon_bal_row' >
              <td>".$row["0"]."</td><td>Income</td><td>".$row["2"]."</td><td  align='right'>".number_format($row["3"],2)."</td>
	          </tr>";
	  
	  }else{
	     echo "<tr id='mon_bal_row' >
              <td>".$row["0"]."</td><td>Expense</td><td>".$row["2"]."</td><td  align='right'>".number_format($row["3"],2)."</td>
	          </tr>";
	  
	  }
	  
			  
	 }
	 
}	
		
mysqli_close($conect);
}


?>