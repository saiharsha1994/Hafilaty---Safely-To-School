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
<button id="menuToggler" style="background-color:white;border-color:transparent"><span class="glyphicon glyphicon-list" style="color:#2196f3;margin-right:10px"></span><strong style="font-size:18px">MESSAGING</strong></button>
</div>
</div>
</section>
<div class="container">
<div class="jumbotron">
<div class="panel panel-primary">
<div class="panel-heading">SELECT RECIPIENT CRITERIA</div>
<div class="panel-body">
<form class="form-inline" method="POST" action="<?php echo site_url('Welcome/getStudentsorTeacher');?>">
<div class="form-group">
<label for="email" style="margin-right:20px;margin-left:50px">Select Route:</label>
<select class="form-control" name="route" onchange="EnableType()">
<option></option>
<?php foreach ($h as $row) { ?>
<option><?php echo $row; ?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label for="pwd" style="margin-right:20px;margin-left:50px">Student/Teacher:</label>
<select class="form-control" name="selectType" id="studentorteacher" onchange="EnableList()" disabled>
<option></option>
<option>Student selcted</option>
<option>Teacher selected</option>
</select>
</div>
<button type="submit" id="getList" class="btn btn-primary btn-md" disabled>GET LIST</button>
</form>
</div>
</div>
<form method="POST" action="<?php echo site_url('Welcome/sendingMsg');?>">
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
<td><input type="checkbox" onclick="enabletextarea()" name='checkbox[]' value='<?php echo $checkbox_count;?>' />&nbsp;</td>
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
<td><?php echo $row; ?></td>
<?php } if ($count===5) { ?>
<td><?php echo $row; ?></td>
</tr>
<?php $count=0; } $count++; } ?>
</tbody>
</table>
<div class="form-group">
<div class="col-sm-8" style="margin-top:20px">
<input type="hidden" name="arr_msg">
<textarea class="form-control" rows="5" name="comment" onkeyup="EnableSendButton()" id="comment" placeholder="write something here..." disabled></textarea>
</div>
<div class="col-sm-4" style="margin-top:50px">
<button type="submit" id="sendbutton" class="btn btn-default btn-block" style="background:#4da6ff;color:white" disabled>SEND MESSAGE</button>
</div>
</div>
</form>
</div></div>
</div>
<h5 style="text-align:center"><a href="http://www.valuetechsa.com/" target="_blank" style="color: black">copyright@VT</a></h5>
</div>
 <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>

    <script type="text/javascript">
    function enabletextarea(){
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
      1==checkedOne?document.getElementById("comment").disabled=!1:(document.getElementById("comment").disabled=!0,document.getElementById("sendbutton").disabled=!0);
    }function active(){$(".main-nav li").removeClass("active"),$("#messaging").addClass("active")}function EnableType(){document.getElementById("studentorteacher").disabled=!1}function EnableList(){
      document.getElementById("getList").disabled=!1}$(document).ready(function(){appMaster.menuToggler(),appMaster.anotherFunction()});function EnableSendButton(){document.getElementById("comment").value.length>0?document.getElementById("sendbutton").disabled=!1:document.getElementById("sendbutton").disabled=!0}
     
    </script>
  </body>
</html>