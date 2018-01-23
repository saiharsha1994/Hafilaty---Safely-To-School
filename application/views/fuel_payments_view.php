
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
        .ajax-progress-throbber {
    display: none;
}

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
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">MANAGE FUEL</strong></button>
                </div>
            </div>
        </section>
<div class="container-fluid">

  <div class="jumbotron">
   <div class="panel panel-default">
    <div class="panel-body">
      <button style="color:white;background:black" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add_modal_form">
      <span class="glyphicon glyphicon-plus"></span>
     Add New Petty Cash
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
          <label for="pwd" style="margin-right:10px;margin-left:25px">Driver</label>
           <select class="form-control" type="text" name="driver" id="driver" style="color: black" />
              <option style="display: none;"></option>
                    <?php
                        foreach ($driver_list as $row) {
                     ?>
                        <option value = "<?php echo $row['driver_id']; ?>"><?php echo $row['name']; ?></option>
                      <?php
                     }
                    ?>
           </select>
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
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Driver</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Amount </td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Amount Spent </td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Balance </td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Invoice </td>
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
var total_files = '';
var x = 0;
var y = 0;
var z = 1;
$(document).ready(function() {
    var max_fields      = 100;
    var wrapper         = $(".container1");
    var add_button      = $(".add_form_field");
    
    /*x = 1;
    x = z;*/
    $(add_button).click(function(e){
        e.preventDefault();
        
        if($("#upload"+z).val() != '' || ($("#file"+z).val() != '')){
            //alert("file Uploaded")
            add_file_upload();
        }else{
            alert("Please Upload in Prevoius field!")
        }

        
  
    });

    function add_file_upload(){
        if(z < max_fields){
            //x++;
            z++;
            //alert(x)
            //$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="delete">Delete</a></div>'); 
            $(wrapper).append('<div class="form-group" id="upload_more'+z+'"><label class="control-label col-sm-3" for="report">Invoice Upload</label><div class="col-sm-7"><label class="btn btn-default btn-file"><input type="file" name="upload'+z+'" id="upload'+z+'" class="custom-file-input" onchange="fileinfo('+z+')" /><input type="input" name="file'+z+'" id="file'+z+'" class="form-control" /></label></div><button class="btn btn-danger delete"><i class="glyphicon glyphicon-remove"></i></button></div>');
        }
    }
  
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); z--;
    })
});

//************** ******************//
function fileinfo(id) 
{ 
//alert("File name has changed......") 
//alert(id) 
var x = document.getElementById("file"+id).value;
         //alert(x);
         if (x != '') {
          document.getElementById("file"+id).value = "";
         }
} 
//**********************************//
function add_file_fields(z1){

    for(var i=2; i<=z1; i++){
            //alert(x) 
            $(".container1").append('<div class="form-group" id="upload_more'+i+'"><label class="control-label col-sm-3" for="report">Invoice Upload</label><div class="col-sm-7"><label class="btn btn-default btn-file"><input type="file" name="upload'+i+'" id="upload'+i+'" class="custom-file-input" onchange="fileinfo('+i+')" /><input type="input" name="file'+i+'" id="file'+i+'" class="form-control" /></label></div><button class="btn btn-danger delete"><i class="glyphicon glyphicon-remove"></i></button></div>');
    }
    //x = z1;
}
//**********************************//

//function to clear all document fields added dynamically
  function clear_more(){
  
    for(var i = 2; i <= 100; i++){
    
       $( "#upload_more"+i ).remove();
    }
  
  }


function test_fun(){
  
  $.each($("input[type=file]"), function(i, obj) {
        $.each(obj.files,function(j,file){
        
           var file_data = file;
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    
                    $.ajax({
                        url: "<?php echo site_url('Welcome/upload_invoice')?>", // point to server-side controller method
                        dataType: 'text', // what to expect back from the server
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        async:false, 
                        success: function (response) {
                          //alert(response);
                          total_files += response+'~';
                          //alert(total_files);
                           
                        },
                        error: function (response) {
                            
                            //alert(response);
                        }
                    });
            
        })
        
      });
}

 var file_name;
 //var invoice;

 function add()
    {
      var url;
      url = "<?php echo site_url('Welcome/petty_add')?>";
     
       // ajax adding data to database
       var d_data=$('#add_form').serialize();
       //alert(d_data);
          $.ajax({
            url : url,
            type: "POST",
            data: d_data,
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#add_modal_form').modal('hide');
               //alert(data.file)
               /*$('#myModal').find('.modal-body').append('<p>Info. Updated Successfully.</p>');
               
*/
              //location.reload();// for reload a page
              myfun();
              $('#myModal').modal('show');

            },
            error: function ()
            {
                console.log(data);
            }
        });
}

