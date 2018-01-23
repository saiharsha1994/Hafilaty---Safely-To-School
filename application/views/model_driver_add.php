<style type="text/css">
  input:focus:required:invalid {border: 2px solid red;}

</style>


<link href="<?php echo base_url();?>Assets/CSS/fileinput.css" rel="stylesheet">
<script src="<?php echo base_url('Assets/Javascripts/fileinput.js');?>"></script>
<div id="myModal" class="modal fade" role="dialog">
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
    Add New Driver</div>
    <div class="panel-body" style="color:gray;font-size:12px">
      <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo site_url('Welcome/add_driver_upload');?>">
    <div class="form-group">
      <label class="control-label col-sm-3" for="name">Name</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" id="driver_name" name="driver_name" required>
      </div>
     <div class="col-sm-2"></div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-3" for="mobile">Mobile</label>
      <div class="col-sm-7">
        <input type="number" class="form-control" name="mobile" id="mobile" required>
      </div>
     <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="pass">Password</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="pass" id="pass" required>
      </div>
     <div class="col-sm-2"></div>
    </div>
       <div class="form-group">
      <label class="control-label col-sm-3" for="driver_nationality">Nationality</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" name="driver_nationality" id="driver_nationality">
      </div>
      <div class="col-sm-2"></div>
    </div>
        <div class="form-group">
      <label class="control-label col-sm-3" for="iq_number">Iqama Number</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="iq_number" id="iq_number">
      </div>
      <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="iq_exp_date">Iqama Expiry Date</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="iq_exp_date" id="datepicker" />
      </div>
      <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Upload Iqama</label>
      <div class="col-sm-7">   
      <input type="file" name="iqama_upload" id="file-0a" class="file" />
      </div>
      <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="pass_number">Passport Number</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="pass_number" id="pass_number">
      </div>
     <div class="col-sm-2"></div>
    </div>
       <div class="form-group">
      <label class="control-label col-sm-3" for="pass_exp_date">Passport Expiry Date</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="pass_exp_date" id="datepicker1" />
      </div>
      <div class="col-sm-2"></div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Upload Passport</label>
      <div class="col-sm-7">   
      
      <input type="file" name="passport_upload" id="file-0a" class="file" />

      </div>
      <div class="col-sm-2"></div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-3" for="lc_number">License Number</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="lc_number" id="lc_number">
      </div>
     <div class="col-sm-2"></div>
    </div>
       <div class="form-group">
      <label class="control-label col-sm-3" for="lc_exp_number">License Expiry Date</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="lc_exp_number" id="datepicker2" />
      </div>
      <div class="col-sm-2"></div>
    </div>
      <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Upload License</label>
      <div class="col-sm-7">   
      
      <input type="file" name="license_upload" id="file-0a" class="file" />

      </div>
      <div class="col-sm-2"></div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-3" for="busto">Assign Bus</label>
      <div class="col-sm-7">
        <select class="form-control" name="assignbus">
      <option></option>
          <?php 
            foreach ($asain_bus as $row) {
            ?>

                <option><?php echo $row; ?>
                  
                </option>
          <?php
                }
          ?>
      </select>
      </div>
     <div class="col-sm-2"></div>
    </div>
    
    <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Photo</label>
                <div class="col-sm-7">
                 <input id="file-0a" class="file" type="file" name="photo_upload" multiple data-min-file-count="1">
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
<script type="text/javascript">
  $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $( "#datepicker2" ).datepicker();
  //Pass the user selected date format 
    $( "#format" ).change(function() {
      $( "#datepicker2" ).datepicker( "option", "dateFormat", $(this).val() );
    });
  });
  
});
</script>