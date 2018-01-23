
<!DOCTYPE html>
<html>
 <head>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
    <link href="<?php echo base_url('Assets/CSS/sidebar.css')?>" rel="stylesheet">
 </head>
 <body onload="active()">
   <div id="wrapper">
<?php include 'sidebar.php' ?>
<section class="main-section">
<div class="content">
<div class="form-group">
<button id="menuToggler" style="background-color:white;border-color:transparent"><span class="glyphicon glyphicon-list" style="color:#2196f3;margin-right:10px"></span><strong style="font-size:18px">DRIVER RATING</strong></button>
</div>
</div>
</section>
<div class="container">
<div class="jumbotron">
<div class="panel panel-primary">
<div class="panel-heading">DRIVER RATING</div>
<div class="panel-body">
<form class="form-inline" method="POST" action="<?php echo site_url('Welcome/calculaterating');?>">
<div class="form-group">
<label for="email" style="margin-right:20px;margin-left:50px">Select Month:</label>
<select class="form-control" name="month" onchange="EnableApply()">
<option></option>
<option> January </option>
<option> February </option>
<option> March </option>
<option> April </option>
<option> May </option>
<option> June </option>
<option> August </option>
<option> September </option>
<option> October </option>
<option> November </option>
<option> December </option>
</select>
</div>
<button type="submit" id="getList" class="btn btn-primary btn-md" disabled>APPLY</button>
</form>
</div>
</div>
<form method="POST">
<?php foreach ($m as $page){ if($page==1){ include 'defaultrating.php'; }else{ include 'ratingonclick.php'; } } ?>
</form>
</div></div>
<h5 style="text-align:center"><a href="http://www.valuetechsa.com/" target="_blank" style="color: black">copyright@VT</a></h5>
</div>
</div>
 <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <script type="text/javascript">
    function active(){$(".main-nav li").removeClass("active"),$("#driverrating").addClass("active")}function EnableApply(){document.getElementById("getList").disabled=!1}$(document).ready(function(){appMaster.menuToggler(),appMaster.anotherFunction()});
    </script>
  </body>
</html>