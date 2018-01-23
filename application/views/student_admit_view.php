<!DOCTYPE html>
<html>
  <head>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- font Awesome CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">

    <style type="text/css">
        .main-nav > li:hover{background-color:#1976d2;}
        li.active {background: #1976d2;}
        .jumbotron{background: white}

        a {
           text-decoration: none !important;
        }
        .panel-heading{
          background: grey;
        }
    </style>

    <script type="text/javascript">
      $(document).ready(function(){
      $('.collapse').on('shown.bs.collapse', function(){
        $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
        }).on('hidden.bs.collapse', function(){
        $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
        });
      });

      $( function() {
        $('.datepicker').each(function(){
    $(this).datepicker();
});
         });

  

    </script>
    
  </head>

  <body onload="active()">
  <div id="wrapper">
        <?php include 'sidebar.php' ?>
          <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">ADMIT STUDENT</strong></button>
                </div>
            </div>
        </section>
<div class="container">
 <p></p>
 <p></p>
 <p></p>
  <div class="row">
  <div class="col-sm-12" style="">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">
    <i class="entypo-menu"></i> 
      <?php echo "Add Student";?></a>
    </li>
    <li><a data-toggle="tab" href="#menu1"><?php echo "Add Student Documents";?></a></li>
  </ul>
  
  
  
  <div class="tab-content">

    <div id="home" class="tab-pane fade in active">
    <div class="col-sm-8" style="">
      <?php echo form_open(site_url() . '/Welcome/student1/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'id' => 'form'));?>
        <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading" style="background: grey;">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="color: white;">
          <span class="glyphicon glyphicon-minus"></span>
          Personal Section
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
          <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Student Number</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="applicationNumber" required="">
                </div>
          </div>
          <!-- <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Admission ID</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="admissionId">
                </div>
          </div> -->

          <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Academic Year</label>
                  <div class="col-sm-5">
                  <select name="academicYear" class="form-control select2" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "Select Year";?></option>
                    <?php 
                    $years = $this->db->get('academic_year')->result_array();
                    foreach ($years as $row):
                    ?>
                      <option><?php echo $row['academic_year'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
          </div>

          <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Date of Admission</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="DOA" value="" data-start-view="2">
                </div> 
          </div>

          <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Student Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="name"  value="" autofocus required="">
                </div>
          </div>

          <div class="form-group">
              <label for="field-2" class="col-sm-3 control-label">Student Photo</label>
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <!-- <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div> -->
                    <div>

                      <span class="btn btn-white btn-file">
                        <!-- <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span> -->
                        <input type="file" name="userfile" accept="*/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"></a>
                    </div>
                  </div>
                </div>
          </div>

          <div class="form-group">
              <label for="field-2" class="col-sm-3 control-label">Date of Birth</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="DOB" id="datepicker1" data-start-view="2">
                </div> 
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Place of Birth</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="birthPlace">
                </div>
          </div>

          <div class="form-group">
              <label for="field-2" class="col-sm-3 control-label">Student Gender</label>
                <div class="col-sm-5">
                  <select name="sex" class="form-control select2" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "select";?></option>
                    <option value="male"><?php echo "Male";?></option>
                    <option value="female"><?php echo "Female";?></option>
                  </select>
                </div> 
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Blood Group</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="bloodGroup">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Religion</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="religion">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Mother Tongue</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherTongue">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Student Mobile Number</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="studentMobileNumber">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Student Email</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="studentEmail">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Last School Attended</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="LastSchoolAttended">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Last School Address</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="lastSchoolAddress">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Special Care if any</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="specialCare">
                </div>
          </div>

          <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Allergies</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="allergies">
                </div>
          </div>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading" style="background: grey;">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="color: white;">
          <span class="glyphicon glyphicon-plus"></span>
          Parent's Section
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Select Parent</label>
                <div class="col-sm-5">
                  <select class="btn dropdown-toggle form-control select2" ONCHANGE="change_parent(this)" name="parent_id"  data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "Add New Parent";?></option>
                    <?php 
                    $parents = $this->db->get('parent')->result_array();
                    foreach($parents as $row):
                      ?>
                      <option value="<?php echo $row['parent_id'];?>">
                        <?php echo $row['name'];?>
                      </option>
                    <?php
                    endforeach;
                    ?>
                  </select>
                </div> 
              </div>
              <input type="hidden" class="form-control" name="childCount">
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Parent Email</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="parentEmail" required="">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="password" required="">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherName" required="">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Nationality</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherNationality">
                </div>
              </div>
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Occupation</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="profession"  value="">
                </div>
              </div>
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Employer</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherEmployer"  value="">
                </div>
              </div>
            
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Work Address</label>
                <div class="col-sm-5">
                  <textarea class="form-control" rows="5" name="fatherWorkAddress" id="fatherWorkAddress"></textarea>
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherName">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Nationality</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherNationality">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Occupation</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherOccupation"  value="">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Employer</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherEmployer"  value="">
                </div>
              </div>
             <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Work Address</label>
                <div class="col-sm-5">
                  <textarea class="form-control" rows="5" name="motherWorkAddress" id="motherWorkAddress"></textarea>
                </div>
              </div>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading" style="background: grey;">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="color: white;">
          <span class="glyphicon glyphicon-plus"></span>
          Admission Section
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Class";?></label>
                
                <div class="col-sm-5">
                  <select name="class_id" class="form-control" data-validate="required" id="class_id" required="" 
                      onchange="return get_class_sections(this.value)">
                    <option value=""><?php echo "Select";?></option>
                    <?php 
                    $classes = $this->db->get('class')->result_array();
                    foreach($classes as $row):
                      ?>
                      <option value="<?php echo $row['class_id'];?>">
                          <?php echo $row['name'];?>
                      </option>
                    <?php
                    endforeach;
                    ?>
                  </select>
                </div> 
                <div class="col-sm-3">
                    <button type="button" id="fee_amount" class="btn btn-default" style="display: none;">Info</button>
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Section";?></label>
                  <div class="col-sm-5">
                    <select name="section_id" class="form-control select2" id="section_selector_holder" required="">
                      <option value=""><?php echo "Select Section";?></option>
                      
                    </select>
                  </div>
              </div>

<div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Select Admission Type</label>
                <div class="col-sm-5">
                  <select name="selectAdmissionType" class="form-control select2" required="">
                    <option value=""><?php echo "Select";?></option>
                    <option value="Normal"><?php echo "Normal";?></option>
                    <option value="Special"><?php echo "Special";?></option>
                  </select>
                </div> 
              </div>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading" style="background: grey;">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" style="color: white;">
          <span class="glyphicon glyphicon-plus"></span>
          Contact Section
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Email</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherEmail">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Email</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherEmail">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Primary Mobile</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherPrimaryMobile">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Seconary Mobile</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherSeconaryMobile">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Primary Mobile</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherPrimaryMobile"  value="">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Secondary Mobile</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherSecondaryMobile">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Home Landline</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="homeLandline">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Father's Office Landline</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="fatherOfficeLandline">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Mother's Office Landlin</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="motherOfficeLandline">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Emergency Contact Person Name Primary</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="emergencyContactPersonNamePrimary">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Emergency Contact Person Mobile Primary</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="emergencyContactPersonMobilePrimary">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Emergency Contact Person Name Secondary</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="emergencyContactPersonNameSecondary">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Emergency Contact Person Mobile Secondary</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="emergencyContactPersonMobileSecondary">
                </div>
              </div>

      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" style="background: grey;">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" style="color: white">
          <span class="glyphicon glyphicon-plus"></span>
           Address Section
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Street Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="streetName">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Area Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="areaName">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Pin Code</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="pinCode">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Landmark Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="landmarkName">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Latitude</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="latitude"  value="">
                </div>
              </div>
<div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Longitude</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="longitude">
                </div>
              </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" style="background: grey;">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" style="color: white">
          <span class="glyphicon glyphicon-plus"></span>
          Transport Section
        </a>
      </h4>
    </div>
    <div id="collapseSeven" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Transport Facility</label>
                <div class="col-sm-5">
                  <select name="transportFacility" class="form-control select2" required="">
                    <option value=""><?php echo "Select";?></option>
                    <option value="yes"><?php echo "Yes";?></option>
                    <option value="no"><?php echo "No";?></option>
                  </select>
                </div> 
              </div>
<!-- <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Assign Bus</label>
                <div class="col-sm-5">
                  <select name="assigned_bus" class="form-control select2" data-validate="required" data-message-required="<?php echo "value_required";?>">
                    <option value=""><?php echo "select_bus";?></option>
                    <?php 
                    $buses = $this->db->get('bus_details')->result_array();
                    foreach ($buses as $row):
                    ?>
                      <option value="<?php echo $row['bus_Id'];?>"><?php echo $row['name'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div> -->
<div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Journey Type</label>
                <div class="col-sm-5">
                  <select name="journeyType" ONCHANGE="change_journey(this)" class="form-control select2" required="">
                    <option value=""><?php echo "Select";?></option>
                    <option value="oneWay"><?php echo "One Way";?></option>
                    <option value="twoWay"><?php echo "Two Way";?></option>
                  </select>
                </div> 
              </div>
              
                <div class="form-group" id="israil" style="display: none;">
                <label for="field-2" class="col-sm-3 control-label">Trip Type</label>
                <div class="col-sm-5">
                  <select name="tripType" class="form-control select2" required="">
                    <option value=""><?php echo "Select";?></option>
                    <option value="pickup"><?php echo "Pickup";?></option>
                    <option value="drop"><?php echo "Drop";?></option>
                  </select>
                </div> 
              </div>
<div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Fees Type</label>
                <div class="col-sm-5">
                  <select name="feeType" class="form-control select2" required="">
                    <option value=""><?php echo "Select";?></option>
                    <option value="monthly"><?php echo "Monthly";?></option>
                    <option value="term"><?php echo "Term";?></option>
                  </select>
                </div> 
              </div>
      </div>
    </div>
  </div>
  <!-- <div class="panel panel-default">
    <div class="panel-heading" style="background: grey;">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" style="color: white">
          <span class="glyphicon glyphicon-plus"></span>
          Fees Section
        </a>
      </h4>
    </div>
    <div id="collapseEight" class="panel-collapse collapse">
      <div class="panel-body">
          
      </div>
    </div>
  </div> -->
  <div class="panel-body">
          <div class="form-group">
                <div class="col-sm-offset-5 col-sm-3">
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
          </div>
  </div>
</div>
      <?php echo form_close();?>
</div>

      <!-- <div class="col-md-4">
        <blockquote class="blockquote-blue">
          <p>
            <strong>Student Admission Notes</strong>
          </p>
          <p>
            Admitting new students will automatically create an enrollment to the selected class in the running session.
            Please check and recheck the informations you have inserted because once you admit new student, you won't be able
            to edit his/her class,roll,section without promoting to the next session.
          </p>
        </blockquote>
      </div> -->

  </div><!-- End of tab content student admit-->

    <div id="menu1" class="tab-pane fade">
    <div class="col-sm-8" style="">
      <?php echo form_open(site_url() . '/Welcome/student/add_document' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'
              ));
          ?>   
            <div class="padded">
            
              <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "student";?></label>
                                <div class="col-sm-5">
                                    <select name="student_id" class="form-control selectboxit" style="width:100%;">
                                        <option value=""><?php echo "Select Student";?></option>
                                      <?php 
                    $students = $this->db->get('student')->result_array();
                    foreach($students as $row):
                    ?>
                                        <option value="<?php echo $row['student_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
                    endforeach;
                    ?>
                                    </select>
                                </div>
                            </div>
                            
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Child Iqama Copy";?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <!-- <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
 -->                    <div>
                      <span class="btn btn-white btn-file">
                        <!-- <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span> -->
                        <input type="file" name="iqama_copy" accept="*/*">
                      </span>
                    <!--   <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a> -->
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Child Iqama Issue Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="child_iqama_issue" value="" data-start-view="2">
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Child Iqama Expiry Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="child_iqama_expiry" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Child Iqama Issue Place";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="child_iqama_issue_place" value="" data-start-view="2">
                </div> 
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Child Passport Copy";?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <!-- <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div> -->
                    <div>
                      <span class="btn btn-white btn-file">
                        <!-- <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span> -->
                        <input type="file" name="child_passport_copy" accept="*/*">
                      </span>
                  
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Child Passport Issue Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="child_passport_issue" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Child Passport Expiry Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="child_passport_expiry" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Child Passport Issue Place";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="child_passport_issue_place" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Student Medical Insurance Id";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="student_medical_insurance_id" value="" data-start-view="2">
                </div> 
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Student Medical Insurance Expiry Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="student_medical_insurance_expiry_date" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Copy of Vaccination Card for the Student";?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <!-- <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div> -->
                    <div>
                      <span class="btn btn-white btn-file">
                        <!-- <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span> -->
                        <input type="file" name="vaccination_copy" accept="*/*">
                      </span>
                 
                    </div>
                  </div>
                </div>
              </div>
               
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Report Card Grade";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="report_card_grade" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Report Card Copy";?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <!-- <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div> -->
                    <div>
                      <span class="btn btn-white btn-file">
                        <!-- <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span> -->
                        <input type="file" name="previous_progress_report" accept="*/*">
                      </span>
                    
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "First Semester Report Card";?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <!-- <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div> -->
                    <div>
                      <span class="btn btn-white btn-file">
                        <!-- <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span> -->
                        <input type="file" name="first_semester_report_card" accept="*/*">
                      </span>
                   
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Fee_Clearance_Letter_From_Previous_School";?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    
                    <div>
                      <span class="btn btn-white btn-file">
                        
                        <input type="file" name="fee_clearence_previous_school" accept="*/*">
                      </span>
                    
                    </div>
                  </div>
                </div>
              </div>
               
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Letter Guardian Company";?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    
                    <div>
                      <span class="btn btn-white btn-file">
                        
                        <input type="file" name="letter_from_guardian_company" accept="*/*">
                      </span>
                  
                    </div>
                  </div>
                </div>  
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Transfer / School Leaving Certificate";?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                   
                    <div>
                      <span class="btn btn-white btn-file">
                        
                        <input type="file" name="transfer_certificate" accept="*/*">
                      </span>
               
                    </div>
                  </div>
                </div>
              </div>
              
               <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Father Iqama Copy";?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                   
                    <div>
                      <span class="btn btn-white btn-file">
                        
                        <input type="file" name="father_iqama_copy" accept="*/*">
                      </span>
                   
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Father Iqama Issue Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="father_iqama_issue_date" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Father Iqama Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="father_iqama_expiry" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Father Iqama Issue Place";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="father_iqama_issue_place" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Father Passport Copy";?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    
                    <div>
                      <span class="btn btn-white btn-file">
                        
                        <input type="file" name="father_passport_copy" accept="*/*">
                      </span>
                  
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Father Passport Issue Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="father_passport_issue_date" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Father Passport Expiry Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="father_passport_expiry" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Father Passport Issue Place";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="father_passport_issue_place" value="" data-start-view="2">
                </div> 
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Mother Iqama Copy";?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                  
                    <div>
                      <span class="btn btn-white btn-file">
                       
                        <input type="file" name="mother_iqama_copy" accept="*/*">
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Mother Iqama Issue Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="mother_iqama_issue_date" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Mother Iqama Expiry Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="mother_iqama_expiry" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Mother Iqama Issue Place";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="mother_iqama_issue_place" value="" data-start-view="2">
                </div> 
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Mother Passport Copy";?></label>
                
                <div class="col-sm-5">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    
                    <div>
                      <span class="btn btn-white btn-file">
               
                        <input type="file" name="mother_passport_copy" accept="*/*">
                      </span>
                  
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Mother Passport Issue Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="mother_passport_issue_date" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Mother Passport Expiry Date";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="mother_passport_expiry" value="" data-start-view="2">
                </div> 
              </div>

              <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo "Mother Passport Issue Place";?></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="mother_passport_issue_place" value="" data-start-view="2">
                </div> 
              </div>                         
                        </div>
            
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo "Add Documents";?></button>
                              </div>
               </div>
                    <?php echo form_close();?> 
        </div>             
    </div><!-- End of tab content student documents-->

  </div><!-- End of tab content-->


</div>
</div>
</div>
<h5 style="margin-left:20px;text-align:center">copyright@VT</h5>
</div>


    <!-- Bootstrap JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/script.js');?>"></script>
    <!-- Call functions on document ready -->


    <script type="text/javascript">

var child_count;

$('#fee_amount').prop('disabled', true);

  function change_journey(that){
      //alert(that.value)
      if (that.value == "oneWay") {
        document.getElementById('israil').style.display = "block";
      }else{
        document.getElementById('israil').style.display = "none";
      }
      
  }

  /*function change_class(that) {
       child_count = $("input[name=childCount]").val();
       //alert(child_count)
       if (that.value != '') {
           class_data(that.value);
       }else{
           document.getElementById('fee_amount').style.display = "none";
       }
                
  }*/

  function class_data(id){ 
    //alert(id)
    child_count = $("input[name=childCount]").val();
    //alert(child_count)
     var discounted_fee;
            if (id != '') {
              $.ajax({
                url : '<?php echo site_url();?>/Welcome/get_class_wise_fee/' + id ,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    if (child_count == 0) {
                      $('[id="fee_amount"]').text("Fee  "+data.fee_amount);   
                    document.getElementById('fee_amount').style.display = "block"; 
                    }
                    else{
                      if (child_count == 1) {
                      var discounted_fee = (90 / 100) * data.fee_amount;
                    }
                    else if (child_count == 2) {
                      discounted_fee = (80 / 100) * data.fee_amount;
                    }
                    else if (child_count >= 3) {
                      discounted_fee = (70 / 100) * data.fee_amount;
                    }
                    $('[id="fee_amount"]').text("Fee  "+data.fee_amount+"  Disc fee  "+discounted_fee);   
                    document.getElementById('fee_amount').style.display = "block"; 
                    }          
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   alert('Error get data from ajax');
                }
            });
            }
            else{
           document.getElementById('fee_amount').style.display = "none";
       }


  }

  function get_class_sections(class_id) {

      $.ajax({
            url: '<?php echo site_url();?>/Welcome/get_class_section/' + class_id ,
            async:false, 
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

      class_data(class_id);

}

  function change_parent(that) {
    child_count = 0;
            if (that.value == '') {
              
              $('#form')[0].reset();
              
            }else{
               parent_data(that.value);
            }
            
  }

  function parent_data(id){ 
     
            $.ajax({
                url : '<?php echo site_url();?>/Welcome/get_parent/' + id ,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    //alert(data[0].parent_id);
                    //drawTable(data);
                    $('[name="parentEmail"]').val(data[0].email);
                    $('[name="password"]').val(data[0].password);
                    $('[name="fatherName"]').val(data[0].name);
                    $('[name="fatherNationality"]').val(data[0].father_nationality);
                    $('[name="profession"]').val(data[0].profession);
                    $('[name="fatherEmployer"]').val(data[0].father_empr_sponsor_name);
                    $('[name="fatherWorkAddress"]').val(data[0].father_work_address);
                    $('[name="motherName"]').val(data[0].mother_name);
                    $('[name="motherNationality"]').val(data[0].mother_nationality);
                    $('[name="motherOccupation"]').val(data[0].mother_occupation);
                    $('[name="motherEmployer"]').val(data[0].mother_empr_sponsor_name);
                    $('[name="motherWorkAddress"]').val(data[0].mother_work_address);
                    $('[name="childCount"]').val(data[0].child_count);
                   
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   alert('Error get data from ajax');
                }
            });

  }

  

</script>
<script type="text/javascript">
    document.getElementById('test').addEventListener('change', function () {
    var style = this.value == "oneWay" ? 'block' : 'none';
    document.getElementById('hidden_div').style.display = style;
});
</script>
  </body>
</html>