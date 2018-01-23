<!DOCTYPE html>

 <?php
         $driver_details = $this->db->get('driver_details')->result_array();
        
    ?>
<html>
  <head>
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
    <link href="<?php echo base_url('Assets/CSS/sidebar.css')?>" rel="stylesheet">
  </head>
  <body onload="active()">
  <div id="wrapper">
<?php include 'sidebar.php' ?>
<section class="main-section">
<div class="content">
<div class="form-group">
<button id="menuToggler" style="background-color:white;border-color:transparent"><span class="glyphicon glyphicon-list" style="color:#2196f3;margin-right:10px"></span><strong style="font-size:18px">LEAVE Request</strong></button>
</div>
</div>
</section>
<div class="container">
  <div class="jumbotron" >

  <ul class="nav nav-tabs" >
    <li class="active"><a data-toggle="tab" href="#home">Admin Leave</a></li>
    <li><a data-toggle="tab" href="#menu1">Drivers Leave</a></li>
    
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
                <div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">
            <form class="form-inline" action="" style="text-align: center;">
    <div class="form-group">
      <label for="email">From Date:</label>
      <input type="text" class="form-control" name="selected_date" id="datepicker" onchange="Enabletodate()" />
    </div>
    <div class="form-group">
      <label for="pwd">To Date:</label>
      <input type="text" class="form-control" name="selected_date" id="datepicker1" onchange="EnableButtonList()" disabled />

    </div>
    
    <button type="button" id="submit" class="btn btn-primary" onclick="call_ajax()" disabled>GET LIST</button>
     <button type="button" id="add_leave" class="btn btn-primary" data-toggle="modal" data-target="#myModal">ADD LEAVE</button>
  </form>
    </div>

    <div class="panel-footer">
        <table class="table table-bordered" id="docsTable" style="text-align:center">
          <thead>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">From Date</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">To Date</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Reason</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Status</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">option</td>
          </thead>
          <tbody id="personDataTable">
      </table>
    </div>
  </div>

    </div>

    <div id="menu1" class="tab-pane fade">
        <div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body" >
            <form class="form-inline" action="" style="text-align: center;">
    <div class="form-group">
      <label for="email">From Date:</label>
      <input type="text" class="form-control" name="datepicker_driver_view" id="datepicker_driver_view" onchange="Enabletodate_driver()" />
    </div>
    <div class="form-group">
      <label for="pwd">To Date:</label>
      <input type="text" class="form-control" name="datepicker_driver_view" id="datepicker1_driver_view" onchange="EnableDriver()" disabled />

    </div>

    <div class="form-group">
      <label for="email">Driver:</label>
          <select name="driver_name" id="driver_name_view" class="form-control" disabled onchange="Enablesubmit_driver()">
            <option value="0">Choose Driver</option>
               <?php foreach ($driver_details as $row):?>
                    <option value="<?php echo $row['driver_id'];?>"><?php echo $row['name'];?></option>
                <?php endforeach;?>
            </select>
    </div>
    
    <button type="button" id="submit_driver_view" class="btn btn-primary" onclick="call_ajax_driver()" disabled>GET LIST</button>
     <button type="button" id="add_leave" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">ADD LEAVE</button>
  </form>
    </div>

    <div class="panel-footer">
        <table class="table table-bordered" id="docsTable1" style="text-align:center">
          <thead>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">From Date</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">To Date</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Reason</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Status</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">option</td>
          </thead>
          <tbody id="personDataTable_driver">
      </table>
    </div>


  </div>
    </div>
   
  </div>
  </div>
