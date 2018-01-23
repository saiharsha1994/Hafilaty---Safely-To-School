
<div id="myModal12345" class="modal fade" role="dialog">
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
    Edit New Accident</div>
    <div class="panel-body" style="color:gray;font-size:12px">
      <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo site_url('Welcome/edit_incident_data');?>">
      <?php 
      $count = 1;
      foreach ($incident3 as $row) {?>
        <?php if($count === 1){?>
	<div class="form-group">
      <label class="control-label col-sm-3" for="date">Date</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="incident_date" id="datepicker2" value="<?php echo $row;?>"/>
      </div>
      <div class="col-sm-2"></div>
    </div>
<?php };?>
<?php if($count === 2){?>
    
   <div class="form-group">
      <label class="control-label col-sm-3" for="Details">Details</label>
      <div class="col-sm-7">          
        <textarea type="text" class="form-control" name="incident_details" id="incident_details" value="<?php echo $row;?>"><?php echo $row;?></textarea>
      </div>
      <div class="col-sm-2"></div>
    </div>
<?php };?>
<?php if($count === 3){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="report">Upload Report</label>
      <div class="col-sm-7"> 
	<?php if($row!="null"){ ?>
      <button class="form-control" id="doc">
                        <a 
                        href="<?php echo base_url();?>index.php/Welcome/accident_download/<?php echo $row;?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>License
                  </a>
                  </button> 
                  <?php };?>
     <label class="btn btn-default">
      <input type="file" name="userfile" id="userfile" class="custom-file-input"/>
</label>
<input type="hidden" name="userfile_doc" value="<?php echo $row;?>">
      </div>
      <div class="col-sm-2"></div>
    </div>
<?php };?>
<?php if($count === 4){?>
   <div class="form-group">
      <label class="control-label col-sm-3" for="select_bus">Select Bus</label>
      <div class="col-sm-7">
        <select class="form-control" name="incident_bus" >
	<option style="display:none"><?php echo $row;?></option>
          <?php 
            $counter;
            foreach ($bus_list as $row) {
              $counter = 0;
              foreach ($row as $key => $value) {
                 $counter++;
                 if ($counter == 1) {
                     $v = $value;
                 }
                 if ($counter == 2) {
                     ?>
                     <option value = "<?php echo $v; ?>"><?php echo $value; ?></option>
                     <?php
                 }
                 ?>
                 <?php
              }
              ?>
              <?php
            }
          ?>
      </select>
      </div>
     <div class="col-sm-2"></div>
    </div> 
    <?php };?>

<?php if($count === 5){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="select_driver">Select Driver</label>
      <div class="col-sm-7">
        <select class="form-control" name="incident_driver" >
	<option style="display:none"><?php echo $row;?></option>
          <?php 
            $counter;
            foreach ($driver_list as $row) {
              $counter = 0;
              foreach ($row as $key => $value) {
                 $counter++;
                 if ($counter == 1) {
                     $v = $value;
                 }
                 if ($counter == 2) {
                     ?>
                     <option value = "<?php echo $v; ?>"><?php echo $value; ?></option>
                     <?php
                 }
                 ?>
                 <?php
              }
              ?>
              <?php
            }
          ?>
        </select>
      </div>
     <div class="col-sm-2"></div>
    </div> 
<?php };?>

<?php if($count === 6){?>
         <div class="form-group">
      <label class="control-label col-sm-3" for="fine_amt">Fine Amount</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="fine_amt" id="fine_amt" value="<?php echo $row;?>">
      </div>
      <div class="col-sm-2"></div>
    </div>
<?php };?>
<?php if($count === 7){?>
     <div class="form-group">
      <label class="control-label col-sm-3" for="paid">Status</label>
      <div class="col-sm-7">        
	<?php if($row==1){$row="paid";}else{$row="unpaid";}
		?>  
<select class="form-control" name="status" >
                    <option style="display:none" selected value="<?php echo $row;?>"><?php echo $row;?></option>
          <option value="10 Seater">Paid</option>
          <option value="20 Seater">Unpaid</option>
        </select>
      </div>
      <div class="col-sm-2"></div>
    </div>
<?php };?>
<?php if($count === 8){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Upload Document</label>
      <div class="col-sm-7"> 
<?php if($row!="null"){ ?>
      <button class="form-control" id="doc1">
                        <a 
                        href="<?php echo base_url();?>index.php/Welcome/accident_download/<?php echo $row;?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>License
                  </a>
                  </button> 
                  <?php };?>
     <label class="btn btn-default">
      <input type="file" name="document_upload" id="document_upload" class="custom-file-input"/>
</label>
<input type="hidden" name="document_upload" value="<?php echo $row;?>"
      </div>
      <div class="col-sm-2"></div>
    </div> 
<?php   
                $count=0;}
                $count++;}
              ?>
    </div>
    <div class="panel-footer">
    <div class="form-group">        
      
        <button type="submit" class="btn btn-primary center-block">SUBMIT</button>
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