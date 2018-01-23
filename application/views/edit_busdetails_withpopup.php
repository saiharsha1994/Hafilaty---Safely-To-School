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
    .panel{
      border: 1px solid white;
    }
        .main-nav > li:hover{background-color:#1976d2;}
        li.active {background: #1976d2;}
        .jumbotron{background: white}
        .modal-dialog{
    overflow-y: initial !important
}
.popover.bottom .arrow:after {
  border-bottom-color: gray;
}

        .modal-body{
    height: 500px;
    overflow-y: auto;
}

.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: 'Choose File';
  display: inline-block;
  background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3);
  border: 1px solid #999;
  border-radius: 3px;
  padding: 5px 8px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  font-size: 10pt;
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}
input:focus:required:invalid {border: 2px solid red;}
select:focus:required:invalid {border: 2px solid red;}
.custom {
    width: 100px !important;

}
.table-responsive {
        overflow: visible;
    }
    </style>
  </head>
  <body onload="active()">
  <script type="text/javascript">
    $(window).load(function(){
        $('#model_busdetails_edit').modal('show');
    });
</script>
  <div id="wrapper">
        <?php  include 'sidebar.php';?>
        <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">MANAGE BUS</strong></button>
                </div>
            </div>
        </section>
    <div class="container-fluid">
        <div style="background:transparent !important" class="jumbotron">
        <div class="panel panel-default">
    <div class="panel-body">
      <button style="background:black;color:white" class="btn btn-default btn-md pull-right" data-toggle="modal" data-target="#myModal">
      <span class="glyphicon glyphicon-plus"></span>
     Add New Bus
   </button>
    </div>
  </div>
            <form method="" action="">
        <div class="table-responsive">
          <div class="col-sm-12" style="height:40px;background-color:steelblue;color:white">
            <h4>BUS DETAILS</h4>
          </div>
                    <table class="table table-bordered" id="docsTable" style="text-align:center">
            <thead>
            <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus Type</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus Name</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Plate Number</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">chassis_number</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">License</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">License-Expiry-Date</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">MVPI</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">MVPI Expiry Date</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Option</th>
            </thead>
            <tbody>
              <?php 
                $count = 1;
                $exp_count=0;
                $exp_count_type=0;
                $action_exp=0;
                foreach ($names as $row) {
                if($count === 1 && substr($row,9)==1){?>
                <tr data-toggle="popover" data-placement="bottom" data-content="<?php echo $expiry_type[$exp_count_type++];?> is going to Expire on <?php echo $expiry[$exp_count++]; $action_exp=1;?>" style="cursor:pointer;border-style:ridge;border-width: 2.3px 2.3px 2.3px 2.3px;border-color: red;">
                  <td data-title="Contract Date" ><?php echo substr($row,0,9);
                   ?></td>
              <?php }
              if($count === 1 && substr($row,9)==0){?>
                <tr>
                  <td data-title="Contract Date" ><?php echo substr($row,0,9); ?></td>
              <?php }
              if($count === 1 && substr($row,9)== -1){?>
                <tr data-toggle="popover" data-placement="bottom" data-content="SORRY!!! Already Expired" style="cursor:pointer;border-style:ridge;border-width: 2.3px 2.3px 2.3px 2.3px;border-color: red;">
                  <td data-title="Contract Date" ><?php echo substr($row,0,9);$action_exp=1;
                   ?></td>
              <?php }
                if($count === 2){?>
                  <td data-title="Bus Type"><?php 
                  if($row && $row != "null"){
                  echo $row; }
                  else{
                    echo "---";
                  }
                  ?>
                      </td>
                  <?php       
                  }

                if($count === 3){?>
                  <td data-title="Plate Number"><?php echo $row; ?>
                      </td>
                  <?php       
                  }

                if($count === 4){?>
                  <td data-title="Chassis Number"><?php
                  if($row!="null"){
                   echo $row; }
                   else{
                    echo "---";
                   }
                   ?>
                      </td>
                  <?php       
                  }
                  if($count === 5){?>
                      <td data-title="License Upload">
                      <?php
                      if($row!="null"){
                        ?>
                        <button class="btn btn-info custom">
                        <a style="color:white"
                        href="<?php echo base_url();?>index.php/Welcome/managebus_download/<?php echo $row;?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>License
                  </a>
                  </button>
                        <?php
                      
                       }else{
                        echo "---";
                       } 
                       ?>
                        
                      </td>
              <?php       }
                    if ($count === 6) {
              ?>
                      <td data-title="License Expiry Date">
                      <?php 
                      if($row !="null"){
                      echo $row;}
                      else{
                        echo "---";
                      }

                       ?>
                        
                      </td>
                    <?php }
                    if ($count === 7) {
              ?>
                      <td data-title="MVPI Upload">
                      <?php
                      if($row !="null"){
                        ?>
                        <button class="btn btn-info custom">
                        <a style="color:white"
                        href="<?php echo base_url();?>index.php/Welcome/managebus_download/<?php echo $row;?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>MVPI
                  </a>
                  </button>
                        <?php
                      
                       }else{
                        echo "---";
                       } 
                       ?>

                      </td>
                    <?php }
                     if ($count === 8) {
              ?>
                      <td data-title="MVPI-Expiry-Date">
                      <?php 
                      if($row !="null"){
                      echo $row; }
                      else{
                        echo "---";
                      }
                      ?>
                      </td>
                    <?php 
                    
                    }
                    if ($count === 9) {
                    ?>
                    <td data-title="Option">
                      <div class="btn-group" style="overflow:visible">
                      
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu" >
                    <!--  DELETION LINK -->
                          <li>
                                            <a href="<?php echo base_url();?>index.php/Welcome/del_contract_with_popup/<?php echo $row;?>">
                                                <i class="glyphicon glyphicon-trash"></i>
                                                    delete
                                            </a>
                    </li>
                                        
                                        <!--  EDITING LINK -->
                                        <li>
                                            <a href="<?php echo base_url();?>index.php/Welcome/edit_busdetails_with_popup/<?php echo $row;?>">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                                    edit
                                                </a>
                                        </li>
                                    </ul>
                                </div>
                    </td>
              <?php   
                $count=0;
                    }
                   
                $count++;
                    }
              ?>
               
            </tbody>
        </table>
      </form>
</div></div>
</div>
<h5 style="text-align:center">copyright@VT</h5>
</div>

<?php include 'model_busdetails_edit.php';?>

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
    $("#managebus").addClass('active');
    }
    </script>
    <script>
        $(document).ready(function() {
            // Call Menu Toggler
            appMaster.menuToggler();
            // Example Call anotherFunction
            appMaster.anotherFunction();
        });

        $(document).ready(function(){
          $(function(){
            $( "#datepicker2" ).datepicker();
              //Pass the user selected date format 
                  $( "#format" ).change(function() {
                  $( "#datepicker2" ).datepicker( "option", "dateFormat", $(this).val() );
                  });
          });
      });
             $(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
                    $('#model_busdetails_edit').on('hidden.bs.modal', function () {
  window.location = "<?php echo site_url('Welcome/managebus');?>";
});

            $("#userfile").change(function(){
        var elem = document.getElementById("doc");
       elem.parentNode.removeChild(elem);
    });     
     $("#userfile1").change(function(){
        var elem = document.getElementById("doc1");
       elem.parentNode.removeChild(elem);
    });    
    </script>
  </body>
</html>