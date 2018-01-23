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
    $( "#datepicker2").datepicker();
    $( "#date1").datepicker();
    
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

.modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}

/* Important part */

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
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">MANAGE ACCIDENTS</strong></button>
                </div>
            </div>
        </section>
<div class="container-fluid">

  <div class="jumbotron" style="background:transparent !important">
   <div class="panel panel-default">
    <div class="panel-body">
      <button type="button" style="color:white;background:black" class="btn btn-primary pull-right" onclick="add_petty()" >
      <span class="glyphicon glyphicon-plus"></span>
     Add New Accident
   </button>
    </div>
  </div>

  <div class="panel panel-primary">
      <div class="panel-heading">SELECT RECIPIENT CRITERIA</div>
      <div class="panel-body">
          <form class="form-inline" id="getList">
          <div class="form-group">
          <label for="pwd" style="margin-right:10px;margin-left:25px">Date From</label>
          <input class="form-control" type="text" name="datepicker1" id="datepicker1"/>
          </div>

          <div class="form-group">
          <label for="pwd" style="margin-right:10px;margin-left:25px">Date To</label>
          <input class="form-control" type="text" name="date1" id="date1"/> 
          </div>
       

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
    
          <button type="button" id="" onclick="get_list()" class="btn btn-primary pull-right">GET LIST</button>
        </form>
      </div>
    </div>

    <div class="table-responsive">
      <div class="col-sm-12" style="height:40px;background-color:steelblue;color:white;margin-top:10px">
        <h4>INDIVIDUAL SECTION</h4>
      </div>
      <table id="table_id" class="table table-bordered" id="docsTable" style="text-align:center">
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
          <tbody id="personDataTable">

          </tbody>
      </table>
  
    </div>
  </div>
</div>

<h5 style="margin-left:20px;text-align:center">copyright@VT</h5>
</div>



<?php include 'modal_add_fuel_payments.php'; ?>


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


  function edit_incident(id){

      $('#form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('Welcome/accident_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="incident_id"]').val(data.incident_id);
            $("#incident_bus option:selected").text(data.bus_name);
            $("#incident_bus option:selected").val(data.bus_id);
            $("#incident_driver option:selected").text(data.driver_name);
            $("#incident_driver option:selected").val(data.driver_id);
            $('[name="incident_date"]').val(data.date);
            $('[name="incident_details"]').val(data.details);
            $('[name="upload_report"]').val(data.report_upload);
            $('[name="fine_amt"]').val(data.fine_amount);
            $('[name="status"]').val(data.status);
            $('[name="upload_document"]').val(data.document_upload);

            $('#myModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Incident'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

  }

var total_files = '';

function test_fun(){
  
  $.each($("input[type=file]"), function(i, obj) {
        $.each(obj.files,function(j,file){
        
           var file_data = file;
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    
                    $.ajax({
                        url: "<?php echo site_url('Welcome/upload_incidents')?>", // point to server-side controller method
                        dataType: 'text', // what to expect back from the server
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        async:false, 
                        success: function (response) {
                          //alert(response.trim());
    
                          if (i == 0) {
                            $('[name="upload_report"]').val(response.trim());
                          }else if (i == 1) {
                            $('[name="upload_document"]').val(response.trim());
                          }
                           
                        },
                        error: function (response) {
                            
                            //alert(response);
                        }
                    });
            
        })
        
      });
}

var save_method; //for save method string
var table;

function add_petty(){
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#myModal').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

function save(){
  
  test_fun();
  var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('Welcome/incident_add')?>";
      }
      else
      {
        url = "<?php echo site_url('Welcome/incident_update1')?>";
      }

     
      var formData=$('#form').serialize();
      //alert(url);
      //alert(formData)
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            success: function(data)
            {
               //if success close modal and reload ajax table
               //alert(data.status)
               $('#myModal').modal('hide');
               alert("Added Successfully!")
              //location.reload();// for reload a page
                myfun();
                save_method = '';
            },
            error: function ()
            {
                alert("error adding data!!")
            }
        });
    }

  function delete_incident(id){

      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('Welcome/incident_delete')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               alert("Deleted Successfully!!")
               //location.reload();
               myfun();
               //$('#myModalDel').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
  }
        
//Listing filtered data in table
function get_list(){
  myfun(); 
}
    
function myfun(){
       
    $("#personDataTable").empty();
    var data = $('#getList').serialize();
    //alert(data)
    $.ajax({
      
        url : "<?php echo site_url('Welcome/incidents_ajax')?>/",
        type: "POST",
        data: data ,
        dataType: "JSON",
        success: function(data)
        {
             //alert(data[0].response)
             drawTable(data);
             

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('No data found!');
        }
    });

}

function drawTable(data) {

    for (var i = 0; i < data.length; i++) {

        drawRow(data[i]);
    }
   }

