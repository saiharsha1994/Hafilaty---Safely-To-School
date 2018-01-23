<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="font-size: 12px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;color:gray;margin:10px;font-family:verdana">ADMIN PORTAL SCHOOOLY</h4>
      </div>
      <div class="modal-body">
        <div class="panel panel-primary">
    <div class="panel-heading">
    <span class="glyphicon glyphicon-plus"></span>
    Add New Contract</div>
    <div class="panel-body" style="color:gray;font-size:12px;border:1px solid steelblue">
<!--<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url('Welcome/contract_add_details');?>">-->



<?php echo form_open_multipart('Welcome/contract_add_details' , array('class' => 'form-horizontal form-groups-bordered validate'));?>


 <div class="form-group">
      <label class="control-label col-sm-3" for="name">Contract Date</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="contract_date" id="datepicker" required />
      </div>
     <div class="col-sm-2"></div>
    </div>
       <div class="form-group">
      <label class="control-label col-sm-3" for="bustype">Vendor Name</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" name="vendor_name" id="vendor_name" required>
      </div>
      <div class="col-sm-2"></div>
      
    </div>
        <div class="form-group">
      <label class="control-label col-sm-3" for="route">Vendor Email</label>
      <div class="col-sm-7">          
        <input type="email" class="form-control" name="vendor_email" id="vendor_email" required>
      </div>
      <div class="col-sm-2"></div>
      
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="chassis">Vendor Mobile</label>
      <div class="col-sm-7">
        <input type="number" class="form-control" name="vendor_mobile" id="vendor_mobile" required />
      </div>
      <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="platenumber">Bus Provided</label>
      <div class="col-sm-7">
        <input type="number" class="form-control" name="bus_provided" id="bus_provided"  required>
      </div>
     <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="platenumber">Driver Provided</label>
      <div class="col-sm-7">
        <input type="number" class="form-control" name="driver_provided" id="driver_provided" required>
      </div>
     <div class="col-sm-2"></div>
    </div>
       <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Expiry Date</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="expiry_date" id="datepicker1"  required />
      </div>
      <div class="col-sm-2"></div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Additional Details</label>
      <div class="col-sm-7">          
        <textarea class="form-control" rows="3" id="comment" name="addi_details" placeholder="Enter Text here"></textarea>
      </div>
      <div class="col-sm-2"></div>
    </div>
      <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Upload Contract</label>
      <div class="col-sm-7">   
      <label class="btn btn-default btn-file">
      <input type="file" name="userfile" class="custom-file-input" />
</label>
      </div>
      <div class="col-sm-2"></div>
    </div>
    
  
    </div>
    <div class="panel-footer">
    <div class="form-group">        
        <button type="submit"  class="btn btn-primary center-block" >SUBMIT</button>
      <!--</form>-->
	  
	  <?php echo form_close();?>
	  
    </div></div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>