<!DOCTYPE html>
<html>
  <head>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- font Awesome CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">

    <style type="text/css">
        .main-nav > li:hover{background-color:#1976d2;}
        li.active {background: #1976d2;}
        .jumbotron{background: white}
    </style>
    
  
  </head>
  <body onload="active()">
  <div id="wrapper">
        <?php include 'sidebar.php' ?>
          <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">VEHICLE DISTANCE</strong></button>
                </div>
            </div>
        </section>
<div class="container">
  <div class="jumbotron">
    <div class="panel panel-primary">
      <div class="panel-heading">SELECT RECIPIENT CRITERIA</div>
      <div class="panel-body">
          <form class="form-inline" method="POST" action="<?php echo site_url('Welcome/vehicle_distance');?>">
      <div class="form-group">
          <label for="email" style="margin-right:20px;margin-left:20px">Select Bus</label>
          <select class="form-control" name="busname" id="busname" onchange="EnableButtonList()">

      <option></option>
          <?php 

            $count;
            foreach ($vehicle_name as $row) {
              $count = 0;
              foreach ($row as $key => $value) {
                 $count++;
                 if ($count == 1) {
                     $v = $value;
                 }
                 if ($count == 2) {
                     ?>
                     <option value = "<?php echo $v; ?>"><?php echo $value; ?></option>
                     <?php
                 }
                 ?>
                 <?php
              }
              ?>
              <?php
            }
          ?>
      </select>
      </div>
          <div class="form-group">
          <label for="pwd" style="margin-right:10px;margin-left:25px">Date From</label>
          <input class="form-control" type="text" name="startdate" id="dt1"/>
          </div>

          <div class="form-group">
          <label for="pwd" style="margin-right:10px;margin-left:25px">Date To</label>
          <input class="form-control" type="text" name="enddate" id="dt2"/> 
          </div>
    
          <button type="submit" id="getList" class="btn btn-primary pull-right">GET LIST</button>
        </form>
      </div>
    </div>

    
    <form method="POST">
    <div class="table-responsive">
      <div class="col-sm-12" style="height:40px;background-color:steelblue;color:white;margin-top:10px">
        <h4>INDIVIDUAL SELECTION</h4>
      </div>
      <table class="table table-bordered" id="docsTable" style="text-align:center">
          <thead>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Date</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus Id</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus Name</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Plate Number</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus Distance</td>
      
          </thead>
          <tbody>
            <?php 
              //print_r($reports);
              foreach ($vehicle as $row) {
                ?>
                <tr>
                  <?php
                  foreach ($row as $key => $value) {
                     if ($value == null) {
                          ?>
                      <td><?php echo "--";?></td>
                      <?php
                     }
                     else{
                       ?>
                      <td><?php echo $value;?></td>
                      <?php
                     }
                  }
                  ?>
                </tr>
               <?php
              }

            ?>
          </tbody>
      </table>
    </form>
    </div>
  </div>
</div>
<h5 style="margin-left:20px;text-align:center">copyright@VT</h5>
</div>


    <!-- Bootstrap JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/script.js');?>"></script>
    <!-- Call functions on document ready -->

  <script type="text/javascript">
        $(document).ready(function () {
    
        $("#dt1").datepicker({
            dateFormat: "dd-mm-yy",
            //minDate: 0,

            onSelect: function (date) {
                var date2 = $('#dt1').datepicker('getDate');
                date2.setDate(date2.getDate() + 1);
                $('#dt2').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                $('#dt2').datepicker('option', 'minDate', date2);
            }

        });
        document.getElementById('dt1').value="<?php echo $_POST['startdate'];?>";
        $('#dt2').datepicker({
            dateFormat: "dd-mm-yy",
            onClose: function () {
                var dt1 = $('#dt1').datepicker('getDate');
                console.log(dt1);
                var dt2 = $('#dt2').datepicker('getDate');
                if (dt2 <= dt1) {
                    var minDate = $('#dt2').datepicker('option', 'minDate');
                    $('#dt2').datepicker('setDate', minDate);
                }
            }
        });
    });
    document.getElementById('dt2').value="<?php echo $_POST['enddate'];?>";
    document.getElementById('busname').value="<?php echo $_POST['busname'];?>";

  </script>
  </body>
</html>