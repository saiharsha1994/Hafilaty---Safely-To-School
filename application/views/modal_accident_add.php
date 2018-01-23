<div id="myModal123" class="modal fade" role="dialog">
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
      <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo site_url('Welcome/add_incident');?>">
      <div class="form-group">
      <label class="control-label col-sm-3" for="date">Date</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="incident_date" id="datepicker2" required />
      </div>
      <div class="col-sm-2"></div>
    </div>

   <div class="form-group">
      <label class="control-label col-sm-3" for="Details">Details</label>
      <div class="col-sm-7">          
        <textarea type="text" class="form-control" name="incident_details" id="incident_details"></textarea>
      </div>
      <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="report">Upload Report<br>*img/pdf*</label>
      <div class="col-sm-7">   
	<label class="btn btn-default btn-file">
      <input type="file" name="userfile" id="file-0a" class="custom-file-input" />
      </div>
      <div class="col-sm-2"></div>
    </div>
   <div class="form-group">
      <label class="control-label col-sm-3" for="select_bus">Select Bus</label>
      <div class="col-sm-7">
        <select class="form-control" name="incident_bus" required>
	<option style="display:none"></option>
          <?php 
            $count;
            foreach ($bus_list as $row) {
              $count = 0;
              foreach ($row as $key => $value) {
                 $count++;
                 if ($count == 1) {
                     $v = $value;
                 }
                 if ($count == 2) {
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
    
    <div class="form-group">
      <label class="control-label col-sm-3" for="select_driver">Select Driver</label>
      <div class="col-sm-7">
        <select class="form-control" name="incident_driver" required>
	<option style="display:none"></option>
          <?php 
            $count;
            foreach ($driver_list as $row) {
              $count = 0;
              foreach ($row as $key => $value) {
                 $count++;
                 if ($count == 1) {
                     $v = $value;
                 }
                 if ($count == 2) {
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
      <label class="control-label col-sm-3" for="fahas">Upload Document<br>*img/pdf*</label>
      <div class="col-sm-7">   
	<label class="btn btn-default btn-file">
      <input type="file" name="document_upload" id="file-0a" class="custom-file-input" />
      </div>
      <div class="col-sm-2"></div>
    </div> 
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