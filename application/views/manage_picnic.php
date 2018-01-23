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
		.panel{
			border: 1px solid white;
		}
		.main-nav > li:hover{background-color:#1976d2;}
		li.active {background: #1976d2;}
		.jumbotron{background: white}
		.modal-dialog{
			overflow-y: initial !important
		}
		.popover.bottom .arrow:after {
			border-bottom-color: gray;
		}

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
		input:focus:required:invalid {border: 2px solid red;}
		select:focus:required:invalid {border: 2px solid red;}
		.custom {
			width: 100px !important;

		}
		.table-responsive {
			overflow: visible;
		}
	</style>
</head>
<body onload="active()">
	<div id="wrapper">
		<?php  include 'sidebar.php';?>
		<section class="main-section">
			<div class="content">
				<div class="form-group">
				<button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">MANAGE PICNIC</strong></button>
				</div>
			</div>
		</section>
		<div class="container-fluid">
			<div style="background:transparent !important" class="jumbotron">
				<div class="panel panel-default">
					<div class="panel-body">
					<a href="<?php echo base_url();?>index.php/Welcome/add_picnic" class="btn btn-default btn-md pull-right" style="background:black;color:white"><span class="glyphicon glyphicon-plus"></span>
							Add New Picnic</a>
						<!-- <button style="background:black;color:white" class="btn btn-default btn-md pull-right" >
							<span class="glyphicon glyphicon-plus"></span>
							Add New Picnic
						</button> -->
					</div>
				</div>
				<form method="" action="">
					<div class="table-responsive">
						<div class="col-sm-12" style="height:40px;background-color:steelblue;color:white">
							<h4>PICNIC DETAILS</h4>
						</div>
						<table class="table table-bordered" id="docsTable" style="text-align:center">
							<thead>
								<th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Title</th>
								<th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">From Date</th>

								<th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">To Date</th>
								<th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Location</th>

								<th style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Options</th>
							</thead>
							<tbody>
								<?php 
								$count = 1;

								foreach ($picnic as $row) {
								if($count === 1 ){?>
								<tr>
									<td data-title="Title" ><?php echo $row; ?></td>
									<?php }

									if($count === 2){?>
									<td data-title="From Date" ><?php echo date("d-m-Y", strtotime($row)); ?></td>
									<?php       
								}

								if($count === 3){?>
								<td data-title="To Date"><?php echo date("d-m-Y", strtotime($row)); ?>
								</td>
								<?php       
							}

							if($count === 4){?>
							<td data-title="Location"><?php echo $row; ?>
							</td>
							<?php       
						}

						if ($count === 5) {
						?>
						<td data-title="Options">
							<div class="btn-group" style="overflow:visible">

								<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
									Action <span class="caret"></span>
								</button>
								<ul class="dropdown-menu dropdown-default pull-right" role="menu" >
								<li style="margin-top: 5px;">
										<a href="<?php echo base_url();?>index.php/Welcome/add_students_picnic/<?php echo $row;?>">
											<i class="glyphicon glyphicon-plus"></i>
											Add Students
										</a>
									</li>
									<li style="margin-top: 5px;">
										<a href="<?php echo base_url();?>index.php/Welcome/add_bus_picnic/<?php echo $row;?>">
											<i class="glyphicon glyphicon-plus"></i>
											Add Bus
										</a>
									</li>
									<li style="margin-top: 5px;">
										<a href="<?php echo base_url();?>index.php/Welcome/edit_picnic/<?php echo $row;?>">
											<i class="glyphicon glyphicon-pencil"></i>
											Edit
										</a>
									</li>
									<!--  DELETION LINK -->
									<li style="margin-top: 5px;">
										<a href="#" data-record-id="<?php echo $row; ?>" data-toggle="modal" data-target="#myModal_delete"  name="delete" id=<?php echo $row; ?> title="Delete">
											<i class="glyphicon glyphicon-trash"></i>
											Delete
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



<?php include 'modal_add_picnic.php';?>

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
				<h4 style="text-align: center;">Are You Sure? Do You Want To Delete Permanently?</h4>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
				<a class="btn btn-danger btn-ok ">DELETE</a>
			</div>
		</div>


	</div>
</div>
<!-- Bootstrap JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!-- Custom JavaScript -->
<script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
<script src="<?php echo base_url('Assets/Javascripts/main.js');?>"></script>
<script src="<?php echo base_url('Assets/Javascripts/script.js');?>"></script>
<!-- Call functions on document ready -->
<script type="text/javascript">
	function active(){
		var selector = '.main-nav li';
		$(selector).removeClass('active');
		$("#managepicnic").addClass('active');
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

		$(function(){
			$( "#datepicker2" ).datepicker();
              //Pass the user selected date format 
              $( "#format" ).change(function() {
              	$( "#datepicker2" ).datepicker( "option", "dateFormat", $(this).val() );
              });
          });
	});
	$(document).ready(function(){
		$('[data-toggle="popover"]').popover();   
	});





	$('#myModal_delete').on('click', '.btn-ok', function(e) {
		var $modalDiv = $(e.delegateTarget);
		var id = $(this).data('recordId');
		var data = 'picnic_id=' +id;
		$.ajax({url: "<?php echo base_url(); ?>" + "index.php/Welcome/delete_picnic", type: 'post',data: data,success: function(result){ 

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