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
    </style>
    
  
  </head>
  <body>
  
  <div id="wrapper">
        <?php include 'sidebar.php' ?>
          <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">REPORTS</strong></button>
                </div>
            </div>
        </section>
<div class="container">
  <div class="jumbotron">
    <div class="panel panel-primary">
      <div class="panel-heading">SELECT RECIPIENT CRITERIA</div>
      <div class="panel-body">
          <form class="form-inline" method="POST" action="<?php echo site_url('Welcome/reports');?>">
          <div class="form-group">
          <label for="pwd" style="margin-right:10px;margin-left:25px">Date From</label>
          <input class="form-control" type="text" name="startdate" id="startdate"/>
          </div>

          <div class="form-group">
          <label for="pwd" style="margin-right:10px;margin-left:25px">Date To</label>
          <input class="form-control" type="text" name="enddate" id="enddate"/> 
          </div>
       

      <div class="form-group">
          <label for="pwd" style="margin-right:10px;margin-left:25px">Speed Limits</label>
           <select class="form-control" type="text" name="speedlimit" id="speedlimit" style="color: black" />
          <option>Select All</option>
          <option>10 km/hr</option>
          <option>20 km/hr</option>
          <option>30 km/hr</option>
          <option>40 km/hr</option>
          <option>50 km/hr</option>
          <option>60 km/hr</option>
          <option>70 km/hr</option>
          <option>80 km/hr</option>
          <option>90 km/hr</option>
          <option>100 km/hr</option>
        </select>
      </div>
    
          <button type="submit" id="getList" class="btn btn-primary pull-right">GET LIST</button>
        </form>
      </div>
    </div>

    <button id="printx" onclick="printData()"></button>
    <form method="POST">
    <div class="table-responsive">
      <div class="col-sm-12" style="height:40px;background-color:steelblue;color:white;">
        <h4>INDIVIDUAL SELECTION</h4>
      </div>
      
      <table class="table table-bordered" border="1" cellspacing="0" cellpadding="20" id="docsTable" style="text-align:center;">
          <thead>
             <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Date</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus Name</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Driver Name</td>
              <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Speed</td>
          </thead>
          <tbody>
              <?php 
              //print_r($reports);
              foreach ($reports as $row) {
                ?>
                <tr>
                  <?php
                  foreach ($row as $key => $value) {
                      ?>
                      <td class="row" style="padding: 5px"><?php echo $value;?></td>
                  <?php
                  }
                  ?>
                </tr>
               <?php
              // echo "<br/>";
              }
              ?>
          </tbody>
      </table>

             <ul class="pager">
  <li><a href="#" id="prev">Previous</a></li>
  <li><a href="#" id="next">Next</a></li>
</ul>
      </div>
    </form>
    </div>
  </div>
</div>
<h5 style="margin-left:20px;text-align:center">copyright@VT</h5>
</div>


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
    $("#reports").addClass('active');
    }
    </script>
    <script>
        $(document).ready(function() {
            // Call Menu Toggler
            appMaster.menuToggler();
            // Example Call anotherFunction
            appMaster.anotherFunction();
        });

        
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#startdate').datepicker().datepicker('setDate',new Date());
//$( "#startdate" ).datepicker();

document.getElementById('startdate').value="<?php echo $_POST['startdate'];?>";
$( "#enddate" ).datepicker().datepicker('setDate',new Date());

document.getElementById('enddate').value="<?php echo $_POST['enddate'];?>";
         // $("#start_datepicker").datepicker();
         // document.getElementById('speedlimit').value = "<?php echo $_POST['speedlimit'];?>";
         document.getElementById('speedlimit').value = "<?php echo $_POST['speedlimit'];?>";
 
  });

  </script>

  <script type="text/javascript">
    var max = 40;
    var pageNum=0;
 var _=$('#docsTable .row');

$(document).ready(function() {
var total = _.length;
var pages = total / max;
        
     
    
    $('#prev').click(function() {
        pageNum--;
         sort("prev");
    });

    $('#next').click(function() {
        pageNum++;
         sort("next");
    });
    $('#next').trigger('click');
});


function sort(a)
{  _.hide();  
    _.filter(function(i){ return i>=(pageNum-1)*max  && i<  (pageNum)*max;}) .show();
 $("#total").text("page " + pageNum + " of " + Math.ceil($('#docsTable .row').length/max));
}
  </script>
  <script>
function printData()
{
   var divToPrint=document.getElementById("docsTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}


</script>

  </body>
</html>