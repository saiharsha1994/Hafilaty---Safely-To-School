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

	input:focus:required:invalid {border: 2px solid red;}
	textarea:focus:required:invalid {border: 2px solid red;}
	select:focus:required:invalid {border: 2px solid red;}

    </style>
    
  
  </head>
  <body onload="active()">
  <div id="wrapper">
        <?php include 'sidebar.php' ?>
          <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">MANAGE BEHAVIOUR</strong></button>
                </div>
            </div>
        </section>

<div class="container">
  <div class="jumbotron">
	<div class="panel panel-default">
    <div class="panel-body">
      <button style="color:white;background:black" class="btn btn-primary pull-right" data-toggle="modal" data-target="#beh_myModal">
      <span class="glyphicon glyphicon-plus"></span>
     Add New Misbehaviour
   </button>
    </div>
  </div>
    <div class="panel panel-primary">
      <div class="panel-heading">STUDENTS MISBEHAVIOUR DETAILS</div>
      <div class="panel-body">
          <form class="form-inline" method="POST" action="<?php echo site_url('Welcome/student_misbehaviour_data');?>">
      <div class="form-group">
        <label for="email" style="margin-right:20px;margin-left:20px">Select Bus</label>
        <select class="form-control" name="busname" id="busname" onchange="EnableButtonList()">
		<option style="display:none"></option>
            <?php 
            $count;
            foreach ($bus_list as $row) {
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
   
    
          <button type="submit" id="getList" class="btn btn-primary pull-right"  disabled>GET LIST</button>
        </form>
      </div>
    </div>

    
    <form method="POST" action="<?php echo site_url('Welcome/sendingMsg');?>">
    <div class="table-responsive">
      <div class="col-sm-12" style="height:40px;background-color:steelblue;color:white;margin-top:10px">
        <h4>INDIVIDUAL SECTION</h4>
      </div>
      <table class="table table-bordered" id="docsTable" style="text-align:center">
          <thead>
               <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Date</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus ID</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Student </td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Details </td>
      
          </thead>
          <tbody>
              <?php 
              foreach ($misbehave as $row) {
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
      </div>
    </form>
    </div>
    

  <?php include 'modal_add_misbehave.php';?>
<h5 style="margin-left:20px;text-align:center">copyright@VT</h5>
</div>
</div>

   
</body>
 <!-- Bootstrap JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

       <!-- Bootstrap JavaScript -->
    <!-- Custom JavaScript -->
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/main.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/script.js');?>"></script>
    <!-- Call functions on document ready -->
    <script type="text/javascript">
    
  $(document).ready(function() {
            // Call Menu Toggler
            appMaster.menuToggler();
            // Example Call anotherFunction
            appMaster.anotherFunction();
        });

  function active(){
      var selector = '.main-nav li';
      $(selector).removeClass('active');
    $("#incidents").addClass('active');
    }

  function EnableButtonList() {

          document.getElementById("getList").disabled = false;
        }
document.getElementById('busname').value="<?php echo $_POST['busname'];?>";

</script>
</html>