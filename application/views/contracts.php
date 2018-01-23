<!DOCTYPE html>
<html>
  <head>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
    <link href="<?php echo base_url('Assets/CSS/sidebar.css')?>" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<style>
.panel{
      border: 1px solid white;
    }
        .main-nav > li:hover{background-color:#1976d2;}
        li.active {background: #1976d2;}
        .jumbotron{background: white}
        .modal-dialog{
    overflow-y: initial !important
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

        .modal-body{
    height: 500px;
    overflow-y: auto;
}
input:focus:required:invalid {border: 1px solid red;}
.custom {
    width: 120px !important;
}
.margin {
	margin: 3em;
}
.popover.bottom .arrow:after {
  border-bottom-color: gray;
}
</style>
  </head>
  <body onload="active()">
  <div id="wrapper">
        <?php  include 'sidebar.php';?>
        <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">CONTRACT</strong></button>
                </div>
            </div>
        </section>
    <div class="container-fluid">
        <div style="background:transparent !important" class="jumbotron">

        <div class="panel panel-default">
    <div class="panel-body">
      <button style="background:black;color:white;" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#myModal">
      <span class="glyphicon glyphicon-plus"></span>
     Add New Contract
   </button>
    </div>
  </div>
    
            <form method="POST">
        <div class="table-responsive">
          <div class="col-sm-12"  style="height:40px;background-color:steelblue;color:white">
            <h5>CONTRACT LIST</h5>
          </div>
                    <table class="table table-bordered" id="docsTable" style="text-align:center;padding: 10px" >
            <thead>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Contract Date</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Vendor Name</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Vendor Email</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Vendor Mobile</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus Provided</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Driver Provided</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Expiry Date</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Document</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Option</th>
            </thead>
           <tbody style="font-size: 12px;">
              <?php 
                $count = 1;
                $exp_count=0;
                foreach ($names as $row) {
                if($count === 1 && substr($row,10)==1){?>
                <tr data-toggle="popover" data-placement="bottom" data-content="contract is going to Expire on <?php echo $expiry[$exp_count++];
                ?>" style="cursor:pointer;border-style:ridge;border-width: 2.3px 2.3px 2.3px 2.3px;border-color: red;color: gray;font-size:12px">
                  <td data-title="Contract Date" ><?php echo substr($row,0,10);
                   ?></td>
              <?php }
              if($count === 1 && substr($row,10)==0){?>
                <tr>
                  <td data-title="Contract Date" ><?php echo substr($row,0,10); ?></td>
              <?php }
              if($count === 1 && substr($row,10)==-1){?>
                <tr data-toggle="popover" data-placement="bottom" data-content="sorry!!contract already Expired" style="font-size:12px;cursor:pointer;border-style:ridge;border-width: 2.0px 2.0px 2.0px 2.0px;border-color: red;color: gray">
                  <td data-title="Contract Date" ><?php echo substr($row,0,10);
                   ?></td>
              <?php }


                if($count === 2){?>
                  <td data-title="Vendor Name"><?php echo $row; ?>
                      </td>
                  <?php       
                  }
                  if($count === 3){?>
                      <td data-title="Vendor Email"><?php echo $row; ?></td>
              <?php       }
                    if ($count === 4) {
              ?>
                      <td data-title="Vendor Mobile"><?php echo $row; ?></td>
                    <?php }
                    if ($count === 5) {
              ?>
                      <td data-title="Bus Provided"><?php echo $row; ?></td>
                    <?php }

                     if ($count === 6) {
              ?>
                      <td data-title="Driver Provided"><?php echo $row; ?></td>
                    <?php }

                     if ($count === 7) {
              ?>

                      <td data-title="Expiry Date">
                      <?php
                      
                      echo $row; 
                      ?>
                        
                      </td>
                    <?php 
                    
                    }

                    if ($count === 8) {
                    ?>
                      <td data-title="document"><?php
                      if($row){
                        ?>
                        <button class="btn btn-info custom">
                        <a style="color:white;font-size: 12px"
                        href="<?php echo base_url();?>index.php/Welcome/contract_download/<?php echo $row;?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Document
                  </a>
                  </button>
                        <?php
                      
                       }else{
                        echo "---";
                       } 
                       ?></td>
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
                                            <a href="<?php echo base_url();?>index.php/Welcome/edit_contract_with_popup/<?php echo $row;?>">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                                    edit
                                                </a>
                                        </li>
                                    </ul>
                                </div>
                    </td>
                    </tr>
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
<?php  include 'model_contract_add.php' ;?>

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
    $("#contract").addClass('active');
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
    $('[data-toggle="popover"]').popover();   
});
$(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $( "#datepicker1" ).datepicker();
	//Pass the user selected date format 
    $( "#format" ).change(function() {
      $( "#datepicker1" ).datepicker( "option", "dateFormat", $(this).val() );
    });
  });

  
});


    </script>
  </body>
</html>