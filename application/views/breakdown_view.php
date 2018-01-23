<!DOCTYPE html>
<html>
  <head>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
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
          <div class="panel panel-primary">
          <div class="panel-heading">SELECT RECIPIENT CRITERIA</div>
          <div class="panel-body">
          <form class="form-inline" method="POST" action="<?php echo site_url('Welcome/breakdown_list');?>">
          <div class="form-group">
          <label for="email" style="margin-right:20px;margin-left:20px">Select Bus</label>
          <select class="form-control" name="busname" id="busname" required>
          <option style="display:none"></option>
          <?php foreach ($vehicle_name as $row) { ?>
          <option value="<?php echo $row['bus_Id']; ?>"><?php echo $row['name']; ?></option>
          <?php } ?>
          </select>
          </div>
          <div class="form-group">
          <label for="pwd" style="margin-right:10px;margin-left:25px">Date From</label>
          <input class="form-control" type="text" name="startdate" id="startdate" onchange="dateTo()" required />
          </div>
          <div class="form-group">
          <label for="pwd" style="margin-right:10px;margin-left:25px">Date To</label>
          <input class="form-control" type="text" name="enddate" id="end_datepicker" value="" required />
          </div>
          <button type="submit" id="getList" class="btn btn-primary pull-right">GET LIST</button>
          </form>
          </div>
          </div>
          <form method="POST">
          <div class="table-responsive">
          <div class="col-sm-6" style="height:40px;background-color:steelblue;color:white;margin-top:10px">
          <h4>DETAILS</h4>
          </div>
          <div class="col-sm-6" style="height:40px;background-color:steelblue;color:white;margin-top:10px">
          <button id="printx" class="btn btn-default pull-right" style="margin: 5px"  onclick="printData()"><span class="glyphicon glyphicon-print"> </span> print</button>
          </div>
          <table class="table table-bordered" id="docsTable" border="1" cellspacing="0"  style="text-align:center;color: black">
          <thead>
          <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus Id</td>
          <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus Name</td>
          <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Status</td>
          <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Date</td>
          </thead>
          <tbody>
          <?php $count; foreach ($breakdown_list as $row) { ?>
          <tr>
          <td><?php echo $row['bus_id']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <?php if ($row['status']==2) { ?>
          <td><?php echo "BREAKDOWN"; ?></td>
          <?php }else if($row['status']==1){ ?>
          <td><?php echo "NORMAL"; ?></td>
          <?php } ?>
          <td><?php echo date("d-m-Y",strtotime($row['last_updated'])); ?></td>
          </tr>
          <?php } ?>
          </tbody>
          </table>
          <ul class="pager pull-right">
          <li ><a href="#" id="prev">Previous</a></li>
          <li><a href="#" id="next">Next</a></li>
          </ul>
        
          </form>
          </div>
          </div>
          </div>
          <h5 style="margin-left:20px;text-align:center"><a href="http://www.valuetechsa.com/" target="_blank" style="color: black">copyright@VT</a></h5>
          </div>
              <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
              <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
              <script src="<?php echo base_url('Assets/Javascripts/script.js');?>"></script>
              <script type="text/javascript">
              function active(){$(".main-nav li").removeClass("active"),$("#breakdown1").addClass("active"),$("#breakdown").removeClass("sub-menu collapse"),$("#breakdown").addClass("sub-menu active")}$(document).ready(function(){appMaster.menuToggler(),appMaster.anotherFunction()}),$(document).ready(function(){$("#startdate").datepicker().datepicker("setDate",new Date),document.getElementById("startdate").value="<?php echo $_POST['startdate'];?>",$("#end_datepicker").datepicker(),document.getElementById("end_datepicker").value="<?php echo $_POST['enddate'];?>"}),document.getElementById("busname").value="<?php echo $_POST['busname'];?>";
              </script>
              <script type="text/javascript">
                function sort(a){_.hide(),_.filter(function(a){return a>=(pageNum-1)*max&&a<pageNum*max}).show(),$("#total").text("page "+pageNum+" of "+Math.ceil($("#docsTable .row").length/max))}function printData(){var a=document.getElementById("docsTable");newWin=window.open(""),newWin.document.write(a.outerHTML),newWin.print(),newWin.close()}var max=40,pageNum=0,_=$("#docsTable .row");$(document).ready(function(){_.length;$("#prev").click(function(){pageNum--,sort("prev")}),$("#next").click(function(){pageNum++,sort("next")}),$("#next").trigger("click")});
              </script>
  </body>
</html>