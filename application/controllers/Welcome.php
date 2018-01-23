<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    var $variable;

	public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
				$this->load->library('session');
				$this->load->model('TransportModel');
        }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			$this->load->view('birdeyemap');
		}else{
         $this->load->view('login'); 
		}
		
		
	}
	// index.php/Welcome/login for dashboard/birdeye
	public function login(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
				$formemail=$_SESSION['username'];
				$formpassword=$_SESSION['email'];
				
			$this->load->model('TransportModel');
			$data=$this->TransportModel->getLogDetails($formemail,$formpassword);
			$data = json_decode($data, true);
			$arr['school']=array();
			$arr['speedlimit']=array();
			$data1=$data['result_arr'];
			foreach ($data1 as $row) {
				array_push($arr['school'], $row['school_location']);
				array_push($arr['speedlimit'], $row['speed_limit']);
			}
			
			
			$data=$this->TransportModel->getRadius();
			$data = json_decode($data, true);
			$arr['rad']=array();
			$arr['scname']=array();
			$data1=$data['result_arr'];
			foreach ($data1 as $row) {
				array_push($arr['rad'], $row['school_fence']);
			}
			foreach ($data1 as $row1) {
				array_push($arr['scname'], $row1['school_name']);
			}
			$this->load->view('birdeyemap',$arr);
		}else{
			
		$formemail = $this->input->post('email');
		$formpassword=$this->input->post('password');
		$this->load->model('TransportModel');
		$data=$this->TransportModel->getLogDetails($formemail,$formpassword);
		$data = json_decode($data, true);
		
		//print_r($data);
		$data1=$data['result_arr'];
		
		$emp_id = array_column($data1, 'emp_id');
		$type_id = array_column($data1, 'type_id');
		
		$newdata = array(
        	'username'  => $formemail ,
        	'email'     => $formpassword,
        	'user_id'     => $emp_id[0],
        	'user_type'     => $type_id[0],
        	'logged_in' => TRUE
			);
		
		if($data['responsecode'] === 1){
			$arr['school']=array();
			$arr['speedlimit']=array();
			$data1=$data['result_arr'];
			//print_r($data1);
			foreach ($data1 as $row) {
				array_push($arr['school'], $row['school_location']);
				array_push($arr['speedlimit'], $row['speed_limit']);
				
			}
			
			$data=$this->TransportModel->getRadius();
			$data = json_decode($data, true);
			$arr['rad']=array();
			$arr['scname']=array();
			$data1=$data['result_arr'];
			foreach ($data1 as $row) {
				array_push($arr['rad'], $row['school_fence']);
			}
			foreach ($data1 as $row1) {
				array_push($arr['scname'], $row1['school_name']);
			}
			$this->session->set_userdata($newdata);
			$this->load->view('birdeyemap',$arr);
		}else{
			echo "<script type='text/javascript'>alert('Sorry!! Invalid Username/Password.');</script>";
			//redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/','refresh');
			
		}
	}

	}

	function coordinateUpdate(){
		
			if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
					$this->load->model('TransportModel');
					$data = $this->TransportModel->updateCoordinates();
        	
	    			echo $data;
				
					
			}else{
				redirect("welcome");
			}
	}


	//for index.php/Welcome/attendance
	public function attendance(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');
		$data = $this->TransportModel->get_Route();
        $arr['h'] = array();
        $arr['attndnc'] = array();
        if($data['responsecode']==1){
		$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
	    			array_push($arr['h'],$row['route_name'] );
			}
		}else{
			echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";	
    		}
		$this->load->view('attendance',$arr);
	}else{
		redirect("welcome");
		}
	}
	//populate table with student attendance list
	public function attendance_student(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		if($this->input->post('route')!=''){
 		$route=$this->input->post('route');
 		$RouteType=$this->input->post('RouteType');
 		$selected_date=$this->input->post('selected_date');
 		$newDate = date("Y-m-d", strtotime($selected_date));
 		if($RouteType==="PickUp"){
 			$trip_type = 1;
 		}else{
 			$trip_type = 2;
 		}

 		$this->load->model('TransportModel');
 		$data_route = $this->TransportModel->get_Route();
			if($data_route['responsecode']==1){
			$data1_route=$data_route['result_arr'];
        		foreach ($data1_route as $row) {
	    			if($route===$row['route_name']){
	    					$route_id=$row['route_id'];
	    					break;
	    			}		
				}
			}

			$data = $this->TransportModel->get_Route();
        	$arr['h'] = array();
        	$arr['attndnc'] = array();
        	if($data['responsecode']==1){
				$data1=$data['result_arr'];
        		foreach ($data1 as $row) {
	    			array_push($arr['h'],$row['route_name'] );
				}
			}
			$data_attndnc = $this->TransportModel->get_students_attendance($route_id,$newDate,$trip_type);
			$arr['attndnc'] = array();
			if($data_attndnc['responsecode']===1){
		 	$data=$data_attndnc['result_arr'];
        		foreach ($data as $row) {
	    			array_push($arr['attndnc'],$row['student_name'] );
	    			array_push($arr['attndnc'],$row['student_id'] );
	    			array_push($arr['attndnc'],$row['parent_name'] );
	    			array_push($arr['attndnc'],$row['parent_contact'] );
        		}
        	}else{
    			echo "<script type='text/javascript'>alert('Sorry!! No data found.');</script>";
    		}
        		
 		$this->load->view('attendance',$arr);

 	}else{
 		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/attendance');
 	}

 		}else{
 			redirect('welcome');
 			}

	}



//for index.php/Welcome/transfer
	public function transfer(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');
		$data = $this->TransportModel->get_Route();
        $arr['h'] = array();
        $arr['names'] = array();
        $arr['toroute']=array();
        array_push($arr['toroute'],'');
        array_push($arr['toroute'],'');

        if($data['responsecode']==1){
		$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
	    		array_push($arr['h'],$row['route_name'] );
			}
		}
		$this->load->view('transfer',$arr);
		}else{
	redirect('welcome');
}
	}
//for populating table with details
	public function managetransfer(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		if($this->input->post('fromroute')!='' && $this->input->post('toroute')!='' ){
			$route=$this->input->post('fromroute');
			$toroute=$this->input->post('toroute');
			$type=$this->input->post('selectType');
			if($type==='Student selected'){
			$this->load->model('TransportModel');
			$data_route = $this->TransportModel->get_Route();
			if($data_route['responsecode']==1){
			$data1_route=$data_route['result_arr'];
        	foreach ($data1_route as $row) {
	    		if($route===$row['route_name']){
	    		$route_id=$row['route_id'];
	  
	    		break;
	    		}		
			}
			foreach ($data1_route as $row) {
	    		if($toroute===$row['route_name']){
	    		$toroute_id=$row['route_id'];
	    		break;
	    		}		
			}
		}
			$data = $this->TransportModel->get_studentsorget_teacher($route_id,$type);
        	$arr['names'] = array();
        	$arr['h']=array();
        	if($data_route['responsecode']==1){
        		foreach ($data1_route as $row){
        			array_push($arr['h'],$row['route_name'] );
        		}
    		}
    		$arr['toroute']=array();
    		array_push($arr['toroute'], $toroute_id);
    		array_push($arr['toroute'], $route_id);
    		$track=0;
    		$type="student";
			if($data['responsecode']==1){
				$data1=$data['result_arr'];
        		foreach ($data1 as $row) {
        			if (strpos($row['assigned_to'], $type) !== false){
        			array_push($arr['names'],'Student' );
	    			array_push($arr['names'],$row['name'] );
	    			array_push($arr['names'],$row['assigned_to'] );
	    			array_push($arr['names'],$row['latitude'].",".$row['langitude'] );
	    			array_push($arr['names'],$row['contact_num'] );
	    			$track++;
	    		}
        		}
    		}
    		
    		if(!$track){
    			echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
    		}

		$this->load->view('transfer',$arr);
		}
		if($type==='Teacher selected'){
			$this->load->model('TransportModel');
			$data_route = $this->TransportModel->get_Route();
			if($data_route['responsecode']==1){
			$data1_route=$data_route['result_arr'];
        	foreach ($data1_route as $row) {
	    		if($route===$row['route_name']){
	    		$route_id=$row['route_id'];
	  
	    		break;
	    		}		
			}
			foreach ($data1_route as $row) {
	    		if($toroute===$row['route_name']){
	    		$toroute_id=$row['route_id'];
	    		break;
	    		}		
			}
		}
			$data = $this->TransportModel->get_studentsorget_teacher($route_id,$type);
        	$arr['names'] = array();
        	$arr['h']=array();
        	if($data_route['responsecode']==1){
        		foreach ($data1_route as $row){
        			array_push($arr['h'],$row['route_name'] );
        		}
    		}
    		$arr['toroute']=array();
    		array_push($arr['toroute'], $toroute_id);
    		array_push($arr['toroute'], $route_id);
    		$track=0;
    		$type="teacher";
			if($data['responsecode']==1){
				$data1=$data['result_arr'];
        		foreach ($data1 as $row) {
        			if (strpos($row['assigned_to'], $type) !== false){
        			array_push($arr['names'],'Student' );
	    			array_push($arr['names'],$row['name'] );
	    			array_push($arr['names'],$row['assigned_to'] );
	    			array_push($arr['names'],$row['latitude'].",".$row['langitude'] );
	    			array_push($arr['names'],$row['contact_num'] );
	    			$track++;
	    		}
        		}
    		}
    		
    		if(!$track){
    			echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
    		}
    		$this->load->view('transfer',$arr);
		}
	}else{
		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/transfer');
	}
}else{
	redirect('welcome');
}

	}
//for transferring selected student/teacher
	public function transferselected(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		if($this->input->post('toroutehidden')!='' && $this->input->post('checkbox')!=''){
			$toroutehidden_id=$this->input->post('toroutehidden');
			 $route_id =$this->input->post('fromroutehidden');
			$checkbox=$this->input->post('checkbox');
  			$Type=$this->input->post('Type');
  			$id=$this->input->post('id');
			$arr_checkbox=array();$arr_id=array();
  			$count=0;
  		foreach($checkbox as $check) { 
            array_push($arr_checkbox, $check);
            $count++;
    	}
    	foreach($_POST['id'] as $trackid) {
            array_push($arr_id, $trackid); 

    	}
    	$stored_id=array();
  		
  		for($i=0;$i<$count;$i++){
  			$value=$arr_checkbox[$i];
  			array_push($stored_id, $arr_id[$value-1]);
  		}
  		echo $count;
    	$this->load->model('TransportModel');
		$data_return=$this->TransportModel->getDetails_driverbus();
				$data_calc=$data_return['result_arr'];
				foreach ($data_calc as $row){
					if($route_id==$row['route_id']){
						$driver_id=$row['driver_id'];
						$bus_id=$row['bus_id'];
						break;
					}
				}
				
		$data_route = $this->TransportModel->get_studentsorget_teacher($route_id);
		$arr['stop_name']=array();
		$arr['stope_time']=array();
		$arr['latitude']=array();
		$arr['langitude']=array();
		$arr['arr_checkbox']=array();
		$arr['toroutehidden_id']=array();
		$arr['assigned_to']=array();
		$arr['driver_id']=array();
		$arr['bus_id']=array();


		if($data_route['responsecode']==1){
			$data1=$data_route['result_arr'];
			$i=0;
			foreach ($data1 as $row) {
				
				 if($i<count($stored_id) && $stored_id[$i]=== $row['assigned_to']){
				
				 	array_push($arr['stop_name'], $row['stop_name']);
				 	array_push($arr['stope_time'], $row['stope_time']);
				 	array_push($arr['latitude'], $row['latitude']);
				 	array_push($arr['langitude'], $row['langitude']);
				 	array_push($arr['arr_checkbox'], $arr_checkbox[$i]);
				 	array_push($arr['toroutehidden_id'], $toroutehidden_id);
				 	array_push($arr['assigned_to'], $row['assigned_to']);
				 	array_push($arr['driver_id'], $driver_id);
				 	array_push($arr['bus_id'], $bus_id);
				 	$i++;
				 	
				 }

			}

		}
			
			$data_return = $this->TransportModel->transfer_studentsorteachers($arr['stop_name'],$arr['stope_time'],$arr['latitude'],$arr['langitude'],$arr['arr_checkbox'],$arr['toroutehidden_id'],$arr['assigned_to'],$arr['driver_id'],$arr['bus_id']);
						$responsecode= $data_return['responsecode'];

    	// echo $route;
    	// echo $route_id;
    	// echo $toroutehidden;

if($responsecode==1){
	echo "<script type='text/javascript'>alert('sent successfully.');</script>";
}else{
	echo "<script type='text/javascript'>alert('Sorry!!something wrong. please try again.');</script>";
}

$data = $this->TransportModel->get_Route();
        $arr_new['h'] = array();
        $arr_new['names'] = array();
        $arr_new['toroute']=array();
        array_push($arr_new['toroute'],'');
        array_push($arr_new['toroute'],'');

        if($data['responsecode']==1){
		$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
	    		array_push($arr_new['h'],$row['route_name'] );
			}
		}
		unset($stored_id);
		$this->load->view('transfer',$arr_new);

		}else{
			redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/transfer');
		}
		}else{
			redirect('welcome');
		}	
	}


	//
	public function routes(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');
		$data = $this->TransportModel->get_Route();
        $arr['h'] = array();
        $arr['names'] = array();
        if($data['responsecode']==1){
		$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
	    		array_push($arr['h'],$row['route_name'] );
			}
		}
		
		$dataDetails = $this->TransportModel->get_Route_with_stops();
		if($dataDetails['responsecode']==1){
			$dataResult=$dataDetails['result_arr'];
        	foreach ($dataResult as $row) {
				$type="";
				if($row['trip_type']=='1'){
					$type='Pickup';
				}else{
					$type='Drop';
				}
				$this -> db -> from('employee_details');
				$this -> db -> where('emp_id', $row['driver_id'], NULL, FALSE);
				$query = $this->db->get();
				$driver_name= $query->row('name');
				
				$this -> db -> from('bus_details');
				$this -> db -> where('bus_Id', $row['bus_id'], NULL, FALSE);
				$query = $this->db->get();
				$bus_number= $query->row('plate_number');
				
				//$driver_name=$this->db->query("SELECT name FROM driver_details WHERE driver_id=".$row['driver_id'])->row()->name;
				//$bus_number=$this->db->query("SELECT plate_number FROM bus_details WHERE bus_Id=".$row['bus_id'])->row()->plate_number;
				
				
				array_push($arr['names'],$row['route_name']." - ".$type );
	    		array_push($arr['names'],$row['start_time']." - ".$row['end_time'] );
	    		array_push($arr['names'],$row['stop_count']);
	    		array_push($arr['names'],$driver_name);
	    		array_push($arr['names'],$bus_number);
	    		array_push($arr['names'],$row['route_id']);
        	}
    	}
    	else{
			echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
    	}
		$this->load->view('routes',$arr);

	}else{
		redirect('welcome');
	}
	}



//for index.php/Welcome/ratings
		public function ratings(){

			if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			 $month=date("F");
			$this->load->model('TransportModel');
			$data = $this->TransportModel->get_ratings($month);
			if($data['responsecode']==1){
				$arr['names'] = array();
				$data1=$data['result_arr'];
        		$total_driver = array();
        		$datalist = array();
        		$datalist1 = array();
        	foreach ($data1 as $row) {
        		foreach ($row  as $key => $value) {
                
        			if ($key == "driver_id") {
        				if(!in_array($value, $total_driver, true)){
                        	array_push($total_driver, $value);
                    	}
        			}
        		}
        	}

        $avg = 0;$avg1 = 0;$avg2 = 0;$counter = 0;
        	for ($i=1; $i <= count($total_driver); $i++) { 
        	 	foreach ($data1 as $key => $value) {
        	 		if ($value['driver_id'] == $i) {
        	        	$counter++;
        	 			$avg += $value['speed_limit'];
                    	$avg1 += $value['rash_driving'];
                    	$avg2 += $value['time_maitanance'];
        	 			$name = $value['name'];
        	 		}
        	 	}
        	 $avg = round($avg / $counter);
             $avg1 = round($avg1 / $counter);
             $avg2 = round($avg2 / $counter);
             array_push($datalist, $name, $avg, $avg1, $avg2);
        	 array_push($datalist1, $datalist);

        	 $counter = 0;$avg = 0;$avg1 = 0;$avg2 = 0;
        	 unset($datalist);
             $datalist = array();
        }
         
         	$page=array(2);
        	$datapage = array('m' => $page);
        
       		$months=array(strtoupper($month));
        	$data = array('h' => $datalist1);
        	$data1 = array('d' => $months);
		$this->load->view('ratings',$data+$data1+$datapage);

	}
		else{
			$page=array(1);
        	$data = array('m' => $page);
        	echo "<script type='text/javascript'>alert('Sorry!! no data found for current month.');</script>";
		$this->load->view('ratings',$data);

		}
	}else{
		redirect('welcome');
	}

		}
//calculate rating based on month
		public function calculaterating(){
			if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			$month=$this->input->post('month');
			$this->load->model('TransportModel');
			$data = $this->TransportModel->get_ratings($month);
			if($data['responsecode']==1){
				$arr['names'] = array();
				$data1=$data['result_arr'];
        		$total_driver = array();
        		$datalist = array();
        		$datalist1 = array();
        	foreach ($data1 as $row) {
        		foreach ($row  as $key => $value) {
                
        			if ($key == "driver_id") {
        				if(!in_array($value, $total_driver, true)){
                        	array_push($total_driver, $value);
                    	}
        			}
        		}
        	}

        $avg = 0;$avg1 = 0;$avg2 = 0;$counter = 0;
        	for ($i=1; $i <= count($total_driver); $i++) { 
        	 	foreach ($data1 as $key => $value) {
        	 		if ($value['driver_id'] == $i) {
        	        	$counter++;
        	 			$avg += $value['speed_limit'];
                    	$avg1 += $value['rash_driving'];
                    	$avg2 += $value['time_maitanance'];
        	 			$name = $value['name'];
        	 		}
        	 	}
        	 $avg = round($avg / $counter);
             $avg1 = round($avg1 / $counter);
             $avg2 = round($avg2 / $counter);
             array_push($datalist, $name, $avg, $avg1, $avg2);
        	 array_push($datalist1, $datalist);

        	 $counter = 0;$avg = 0;$avg1 = 0;$avg2 = 0;
        	 unset($datalist);
             $datalist = array();
        }
         
         	$page=array(2);
        	$datapage = array('m' => $page);
        
       		$months=array(strtoupper($month));
        	$data = array('h' => $datalist1);
        	$data1 = array('d' => $months);
		$this->load->view('ratings',$data+$data1+$datapage);

	}
		else{
			$page=array(1);
        	$data = array('m' => $page);
        	echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
		$this->load->view('ratings',$data);

		}
	}else{
		redirect('welcome');
	}

	}



//for index.php/Welcome/message
	public function message(){

		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');
		$data = $this->TransportModel->get_Route();
        	$arr['h'] = array();
        	$arr['names'] = array();
        	if($data['responsecode']==1){
			$data1=$data['result_arr'];
        		foreach ($data1 as $row) {
	    			array_push($arr['h'],$row['route_name'] );
			}
		}
			$this->load->view('messaging',$arr);
		}else{
		redirect('welcome');
	}
	}




	 //leave_request functions

    function leave_request(){

    	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
    			$this->load->model('TransportModel');
    	
    	$this->load->view('leave_request_view', $arr);
    	}else{
    		redirect('welcome');
    	}

    }

    function driver_leave_view(){

	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
				$to_date= date("Y-m-d", strtotime($this->input->post('to_date')));
				$from_date=date("Y-m-d", strtotime($this->input->post('from_date')));
				$driver_id=$this->input->post('driver_id');

				//$id=$this->db->get_where('transport_admin' , array('email'=>$this->session->userdata('username')))->row()->trans_admin_id;
				$type="";
				$data=$this->db->get('hr_roles')->result_array();
				foreach ($data as $row) {
					if (strpos(strtolower($row['role']), 'driver') !== false) {
    						$type=$row['id'];
    						break;
						}
				}
				$running_year 		=   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;

				 $this->load->model('TransportModel');
				 $data_return = $this->TransportModel->get_leave_view_driver($type,$driver_id,$from_date,$to_date);
				 	$arr['pending_data'] = array();
        
		        if($data_return['responsecode']==1){
				    $data1=$data_return['result_arr'];
				    foreach ($data1 as $row) {
		                
		                	$button = '<div class="btn-group" style="overflow:visible">
<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
<ul class="dropdown-menu dropdown-default pull-right" role="menu" >
<li><a href="#" onclick="changemodal_driver('.$row['student_id'].', 2);">Re-apply</a>
<input type="hidden" id="row_id_driver" value="'.$row['id'].'">
</li>
</ul>
</div>';
				    	     array_push($arr['pending_data'], $row + array('btn' => $button));
		                
				    }

				}else{
					array_push($arr['pending_data'], array('response' => 'nodata'));
				}
				

		

				
echo json_encode($arr['pending_data']);
	}else{
		redirect('Welcome');
	}


}


function admin_leave_add_driver(){

	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
				$to_date=$this->input->post('to_date');
				$from_date=$this->input->post('from_date');
				$text_area=$this->input->post('text_area');
				$driver_id=$this->input->post('driver_id');

				//$id=$this->db->get_where('transport_admin' , array('email'=>$this->session->userdata('username')))->row()->trans_admin_id;
				$type="";
				$data=$this->db->get('hr_roles')->result_array();
				foreach ($data as $row) {
					if (strpos(strtolower($row['role']), 'driver') !== false) {
    						$type=$row['id'];
    						break;
						}
				}

			
				 $diff=$diff = abs(strtotime($to_date) - strtotime($from_date));
				 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

				 $running_year 		=   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
				 $applied_on=date("Y-m-d");
				 $status=1;
				 $reason=$text_area;
				 $data1['student_id']=$driver_id;
				 $data1['user_type']=$type;
				 $data1['from_date']=$from_date;
				 $data1['to_date']=$to_date;
				 $data1['no_of_days']=$days;
				 $data1['reason']=$text_area;
				 $data1['status']=1;
				 $data1['applied_on']=$applied_on;
				 $data1['year']=$running_year;
				 $this->db->insert('leave_records',$data1);

				echo $driver_id;

	}else{
		redirect('Welcome');
	}


}

