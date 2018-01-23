<!DOCTYPE html>
<html>
  <head>
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<button id="menuToggler" style="background-color:white;border-color:transparent"><span class="glyphicon glyphicon-list" style="color:#2196f3;margin-right:10px"></span><strong style="font-size:18px">MANAGE LEAVE</strong></button>
</div>
</div>
</section>
<div class="container">
<div class="jumbotron">
<div class="panel panel-primary">
<div class="panel-heading">
LEAVE DECISION PENDING
</div>
<div class="panel panel-body">
<form class="form-inline">
<div class="form-group">
<label>Select Bus:</label>
<select class="form-control" ONCHANGE="change_bus(this)">
<option style="display:none"></option>
<?php foreach ($bus_list as $row) { ?>
<option value="<?php echo $row['bus_Id']; ?>"><?php echo $row['name']; ?></option>
<?php } ?>
</select>
</div>
</form>
</div>
</div>
<form method="POST">
<div class="table-responsive">
<div class="col-sm-12" style="height:40px;background-color:steelblue;color:white;margin-top:10px">
<h4>STUDENT LIST</h4>
</div>
<table class="table table-bordered" id="docsTable" style="text-align:center">
<thead>
<td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Name</td>
<td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">From Date</td>
<td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">To Date</td>
<td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Reason</td>
<td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Status
</td>
</thead>
<tbody id="personDataTable">
</tbody>
</table>
</form>
</div>
</div>
</div>
<h5 style="margin-left:20px;text-align:center"><a href="http://www.valuetechsa.com/" target="_blank" style="color:black">copyright@VT</a></h5>
</div>

    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/main.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/script.js');?>"></script>
 
    <script type="text/javascript">
        function active(){$(".main-nav li").removeClass("active"),$("#leave1").addClass("active"),$("#leave").removeClass("sub-menu collapse"),$("#leave").addClass("sub-menu active")}function change_bus(a){$("#personDataTable").empty(),leave_data(a.value)}function leave_data(a){selected_bus_id=a,$.ajax({url:"<?php echo site_url('Welcome/pending_leave_data')?>",type:"POST",data:{param0:a},dataType:"JSON",success:function(a){"nodata"==a[0].response?alert("No Leave request Found!"):drawTable(a)},error:function(a,b,c){alert("Error get data from ajax")}})}function drawTable(a){for(var b=0;b<a.length;b++)drawRow(a[b])}function drawRow(a){var c=(a.id,$("<tr />"));$("#personDataTable").append(c),c.append($("<td class=col-sm-2>"+a.student_name+"</td>")),c.append($("<td class=col-sm-2>"+a.from_date+"</td>")),c.append($("<td class=col-sm-2>"+a.to_date+"</td>")),c.append($("<td class=col-sm-4>"+a.reason+"</td>")),c.append($("<td class=col-sm-2>"+a.btn+"</td>"))}function changeStatus(a,b){var c="leave_id="+a+"&status_id="+b;$.ajax({url:"<?php echo site_url('Welcome/change_leave_status')?>/",type:"POST",data:c,success:function(a){$("#personDataTable").empty(),leave_data(selected_bus_id)},error:function(a,b,c){alert("Error get data from ajax")}})}var selected_bus_id;$(document).ready(function(){appMaster.menuToggler(),appMaster.anotherFunction()});
    </script>
  </body>
</html>