function save(){

  test_fun();
  
     var url = "<?php echo site_url('Welcome/petty_update')?>";
    
      /*$.each($("input[type=file]"), function(i, obj) {
        $.each(obj.files,function(j,file){
          count++;
            var file1 = file.name+'~';
            file_names += file1
        })
        
      });*/

    total_files = total_files.slice(0, -1);
    var d_data=$('#form').serialize();
    formData = d_data+'&invoice_docs='+total_files+'&z='+z;
    //alert(formData);

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: formData,
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
               //alert(data.file)
              //location.reload();// for reload a page
              myfun();
              $('#myModal').modal('show');

            },
            error: function ()
            {
                console.log(data);
            }
        });

      total_files = '';
      clear_more();
      //clear_more(z);
}

  function delete_petty(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('Welcome/petty_delete')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               //location.reload();
               myfun();
               $('#myModalDel').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
  }
        
        
   /*$(document).ready(function (e) {
                $('#form input[type=file]').on('change', function () {
                    var file_data = $(this).prop('files')[0];
                    alert(file_data.name)
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    
                    $.ajax({
                        url: "<?php echo site_url('Welcome/upload_invoice')?>", // point to server-side controller method
                        dataType: 'text', // what to expect back from the server
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                          file_name = file_data.name;
                           // alert(file_name);
                           
                        },
                        error: function (response) {
                            file_name = file_data.name;
                            //alert(file_name);
                        }
                    });
                });
    });*/

var keep;

function xyz(){
  myfun();
}


