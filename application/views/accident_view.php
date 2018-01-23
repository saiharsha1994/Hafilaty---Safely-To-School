<!DOCTYPE>
<html>
  <head>

      <title></title>
      
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
@media screen and (min-width: 900px) {
.table-responsive{
        overflow: visible;
    }
}
input:focus:required:invalid {border: 2px solid red;}
  textarea:focus:required:invalid {border: 2px solid red;}
  select:focus:required:invalid {border: 2px solid red;}

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
    </style>
  </head>
  <body onload="active()" >
  <div id="wrapper">
        <?php include 'sidebar.php' ?>
          <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">MANAGE ACCIDENTS</strong></button>
                </div>
            </div>
        </section>
<div class="container-fluid">

  <div class="jumbotron" style="background:transparent !important">
   <div class="panel panel-default">
    <div class="panel-body">
      <button style="color:white;background:black" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal123">
      <span class="glyphicon glyphicon-plus"></span>
     Add New Accident
   </button>
    </div>
  </div>

    
    <form method="POST">
    <div class="table-responsive">
      <div class="col-sm-12" style="height:40px;background-color:steelblue;color:white;margin-top:10px">
        <h4>INDIVIDUAL SECTION</h4>
      </div>
      <table class="table table-bordered" id="docsTable" style="text-align:center">
           <thead>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Date</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Details </th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Report </th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Driver</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Fine Amount</th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Status </th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Document </th>
              <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Option</th>
            </thead>          
            <tbody>
            <?php 
              $count;
              foreach ($incident as $row) {
                $count = 0;
                ?>
                <tr>
                  <?php
                  foreach ($row as $key => $value) {
                    $count++;
                     if ($count == 7) {
                         if ($value == 1) {
                          ?>
                           <td><?php echo "Paid";?></td>
                          <?php
                         }
                         else{
                          ?>
                          <td><?php echo "Unpaid";?></td>
                          <?php
                         }
                     }
                     ///
                    else if($count == 3){
               
                         if ($value == null) {
                          ?>
                          <td><?php echo "--";?></td>
                         <?php
                         }
                         else{
                          ?>
                           <td>
        <button class="btn btn-info">
                        <a style="color:white"
                        href="<?php echo base_url();?>index.php/Welcome/manageaccident_download/<?php echo $value;?>">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>REPORT
                  </a>
                  </button>
        </td>
                          <?php
                         }
                    }
      else if($count == 8){
               
                         if ($value == null) {
                          ?>
                          <td><?php echo "--";?></td>
                         <?php
                         }
                         else{
                          ?>
                           <td>
        <button class="btn btn-info">
                        <a style="color:white"
                        href="<?php echo base_url();?>index.php/Welcome/manageaccident_download/<?php echo $value;?>">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>DOCUMENT
                  </a>
                  </button>
        </td>
                          <?php
                         }
                    }
                    else if($count == 9) {
                       ?>
                      <td data-title="Option" >
                        <div class="btn-group" style="overflow:visible">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-default pull-right" role="menu" >
                    <!--  DELETION LINK -->
                            <li>
                              <a href="#" data-record-id="<?php echo $value; ?>" data-toggle="modal" data-target="#myModal_delete"  name="delete" id=<?php echo $value; ?> title="Delete">
                                                <i class="glyphicon glyphicon-trash"></i>
                                                    delete
                                            </a>
                            </li>
                    <!--  EDITING LINK -->
                            <li>
                              <a href="<?php echo base_url();?>index.php/Welcome/edit_incident_with_popup/<?php echo $value;?>">
                              <i class="glyphicon glyphicon-pencil"></i> edit</a>
                            </li>
                            </ul>
                        </div>
                      </td>
                   <?php   
                       }
                     ////
                     else{
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

<!--Add model-->

<?php include 'modal_accident_add.php';?>
<?php include 'delete_popup.php';?>
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

</script>

<script type="text/javascript">
    
  $(document).ready(function(){
$(function(){
    $( "#datepicker2" ).datepicker();
    $( "#format" ).change(function() {
      $( "#datepicker2" ).datepicker( "option", "dateFormat", $(this).val() );
    });
  });
  
});

$('#myModal_delete').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            var data = 'ID=' +id;
            $.ajax({url: "<?php echo base_url(); ?>" + "index.php/Welcome/delete_accident_record", type: 'post',data: data,success: function(result){ 
          
          setTimeout(pageRefresh_new,1500);
        },
        error:function(){setTimeout(pageRefresh_new,1500);}
      });
           


        });
        $('#myModal_delete').on('show.bs.modal', function(e) {
            var data = $(e.relatedTarget).data();
            $('.btn-ok', this).data('recordId', data.recordId);
        });
 

</script>  


  </body>
</html>