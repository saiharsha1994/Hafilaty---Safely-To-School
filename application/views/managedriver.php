<!DOCTYPE html>
<html>
  <head>
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- font Awesome CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
  
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
/*
.popover{
    max-width: 100%;
    color: red;
    padding-top: 20px;
    padding-bottom: 20px;
    padding-left: 50px;
    padding-right: 50px;
}*/


    </style>
      
  </head>

  <body onload="active()">


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

    
    <form method="POST" >
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
          
              foreach ($names as $row) {
                $count = 0;

                ?>
                <tr data-toggle="popover" data-content="" style="cursor:pointer;">
                       <?php
                  foreach ($row as $key => $value) {
                      $count++;
                      if ($count == 9) {
                       ?>
                       <td>
                          <div class="btn-group" style="overflow:visible">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-default pull-right" role="menu" >          
                            <!-- PROFILE LINK -->
                                <li>
                                    <a  href="<?php echo base_url();?>index.php/Welcome/managedrivers_with_popup/<?php echo $row[$count-1];?>">
                                                <i class="glyphicon glyphicon-user"></i>
                                                    profile
                                                </a>
                                              
                                </li>
                    <!--  DELETION LINK -->
                                <li>
                                     <a href="#" data-record-id="<?php echo $row[$count-1]; ?>" data-toggle="modal" data-target="#myModal_delete"  name="delete" id=<?php echo $row[$count-1]; ?> title="Delete">
                                                <i class="glyphicon glyphicon-trash"></i>
                                                    delete
                                            </a>
                                </li>
                                        
                                        <!--  EDITING LINK -->
                                <li>
                                    <a href="<?php echo base_url();?>index.php/Welcome/edit_driverdetails_with_popup/<?php echo $row[$count-1];?>">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                                    edit
                                                </a>
                                </li>
            
                              </ul>
                            </div>
                        </td>
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
    </form>
    </div>
  </div>
</div>
<h5 style="margin-left:20px;text-align:center">copyright@VT</h5>
</div>



<?php include 'model_driver_add.php' ?>

<div class="modal fade" id="myModal_delete" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;">CONFIRM DELETE</h4>
        </div>
        <div class="modal-body-new" style="height:200px">
        <div class="modal-body-new" style="height:60px;text-align: center;margin-top: 50px;font-size: 40px">
          <span class="glyphicon glyphicon-trash"></span>
        </div>
          <h4 style="text-align: center;">Are You Sure?Do You Want To Delete Permenantly?</h4>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                <a class="btn btn-danger btn-ok ">DELETE</a>
        </div>
      </div> 
    </div>
  </div>

    <!-- Bootstrap JavaScript -->
    <!-- Custom JavaScript -->
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/main.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/script.js');?>"></script>
    <!-- Call functions on document ready -->
<script type="text/javascript">
          
          var row = 0;
          var num;
          var message = "";
          var dt1 = "";
          var dt2 = "";
          var dt3 = "";
          var zero;

         $("tr").each(function(){
          var col = 0;
             row++;
             console.log(row);
            num = 0;
            message = "";
             
          var dt1 = "";
          var dt2 = "";
          var dt3 = "";
          var zero1 = 1;
          var zero2 = 1;
           var zero3 = 1;

            $(this).find('td').each (function() {
                col++;
             var texttocheck = $(this).html();
             ////////////
             // Here are the two dates to compare
var todayDate = new Date().toISOString().slice(0,10);
date1 = todayDate.split('-');
date2 = texttocheck.split('-');

var d1 = parseInt(date1[1]);
var d2 = parseInt(date2[1]);

console.log(date1 +"  "+date2)
console.log(date1[1] +"  "+date2[1])

date1 = new Date(date1[0], d1-1, date1[2]);
date2 = new Date(date2[0], d2-1, date2[2]);


date1_unixtime = parseInt(date1.getTime() / 1000);
date2_unixtime = parseInt(date2.getTime() / 1000);

var timeDifference = date2_unixtime - date1_unixtime;

var timeDifferenceInHours = timeDifference / 60 / 60;
var timeDifferenceInDays = timeDifferenceInHours  / 24;
console.log("3 " + timeDifferenceInDays);
             ///////////

             if (-90<timeDifferenceInDays && timeDifferenceInDays <= 2 ) {
                //num++;
                if (col == 3) {
                  zero1 = timeDifferenceInDays;
                  dt1 = texttocheck;
                  message += "Iqama";
                }
                else if(col == 5){
                  zero2 = timeDifferenceInDays;
                  dt2 = texttocheck;
                  message += "Passport";
                }
                else if(col == 7){
                  zero3 = timeDifferenceInDays;
                  dt3 = texttocheck;
                  message += "License";
                }
            
             }
          
            });  
           
           if (message == "Iqama") {
                 $(this).click(function(event){
                 var msg = "";
                 if (zero1 < 0) {
                     msg = "Iqama has already expired! "
                 }
                 else if (zero1 == 0) {
                     msg = "Iqama will expire today";
                 }
                 else{
                     msg = "Iqama will expire on "+ dt1; 
                 }  

                 $(this).attr('data-content', msg);  
              });

             $(this).css('border', '2px solid red');
               console.log("found one element");
           }

           else if (message == "Passport") {
               $(this).click(function(event){
                 var msg = "";
                 if (zero2 < 0) {
                     msg = "PASSPORT already expired! "
                 }
                 else if (zero2 == 0) {
                     msg = "PASSPORT will expire Today";
                 }
                 else{
                     msg = "PASSPORT will expire on "+ dt2; 
                 }  

                 $(this).attr('data-content', msg);  
             
              });
               $(this).css("-webkit-border-radius", "20px");
            $(this).css('border', '2px solid red');

               console.log("found two elements");
           }
           else if (message == "License"){
               $(this).click(function(event){
                var msg = "";
                 if (zero3 < 0) {
                     msg = "LICENSE has already expired! "
                 }
                 else if (zero3 == 0) {
                     msg = "LICENSE will expire today";
                 }
                 else{
                     msg = "License will expire on "+ dt3; 
                 }  

              $(this).attr('data-content', msg);   
              });
            $(this).css('border', '2px solid red');
               console.log("found all elements");
           }
           ////////////////////////////////////////
           else if (message == "IqamaPassport") {
               $(this).click(function(event){

                if (zero1 < 0) {
                    var msg1 = "IQAMA already expired! and "; 
                }
                else if (zero1 == 0) {
                  var msg1 = "IQQAMA will expire Today and ";
                }
                else{
                   var msg1 = "IQAMA will expire on " + dt1 + " and ";
                }

                if(zero2 < 0){
                    var msg2 = "PASSPORT already expired! ";
                }
                else if (zero2 == 0) {
                  var msg2 = "PASSPORT will expire Today ";
                }
                else{
                   var msg2 = "PASSPORT will expire on " + dt2;
                }
          
                 var msg = msg1 + msg2;
                 $(this).attr('data-content', msg);  
              });
              $(this).css('border', '2px solid red');
               console.log("found two elements");
           }


           else if (message == "IqamaLicense") {
               $(this).click(function(event){

                if (zero1 < 0) {
                     var msg1 = "IQAMA already expired! and "; 
                 }
                else if (zero1 == 0) {
                    var msg1 = "IQAMA will expire Today and "; 
                 }
                else{
                   var msg1 = "IQAMA will expire on " + dt1 + " and ";
                }
                
                if (zero3 < 0) {
                    var msg3 = "LICENSE already expired! "; 
                }
                else if (zero3 == 0) {
                  var msg3 = "LICENSE will expire Today ";
                }
                else{
                   var msg3 = "LICENSE will expire on " + dt3;
                }
                 var msg = msg1 + msg3;
                 $(this).attr('data-content', msg);   
              });
            $(this).css('border', '2px solid red');
               console.log("found two elements");
           }
           else if (message == "PassportLicense"){
               $(this).click(function(event){
                 //var cell_value = $(event.target);
                if (zero2 < 0) {
                    var msg2 = "PASSPORT already expired! and "; 
                }
                else if (zero2 == 0) {
                  var msg2 = "PASSPORT will expire Today and ";
                }
                else{
                   var msg2 = "PASSPORT will expire on " + dt2 + " and ";
                }

                if(zero3 < 0){
                    var msg3 = "LICENSE already expired ";
                }
                else if (zero3 == 0) {
                  var msg3 = "LICENSE will expire Today ";
                }
                else{
                   var msg3 = "LICENSE will expire on " + dt3;
                }

                 var msg = msg2 + msg3;
                 $(this).attr('data-content', msg);  
              });
              $(this).css('border', '2px solid red');
               console.log("found all elements");
           }
              
           /////////////////////////////////////
           else if (message == "IqamaPassportLicense"){
            
               $(this).click(function(event){
                 //var cell_value = $(event.target);
                 var status1 = "", status2 = "", status3 = "";
                 if ( zero1 < 0) {
                     var msg1 = "IQAMA already expired!, "; 
                     status1 = "expired";
                 }
                else if (zero1 == 0) {
                    var msg1 = "IQAMA will expire Today, "; 
                    status1 = "today";
                 }
                 else{
                     var msg1 = "IQAMA will expire on "+ dt1 + ", "; 
                 }

                 if ( zero2 < 0) {
                     var msg2 = "PASSPORT already expired! and "; 
                     status2 = "expired";
                 }
                 else if(zero2 == 0){
                  var msg2 = "PASSPORT will expire Today and ";
                  status2 = "today";
                 } 
                 else{
                     var msg2 = "PASSPORT will expire on "+ dt2 + " and "; 
                 }

                 if ( zero3 < 0) {
                     var msg3 = "LICENSE already expired! "; 
                     status3 = "expired";
                 }
                 else if(zero3 == 0){
                  var msg3 = "LICENSE will expire Today ";
                  status3 = "today";
                 } 
                 else{
                     var msg3 = "License will expire on "+ dt3; 
                 }
                //
                 if (status1 && status2 && status3 == "expired") {
                     msg = "All already expired!"
                 }
                 else if (status1 && status2 && status3 == "today") {
                     msg = "All will expire Today!"
                 }
                  else{
                    var msg = msg1 + msg2 + msg3;
                  }

                 $(this).attr('data-content', msg);  
              });
            $(this).css('border', '2px solid red');
               console.log("found all elements");
           }

           else{
            console.log("no element found");
           }

         });

	
    
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({ placement : 'bottom'});   
});

$('#myModal_delete').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            var data = 'ID=' +id;
       
            $.ajax({url: "<?php echo base_url(); ?>" + "index.php/Welcome/delete_managedriver", type: 'post',data: data,success: function(result){ 
          
          setTimeout(pageRefresh_new,1500);
        },
        error:function(){setTimeout(pageRefresh_new,1500);}
      });
           


        });
        $('#myModal_delete').on('show.bs.modal', function(e) {
            var data = $(e.relatedTarget).data();
            $('.btn-ok', this).data('recordId', data.recordId);
        });
 
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

  </body>
</html>