</div>
</div>
<h5 style="margin-left:20px;text-align:center"><a href="http://www.valuetechsa.com/" target="_blank" style="color:black">copyright@VT</a></h5>
</div>

    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/main.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/script.js');?>"></script>
 
    <script type="text/javascript">
        function active(){$(".main-nav li").removeClass("active"),$("#leave_request").addClass("active")}function change_bus(a){$("#personDataTable").empty(),leave_data(a.value)}function leave_data(a){selected_bus_id=a,$.ajax({url:"<?php echo site_url('Welcome/pending_leave_data')?>",type:"POST",data:{param0:a},dataType:"JSON",success:function(a){"nodata"==a[0].response?alert("No Leave request Found!"):drawTable(a)},error:function(a,b,c){alert("Error get data from ajax")}})}function drawTable(a){for(var b=0;b<a.length;b++)drawRow(a[b])}function drawRow(a){var c=(a.id,$("<tr />"));$("#personDataTable").append(c),c.append($("<td class=col-sm-2>"+a.student_name+"</td>")),c.append($("<td class=col-sm-2>"+a.from_date+"</td>")),c.append($("<td class=col-sm-2>"+a.to_date+"</td>")),c.append($("<td class=col-sm-4>"+a.reason+"</td>")),c.append($("<td class=col-sm-2>"+a.btn+"</td>"))}function changeStatus(a,b){var c="leave_id="+a+"&status_id="+b;$.ajax({url:"<?php echo site_url('Welcome/change_leave_status')?>/",type:"POST",data:c,success:function(a){$("#personDataTable").empty(),leave_data(selected_bus_id)},error:function(a,b,c){alert("Error get data from ajax")}})}var selected_bus_id;$(document).ready(function(){appMaster.menuToggler(),appMaster.anotherFunction()});
        function Enabletodate(){
          document.getElementById('datepicker1').disabled=false;

        }


         function Enabletodate_driver(){
          document.getElementById('datepicker1_driver_view').disabled=false;

        }
        function EnableButtonList(){
           document.getElementById('submit').disabled=false;
        }
        function EnableDriver(){
          document.getElementById('driver_name_view').disabled=false;
          
        }
        function Enablesubmit_driver(){
          document.getElementById('submit_driver_view').disabled=false;
        }

        var global_to_date="";
        var global_from_date="";


        function call_ajax_driver(){
          var to_date=document.getElementById('datepicker1_driver_view').value;
          var from_date=document.getElementById('datepicker_driver_view').value;
          var driver_id=document.getElementById('driver_name_view').value;
          global_to_date=to_date;
          global_from_date=from_date;
          var c = "to_date=" + to_date + "&from_date=" + from_date+"&driver_id="+driver_id;
           $.ajax({
         url: "<?php echo site_url('Welcome/driver_leave_view')?>/",
         type: "POST",
         data: c,
         dataType:"JSON",
         success: function(a) {
              $("#personDataTable_driver").empty()
             "nodata" == a[0].response ? alert("No Leave request Found!") : drawTable_driver(a)
         },
         error: function(a, b, c) {
             alert("Error get data from ajax")
         }
     });
        }

function drawTable_driver(a) {
    for (var b = 0; b < a.length; b++) drawRow_driver(a[b])
}

function drawRow_driver(a) {

    var c = (a.id, $("<tr />"));
    if(a.status==1){
      a.status="Waiting";
      a.btn="<div style=overflow:visible><button type=button class=btn btn-default>"+"Action"+"<span class=glyphicon glyphicon-pause></span></button></div>";
    }
    if(a.status==2){
      a.status="<p style=color:green;font-size:15px>Approved</p>";
       a.btn="<div style=overflow:visible><button type=button class=btn btn-default>"+"Action"+"<span class=glyphicon glyphicon-pause></span></button></div>";
    }
      if(a.status==3){
      a.status="<p style=color:red;font-size:15px>Rejected</p>";
    }
   
    $("#personDataTable_driver").append(c), c.append($("<td class=col-sm-2>" + a.from_date + "</td>")), c.append($("<td class=col-sm-2>" + a.to_date + "</td>")), c.append($("<td class=col-sm-4>" + a.reason + "</td>")), c.append($("<td class=col-sm-2>" + a.status + "</td>")),c.append($("<td class=col-sm-2>" + a.btn + "</td>"));
}


        function call_ajax(){
          var to_date=document.getElementById('datepicker1').value;
          var from_date=document.getElementById('datepicker').value;
          global_to_date=to_date;
          global_from_date=from_date;
          var c = "to_date=" + to_date + "&from_date=" + from_date;
           $.ajax({
         url: "<?php echo site_url('Welcome/admin_leave_view')?>/",
         type: "POST",
         data: c,
         dataType:"JSON",
         success: function(a) {
          $("#personDataTable").empty();
             "nodata" == a[0].response ? alert("No Leave request Found!") : drawTable(a)
         },
         error: function(a, b, c) {
             alert("Error get data from ajax")
         }
     });
        }

    function drawTable(a) {
    for (var b = 0; b < a.length; b++) drawRow(a[b])
}

