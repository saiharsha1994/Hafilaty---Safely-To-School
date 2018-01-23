
<div id="model_busdetails_edit" class="modal fade" role="dialog">
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
    Edit Bus Details</div>
    <div class="panel-body" style="color:gray;font-size:12px;border:1px solid steelblue">
      <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo site_url('Welcome/updatebus_upload');?>">
      <?php 
      $count = 1;
      foreach ($edit_data as $row) {?>
        <?php if($count === 1){?>
          <div class="form-group">
      <label class="control-label col-sm-3" for="bustype">Bus Name</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" name="bus_name" id="bus_name"  value="<?php echo $row;?>" required>
      </div>
      <div class="col-sm-2"></div>
      
    </div>
    <?php };?>
<?php if($count === 2){?>
          <div class="form-group">
      <label class="control-label col-sm-3" for="bustype">Bus Type</label>
      <div class="col-sm-7">  
                    <select class="form-control" name="bus_type" onclick="optionselect()"  required >
                    <option selected value="<?php echo $row;?>"><?php echo $row;?></option>
          <option value="10 Seater">10 Seater</option>
          <option value="20 Seater">20 Seater</option>
          <option value="30 Seater">30 Seater</option>
        </select>
      </div>
      <div class="col-sm-2"></div>
      
    </div>
    <?php };?>
    <script type="text/javascript">
    function optionselect() {
    $('.col-sm-7 option:eq(0)').hide();
    }
                      
                      
                      </script>
    <?php if($count === 3){?>
      <div class="form-group">
      <label class="control-label col-sm-3" for="bustype">Chassis Number</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" id="chassis_number" name="chassis_number" value="<?php echo $row;?>">
      </div>
      <div class="col-sm-2"></div>
      
    </div>
    <?php };?>
    <?php if($count === 4){?>
       <div class="form-group">
      <label class="control-label col-sm-3" for="bustype">Plate Number</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" name="plate_number" id="plate_number" value="<?php echo $row;?>" required>
      </div>
      <div class="col-sm-2"></div>
      
    </div>
     <?php };?>
     <?php if($count === 5){?>
        <div class="form-group">
      <label class="control-label col-sm-3" for="route">Fahas</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" id="fahas" name="fahas" value="<?php echo $row;?>">
      </div>
      <div class="col-sm-2"></div>
      
    </div><?php };?>
    <?php if($count === 6){?>
      <div class="form-group">
      <label class="control-label col-sm-3" for="license">License Upload<br>*img/pdf*</label>
      <div class="col-sm-7">   
      <?php if($row!="null"){ ?>
      <button class="form-control" id="doc">
                        <a 
                        href="<?php echo base_url();?>index.php/Welcome/managebus_download/<?php echo $row;?> ">
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
    </div><?php };?>
    <?php if($count === 7){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="platenumber">License Expiry Date</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="license_expiry" id="datepicker"  value="<?php echo $row;?>" />
      </div>
     <div class="col-sm-2"></div>
    </div><?php };?>
    <?php if($count === 8){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="platenumber">License Renewal Date</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="license_renew" id="datepicker2"  value="<?php echo $row;?>" />
      </div>
     <div class="col-sm-2"></div>
    </div><?php };?>
    <?php if($count === 9){?>
          <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">MVPI Upload<br>
      *img/pdf*</label>
      <div class="col-sm-7">   
     <?php if($row!="null"){ ?>
      <button class="form-control" id="doc1">
                        <a 
                        href="<?php echo base_url();?>index.php/Welcome/managebus_download/<?php echo $row;?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>MVPI
                  </a>
                  </button> 
                  <?php };?>
     <label class="btn btn-default">
      <input type="file" name="userfile1" id="userfile1" class="custom-file-input"/>
</label>
<input type="hidden" name="userfile1_doc" value="<?php echo $row;?>">
      </div>
      <div class="col-sm-2"></div>
    </div><?php };?>
    <?php if($count === 10){?>
       <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">MVPI Expiry Date</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="mvpi_expiry" id="datepicker1" value="<?php echo $row;?>" />
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

                      

                      