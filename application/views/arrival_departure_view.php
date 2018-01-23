<!DOCTYPE html>
<html>
  <head>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
 
 
  <title></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- font Awesome CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
     <script>
  $( function() {
    $( "#datepicker" ).datepicker();
    $( "#date" ).datepicker();
    $( "#datepicker1" ).datepicker();
    $( "#date1" ).datepicker();
  } );
  </script>
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
        .modal-body{
    overflow-y: auto;
}
input:focus:required:invalid {border: 2px solid red;}
  textarea:focus:required:invalid {border: 2px solid red;}
  select:focus:required:invalid {border: 2px solid red;}
    </style>
  </head>
  <body>
  <div id="wrapper">
        <?php include 'sidebar.php' ?>
          <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">MANAGE ARRIVAL/DEPARTURE</strong></button>
                </div>
            </div>
        </section>
<div class="container-fluid">

  <div class="jumbotron">
   <!-- <div class="panel panel-default">
    <div class="panel-body">
      <button style="color:white;background:black" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add_modal_form">
      <span class="glyphicon glyphicon-plus"></span>
     Add New Petty Cash
   </button>
    </div>
  </div> -->

  <div class="panel panel-primary">
      <div class="panel-heading">SELECT RECIPIENT CRITERIA</div>
      <div class="panel-body">
          <form class="form-inline" id="getList">
          
          <div class="form-group">
          <label for="pwd" style="margin-right:10px;margin-left:25px">Bus</label>
           <select class="form-control" type="text" name="bus" id="bus" style="color: black" />
              <option style="display: none;"></option>
                    <?php
                        foreach ($bus_list as $row) {
                     ?>
                        <option value = "<?php echo $row['bus_Id']; ?>"><?php echo $row['name']; ?></option>
                      <?php
                     }
                    ?>
           </select>
          </div>

          <div class="form-group">
          <label for="pwd" style="margin-right:10px;margin-left:25px">Date From</label>
          <input class="form-control" type="text" name="datepicker1" id="datepicker1"/>
          </div>

          <div class="form-group">
          <label for="pwd" style="margin-right:10px;margin-left:25px">Date To</label>
          <input class="form-control" type="text" name="date1" id="date1"/> 
          </div>
    
          <button type="button" id="getList11" onclick="xyz()" class="btn btn-primary pull-right">GET LIST</button>
        </form>
      </div>
    </div>

    <div class="table-responsive">
      <div class="col-sm-12" style="height:40px;background-color:steelblue;color:white;margin-top:10px">
        <h4>INDIVIDUAL SECTION</h4>
      </div>
      <table id="table_id" class="table table-bordered" id="docsTable" style="text-align:center">
           <thead>
           <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Date</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Pick-Up Start Time</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Pick-Up End Time</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Drop Start Time</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Drop Start Time</td>
          </thead>          
          <tbody id="personDataTable">

          </tbody>
      </table>
  
    </div>
  </div>
</div>

<h5 style="margin-left:20px;text-align:center">copyright@VT</h5>
</div>
   <!-- Bootstrap JavaScript//-->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

       <!-- Bootstrap JavaScript -->
    <!-- Custom JavaScript -->
    
    <script src="<?php echo base_url('Assets/Javascripts/main.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/script.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <!-- Call functions on document ready -->
  
 


<script src="js/jquery.ajax-progress.js"></script>
<script type="text/javascript">
        
  
function xyz(){
  myfun();
}


function myfun(){
        $("#personDataTable").empty();
        var data = $('#getList').serialize();
        //alert(data)
        $.ajax({
      
        url : "<?php echo site_url('Welcome/arrival_departure_ajax')?>/",
        type: "POST",
        data: data ,
        dataType: "JSON",
        success: function(data)
        {
             //alert(data[0].msg)
             if (data[0].msg == 'nodata') {
                 alert("No data found!")
             }else{
                  drawTable(data);
             }
             

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}
    function drawTable(data) {

    for (var i = 0; i < data.length; i++) {

        drawRow(data[i]);
    }
   }

function drawRow(rowData) {

  var id = rowData.id;
  
    var row = $("<tr />")
    $("#personDataTable").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
    //row.append($("<td>" + rowData.id + "</td>"));
    row.append($("<td>" + rowData.date + "</td>"));
    if (rowData.pickup_start_time == 0 || rowData.pickup_start_time == '') {
        row.append($("<td>" + "---" + "</td>"));
    }else{row.append($("<td>" + rowData.pickup_start_time + "</td>"));}

    if (rowData.pickup_end_time == 0 || rowData.pickup_end_time == '' ) {
      row.append($("<td>" + "---" + "</td>"));
    }else{row.append($("<td>" + rowData.pickup_end_time + "</td>"));}

    if (rowData.drop_start_time == 0 || rowData.drop_start_time == '' ) {
      row.append($("<td>" + "---" + "</td>"));
    }else{row.append($("<td>" + rowData.drop_start_time + "</td>"));}

    if (rowData.drop_end_time == 0 || rowData.drop_end_time == '' ) {
      row.append($("<td>" + "---" + "</td>"));
    }else{row.append($("<td>" + rowData.drop_end_time + "</td>"));}
    
}


        $(document).ready(function() {
            // Call Menu Toggler
            appMaster.menuToggler();
            // Example Call anotherFunction
            appMaster.anotherFunction();
        });

  function active(){
      var selector = '.main-nav li';
      $(selector).removeClass('active');
    $("#managedriver").addClass('active');
    }

  </script>

 
  <script type="text/javascript">
    $(document).ready(function() {
        $('#date').datepicker().datepicker('setDate',new Date());
//$( "#startdate" ).datepicker();


  </script>

 
  </body>
</htm 