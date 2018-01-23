<div id="beh_myModal" class="modal fade" role="dialog">
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
    Add New Misbehaviour</div>
    <div class="panel-body" style="color:gray;font-size:12px">
      <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo site_url('Welcome/add_misbehaviour');?>">
      <div class="form-group">
      <label class="control-label col-sm-3" for="date">Date</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="date" id="datepicker1" required />
      </div>
      <div class="col-sm-2"></div>
    </div>

  <div class="form-group">
      <label class="control-label col-sm-3" for="select_bus">Select Bus</label>
      <div class="col-sm-7">
        <select class="form-control" name="select_bus">
		<option style="display:none"></option>
            <?php ///student_list
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
      <label class="control-label col-sm-3" for="select_student">Select Student</label>
      <div class="col-sm-7">
        <select class="form-control" name="select_student" required>
	<option style="display:none"></option>
          <?php
            $count;
            foreach ($student_list as $row) {
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
      <label class="control-label col-sm-3" for="details">Details</label>
      <div class="col-sm-7">          
	<textarea class="form-control" rows="5" name="details" id="comment" required placeholder="write something here..." ></textarea>
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