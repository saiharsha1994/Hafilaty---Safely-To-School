<!DOCTYPE html>
<html>
  <head>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
    <link href="<?php echo base_url('Assets/CSS/sidebar.css')?>" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  </head>
  <body onload="active()">
    <div id="wrapper">
		<?php include 'sidebar.php' ?>
        <section class="main-section">
			<div class="content">
				<div class="form-group">
					<button id="menuToggler" style="background-color:white;border-color:transparent"><span class="glyphicon glyphicon-list" style="color:#2196f3;margin-right:10px"></span><strong style="font-size:18px">Exit Re-Entry</strong></button>
				</div>
			</div>
        </section>
          <div class="container">
          <div class="jumbotron" style="background-color:white">
          <div class="panel panel-primary">
          <div class="panel-heading">SELECT RECIPIENT CRITERIA</div>
          <div class="panel-body">
          <form class="form-inline" method="POST" action="<?php echo site_url('Welcome/exit_reentry_list');?>">
			  <div class="form-group">
			  <label for="status" style="margin-right:20px;margin-left:20px">Select Status</label>
			 
			  <select class="form-control" name="status" id="status" required>
				<option></option>
				<option value="0">All</option>
				<option value="1">Pending</option>
				<option value="2">Approve By HR</option>
				<option value="3">Rejected By HR</option>
				<option value="4">Approve By Ministry</option>
				<option value="5">Rejected By Ministry</option>
			  </select>
			  
			  <button style="margin-left:20px" type="submit" id="getList" class="btn btn-primary pull-right">GET LIST</button>
			  </div>
			  
			 <button type="button" id="apply_exit_reentry" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Apply Exit Re-Entry</button>
          </form>
		  
		  
          </div>
          </div>
          <form method="POST">
          <div class="table-responsive">
          <div class="col-sm-6" style="height:40px;background-color:steelblue;color:white;margin-top:10px">
          <h4>DETAILS</h4>
          </div>
          <div class="col-sm-6" style="height:40px;background-color:steelblue;color:white;margin-top:10px">
          <button id="printx" class="btn btn-default pull-right" style="margin: 5px"  onclick="printData()"><span class="glyphicon glyphicon-print"> </span> print</button>
          </div>
          <table class="table table-bordered" id="docsTable" border="1" cellspacing="0"  style="text-align:center;color: black">
          <thead>
          <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">S.No</td>
          <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Months</td>
          <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">From Date</td>
          <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">To Date</td>
          <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Document</td>
          <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Executed Document</td>
			<td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Reject Reason</td>
          </thead>
          <tbody>
          <?php $count=1; foreach ($exit_reentry_list as $row) { ?>
          <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row['no_of_months']." months"; ?></td>
          <td><?php echo $row['from_date']; ?></td>
          <td><?php echo $row['to_date']; ?></td>
          
		  <td><?php if($row['document']!='' && $row['document']!=null){?>
				<button class="btn btn-info custom">
				<a style="color:white;font-size: 12px" href="<?php echo base_url();?>index.php/Welcome/exit_reentry_download/<?php echo $row['document'];?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Document
                </a>
            </button>
		  <?php }
			else{
				echo "-";
			}?></td>
		  
          <td><?php if($row['executed_doc']!='' && $row['executed_doc']!=null){?>
		  <button class="btn btn-info custom">
				<a style="color:white;font-size: 12px" href="<?php echo base_url();?>index.php/Welcome/exit_reentry_download/<?php echo $row['executed_doc'];?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Executed Document
                </a>
            </button>
		  <?php }
			else{
				echo "-";
			}?></td>
		 <td><?php if($row['status']==3){
				echo $row['reject_reason_hr'];
			}else if($row['status']==5){
				echo $row['reject_reason_ministry'];
			}else{
				echo "-";
			}?></td>
         
          </tr>
          <?php $count++;} ?>
          </tbody>
          </table>
          <ul class="pager pull-right">
          <li ><a href="#" id="prev">Previous</a></li>
          <li><a href="#" id="next">Next</a></li>
          </ul>
        
          </form>
          </div>
          </div>
          </div>
          <h5 style="margin-left:20px;text-align:center"><a href="http://www.valuetechsa.com/" target="_blank" style="color: black">copyright@VT</a></h5>
          </div>
              <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
              <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
              <script src="<?php echo base_url('Assets/Javascripts/script.js');?>"></script>
              <script type="text/javascript">
				function active(){
					var selector = '.main-nav li';
					$(selector).removeClass('active');
					$("#exit_reentry").addClass('active');
				}

              </script>
              <script type="text/javascript">
                function sort(a){_.hide(),_.filter(function(a){return a>=(pageNum-1)*max&&a<pageNum*max}).show(),$("#total").text("page "+pageNum+" of "+Math.ceil($("#docsTable .row").length/max))}function printData(){var a=document.getElementById("docsTable");newWin=window.open(""),newWin.document.write(a.outerHTML),newWin.print(),newWin.close()}var max=40,pageNum=0,_=$("#docsTable .row");$(document).ready(function(){_.length;$("#prev").click(function(){pageNum--,sort("prev")}),$("#next").click(function(){pageNum++,sort("next")}),$("#next").trigger("click")});
              </script>
			  
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title" style="text-align: center;font-size: 15px"> Apply Exit Re-Entry</h4>
		</div>
        <div class="modal-body" style="font-size: 15px">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo site_url('Welcome/exit_reentry_add');?>" style="font-size: 15px;margin-top: 10px">
				<div class="form-group">
					<label class="control-label col-sm-3" for="months">No. Of Months:</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="no_of_months"  required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-3" for="from_date">From Date:</label>
					<div class="col-sm-6">
						<input type="date" class="form-control" name="from_date" id="datepicker2" required />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="to_date">To Date:</label>
					<div class="col-sm-6">          
						<input type="date" class="form-control" name="to_date" id="datepicker3"  required />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="doc">Upload Document</label>
					<div class="col-sm-7">   
						<label class="btn btn-default btn-file">
							<input type="file" name="userfile" class="custom-file-input" />
						</label>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="form-group">        
					<div class="col-sm-offset-3 col-sm-6 text-center" >
						<button type="submit" class="btn btn-primary" >Submit</button>
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
<!--
<script type="text/javascript">
function ajax_submit_add(){
		
		var months=document.getElementById('no_of_months').value;
		var from_date=document.getElementById('from_date').value;
		var to_date=document.getElementById('to_date').value;
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
</script>-->	
  </body>
</html>