function drawRow(a) {

    var c = (a.id, $("<tr />"));
    if(a.status==1){
      a.status="Waiting";
      a.btn="<div style=overflow:visible><button type=button class=btn btn-default>"+"Action"+"<span class=glyphicon glyphicon-pause></span></button></div>";
    }
    if(a.status==2){
      a.status="<p style=color:green;font-size:15px>Approved</p>";
       a.btn="<div style=overflow:visible><button type=button class=btn btn-default>"+"Action"+"<span class=glyphicon glyphicon-pause></span></button></div>";
    }
      if(a.status==3){
      a.status="<p style=color:red;font-size:15px>Rejected</p>";
    }
   
    $("#personDataTable").append(c), c.append($("<td class=col-sm-2>" + a.from_date + "</td>")), c.append($("<td class=col-sm-2>" + a.to_date + "</td>")), c.append($("<td class=col-sm-4>" + a.reason + "</td>")), c.append($("<td class=col-sm-2>" + a.status + "</td>")),c.append($("<td class=col-sm-2>" + a.btn + "</td>"));
}

        function ajax_submit_add(){
          var from_date=document.getElementById('datepicker2').value;

           if(from_date== '')
    {
        alert("Please Select from_date!");
        return;
    }
          var to_date=document.getElementById('datepicker3').value;

           if(to_date== '')
    {
        alert("Please Select To_Date!");
        return;
    }
          var text_area=document.getElementById('text_area').value;
          
          var c = "to_date=" + to_date + "&from_date=" + from_date+"&text_area="+text_area;
                 $.ajax({
         url: "<?php echo site_url('Welcome/admin_leave_add')?>/",
         type: "POST",
         data: c,
         success: function(a) {
          alert('Applied Successfully');
             $('#myModal').modal('hide');
         },
         error: function(a, b, c) {
             alert("Error get data from ajax")
         }
     });
        }




        function ajax_submit_add_driver(){
          var from_date=document.getElementById('datepicker_driver').value;

           if(from_date== '')
    {
        alert("Please Select from_date!");
        return;
    }
          var to_date=document.getElementById('datepicker3_driver').value;

           if(to_date== '')
    {
        alert("Please Select To_Date!");
        return;
    }
          var text_area=document.getElementById('text_area_Reason').value;
          var driver_id=document.getElementById('driver_name').value;
                 if(driver_id== ''|| driver_id==0)
    {
        alert("Please Select Driver!");
        return;
    }
          
          var c = "to_date=" + to_date + "&from_date=" + from_date+"&text_area="+text_area+"&driver_id="+driver_id;
                 $.ajax({
         url: "<?php echo site_url('Welcome/admin_leave_add_driver')?>/",
         type: "POST",
         data: c,
         success: function(a) {
          //alert(a);
          alert('Applied Successfully');
             $('#myModal2').modal('hide');
         },
         error: function(a, b, c) {
             alert("Error get data from ajax")
         }
     });
        }

        function changemodal(data){
              var to_date=global_to_date;
          var from_date=global_from_date;
        
          var c = "to_date=" + to_date + "&from_date=" + from_date;
           $.ajax({
         url: "<?php echo site_url('Welcome/admin_leave_view')?>/",
         type: "POST",
         data: c,
         dataType:"JSON",
         success: function(a) {
          
         "nodata" == a[0].response ? alert("No Leave request Found!") : drawTable1(a,data)
             
         },
         error: function(a, b, c) {
             alert("Error get data from ajax")
         }
     });

            
        }

        function changemodal_driver(data){
         
              var to_date=global_to_date;
          var from_date=global_from_date;
          //alert(to_date);
          var row_id=document.getElementById('row_id_driver').value;
          
        
          var c = "to_date=" + to_date + "&from_date=" + from_date+"&driver_id="+data;
           $.ajax({
         url: "<?php echo site_url('Welcome/driver_leave_view')?>/",
         type: "POST",
         data: c,
         dataType:"JSON",
         success: function(a) {
          //alert(a);
         "nodata" == a[0].response ? alert("No Leave request Found!") : drawTable1_driver(a,row_id)
             
         },
         error: function(a, b, c) {
             alert("Error get data from ajax")
         }
     });

            
        }


            function drawTable1_driver(a,data) {
    for (var b = 0; b < a.length; b++) drawRow1_driver(a[b],data)
}


    function drawRow1_driver(a,data) {

 if(a.id==data){
    //$('#myModal').modal('hide');
    //document.getElementById('datepickerx').innerHTML=a.from_date;
    $('#text_areax_driver_modal').text(a.reason);
    $('#row_id_driver').val(a.id);
     $('#student_id_driver').val(a.student_id);
    $('#reject_reason_driver_modal').text(a.reject_reason);
    var date = new Date(a.from_date);
    $('#datepicker5_driver').datepicker('setDate', (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear());
    var date = new Date(a.to_date);
    $('#datepicker4_driver').datepicker('setDate', (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear());
   // $('#text_area').html(a.reason);

   $('#myModal_new_driver').modal('show');

 }
   
}

            function drawTable1(a,data) {
    for (var b = 0; b < a.length; b++) drawRow1(a[b],data)
}

function drawRow1(a,data) {

 if(a.id==data){

    //$('#myModal').modal('hide');
    //document.getElementById('datepickerx').innerHTML=a.from_date;
    $('#text_areax').text(a.reason);
    $('#row_id').val(a.id);
    $('#reject_reason').text(a.reject_reason);
     var date = new Date(a.from_date);
    $('#datepicker5').datepicker('setDate', (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear());
    var date = new Date(a.to_date);
    $('#datepicker4').datepicker('setDate', (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear());
   // $('#text_area').html(a.reason);

   $('#myModal_new').modal('show');

 }
   
}


function ajax_submit_add_new_driver(){
          var from_date=document.getElementById('datepicker5_driver').value;

           if(from_date== '')
    {
        alert("Please Select from_date!");
        return;
    }
          var to_date=document.getElementById('datepicker4_driver').value;

           if(to_date== '')
    {
        alert("Please Select To_Date!");
        return;
    }
          var text_area=document.getElementById('text_areax_driver_modal').value;
          var text_reject=document.getElementById('reject_reason_driver_modal').value;
          var id=document.getElementById('row_id_driver').value;
          var student_id=document.getElementById('student_id_driver').value;
          
          
          var c = "to_date=" + to_date + "&from_date=" + from_date+"&text_area="+text_area+"&text_reject="+text_reject+"&id="+id+"&student_id="+student_id;
                 $.ajax({
         url: "<?php echo site_url('Welcome/driver_leave_add_new')?>/",
         type: "POST",
         data: c,
         success: function(a) {
          
          alert('Re-applied Successfully');
             $('#myModal_new_driver').modal('hide');
         },
         error: function(a, b, c) {
             alert("Error get data from ajax")
         }
     });
        }


function ajax_submit_add_new(){
          var from_date=document.getElementById('datepicker5').value;

           if(from_date== '')
    {
        alert("Please Select from_date!");
        return;
    }
          var to_date=document.getElementById('datepicker4').value;

           if(to_date== '')
    {
        alert("Please Select To_Date!");
        return;
    }
          var text_area=document.getElementById('text_areax').value;
          var text_reject=document.getElementById('reject_reason').value;
          var id=document.getElementById('row_id').value;
          
          
          var c = "to_date=" + to_date + "&from_date=" + from_date+"&text_area="+text_area+"&text_reject="+text_reject+"&id="+id;
                 $.ajax({
         url: "<?php echo site_url('Welcome/admin_leave_add_new')?>/",
         type: "POST",
         data: c,
         success: function(a) {
          
          alert('Re-applied Successfully');
             $('#myModal_new').modal('hide');
         },
         error: function(a, b, c) {
             alert("Error get data from ajax")
         }
     });
        }




       $(window).load(function(){
        $('#myModal_new').modal('hide');
    });


       $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $( "#datepicker4" ).datepicker();
  //Pass the user selected date format 
    $( "#format" ).change(function() {
      $( "#datepicker4" ).datepicker( "option", "dateFormat", $(this).val() );
    });
  });
  
});

              $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $( "#datepicker5" ).datepicker();
  //Pass the user selected date format 
    $( "#format" ).change(function() {
      $( "#datepicker5" ).datepicker( "option", "dateFormat", $(this).val() );
    });
  });
  
});

              $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $( "#datepicker5_driver" ).datepicker();
  //Pass the user selected date format 
    $( "#format" ).change(function() {
      $( "#datepicker5_driver" ).datepicker( "option", "dateFormat", $(this).val() );
    });
  });
  
});


              $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $( "#datepicker4_driver" ).datepicker();
  //Pass the user selected date format 
    $( "#format" ).change(function() {
      $( "#datepicker4_driver" ).datepicker( "option", "dateFormat", $(this).val() );
    });
  });
  
});

                            $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $( "#datepicker_driver_view" ).datepicker();
  //Pass the user selected date format 
    $( "#format" ).change(function() {
      $( "#datepicker_driver_view" ).datepicker( "option", "dateFormat", $(this).val() );
    });
  });
  
});

                                                      $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $( "#datepicker1_driver_view" ).datepicker();
  //Pass the user selected date format 
    $( "#format" ).change(function() {
      $( "#datepicker1_driver_view" ).datepicker( "option", "dateFormat", $(this).val() );
    });
  });
  
});

              


 

    </script>


