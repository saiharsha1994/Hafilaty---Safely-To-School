
<div id="model_driverdetails_edit" class="modal fade" role="dialog">
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
    Edit Driver Details</div>
    <div class="panel-body" style="color:gray;font-size:12px;">
      <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo site_url('Welcome/updatedriver_upload');?>">
      <?php 
      $count = 1;
      foreach ($pf as $row) {?>
        <?php if($count === 1){?>
          <div class="form-group">
      <label class="control-label col-sm-3" for="name">Driver Name</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" name="driver_name" id="driver_name"  value="<?php echo $row;?>" required>
      </div>
      <div class="col-sm-2"></div>
      
    </div>
    <?php };?>
<?php if($count === 2){?>
       <div class="form-group">
      <label class="control-label col-sm-3" for="mobile">Mobile</label>
      <div class="col-sm-7">          
          <input type="number" class="form-control" name="mobile" id="mobile"  value="<?php echo $row;?>" required>
      </div>
      <div class="col-sm-2"></div>
      
    </div>
    <?php };?>
    
    <?php if($count === 3){?>
      <div class="form-group">
      <label class="control-label col-sm-3" for="password">Password</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" id="password" name="password" value="<?php echo $row;?>">
      </div>
      <div class="col-sm-2"></div>
      
    </div>
    <?php };?>
    <?php if($count === 4){?>
       <div class="form-group">
      <label class="control-label col-sm-3" for="nationality">Nationality</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" name="nationality" id="nationality" value="<?php echo $row;?>" required>
      </div>
      <div class="col-sm-2"></div>
      
    </div>
     <?php };?>
     <?php if($count === 5){?>
        <div class="form-group">
      <label class="control-label col-sm-3" for="IqamaNumber">Iqama Number</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" id="IqamaNumber" name="IqamaNumber" value="<?php echo $row;?>">
      </div>
      <div class="col-sm-2"></div>
      
    </div><?php };?>
    <?php if($count === 6){?>
      <div class="form-group">
      <label class="control-label col-sm-3" for="IqamaExpiryDate">Iqama Expiry Date</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="IqamaExpiryDate" id="datepicker"  value="<?php echo $row;?>" />
      </div>
     <div class="col-sm-2"></div>
    </div><?php };?>
    <?php if($count === 7){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Iqama Upload<br>
      *img/pdf*</label>
      <div class="col-sm-7">   
     <?php if($row!="null"){ ?>
      <button class="form-control" id="doc">
                        <a 
                        href="<?php echo base_url();?>index.php/Welcome/managedriver_download/<?php echo $row;?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>IQAMA
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
    <?php if($count === 8){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="PassportNumber">Passport Number</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" name="PassportNumber" id="PassportNumber" value="<?php echo $row;?>" required>
      </div>
      <div class="col-sm-2"></div>
      
    </div><?php };?>
    <?php if($count === 9){?>
          <div class="form-group">
      <label class="control-label col-sm-3" for="PassportExpiryDate">Passport Expiry Date</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="PassportExpiryDate" id="datepicker1"  value="<?php echo $row;?>" />
      </div>
     <div class="col-sm-2"></div>
    </div><?php };?>
    <?php if($count === 10){?>
       <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Passport Upload<br>
      *img/pdf*</label>
      <div class="col-sm-7">   
     <?php if($row!="null"){ ?>
      <button class="form-control" id="doc1">
                        <a 
                        href="<?php echo base_url();?>index.php/Welcome/managedriver_download/<?php echo $row;?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>PASSPORT
                  </a>
                  </button> 
                  <?php };?>
     <label class="btn btn-default">
      <input type="file" name="userfile1" id="userfile1" class="custom-file-input"/>
</label>
<input type="hidden" name="userfile1_doc" value="<?php echo $row;?>">
      </div>
      <div class="col-sm-2"></div>
    </div>
    <?php };?>
    <?php if($count === 11){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="LicenseNumber">License Number</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" name="LicenseNumber" id="LicenseNumber" value="<?php echo $row;?>" required>
      </div>
      <div class="col-sm-2"></div>
      
    </div>
    <?php };?>
    <?php if($count === 12){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="LicenseExpiryDate">License Expiry Date</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="LicenseExpiryDate" id="datepicker2"  value="<?php echo $row;?>" />
      </div>
     <div class="col-sm-2"></div>
    </div>
    <?php };?>
    <?php if($count === 13){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">License Upload<br>
      *img/pdf*</label>
      <div class="col-sm-7">   
     <?php if($row!="null"){ ?>
      <button class="form-control" id="doc2">
                        <a 
                        href="<?php echo base_url();?>index.php/Welcome/managedriver_download/<?php echo $row;?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>LICENSE
                  </a>
                  </button> 
                  <?php };?>
     <label class="btn btn-default">
      <input type="file" name="userfile2" id="userfile2" class="custom-file-input"/>
</label>
<input type="hidden" name="userfile2_doc" value="<?php echo $row;?>">
      </div>
      <div class="col-sm-2"></div>
    </div>
    <?php };?>
    <?php if($count === 14){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="AsaignBus">Asaign Bus</label>
      <div class="col-sm-7">          
          <select class="form-control" name="assignbus" onclick="optionselect()">
      <option selected value="<?php echo $row;?>"><?php echo $row;?></option>
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
    <?php };?>
<script type="text/javascript">
    function optionselect() {
    $('.col-sm-7 option:eq(0)').hide();
    }
    </script>
    <?php if($count === 15){?>
    <div class="form-group">
    <label class="control-label col-sm-3" for="fahas">Photo Upload<br>
      *img*</label>
      <div class="col-sm-7">   
     <?php if($row!="null"){ ?>
      <button class="form-control" id="doc3">
                        <a 
                        href="<?php echo base_url();?>index.php/Welcome/managedriver_download_photo/<?php echo $row;?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>PHOTO
                  </a>
                  </button> 
                  <?php };?>
     <label class="btn btn-default">
      <input type="file" name="userfile3" id="userfile3" class="custom-file-input"/>
</label>
<input type="hidden" name="userfile3_doc" value="<?php echo $row;?>">
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

           <script type="text/javascript">
  $(document).ready(function(){
$(function(){
    $( "#datepicker2" ).datepicker();
    $( "#format" ).change(function() {
      $( "#datepicker2" ).datepicker( "option", "dateFormat", $(this).val() );
    });
  });
  
});
</script>           

                      