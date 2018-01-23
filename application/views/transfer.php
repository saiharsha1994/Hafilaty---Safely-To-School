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
<button id="menuToggler" style="background-color:white;border-color:transparent"><span class="glyphicon glyphicon-list" style="color:#2196f3;margin-right:10px"></span><strong style="font-size:18px">TRANSFER</strong></button>
</div>
</div>
</section>
<div class="container">
<div class="jumbotron">
<div class="panel panel-primary">
<div class="panel-heading">SELECT CRITERIA</div>
<div class="panel-body">
<form class="form-inline" method="POST" action="<?php echo site_url('Welcome/managetransfer');?>">
<div class="col-sm-3">
<div class="form-group">
<label for="email">Transfer from Route:</label><br>
<select class="form-control" name="fromroute" onchange="EnableToRoute()">
<option></option>
<?php foreach ($h as $row) { ?>
<option><?php echo $row; ?></option>
<?php } ?>
</select>
</div></div>
<div class="col-sm-3">
<div class="form-group">
<label for="pwd">Transfer to Route:</label><br>
<select class="form-control" name="toroute" id="toroute" onchange="EnableType()" disabled>
<option></option>
<?php foreach ($h as $row) { ?>
<option><?php echo $row; ?></option>
<?php } ?>
</select>
</div></div>
<div class="col-sm-3">
<div class="form-group" style="align:center">
<label for="pwd">Student/Teacher:</label><br>
<select class="form-control" name="selectType" id="studentorteacher" onchange="EnableList()" disabled>
<option></option>
<option>Student selected</option>
<option>Teacher selected</option>
</select>
</div>
</div>
<div class="col-sm-3"><br>
<button type="submit" id="getList" class="btn btn-primary btn-md" disabled>MANAGE TRANSFER</button>
</div>
</form>
</div>
</div>
<form method="POST" action="<?php echo site_url('Welcome/transferselected');?>">
<div class="table-responsive">
<div class="col-sm-12" style="height:40px;background-color:steelblue;color:white">
<h4>INDIVIDUAL SELECTION</h4>
</div>
<table class="table table-bordered" id="docsTable" style="text-align:center">
<thead>
<th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">
<td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Type</td>
<td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Name</td>
<td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">ID</td>
<td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Location</td>
<td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Contact Details</td>
</th>
</thead>
<tbody>
<?php $count=1; $checkbox_count=1; foreach ($names as $row) { if($count===1){?>
<tr>
<td><input type="checkbox" onclick="EnableTransbtn()" name='checkbox[]' value='<?php echo $checkbox_count;?>' />&nbsp;</td>
<td><?php echo $row; ?>
<input type="hidden" name="Type" value='<?php echo $row; ?>'>
</td>
<?php } if($count===2){?>
<td><?php echo $row; ?>
</td>
<?php } if($count===3){?>
<td><?php echo $row; ?>
<input type="hidden" name="id[]" value='<?php echo $row; ?>'>
</td>
<?php $checkbox_count++; } if ($count===4) { ?>
<td><?php echo $row; ?>
</td>
<?php } if ($count===5) { ?>
<td><?php echo $row; ?></td>
</tr>
<?php $count=0; } $count++; } ?>
</tbody>
</table>
<button type="submit" id="transferbtn" class="btn btn-primary pull-right" disabled>TRANSFER SELECTED</button>
<?php $counter=1; foreach ($toroute as $row) { if($counter==1){ ?>
<input type="hidden" name="toroutehidden" value='<?php echo $row; ?>'>
<?php }else{ ?>
<input type="hidden" name="fromroutehidden" value='<?php echo $row; ?>'>
<?php } $counter++; } ?>
</form>
</div>
</div>
</div>
<h5 style="text-align:center"><a href="http://www.valuetechsa.com/" target="_blank" style="color: black">copyright@VT</a></h5>
</div>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <script type="text/javascript">
        function EnableTransbtn(){var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
      1==checkedOne?document.getElementById("transferbtn").disabled=!1:document.getElementById("transferbtn").disabled=!0;  }function EnableToRoute(){document.getElementById("toroute").disabled=!1}function EnableType(){document.getElementById("studentorteacher").disabled=!1}function EnableList(){document.getElementById("getList").disabled=!1}function active(){$(".main-nav li").removeClass("active"),$("#transferid").addClass("active")}$(document).ready(function(){appMaster.menuToggler(),appMaster.anotherFunction()});
    </script>
  </body>
</html>