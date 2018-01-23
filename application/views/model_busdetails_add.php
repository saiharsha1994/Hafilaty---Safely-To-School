<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;color:gray;margin:10px;font-family:verdana">SCHOOLY PORTAL</h4>
      </div>
      <div class="modal-body">
        <div class="panel panel-primary">
    <div class="panel-heading">
    <span class="glyphicon glyphicon-plus"></span>
    Add New Bus</div>
    <div class="panel-body" style="color:gray;font-size:12px;border:1px solid steelblue">
      <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo site_url('Welcome/addbus_upload');?>">
  
          <div class="form-group">
      <label class="control-label col-sm-3" for="bustype">Bus Name</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" name="bus_name" id="bus_name" required>
      </div>
      <div class="col-sm-2"></div>
      
    </div>

          <div class="form-group">
      <label class="control-label col-sm-3" for="bustype">Bus Type</label>
      <div class="col-sm-7">          
                    <select class="form-control" name="bus_type" required>
                    <option></option>
          <option>10 Seater</option>
          <option>20 Seater</option>
          <option>30 Seater</option>
        </select>
      </div>
      <div class="col-sm-2"></div>
      
    </div>
      <div class="form-group">
      <label class="control-label col-sm-3" for="bustype">Chassis Number</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" id="chassis_number" name="chassis_number">
      </div>
      <div class="col-sm-2"></div>
      
    </div>
       <div class="form-group">
      <label class="control-label col-sm-3" for="bustype">Plate Number</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" name="plate_number" id="plate_number" required>
      </div>
      <div class="col-sm-2"></div>
      
    </div>
        <div class="form-group">
      <label class="control-label col-sm-3" for="route">Fahas</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" id="fahas" name="fahas">
      </div>
      <div class="col-sm-2"></div>
      
    </div>
      <div class="form-group">
      <label class="control-label col-sm-3" for="license">License Upload</label>
      <div class="col-sm-7">   
      <label class="btn btn-default btn-file">
      <input type="file" name="userfile" class="custom-file-input" />
      
</label>
      </div>
      <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="platenumber">License Expiry Date</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="license_expiry" id="datepicker" />
      </div>
     <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="platenumber">License Renewal Date</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="license_renew" id="datepicker2" />
      </div>
     <div class="col-sm-2"></div>
    </div>
          <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">MVPI Upload</label>
      <div class="col-sm-7">   
      <label class="btn btn-default btn-file">
      <input type="file" name="userfile1" class="custom-file-input" />
      
</label>
      </div>
      <div class="col-sm-2"></div>
    </div>
       <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">MVPI Expiry Date</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="mvpi_expiry" id="datepicker1" />
      </div>
      <div class="col-sm-2"></div>
    </div>

    
  
    </div>
    <div class="panel-footer">
    <div class="form-group">        
        <button type="submit"  class="btn btn-primary center-block" >SUBMIT</button>
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