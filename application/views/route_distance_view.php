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
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">ROUTE DISTANCE</strong></button>
                </div>
            </div>
        </section>
<div class="container">
  <div class="jumbotron">
    <div class="panel panel-primary">
      <div class="panel-heading">SELECT RECIPIENT CRITERIA</div>
      <div class="panel-body">
          <form class="form-inline" method="POST" action="<?php echo site_url('Welcome/route_distance');?>">
      <div class="form-group">
          <label for="email" style="margin-right:20px;margin-left:20px">Select Route:</label>
          <select class="form-control" name="routename" id="routename" onchange="EnableButtonList()">
      <option></option>
          <?php 
            foreach ($h as $row) {
            ?>
                <option><?php echo $row; ?></option>
          <?php
                }
          ?>
      </select>
      </div>
   
    
          <button type="submit" id="getList" class="btn btn-primary pull-right"  disabled>GET LIST</button>
        </form>
      </div>
    </div>

    
    <form method="POST" action="<?php echo site_url('Welcome/sendingMsg');?>">
    <div class="table-responsive">
      <div class="col-sm-12" style="height:40px;background-color:steelblue;color:white;margin-top:10px">
        <h4>INDIVIDUAL SELECTION</h4>
      </div>
      <table class="table table-bordered" id="docsTable" style="text-align:center">
          <thead>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Route Name</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Trip Type</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus Name</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">No. of Stops</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Route Distance</td>
      
          </thead>
          <tbody>
            <?php 
              $count;
              foreach ($distance as $row) {
                $count = 0;
                ?>
                <tr>
                  <?php
                  foreach ($row as $key => $value) {
                    $count++;
                     if ($count == 2) {
                        if ($value == 1) {
                          ?>
                          <td><?php echo "Pickup";?></td>
                          <?php
                        }
                        else{
                         ?>
                         <td><?php echo "Drop";?></td>
                         <?php
                         }
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
    function active(){
      var selector = '.main-nav li';
      $(selector).removeClass('active');
    $("#reports").addClass('active');
    }
    </script>
    <script>
        $(document).ready(function() {
            // Call Menu Toggler
            appMaster.menuToggler();
            // Example Call anotherFunction
            appMaster.anotherFunction();
        });

        function EnableButtonList() {
          document.getElementById("getList").disabled = false;
        }
    </script>
  </body>
</html>