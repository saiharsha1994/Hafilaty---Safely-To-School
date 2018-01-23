<div class="panel panel-primary">
<div class="panel-heading">RATING FOR
<?php foreach ($d as $month){ echo $month; } ?>
</div>
<div class="panel-body">
<div class="col-sm-12">
<?php $arr_limit=array("Speed Limit Rate: ","Rash Driving Rate: ","Time Maintainance: "); foreach ($h as $row){ $count=0; ?>
<div class="col-sm-4" style="border:1px solid gray;text-align:center;margin-right:10px;margin-top:10px">
<img class="center-block img-responsive" src="http://al-amaanah.com/Schoooly/uploads/driver_image/employees.png" style="width:120px;height:120px">
<?php $limit_count=0; echo "<form class=\"form-horizontal\">\n";
foreach ($row as $value) {
$count++;
if ($count >= 2 and $count <=4) { echo "<div class=\"form-group\">\n";
?>
<label>
<?php echo "<p style=\"font-size:15px\">".$arr_limit[$limit_count]."</p>";
?>
</label>
<?php for ($i=0; $i < $value; $i++) { ?>
<img class="img-rounded" src="<?php echo base_url('Assets/images/star.png');?>" width="18px" height="18px">
<?php } $limit_count++; echo " </div>\n";
}
else{
?>
<h4> <?php echo $value;?></h4>
<br>
<?php } echo "</form>";
}
?>
</div>
<?php } ?>
</div>
</div>
</div>