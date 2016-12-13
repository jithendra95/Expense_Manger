<?php

function menu(){


echo '<nav class="navbar navbar-inverse">
     <div class="container-fluid">
     <div class="navbar-header">
	 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">My Expense</a>
    </div>
	<div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li><a href="Home.php">Home</a></li>
      <li><a href="Expense.php">Expense</a></li>
      <li><a href="Income.php">Income</a></li>
      <li><a href="Budget.php">Budgeting</a></li>
	  
    </ul>
	 <ul class="nav navbar-nav navbar-right">
	 <li><a href="PHP/Log_out.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
	 </ul>
    </div>
	</div>
    </nav>';


}

?>