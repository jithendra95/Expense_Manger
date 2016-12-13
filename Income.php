<?php 
session_start();

if ($_SESSION['login']!="1") {
header ("Location: index.php");
}

require 'PHP/menu.php';
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

<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.datepick.css"> 
<script src="http://keith-wood.name/js/jquery.plugin.js"></script>
<script src="http://keith-wood.name/js/jquery.datepick.js"></script>

<!--
<script language="JavaScript" type = "text/javascript"  src = "JS/CreateClass.js" ></script>
<script language="JavaScript" type = "text/javascript"  src = "JS/ClassDetails.js" ></script>
-->
<style>

#mon_pend_inc_row{

background-color:#F0F8FF;

}

#mon_pend_inc_row:hover{

background-color:#FFFACD;

}

</style>


<script>


function mon_date_change()
{
data='<br/>';
data+="<div  class='col-sm-2' >Transaction Day *</div>";
data+="<div class='col-sm-10' >";

data+="<select name='trn_day'>";
for(i=1;i<=28;i++){
data+="<option value="+i+">"+i+"</option>";
}
data+="</select></div>";

data2='<br/>';
data2+="<div  class='col-sm-2' >Value Date *</div>";
data2+="<div class='col-sm-10' >";

data2+="<input type='text' name='trn_day' id='trn_day' placeholder='YYYY-MM-DD'>";
data+="</div>";

//data+='</span></div> </div>';
inm_type_val=document.form1.inc_type.value;
if(inm_type_val=='month'){
document.getElementById('mon_date_div').innerHTML=data;
//alert('mon');
}else if(inm_type_val=='day'){

document.getElementById('mon_date_div').innerHTML=data2;
$("#trn_day").datepick({dateFormat: 'yyyy-mm-dd'});

//alert('Test');
}else{
document.getElementById('mon_date_div').innerHTML='';
}

}

function submit_data(){
amount=document.form1.amount_txt.value;
trn_desc=document.form1.desc_txt.value;
//trn_date="none";
trn_type=document.form1.inc_type.value;
trn_date=document.form1.trn_day.value;

$.ajax({

type:'POST',
data:{amount:amount,trn_desc:trn_desc,trn_date:trn_date,trn_type:trn_type,chk_sql:"income"},
url:"PHP/save_transaction.php",
success:function(){
//alert(result);
alert('Income Save Sucessfully');
clear_data();
load_pending_trn();
//window.location.assign("");


//check_num();
}


     })
	 
	 
	 }
	 
	 function load_pending_trn(){
	 /*data=" <tr id='mon_pend_inc'> ";
	 data+= "<td>1</td>";
     data+= " <td>Tetster</td>";
     data+= " <td>1500.00</td>";
     data+= " <td><input type='checkbox' value='1'></td>";
     data+=" </tr>"; */
	 
	 $.ajax({

	type:'POST',
	data:{chk_sql:"income"},
	url:"PHP/get_trans_details.php",
	success:function(result){
	//alert(result);
	//alert('Completed');
	//window.location.assign("");
	document.getElementById("mon_pend_inc").innerHTML=result;
    }
     })
	 
	 
	 
	 }
	 
	 function clear_data(){
	 document.form1.amount_txt.value="";
     document.form1.desc_txt.value="";
     document.form1.inc_type.value="none";
	 
	 mon_date_change();
	 }
</script>

<title>Income</title>

</head>

<body onload='load_pending_trn()'>
<?php menu();?>

<form name='form1'>

<div class="container-fluid">

<fieldset>
<legend>Income Entry</legend>
<div  align='left'  class='row'> 
<br/>
<div class='col-sm-2'>Amount Earned *</div>
<div class='col-sm-8'><input type='text' class='input_field'  name='amount_txt' width='100px' >&nbsp
<input type='button'   name='submit_btn' width='100px' value='Submit' onclick='submit_data()' >
</div>

</div>

<div height='60px' align='left' class='row'> 
<br/>
<div  class='col-sm-2' >Income Discription *</div>
<div class='col-sm-10' ><input type='text' class='input_field'  name='desc_txt' ></div>
</div>

<div height='60px' align='left' class='row'> 
<br/>
<div  class='col-sm-2' >Income Type *</div>
<div class='col-sm-10' >
<select onchange='mon_date_change()' name='inc_type'>
<option value='none'>----Please Select-----</option>
<option value='day'>Current</option>
<option value='month'>Monthy</option>
</select>
</div>
</div>


<div height='60px' align='left' class='row' id='mon_date_div'> 
</div>


</fieldset>
<!--/table-->



<br/>
<br/>
<br/>

</form>


<form name='form2' action='PHP/save_pen_trans.php' method='POST'>

<input type="HIDDEN" value="income" name='chk_sql'>

<fieldset>
<legend>Pending Monthy Income </legend>

 <table class="table table-striped">
    <thead>
      <tr style="background-color:#B0E0E6;">
	    <th>No.</th>
        <th>Transaction Discription</th>
        <th>Amount</th>
        <th>Check</th>
      </tr>
    </thead>
	
	<tbody id='mon_pend_inc'>
	
    

	 </tr>
	 
    </tbody>
	
</table>
</fieldset>
<!--/table-->





</form>
</div>

</body>
</html>