<?php 
session_start();

if ($_SESSION['login']!="1") {
header ("Location: index.php");
}

require 'PHP/menu.php';
require 'PHP/get_trans_summary.php';
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

<script src="jquery-1.11.2.min.js"></script>
<style>

#mon_bal{

margin-left:5%;

}
#mon_trn{

margin-left:5%;

}

#mon_bal_row:hover{

background-color:#FFFACD;

}
#mon_trn_cr{
background-color:#DDFBAB
}
#mon_trn_cr:hover{
background-color:#03DCD8
}


#mon_trn_dr{
background-color:#FCBBAC
}
#mon_trn_dr:hover{
background-color:#03DCD8
}

</style>

<script>
</script>

<title>Home</title>

</head>

<body>

<?php menu();?>
<div class="container-fluid">
<div  align='left'  class='row'> 
<div class='col-sm-1'> &nbsp </div>
<div class='col-sm-4'>
<table class="table table-striped" >
    <thead>
      <tr rowspan='2' style="background-color:#B0E0E6;">
	    <th colspan='2' >Monthly Balance</th>
      </tr>
    </thead>
	<tbody id='mon_pend_inc'>
	
     <tr id='mon_bal_row'>
       <td>Opening Balance</td><td style="<?php echo $opening_balance_color;?>;" align='right'><?php   echo number_format($opening_balance,2); ?></td>
	 </tr>
     <tr id='mon_bal_row'>	 
	   <td>Monthly Income</td><td style="color:#32CD32;" align='right'><?php  echo number_format($cr_balance,2); ?></td>
	 </tr>
     <tr id='mon_bal_row'>	 
	   <td>Monthly Expense</td><td style="color:#DC143C;" align='right'><?php   echo number_format($dr_balance,2); ?></td>
	 </tr> 
	 <tr id='mon_bal_row'>	 
	   <td>Closing Balance</td><td style="<?php echo $closing_balance_color;?>;" align='right'><?php   echo number_format($closing_balance,2); ?></td>
	 </tr>
	 
    </tbody>
	
</table>
</div>
<div class='col-sm-7'>

<table class="table table-striped" >
    <thead>
      <tr style="background-color:#B0E0E6;">
		 <th colspan='4'>Transactions History</th>
      </tr>
	   <tr style="background-color:#69C7D6;">
	   <th>Discription</th>
	   <th>Expense/Income</th>
	   <th>Transaction Date</th>
	   <th>Amount</th>
      </tr>
    </thead>
	<tbody id='mon_pend_inc'>
	
     <?php get_trn_history();?>
	 
    </tbody>
	
</table>

</div>

</div>

<div  align='left'  class='row'> 
<div class='col-sm-1'> &nbsp </div>
<div class='col-sm-4'>
<table class="table table-striped" >
    <thead>
      <tr style="background-color:#B0E0E6;">
	   <th colspan='3'>Monthly Transactions</th>
      </tr>
	  <tr style="background-color:#69C7D6;">
	   <th>Discription</th>
	   <th>Transaction Day</th>
	   <th>Amount</th>
      </tr>
    </thead>
	<tbody id='mon_pend_inc'>
	
     <?php get_monthly_trn();?>
	 
    </tbody>
	
</table>
</div>
<div class='col-sm-7'></div>
</div>
</div>
</body>