function drawRow(rowData) {

    var row = $("<tr />");

    $("#personDataTable").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
    row.append($("<td>" + rowData.date + "</td>"));
    row.append($("<td>" + rowData.details + "</td>"));

	<?php  $config = file_get_contents("Assets/configuration.txt"); ?>
    <?php  $path=  str_replace("index.php?web_services/","uploads/",$config); ?>
	
    //row.append($("<td>" + rowData.report_upload + "</td>"));
    row.append($("<td>" + '<button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url();?>index.php/Welcome/accident_download/"'+rowData.report_upload+'" download="'+rowData.report_upload+'"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>' + "</td>"));
    row.append($("<td>" + rowData.bus_name + "</td>"));
    row.append($("<td>" + rowData.driver_name + "</td>"));
    row.append($("<td>" + rowData.fine_amount + "</td>"));
    if (rowData.status == 1) {row.append($("<td>" + "Paid" + "</td>"));}
    else{row.append($("<td>" + "Unpaid" + "</td>"));}
    //row.append($("<td>" + rowData.document_upload + "</td>"));
	
	
    // row.append($("<td>" + '<button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url();?>uploads/accident/'+rowData.document_upload+'" download="'+rowData.document_upload+'"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>' + "</td>"));
    row.append($("<td>" + '<button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url();?>index.php/Welcome/accident_download/"'+rowData.document_upload+'" download="'+rowData.document_upload+'"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>' + "</td>"));
    row.append($("<td>" + rowData.btn + "</td>"));
    
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

  <!-- Add modal-->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;color:gray;margin:10px;font-family:verdana">ADMIN PORTAL SCHOOOLY</h4>
      </div>
      <div class="modal-body">
        <div class="panel panel-primary">
    <div class="panel-heading">
    <span class="glyphicon glyphicon-plus"></span>
    Add New Accident</div>
    <div class="panel-body" style="color:gray;font-size:12px">
      <form class="form-horizontal" id="form" method="" enctype="multipart/form-data" action="#">
      <div class="form-group">
      <label class="control-label col-sm-3" for="date">Date</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control datepicker" name="incident_date" id="datepicker2" required />
      </div>
      <div class="col-sm-2"></div>
    </div>
    <input type="hidden" name="incident_id" id="incident_id">
   <div class="form-group">
      <label class="control-label col-sm-3" for="Details">Details</label>
      <div class="col-sm-7">          
        <textarea type="text" class="form-control" name="incident_details" id="incident_details"></textarea>
      </div>
      <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="report">Upload Report</label>
      <div class="col-sm-7">   
  <label class="btn btn-default btn-file">
      <input type="file" name="upload_report1" id="upload_report1" class="custom-file-input" />
      <input type="input" name="upload_report" id="upload_report" class="form-control" />
      </div>
      <div class="col-sm-2"></div>
    </div>
   <div class="form-group">
      <label class="control-label col-sm-3" for="select_bus">Select Bus</label>
      <div class="col-sm-7">
      
          <select class="form-control" name="incident_bus" id="incident_bus">
                    <option style="" name="">Select Bus</option>
                    <?php
                        foreach ($bus_list as $row) {
                     ?>
                        <option value = "<?php echo $row['bus_Id']; ?>"><?php echo $row['name']; ?></option>
                      <?php
                      
                     }
                    ?>
          </select>
      </div>
     <div class="col-sm-2"></div>
   </div> 
    
    <div class="form-group">
      <label class="control-label col-sm-3" for="select_driver">Select Driver</label>
      <div class="col-sm-7">
          <select class="form-control" name="incident_driver" id="incident_driver">
                    <option style="">Select Driver</option>
                    <?php
                        foreach ($driver_list as $row) {
                     ?>
                        <option value = "<?php echo $row['driver_id']; ?>"><?php echo $row['name']; ?></option>
                      <?php
                     }
                    ?>
          </select>
      </div>
     <div class="col-sm-2"></div>
    </div> 
         <div class="form-group">
      <label class="control-label col-sm-3" for="fine_amt">Fine Amount</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="fine_amt" id="fine_amt" required>
      </div>
      <div class="col-sm-2"></div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-3" for="paid">Status</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="status" id="status" required>
      </div>
      <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Upload Document</label>
      <div class="col-sm-7">   
  <label class="btn btn-default btn-file">
      <input type="file" name="document_upload1" id="document_upload1" class="custom-file-input" />
      <input type="input" name="upload_document" id="upload_document" class="form-control" />
      </div>
      <div class="col-sm-2"></div>
    </div> 
    </div>
    <div class="panel-footer">
    <div class="form-group">        
        <button type="button" onclick="save()" class="btn btn-primary center-block">SUBMIT</button>
      </form>
    </div></div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Edit modal-->

  </body>
</html> 