function myfun(){
        $("#personDataTable").empty();
        var data = $('#getList').serialize();
        //alert(data)
        $.ajax({
      
        url : "<?php echo site_url('Welcome/fuel_ajax')?>/",
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

    var row = $("<tr />")
    //row.attr('id', id);

    $("#personDataTable").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
    //row.append($("<td>" + rowData.id + "</td>"));
    row.append($("<td>" + rowData.date + "</td>"));
    row.append($("<td>" + rowData.driver_name + "</td>"));
    row.append($("<td>" + rowData.amount_given + "</td>"));
    row.append($("<td>" + rowData.amount_spend + "</td>"));
    row.append($("<td>" + rowData.balance + "</td>"));
    
    if (rowData.invoice_doc != '') {
      row.append($("<td>" + '<a onclick="abcd('+rowData.id+')" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-download"></span> View Invoice</a>' + "</td>"));
    }
    else{
      row.append($("<td>" + "" + "</td>"));
    }
    row.append($("<td>" + rowData.btn + "</td>"));
    
}
   
    //*************** **************//
    function abcd(id)
    {
      $("#invoice_table").empty();
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('Welcome/get_invoices')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          
            
            drawTable1(data);

            $('#myInvoiceModal').modal('show'); // show bootstrap modal when complete loaded
      

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

    }

    function drawTable1(data) {

    for (var i = 0; i < data.length; i++) {

        drawRow1(data[i]);
    }
   }

function drawRow1(rowData) {

  
    var row = $("<tr />")

    $("#invoice_table").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
    row.append($("<td>" + rowData.invoice + "</td>"));

    row.append($("<td>" + '<button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url();?>uploads/petty_cash/'+rowData.invoice+'" download="'+rowData.invoice+'"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>' + "</td>"));

    /*row.append($("<td>" + '<a href="<?php echo base_url();?>uploads/petty_cash/'+rowData.invoice+'" download="'+rowData.invoice+'">Download </a>' + "</td>"));*/
    
}
//**************  ***************//

    var save_method; //for save method string
    var table;

    function add_petty()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_petty(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
     // console.log(id);
     //alert(id)
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('Welcome/petty_edit')?>/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          
            $('[name="pc_id"]').val(data.id);
            $('[name="driver_id"]').val(data.driver_id);
            $('[name="date"]').val(data.date);
            $('[name="driver_name"]').val(data.driver_name);
            $('[name="amount_given"]').val(data.amount_given);
            $('[name="amount_spend"]').val(data.amount_spend);

            var invoices = data.invoice_doc;
            var res = invoices.split("~");
            z = res.length;
            x = z;
            add_file_fields(z);
            for(var i = 0; i < z; i++) {
                var j = i + 1;
                $('[name="file'+j+'"]').val(res[i]);
                //alert(res[i])
            }

            //$('[name="file1"]').val(data.invoice_doc);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Petty'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

    }

    var selected_bus_id;
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

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="clear_more()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Petty Cash</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
          <input type="hidden" value="" name="pc_id"/>
          <input type="hidden" value="" name="driver_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-9">
                <input name="date" placeholder="date" id="date" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Driver</label>
              <div class="col-md-9">
                <input name="driver_name" placeholder="driver_name" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Amount</label>
              <div class="col-md-9">
                <input name="amount_given" placeholder="Amount" class="form-control" type="text">

              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Amount Spend</label>
              <div class="col-md-9">
                <input name="amount_spend" placeholder="Amount Spend" class="form-control" type="text">

              </div>
            </div>
             <div >
               <div class="container1">
                 <div class="form-group" id="upload_more1">
              <label class="control-label col-sm-3" for="report">Invoice Upload</label>
              <div class="col-sm-9">   
              <!-- <button class="form-control" id="doc1">
                <a ref="<?php echo base_url();?>index.php/Welcome/managebus_download/">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Invoice
                  </a>
              </button>  -->
                <label class="btn btn-default btn-file" >
                <input type="file" name="upload1" id="upload1" class="custom-file-input"onchange="fileinfo(1)"/>
                <input type="input" name="file1" id="file1" class="form-control" />
                </label>
              </div>
            </div>

               </div>
            <div class="col-sm-3"></div>
            <div class="col-md-9" style="margin-bottom: 10px;">
            <button class="btn btn-info add_form_field">Upload More Documents &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>

            </div>
            </div>
           
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clear_more()">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  <!-- <button class="btn btn-info custom">
    <a style="color:white" href="<?php echo base_url();?>index.php/Welcome/managebus_download/<?php echo $row;?> ">
    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>License</a>
  </button>

  <script type="text/javascript">
    row.append($("<td>" + rowData.invoice_doc + "</td>"));
    row.append($("<td>" + '<button class="btn btn-info custom"><a style="color:white" href="<?php echo base_url();?>index.php/Welcome/managebus_download/+rowData.invoice_doc "><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>License</a></button>' + "</td>"));

  </script>
 -->


  <!-- Bootstrap modal -->
  <div class="modal fade" id="add_modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Petty Cash</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="add_form" class="form-horizontal" enctype="multipart/form-data">
          <input type="hidden" value="" name="pc_id"/>
          <input type="hidden" value="" name="driver_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="datepicker" id="datepicker" required/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Driver</label>
              <div class="col-md-9">
                <select class="form-control" name="select_driver">
                    <option style="display: none;"></option>
                    <?php
                        foreach ($driver_list as $row) {
                     ?>
                        <option value = "<?php echo $row['driver_id']; ?>"><?php echo $row['name']; ?></option>
                      <?php
                     }
                    ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Amount</label>
              <div class="col-md-9">
                <input name="amount" placeholder="Amount" class="form-control" type="text">

              </div>
            </div>
           
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="add()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  <script type="text/javascript">
    $(document).ready(function() {
        $('#date').datepicker().datepicker('setDate',new Date());
//$( "#startdate" ).datepicker();


  </script>

 <div class="container">
 
  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        
        <div class="modal-body">
          <p>Info. Updated Successfully.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
 <div class="container">
 
  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div class="modal fade" id="myModalDel" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        
        <div class="modal-body">
          <p>Info. Deleted Successfully.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal for invoices download -->
<div class="container">
  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div class="modal fade" id="myInvoiceModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Invoice Download</h4>
        </div>
        <div class="modal-body">
          
    <div class="panel panel-primary" data-collapsed="0">
          <div class="panel-heading">
              <div class="panel-title" >Invoice
                
              </div>
            </div>
      <div class="panel-body">

      <div class="row">
            <table class="table-bordered table-striped table-condensed cf" cellspacing="5" width="100%">
                <thead>
                  <tr>                
                    <th>Invoice Name</th>
                    <th>Invoice</th>                                      
                  </tr>
                </thead>
                <tbody id="invoice_table">

                </tbody>        
            </table>
          <br><span>* Click Invoice to download!</span>
      </div> 
  </div>
        </div>
    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div><!-- end invoices modal -->
  </body>
</html>