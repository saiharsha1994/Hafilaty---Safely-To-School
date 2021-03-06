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
        .modal-dialog{
    overflow-y: initial !important
}
.table-responsive {
        overflow: visible;
    }
        .modal-body{
    height: 500px;
    overflow-y: auto;
}

    </style>
    
  
  </head>
  <body>
  <script type="text/javascript">
    $(window).load(function(){
        $('#driver_profile_view').modal('show');
    });
</script>
  <div id="wrapper">
        <?php include 'sidebar.php' ?>
          <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">MANAGE DRIVERS</strong></button>
                </div>
            </div>
        </section>
<div class="container-fluid">

  <div class="jumbotron">
   <div class="panel panel-default">
    <div class="panel-body">
      <button style="color:white;background:black" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
      <span class="glyphicon glyphicon-plus"></span>
     Add New Driver
   </button>
    </div>
  </div>

    
    <form method="POST" action="<?php echo site_url('Welcome/sendingMsg');?>">
    <div class="table-responsive">
      <div class="col-sm-12" style="height:40px;background-color:steelblue;color:white;margin-top:10px">
        <h4>INDIVIDUAL SELECTION</h4>
      </div>
      <table class="table table-bordered" id="docsTable" style="text-align:center">
          <thead>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Name</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Iqama Number</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Iqama Expiry Date</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Passport Number</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Passport Expiry Date</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">License Number</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Licence Expiry Date</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Mobile</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Options</td>
          </thead>
          <tbody>
              <?php 
                  $count = 1;
                  foreach ($names as $row) {
                          if($count === 1){?>
                          <tr>
                              <td ><?php echo $row; ?></td>
              <?php 
                          }
                          if($count === 2){?>
                              <td><?php
                              if($row){
                               echo $row;}
                               else{
                                echo "---";
                               } 

                               ?>
                              </td>
              <?php       }
                          if($count === 3){?>
                              <td><?php
                              if($row){
                               echo $row;}
                               else{
                                echo "---";
                               }

                                ?></td>
              <?php       }


                if($count === 4){?>
                              <td><?php
                              if($row){
                               echo $row;}
                               else{
                                echo "---";
                               }

                                ?></td>
              <?php       }

                if($count === 5){?>
                              <td><?php
                              if($row){
                               echo $row; 
                             }else{
                              echo "---";
                             }

                               ?></td>
              <?php       }

                if($count === 6){?>
                              <td><?php
                              if($row){
                               echo $row;}
                               else{
                                echo "---";
                               }

                                ?></td>
              <?php       }

              if($count === 7){?>
                              <td><?php 
                              if($row){
                              echo $row;}
                              else{
                                echo "---";
                              } 
                              ?></td>
              <?php       }

                if($count === 8){?>
                              <td><?php 
                              if($row){
                              echo $row; }
                              else{
                                echo "---";
                              }

                              ?></td>
              <?php       }

                          if ($count === 9) {
              ?>
                              <td>
                                <div class="btn-group" style="overflow:visible">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu" >
                                        
                                        <!-- PROFILE LINK -->
                                        <li>
                                        
                                            <a  href=""<?php echo site_url('Welcome/managedrivers1');?>">
                                                <i class="glyphicon glyphicon-user"></i>
                                                    profile<?php echo $names?>
                                                    <input type="hidden" name="pro" value="<?php echo $row;?>">
                                                </a>
                                              
                                        </li>
                    <!--  DELETION LINK -->
                          <li>
                                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/student/delete/<?php echo $row['student_id'];?>');">
                                                <i class="glyphicon glyphicon-trash"></i>
                                                    delete
                                            </a>
                    </li>
                                        
                                        <!--  EDITING LINK -->
                                        <li>
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_edit/<?php echo $row['student_id'];?>');">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                                    edit
                                                </a>
                                        </li>
                                    </ul>
                                </div>
                              </td>
              <?php
                  $count = 0;
                          }
                  $count++;
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

<?php include 'driver_profile.php' ?>

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
    $("#attendance").addClass('active');
    }
    </script>
    <script>
        $(document).ready(function() {
            // Call Menu Toggler
            appMaster.menuToggler();
            // Example Call anotherFunction
            appMaster.anotherFunction();
        });
$('#driver_profile_view').on('hidden.bs.modal', function () {
  window.location = "<?php echo site_url('Welcome/managedrivers');?>";
});
    </script>
  </body>
</html>