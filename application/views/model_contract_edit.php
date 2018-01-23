
<link href="<?php echo base_url();?>Assets/CSS/fileinput.css" rel="stylesheet">
<script src="<?php echo base_url('Assets/Javascripts/fileinput.js');?>"></script>
<div id="model_contract_edit" class="modal fade" role="dialog">
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
    Edit Contract</div>
    <div class="panel-body" style="color:gray;font-size:12px;border:1px solid steelblue">
      <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo site_url('Welcome/update_contract');?>">
      <input type="hidden" name="contractid" value=<?php echo $contract_id[0]?>>
      <?php 
      $count = 1;
      foreach ($edit_data as $row) {?>
        <?php if($count === 1){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="name">Contract Date</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="contract_date" id="datepicker" value="<?php echo $row;?>" />
      </div>
     <div class="col-sm-2"></div>
    </div><?php }?>
    <?php if($count === 2){?>
       <div class="form-group">
      <label class="control-label col-sm-3" for="bustype">Vendor Name</label>
      <div class="col-sm-7">          
          <input type="text" class="form-control" name="vendor_name" id="vendor_name" value="<?php echo $row;?>">
      </div>
      <div class="col-sm-2"></div>
    </div> <?php }?>
<?php if($count === 3){?>
        <div class="form-group">
      <label class="control-label col-sm-3" for="route">Vendor Email</label>
      <div class="col-sm-7">          
        <input type="email" class="form-control" name="vendor_email" id="vendor_email" value="<?php echo $row;?>">
      </div>
      <div class="col-sm-2"></div>
    </div><?php }?>
     <?php if($count === 4){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="chassis">Vendor Mobile</label>
      <div class="col-sm-7">
        <input type="number" class="form-control" name="vendor_mobile" id="vendor_mobile" value="<?php echo $row; ?>" />
      </div>
      <div class="col-sm-2"></div>
    </div>
    <?php }?>
<?php if($count === 5){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="platenumber">Bus Provided</label>
      <div class="col-sm-7">
        <input type="number" class="form-control" name="bus_provided" id="bus_provided"  value="<?php echo $row ;?>">
      </div>
     <div class="col-sm-2"></div>
    </div><?php }?>
<?php if($count === 6){?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="platenumber">Driver Provided</label>
      <div class="col-sm-7">
        <input type="number" class="form-control" name="driver_provided" id="driver_provided" value="<?php echo $row ;?>">
      </div>
     <div class="col-sm-2"></div>
    </div><?php }?>
    <?php if($count === 7){?>
       <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Expiry Date</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="expiry_date" id="datepicker1" value="<?php echo $row ;?>" />
      </div>
      <div class="col-sm-2"></div>
    </div> <?php }?>
  <?php if($count === 8){?>
     <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Additional Details</label>
      <div class="col-sm-7">          
        <textarea class="form-control" rows="3" id="comment" name="addi_details"  ><?php echo $row ;?></textarea>
      </div>
      <div class="col-sm-2"></div>
    </div><?php }?>
         <?php if($count === 9){?>
      <div class="form-group">
      <label class="control-label col-sm-3" for="fahas">Upload Contract<br>*img/pdf*</label>
      <div class="col-sm-7"> 
      <?php if($row){ ?>
      <button class="form-control" id="doc">
                        <a 
                        href="<?php echo base_url();?>index.php/Welcome/contract_download/<?php echo $row;?> ">
                    <span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Document
                  </a>
                  </button> 
                  <?php };?>
     <label class="btn btn-default">
      <input type="file" name="userfile" id="userfile" class="custom-file-input"/>
</label>
      </div>
      <div class="col-sm-2">
        <input type="hidden" name="user_file_default" value="<?php echo $row;?>" >
      </div>
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