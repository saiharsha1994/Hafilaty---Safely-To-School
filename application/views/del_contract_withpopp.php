<!DOCTYPE html>
<html>
  <head>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- font Awesome CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">

  </head>
  <body onload="active()">
  <script type="text/javascript">
    $(window).load(function(){
        $('#model_contract_del').modal('show');
    });
</script>
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
          <div class="col-sm-12" style="height:40px;background-color:steelblue;color:white">
            <h4>CONTRACT LIST</h4>
          </div>
                    <table class="table table-bordered" id="docsTable" style="text-align:center">
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
            <tbody>
              <?php 
                $count = 1;
                foreach ($names as $row) {
                if($count === 1){?>
                <tr>
                  <td data-title="Contract Date" ><?php echo $row; ?></td>
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
                      <td data-title="Expiry Date"><?php echo $row; ?></td>
                    <?php 
                    
                    }

                    if ($count === 8) {
                    ?>
                      <td data-title="document"><?php
                      if($row){
                        ?>
                        <button class="btn btn-info custom">
                        <a style="color:white"
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
                                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/student/delete/<?php echo $row['student_id'];?>');">
                                                <i class="glyphicon glyphicon-trash"></i>
                                                    delete
                                            </a>
                    </li>
                                        
                                        <!--  EDITING LINK -->
                                        <li>
                                            <a href="<?php echo base_url();?>index.php/Welcome/contract_with_popup/<?php echo $row;?>">
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

<?php include 'model_contract_del.php';?>
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

        $('#model_contract_del').on('hidden.bs.modal', function () {
  window.location = "<?php echo site_url('Welcome/contract');?>";
});
     
    </script>
  </body>
</html>