function driver_leave_add_new(){

	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
				$to_date=$this->input->post('to_date');
				$from_date=$this->input->post('from_date');
				$text_area=$this->input->post('text_area');
				$text_reject=$this->input->post('text_reject');
				$row_id=$this->input->post('id');
				$student_id=$this->input->post('student_id');
					

				//$id=$this->db->get_where('transport_admin' , array('email'=>$this->session->userdata('username')))->row()->trans_admin_id;
				$type="";
				$data=$this->db->get('hr_roles')->result_array();
				foreach ($data as $row) {
					if (strpos(strtolower($row['role']), 'driver') !== false) {
    						$type=$row['id'];
    						break;
						}
				}

			
				 $diff=$diff = abs(strtotime($to_date) - strtotime($from_date));
				 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

				 $running_year 		=   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
				 $applied_on=date("Y-m-d");
				 $status=1;
				 $reason=$text_area;
				 $data1['student_id']=$student_id;
				 $data1['user_type']=$type;
				 $data1['from_date']=$from_date;
				 $data1['to_date']=$to_date;
				 $data1['no_of_days']=$days;
				 $data1['reason']=$text_area;
				 $data1['status']=1;
				 $data1['applied_on']=$applied_on;
				 $data1['year']=$running_year;
				 $data1['reject_reason']=$text_reject;
				

				
            	$this->db->where('id', $row_id);
                $this->db->update('leave_records', $data1);



				echo $row_id;

	}else{
		redirect('Welcome');
	}


}


    function admin_leave_add_new(){

	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
				$to_date=$this->input->post('to_date');
				$from_date=$this->input->post('from_date');
				$text_area=$this->input->post('text_area');
				$text_reject=$this->input->post('text_reject');
				$row_id=$this->input->post('id');


				$id=$this->db->get_where('transport_admin' , array('email'=>$this->session->userdata('username')))->row()->trans_admin_id;
				$type="";
				$data=$this->db->get('hr_roles')->result_array();
				foreach ($data as $row) {
					if (strpos(strtolower($row['role']), 'trans') !== false) {
    						$type=$row['id'];
    						break;
						}
				}

			
				 $diff=$diff = abs(strtotime($to_date) - strtotime($from_date));
				 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

				 $running_year 		=   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
				 $applied_on=date("Y-m-d");
				 $status=1;
				 $reason=$text_area;
				 $data1['student_id']=$id;
				 $data1['user_type']=$type;
				 $data1['from_date']=$from_date;
				 $data1['to_date']=$to_date;
				 $data1['no_of_days']=$days;
				 $data1['reason']=$text_area;
				 $data1['status']=1;
				 $data1['applied_on']=$applied_on;
				 $data1['year']=$running_year;
				 $data1['reject_reason']=$text_reject;
				

				
            	$this->db->where('id', $row_id);
                $this->db->update('leave_records', $data1);



				echo $row_id;

	}else{
		redirect('Welcome');
	}


}



    function admin_leave_view(){

	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
				$to_date= date("Y-m-d", strtotime($this->input->post('to_date')));
				$from_date=date("Y-m-d", strtotime($this->input->post('from_date')));

				$id=$this->db->get_where('transport_admin' , array('email'=>$this->session->userdata('username')))->row()->trans_admin_id;
				$type="";
				$data=$this->db->get('hr_roles')->result_array();
				foreach ($data as $row) {
					if (strpos(strtolower($row['role']), 'trans') !== false) {
    						$type=$row['id'];
    						break;
						}
				}
				$running_year 		=   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;

				 $this->load->model('TransportModel');
				 $data_return = $this->TransportModel->get_leave_view($type,$id,$from_date,$to_date);
				 	$arr['pending_data'] = array();
        
		        if($data_return['responsecode']==1){
				    $data1=$data_return['result_arr'];
				    foreach ($data1 as $row) {
		                
		                	$button = '<div class="btn-group" style="overflow:visible">
<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
<ul class="dropdown-menu dropdown-default pull-right" role="menu" >
<li><a href="#" onclick="changemodal('.$row['id'].', 2);">Re-apply</a></li>
</ul>
</div>';
				    	     array_push($arr['pending_data'], $row + array('btn' => $button));
		                
				    }

				}else{
					array_push($arr['pending_data'], array('response' => 'nodata'));
				}
				

		

				
echo json_encode($arr['pending_data']);
	}else{
		redirect('Welcome');
	}


}

function admin_leave_add(){

	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
				$to_date=$this->input->post('to_date');
				$from_date=$this->input->post('from_date');
				$text_area=$this->input->post('text_area');

				$id=$this->db->get_where('transport_admin' , array('email'=>$this->session->userdata('username')))->row()->trans_admin_id;
				$type="";
				$data=$this->db->get('hr_roles')->result_array();
				foreach ($data as $row) {
					if (strpos(strtolower($row['role']), 'trans') !== false) {
    						$type=$row['id'];
    						break;
						}
				}

			
				 $diff=$diff = abs(strtotime($to_date) - strtotime($from_date));
				 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

				 $running_year 		=   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
				 $applied_on=date("Y-m-d");
				 $status=1;
				 $reason=$text_area;
				 $data1['student_id']=$id;
				 $data1['user_type']=$type;
				 $data1['from_date']=$from_date;
				 $data1['to_date']=$to_date;
				 $data1['no_of_days']=$days;
				 $data1['reason']=$text_area;
				 $data1['status']=1;
				 $data1['applied_on']=$applied_on;
				 $data1['year']=$running_year;
				 $this->db->insert('leave_records',$data1);

				echo "Inserted Successfully";

	}else{
		redirect('Welcome');
	}


}

//for sending msg to parents/teachers
	public function sendingMsg(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		if($this->input->post('checkbox')!='' && $this->input->post('comment')!=''){
  		$checkbox=$this->input->post('checkbox');
  		$Type=$this->input->post('Type');
  			if($Type==='Student'){$Type='parent';
  			}else{$Type='teacher';}

  			$id=$this->input->post('id');
			$comment = $this->input->post('comment');
			$arr_checkbox=array();$arr_id=array();
  			$count=0;
  				foreach($checkbox as $check) { 
            		array_push($arr_checkbox, $check);
            		$count++;
    			}
  				foreach($_POST['id'] as $trackid) {
            		array_push($arr_id, $trackid); 
    			}
  				$stored_id=array();
  				$type_arr=array();
  				for($i=0;$i<$count;$i++){
  					$value=$arr_checkbox[$i];
  					array_push($stored_id, $arr_id[$value-1]);
  					array_push($type_arr, $Type);
  				}
  				$arr_Type=implode($type_arr,",");
				$arr_MsgTo=implode($stored_id,",");
  				$this->load->model('TransportModel');
  				$datareturn = $this->TransportModel->send_msgTo($arr_MsgTo,$arr_Type,$comment);
  				$data = $this->TransportModel->get_Route();
        		$arr['h'] = array();
        		$arr['names'] = array();
        		if($data['responsecode']==1){
					$data1=$data['result_arr'];
        			foreach ($data1 as $row) {
	    				array_push($arr['h'],$row['route_name'] );
					}
				}
				if($datareturn['responsecode']==1){
  					echo "<script type='text/javascript'>alert('sent successfully.');</script>";
  				}else{
  				echo "<script type='text/javascript'>alert('Sorry!!something wrong.please try again.');</script>";
				
  				}

			$this->load->view('messaging',$arr);

		}else{
			redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/message');
		}
	}else{
		redirect('welcome');
	}
	}
//populate message table with student/teacher list
	public function getStudentsorTeacher(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		if($this->input->post('route')!=''){
     		$route = $this->input->post('route');
			$type = $this->input->post('selectType');
				if($type==='Student selcted'){
					$this->load->model('TransportModel');
					$data_route = $this->TransportModel->get_Route();
						if($data_route['responsecode']==1){
							$data1_route=$data_route['result_arr'];
        						foreach ($data1_route as $row) {
	    							if($route===$row['route_name']){
	    								$route_id=$row['route_id'];
	    								break;
	    							}		
								}
						}
			$data = $this->TransportModel->get_studentsorget_teacher($route_id,$type);
        	$arr['names'] = array();
        	$arr['h']=array();
        		if($data_route['responsecode']==1){
        			foreach ($data1_route as $row){
        				array_push($arr['h'],$row['route_name'] );
        			}
    			}

    			$track_student=0;
				if($data['responsecode']==1){
					$data1=$data['result_arr'];
					
        			foreach ($data1 as $row) {
        				if (strpos($row['assigned_to'], 'student') !== false){
        					$stu_id=explode('-',$row['assigned_to']);
        					array_push($arr['names'],'Student' );
	    					array_push($arr['names'],$row['name'] );
	    					array_push($arr['names'], $stu_id[0]);
	    					array_push($arr['names'],$row['latitude'].",".$row['langitude'] );
	    					array_push($arr['names'],$row['contact_num'] );
	    					$track_student++;
	    				}
        			}
    			}
    			else{
    				echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
    				$track_student++;
    			}

    			if($track_student==0){
    				echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
    			}

			$this->load->view('messaging',$arr);
		}
				if($type==='Teacher selected'){
					$this->load->model('TransportModel');
					$data_route = $this->TransportModel->get_Route();
					if($data_route['responsecode']==1){
						$data1_route=$data_route['result_arr'];
        				foreach ($data1_route as $row) {
	    					if($route===$row['route_name']){
	    						$route_id=$row['route_id'];
	    						break;
	    					}		
						}
					}
				$data = $this->TransportModel->get_studentsorget_teacher($route_id,$type);
        		$arr['names'] = array();
        		$arr['h']=array();
        		if($data_route['responsecode']==1){
        			foreach ($data1_route as $row){
        				array_push($arr['h'],$row['route_name'] );
        			}
    			}

    			$track_teachr = 0;
				if($data['responsecode']==1){
					$data1=$data['result_arr'];
					
        			foreach ($data1 as $row) {
        				if (strpos($row['assigned_to'], 'teacher') !== false){
        					$teacher_id=explode('-',$row['assigned_to']);
        					array_push($arr['names'],'Student' );
	    					array_push($arr['names'],$row['name'] );
	    					array_push($arr['names'], $teacher_id[0]);
	    					array_push($arr['names'],$row['latitude'].",".$row['langitude'] );
	    					array_push($arr['names'],$row['contact_num'] );
	    					$track_teachr++;
	    				}
        			}
    			}
    			else{
    				echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
    				$track_teachr++;
    			}

    			if($track_teachr==0){
    				echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
    			}

			$this->load->view('messaging',$arr);
		}
	}	else{
			redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/message');
		}
	}else{
		redirect('welcome');
	}
	}

//Add Route and get route list
	public function AddRoute(){
		$route_name=$this->input->post('route_name');
		$trip_type=$this->input->post('trip_type');
		$type="";
		if($trip_type=='Pickup'){
			$type="1";
		}else{
			$type="2";
		}
		
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post('end_time');
		
		$this->load->model('TransportModel');
		$datareturn = $this->TransportModel->add_new_route($route_name,$type,$start_time,$end_time);
		$data = $this->TransportModel->get_Route_with_stops();
        $arr['names'] = array();
        $arr['h']=array();
		
        if($datareturn['responsecode']==1){
			foreach ($datareturn as $row){
				array_push($arr['h'],$row['route_name'] );
        	}
    	}
		if($data['responsecode']==1){
			$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
				$type="";
				if($row['trip_type']=='1'){
					$type='Pickup';
				}else{
					$type='Drop';
				}
				
				$this -> db -> from('driver_details');
				$this -> db -> where('driver_id', $row['driver_id'], NULL, FALSE);
				$query = $this->db->get();
				$driver_name= $query->row('name');
				
				$this -> db -> from('bus_details');
				$this -> db -> where('bus_Id', $row['bus_id'], NULL, FALSE);
				$query = $this->db->get();
				$bus_number= $query->row('plate_number');
				
				//$driver_name=$this->db->query("SELECT name FROM driver_details WHERE driver_id=".$row['driver_id'])->row()->name;
				//$bus_number=$this->db->query("SELECT plate_number FROM bus_details WHERE bus_Id=".$row['bus_id'])->row()->plate_number;
				
				array_push($arr['names'],$row['route_name']." - ".$type );
	    		array_push($arr['names'],$row['start_time']." - ".$row['end_time'] );
	    		array_push($arr['names'],$row['stop_count']);
	    		array_push($arr['names'],$driver_name);
	    		array_push($arr['names'],$bus_number);
	    		array_push($arr['names'],$row['route_id']);
        	}
    	}
    	else{
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.please try again.');</script>";
    	}
		
		redirect(base_url() . 'index.php/Welcome/routes', 'refresh',$arr);
		//$this->load->view('routes',$arr);
	}

//Ajax to delete Route
	function AJAX_DeleteRoute(){
		$this->load->model('TransportModel');		
		//get data from the database			
		$data = $this->TransportModel->deleteRoute($this->input->post('ID'));	
		if($datareturn['responsecode']!=1){
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.please try again.');</script>";
    	}
		
		//$this->load->view('routes');
		redirect(base_url() . 'index.php/Welcome/routes', 'refresh');
	}





//create route view
	public function create_route(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			$formemail = $this->session->userdata('username');
			$formpassword = $this->session->userdata('email');
			
			$this->load->model('TransportModel');
			$data=$this->TransportModel->getLogDetails($formemail,$formpassword);
			$data = json_decode($data, true);
			$arr['school']=array();
			$arr['scname']=array();

			$data1=$data['result_arr'];
			foreach ($data1 as $row) {
				array_push($arr['school'], $row['school_location']);
			}

			foreach ($data1 as $row) {
				array_push($arr['scname'], $row['school_name']);
			}


		}
		$route_id=$this->input->post('edit');
		
		$this->load->model('TransportModel');
		$trip_type="";
		$driver="";
		$arr['type']=array();
		$arr['cur_bus']=array();
		$dataForType=$this->TransportModel->get_Route_with_stops();
		if($dataForType['responsecode']==1){
			foreach ($dataForType['result_arr'] as $row) {
				if($row['route_id']==$route_id){
					$trip_type=$row['trip_type'];
					$driver=$row['driver_id'];
					array_push($arr['type'], $trip_type);
					array_push($arr['cur_bus'], $row['bus_name']);
					break;
				}
			}
		}

		$datareturn = $this->TransportModel->get_studentsorget_teacher($route_id);
		
		$datareturn_driver = $this->TransportModel->get_driver_list();
		$datareturn_bus = $this->TransportModel->get_bus_list();
		$arr['names'] = array();
		$arr['routename']=array();
		
		array_push($arr['routename'], $route_id);
		$arr['h']=array();
		$arr['cur_driver']=array();

			if($datareturn_driver['responsecode']==1){
						$data_driver=$datareturn_driver['result_arr'];
        				foreach ($data_driver as $row) {
	    						array_push($arr['h'], $row['name']);
	    						if($row['driver_id']==$driver){
	    							array_push($arr['cur_driver'], $row['name']);
	    						}	
						}
					}
		$arr['h1']=array();

			if($datareturn_bus['responsecode']==1){
						$data_bus=$datareturn_bus['result_arr'];
        				foreach ($data_bus as $row) {
	    						array_push($arr['h1'], $row['name']);	
						}
					}

			$arr['assigned_to']=array();

		if($datareturn['responsecode']==1){
						$data1_route=$datareturn['result_arr'];
						
        				foreach ($data1_route as $row) {
	    						array_push($arr['names'], $row['name']);
	    						array_push($arr['assigned_to'], $row['assigned_to']);

						}


					}


					$this->load->view('create_route_view',$arr);
				

			
	}

//
	public function updatedetailsinroute(){
		$driver_name=$this->input->post('driver_name');
		$bus_name=$this->input->post('bus_id');
		$sc_lat_lon=$this->input->post('sc_lat_lon');
		$pieces = explode(",", $sc_lat_lon);
		$sc_lat=$pieces[0];$sc_lon=$pieces[1];
		

		$name_details=$this->input->post('name_details');
		
		$distance=$this->input->post('ll');
		$distance=($distance/1000);
		$route_id_details=$this->input->post('route_id_details');
		$arr_name=array();
		
		foreach ($name_details as $value) {
			array_push($arr_name, $value);
		}


		$this->load->model('TransportModel');

		$route_trip_type=$this->TransportModel->get_Route_with_stops();
		foreach ($route_trip_type['result_arr'] as $row){
			if($row['route_id']==$route_id_details){
				$trip_type_route=$row['trip_type'];
				break;
			}
		}



		$data_return=$this->TransportModel->get_bus_list();
				$data_calc=$data_return['result_arr'];
				foreach ($data_calc as $row){
					if($bus_name == $row['name']){
						$bus_id=$row['bus_Id'];
						break;
					}
				}

			$datareturn_bus = $this->TransportModel->get_driver_list();
			$data_bus=$datareturn_bus['result_arr'];
			foreach ($data_bus as $val) {
				if($driver_name == $val['name']){
					$driver_id=$val['driver_id'];
					break;

				}
			}

		$data_route = $this->TransportModel->get_studentsorget_teacher($route_id_details);
		
		if($data_route['responsecode']==1){
			$data1=$data_route['result_arr'];
			
			foreach ($data1 as $row) {
						$count++;
			}

		}
		$arr_distance=0.00;
		$studentorteacher='-teacher';
		$data_route = $this->TransportModel->getallStudentsDetails($trip_type_route);
		$data_route_teacher=$this->TransportModel->get_teachers();
		$count=0;
		$arr_stuteachr=array();
		$arr_id=array();
		$arr_route=array();
		$arr_count=array();
		$arr_lat=array();
		$arr_lon=array();
		$arr_stop_time=array();
		$arr_stop_name=array();
		while($count <  count($arr_name) ){
		if($data_route['responsecode']==1 && $data_route_teacher['responsecode']==1){
			$data1=$data_route['result_arr'];
			$data2=$data_route_teacher['result_arr'];
			foreach ($data1 as $row){
				if($arr_name[$count] == $row['name']){
					$studentorteacher="-student";
					break;
				}
		}
			foreach ($data2 as $row){
				if($arr_name[$count] == $row['name']){
					$studentorteacher="-teacher";
					break;
				}
		}
		if($studentorteacher == "-student"){
			foreach ($data1 as $row) {
			if($arr_name[$count] == $row['name']){
			// $data_return = $this->TransportModel->create_studentsorteachers($arr_name[$count],"5:21 AM",$row['latitude'],$row['langitude'],$count,$route_id_details,$row['student_id'].$studentorteacher,$driver_id,$bus_id,$distance);
				array_push($arr_stop_name, $arr_name[$count]);
				array_push($arr_stop_time, "5:21 AM");
				array_push($arr_lat, $row['latitude']);
				array_push($arr_lon, $row['langitude']);
				array_push($arr_count, $count);
				array_push($arr_route, $route_id_details);
				array_push($arr_id, $row['student_id'].$studentorteacher);
				$arr_driver=$driver_id;
				$arr_bus=$bus_id;
				$arr_distance=$arr_distance+$this->TransportModel->GetDrivingDistance($sc_lat,$row['latitude'],$sc_lon,$row['langitude']);

				$sc_lat=$row['latitude'];
				$sc_lon=$row['langitude'];
			break;
				}
			}
		}else{
			foreach ($data2 as $row) {
			if($arr_name[$count] == $row['name']){
			// $data_return = $this->TransportModel->create_studentsorteachers($arr_name[$count],"5:21 AM",$row['latitude'],$row['langitude'],$count,$route_id_details,$row['teacher_id'].$studentorteacher,$arr_name[$count],$driver_id,$bus_id,$distance);

				array_push($arr_stop_name, $arr_name[$count]);
				array_push($arr_stop_time, "5:21 AM");
				array_push($arr_lat, $row['latitude']);
				array_push($arr_lon, $row['langitude']);
				array_push($arr_count, $count);
				array_push($arr_route, $route_id_details);
				array_push($arr_id, $row['teacher_id'].$studentorteacher);
				$arr_driver=$driver_id;
				$arr_bus=$bus_id;
				$arr_distance=$arr_distance+$this->TransportModel->GetDrivingDistance($sc_lat,$row['latitude'],$sc_lon,$row['langitude']);
				//echo $arr_distance;
				$sc_lat=$row['latitude'];
				$sc_lon=$row['langitude'];
			break;
				}
			}
		}

			}
		$count++;
		}
		

	
	$data_return = $this->TransportModel->create_studentsorteachers($arr_stop_name,$arr_stop_time,$arr_lat,$arr_lon,$arr_count,$arr_route,$arr_id,$arr_driver,$arr_bus,number_format($arr_distance, 2));
		if($data_return['responsecode']!=1 || $data_return['responsecode']!="1"){
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.please try again.');</script>";
		}
		
		redirect(base_url() . 'index.php/Welcome/routes');
	}


	//breakdown
	public function breakdown(){
			if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			$this->load->model('TransportModel');
			$data = $this->TransportModel->get_vehicle_Details();
        		$arr['vehicle_name'] = array();
        		if($data['responsecode']==1){
				$data1=$data['result_arr'];
        			foreach ($data1 as $row) {
	    				array_push($arr['vehicle_name'],$row);
				}
			}
		$this->load->view('breakdown_view',$arr);
		}else{
	         	redirect('welcome');
        	}
	}

	//breakdown-list
public function breakdown_list(){
        	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
        		if($this->input->post('startdate')!=''){
        			$bus_id = $this->input->post('busname');
 		    		$startdate = $this->input->post('startdate');
 		    		$startdate=date("Y-m-d",strtotime($startdate));
 		    		$enddate=$this->input->post('enddate');
 		    		$enddate=date("Y-m-d",strtotime($enddate));
 				    $this->load->model('TransportModel');
                     
                    $data = $this->TransportModel->get_vehicle_Details();
        		$arr['vehicle_name'] = array();
        		if($data['responsecode']==1){
				$data1=$data['result_arr'];
        			foreach ($data1 as $row) {
	    				array_push($arr['vehicle_name'],$row);
				}
			}

 	        		$data_report = $this->TransportModel->get_breakdown_list($bus_id, $startdate, $enddate);
				    $arr['breakdown_list'] = array();

				if($data_report['responsecode'] == 1){
		 			$data=$data_report['result_arr'];
        				foreach ($data as $row) {
        					
        			        array_push($arr['breakdown_list'], $row);
        		       }
        	}else{
        	
    			echo "<script type='text/javascript'>alert('Sorry!! No data found.');</script>";
    		}

    	}

 	$this->load->view('breakdown_view',$arr);
 	}else{
 		redirect('Welcome');
 	}

}

