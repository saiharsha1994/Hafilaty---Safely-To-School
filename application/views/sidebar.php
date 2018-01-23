<aside id="sideBar">
	<ul class="main-nav1">
		<li class="nav-brand" style="margin-bottom:5px;height:50px">
		</li>
		<li class="main-search">
			<h4 style="margin-bottom:40px;color:white;text-align: center;">Welcome Admin</h4>
		</li>
	</ul>
	<ul class="main-nav" style="margin:5px">
		<li>
			<a href="#"></a>
		</li>
		<li style="padding:2px;height:45px" id="dashboardid">
			<a href="<?php echo site_url("Welcome/login"); ?>"> <img src="<?php echo base_url('Assets/images/dashboard.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Dashboard</a>
		</li>
		<li style="padding:2px;height:45px" id="routeid">
			<a href="<?php echo site_url("Welcome/routes"); ?>"><img src="<?php echo base_url('Assets/images/routes.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Routes</a>
		</li>
		<li style="padding:2px;height:45px" id="breakdow" data-toggle="collapse" data-target="#breakdown" class="collapsed active"><a href="#new"><img src="<?php echo base_url('Assets/images/towed-car.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Breakdown <span class="glyphicon glyphicon-chevron-down" style=" margin-right:10px; float: right; margin-top: 10px;"></span></a>
		</li>
		<ul class="sub-menu collapse" id="breakdown">
			<li id="breakdown1">
				<a href="<?php echo site_url("Welcome/breakdown"); ?>" style="margin-right: 20px" class="img-rounded" width="20px" height="20px">Breakdown </a>
			</li>
			<li id="breakdown2">
				<a href="<?php echo site_url("Welcome/re_assign"); ?>" style="margin-right: 20px" class="img-rounded" width="20px" height="20px">Re-assign Bus</a>
			</li>
		</ul>
		<!--Exit Re-Entry-->
		<li style="padding:2px;height:45px" id="exit_reentry">
			<a href="<?php echo site_url("Welcome/exit_reentry"); ?>"><img src="<?php echo base_url('Assets/images/attendance.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Exit Re-Entry</a>
		</li>
		<li style="padding:2px;height:45px" id="attendance">
			<a href="<?php echo site_url("Welcome/attendance"); ?>"><img src="<?php echo base_url('Assets/images/attendance.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Attendance</a>
		</li>
		<li style="padding:2px;height:45px" id="transferid">
			<a href="<?php echo site_url("Welcome/transfer"); ?>"><img src="<?php echo base_url('Assets/images/transfer.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Transfer</a>
		</li>
		<li style="padding:2px;height:45px" id="driverrating">
			<a href="<?php echo site_url("Welcome/ratings"); ?>"><img src="<?php echo base_url('Assets/images/driver rating.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Driver Rating</a>
		</li>
		<li style="padding:2px;height:45px" id="messaging">
			<a href="<?php echo site_url("Welcome/message"); ?>"><img src="<?php echo base_url('Assets/images/messaging.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Messaging</a>
		</li>
		<li style="padding:2px;height:45px" data-toggle="collapse" data-target="#student" class="collapsed active"><a href="#new"><img src="<?php echo base_url('Assets/images/');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Student<span class="glyphicon glyphicon-chevron-down" style="margin-right:10px; float: right; margin-top: 10px;"></span></a>
		</li>
		<ul class="sub-menu collapse" id="student">
			<li>
				<a href="<?php echo site_url("Welcome/admit_student"); ?>" style="margin-right: 20px" class="img-rounded" width="20px" height="20px">Admit Student</a>
			</li>
		</ul>
		<li style="padding:2px;height:45px" data-toggle="collapse" data-target="#leave" class="collapsed active"><a href="#new"><img class="filter" src="<?php echo base_url('Assets/images/Leave-26.png');?>" style="margin-right:20px" class="img-rounded" width="25px" height="30px">Student Leave<span class="glyphicon glyphicon-chevron-down" style="margin-right:10px; float: right; margin-top: 10px;"></span></a>
		</li>
		<ul class="sub-menu collapse" id="leave">
			<li id="leave1">
				<a href="<?php echo site_url("Welcome/leave_pending"); ?>" style="margin-right: 20px" class="img-rounded" width="20px" height="20px">Pending Leaves</a>
			</li>
			<li id="leave2">
				<a href="<?php echo site_url("Welcome/leave_confirmed"); ?>" style="margin-right: 20px" class="img-rounded" width="20px" height="20px">Confirm Leaves</a>
			</li>
		</ul>

		<li style="padding:1px;height:45px" id="leave_request">
			<a href="<?php echo site_url("Welcome/leave_request"); ?>"><img class="filter" src="<?php echo base_url('Assets/images/Leave-26.png');?>" style="margin-right:20px" class="img-rounded" width="25px" height="30px"> Leave Request</a>
		</li>
		<li style="padding:2px;height:45px" id="reports" data-toggle="collapse" data-target="#new" class="collapsed active"><a href="#new"><img src="<?php echo base_url('Assets/images/report.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Reports <span class="glyphicon glyphicon-chevron-down" style="margin-right:10px; float: right; margin-top: 10px;"></span></a>
		</li>
		<ul class="sub-menu collapse" id="new">
			<li>
				<a href="<?php echo site_url("Welcome/reports"); ?>" style="margin-right: 20px" class="img-rounded" width="20px" height="20px">Speed Reports</a>
			</li>
			<li>
				<a href="<?php echo site_url("Welcome/route_distance_id"); ?>" style="margin-right: 20px" class="img-rounded" width="20px" height="20px">Route Distance</a>
			</li>
			<li>
				<a href="<?php echo site_url("Welcome/vehicle_distance_name"); ?>" style="margin-right: 10px" class="img-rounded" width="20px" height="20px">Vehicle Distance</a>
			</li>
			<li>
				<a href="<?php echo site_url("Welcome/arrival_departure"); ?>" style="margin-right: 10px" class="img-rounded" width="20px" height="20px">Arrival/Departure</a>
			</li>
		</ul>
		<li style="padding:2px;height:45px" id="incidents" data-toggle="collapse" data-target="#new1" class="collapsed"><a href="#new"><img src="<?php echo base_url('Assets/images/folder.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Incidents <span class="glyphicon glyphicon-chevron-down" style="margin-right:10px; float: right; margin-top: 10px;"></span></a>
		</li>
		<ul class="sub-menu collapse" id="new1">
			<li>
				<a href="<?php echo site_url("Welcome/accidents"); ?>" style="margin-right: 20px" class="img-rounded" width="30px" height="30px">Accidents </a>
			</li>
			<li>
				<a href="<?php echo site_url("Welcome/student_misbehaviour"); ?>" style="margin-right: 20px" class="img-rounded" width="30px" height="30px">Misbehavior </a>
			</li>
		</ul>
		<li style="padding:1px;height:45px" id="managepicnic">
			<a href="<?php echo site_url("Welcome/manage_picnic"); ?>"><img src="<?php echo base_url('Assets/images/basket.png');?>" style="margin-right:20px" class="img-rounded" width="28px" height="32px"> Manage Picnic</a>
		</li>
		<li style="padding:1px;height:45px" id="managebus">
			<a href="<?php echo site_url("Welcome/managebus"); ?>"><img src="<?php echo base_url('Assets/images/icon_bus.png');?>" style="margin-right:20px" class="img-rounded" width="25px" height="40px"> Manage Bus</a>
		</li>
		<li style="padding:2px;height:45px" id="managedriver">
			<a href="<?php echo site_url("Welcome/managedrivers"); ?>"><img src="<?php echo base_url('Assets/images/icondriver.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Manage Drivers</a>
		</li>
		<li style="padding:2px" id="fuel" data-toggle="collapse" data-target="#new2" class="collapsed"><a href="#new"><img src="<?php echo base_url('Assets/images/fuel.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Manage Fuel<span class="glyphicon glyphicon-chevron-down" style="margin-right:10px; float: right; margin-top: 10px;"></span></a>
		</li>
		<ul class="sub-menu collapse" id="new2">
			<li>
				<a href="<?php echo site_url("Welcome/fuel_management"); ?>" style="margin-right: 20px" class="img-rounded" width="30px" height="30px">Fuel Payments</a>
			</li>
		</ul>
		<li style="padding:2px;height:45px" id="contract">
			<a href="<?php echo site_url("Welcome/contract"); ?>"><img src="<?php echo base_url('Assets/images/contract.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Contract</a>
		</li>
		<li style="padding:2px;height:45px" id="Settings">
			<a href="<?php echo site_url("Welcome/Settings"); ?>"><span class="glyphicon glyphicon-cog" style="margin-right:30px"></span> Settings</a>
		</li>
		<li style="padding:2px;height:45px">
			<a href="<?php echo site_url("Welcome/logout"); ?>"><img src="<?php echo base_url('Assets/images/log_out.png');?>" style="margin-right:20px" class="img-rounded" width="30px" height="30px">Logout</a>
		</li>
	</ul>
</aside>
<style type="text/css">
	.filter{-webkit-filter:brightness(0) invert(1);filter:brightness(0) invert(1)}
</style>