<!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;font-size: 15px"><span class="glyphicon glyphicon-plus"></span> ADD LEAVE <span class="glyphicon glyphicon-plus"></span></h4>
        </div>
        <div class="modal-body" style="font-size: 15px">

        <form class="form-horizontal" action="/action_page.php" style="font-size: 15px;margin-top: 10px">
    <div class="form-group">
      <label class="control-label col-sm-3" for="email">From Date:</label>
      <div class="col-sm-6">
        <input type="date" class="form-control" name="datepicker_driver" id="datepicker_driver" required />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="pwd">To Date:</label>
      <div class="col-sm-6">          
      <input type="date" class="form-control" name="datepicker3_driver" id="datepicker3_driver"  required />
      </div>
    </div>
     
    <div class="form-group">
      <label class="control-label col-sm-3" for="pwd">Driver:</label>
      <div class="col-sm-6">          
       
            <select name="driver_name" id="driver_name" class="form-control">
            <option value="0">Choose Driver</option>
               <?php foreach ($driver_details as $row):?>
                    <option value="<?php echo $row['driver_id'];?>"><?php echo $row['name'];?></option>
                <?php endforeach;?>
            </select>
        
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-3" for="pwd">Reason:</label>
      <div class="col-sm-6">          
      <textarea class="form-control custom-control" rows="3" id="text_area_Reason" style="resize:none"></textarea>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-3 col-sm-6 text-center" >
        <button type="button" class="btn btn-primary" onclick="ajax_submit_add_driver()">Submit</button>
      </div>
    </div>
  </form>
    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>




    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;font-size: 15px"><span class="glyphicon glyphicon-plus"></span> ADD LEAVE <span class="glyphicon glyphicon-plus"></span></h4>
        </div>
        <div class="modal-body" style="font-size: 15px">

        <form class="form-horizontal" action="/action_page.php" style="font-size: 15px;margin-top: 10px">
    <div class="form-group">
      <label class="control-label col-sm-3" for="email">From Date:</label>
      <div class="col-sm-6">
        <input type="date" class="form-control" name="selected_date2" id="datepicker2" required />
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="pwd">To Date:</label>
      <div class="col-sm-6">          
      <input type="date" class="form-control" name="selected_date3" id="datepicker3"  required />
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-3" for="pwd">Reason:</label>
      <div class="col-sm-6">          
      <textarea class="form-control custom-control" rows="3" id="text_area" style="resize:none"></textarea>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-3 col-sm-6 text-center" >
        <button type="button" class="btn btn-primary" onclick="ajax_submit_add()">Submit</button>
      </div>
    </div>
  </form>
    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>




  <!-- Modal -->
  <div class="modal fade" id="myModal_new_driver" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;font-size: 15px"><span class="glyphicon glyphicon-plus"></span> RE-APPLY LEAVE <span class="glyphicon glyphicon-plus"></span></h4>
        </div>
        <div class="modal-body" style="font-size: 15px">

        <form class="form-horizontal" action="/action_page.php" style="font-size: 15px;margin-top: 10px">
    <div class="form-group">
      <label class="control-label col-sm-3" for="email">From Date:</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" name="selected_date" id="datepicker5_driver"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="pwd">To Date:</label>
      <div class="col-sm-6">          
      
      <input type="text" class="form-control" name="selected_date" id="datepicker4_driver"/>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-3" for="pwd">Reason:</label>
      <div class="col-sm-6">          
      <textarea class="form-control custom-control" rows="3" id="text_areax_driver_modal" style="resize:none"></textarea>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-3" for="pwd">Rejection-Reason:</label>
      <div class="col-sm-6">          
      <textarea class="form-control custom-control" rows="3" id="reject_reason_driver_modal" style="resize:none" readonly></textarea>
      <input type="hidden" name="row_id" id="row_id" value="">
      </div>
    </div>
    
    
    <div class="form-group">        
      <div class="col-sm-offset-3 col-sm-6 text-center" >
        <button type="button" class="btn btn-primary" onclick="ajax_submit_add_new_driver()">Submit</button>
      </div>
    </div>
  </form>
    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


      <!-- Modal -->
  <div class="modal fade" id="myModal_new" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;font-size: 15px"><span class="glyphicon glyphicon-plus"></span> RE-APPLY LEAVE <span class="glyphicon glyphicon-plus"></span></h4>
        </div>
        <div class="modal-body" style="font-size: 15px">

        <form class="form-horizontal" action="/action_page.php" style="font-size: 15px;margin-top: 10px">
    <div class="form-group">
      <label class="control-label col-sm-3" for="email">From Date:</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" name="selected_date" id="datepicker5"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="pwd">To Date:</label>
      <div class="col-sm-6">          
      
      <input type="text" class="form-control" name="selected_date" id="datepicker4"/>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-3" for="pwd">Reason:</label>
      <div class="col-sm-6">          
      <textarea class="form-control custom-control" rows="3" id="text_areax" style="resize:none"></textarea>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-3" for="pwd">Rejection-Reason:</label>
      <div class="col-sm-6">          
      <textarea class="form-control custom-control" rows="3" id="reject_reason" style="resize:none" readonly></textarea>
      <input type="hidden" name="row_id_driver" id="row_id_driver" value="">
      <input type="hidden" name="student_id_driver" id="student_id_driver" value="">

      </div>
    </div>
    
    
    <div class="form-group">        
      <div class="col-sm-offset-3 col-sm-6 text-center" >
        <button type="button" class="btn btn-primary" onclick="ajax_submit_add_new()">Submit</button>
      </div>
    </div>
  </form>
    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  </body>
</html>