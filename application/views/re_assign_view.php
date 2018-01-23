
<!DOCTYPE html>
<html>
  <head>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="<?php echo base_url('css/main.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('Assets/CSS/sidebar.css')?>" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  </head>
  <body onload="active()">
  <div id="wrapper">
<?php include 'sidebar.php' ?>
<section class="main-section">
<div class="content">
<div class="form-group">
<button id="menuToggler" style="background-color:white;border-color:transparent"><span class="glyphicon glyphicon-list" style="color:#2196f3;margin-right:10px"></span><strong style="font-size:18px">BREAKDOWN</strong></button>
</div>
</div>
</section>
<div class="container">
<div class="jumbotron">
<div class="col-sm-3" style=""></div>
<div class="col-sm-6" style="">
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">SELECT BUS TO RE-ASSIGN</h4>
</div>
<div class="modal-body">
<div class="panel panel-default" style="border:1px solid white;margin:40px">
<div class="panel-body">
<form class="form-horizontal" id="form" action="#">
<div class="form-group">
<label style="font-size:13px">From Bus</label>
<select class="form-control" name="bus_from" id="bus_from" value="">
<option style="display:none"></option>
<?php foreach ($bus_from as $row) { ?>
<option value="<?php echo $row['bus_Id']; ?>"><?php echo $row['name']; ?></option>
<?php } ?>
</select>
<span id="err1" style="color:#ff9900"></span>
</div>
<div class="form-group">
<label style="font-size:13px">To Bus</label>
<select class="form-control" name="bus_to" id="bus_to" value="">
<option style="display:none"></option>
<?php foreach ($bus_to as $row) { ?>
<option value="<?php echo $row['bus_Id']; ?>"><?php echo $row['name']; ?></option>
<?php } ?>
</select>
<span id="err2" style="color:#ff9900"></span>
</div>
<div class="form-group">
<button type="button" id="getList" onclick="transfer()" class="btn btn-warning pull-right">Transfer</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-sm-3" style=""></div>
</div>
</div>

<img src="http://www.valuetechsa.com/images/valuetech_logo_2.png" class="img-responsive center-block">
<div class="footer">
<h5 style="text-align:center"><a href="http://www.valuetechsa.com/" target="_blank" style="color:black">copyright@VT</a></h5>
</div>
</div>

    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/script.js');?>"></script>
    <script type="text/javascript">
    function active(){$(".main-nav li").removeClass("active"),$("#breakdown2").addClass("active"),$("#breakdown").removeClass("sub-menu collapse"),$("#breakdown").addClass("sub-menu active"),$("#myModal").modal("show")}function EnableButtonList(){document.getElementById("getList").disabled=!1}function transfer(){var a=document.getElementById("bus_from").value,b=document.getElementById("bus_to").value;if(a&&b){var d=$("#form").serialize();$.ajax({url:"<?php echo site_url('Welcome/bus_transfer_update')?>",type:"POST",data:d,dataType:"JSON",success:function(a){alert("successful"),window.location.href="<?php echo base_url() . 'index.php/Welcome/re_assign';?>"},error:function(){alert("Something went wrong!")}})}else document.getElementById("err1").innerHTML="value required",document.getElementById("err2").innerHTML="value required"}$(document).ready(function(){appMaster.menuToggler(),appMaster.anotherFunction()}),$(document).ready(function(){$("#startdate").datepicker().datepicker("setDate",new Date),document.getElementById("startdate").value="<?php echo $_POST['startdate'];?>",$("#end_datepicker").datepicker(),document.getElementById("end_datepicker").value="<?php echo $_POST['enddate'];?>"}),document.getElementById("busname").value="<?php echo $_POST['busname'];?>";
    </script>

   

  </body>
</html>