//re-assign buses on breakdown

public function re_assign(){
	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
	    $this->load->model('TransportModel');
        $arr['bus_from'] = array();
	    $data = $this->TransportModel->get_vehicle_Details();

        if($data['responsecode']==1){
			$data1=$data['result_arr'];
        		foreach ($data1 as $row) {
        			if($row['pickup_route_id']!="0" && $row['drop_route_id']!="0"){
        					array_push($arr['bus_from'], $row);
        			}
	    			
			}
		}

		$arr['bus_to'] = array();
	    $data = $this->TransportModel->get_spare_buses();

        if($data['responsecode']==1){
			$data1=$data['result_arr'];
        		foreach ($data1 as $row) {
	    			array_push($arr['bus_to'], $row);
			}
		}

		$this->load->view('re_assign_view', $arr);

	}else{
	    redirect('welcome');
    }

}

public function bus_transfer_update(){
			if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			$bus_from = $this->input->post('bus_from');
				$bus_to = $this->input->post('bus_to');
				
				$this->load->model('TransportModel');
				$status = $this->TransportModel->bus_transfer_update($bus_from, $bus_to);

				if($status['responsecode'] == 1){
					echo json_encode(array("status" => TRUE));
			    }
			}else{
				redirect('Welcome');
			}
				
}	

public function managedrivers(){
if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$arr['names']=array();
		$arr1['names'] = array();
		$arr1['asain_bus']=array();
	
		$this->load->model('TransportModel');
		$data_bus=$this->TransportModel->populate_bus();
    	if($data_bus['responsecode']==1){
    		$data_bus_details=$data_bus['result_arr'];
    		foreach ($data_bus_details as $row) {
    			array_push($arr1['asain_bus'], $row['name']);
    			// array_push($arr['asain_bus'], $row['bus_Id']);
    		}
    		
    	}

		$dataDetails = $this->TransportModel->get_driver_profile();
		if($dataDetails['responsecode']==1){
			    	$dataResult=$dataDetails['result_arr'];
    				$action_id=0;
    				
    			    foreach ($dataResult as $row) {
					if($row['name']=="null"){
						array_push($arr['names'], "---");
						}else{array_push($arr['names'], $row['name']);}
     				if($row['iqama_number']=="null"){
						array_push($arr['names'], "---");
						}else{array_push($arr['names'], $row['iqama_number']);}
				    if($row['iqama_expiry_date']=="null"){
						array_push($arr['names'], "---");
						}else{array_push($arr['names'], $row['iqama_expiry_date']);}
				    if($row['passport_number']=="null"){
						array_push($arr['names'], "---");
						}else{array_push($arr['names'], $row['passport_number']);}
				    if($row['passport_expiry_date']=="null"){
						array_push($arr['names'], "---");
						}else{array_push($arr['names'], $row['passport_expiry_date']);}
				    
				    if($row['license_number']=="null"){
						array_push($arr['names'], "---");
						}else{array_push($arr['names'], $row['license_number']);}
				    if($row['license_expiry_date']=="null"){
						array_push($arr['names'], "---");
						}else{ array_push($arr['names'], $row['license_expiry_date']);}
				   if($row['mobile']=="null"){
						array_push($arr['names'], "---");
						}else{ array_push($arr['names'], $row['mobile']);}
				    
				    array_push($arr['names'], $action_id);
				    $action_id++;
     		            

     		        array_push($arr1['names'],$arr['names']);
        			unset($arr);
        			$arr['names'] = array();
     		
    				}
		}else{
			echo "<script type='text/javascript'>alert('Sorry!! no data found.Try again');</script>";
  
		}


		$this->load->view('managedriver',$arr1);

}else{
	redirect('Welcome');
}

	
}



	//managebus
    public function managebus(){
        if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
   			$this->load->model('TransportModel');
    			$arr['names'] = array();
   			$dataDetails = $this->TransportModel->managebus_data();
   			if($dataDetails['responsecode']==1){
    			$dataResult=$dataDetails['result_arr'];
    			$data_exp=0;$data_counter=0;
    			$arr['expiry']=array();$arr['expiry_type']=array();
    		foreach ($dataResult as $row) {
    			$DateOfRequest=date('Y-m-d');
    			if($row['license_expiry_date']!="null"){
    			$your_date = strtotime($row['license_expiry_date']);

     			$datediff = $your_date-strtotime($DateOfRequest);
     			$x=floor($datediff / (60 * 60 * 24));

     			if($x>2){
     				$DateOfRequest=date('Y-m-d');
    			$your_date = strtotime($row['MVPI_expiry_date']);
     			$datediff = $your_date-strtotime($DateOfRequest);
     			$y=floor($datediff / (60 * 60 * 24));
     			if($y<=2 && $y>=0){
     					array_push($arr['expiry_type'],'MVPI');
     					array_push($arr['expiry'],$row['MVPI_expiry_date']);
     					$y=1;
     					array_push($arr['names'],$row['bus_type'].$y);	
     				}
     				if($y< 0){
     					$y=-1;
     					array_push($arr['names'],$row['bus_type'].$y);
     				}
     				if($y>2){
     					$y=0;
     					array_push($arr['names'],$row['bus_type'].$y);
     				}

     			}else{
     				if($x<=2 && $x>=0){
     					array_push($arr['expiry_type'],'LICENSE');
     					array_push($arr['expiry'],$row['license_expiry_date']);
     					$x=1;
     					array_push($arr['names'],$row['bus_type'].$x);	
     				}
     				if($x< 0){
     					$x=-1;
     					array_push($arr['names'],$row['bus_type'].$x);
     				}
     				if($x>2){
     					$x=0;
     					array_push($arr['names'],$row['bus_type'].$x);
     				}
     			}
     			}else{
     				$x=0;
     				array_push($arr['names'],$row['bus_type'].$x);
     			}
     			
     			 array_push($arr['names'],$row['name']);
			     array_push($arr['names'],$row['plate_number']);
			     array_push($arr['names'],$row['chassis_number']);
			     array_push($arr['names'],$row['bus_license_upload']);
			     array_push($arr['names'],$row['license_expiry_date']);
			     array_push($arr['names'],$row['MVPI_upload']);
			     array_push($arr['names'],$row['MVPI_expiry_date']);
			     array_push($arr['names'],$data_counter++);
    		}
   		}
   		else{echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";}
   	$this->load->view('managebus_view',$arr);
  	}else{
   		redirect('welcome');
  	}
   }



		//upload mangebus
    public function addbus_upload(){
    	$data['file_name']="null";
    	
		/* $config['upload_path'] = './uploads/bus_document/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile')){
			$error = $this->upload->display_errors();
		}else{
			$data = $this->upload->data();
			
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/bus_document/'.$data['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data['file_name'] = str_replace(" ","_",$data['file_name']);
			$data['file_name'] = str_replace("&","_",$data['file_name']);
		} */
		//updalod file by API
			
		$files = $_FILES['userfile'];
		$_FILES['userfile']['name']     = $files['name'];
		$_FILES['userfile']['type']     = $files['type'];
		$_FILES['userfile']['tmp_name'] = $files['tmp_name'];
		$_FILES['userfile']['size']     = $files['size'];
		
		$path='Upload/uploadsBusDocument';
		$fileResponse=$this->TransportModel->upload_file_api($path,$_FILES['userfile']['tmp_name'],$_FILES['userfile']['type'],$_FILES['userfile']['name']);
		if($fileResponse){
			$data['file_name']=$fileResponse;
		}else{
			$data['file_name']=NULL;
		}
		
		$data_test['file']=$data['file_name'];
		$data1['file_name']="null";
			
		/* $config['upload_path'] = './uploads/bus_document/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile1')){
			$error = $this->upload->display_errors();
		}else{
			$data1 = $this->upload->data();
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/bus_document/'.$data1['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data1['file_name'] = str_replace(" ","_",$data1['file_name']);
			$data1['file_name'] = str_replace("&","_",$data1['file_name']);
		} */
		
		//updalod file by API
			
		$files = $_FILES['userfile1'];
		$_FILES['userfile1']['name']     = $files['name'];
		$_FILES['userfile1']['type']     = $files['type'];
		$_FILES['userfile1']['tmp_name'] = $files['tmp_name'];
		$_FILES['userfile1']['size']     = $files['size'];
		
		$path='Upload/uploadsBusDocument';
		$fileResponse=$this->TransportModel->upload_file_api($path,$_FILES['userfile1']['tmp_name'],$_FILES['userfile1']['type'],$_FILES['userfile1']['name']);
		if($fileResponse){
			$data1['file_name']=$fileResponse;
		}else{
			$data1['file_name']=NULL;
		}
		
		$bus_name=$this->input->post('bus_name');
		$bus_type=$this->input->post('bus_type');
		$chassis_number=$this->input->post('chassis_number');
		if($chassis_number==NULL){
			$chassis_number="null";
		}
		$plate_number=$this->input->post('plate_number');
		$fahas=$this->input->post('fahas');
		if($fahas==NULL){
			$fahas="null";
		}
		$license_expiry=$this->input->post('license_expiry');
		if($license_expiry==NULL){
			$license_expiry="null";
		}else{
		$license_expiry = date("Y-m-d", strtotime($license_expiry));
		}
		
		$license_renew=$this->input->post('license_renew');
		if($license_renew==NULL){
			$license_renew="null";
		}else{
		$license_renew = date("Y-m-d", strtotime($license_renew));
		}
		$mvpi_expiry=$this->input->post('mvpi_expiry');
		if($mvpi_expiry==NULL){
			$mvpi_expiry="null";
		}else{
		$mvpi_expiry = date("Y-m-d", strtotime($mvpi_expiry));
		}
		$this->load->model('TransportModel');
		$dataDetails = $this->TransportModel->add_managebus($bus_name,$bus_type,$chassis_number,$plate_number,$fahas,$data_test['file'],$license_expiry,$license_renew,$data1['file_name'],$mvpi_expiry);
			if($dataDetails['responsecode'] == 1){
				echo "<script type='text/javascript'>alert('successfully added');</script>";
			}
			else{
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.Try again.');</script>";
			}
		
		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/managebus');
	}


	public function edit_busdetails_with_popup($id){
  			if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
   			$this->load->model('TransportModel');
    		$arr['names'] = array();
   			$dataDetails = $this->TransportModel->managebus_data();
   			if($dataDetails['responsecode']==1){
    			$dataResult=$dataDetails['result_arr'];
    			$data_exp=0;
    			$arr['expiry']=array();$arr['expiry_type']=array();
    		foreach ($dataResult as $row) {
    			array_push($arr['names'],$row['bus_type']);
     			 array_push($arr['names'],$row['name']);
			     array_push($arr['names'],$row['plate_number']);
			     array_push($arr['names'],$row['chassis_number']);
			     array_push($arr['names'],$row['bus_license_upload']);
			     array_push($arr['names'],$row['license_expiry_date']);
			     array_push($arr['names'],$row['MVPI_upload']);
			     array_push($arr['names'],$row['MVPI_expiry_date']);
			     array_push($arr['names'],'');
    		}
    		$arr['edit_data']=array();
    		$edit_counter=0;
    		$arr['dropdown']=array();
    		foreach ($dataResult as $row) {
    			if($edit_counter==$id){
    			 array_push($arr['edit_data'],$row['name']);
    			 array_push($arr['edit_data'],$row['bus_type']);
    			 
    			 array_push($arr['edit_data'],$row['chassis_number']);
			     array_push($arr['edit_data'],$row['plate_number']);
			     array_push($arr['edit_data'],$row['fahas']);
			     array_push($arr['edit_data'],$row['bus_license_upload']);
			     if($row['license_expiry_date']!="null"){
		$expiry_date = date("m/d/Y", strtotime($row['license_expiry_date']));
			     array_push($arr['edit_data'],$expiry_date);
			 }else{
			 	array_push($arr['edit_data'],"null");
			 }
			 if($row['license_renewal_date']!="null"){
		$renw_date = date("m/d/Y", strtotime($row['license_renewal_date']));
			     array_push($arr['edit_data'],$renw_date);
			 }else{
			 	array_push($arr['edit_data'],"null");
			 }

			     array_push($arr['edit_data'],$row['MVPI_upload']);
			     if($row['MVPI_expiry_date']!="null"){
		$expiry_date = date("m/d/Y", strtotime($row['MVPI_expiry_date']));
			     array_push($arr['edit_data'],$expiry_date);
			 }else{
			 	array_push($arr['edit_data'],"null");
			 }
		
			 }
			 $edit_counter++;
    		}


   		}
   		else{echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";}
   	$this->load->view('edit_busdetails_withpopup',$arr);
  	}else{
   		redirect('welcome');
  	}
 	}


	//update bus details
	public function updatebus_upload(){
		
		 $data['file_name']=$this->input->post('userfile_doc');
		/*$config['upload_path'] = './uploads/bus_document/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile')){
			$error = $this->upload->display_errors();
		}else{
			$data = $this->upload->data();
			
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/bus_document/'.$data['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data['file_name'] = str_replace(" ","_",$data['file_name']);
			$data['file_name'] = str_replace("&","_",$data['file_name']);
		} */
		
		//updalod file by API
			
		$files = $_FILES['userfile'];
		$_FILES['userfile']['name']     = $files['name'];
		$_FILES['userfile']['type']     = $files['type'];
		$_FILES['userfile']['tmp_name'] = $files['tmp_name'];
		$_FILES['userfile']['size']     = $files['size'];
		
		$path='Upload/uploadsBusDocument';
		$fileResponse=$this->TransportModel->upload_file_api($path,$_FILES['userfile']['tmp_name'],$_FILES['userfile']['type'],$_FILES['userfile']['name']);
		if($fileResponse){
			$data['file_name']=$fileResponse;
		}else{
			$data['file_name']=NULL;
		}
		
		$data_test['file']=$data['file_name'];
		$data1['file_name']=$this->input->post('userfile1_doc');
		
		/* $config['upload_path'] = './uploads/bus_document/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile1')){
			$error = $this->upload->display_errors();
		}else{
			$data1 = $this->upload->data();
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/bus_document/'.$data1['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data1['file_name'] = str_replace(" ","_",$data1['file_name']);
			$data1['file_name'] = str_replace("&","_",$data1['file_name']);
			
		} */

		//updalod file by API
			
		$files = $_FILES['userfile1'];
		$_FILES['userfile1']['name']     = $files['name'];
		$_FILES['userfile1']['type']     = $files['type'];
		$_FILES['userfile1']['tmp_name'] = $files['tmp_name'];
		$_FILES['userfile1']['size']     = $files['size'];
		
		$path='Upload/uploadsBusDocument';
		$fileResponse=$this->TransportModel->upload_file_api($path,$_FILES['userfile1']['tmp_name'],$_FILES['userfile1']['type'],$_FILES['userfile1']['name']);
		if($fileResponse){
			$data1['file_name']=$fileResponse;
		}else{
			$data1['file_name']=NULL;
		}
		
		$bus_name=$this->input->post('bus_name');
		$bus_type=$this->input->post('bus_type');
		$chassis_number=$this->input->post('chassis_number');
		$plate_number=$this->input->post('plate_number');
		$fahas=$this->input->post('fahas');
		$license_expiry=$this->input->post('license_expiry');
		$license_expiry=date("Y-m-d", strtotime($license_expiry));
		$license_renew=$this->input->post('license_renew');
		$license_renew=date("Y-m-d", strtotime($license_renew));
		$mvpi_expiry=$this->input->post('mvpi_expiry');
		$mvpi_expiry=date("Y-m-d", strtotime($mvpi_expiry));
		$this->load->model('TransportModel');
		$dataDetails=$this->TransportModel->managebus_data();
		$data=$dataDetails['result_arr'];
		foreach ($data as $row) {
			if($bus_name==$row['name']){
				$bus_id=$row['bus_Id'];break;
			}
		}
		$dataDetails = $this->TransportModel->update_managebus($bus_name,$bus_type,$chassis_number,$plate_number,$fahas,$data_test['file'],$license_expiry,$license_renew,$data1['file_name'],$mvpi_expiry,$bus_id);
			if($dataDetails['responsecode'] == 1){
				echo "<script type='text/javascript'>alert('successfully updated');</script>";
			}
			else{
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.Try again.');</script>";
			}

		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/managebus');
	}


	 function accident_download($file_name){
        /* $this->load->helper('download');
        $data = file_get_contents("uploads/accident/" . $file_name);
        $name = $file_name;
        force_download($name, $data); */
		
		$config = file_get_contents("Assets/configuration.txt");
        $path= str_replace("index.php?web_services/","uploads/",$config);
		
        $this->load->helper('download');
        $data = file_get_contents($path."accidents/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
    }
	
	//delete bus_details
     function delete_managebus(){
    	$this->load->model('TransportModel');	
    	$x=$this->input->post('ID');
    	$data = $this->TransportModel->managebus_data();
    	$data1=$data['result_arr'];
    	$counter=0;
    	foreach ($data1 as $row) {
    		if($x==$counter){
    			$bus_id=$row['bus_Id'];break;
    			
    		}
    		$counter++;	
    		}
		//get data from the database			
		$data = $this->TransportModel->deletebusdetails($bus_id);	
		if($data['responsecode']!=1){
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.please try again.');</script>";
    	}
		
		//$this->load->view('routes');
		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/managebus');

    }


	//download
	  function managebus_download($file_name){
        /* $this->load->helper('download');
        $data = file_get_contents("uploads/bus_document/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
		 */
		$config = file_get_contents("Assets/configuration.txt");
        $path= str_replace("index.php?web_services/","uploads/",$config);
		
        $this->load->helper('download');
        $data = file_get_contents($path."bus_document/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
    }

public function edit_driverdetails_with_popup($id){
  			if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$arr['names']=array();
		$arr['asain_bus']=array();
		$arr['bus_id_details']=array();
		$this->load->model('TransportModel');
		$data_bus=$this->TransportModel->populate_bus();
    	if($data_bus['responsecode']==1){
    		$data_bus_details=$data_bus['result_arr'];
    		foreach ($data_bus_details as $row) {
    			array_push($arr['asain_bus'], $row['name']);
    			 
    		}
    		
    	}
    	$arr['pf']=array();
		$dataDetails = $this->TransportModel->get_driver_profile();
		
		if($dataDetails['responsecode']==1){
			$data1=$dataDetails['result_arr'];
			$action_id=0;
			$arr['expiry']=array();$arr['expiry_type']=array();
			foreach ($data1 as $row) {
				array_push($arr['names'], $row['name']);
				array_push($arr['names'], $row['iqama_number']);
				array_push($arr['names'], $row['iqama_expiry_date']);
				array_push($arr['names'], $row['passport_number']);
				array_push($arr['names'], $row['passport_expiry_date']);
				array_push($arr['names'], $row['license_number']);
				array_push($arr['names'], $row['license_expiry_date']);
				array_push($arr['names'], $row['mobile']);
				array_push($arr['names'], $action_id);
				$action_id++;

			}
$count_id=0;

			foreach ($data1 as $row) {
				if($count_id==$id){
				$bus=$row['assigned_bus'];break;
				}$count_id++;	

			}
		$data_bus_name=$this->TransportModel->populate_bus();
    	if($data_bus_name['responsecode']==1){
    		$data_bus_details=$data_bus['result_arr'];
    		foreach ($data_bus_details as $row) {
    			if($bus==$row['bus_Id']){
    				$bus_name=$row['name'];break;
    			} 
    		}
    	}


		$count_id=0;
		$this->load->library('ApiCrypter');
			foreach ($data1 as $row) {
				if($count_id==$id){
				array_push($arr['pf'], $row['name']);
				array_push($arr['pf'], $row['mobile']);
				$pass_decrypt = $this->apicrypter->decrypt($row['password']);
				array_push($arr['pf'], $pass_decrypt);
				array_push($arr['pf'], $row['nationality']);
				array_push($arr['pf'], $row['iqama_number']);
				$row['iqama_expiry_date'] = date("m/d/Y", strtotime($row['iqama_expiry_date']));
				array_push($arr['pf'], $row['iqama_expiry_date']);
				array_push($arr['pf'], $row['iqama_upload']);
				array_push($arr['pf'], $row['passport_number']);
				$row['passport_expiry_date'] = date("m/d/Y", strtotime($row['passport_expiry_date']));
				array_push($arr['pf'], $row['passport_expiry_date']);
				array_push($arr['pf'], $row['passport_upload']);
				array_push($arr['pf'], $row['license_number']);
				array_push($arr['pf'], $row['license_expiry_date']);
				array_push($arr['pf'], $row['license_upload']);
				if($bus_name==NULL){
					$bus_name="select here";
				}
				array_push($arr['pf'], $bus_name);
				array_push($arr['pf'], $row['photo']);

				}$count_id++;	

			}


		}else{
			echo "<script type='text/javascript'>alert('Sorry!! no data found.Try again');</script>";
  
		}


		$this->load->view('managedrivers_with_popup_edit',$arr);

}else{
	redirect('Welcome');
}
 	}


	public function updatedriver_upload(){
		$data['file_name']=$this->input->post('userfile_doc');
		$config['upload_path'] = './uploads/driver_document/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile')){
			$error = $this->upload->display_errors();
		}else{
			$data = $this->upload->data();
			/* Adding Image Watermark */
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/driver_document/'.$data['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data['file_name'] = str_replace(" ","_",$data['file_name']);
			$data['file_name'] = str_replace("&","_",$data['file_name']);
		}
		$data_iqama['file']=$data['file_name'];
		$data1['file_name']=$this->input->post('userfile1_doc');
		$config['upload_path'] = './uploads/driver_document/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile1')){
			$error = $this->upload->display_errors();
		}else{
			$data1 = $this->upload->data();
			/* Adding Image Watermark */
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/driver_document/'.$data1['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data1['file_name'] = str_replace(" ","_",$data1['file_name']);
			$data1['file_name'] = str_replace("&","_",$data1['file_name']);
			
		}
		$data_passport['file']=$data1['file_name'];

		$data2['file_name']=$this->input->post('userfile2_doc');
		$config['upload_path'] = './uploads/driver_document/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile2')){
			$error = $this->upload->display_errors();
		}else{
			$data2 = $this->upload->data();
			/* Adding Image Watermark */
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/driver_document/'.$data1['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data2['file_name'] = str_replace(" ","_",$data2['file_name']);
			$data2['file_name'] = str_replace("&","_",$data2['file_name']);
			
		}
		$data_license['file']=$data2['file_name'];


		$data3['file_name']=$this->input->post('userfile3_doc');
		$config['upload_path'] = './uploads/driver_image/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('userfile3')){
			$error = $this->upload->display_errors();
		}else{
			$data3 = $this->upload->data();
			/* Adding Image Watermark */
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/driver_image/'.$data1['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data3['file_name'] = str_replace(" ","_",$data3['file_name']);
			$data3['file_name'] = str_replace("&","_",$data3['file_name']);
			
		}
		$data_photo['file']=$data3['file_name'];

		$driver_name=$this->input->post('driver_name');
		if($driver_name==NULL){
			$driver_name="null";
		}
		$mobile=$this->input->post('mobile');

        $this->load->library('ApiCrypter');
		$password=$this->input->post('password');
		$pass_encrypt = $this->apicrypter->encrypt($row['password']);

		$nationality=$this->input->post('nationality');
		if($nationality==NULL){$nationality="null";}
		$IqamaNumber=$this->input->post('IqamaNumber');
		if($IqamaNumber==NULL){$IqamaNumber="null";}
		$IqamaExpiryDate=$this->input->post('IqamaExpiryDate');
		if($IqamaExpiryDate==NULL){$IqamaExpiryDate="null";}else{
		$IqamaExpiryDate=date("Y-m-d", strtotime($IqamaExpiryDate));}
		$PassportNumber=$this->input->post('PassportNumber');
		if($PassportNumber==NULL){$PassportNumber="null";}
		$PassportExpiryDate=$this->input->post('PassportExpiryDate');
		if($PassportExpiryDate==NULL){$PassportExpiryDate="null";}else{
		$PassportExpiryDate=date("Y-m-d", strtotime($PassportExpiryDate));}
		$LicenseNumber=$this->input->post('LicenseNumber');
		if($LicenseNumber==NULL){$LicenseNumber="null";}
		$LicenseExpiryDate=$this->input->post('LicenseExpiryDate');
		if($LicenseExpiryDate==NULL){$LicenseExpiryDate="null";}else{
		$LicenseExpiryDate=date("Y-m-d", strtotime($LicenseExpiryDate));}
		$assignbus=$this->input->post('assignbus');
		if($assignbus==NULL || $assignbus=="select here"){
			$assignbus_id="null";
		}else{
			$this->load->model('TransportModel');
			$data_bus=$this->TransportModel->populate_bus();
    		if($data_bus['responsecode']==1){
    			$data_bus_details=$data_bus['result_arr'];
    			foreach ($data_bus_details as $row) {
    				if($assignbus==$row['name']){
    					$assignbus_id=$row['bus_Id'];
    					break;
    				}
    		}
    	}
		}


