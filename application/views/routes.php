<!DOCTYPE html>
<html>
 <head>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- font Awesome CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
	<link href="<?php echo base_url('Assets/CSS/sidebar.css')?>" rel="stylesheet">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
	
	<style type="text/css">
        .main-nav > li:hover{
            background-color:#1976d2;
        }
        .btn-md {
          width: 200px;
        }
        li.active {background: #1976d2;}
    </style>
    
 </head>
 <body onload="active()">
    <div id="wrapper">
        <?php  include 'sidebar.php';?>
        <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">ROUTES</strong></button>
                </div>
            </div>
        </section>
    <div class="container">
        <div style="background:transparent !important" class="jumbotron">
            <div class="panel panel-primary">
                <div class="panel-heading">
				<h4>CREATE NEW ROUTE</h4>
				</div>
				<div class="panel-body">
					<form class="form-inline" method="POST" action="<?php echo site_url('Welcome/AddRoute');?>">
						<div class="form-group">
							<label style="margin-right:5px;margin-left:5px">Route Name:</label>
                            <input class="form-control" style="margin-right:5px;margin-left:5px" type="text" name="route_name" size="10" onkeyup="EnableTrip()">
						</div>
						<div class="form-group">
                            <label style="margin-right:5px;margin-left:5px">Trip:</label>
                            <select class="form-control" name="trip_type" id="trip_type" onchange="EnableStart()" disabled>
				<option></option>			
				<option>Pickup</option>
                                <option>Drop</option>
                            </select>
						</div>
						<div class="form-group">
							<label style="margin-right:5px;margin-left:5px">Start At:</label>
							<!--<input class="form-control" style="margin-right:5px;margin-left:5px" type="time" name="start_time" >-->
							<input class="form-control timepicker timepicker-with-dropdown" id="start_time"  style="margin-right:5px;margin-left:5px; width: 100px !important;" name="start_time" onclick="EnableEnd()"  disabled>
						</div>
						<div class="form-group">
							<label for="pwd" style="margin-right:5px;margin-left:5px">End At:</label>
							<!--<input class="form-control" style="margin-right:5px;margin-left:5px" type="time" name="end_time">-->
							<input class="form-control timepicker timepicker-with-dropdown" id="end_time" style="margin-right:5px;margin-left:5px; width: 100px !important;" name="end_time" onclick="EnableAdd()" disabled>
						</div>
                        <button type="submit" id="addRoute" class="btn btn-primary btn-md" disabled>ADD ROUTE</button>
					</form>
				</div>
			</div>
    
            <form method="POST" action="<?php echo site_url('Welcome/create_route');?>">
				<div class="table-responsive">
					<div class="col-sm-12" style="height:40px;background-color:steelblue;color:white">
						<h4>ROUTE LIST</h4>
					</div>
                    <table class="table table-bordered" id="docsTable" style="text-align:center">
					  <thead>
						  <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Route Name - Trip Type</th>
						  <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Start - End Time</th>
						  <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">No.Of Stops</th>
						  <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Driver Name</th>
						  <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Bus No.</th>
						  <th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Option</th>
					  </thead>
					  <tbody>
						  <?php 
							  $count = 1;
							  foreach ($names as $row) {
								if($count === 1){?>
								<tr>
									<td data-title="Route Name - Trip Type" ><?php echo $row; ?>
										<input type="hidden" name="type" value="<?php echo $names[$tracker]; ?>">
									</td>

							<?php
							 }
								if($count === 2){?>
									<td data-title="Start - End Time"><?php echo $row; ?>
										  </td>
									<?php       
									}
									if($count === 3){?>
										  <td data-title="No.Of Stops"><?php echo $row; ?></td>
						  <?php       }
									  if ($count === 4) {
						  ?>
										  <td data-title="Driver Name"><?php echo $row; ?></td>
									  <?php }
									  if ($count === 5) {
						  ?>
										  <td data-title="Bus No."><?php echo $row; ?></td>
									  <?php }
									  if ($count === 6) {
										?>
										<td data-title="Option">
											<div>

											<button type="submit" class="btn btn-info" name="edit" value="<?php echo $row; ?>" id=<?php echo $row; ?> title="Edit"><i class="fa fa-fw fa-edit"></i></button>&nbsp
											<button type="button" class="btn btn-warning" name="delete" id=<?php echo $row; ?> title="Delete"><i class="fa fa-fw fa-remove"></i>

											</button>
											</div>
										</td>
							<?php 	
							  $count = 0;
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
 <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/main.js');?>"></script>

	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	
<script type="text/javascript">
function EnableTrip() {
          document.getElementById("trip_type").disabled = false;
        }

function EnableStart() {
          document.getElementById("start_time").disabled = false;
        }

        function EnableEnd() {
          document.getElementById("end_time").disabled = false;
        }
        function EnableAdd() {
          document.getElementById("addRoute").disabled = false;
        }

    function active(){
      var selector = '.main-nav li';
      $(selector).removeClass('active');
    $("#routeid").addClass('active');
    }
    </script>
    <!-- Call functions on document ready -->
    <script>
        $(document).ready(function() {
            // Call Menu Toggler
            appMaster.menuToggler();
            // Example Call anotherFunction
            appMaster.anotherFunction();
			
			$('.timepicker').timepicker({
				timeFormat: 'hh:mm p',
				interval: 60,
				minTime: '03:00am',
				maxTime: '10:00pm',
				defaultTime: '04:00an',
				dynamic: true,
				dropdown: true,
				scrollbar: true
			});
			
			/* Delete AJAX */
	$(document).on('click', 'div button', function(){
		var src_id = $(this).attr('id');
		var src_name = $(this).attr('name');
		if(src_name == 'delete'){
			var res = confirm("Do you wanna delete the route ?");
			if (res == true) {
				var data = 'ID=' +src_id+ '&act=delete';
				console.log(data);
				
				$.ajax({url: "<?php echo base_url(); ?>" + "index.php/Welcome/AJAX_DeleteRoute", type: 'post',data: data,success: function(result){	
					//sessionHandleCust(result);	
					//console.log(result);
					setTimeout(pageRefresh_new,1500);
				}});
			}
		}/*else if(src_name == 'edit'){
			var data = 'ID=' +src_id+ '&act=edit';
			console.log(data);
				//window.location.href = "<?php echo base_url(); ?>" + "index.php/Welcome/create_route_view" + data;
		}*/
	});
});
    </script>
  </body>
</html>