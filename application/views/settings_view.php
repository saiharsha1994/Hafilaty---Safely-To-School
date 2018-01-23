
<!DOCTYPE html>
<html lang="en">
<head>
  <head>
  <title>settings||AdminPortal</title>
  <link rel="shortcut icon" href="<?php echo base_url('Assets/images/favicon.png');?>" />
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="<?php echo base_url('css/main.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('Assets/CSS/sidebar.css')?>" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  </head>

<body onload="active()">
  <div id="wrapper">
<?php include 'sidebar.php' ?>
<section class="main-section">
<div class="content">
<div class="form-group">
<button id="menuToggler" style="background-color:white;border-color:transparent"><span class="glyphicon glyphicon-list" style="color:#2196f3;margin-right:10px"></span><strong style="font-size:18px">SETTINGS</strong></button>
</div>
</div>
</section>
<div class="container">
<div class="jumbotron">
<div class="container-fluid">
<div class="row">
<div class="col-sm-8" style="">
<div class="panel panel-primary">
<div class="panel-heading">System Settings</div>
<div class="panel-body">
<form class="form-horizontal" id="form">
<fieldset>
<div class="form-group">
<label class="col-md-4 control-label" for="fn">System Name</label>
<div class="col-md-6">
<input id="system_name" name="system_name" type="text" placeholder="System Name" class="form-control input-sm" value="<?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?>" required>
<span style="color:red;font-size:12px" id="err1"></span>
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="ln">System Title</label>
<div class="col-md-6">
<input id="system_title" name="system_title" type="text" placeholder="System Title" class="form-control input-sm" required="" value="<?php echo $this->db->get_where('settings' , array('type' =>'system_title'))->row()->description;?>" required>
<span style="color:red;font-size:12px" id="err2"></span>
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="cmpny">Address</label>
<div class="col-md-6">
<input id="address" name="address" type="text" placeholder="Address" class="form-control input-sm" required="" value="<?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?>">
<span style="color:red;font-size:12px" id="err3"></span>
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="email">Phone</label>
<div class="col-md-6">
<input id="phone" name="phone" type="text" placeholder="Phone" class="form-control input-sm" required="" value="<?php echo $this->db->get_where('settings' , array('type' =>'phone'))->row()->description;?>">
<span style="color:red;font-size:12px" id="err4"></span>
</div>
</div>
<div class="container" id="loader" >
  <div class="jumbotron text-center center-block" style="background: gray;color: white"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate" ></span> ...LOADING...
  </div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="add1">Running Session</label>
<div class="col-md-6">
<select name="running_year" id="running_year" placeholder="Running Session" class="form-control input-sm" required>
<option value="">Select Year</option>
<?php $academic_years=$this->db->get('academic_year')->result_array();
$academic_year = $this->db->get_where('settings' , array('type' =>'running_year'))->row()->description;
foreach($academic_years as $row):
?>
<option value="<?php echo $row['academic_year'];?>" <?php if($row['academic_year']==$academic_year)echo 'selected';?>>
<?php echo $row['academic_year'];?>
</option>
<?php endforeach; ?>
</select>
<span style="color:red;font-size:12px" id="err5"></span>
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="city">School location</label>
<div class="col-md-6">
<input id="school_location" name="school_location" type="text" placeholder="Example:24.4554933,54.3952806" class="form-control input-sm" required="" value="<?php echo $this->db->get_where('settings' , array('type' =>'school_location'))->row()->description;?>" required>
</div>
<span style="color:red;font-size:12px" id="err6"></span>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="zip">Speed Limit</label>
<div class="col-md-6">
<input id="speed_limit" name="speed_limit" type="text" placeholder="speed limit" class="form-control input-sm" required="" value="<?php echo $this->db->get_where('settings' , array('type' =>'speed_limit'))->row()->description;?>" required>
<span style="color:red;font-size:12px" id="err7"></span>
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="ctry">School Fence</label>
<div class="col-md-6">
<input id="school_fence" name="school_fence" type="text" placeholder="school Fence" class="form-control input-sm" required="" value="<?php echo $this->db->get_where('settings' , array('type' =>'school_fence'))->row()->description;?>" required>
<span style="color:red;font-size:12px" id="err8"></span>
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="submit"></label>
<div class="col-md-6">
<button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-md" style="width:100px">Save</button>
</div>
</div>
</fieldset>
</form>
</div>
</div>
</div>
<div class="col-sm-4" style=""></div>
</div>
</div>
</div>
</div>

<h5 style="margin-left:100px;text-align:left;font-size: 15px"><a href="http://www.valuetechsa.com/" target="_blank" style="color: black">copyright@VT</a></h5>
</div>
 
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <!-- Call functions on document ready -->
    <script>
        function active(){
          $('#loader').hide();
          $(".main-nav li").removeClass("active"),$("#Settings").addClass("active")}function save(){var b=document.getElementById("system_name").value,c=document.getElementById("system_title").value,d=document.getElementById("address").value,e=document.getElementById("phone").value,f=document.getElementById("running_year").value,g=document.getElementById("school_location").value,h=document.getElementById("speed_limit").value,i=document.getElementById("school_fence").value;if(b&&c&&d&&e&&f&&g&&h&&i){var j=$("#form").serialize();$('#loader').show();
          $.ajax({url:"<?php echo site_url('Welcome/update_settings')?>",type:"POST",data:j,dataType:"JSON",success:function(a){"success"==a.response&&(alert("Updated Successfully!"),window.location.href="<?php echo base_url() . 'index.php/Welcome/settings';?>")},error:function(){console.clear(),console.log(data)}})}else document.getElementById("err1").innerHTML="value required",document.getElementById("err2").innerHTML="value required",document.getElementById("err3").innerHTML="value required",document.getElementById("err4").innerHTML="value required",document.getElementById("err5").innerHTML="value required",document.getElementById("err6").innerHTML="value required",document.getElementById("err7").innerHTML="value required",document.getElementById("err8").innerHTML="value required"}$(document).ready(function(){appMaster.menuToggler(),appMaster.anotherFunction()});
    </script>
</div>
</body>

</html>