$this->load->model('TransportModel');
$data_driver=$this->TransportModel->get_driver_profile();
if($data_driver['responsecode']==1){
    			$data_driver_details=$data_driver['result_arr'];
    			foreach ($data_driver_details as $row) {
    				if($driver_name==$row['name'] && $mobile==$row['mobile']){
    					$driver_id=$row['driver_id'];
    					break;
    				}
    		}
    		
    	}

$dataDetails = $this->TransportModel->update_driver_details($driver_name,$nationality,$IqamaNumber,$IqamaExpiryDate,$PassportNumber,$PassportExpiryDate,$mobile,$pass_encrypt,$data_photo['file'],$assignbus_id,$data_iqama['file'],$data_license['file'],$data_passport['file'],$LicenseNumber,$LicenseExpiryDate,$driver_id);
		
	if($dataDetails['responsecode']==1){
		echo "<script type='text/javascript'>alert('successfully updated.');</script>";
	}else{
		echo "<script type='text/javascript'>alert('Sorry!! Try again.');</script>";
	}

	redirect(base_url() . 'index.php/Welcome/managedrivers', 'refresh');
	}

	function managedriver_download($file_name){
        $this->load->helper('download');
        $data = file_get_contents("uploads/driver_document/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
    }
    function managedriver_download_photo($file_name){
        $this->load->helper('download');
        $data = file_get_contents("uploads/driver_image/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
    }

	//Contracts initial
 		public function contract(){
  				if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
   					$this->load->model('TransportModel');
    				$arr['names'] = array();
   					$dataDetails = $this->TransportModel->get_contracts();
   					if($dataDetails['responsecode']==1){
    				$dataResult=$dataDetails['result_arr'];
    				$edit_delete_count=0;
    				$arr['expiry']=array();
    				$count_exp=0;
    			foreach ($dataResult as $row) {
						$DateOfRequest=date('Y-m-d');
     					$your_date = strtotime($row['expiry_date']);
     				$datediff = $your_date-strtotime($DateOfRequest);
     				$x=floor($datediff / (60 * 60 * 24));
     				
     				if($x<=2 && $x>=0){
     					array_push($arr['expiry'],$row['expiry_date']);
     					$x=1;
     					array_push($arr['names'],$row['contract_date'].$x);
     					
     				}
     				if($x< 0){

     					$x=-1;
     					array_push($arr['names'],$row['contract_date'].$x);
     					
     				}
     				if($x>2){
     					$x=0;
     					array_push($arr['names'],$row['contract_date'].$x);
     				}
     				
     				// array_push($arr['names'],$row['contract_date'].$x);
     				array_push($arr['names'],$row['vendor_name']);
     				array_push($arr['names'],$row['vendor_email']);
     				array_push($arr['names'],$row['vendor_mobile']);
     				array_push($arr['names'],$row['busses_provide']);
     				array_push($arr['names'],$row['driver_provide']);
     				array_push($arr['names'], $row['expiry_date']);
     				// $DateOfRequest=date('Y-m-d',strtotime("+ 2 day"));
     				if($row['document']=="null"){
     					array_push($arr['names'],'');
     				}else{
     				array_push($arr['names'],$row['document']);
     			}
     				array_push($arr['names'],$edit_delete_count);
     				$edit_delete_count++;
    				}
   				}
   		else{echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";}
   		$this->load->view('contracts',$arr);
  		}else{
   			redirect('welcome');
  		}
 	}

	//download
	function contract_download($file_name){
		/*$this->load->helper('download');
        $data = file_get_contents("uploads/contract_document/" . $file_name);
        $name = $file_name;
        force_download($name, $data);*/    
		
		$config = file_get_contents("Assets/configuration.txt");
        $path= str_replace("index.php?web_services/","uploads/",$config);
		
        $this->load->helper('download');
        $data = file_get_contents($path."contract_document/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
	}

	//upload
 	public function contract_add_details(){
		$data['file_name']="null";
		$addi_details="null";
		/* $config['upload_path'] = './uploads/contract_document/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile')){
			$error = $this->upload->display_errors();
		}else{
			$data = $this->upload->data();
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/contract_document/'.$data['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {	
			}
			$data['file_name'] = str_replace(" ","_",$data['file_name']);
			$data['file_name'] = str_replace("&","_",$data['file_name']);
		} */
		
		//updalod file by API
		$files = $_FILES['userfile'];
		$_FILES['userfile']['name']     = $files['name'];
		$_FILES['userfile']['type']     = $files['type'];
		$_FILES['userfile']['tmp_name'] = $files['tmp_name'];
		$_FILES['userfile']['size']     = $files['size'];
		
		$path='Upload/uploadsContractDocument';
		$fileResponse=$this->TransportModel->upload_file_api($path,$_FILES['userfile']['tmp_name'],$_FILES['userfile']['type'],$_FILES['userfile']['name']);
		if($fileResponse){
			$data['file_name']=$fileResponse;
		}else{
			$data['file_name']=NULL;
		}

		$contract_date=$this->input->post('contract_date');
		$contract_date = date("Y-m-d", strtotime($contract_date));
		$vendor_name=$this->input->post('vendor_name');
		$vendor_email=$this->input->post('vendor_email');
		$vendor_mobile=$this->input->post('vendor_mobile');
		$bus_provided=$this->input->post('bus_provided');
		$driver_provided=$this->input->post('driver_provided');
		$expiry_date=$this->input->post('expiry_date');
		$expiry_date = date("Y-m-d", strtotime($expiry_date));
		$addi_details=$this->input->post('addi_details');

		if(empty($addi_details)){
			$addi_details="null";
		}
		if(empty($data['file_name'])){
		$data['file_name']="null";
		}	
		$this->load->model('TransportModel');
		$dataDetails = $this->TransportModel->send_contracts($vendor_name,$vendor_email,$contract_date,$vendor_mobile,$bus_provided,$driver_provided,$expiry_date,$addi_details,$data['file_name']);
		if($dataDetails['responsecode'] == 1){
			echo "<script type='text/javascript'>alert('successfully added');</script>";
		}
			else{
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.Try again.');</script>";
			}
		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/contract','refresh');
		
		
	}

	//contract_with_popup
 	 	public function edit_contract_with_popup($id){
  			if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
   				$this->load->model('TransportModel');
    			$arr['names'] = array();
   				$dataDetails = $this->TransportModel->get_contracts();
   			if($dataDetails['responsecode']==1){
    			$dataResult=$dataDetails['result_arr'];
    			$edit_delete_count=0;
    		foreach ($dataResult as $row) {
     			array_push($arr['names'],$row['contract_date']);
     			array_push($arr['names'],$row['vendor_name']);
     			array_push($arr['names'],$row['vendor_email']);
     			array_push($arr['names'],$row['vendor_mobile']);
     			array_push($arr['names'],$row['busses_provide']);
     			array_push($arr['names'],$row['driver_provide']);
     			array_push($arr['names'],$row['expiry_date']);
     			if($row['document']=="null"){
     					array_push($arr['names'],'');
     				}else{
     				array_push($arr['names'],$row['document']);
     			}
     			array_push($arr['names'],$edit_delete_count);
     			$edit_delete_count++;
    			}
    		$arr['edit_data']=array();
    		$arr['contract_id']=array();
    		$edit_count=0;
    		foreach ($dataResult as $row) {
    			if($edit_count==$id){
    			array_push($arr['contract_id'], $row['id']);
			$contract_date1 = date("d-m-Y", strtotime($row['contract_date']));
     			array_push($arr['edit_data'],$contract_date1);
     			array_push($arr['edit_data'],$row['vendor_name']);
     			array_push($arr['edit_data'],$row['vendor_email']);
			     array_push($arr['edit_data'],$row['vendor_mobile']);
			     array_push($arr['edit_data'],$row['busses_provide']);
			     array_push($arr['edit_data'],$row['driver_provide']);
				$contract_date1 = date("d-m-Y", strtotime($row['expiry_date']));
			     array_push($arr['edit_data'],$contract_date1);
			     array_push($arr['edit_data'],$row['addtional_details']);
			     if($row['document']=="null"){
     					array_push($arr['edit_data'],'');
     				}else{
     				array_push($arr['edit_data'],$row['document']);
     			}
 				}
     		$edit_count++;
    		}
   		}
   		else{echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";}
		$this->load->view('edit_contract_withpopup',$arr);
  		}else{
   			redirect('welcome');
  		}
 	}



	//update/edit contract
	public function update_contract(){
	$file_name="null";
	$user_file_default=$this->input->post('user_file_default');
			if($user_file_default!=null){
				$file_name=$user_file_default;
				}
	$data['file_name']=array();
		
		/* $config['upload_path'] = './uploads/contract_document/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile')){
			$error = $this->upload->display_errors();
		}else{
			$data = $this->upload->data();
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/contract_document/'.$data['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {	
			}
			$data['file_name'] = str_replace(" ","_",$data['file_name']);
			$data['file_name'] = str_replace("&","_",$data['file_name']);
				if(strlen($data['file_name'])>5)
						{
							$file_name=$data['file_name'];
						}
		} */
		
//updalod file by API
		$files = $_FILES['userfile'];
		$_FILES['userfile']['name']     = $files['name'];
		$_FILES['userfile']['type']     = $files['type'];
		$_FILES['userfile']['tmp_name'] = $files['tmp_name'];
		$_FILES['userfile']['size']     = $files['size'];
		
		$path='Upload/uploadsContractDocument';
		$fileResponse=$this->TransportModel->upload_file_api($path,$_FILES['userfile']['tmp_name'],$_FILES['userfile']['type'],$_FILES['userfile']['name']);
		if($fileResponse){
			$data['file_name']=$fileResponse;
		}else{
			$data['file_name']=NULL;
		}	

		if(strlen($data['file_name'])>5)
		{
			$file_name=$data['file_name'];
		}		
		
		$contract_id=$this->input->post('contractid');
		$contract_date=$this->input->post('contract_date');
		$contract_date = date("Y-m-d", strtotime($contract_date));
		$vendor_name=$this->input->post('vendor_name');
		$vendor_email=$this->input->post('vendor_email');
		$vendor_mobile=$this->input->post('vendor_mobile');
		$bus_provided=$this->input->post('bus_provided');
		$driver_provided=$this->input->post('driver_provided');
		$expiry_date=$this->input->post('expiry_date');
		$expiry_date = date("Y-m-d", strtotime($expiry_date));
		$addi_details=$this->input->post('addi_details');
		$this->load->model('TransportModel');
   		
		$dataDetails = $this->TransportModel->update_contracts($vendor_name,$vendor_email,$contract_date,$vendor_mobile,$bus_provided,$driver_provided,$expiry_date,$addi_details,$file_name,$contract_id);
		if($dataDetails['responsecode'] == 1){
			echo "<script type='text/javascript'>alert('successfully added');</script>";
		}
			else{
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.Try again.');</script>";
			}
		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/contract','refresh');
	}

	//delete contract
 	public function del_contract_with_popup($id){
  			if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
   				$this->load->model('TransportModel');
    			$arr['names'] = array();
    			$arr['edtordel']=array();
    			array_push($arr['edtordel'], "1");
   				$dataDetails = $this->TransportModel->get_contracts();
   			if($dataDetails['responsecode']==1){
    			$dataResult=$dataDetails['result_arr'];
    			$edit_delete_count=0;
    		foreach ($dataResult as $row) {
     			array_push($arr['names'],$row['contract_date']);
     			array_push($arr['names'],$row['vendor_name']);
     			array_push($arr['names'],$row['vendor_email']);
     			array_push($arr['names'],$row['vendor_mobile']);
     			array_push($arr['names'],$row['busses_provide']);
     			array_push($arr['names'],$row['driver_provide']);
     			array_push($arr['names'],$row['expiry_date']);
     			array_push($arr['names'],$row['document']);
     			array_push($arr['names'],$edit_delete_count);
     			$edit_delete_count++;
    			}
    		$arr['edit_data']=array();
    		$arr['con_del_id']=array();
    		$edit_count=0;
    		foreach ($dataResult as $row) {
    			if($edit_count==$id){
    			array_push($arr['con_del_id'], $row['id']);
     			array_push($arr['edit_data'],$row['contract_date']);
     			array_push($arr['edit_data'],$row['vendor_name']);
     			array_push($arr['edit_data'],$row['vendor_email']);
			     array_push($arr['edit_data'],$row['vendor_mobile']);
			     array_push($arr['edit_data'],$row['busses_provide']);
			     array_push($arr['edit_data'],$row['driver_provide']);
			     array_push($arr['edit_data'],$row['expiry_date']);
			     array_push($arr['edit_data'],$row['addtional_details']);
			     array_push($arr['edit_data'],$row['document']);
 				}
     		$edit_count++;
    		}
   		}
   		else{echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";}
		$this->load->view('del_contract_withpopp',$arr);
  		}else{
   			redirect('welcome');
  		}
 	}

	//delete contract
	public function delete_contract(){
		$con_del_id=$this->input->post('con_del_id');
		$this->load->model('TransportModel');
		$dataDetails = $this->TransportModel->get_contracts();
		$data_file=$dataDetails['result_arr'];
		foreach ($data_file as $row) {
			if($con_del_id==$row['id']){
				$files=$row['document'];break;
			}
		}
		$this->load->helper("file");
		$path='./uploads/contract_document/'.$files;
		unlink($path);
		
		$dataDetails = $this->TransportModel->del_contct($con_del_id);
		if($dataDetails['responsecode']==1){
			echo "<script type='text/javascript'>alert('successfully deleted');</script>";
		}
			else{
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.Try again.');</script>";
			}
		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/contract','refresh');

	}


		public function add_driver_upload(){

		$data['file_name']="null";
		$config['upload_path'] = './uploads/driver_document/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('iqama_upload')){
			$error = $this->upload->display_errors();
		}else{
			$data = $this->upload->data();
			/* Adding Image Watermark */
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/driver_document/'.$data['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data['file_name'] = str_replace(" ","_",$data['file_name']);
			$data['file_name'] = str_replace("&","_",$data['file_name']);
			
		}
		$data_file1['file']=$data['file_name'];

		$data['file_name']="null";
		$config['upload_path'] = './uploads/driver_document/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('passport_upload')){
			$error = $this->upload->display_errors();
		}else{
			$data = $this->upload->data();
			/* Adding Image Watermark */
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/driver_document/'.$data['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data['file_name'] = str_replace(" ","_",$data['file_name']);
			$data['file_name'] = str_replace("&","_",$data['file_name']);
			
		}
		$data_file2['file']=$data['file_name'];

		$data['file_name']="null";
		$config['upload_path'] = './uploads/driver_document/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('license_upload')){
			$error = $this->upload->display_errors();
		}else{
			$data = $this->upload->data();
			/* Adding Image Watermark */
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/driver_document/'.$data['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data['file_name'] = str_replace(" ","_",$data['file_name']);
			$data['file_name'] = str_replace("&","_",$data['file_name']);
			
		}
		$data_file3['file']=$data['file_name'];

		$data['file_name']="null";
		$config['upload_path'] = './uploads/driver_image/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('photo_upload')){
			$error = $this->upload->display_errors();
		}else{
			$data = $this->upload->data();
			/* Adding Image Watermark */
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/driver_image/'.$data['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data['file_name'] = str_replace(" ","_",$data['file_name']);
			$data['file_name'] = str_replace("&","_",$data['file_name']);
			
		}



		
		// $CI =& get_instance();
		$this->load->library('ApiCrypter');
		$driver_name=$this->input->post('driver_name');
		$mobile=$this->input->post('mobile');
		$pass=$this->input->post('pass');
		$pass = $this->apicrypter->encrypt($pass);
		$driver_nationality=$this->input->post('driver_nationality');
		if($driver_nationality==NULL){
			$driver_nationality="null";
		}
		$iq_number=$this->input->post('iq_number');
		if($iq_number==NULL){$iq_number="null";}
		$iq_exp_date=$this->input->post('iq_exp_date');
		if($iq_exp_date==NULL){$iq_exp_date="null";}else{
		$iq_exp_date = date("Y-m-d", strtotime($iq_exp_date));}
		$pass_number=$this->input->post('pass_number');
		if($pass_number==NULL){$pass_number="null";}
		$pass_exp_date=$this->input->post('pass_exp_date');
		if($pass_exp_date==NULL){$pass_exp_date="null";}else{
		$pass_exp_date = date("Y-m-d", strtotime($pass_exp_date));}
		$lc_number=$this->input->post('lc_number');
		if ($lc_number==NULL) {$lc_number="null";}
		$lc_exp_number=$this->input->post('lc_exp_number');
		if($lc_exp_number==NULL){$lc_exp_number="null";}else{
		$lc_exp_number = date("Y-m-d", strtotime($lc_exp_number));}
		$assign_bus=$this->input->post('assignbus');
		$assign_bus_id="null";

		$this->load->model('TransportModel');
		$data_bus=$this->TransportModel->populate_bus();
    	if($data_bus['responsecode']==1){
    		$data_bus_details=$data_bus['result_arr'];
    		foreach ($data_bus_details as $row) {
    			if($row['name']==$assign_bus){
    				$assign_bus_id=$row['bus_Id'];
    				break;
    			}
    		}
    	}


		$dataDetails = $this->TransportModel->add_new_driver($driver_name,$driver_nationality,$iq_number,$iq_exp_date,$pass_number,$pass_exp_date,$mobile,$pass,$data['file_name'],$assign_bus_id,$data_file1['file'],$data_file3['file'],$data_file2['file'],$lc_number,$lc_exp_number);
		if($dataDetails['responsecode']==1){
			echo "<script type='text/javascript'>alert('Added successfully');</script>";
		}else{
			echo "<script type='text/javascript'>alert('Sorry something wrong.Try again');</script>";
		}
	redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/managedrivers','refresh');
		
	}


	public function managedrivers_with_popup($id){
if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$arr['names']=array();
		$arr['asain_bus']=array();
		$this->load->model('TransportModel');
		$data_bus=$this->TransportModel->populate_bus();
    	if($data_bus['responsecode']==1){
    		$data_bus_details=$data_bus['result_arr'];
    		foreach ($data_bus_details as $row) {
    			array_push($arr['asain_bus'], $row['name']);
    		}
    	}
    	$arr['pf']=array();
		$dataDetails = $this->TransportModel->get_driver_profile();
		if($dataDetails['responsecode']==1){
			$data1=$dataDetails['result_arr'];
			$action_id=0;
			foreach ($data1 as $row) {
				array_push($arr['names'], $row['name']);
				array_push($arr['names'], $row['iqama_number']);
				array_push($arr['names'], $row['iqama_expiry_date']);
				array_push($arr['names'], $row['passport_number']);
				array_push($arr['names'], $row['passport_expiry_date']);
				array_push($arr['names'], $row['license_number']);
				array_push($arr['names'], $row['license_expiry_date']);
				array_push($arr['names'], $row['mobile']);
				array_push($arr['names'], $action_id);
				$action_id++;
			}
			$counter=0;
			$this->load->library('ApiCrypter');
			foreach ($data1 as $row) {
				if($counter==$id){
				array_push($arr['pf'], $row['photo']);
				array_push($arr['pf'], $row['name']);
				array_push($arr['pf'], $row['driver_id']);
				array_push($arr['pf'], $row['nationality']);
				array_push($arr['pf'], $row['mobile']);
				//$row['password']=$this->apicrypter->decrypt($row['password']);
				array_push($arr['pf'], $row['password']);
				array_push($arr['pf'], $row['assigned_bus']);
				array_push($arr['pf'], $row['pickup_route_id']);
				array_push($arr['pf'], $row['drop_route_id']);
				array_push($arr['pf'], $row['iqama_number']);
				array_push($arr['pf'], $row['iqama_expiry_date']);
				array_push($arr['pf'], $row['passport_number']);
				array_push($arr['pf'], $row['passport_expiry_date']);
				array_push($arr['pf'], $row['license_number']);
				array_push($arr['pf'], $row['license_expiry_date']);

				array_push($arr['pf'], $row['iqama_upload']);
				array_push($arr['pf'], $row['passport_upload']);
				array_push($arr['pf'], $row['license_upload']);
	
			}
			$counter++;
			}
		}else{
			echo "<script type='text/javascript'>alert('Sorry!! no data found.Try again');</script>";
  
		}
		$this->load->view('managedriver_withpopup',$arr);
	}else{
		redirect('Welcome');
	}	
}



	public function reports(){
    if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){

    if($this->input->post('startdate')!=''){
 		$startdate=$this->input->post('startdate');
 		$startdate=date("Y-m-d",strtotime($startdate));
 		$enddate=$this->input->post('enddate');
 		$enddate=date("Y-m-d",strtotime($enddate));
 		$speedlimit=$this->input->post('speedlimit');
 		$arr['dates'] = array();
 		array_push($arr['dates'], $startdate, $enddate);
 		//echo $speedlimit;
 		$speed = explode(" ",$speedlimit);
        $speed = $speed[0];
       // echo $speed;
        $speedlower = $speed - 10;
        //echo $speedlower;
        $bool = false;
        $responsecode = 1;
        //echo $speed;
 	
 			$this->load->model('TransportModel');
 	        $data_report = $this->TransportModel->report_data($startdate,$enddate);
			$arr['report'] = array();
            $arr1['reports'] = array();
			if($data_report['responsecode']===1){
		 	$data=$data_report['result_arr'];
        		foreach ($data as $row) {

        			if ($speedlower < $row['cur_speed'] and $row['cur_speed'] <= $speed) {
        				$bool = true;
        		        array_push($arr['report'],$row['date'] );
	    			    array_push($arr['report'],$row['bus_name'] );
	    			    array_push($arr['report'],$row['driver_name'] );
	    			    array_push($arr['report'],$row['cur_speed'] );
                        
        			}
        			array_push($arr1['reports'],$arr['report']);
        			unset($arr);
        			$arr['report'] = array();
        		}

        	}else{
        		$responsecode = 0;
    			echo "<script type='text/javascript'>alert('Sorry!! No data found.');</script>";
    		}
 	if (!$bool and $responsecode !== 0) {
 		echo "<script type='text/javascript'>alert('Sorry!! No data found.');</script>";
 	}

    	}

 	$this->load->view('reports_view',$arr1);
 }else{
 	redirect('Welcome');
 }

}


