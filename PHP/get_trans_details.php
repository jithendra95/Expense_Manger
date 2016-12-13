<?php
session_start();
require  'connection_new.php';
$chk_sql=$_POST['chk_sql'];
if($chk_sql=='income'){
$result=mysqli_query($conect,"SELECT INC_CODE,INC_DESC,AMOUNT 
					FROM income_trn A
					WHERE USER='".$_SESSION['user']."'
					AND INC_CODE NOT IN(
						
						SELECT INC_CODE 
						FROM main_trn
						WHERE INC_CODE=A.INC_CODE
						AND   MONTH(TRN_DATE)=MONTH(CURDATE())
						
						) 
						AND TRN_DAY<=DAYOFMONTH(CURDATE())"
						);}else{
						
						
$result=mysqli_query($conect,"SELECT EXP_CODE,EXP_DESC,AMOUNT 
					FROM expense_trn A
					WHERE USER='".$_SESSION['user']."'
					AND EXP_CODE NOT IN(
						
						SELECT INC_CODE 
						FROM main_trn
						WHERE INC_CODE=A.EXP_CODE
						AND   MONTH(TRN_DATE)=MONTH(CURDATE())
						
						) 
						AND TRN_DAY<=DAYOFMONTH(CURDATE())"
						);
						
						}
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
$i=0;
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
while($row=mysqli_fetch_array($result)){

      echo " <tr id='mon_pend_inc_row'> ";
	  echo"<td>".$row["0"]."</td>";
      echo " <td>".$row["1"]."</td>";
      echo " <td>".$row["2"]."</td>";
      echo" <td><input type='checkbox' value='".$row["0"]."' name='chk_trn[]'></td>";
      echo" </tr>"; 
	  $i++;
	 }
	 echo " <tr> ";
	 echo"<td><input type='submit' value='Process Transactions'></td>";
	 echo "<td><input type='hidden' value=".$i." name='numChk'></td>";
	 echo" </tr>"; 
/*}
else{

echo '<tr><td colspan="4" >No Pending Transactions</td></tr>';
}*/


}
mysqli_close($conect);


?>