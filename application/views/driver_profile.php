<style type="text/css">
  input:focus:required:invalid {border: 2px solid red;}
</style>

<link href="<?php echo base_url();?>Assets/CSS/fileinput.css" rel="stylesheet">
<script src="<?php echo base_url('Assets/Javascripts/fileinput.js');?>"></script>
<div id="driver_profile_view" class="modal fade" role="dialog">
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
    Driver Profile</div>
    <div class="panel-body" style="color:gray;font-size:13px">
      <form class="form-horizontal">

      <table class="table table-reflow">
 
  <tbody>
    <?php 
    //print_r($pf);
                  $count = 1;
                  foreach ($pf as $row) {

                          if($count === 1){?>
                          <tr><th>PHOTO</th>
                              <td><img style="border:1px solid gray" src="<?php echo base_url('uploads/driver_image/'.$row);?>">
                              </td>
                              </tr>
                              <?php 
                          }
                          if($count === 2){?>
                            <tr><th>DRIVER NAME</th>
                              <td scope="row"><?php
                              if($row!="null"){
                               echo $row;}
                               else{
                                echo "---";
                               } 

                               ?>
                              </td></tr>
              <?php 
                          }
                          if($count === 3){?>
                            <tr><th>DRIVER ID</th>
                              <td scope="row"><?php
                              if($row !="null"){
                               echo $row;}
                               else{
                                echo "---";
                               } 

                               ?>
                              </td></tr>
              <?php       }
                          if($count === 4){?>
                            <tr><th>NATIONALITY</th>
                              <td><?php
                              if($row !="null"){
                               echo $row;}
                               else{
                                echo "---";
                               }

                                ?></td></tr>
              <?php       }


                if($count === 5){?>
                  <tr><th>MOBILE</th>
                              <td><?php
                              if($row !="null"){
                               echo $row;}
                               else{
                                echo "---";
                               }

                                ?></td></tr>
              <?php       }

                if($count === 6){?>
                  <tr><th>PASSWORD</th>
                              <td><?php
                              if($row !="null"){
                               echo $row; 
                             }else{
                              echo "---";
                             }

                               ?></td></tr>
              <?php       }

                if($count === 7){?>
                  <tr><th>ASSIGNED BUS</th>
                              <td><?php
                              if($row){
                               echo $row;}
                               else{
                                echo "---";
                               }

                                ?></td></tr>
              <?php       }

              if($count === 8){?>
                <tr><th>PICKUP ROUTE ID</th>
                              <td><?php 
                              if($row){
                              echo $row;}
                              else{
                                echo "---";
                              } 
                              ?></td></tr>
              <?php       }

                if($count === 9){?>
                  <tr><th>DROP ROUTE ID</th>
                              <td><?php 
                              if($row){
                              echo $row; }
                              else{
                                echo "---";
                              }

                              ?></td></tr>
              <?php       }

                          if ($count === 10) {
              ?><tr><th>IQAMA NUMBER:</th>
                              <td><?php
                                if($row !="null"){
                              echo $row; }
                              else{
                                echo "---";
                              } ?>
                              </td></tr>

                              <?php       }

                          if ($count === 11) {
              ?><tr><th>IQAMA EXPIRY DATE:</th>
                              <td>
                                <?php if($row !="null"){
                              echo $row; }
                              else{
                                echo "---";
                              } ?>
                              </td></tr>

                              <?php       }

                          if ($count === 12) {
              ?><tr><th>PASSPORT NUMBER</th>
                              <td>
                                <?php if($row !="null"){
                              echo $row; }
                              else{
                                echo "---";
                              } ?>
                              </td></tr>

                              <?php       }

                          if ($count === 13) {
              ?><tr><th>PASSPORT EXPIRY DATE</th>
                              <td>
                                <?php if($row !="null"){
                              echo $row; }
                              else{
                                echo "---";
                              } ?>
                              </td></tr>

                              <?php       }

                          if ($count === 14) {
              ?><tr><th>LICENSE NUMBER</th>
                              <td>
                                <?php 
                                if($row!="null"){
                                echo $row;}
                                else{
                                  echo "---";
                                } ?>

                              </td></tr>

                              <?php       }

                              if ($count === 15) {
              ?><tr><th>LICENSE EXPIRY DATE</th>
                              <td>
                                <?php 
                                if($row !="null"){
                                echo $row;}
                                else{
                                  echo "---";
                                } ?>
                              </td></tr>

                              <?php       }

                              if ($count === 16) {
              ?><tr><th>IQAMA</th>
                              <td>
                              <?php 
                                if($row!="null"){?>
                                <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url();?>index.php/Welcome/managedriver_download/<?php echo $row;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                                <?php
                                }
                                else{
                                  echo "---";
                                } ?>
                              </td></tr>

                              <?php       }

                              if ($count === 17) {
              ?><tr><th>PASSPORT</th>
                              <td>
                              <?php 
                                if($row!="null"){?>
                                <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url();?>index.php/Welcome/managedriver_download/<?php echo $row;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                                <?php
                                }
                                else{
                                  echo "---";
                                } ?>
                              </td></tr>

                              <?php       }

                          if ($count === 18) {
              ?><tr><th>LICENSE</th>
                              <td>
                              <?php 
                                if($row!="null"){?>
                                <button class="btn btn-default custom"><a style="text-decoration: none;" href="<?php echo base_url();?>index.php/Welcome/managedriver_download/<?php echo $row;?>"><span class="glyphicon glyphicon-download" style="padding-right:5px"></span>Download</a></button>
                                <?php
                                }
                                else{
                                  echo "---";
                                } ?>
                              </td></tr>
              <?php
                  $count = 0;
                          }
                  $count++;

               
                          }
              ?>
   
  </tbody>
</table>
      
      </form>
    </div></div>
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