public function edit_incident_with_popup($id){
	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');
		

        $arr['incident'] = array();$arr['incident1'] = array();
        //$vehicle_name = array();
        $arr1['incident'] = array();$arr1['incident1'] = array();
        $arr1['driver_list'] = array();
        $arr1['bus_list'] = array();
        $arr2['bus_list'] = array();
        $edit_delete_count=0;

//For Listing bus name in the add field
  	    $bus_data = $this->TransportModel->get_bus_list();
		   if ($bus_data['responsecode']==1) {
		        $bus_data1=$bus_data['result_arr'];
		            foreach ($bus_data1 as $row) {
		            		array_push($arr2['bus_list'], $row['bus_Id'], $row['name']);
		            		array_push($arr1['bus_list'], $arr2['bus_list']);
		            		unset($arr2);
        		            $arr2['bus_list'] = array();
        		           
		            }
		    }

//////////

          $arr2['driver_list']=array();
//For Listing driver name in the add field
        $driver_data = $this->TransportModel->get_driver_list();
		    if ($driver_data['responsecode']==1) {
		        $driver_data1=$driver_data['result_arr'];
		            foreach ($driver_data1 as $row) {
		     
		            		array_push($arr2['driver_list'], $row['driver_id'], $row['name']);
		            		
		            		array_push($arr1['driver_list'], $arr2['driver_list']);
		            		unset($arr2);
        		            $arr2['driver_list'] = array();
        		            
		            }

			
		    }



        $data = $this->TransportModel->get_accident_Details();
        if($data['responsecode']==1){
		$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
 
				 array_push($arr['incident'], $row['date'], $row['details'], $row['report_upload'], $row['bus_name'], $row['driver_name'], $row['fine_amount'], $row['status'], $row['document_upload'], $edit_delete_count);

				 $edit_delete_count++;
        		array_push($arr1['incident'], $arr['incident']);
        		unset($arr);
        		$arr['incident'] = array();
        		}
		$counter=0;
		$arr1['incident3'] = array();
		foreach ($data1 as $row) {
			if($id==$counter){
 				$row['date']=date("m/d/Y",strtotime($row['date']));
				 array_push($arr1['incident3'], $row['date'], $row['details'], $row['report_upload'], $row['bus_name'], $row['driver_name'], $row['fine_amount'], $row['status'], $row['document_upload']);
        		
				}$counter++;
        		}

        		
		}

		$this->load->view('accident_view_edit_popup',$arr1);
		}else{
	         redirect('welcome');
        }

}


function delete_managedriver(){
    	$this->load->model('TransportModel');	
    	$x=$this->input->post('ID');
    	$data = $this->TransportModel->get_driver_profile();
    	$data1=$data['result_arr'];
    	$counter=0;
    	foreach ($data1 as $row) {
    		if($x==$counter){
    			$driver_id=$row['driver_id'];break;
    			
    		}
    		$counter++;	
    		}
		//get data from the database			
		$data = $this->TransportModel->deletedriverdetails($driver_id);	
		if($data['responsecode']!=1){
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.please try again.');</script>";
    	}
		
		//$this->load->view('routes');
		redirect(base_url() . 'index.php/Welcome/managedrivers', 'refresh');

    }


	public function student_misbehaviour(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');
          
         	$arr['incident'] = array();
        	//$vehicle_name = array();
        	$arr1['incident'] = array();
        	$arr1['student_list'] = array();
        	$arr1['bus_list'] = array();
        	
        	$arr2['bus_list'] = array();

//For Listing bus name in the add field
  	    $bus_data = $this->TransportModel->get_bus_list();
		   if ($bus_data['responsecode']==1) {
		        $bus_data1=$bus_data['result_arr'];
		            foreach ($bus_data1 as $row) {
		            		array_push($arr2['bus_list'], $row['bus_Id'], $row['name']);

		            		array_push($arr1['bus_list'], $arr2['bus_list']);
		            		unset($arr2);
        		            $arr2['bus_list'] = array();
		            }
		    }
$arr2['student_list'] = array();
//For Listing student name in the add field
        $driver_data = $this->TransportModel->getallStudentsDetails();
		    if ($driver_data['responsecode']==1) {
		        $driver_data1=$driver_data['result_arr'];
		            foreach ($driver_data1 as $row) {
		            		array_push($arr2['student_list'], $row['student_id'], $row['name']);
		            		array_push($arr1['student_list'], $arr2['student_list']);
		            		unset($arr2);
        		            $arr2['student_list'] = array();
		            }
		    }

		$this->load->view('student_misbehavior_details',$arr1);
		}else{
	         redirect('welcome');
        }
	}

	public function student_misbehaviour_data(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');
          
        $arr['misbehave'] = array();
        //$vehicle_name = array();
        $arr1['misbehave'] = array();
        $arr1['student_list'] = array();
        $arr1['bus_list'] = array();
        $arr2['student_list'] = array();
        $arr2['bus_list'] = array();

		$busid=$this->input->post('busname');
		$data_report = $this->TransportModel->misbehaviour_data($busid);
			if($data_report['responsecode']===1){
		 	  $data=$data_report['result_arr'];
        		foreach ($data as $row) {
                        array_push($arr['misbehave'],$row['date'] );
        		        array_push($arr['misbehave'],$row['bus_id'] );
	    			    array_push($arr['misbehave'],$row['student_name'] );
	    			    array_push($arr['misbehave'],$row['details'] );
        			array_push($arr1['misbehave'],$arr['misbehave']);
        			unset($arr);
        			$arr['misbehave'] = array();
  
        		}

        	}else{
        
    			echo "<script type='text/javascript'>alert('Sorry!! No data found.');</script>";
    		}

    		//For Listing bus name in the add field

  	    $bus_data = $this->TransportModel->get_bus_list();
		   if ($bus_data['responsecode']==1) {
		        $bus_data1=$bus_data['result_arr'];
		            foreach ($bus_data1 as $row) {
		            		array_push($arr2['bus_list'], $row['bus_Id'], $row['name']);

		            		array_push($arr1['bus_list'], $arr2['bus_list']);
		            		unset($arr2);
        		            $arr2['bus_list'] = array();
		            }
		    }

//For Listing student name in the add field
        $driver_data = $this->TransportModel->getallStudentsDetails();
		    if ($driver_data['responsecode']==1) {
		        $driver_data1=$driver_data['result_arr'];
		            foreach ($driver_data1 as $row) {
		            		array_push($arr2['student_list'], $row['student_id'], $row['name']);
		            		array_push($arr1['student_list'], $arr2['student_list']);
		            		unset($arr2);
        		            $arr2['student_list'] = array();
		            }
		    }

		$this->load->view('student_misbehavior_details',$arr1);
		}else{
	         redirect('welcome');
        }
	}

//adding misbehaviour
    public function getStudentList($student_id){
        $student_name;
    	$this->load->model('TransportModel');
    	        $driver_data = $this->TransportModel->getallStudentsDetails();
		    if ($driver_data['responsecode']==1) {
		        $driver_data1=$driver_data['result_arr'];
		            foreach ($driver_data1 as $row) {
		            		//echo $row['student_id'].": ".$row['name']."<br>";
		            		if ($row['student_id'] == $student_id) {
		            			$student_name = $row['name'];
		            			return $student_name;
		            		}
		            }
		    }

    }


function add_misbehaviour(){

	//For Listing student name in the add field
	    $this->load->model('TransportModel');
	    $arr1['student_list'] = array();
        $arr2['student_list'] = array();

        $date=$this->input->post('date');
	$date = date("Y-m-d", strtotime($date));
        $bus_id=$this->input->post('select_bus');
        $student_id=$this->input->post('select_student');
		$details=$this->input->post('details');
        $student_name = $this->getStudentList($student_id);
       
		$this->load->model('TransportModel');///date/2015-3-12/bus_id/1/student_id/1/name/thouseef/details/misbehaving
		$dataDetails = $this->TransportModel->send_misbehaviour($date, $bus_id, $student_id, $student_name ,$details);
		if($dataDetails['responsecode'] == 1){
			echo "<script type='text/javascript'>alert('successfully added');</script>";
		}
			else{
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.Try again.');</script>";
			}
		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/student_misbehaviour','refresh');
	}


public function route_distance_id(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');
		$data = $this->TransportModel->get_Route();
        $arr['h'] = array();
        $arr['names'] = array();
        $arr['toroute']=array();
        array_push($arr['toroute'],'');
        array_push($arr['toroute'],'');

        if($data['responsecode']==1){
		$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
	    		array_push($arr['h'],$row['route_name'] );
	    		

			}
		}
		$this->load->view('route_distance_view',$arr);
		}else{
	         redirect('welcome');
        }
	}


	/*public function accidents(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');
		

        $arr['incident'] = array();
        //$vehicle_name = array();
        $arr1['incident'] = array();
        $arr1['driver_list'] = array();
        $arr1['bus_list'] = array();
        $arr2['bus_list'] = array();
        $edit_delete_count=0;

//For Listing bus name in the add field
  	    $bus_data = $this->TransportModel->get_bus_list();
		   if ($bus_data['responsecode']==1) {
		        $bus_data1=$bus_data['result_arr'];
		            foreach ($bus_data1 as $row) {
		            		array_push($arr2['bus_list'], $row['bus_Id'], $row['name']);
		            		array_push($arr1['bus_list'], $arr2['bus_list']);
		            		unset($arr2);
        		            	$arr2['bus_list'] = array();
        		           
		            }
		    }

//////////
          $arr2['driver_list']=array();
//For Listing driver name in the add field
        $driver_data = $this->TransportModel->get_driver_list();
		    if ($driver_data['responsecode']==1) {
		        $driver_data1=$driver_data['result_arr'];
		            foreach ($driver_data1 as $row) {
		            		array_push($arr2['driver_list'], $row['driver_id'], $row['name']);
		            		array_push($arr1['driver_list'], $arr2['driver_list']);
		            		unset($arr2);
        		            $arr2['driver_list'] = array();
        		            
		            }
		    }
        $data = $this->TransportModel->get_accident_Details();
        if($data['responsecode']==1){
		$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
 
				 array_push($arr['incident'], $row['date'], $row['details'], $row['report_upload'], $row['bus_name'], $row['driver_name'], $row['fine_amount'], $row['status'], $row['document_upload'], $edit_delete_count);

				 $edit_delete_count++;
        		array_push($arr1['incident'], $arr['incident']);
        		unset($arr);
        		$arr['incident'] = array();
        		}
        		
		}

		$this->load->view('accident_view',$arr1);
		}else{
	         redirect('welcome');
        }
	}
*/
	/*public function accidents(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');
		

        $arr['incident'] = array();
        //$vehicle_name = array();
        $arr1['incident'] = array();
        $arr1['driver_list'] = array();
        $arr1['bus_list'] = array();
        $arr2['bus_list'] = array();
        $edit_delete_count=0;

//For Listing bus name in the add field
  	    $bus_data = $this->TransportModel->get_bus_list();
		   if ($bus_data['responsecode']==1) {
		        $bus_data1=$bus_data['result_arr'];
		            foreach ($bus_data1 as $row) {
		            		array_push($arr2['bus_list'], $row['bus_Id'], $row['name']);
		            		array_push($arr1['bus_list'], $arr2['bus_list']);
		            		unset($arr2);
        		            	$arr2['bus_list'] = array();
        		           
		            }
		    }

//////////
          $arr2['driver_list']=array();
//For Listing driver name in the add field
        $driver_data = $this->TransportModel->get_driver_list();
		    if ($driver_data['responsecode']==1) {
		        $driver_data1=$driver_data['result_arr'];
		            foreach ($driver_data1 as $row) {
		            		array_push($arr2['driver_list'], $row['driver_id'], $row['name']);
		            		array_push($arr1['driver_list'], $arr2['driver_list']);
		            		unset($arr2);
        		            $arr2['driver_list'] = array();
        		            
		            }
		    }
        $data = $this->TransportModel->get_accident_Details();
        if($data['responsecode']==1){
		$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
 
				 array_push($arr['incident'], $row['date'], $row['details'], $row['report_upload'], $row['bus_name'], $row['driver_name'], $row['fine_amount'], $row['status'], $row['document_upload'], $edit_delete_count);

				 $edit_delete_count++;
        		array_push($arr1['incident'], $arr['incident']);
        		unset($arr);
        		$arr['incident'] = array();
        		}
        		
		}

		$this->load->view('accident_view',$arr1);
		}else{
	         redirect('welcome');
        }
	}*/

	public function edit_incident_data(){
		echo "<script type='text/javascript'>alert('updated successfully');</script>";
		redirect(base_url() . 'index.php/Welcome/accidents', 'refresh');
	}


	function add_incident(){
		/* $data['file_name']="null";
		$config['upload_path'] = './uploads/accident/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile')){
			$error = $this->upload->display_errors();
		}else{
			$data = $this->upload->data();
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/accident/'.$data['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {	
			}
			$data['file_name'] = str_replace(" ","_",$data['file_name']);
			$data['file_name'] = str_replace("&","_",$data['file_name']);
		} */

		//updalod file by API
		$files = $_FILES['userfile'];
		$_FILES['userfile']['name']     = $files['name'];
		$_FILES['userfile']['type']     = $files['type'];
		$_FILES['userfile']['tmp_name'] = $files['tmp_name'];
		$_FILES['userfile']['size']     = $files['size'];
		
		$path='Upload/uploadsAccidentReport';
		$fileResponse=$this->TransportModel->upload_file_api($path,$_FILES['userfile']['tmp_name'],$_FILES['userfile']['type'],$_FILES['userfile']['name']);
		if($fileResponse){
			$data['file_name']=$fileResponse;
		}else{
			$data['file_name']=NULL;
		}
		
		// print_r($data);
		
		
		/* $data1['file_name']="null";
        $config['upload_path'] = './uploads/accident/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('document_upload')){
			$error = $this->upload->display_errors();
		}else{
			$data1 = $this->upload->data();
			$this->load->library('image_lib');
			$w_config['image_library']    = 'gd2';
			$w_config['source_image']     = './uploads/accident/'.$data1['file_name'];
			$w_config['wm_opacity']       = 50;
			$w_config['wm_vrt_alignment'] = 'bottom';
			$w_config['wm_hor_alignment'] = 'right';
			$w_config['wm_hor_offset'] = '10';
			$w_config['wm_vrt_offset'] = '10';
			$this->image_lib->initialize($w_config);
			if (!$this->image_lib->watermark()) {
			}
			$data1['file_name'] = str_replace(" ","_",$data1['file_name']);
			$data1['file_name'] = str_replace("&","_",$data1['file_name']);
		} */
		
		//updalod file by API
		$files = $_FILES['document_upload'];
		$_FILES['document_upload']['name']     = $files['name'];
		$_FILES['document_upload']['type']     = $files['type'];
		$_FILES['document_upload']['tmp_name'] = $files['tmp_name'];
		$_FILES['document_upload']['size']     = $files['size'];
		
		$path='Upload/uploadsAccidentReport';
		$fileResponse=$this->TransportModel->upload_file_api($path,$_FILES['document_upload']['tmp_name'],$_FILES['document_upload']['type'],$_FILES['document_upload']['name']);
		if($fileResponse){
			$data1['file_name']=$fileResponse;
		}else{
			$data1['file_name']=NULL;
		}

		//print_r($data1);
		$incident_date=$this->input->post('incident_date');
		$incident_date=date("Y-m-d",strtotime($incident_date));
		
        	$incident_details=$this->input->post('incident_details');
		if($incident_details==NULL){$incident_details="null";}
        	$driver_id=$this->input->post('incident_driver');
		$bus_id=$this->input->post('incident_bus');
        	$fine_amount=$this->input->post('fine_amt');
        	$status=$this->input->post('status');
        
		//$this->load->model('TransportModel');
		$dataDetails = $this->TransportModel->send_incident($incident_date,  $driver_id, $bus_id, $incident_details, $data['file_name'], $fine_amount, $status, $data1['file_name']);
		if($dataDetails['responsecode'] == 1){
			echo "<script type='text/javascript'>alert('successfully added');</script>";
		}
			else{
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.Try again.');</script>";
			}
		//redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/accidents','refresh');
	}

	 function manageaccident_download($file_name){
        /* $this->load->helper('download');
        $data = file_get_contents("uploads/accident/" . $file_name);
        $name = $file_name;
        force_download($name, $data); */
		
		
		$config = file_get_contents("Assets/configuration.txt");
        $path= str_replace("index.php?web_services/","uploads/",$config);
		
        $this->load->helper('download');
        $data = file_get_contents($path."accident/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
    }


/*	public function fuel_management(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');

        $arr['petty_cash'] = array();
        $arr1['petty_cash'] = array();
        $arr1['driver_list'] = array();
        $arr2['driver_list'] = array();
        $edit_delete_count=0;
        
//For Listing driver name in the add field
        $driver_data = $this->TransportModel->get_driver_list();
		    if ($driver_data['responsecode']==1) {
		        $driver_data1=$driver_data['result_arr'];
		            foreach ($driver_data1 as $row) {
		            		array_push($arr2['driver_list'], $row['driver_id'], $row['name']);

		            		array_push($arr1['driver_list'], $arr2['driver_list']);
		            		unset($arr2);
        		            $arr2['driver_list'] = array();
		            }
		    }

        $data = $this->TransportModel->get_pettycash_details();

        if($data['responsecode']==1){
		$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
                
                foreach ($row as $key => $value) {
                	if ($key == "driver_id") {
                		$name = "--";
		              if ($key == "driver_id") {
		            	$driver_data = $this->TransportModel->get_driver_list();
		              
		                if ($driver_data['responsecode']==1) {
		            	$driver_data1=$driver_data['result_arr'];
		            	    foreach ($driver_data1 as $row) {
		            		    if ($row['driver_id'] == $value) {
		            			    $name = $row['name'];
		            		    }
		            	    }
		                }
		              }
		              array_push($arr['petty_cash'], $name);
        		    }
        		    else if($key == "date" or $key== "amount_given" or $key== "amount_spend" or $key == "balance"){
        			    array_push($arr['petty_cash'], $value);
        		    }
                }

                array_push($arr['petty_cash'],$edit_delete_count);
     		    $edit_delete_count++;
        		array_push($arr1['petty_cash'],$arr['petty_cash']);
        		    unset($arr);
        		    $arr['petty_cash'] = array();
        		    unset($name);
			}
			
		}

		$this->load->view('fuel_payments_view',$arr1);
		}else{
	         redirect('welcome');
        }
	}
*/
	/*public function add_pettycash(){
	
		$date = $this->input->post('date');
		$date = date("Y-m-d", strtotime($date));
        	$driver_id = $this->input->post('select_driver');
        	$amount = $this->input->post('amount');
	
		//For Listing student name in the add field
       
		$this->load->model('TransportModel');
		$dataDetails = $this->TransportModel->send_pettycash($date, $driver_id, $amount);
		if($dataDetails['responsecode'] == 1){
			echo "<script type='text/javascript'>alert('successfully added');</script>";
		}
			else{
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.Try again.');</script>";
			}
		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/fuel_management','refresh');
	}
	*/

	//Adding petty cash rows
	public function fuel_management(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');

        $arr['petty_cash'] = array();
        $arr1['petty_cash'] = array();
        $arr['driver_list'] = array();
        
//For Listing driver name in the add field
     
		$data = $this->TransportModel->get_driver_list();

        if($data['responsecode']==1){
		    $data1=$data['result_arr'];
		    foreach ($data1 as $row) {
		    	array_push($arr['driver_list'], $row);
		    }
 
		}
//For Listing petty data

        $data = $this->TransportModel->get_pettycash_details();

        if($data['responsecode']==1){
		$data1=$data['result_arr'];
 
		    foreach ($data1 as $row) {
		    	array_push($arr['petty_cash'], $row);
		    }

		}

		//print_r($arr);

		$this->load->view('fuel_payments_view',$arr);
		}else{
	         redirect('welcome');
        }

	}

	public function fuel_ajax(){

		$startdate=$this->input->post('datepicker1');
 		$startdate=date("Y-m-d",strtotime($startdate));
 		$enddate=$this->input->post('date1');
 		$enddate=date("Y-m-d",strtotime($enddate));
 		$driver_id = $this->input->post('driver');
		
		$this->load->model('TransportModel');

        $arr['petty_cash'] = array();
        $arr1['petty_cash'] = array();
        $arr['driver_list'] = array();
        $arr2['driver_list'] = array();
        
        /*$startdate = "2017-02-01";
        $enddate = "2017-03-30";
        $driver_id = "68";*/
        
//For Listing driver name in the add field
        $driver_data = $this->TransportModel->get_driver_list();
		    if ($driver_data['responsecode']==1) {
		        $driver_data1=$driver_data['result_arr'];
		            foreach ($driver_data1 as $row) {
		            		array_push($arr2['driver_list'], $row['driver_id'], $row['name']);

		            		array_push($arr['driver_list'], $arr2['driver_list']);
		            		unset($arr2);
        		            $arr2['driver_list'] = array();
		            }
		    }

        $data = $this->TransportModel->get_pettycash_details($startdate, $enddate, $driver_id);

        if($data['responsecode']==1){
		    
            $data1=$data['result_arr'];
		    foreach ($data1 as $row) {
		    $data_sum = $row['id'].$row['driver_id'].date("Y-m-d",strtotime($row['date']));

$id = '<button class="btn btn-warning" onclick="edit_petty('.$row['id'].')"><i class="glyphicon glyphicon-pencil"></i></button>  <button class="btn btn-danger" onclick="delete_petty('.$row['id'].')"><i class="glyphicon glyphicon-remove"></i></button>';

		    	array_push($arr['petty_cash'], $row + array('btn' => $id));

		    }

		}else{
			array_push($arr['petty_cash'], array('msg' => 'nodata'));
		}
       
		echo json_encode($arr['petty_cash']);

	}

	public function petty_add(){

		$date = $this->input->post('datepicker');
		$date = date("Y-m-d", strtotime($date));
        $driver_id = $this->input->post('select_driver');
        $amount = $this->input->post('amount');

        $this->load->model('TransportModel');
		$dataDetails = $this->TransportModel->send_pettycash($date, $driver_id, $amount);
		if($dataDetails['responsecode'] == 1){
			echo json_encode($dataDetails);
		}

	}
//http://al-amaanah.com/Schoooly/index.php?web_services/PettyCash_api/editPettyCash/date/2017-01-02/driver_id/1/amount_given/220/amount_spend/200/balance/20/invoice_doc/filename.pdf/pc_id/1/amount_for/fuel
	public function petty_edit($id){

        $this->load->model('TransportModel');
		$data = $this->TransportModel->get_pettycash_edit($id);
        if($data['responsecode']== 1){

		    $petty_edit_data = $data['result_arr'];

	    }

	    echo json_encode($petty_edit_data[0]);
	}


	/*public function upload_invoice() {
 
        //upload fil
        $config['upload_path'] = 'uploads/petty_cash';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '1024'; //1 MB
 
        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : uploads/petty_cash' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {
                        //echo 'File successfully uploaded : uploads/petty_cash' . $_FILES['file']['name'];
                    }
                }
            }
        } else {
            echo 'Please choose a file';
        }

    }*/

    public function upload_invoice() {
 
        /* //upload fil
        $config['upload_path'] = 'uploads/petty_cash';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        //$config['encrypt_name'] = TRUE;
        //$config['max_size'] = '1024'; //1 MB
 
        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : uploads/petty_cash' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {

                    	$upload_data=$this->upload->data();
                    	echo $upload_data['file_name'];
                                                //echo 'File successfully uploaded : uploads/petty_cash' . $_FILES['file']['name'];
                       // echo json_encode($this->upload->data());
                    }
                }
            }
        } else {
            echo 'Please choose a file';
        } */
		
		//updalod file by API
		$files = $_FILES['file'];
		$_FILES['file']['name']     = $files['name'];
		$_FILES['file']['type']     = $files['type'];
		$_FILES['file']['tmp_name'] = $files['tmp_name'];
		$_FILES['file']['size']     = $files['size'];
		
		$path='Upload/uploadsPettyCash';
		$fileResponse=$this->TransportModel->upload_file_api($path,$_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']);
		if($fileResponse){
			echo 'File successfully uploaded : '.$fileResponse;
		}else{
			echo 'Failed to upload';
		}

    }

	public function petty_update(){
        
        //$z = $this->input->post('z');
        $files = NULL;
        for ($i=1; $i <=100 ; $i++) { 
        	$file = $this->input->post('file'.$i);
        	if ($file != NULL) {
        		$files .= $file.'~';
        	}
        }
        //$i = 1;
        //$file = $this->input->post('file'.$i);
        //$files = $file.'~';
        $invoice_doc = $this->input->post('invoice_docs');
        
        if ($invoice_doc == null) {
        	$files = substr($files, 0, -1);
        }
        $invoice_doc = $files.$invoice_doc;
        $pc_id = $this->input->post('pc_id');
        $driver_id = $this->input->post('driver_id');
        $date = $this->input->post('date');
        $date = date("Y-m-d", strtotime($date));
        $driver_name = $this->input->post('driver_name');
        $amount_given = $this->input->post('amount_given');
        $amount_spend = $this->input->post('amount_spend');
        $balance = $amount_given - $amount_spend;

        $this->load->model('TransportModel');
		$status = $this->TransportModel->update_petty($date,$driver_id,$amount_given,$amount_spend,$balance,$invoice_doc,$pc_id);
		//$status = $response['responsecode'];

		if($status['responsecode'] == 1){
			//echo json_encode(array("file" => $file));
			echo json_encode(1);
		}

		/*$this->book_model->book_update(array('book_id' => $this->input->post('book_id')), $data);
		echo json_encode(array("status" => TRUE));*/
	}


    public function petty_delete($pc_id){
        
        $this->load->model('TransportModel');

        $status = $this->TransportModel->delete_petty($pc_id);

        if($status['responsecode'] == 1){
			echo json_encode(array("status" => TRUE));
		}

    }


	function petty_invoive_download($file_name){
        /* $this->load->helper('download');
        $data = file_get_contents("uploads/petty_cash/" . $file_name);
        $name = $file_name;
        force_download($name, $data); */
		
		$config = file_get_contents("Assets/configuration.txt");
        $path= str_replace("index.php?web_services/","uploads/",$config);
		
        $this->load->helper('download');
        $data = file_get_contents($path."petty_cash/" .$file_name);
        $name = $file_name;
        force_download($name, $data);
    }
	
	public function delete_accident_record(){
		$this->load->model('TransportModel');	
    		$x=$this->input->post('ID');
		$data = $this->TransportModel->get_accident_Details();
		$count=0;
		if($data['responsecode']==1){
			$data1=$data['result_arr'];
			foreach ($data1 as $row){
				if($x==$count){
					$x=$row['incident_id'];break;
				}
					$count++;
			}
	}
	
    	$data = $this->TransportModel->delete_accident_details($x);
    	if($data['responsecode']!=1){
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.please try again.');</script>";
    	}
		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/accidents','refresh');
		}
		
	public function delete_fuel_payments(){
		$this->load->model('TransportModel');	
    		$x=$this->input->post('ID');
		$data = $this->TransportModel->get_pettycash_details();
		$count=0;
		if($data['responsecode']==1){
			$data1=$data['result_arr'];
			foreach ($data1 as $row){
				if($x==$count){
					$x=$row['id'];break;
				}
					$count++;
			}
	}
	
    	$data = $this->TransportModel->delete_petty_cash_details($x);
    	if($data['responsecode']!=1){
			echo "<script type='text/javascript'>alert('Sorry!!something wrong.please try again.');</script>";
    	}
		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/fuel_management','refresh');
	}

		public function route_distance(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');
		$data = $this->TransportModel->get_Route_Details();
	    	$data1 = $this->TransportModel->get_Route();
		$arr1['h'] = array();
        	$arr['names'] = array();
        	$arr['toroute']=array();
        	array_push($arr['toroute'],'');
        array_push($arr['toroute'],'');

        if($data1['responsecode']==1){
		$data2=$data1['result_arr'];
        	foreach ($data2 as $row) {
	    		array_push($arr1['h'],$row['route_name'] );
	    		

			}
		}
		$arr1['distance'] = array();
        $arr['distance'] = array();
      //  $arr['names'] = array();
       // $arr['toroute']=array();
      //  array_push($arr['toroute'],'');
        //array_push($arr['toroute'],'');
        $routename = $this->input->post('routename');

        if($data['responsecode']==1){
		$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
	    		
	    		if ($row['route_name'] === $routename) {
	    			array_push($arr['distance'], $row['route_name'], $row['trip_type'], $row['bus_name'], $row['stop_count'], $row['route_distance'] );
	    		}
	    		array_push($arr1['distance'],$arr['distance']);
        		unset($arr);
        		$arr['distance'] = array();
			}
		}
		$this->load->view('route_distance_view',$arr1);
		}else{
	         redirect('welcome');
        }
	}


	public function vehicle_distance_name(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');
		$data = $this->TransportModel->get_vehicle_Details();

        $arr['vehicle_name'] = array();
        $vehicle_name = array();
        $arr1['vehicle_name'] = array();

        if($data['responsecode']==1){
		$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
        		array_push($arr['vehicle_name'], $row['bus_Id'], $row['name']);

        		array_push($arr1['vehicle_name'],$arr['vehicle_name']);
        		    unset($arr);
        		    $arr['vehicle_name'] = array();
			}
			
		}

		$this->load->view('vehicle_distance_view',$arr1);
		}else{
	         redirect('welcome');
        }
	}

	public function vehicle_distance(){
		 if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){

    if($this->input->post('startdate')!=''){
 		$startdate=$this->input->post('startdate');
 		$startdate=date("Y-m-d",strtotime($startdate));
 		$enddate=$this->input->post('enddate');
 		$enddate=date("Y-m-d",strtotime($enddate));
 		$busid=$this->input->post('busname');

 	    $arr['vehicle'] = array();
 	    $arr1['vehicle'] = array();
 	    $arr2['vehicle_name'] = array();
 	    $arr1['vehicle_name'] = array();
 			$this->load->model('TransportModel');
 	        $data_report = $this->TransportModel->vehicle_data($busid,$startdate,$enddate);
 	        ///
 	     $data = $this->TransportModel->get_vehicle_Details();
        if($data['responsecode']==1){
		$data1=$data['result_arr'];
        	foreach ($data1 as $row) {
        		array_push($arr2['vehicle_name'], $row['bus_Id'], $row['name']);

        		array_push($arr1['vehicle_name'],$arr2['vehicle_name']);
        		    unset($arr2);
        		    $arr2['vehicle_name'] = array();
			}
			
		}
 	        ///

			if($data_report['responsecode']===1){
		 	  $data=$data_report['result_arr'];
        		foreach ($data as $row) {
                        array_push($arr['vehicle'],$row['date'] );
        		        array_push($arr['vehicle'],$row['bus_id'] );
	    			    array_push($arr['vehicle'],$row['name'] );
	    			    array_push($arr['vehicle'],$row['plate_number'] );
	    			    array_push($arr['vehicle'],$row['bus_distance'] );
                        
        			
        			array_push($arr1['vehicle'],$arr['vehicle']);
        			unset($arr);
        			$arr['vehicle'] = array();
  
        		}

        	}else{
        
    			echo "<script type='text/javascript'>alert('Sorry!! No data found.');</script>";
    		}

    	}     
 	$this->load->view('vehicle_distance_view',$arr1);
 }else{
 	redirect('Welcome');
 }
	}


//arrival_departure

	public function arrival_departure(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		$this->load->model('TransportModel');

        $arr['bus_list'] = array();

		$data = $this->TransportModel->get_bus_list();

        if($data['responsecode']==1){
		    $data1=$data['result_arr'];
		    foreach ($data1 as $row) {
		    	array_push($arr['bus_list'], $row);
		    }
 
		}

		$this->load->view('arrival_departure_view',$arr);

		}else{
	         redirect('welcome');
        }

	}

	//arrival_departure_ajax

	public function arrival_departure_ajax(){

		$startdate=$this->input->post('datepicker1');
 		$startdate=date("Y-m-d",strtotime($startdate));
 		$enddate=$this->input->post('date1');
 		$enddate=date("Y-m-d",strtotime($enddate));
 		$bus_id = $this->input->post('bus');
		
        $this->load->model('TransportModel');
        $data = $this->TransportModel->get_arrival_departure_data($bus_id, $startdate, $enddate);
        $arr['arrival_departure'] = array();

        if($data['responsecode']==1){
		    
            $data1=$data['result_arr'];
		    foreach ($data1 as $row) {
		    	array_push($arr['arrival_departure'], $row);
		    }

		}else{
			array_push($arr['arrival_departure'], array('msg' => 'nodata'));
		}
       
		echo json_encode($arr['arrival_departure']);

	}

//Listing incidents
	public function accidents_ajax(){
		$this->load->model('TransportModel');
        $arr['accidents'] = array();
        $data = $this->TransportModel->get_accident_Details();
		if($data['responsecode']==1){
		    $data1=$data['result_arr'];
 
		    foreach ($data1 as $row) {
				$button = '<button class="btn btn-warning" onclick="edit_petty('.$row['incident_id'].')"><i class="glyphicon glyphicon-pencil"></i></button>  <button class="btn btn-danger" onclick="delete_petty('.$row['incident_id'].')"><i class="glyphicon glyphicon-remove"></i></button>';
				array_push($arr['accidents'], $row + array('btn' => $button));
			}
		}

		echo json_encode($arr['accidents']);
	}

	//Accident view

	//Edit accident

  public function accident_edit($id){

        $this->load->model('TransportModel');
		$data = $this->TransportModel->get_incident_edit($id);
        if($data['responsecode']== 1){

		    $incident_data = $data['result_arr'];

	    }

	    echo json_encode($incident_data[0]);
	}

        //Bus name and driver name
    public function get_bus_name($bus_id){
        $bus_name;
    	$this->load->model('TransportModel');
    	        $bus_data = $this->TransportModel->get_bus_list();
		    if ($bus_data['responsecode']==1) {
		        $bus_data1=$bus_data['result_arr'];
		            foreach ($bus_data1 as $row) {
		            		//echo $row['student_id'].": ".$row['name']."<br>";
		            		if ($row['bus_Id'] == $bus_id) {
		            			$bus_name = $row['name'];
		            			return $bus_name;
		            		}
		            }
		    }

    }

    public function get_driver_name($driver_id){
        $driver_name;
    	$this->load->model('TransportModel');
    	        $driver_data = $this->TransportModel->get_driver_list();
		    if ($driver_data['responsecode']==1) {
		        $driver_data1=$driver_data['result_arr'];
		            foreach ($driver_data1 as $row) {
		            		//echo $row['student_id'].": ".$row['name']."<br>";
		            		if ($row['driver_id'] == $driver_id) {
		            			$driver_name = $row['name'];
		            			return $driver_name;
		            		}
		            }
		    }

    }

   
	//Uploading incidents related documents

	public function upload_accidents() {
/* 		//upload fil
        $config['upload_path'] = 'uploads/accident';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '1024'; //1 MB
 
        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : uploads/accident' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {
                        echo 'File successfully uploaded : uploads/accident' . $_FILES['file']['name'];
                    }
                }
            }
        } else {
            echo 'Please choose a file';
        }
 */
 		//updalod file by API
		$files = $_FILES['userfile'];
		$_FILES['userfile']['name']     = $files['name'];
		$_FILES['userfile']['type']     = $files['type'];
		$_FILES['userfile']['tmp_name'] = $files['tmp_name'];
		$_FILES['userfile']['size']     = $files['size'];
		
		$path='Upload/uploadsAccidentReport';
		$fileResponse=$this->TransportModel->upload_file_api($path,$_FILES['userfile']['tmp_name'],$_FILES['userfile']['type'],$_FILES['userfile']['name']);
		if($fileResponse){
			echo 'File successfully uploaded : '.$fileResponse;
		}else{
			echo 'Failed to upload';
		}
    }

   // Leave management functions 

    public function leave_pending(){

    	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
    			$this->load->model('TransportModel');
    	$arr['bus_list'] = array();
        $data = $this->TransportModel->get_bus_list();
        if($data['responsecode']==1){
		    $data1=$data['result_arr'];
		    foreach ($data1 as $row) {
		    	array_push($arr['bus_list'], $row);
		    }
		}

    	$this->load->view('leave_pending_view', $arr);
    	}else{
    		redirect('welcome');
    	}

    	
    }

    public function pending_leave_data(){

    	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
    		$this->load->model('TransportModel');
    		$par = $this->input->post('param0');
        	$arr['pending_data'] = array();
        	$data = $this->TransportModel->get_pending_data($par);
		        if($data['responsecode']==1){
				    $data1=$data['result_arr'];
				    foreach ($data1 as $row) {
		                if ($row['status'] == 1) {
		                	$button = '<div class="btn-group" style="overflow:visible"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu" ><li><a href="#" onclick="changeStatus('.$row['id'].', 2);">Approve</a></li><li><a href="#" onclick="changeStatus('.$row['id'].', 3);">Reject</a></li></ul></div>';
				    	     array_push($arr['pending_data'], $row + array('btn' => $button));
		                }
				    }

				}else{
					array_push($arr['pending_data'], array('response' => 'nodata'));
				}

		echo json_encode($arr['pending_data']);

    	}else{
    		redirect('welcome');
    	}
		
		

	}

	public function change_leave_status(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
				$leave_id = $this->input->post('leave_id');
				$status_id = $this->input->post('status_id');
				$this->load->model('TransportModel');
        		$data = $this->TransportModel->update_leave_status($leave_id, $status_id);
		        if($data['responsecode']==1){
		        	echo json_encode($data);
				}
		}else{
			redirect('welcome');
		}

	}



    public function leave_confirmed(){
    	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
    			$this->load->model('TransportModel');
    	$arr['bus_list'] = array();
        $data = $this->TransportModel->get_bus_list();
        if($data['responsecode']==1){
		    $data1=$data['result_arr'];
		    foreach ($data1 as $row) {
		    	array_push($arr['bus_list'], $row);
		    }
 
		}
    	$this->load->view('leave_confirmed_view', $arr);
    	}else{
    		redirect('welcome');
    	}

        
    }

    public function confirmed_leave_data(){

    	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
    			$this->load->model('TransportModel');
		$par = $this->input->post('param0');
        $arr['confirmed_data'] = array();
        // echo "string";
        $data = $this->TransportModel->get_pending_data($par);
        if($data['responsecode']==1){
		    $data1=$data['result_arr'];
		    foreach ($data1 as $row) {
                if ($row['status'] != 1) {
		    	     array_push($arr['confirmed_data'], $row);

                }
		    }

		}else{
			array_push($arr['confirmed_data'], array('response' => 'nodata'));
		}

		echo json_encode($arr['confirmed_data']);
    	}else{
    		redirect('welcome');
    	}
		
		
	}

	public function admit_student(){

		$this->load->view('student_admit_view');
	}

	//student data insert function

	function student1($param1 = '', $param2 = '', $param3 = ''){
        /*if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');*/
        //$this->load->model('TransportModel');
        $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
        ))->row()->description;
        if ($param1 == 'create') {

            $parent_id = $this->input->post('parent_id');
        	//$data1['parent_id'] = $this->input->post('parent_id');
            $data1['email'] = $this->input->post('parentEmail');
            $data1['password'] = $this->input->post('password');
            $data1['name'] = $this->input->post('fatherName');
            $data1['father_nationality'] = $this->input->post('fatherNationality');
            $data1['profession'] = $this->input->post('profession');
            $data1['father_empr_sponsor_name'] = $this->input->post('fatherEmployer');
            $data1['father_work_address'] = $this->input->post('fatherWorkAddress');

            $data1['mother_name'] = $this->input->post('motherName');
            $data1['mother_nationality'] = $this->input->post('motherNationality');
            $data1['mother_occupation'] = $this->input->post('motherOccupation');
            $data1['mother_empr_sponsor_name'] = $this->input->post('motherEmployer');
            $data1['mother_work_address'] = $this->input->post('motherWorkAddress');
            
            if ($parent_id == null) {
            	$data1['child_count'] = 1; 
            	$this->db->insert('parent', $data1);
                $parent_id = $this->db->insert_id();
            }else{
            	$child_count = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->child_count;
            	$data1['child_count'] = $child_count + 1; 
            	$this->db->where('parent_id', $parent_id);
                $this->db->update('parent', $data1);
            }

            $data['parent_id'] = $parent_id;
        	$data['student_code'] = $this->input->post('applicationNumber');
            $data['academic_year'] = $this->input->post('academicYear');
            $data['Date_of_Registeration'] = $this->input->post('DOA');
            $data['name'] = $this->input->post('name');
            $data['photo'] = $this->input->post('studentPhoto');
			$data['DOB'] = $this->input->post('DOB');
			$data['place_of_birth'] = $this->input->post('birthPlace');
			//$data['sex'] = $this->input->post('sex');
            $data['blood_group'] = $this->input->post('bloodGroup');
		    $data['religion'] = $this->input->post('religion');
		    $data['mother_tongue'] = $this->input->post('motherTongue');
	        $data['phone'] = $this->input->post('studentMobileNumber');
	        $data['email'] = $this->input->post('studentEmail');
		    $data['last_school_attended'] = $this->input->post('LastSchoolAttended');
			$data['last_school_address'] = $this->input->post('lastSchoolAddress');
		    $data['allergies'] = $this->input->post('allergies');


           
			$data['class_id'] = $this->input->post('class_id');
			$data['class_name'] = $this->db->get_where('class' , array('class_id' => $data['class_id']))->row()->name;
			$data['section_id'] = $this->input->post('section_id');
			$data['section_name'] = $this->db->get_where('section' , array('section_id' => $data['section_id']))->row()->name;
            //$data['Admission_Type'] = $this->input->post('selectAdmissionType');
			$data['Date_of_Registeration']  = date("Y-m-d");

			//$data['Transport_Facility'] = $this->input->post('transportFacility');
            $data['assigned_bus'] = $this->input->post('assigned_bus');
			//$data['journey_type'] = $this->input->post('journeyType');
		    //$data['fee_type???'] = $this->input->post('feeType');

			$VarTransport_Facility=$this->input->post('transportFacility');
			if($VarTransport_Facility == 'yes'){
				$data['Transport_Facility']  = '1';
			}else{
				$data['Transport_Facility']  = '2';
			}

			$journeyType = $this->input->post('journeyType');
			if($journeyType == 'oneWay'){
				$data['journey_type']  = '1';
			}else{
				$data['journey_type']  = '2';
			}

			$tripType = $this->input->post('tripType');
			if($tripType == 'pickup'){
				$data['journey_trip']  = '1';
			}else{
				$data['journey_trip']  = '2';
			}

			$VarAdmission_Type=$this->input->post('selectAdmissionType');
			if($VarAdmission_Type == 'normal'){
				$data['Admission_Type']  = '1';
			}else{
				$data['Admission_Type']  = '2';
			}

			$VarSex=$this->input->post('sex');
			
			if($VarSex == 'male'){
				$data['sex']  = 'M';
			}else{
				$data['sex']  = 'F';
			}
			
			
			$data['Student_Status']  = '1';
			//$data['assigned_bus']      = $this->input->post('assigned_bus');
			//uploading file using codeigniter upload library
			$files = $_FILES['userfile'];
			$this->load->library('upload');
			$config['upload_path']   =  'uploads/student_image/';
			$config['allowed_types'] =  '*';
			$_FILES['userfile']['name']     = $files['name'];
			$_FILES['userfile']['type']     = $files['type'];
			$_FILES['userfile']['tmp_name'] = $files['tmp_name'];
			$_FILES['userfile']['size']     = $files['size'];
			$this->upload->initialize($config);
			$this->upload->do_upload('userfile');
			$upload_data = $this->upload->data();
			$data['photo']  = $upload_data['file_name'];
			//$_FILES['userfile']['name'];

			$data['father_email'] = $this->input->post('fatherEmail');
            $data['mother_email'] = $this->input->post('motherEmail');
            $data['Father_Primary_Mobile'] = $this->input->post('fatherPrimaryMobile');
            $data['Father_Secondary_Mobile'] = $this->input->post('fatherSeconaryMobile');
            $data['Mother_Primary_Mobile'] = $this->input->post('motherPrimaryMobile');
			$data['Mother_Secondary_Mobile'] = $this->input->post('motherSecondaryMobile');
			$data['Home_Landline'] = $this->input->post('homeLandline');
			$data['father_office_landline'] = $this->input->post('fatherOfficeLandline');
			$data['mother_office_landline'] = $this->input->post('motherOfficeLandline');
			$data['Emer_Contact_Person_Name_Primary'] = $this->input->post('emergencyContactPersonNamePrimary');
		    $data['Emer_Contact_Person_Name_Secondary'] = $this->input->post('emergencyContactPersonNameSecondary');
            $data['Emer_Contact_Person_Number_Primary'] = $this->input->post('emergencyContactPersonMobilePrimary');
            $data['Emer_Contact_Person_Number_Secondary'] = $this->input->post('emergencyContactPersonMobileSecondary');

            $data['Street_Name'] = $this->input->post('streetName');
            $data['Area'] = $this->input->post('areaName');
            $data['pincode'] = $this->input->post('pinCode');
            $data['Landmark'] = $this->input->post('landmarkName');
			$data['Latitude'] = $this->input->post('latitude');
		    $data['Longitude'] = $this->input->post('longitude');
		
		    /*$data['Transport_Facility'] = $this->input->post('transportFacility');
            $data['assigned_bus'] = $this->input->post('assigned_bus');
			$data['journey_type'] = $this->input->post('journeyType');
		    $data['fee_type???'] = $this->input->post('feeType');*/

			$this->db->insert('student', $data);
            $student_id = $this->db->insert_id();


            $data2['student_id']     = $student_id;
            $data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
            $data2['class_id']       = $this->input->post('class_id');
            if ($this->input->post('section_id') != '') {
                $data2['section_id'] = $this->input->post('section_id');
            }
            
            $data2['roll']           = $this->input->post('applicationNumber');
            $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
            $data2['year']           = $running_year;
            
			$this->db->insert('enroll', $data2);
		
            $this->session->set_flashdata('flash_message' , 'data_added_successfully');
            
			redirect(site_url() . '/Welcome/admit_student/', 'refresh');
        }	

		
    }

    //parent data by id
    function get_parent($parent_id){
        $query = $this->db->get_where('parent', array('parent_id' => $parent_id))->result_array();
        //echo json_encode($ar, JSON_FORCE_OBJECT);
        echo json_encode($query, JSON_FORCE_OBJECT);

    }

    //ajax fee
    function get_class_wise_fee($class_id)
    {

        $fee_amount = $this->db->get_where('fees_details' , array('class_id' => $class_id, 'type' => 1))->row()->fees_amount;
		
		echo json_encode(array('fee_amount'=>$fee_amount));
    }


    function get_class_section($class_id)
    {
        $sections = $this->db->get_where('section' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }

    //For adding student documents

    function student($param1 = '', $param2 = '', $param3 = '')
    {
        /*if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');*/
        $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
        ))->row()->description;
        
		
		//add_student_documents

		if ($param1 == 'add_document') {
            $updata['student_id'] = $this->input->post('student_id');
			
			
		//uploading file using codeigniter upload library  
		   $this->load->library('upload');
		   $config['upload_path']   =  'uploads/student_document/';
		   $config['allowed_types'] =  '*';  
		   $this->upload->initialize($config);
		   
		   if($this->upload->do_upload('iqama_copy')){
			$upload_data = $this->upload->data();
			$updata['iqama_copy'] = $upload_data['file_name'];
			$updata['iqama_issue_date']           = $this->input->post('child_iqama_issue');
			$updata['child_iqama_expiry']           = $this->input->post('child_iqama_expiry');
			$updata['iqama_place_of_issue']           = $this->input->post('child_iqama_issue_place');
		   }
		   if($this->upload->do_upload('child_passport_copy')){
			$upload_data = $this->upload->data();
			$updata['child_passport_copy'] = $upload_data['file_name'];
			$updata['child_passport_issue_date']           = $this->input->post('child_passport_issue');
			$updata['child_passport_expiry']           = $this->input->post('child_passport_expiry');
			$updata['child_passport_issue_place']           = $this->input->post('child_passport_issue_place');
		   }
		   if($this->upload->do_upload('father_iqama_copy')){
			$upload_data = $this->upload->data();
			$updata['father_iqama_copy'] = $upload_data['file_name'];
			$updata['father_iqama_issue_date']   = $this->input->post('father_iqama_issue_date');
			$updata['father_iqama_expiry']   = $this->input->post('father_iqama_expiry');
			$updata['father_iqama_issue_place']   = $this->input->post('father_iqama_issue_place');
			
		   }
		   if($this->upload->do_upload('mother_iqama_copy')){
			$upload_data = $this->upload->data();
			$updata['mother_iqama_copy'] = $upload_data['file_name'];
			$updata['mother_iqama_issue_date']           = $this->input->post('mother_iqama_issue_date');
			$updata['mother_iqama_expiry']           = $this->input->post('mother_iqama_expiry');
			$updata['mother_iqama_issue_place']           = $this->input->post('mother_iqama_issue_place');
		   }
		   
		   if($this->upload->do_upload('father_passport_copy')){
			$upload_data = $this->upload->data();
			$updata['father_passport_copy'] = $upload_data['file_name'];
			$updata['father_passport_issue_date']           = $this->input->post('father_passport_issue_date');
			$updata['father_passport_expiry']           = $this->input->post('father_passport_expiry');
			$updata['father_passport_issue_place']           = $this->input->post('father_passport_issue_place');
		   }
		   if($this->upload->do_upload('mother_passport_copy')){
			$upload_data = $this->upload->data();
			$updata['mother_passport_copy'] = $upload_data['file_name'];
			$updata['mother_passport_issue_date']           = $this->input->post('mother_passport_issue_date');
			$updata['mother_passport_expiry']           = $this->input->post('mother_passport_expiry');
			$updata['mother_passport_issue_place']           = $this->input->post('mother_passport_issue_place');
		   }
		   if($this->upload->do_upload('birth_certificate')){
			$upload_data = $this->upload->data();
			$updata['birth_certificate'] = $upload_data['file_name'];
			}
		   if($this->upload->do_upload('previous_progress_report')){
			$upload_data = $this->upload->data();
			$updata['previous_progress_report'] = $upload_data['file_name'];
			$updata['child_grade'] = $this->input->post('report_card_grade');
			
		   }
		   if($this->upload->do_upload('first_semester_report_card')){
			$upload_data = $this->upload->data();
			$updata['first_sem_report_card'] = $upload_data['file_name'];
			
		   }
		   if($this->upload->do_upload('fee_clearence_previous_school')){
			$upload_data = $this->upload->data();
			$updata['fee_clearence_previous_school'] = $upload_data['file_name'];
			
		   }
		   if($this->upload->do_upload('transfer_certificate')){
			$upload_data = $this->upload->data();
			$updata['transfer_certificate'] = $upload_data['file_name'];
			
		   }
		   if($this->upload->do_upload('signed_admission_form')){
			$upload_data = $this->upload->data();
			$updata['signed_admission_form'] = $upload_data['file_name'];
		   }
		   if($this->upload->do_upload('vaccination_copy')){
			$upload_data = $this->upload->data();
			$updata['vaccination_copy'] = $upload_data['file_name'];
		   }
		   
		   if($this->upload->do_upload('letter_from_guardian_company')){
			$upload_data = $this->upload->data();
			$updata['letter_from_guardian_company'] = $upload_data['file_name'];
		   }
		   if($this->upload->do_upload('student_photo')){
			$upload_data = $this->upload->data();
			$updata['student_photo'] = $upload_data['file_name'];
		   }
		   if($this->upload->do_upload('medical_insurance')){
			$upload_data = $this->upload->data();
			$updata['medical_insurance'] = $upload_data['file_name'];
		   }
		  
		  $this->db->insert('student_documents', $updata);
          $this->session->set_flashdata('flash_message' , 'data_added_successfully');
          redirect(site_url() . '/Welcome/admit_student/', 'refresh');
        }
		
    }

    public function get_invoices($id){

        $invoice = array();
        $i = 0;
        $this->load->model('TransportModel');
		$data = $this->TransportModel->get_pettycash_edit($id);
        if($data['responsecode']== 1){

		    $invoice_docs = $data['result_arr'];
		    $invoice_doc = $invoice_docs[0];
		    $invoice_doc1 = $invoice_doc['invoice_doc'];

	    }
	    $invoice_doc1 = explode("~",$invoice_doc1);
	    //echo $invoice_doc1;
        foreach ($invoice_doc1 as $key => $value) {
        	$i++;
        	array_push($invoice, array('invoice' => $value));
        }
        //echo json_encode(array('fee_amount'=>$fee_amount));
	    echo json_encode($invoice);
	}
     
    public function settings(){

    	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
    	
    	    $this->load->view('settings_view');
        }else{
	        redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/','refresh');
        }

    }

    public function update_settings(){

    	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){

    	
    	    $data['system_name'] = $this->input->post('system_name');
            $data['system_title'] = $this->input->post('system_title');
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['running_year'] = $this->input->post('running_year');
            $data['school_location'] = $this->input->post('school_location');
            $data['speed_limit'] = $this->input->post('speed_limit');
            $data['school_fence'] = $this->input->post('school_fence');
            if($data['system_name'] === NULL || $data['system_title'] === NULL || $data['address'] === NULL ||
            	$data['phone'] === NULL ||$data['running_year'] === NULL ||$data['school_location'] === NULL ||
            	$data['speed_limit']===NULL ||$data['school_fence']===NULL ){
            	echo "<script type='text/javascript'>alert('Sorry!! you are not allowed.');</script>";
            }else{

            	$this->db->set('description', $data['system_name'])
			    ->where('type','system_name')
			    ->update('settings');
			  $this->db->set('description', $data['system_title'])
			    ->where('type','system_title')
			    ->update('settings');
			  $this->db->set('description', $data['address'])
			    ->where('type','address')
			    ->update('settings');
			  $this->db->set('description', $data['phone'])
			    ->where('type','phone')
			    ->update('settings');
			    $this->db->set('description', $data['running_year'])
			    ->where('type','running_year')
			    ->update('settings');
			  $this->db->set('description', $data['school_location'])
			    ->where('type','school_location')
			    ->update('settings');
			  $this->db->set('description', $data['speed_limit'])
			    ->where('type','speed_limit')
			    ->update('settings');
			  $this->db->set('description', $data['school_fence'])
			    ->where('type','school_fence')
			    ->update('settings');

            echo json_encode(array('response' => 'success' ));

            }
            

        }else{
	        redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/','refresh');
        }

    }

    
    public function accidents(){//get_driver_list/get_bus_list/accident_view1

    	if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){

    		$this->load->model('TransportModel');
    	$arr['bus_list'] = array();
    	$arr['driver_list'] = array();

        $data = $this->TransportModel->get_bus_list();

        if($data['responsecode']==1){
		    $data1=$data['result_arr'];
		    foreach ($data1 as $row) {
		    	array_push($arr['bus_list'], $row);
		    }
 
		}

		$data = $this->TransportModel->get_driver_list();

        if($data['responsecode']==1){
		    $data1=$data['result_arr'];
		    foreach ($data1 as $row) {
		    	array_push($arr['driver_list'], $row);
		    }
 
		}

    	$this->load->view('accident_view1', $arr);


	    }else{
	        redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/','refresh');
        }

    }

    public function incidents_ajax(){
		
		$from_date = $this->input->post('datepicker1');
 		$from_date=date("Y-m-d",strtotime($from_date));
 		$to_date=$this->input->post('date1');
 		$to_date=date("Y-m-d",strtotime($to_date));
 		$bus_id = $this->input->post('bus');
		
		$this->load->model('TransportModel');
        $arr['accidents'] = array();
        $data = $this->TransportModel->get_incident_details($from_date, $to_date, $bus_id);

        if($data['responsecode']==1){
		    $data1=$data['result_arr'];
 
		    foreach ($data1 as $row) {
		    	$button = '<div class="btn-group" style="overflow:visible"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu" ><li><a href="#" onclick="edit_incident('.$row['incident_id'].')"><i class="glyphicon glyphicon-pencil"></i>Edit</li></a></li><li><a href="#" onclick="delete_incident('.$row['incident_id'].')"><i class="glyphicon glyphicon-trash"></i>Delete</a></li></ul></div>';

		    	array_push($arr['accidents'], $row + array('btn' => $button));

		    }

		}else{
			array_push($arr['accidents'], $row + array('response' => 'nodata'));
		}

		echo json_encode($arr['accidents']);

	}


    public function incident_add(){
        
        $file1 = $this->input->post('upload_report');
        $file2 = $this->input->post('upload_document');
           
        $incident_date = $this->input->post('incident_date');
		$incident_date = date("Y-m-d",strtotime($incident_date));
        $incident_details = $this->input->post('incident_details');
		if($incident_details == NULL){$incident_details = "null";}
        $driver_id = $this->input->post('incident_driver');
        $driver_name = $this->get_driver_name($driver_id);
        $bus_id = $this->input->post('incident_bus');
        $bus_name = $this->get_bus_name($bus_id);

        $fine_amount = $this->input->post('fine_amt');
        $status = $this->input->post('status');

        $this->load->model('TransportModel');
		$status = $this->TransportModel->send_incident($incident_date, $driver_id, $driver_name, $bus_id, $bus_name, $incident_details, $file1, $fine_amount, $status, $file2 );

		if($status['responsecode'] == 1){
			
			echo json_encode(array("status" => TRUE));
		}

		/*$this->book_model->book_update(array('book_id' => $this->input->post('book_id')), $data);
		echo json_encode(array("status" => TRUE));*/
	}

	public function upload_incidents() {
 
        /* //upload fil
        $config['upload_path'] = 'uploads/accident';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        //$config['encrypt_name'] = TRUE;
        //$config['max_size'] = '1024'; //1 MB
        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : uploads/accident' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {

                    	$upload_data=$this->upload->data();
                    	echo $upload_data['file_name'];
                                                //echo 'File successfully uploaded : uploads/petty_cash' . $_FILES['file']['name'];
                       // echo json_encode($this->upload->data());
                    }
                }
            }
        } else {
            echo 'Please choose a file';
        } */
		//updalod file by API
		
		$files = $_FILES['file'];
		$_FILES['file']['name']     = $files['name'];
		$_FILES['file']['type']     = $files['type'];
		$_FILES['file']['tmp_name'] = $files['tmp_name'];
		$_FILES['file']['size']     = $files['size'];
		
		if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
				$path='Upload/uploadsAccidentReport';
				$fileResponse=$this->TransportModel->upload_file_api($path,$_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']);
				if($fileResponse){
					echo trim($fileResponse);
				}else{
					echo "Failed to upload";
				}
				//echo 'File successfully uploaded : uploads/petty_cash' . $_FILES['file']['name'];
                // echo json_encode($this->upload->data());
            }
        } else {
            echo 'Please choose a file';
        } 
		
		

    }

    public function incident_update1(){
        
        $incident_id = $this->input->post('incident_id');
        
        $file1 = $this->input->post('upload_report');
        $file2 = $this->input->post('upload_document');
           
        $incident_date = $this->input->post('incident_date');
		$incident_date = date("Y-m-d",strtotime($incident_date));
        $incident_details = $this->input->post('incident_details');
		if($incident_details == NULL){$incident_details = "null";}
        $driver_id = $this->input->post('incident_driver');
        $driver_name = $this->get_driver_name($driver_id);
        $bus_id = $this->input->post('incident_bus');
        $bus_name = $this->get_bus_name($bus_id);

        $fine_amount = $this->input->post('fine_amt');
        $status = $this->input->post('status');

        $this->load->model('TransportModel');
     
		$status = $this->TransportModel->update_accident($incident_id,$incident_date,$driver_id,$driver_name,$bus_id,$bus_name,$incident_details,$file1,$fine_amount,$status,$file2);

		if($status['responsecode'] == 1){
			
			echo json_encode(array("status" => TRUE));
		}

	}

	public function incident_delete($id){
		$this->load->model('TransportModel');

		$status = $this->TransportModel->delete_accident_details($id);
		if ($status['responsecode'] == 1) {
			echo json_encode(array('msg' => 'deleted'));
		}
	}
	
	//Exit Re-entry
	public function exit_reentry(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			$this->load->model('TransportModel');
			$data_report = $this->TransportModel->get_exit_reentry_list($status);
			  
			$arr['exit_reentry_list']=array();
			if($data_report){
				foreach ($data_report as $row) {
					array_push($arr['exit_reentry_list'], $row);
				}
			}else{
				echo "<script type='text/javascript'>alert('Sorry!! No data found.');</script>";
			}
			$this->load->view('exit_reentry_view',$arr);
		}else{
			redirect('welcome');
        }
	}
	
		//exit_reentry_list
	public function exit_reentry_list(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			if($this->input->post('status')!=''){
				$status = $this->input->post('status');
 		    	$this->load->model('TransportModel');
                $data_report = $this->TransportModel->get_exit_reentry_list($status);
				  
				$arr['exit_reentry_list']=array();
				if($data_report){
					foreach ($data_report as $row) {
						array_push($arr['exit_reentry_list'], $row);
					}
				}else{
					echo "<script type='text/javascript'>alert('Sorry!! No data found.');</script>";
				}
				
			}
			$this->load->view('exit_reentry_view',$arr);
		}else{
			redirect('Welcome');
		}
	}

	//exit_reentry_Add
	public function exit_reentry_add(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
		
			$data['no_of_months']     = $this->input->post('no_of_months');
            $data['from_date']           = $this->input->post('from_date');
            $data['to_date']           = $this->input->post('to_date');
            $data['emp_id']           = $this->session->userdata('user_id');
			$data['emp_type']           = $this->session->userdata('user_type');
            
			//updalod file by API
			
			$files = $_FILES['userfile'];
            $_FILES['userfile']['name']     = $files['name'];
            $_FILES['userfile']['type']     = $files['type'];
            $_FILES['userfile']['tmp_name'] = $files['tmp_name'];
            $_FILES['userfile']['size']     = $files['size'];
			
			$path='Upload/uploadsExitReEntryDocument';
			$fileResponse=$this->TransportModel->upload_file_api($path,$_FILES['userfile']['tmp_name'],$_FILES['userfile']['type'],$_FILES['userfile']['name']);
			if($fileResponse){
				$data['document']=$fileResponse;
			}else{
				$data['document']=NULL;
			}
			
 			$this->db->insert('exit_re_entries', $data);
          
			// to get all records
			$data_report = $this->TransportModel->get_exit_reentry_list(0);
			  
			$arr['exit_reentry_list']=array();
			if($data_report){
				foreach ($data_report as $row) {
					array_push($arr['exit_reentry_list'], $row);
				}
			}else{
				echo "<script type='text/javascript'>alert('Sorry!! No data found.');</script>";
			}
					
			$this->load->view('exit_reentry_view',$arr);
			redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/exit_reentry','refresh');
		}else{
			
			redirect('Welcome');
		}
	}
	
	//download
	function exit_reentry_download($file_name){
		
		$config = file_get_contents("Assets/configuration.txt");
        $path= str_replace("index.php?web_services/","uploads/",$config);
		
        $this->load->helper('download');
        $data = file_get_contents($path."exit_reentry/" .$file_name);
        $name = $file_name;
        force_download($name, $data);
    }

	
	public function manage_picnic(){

		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			$this->load->model('TransportModel');
			$picnic   =   $this->db->get('picnic');
			if($picnic->num_rows()>0){
				$arr['picnic']=array();
				foreach ($picnic->result_array() as $row) {
					array_push($arr['picnic'], $row['title']);
					array_push($arr['picnic'], $row['from_date']);
					array_push($arr['picnic'], $row['to_date']);
					array_push($arr['picnic'], $row['latitude'].', '.$row['longitude']);
					array_push($arr['picnic'], $row['picnic_id']);
				}

			}
			else{
				echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
			}
			$this->load->view('manage_picnic',$arr);

		}else{
			redirect('welcome');
		}
	}

	public function add_picnic(){

		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			$this->load->library('googlemaps');

			$config['center'] = 'auto';
			$config['zoom'] = 'auto';
			$config['onclick'] = ' makemarker(event.latLng.lat(),event.latLng.lng(),event.latLng)';
			$config['places'] = TRUE;
			$config['placesAutocompleteInputID'] = 'search';
//$config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
			$config['placesAutocompleteOnChange'] = 'makemarkertext()';
			$this->googlemaps->initialize($config);
			$data['map'] = $this->googlemaps->create_map();

			$this->load->view('add_picnic', $data);

		}else{
			redirect('Welcome');
		}

	}	

	public function add_new_picnic(){

		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			$data['title']=$this->input->post('title');	
			$data['from_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
			$data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));	
			$data['pickup_time']=$this->input->post('pickup_from_time').'-'.$this->input->post('pickup_to_time');
			$data['drop_time']=$this->input->post('drop_from_time').'-'.$this->input->post('drop_to_time');	
			$data['latitude']=$this->input->post('latitude');	
			$data['assigned_bus']='null';
			// $data['assigned_driver']='null';
			// $data['assigned_teacher']='null';
			$data['longitude']=$this->input->post('longitude');	
			$data['year']          =   $this->db->get_where('settings' , array(
				'type' => 'running_year'
				))->row()->description;

			$this->db->insert('picnic' , $data);

			echo "<script type='text/javascript'>alert('New picnic added');</script>";

			$this->load->model('TransportModel');
			$picnic   =   $this->db->get('picnic');
			if($picnic->num_rows()>0){
				$arr['picnic']=array();
				foreach ($picnic->result_array() as $row) {
					array_push($arr['picnic'], $row['title']);
					array_push($arr['picnic'], $row['from_date']);
					array_push($arr['picnic'], $row['to_date']);
					array_push($arr['picnic'], $row['latitude'].', '.$row['longitude']);
					array_push($arr['picnic'], $row['picnic_id']);
				}
				$this->load->view('manage_picnic',$arr);

			}
			else{
				$this->load->view('manage_picnic',$arr);
				echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
			}


		}else{
			redirect('Welcome');
		}

	}	

	public function add_students_picnic($picnic_id){
		
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			// if($this->input->post('class')!='' && $this->input->post('section')!='' ){
			// 	$class_id=$this->input->post('class');
			// 	$section_id=$this->input->post('section');

			// 	$arr['students']=array();
			// 	$students=$this->db->get_where('student',array('class_id' => $class_id,'section_id'=>$section_id));
			// 	if($students->num_rows()>0){
			// 		foreach ($students->result_array() as $row) {
			// 			array_push($arr['students'], $row['student_id']);
			// 			array_push($arr['students'], $row['student_id']);
			// 			array_push($arr['students'], $row['name']);
			// 			array_push($arr['students'], $row['class_id']);
			// 			array_push($arr['students'], $row['section_id']);
			// 		}
			// 	}
			// 	else{
			// 		echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
			// 	}
			// 	//$arr['picnic_id']=$picnic_id;
			// 	//$this->load->view('add_students_picnic',$arr);
			// 	//echo "<script type='text/javascript'>alert($class_id.$section_id);</script>";
			// }
			$arr['picnic_id']=$picnic_id;

			$this->load->view('add_students_picnic', $arr);

		}else{
			redirect('Welcome');
		}
		
	}	

	function get_class_sections($class_id)
	{

		$sections   =   $this->db->get_where('section',array('class_id' => $class_id))->result_array();

		foreach($sections as $row){
			echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
		}
	}

	
	function get_students_picnic(){

		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			$class_id= $this->input->post('class_id');
			$section_id= $this->input->post('section_id');
			$picnic_id= $this->input->post('picnic_id');
			$arr['pending_data'] = array();
			$count=0;

			$students=$this->db->get_where('student',array('class_id' => $class_id,'section_id'=>$section_id));
			if($students->num_rows()>0){
				foreach ($students->result_array() as $row) {

					$selected=$this->db->get_where('picnic_selected_students',array('picnic_id' => $picnic_id, 'student_id' => $row['student_id']));
					if($selected->num_rows()>0){}
						else{
							array_push($arr['pending_data'], $row);
							$count++;
						}
					}
					if($count==0){
						array_push($arr['pending_data'], array('response' => 'exists'));
					}

				}else{
					array_push($arr['pending_data'], array('response' => 'nodata'));
				}

				echo json_encode($arr['pending_data']);
			}else{
				redirect('Welcome');
			}


		}

		function get_students_picnic_selected(){

			if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
				$picnic_id= $this->input->post('picnic_id');
				
				$arr['pending_data'] = array();

				$students=$this->db->get_where('picnic_selected_students',array('picnic_id' => $picnic_id));
				if($students->num_rows()>0){
					foreach ($students->result_array() as $row) {
						$name=$this->db->get_where('student',array('student_id' => $row['student_id']))->row()->name;
						$class_name=$this->db->get_where('student',array('student_id' => $row['student_id']))->row()->class_name;
						$section_name=$this->db->get_where('student',array('student_id' => $row['student_id']))->row()->section_name;
						array_push($arr['pending_data'], $row + array('name' => $name) + array('class_name' => $class_name) + array('section_name' => $section_name));
					}

				}else{
					array_push($arr['pending_data'], array('response' => 'nodata'));
				}

				echo json_encode($arr['pending_data']);
			}else{
				redirect('Welcome');
			}


		}

		public function picnic_insert_selected(){
			if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
				if($this->input->post('checkbox')!=''){
					
					$picnic_id =$this->input->post('picnic_id');
					$checkbox=$this->input->post('checkbox');

				// $this->db->where('picnic_id' , $picnic_id);
    //         	$this->db->delete('picnic_selected_students');
					
					
					foreach($checkbox as $check) { 
					//echo $check;
						$x =  explode(',',$check);
						$student_id = $x[0];
						$class_id = $x[1];
						$section_id = $x[2];

						$students=$this->db->get_where('picnic_selected_students',array('picnic_id' => $picnic_id,'student_id'=>$student_id));
						if($students->num_rows()>0){
						//debug_to_console('exists');
						//echo "exists";

						}else{
							$data1['picnic_id'] = $picnic_id;
							$data1['student_id'] = $student_id;
							$data1['class_id'] = $class_id;
							$data1['section_id'] = $section_id; 
							$this->db->insert('picnic_selected_students', $data1);
						//echo 'inserted';
						}

						


					}

				//To remove unselected students from db
					$existing=$this->db->get_where('picnic_selected_students',array('picnic_id' => $picnic_id))->result_array();

					foreach ($existing as $row3) {
						$exists=0;
						$s_id1= $row3['student_id'];

						foreach($checkbox as $check2) {
							$x2 =  explode(',',$check2);
							$s_id2 = $x2[0];
							if($s_id1==$s_id2){
								$exists=1;
							}
						}

						if($exists==0){
							$this->db->where('student_id' , $s_id1);
							$this->db->where('picnic_id' , $picnic_id);
							$this->db->delete('picnic_selected_students');
	            		//echo 'deleted '.$s_id1;
						}
						
					}

					$total=$this->db->get_where('picnic_selected_students',array('picnic_id' => $picnic_id));
					$no = $total->num_rows();
					$data['total_students']=$no;
					$this->db->where('picnic_id' , $picnic_id);
					$this->db->update('picnic' , $data);

					

					echo "<script type='text/javascript'>alert('Students Added');</script>";
					
					$this->load->model('TransportModel');
					$picnic   =   $this->db->get('picnic');
					if($picnic->num_rows()>0){
						$arr['picnic']=array();
						foreach ($picnic->result_array() as $row) {
							array_push($arr['picnic'], $row['title']);
							array_push($arr['picnic'], $row['from_date']);
							array_push($arr['picnic'], $row['to_date']);
							array_push($arr['picnic'], $row['latitude'].', '.$row['longitude']);
							array_push($arr['picnic'], $row['picnic_id']);
						}
						$this->load->view('manage_picnic',$arr);

					}
					else{
						$this->load->view('manage_picnic',$arr);
						echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
					}

				}else{
					$arr['picnic_id']=$picnic_id;
					$this->load->view('add_students_picnic', $arr);
					echo "<script type='text/javascript'>alert('No Students Selected');</script>";
				}
			}else{
				redirect('welcome');
			}	
		}


		public function edit_picnic($picnic_id){

			if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
				$this->load->library('googlemaps');

				$latitude= $this->db->get_where('picnic' , array('picnic_id' => $picnic_id))->row()->latitude;
				$longitude= $this->db->get_where('picnic' , array('picnic_id' => $picnic_id))->row()->longitude;
				$marker = array();
				$marker['position'] = ''.$latitude.', '.$longitude;

			$config['center'] = 'auto';//.$latitude.', '.$longitude;
			$config['zoom'] = '16';
			$config['onclick'] = 'makemarker(event.latLng.lat(),event.latLng.lng(),event.latLng)';
			$config['places'] = TRUE;
			$config['placesAutocompleteInputID'] = 'search';
//$config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
			$config['placesAutocompleteOnChange'] = 'makemarkertext()';
			$this->googlemaps->initialize($config);
			//$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();
			$data['picnic_id']=$picnic_id;

			$this->load->view('edit_picnic', $data);

		}else{
			redirect('Welcome');
		}

	}	


	function get_picnic_details(){

		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			
			$picnic_id= $this->input->post('picnic_id');
			$arr['pending_data'] = array();
			$count=0;

			$picnic= $this->db->get_where('picnic' , array('picnic_id' => $picnic_id));
			if($picnic->num_rows()>0){
				foreach ($picnic->result_array() as $row) {

					$title= $row['title'];
					$from_date= date("d-m-Y",strtotime($row['from_date']));
					$to_date= date("d-m-Y",strtotime($row['to_date']));
					$p= explode('-',$row['pickup_time']);
					$pickup_from_time= $p[0];
					$pickup_to_time= $p[1];
					$d= explode('-',$row['drop_time']);
					$drop_from_time= $d[0];
					$drop_to_time= $d[1];
					$latitude= $row['latitude'];
					$longitude= $row['longitude'];
					$marker= '('.$latitude.', '.$longitude.')';
					array_push($arr['pending_data'], array('title' => $title)+array('from_date' => $from_date)+array('to_date' => $to_date)+array('pickup_from_time' => $pickup_from_time)+array('pickup_to_time' => $pickup_to_time)+array('drop_from_time' => $drop_from_time)+array('drop_to_time' => $drop_to_time)+array('latitude' => $latitude)+array('longitude' => $longitude)+array('marker' => $marker));
					
				}
				

			}else{
				array_push($arr['pending_data'], array('response' => 'nodata'));
			}

			echo json_encode($arr['pending_data']);
		}else{
			redirect('Welcome');
		}


	}


	public function update_picnic(){

		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){

			$picnic_id= $this->input->post('picnic_id');
			$data['title']=$this->input->post('title');	
			$data['from_date']=date("Y-m-d", strtotime($this->input->post('from_date')));
			$data['to_date']=date("Y-m-d", strtotime($this->input->post('to_date')));	
			$data['pickup_time']=$this->input->post('pickup_from_time').'-'.$this->input->post('pickup_to_time');
			$data['drop_time']=$this->input->post('drop_from_time').'-'.$this->input->post('drop_to_time');	
			$data['latitude']=$this->input->post('latitude');	
			$data['longitude']=$this->input->post('longitude');	
			$data['year']          =   $this->db->get_where('settings' , array(
				'type' => 'running_year'
				))->row()->description;

			$this->db->where('picnic_id' , $picnic_id);
			$this->db->update('picnic' , $data);

			echo "<script type='text/javascript'>alert('Picnic Details Updated');</script>";

			$this->load->model('TransportModel');
			$picnic   =   $this->db->get('picnic');
			if($picnic->num_rows()>0){
				$arr['picnic']=array();
				foreach ($picnic->result_array() as $row) {
					array_push($arr['picnic'], $row['title']);
					array_push($arr['picnic'], $row['from_date']);
					array_push($arr['picnic'], $row['to_date']);
					array_push($arr['picnic'], $row['latitude'].', '.$row['longitude']);
					array_push($arr['picnic'], $row['picnic_id']);
				}
				$this->load->view('manage_picnic',$arr);

			}
			else{
				$this->load->view('manage_picnic',$arr);
				echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
			}


		}else{
			redirect('Welcome');
		}

	}	


	public function add_bus_picnic($picnic_id){
		
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			
			$arr['picnic_id']=$picnic_id;

			$this->load->view('add_bus_picnic', $arr);

		}else{
			redirect('Welcome');
		}
		
	}	


	function add_new_bus_picnic(){

		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			
			$picnic_id= $this->input->post('picnic_id');
			$bus_id= $this->input->post('bus_id');
			$driver_id= $this->input->post('driver_id');
			$teacher_id= $this->input->post('teacher_id');
			$t= explode(',', $teacher_id);
			$teachers= sizeof($t);

			$c= $this->db->get_where('bus_details' , array('bus_Id' => $bus_id))->row()->bus_type;
			$parts = preg_split('/\s+/', $c);
			$capacity= $parts[0]-$teachers;
			$arr['pending_data'] = array();
			$count=1;

			$picnic= $this->db->get_where('picnic_selected_students' , array('picnic_id' => $picnic_id, 'bus_id'=> 0));
			if($picnic->num_rows()>0){
				foreach ($picnic->result_array() as $row) {

					if($count<=$capacity){
						$data['bus_id']=$bus_id;
						$data['driver_id']=$driver_id;
						$data['teacher_id']=$teacher_id;

						$this->db->where('student_id' , $row['student_id']);
						$this->db->where('picnic_id' , $picnic_id);
						$this->db->update('picnic_selected_students' , $data);
						$count++;	
					}
					else
						break;

				}
				$assigned_bus= $this->db->get_where('picnic' , array('picnic_id' => $picnic_id))->row()->assigned_bus;
				$assigned_driver= $this->db->get_where('picnic' , array('picnic_id' => $picnic_id))->row()->assigned_driver;
				$assigned_teacher= $this->db->get_where('picnic' , array('picnic_id' => $picnic_id))->row()->assigned_teacher;
				if($assigned_bus==''){
					$data2['assigned_bus']=$bus_id;
					$data2['assigned_driver']=$driver_id;
					$data2['assigned_teacher']=$teacher_id;

					$this->db->where('picnic_id' , $picnic_id);
					$this->db->update('picnic' , $data2);


				}
				else{
					$data3['assigned_bus']=$assigned_bus.','.$bus_id;
					$data3['assigned_driver']=$assigned_driver.','.$driver_id;
					$data3['assigned_teacher']=$assigned_teacher.','.$teacher_id;

					$this->db->where('picnic_id' , $picnic_id);
					$this->db->update('picnic' , $data3);
				}


				$q= $this->db->get_where('picnic_selected_students' , array('picnic_id' => $picnic_id, 'bus_id !='=> 0));
				$tot= $q->num_rows();
				
				array_push($arr['pending_data'], array('response' => 'added')+array('total_assigned' => $q));

			}else{
				$q= $this->db->get_where('picnic_selected_students' , array('picnic_id' => $picnic_id, 'bus_id !='=> 0));
				$tot= $q->num_rows();
				
				array_push($arr['pending_data'], array('response' => 'nodata') +array('total_assigned' => $q));
			}

			echo json_encode($arr['pending_data']);
		}else{
			redirect('Welcome');
		}


	}


	function get_selected_bus_picnic(){

		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			
			$picnic_id= $this->input->post('picnic_id');
			$arr['pending_data'] = array();
			$count=0;


			$this->db->select('bus_id,driver_id,teacher_id');
			$this->db->where('picnic_id' , $picnic_id);
			$this->db->where("bus_id !=", $count);
			$this->db->group_by('bus_id');
			$picnic= $this->db->get('picnic_selected_students');
			//$picnic= $this->db->get_where('picnic' , array('picnic_id' => $picnic_id));
			if($picnic->num_rows()>0){
				foreach ($picnic->result_array() as $row) {

					$query= $this->db->get_where('picnic_selected_students' , array('picnic_id' => $picnic_id,'bus_id'=>$row['bus_id']));
					$number= $query->num_rows();
					$bus_name= $this->db->get_where('bus_details' , array('bus_Id' => $row['bus_id']))->row()->name;
					$driver_name= $this->db->get_where('employee_details' , array('emp_id' => $row['driver_id']))->row()->name;
					$t= explode(',', $row['teacher_id']);
					$teachers='';
					$i=0;
						//echo "<script type='text/javascript'>alert($t);</script>";
					for ($i=0; $i < sizeof($t)-1; $i++) { 
						$q=$this->db->get_where('employee_details' , array('emp_id' => $t[$i]))->row()->name;
						$teachers=$teachers.$q;
						$teachers=$teachers.', ';
					}
					$teachers=$teachers.$this->db->get_where('employee_details' , array('emp_id' => $t[$i]))->row()->name;
					array_push($arr['pending_data'], $row +array('number' => $number) +array('bus_name' => $bus_name) +array('driver_name' => $driver_name) +array('teacher_name' => $teachers));
					
				}
				

			}else{
				array_push($arr['pending_data'], array('response' => 'nodata'));
			}

			echo json_encode($arr['pending_data']);
		}else{
			redirect('Welcome');
		}


	}

	function remove_assigned_bus_picnic(){

		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			
			$picnic_id= $this->input->post('picnic_id');
			$bus_id= $this->input->post('bus_id');
			
			$arr['pending_data'] = array();
			$count=0;

			$picnic= $this->db->get_where('picnic_selected_students' , array('picnic_id' => $picnic_id, 'bus_id'=> $bus_id));
			if($picnic->num_rows()>0){
				foreach ($picnic->result_array() as $row) {

					$data['bus_id']=0;
					$data['driver_id']=0;
					$data['teacher_id']=0;

					$this->db->where('student_id' , $row['student_id']);
					$this->db->where('picnic_id' , $picnic_id);
					$this->db->update('picnic_selected_students' , $data);
					

				}
				
				// $data2['assigned_bus']='';
				// $data2['assigned_driver']='';
				// $data2['assigned_teacher']='';

				// $this->db->where('picnic_id' , $picnic_id);
				// $this->db->update('picnic' , $data2);



				$q= $this->db->get_where('picnic_selected_students' , array('picnic_id' => $picnic_id, 'bus_id !='=> 0));
				$tot= $q->num_rows();
				
				array_push($arr['pending_data'], array('response' => 'removed') +array('total_assigned' => $q));

			}else{
				$q= $this->db->get_where('picnic_selected_students' , array('picnic_id' => $picnic_id, 'bus_id !='=> 0));
				$tot= $q->num_rows();
				
				array_push($arr['pending_data'], array('response' => 'nodata') +array('total_assigned' => $q));
			}

			echo json_encode($arr['pending_data']);
		}else{
			redirect('Welcome');
		}


	}


	function get_total_assigned_picnic(){
		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			
			$picnic_id= $this->input->post('picnic_id');
			
			
			$arr['pending_data'] = array();
			
			$q= $this->db->get_where('picnic_selected_students' , array('picnic_id' => $picnic_id, 'bus_id !='=> 0));
			$tot= $q->num_rows();
			
			array_push($arr['pending_data'], array('response' => 'assigned') +array('total_assigned' => $tot));

			echo json_encode($arr['pending_data']);
		}else{
			redirect('Welcome');
		}
	}

	function picnic_add_bus_submit(){

		if ($this->session->has_userdata('username') && $this->session->has_userdata('email') ){
			
			$picnic_id= $this->input->post('picnic_id');
			$count=0;
			$assigned_bus='';
			$assigned_teacher='';
			$assigned_driver='';

			$this->db->select('bus_id,driver_id,teacher_id');
			$this->db->where('picnic_id' , $picnic_id);
			$this->db->where("bus_id !=", $count);
			$this->db->group_by('bus_id');
			$picnic= $this->db->get('picnic_selected_students');
			//$picnic= $this->db->get_where('picnic' , array('picnic_id' => $picnic_id));
			if($picnic->num_rows()>0){
				$p= $picnic->result_array();
				$i=0;
				for ($i=0; $i < sizeof($p)-1 ; $i++) { 
					$assigned_bus=$assigned_bus.$p[$i]['bus_id'];
					$assigned_bus=$assigned_bus.',';

					$assigned_driver=$assigned_driver.$p[$i]['driver_id'];
					$assigned_driver=$assigned_driver.',';

					$assigned_teacher=$assigned_teacher.$p[$i]['teacher_id'];
					$assigned_teacher=$assigned_teacher.',';
				}
				$assigned_bus=$assigned_bus.$p[$i]['bus_id'];
				$assigned_driver=$assigned_driver.$p[$i]['driver_id'];
				$assigned_teacher=$assigned_teacher.$p[$i]['teacher_id'];

				$data2['assigned_bus']=$assigned_bus;
				$data2['assigned_driver']=$assigned_driver;
				$data2['assigned_teacher']=$assigned_teacher;

				$this->db->where('picnic_id' , $picnic_id);
				$this->db->update('picnic' , $data2);
				

			}

			$this->load->model('TransportModel');
			$picnic   =   $this->db->get('picnic');
			if($picnic->num_rows()>0){
				$arr['picnic']=array();
				foreach ($picnic->result_array() as $row) {
					array_push($arr['picnic'], $row['title']);
					array_push($arr['picnic'], $row['from_date']);
					array_push($arr['picnic'], $row['to_date']);
					array_push($arr['picnic'], $row['latitude'].', '.$row['longitude']);
					array_push($arr['picnic'], $row['picnic_id']);
				}

			}
			else{
				echo "<script type='text/javascript'>alert('Sorry!! no data found.');</script>";
			}
			$this->load->view('manage_picnic',$arr);
			


			
		}else{
			redirect('Welcome');
		}

	}

	function delete_picnic(){
		
		$picnic_id=$this->input->post('picnic_id');


		$this->db->where('picnic_id', $picnic_id);
		$this->db->delete('picnic');

		$this->db->where('picnic_id', $picnic_id);
		$this->db->delete('picnic_selected_students');

		

		//$this->load->view('routes');
		redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/index.php/Welcome/manage_picnic');

	}
	
	public function logout()
	{
		// destroy session
        $data = array('email' => '');
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
redirect('http://'.$_SERVER['SERVER_NAME'].'/AdminPortal/','refresh');
	}

}
