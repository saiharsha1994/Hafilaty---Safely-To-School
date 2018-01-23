<?php  
   class TransportModel extends CI_Model  
   {  
      function __construct()  
      {  
         // Call the Model constructor  
         parent::__construct();  
      }  
        
      public function getLogDetails($formemail,$formpassword){
        
      		$config = file_get_contents("Assets/configuration.txt");
          	$url=$config.'Transport_Admin_Login_api/loginPortal';
               $ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch,CURLOPT_POSTFIELDS,"Email=".$formemail."&Password=".$formpassword);
              $data = curl_exec($ch);
              curl_close($ch);
              
              return $data;


      }

	
	public function getRadius(){
		$config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Settings_api/listSettings';
              $ch = curl_init();
              $timeout = 5;
              curl_setopt($ch,CURLOPT_URL,$url);
              curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
              curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
              $data = curl_exec($ch);
              curl_close($ch);
              return $data;

		}

function get_leave_view_driver($type,$id,$from_date,$to_date){
       
     
      $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Attendance_api/LeaveListOfAdmins/user_type/'.$type.'/user_id/'.$id.'/from_date/'.$from_date.'/to_date/'.$to_date;
              $ch = curl_init();
              $timeout = 5;
              curl_setopt($ch,CURLOPT_URL,$url);
              curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
              curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
              $data = curl_exec($ch);
              curl_close($ch);
              return json_decode($data,true);

    }


    function get_leave_view($type,$id,$from_date,$to_date){
     
      $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Attendance_api/LeaveListOfAdmins/user_type/'.$type.'/user_id/'.$id.'/from_date/'.$from_date.'/to_date/'.$to_date;
              $ch = curl_init();
              $timeout = 5;
              curl_setopt($ch,CURLOPT_URL,$url);
              curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
              curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
              $data = curl_exec($ch);
              curl_close($ch);
              return json_decode($data,true);

    }

	public function updateCoordinates(){
	$config = file_get_contents("Assets/configuration.txt");
          $url=$config.'BusCoordinates_api/getAllBusCoordinates';
              $ch = curl_init();
              $timeout = 5;
              curl_setopt($ch,CURLOPT_URL,$url);
              curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
              curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
              $data = curl_exec($ch);
              curl_close($ch);
              return $data;
	}
      public function get_Route(){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'GetRouteDetails_api/listRoutes';
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);

      }

 public function get_Route_Details(){
            $config = file_get_contents("Assets/configuration.txt");
            $url=$config.'GetRouteDetails_api/RoutesListStops';
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);

         }

      public function getDetails_driverbus(){
       $config = file_get_contents("Assets/configuration.txt");
        $url=$config.'GetRouteDetails_api/RoutesListStops';
        $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);
      }


	

      public function transfer_studentsorteachers($stopname,$stoptime,$latitude,$langitude,$order,$route_id,$assigned_to,$driver_id,$bus_id){
       

      	$config = file_get_contents("Assets/configuration.txt");
        $url=$config.'GetRouteDetails_api/createRouteStops';
        $ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "stop_name=".urlencode(implode(",", $stopname))."&stop_time=".urlencode(implode(",", $stoptime))."&latitude=".implode(",", $latitude)."&langitude=".implode(",", $langitude)."&numeric_order=".implode(",", $order)."&route_id=".implode(",", $route_id)."&assigned_to=".implode(",", $assigned_to)."&driver_id=".implode(",", $driver_id)."&bus_id=".implode(",", $bus_id)."&for=transfer");
		$data = curl_exec($ch);
		curl_close($ch);
            return json_decode($data, true);
      }


	public function managebus_data(){
       $config = file_get_contents("Assets/configuration.txt");
        $url=$config.'BusList_api/listBuses';
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);
         }

	public function add_managebus($bus_name,$bus_type,$chassis_number,$plate_number,$fahas,$data,$license_expiry,$license_renew,$data1,$mvpi_expiry){

         $config = file_get_contents("Assets/configuration.txt");
        $url=$config.'BusList_api/addBuses';
        $ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "bus_name=".urlencode($bus_name)."&bus_type=".urlencode($bus_type)."&chassis_number=".$chassis_number."&plate_number=".$plate_number."&fahas=".$fahas."&bus_license=".$data."&license_expiry=".$license_expiry."&license_renewal_date=".$license_renew."&MVPI=".$data1."&MVPI_expiry=".$mvpi_expiry);
		$data = curl_exec($ch);
		curl_close($ch);
            return json_decode($data, true);
         }
	public function update_managebus($bus_name,$bus_type,$chassis_number,$plate_number,$fahas,$data,$license_expiry,$license_renew,$data1,$mvpi_expiry,$bus_id){
         $config = file_get_contents("Assets/configuration.txt");
        $url=$config.'BusList_api/editBuses';
       
            $ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "bus_name=".urlencode($bus_name)."&bus_type=".urlencode($bus_type)."&chassis_number=".$chassis_number."&plate_number=".$plate_number."&fahas=".$fahas."&bus_license=".$data."&license_expiry=".$license_expiry."&license_renewal_date=".$license_renew."&MVPI=".$data1."&MVPI_expiry=".$mvpi_expiry."&bus_id=".$bus_id);
			$data = curl_exec($ch);
			curl_close($ch);
            return json_decode($data, true);
         }

	public function deletebusdetails($id){
         $config = file_get_contents("Assets/configuration.txt");
        $url=$config.'BusList_api/deleteBus';
           $ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "bus_id=".$id);
			$data = curl_exec($ch);
			curl_close($ch);
            return json_decode($data, true);

         }



         function GetDrivingDistance($lat1, $lat2, $long1, $long2)
{

echo $lat1;
echo $long1;
echo "///";
  echo $lat2+" ";
  echo $long2+" ";
  echo "///";
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=pl-PL";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
    $time = $response_a['rows'][0]['elements'][0]['duration']['text'];


    if(strpos($dist, 'km') !== false) {
      //echo "in KM".$dist;
      $dist=str_replace(",",".",$dist);
      $dist=substr($dist, 0, strpos($dist, ' '));
          //echo $dist;
          //echo "/";
        
        
        }else{
          //echo "in M".$dist;
          $dist=str_replace(",",".",$dist);
                  $dist=substr($dist, 0, strpos($dist, ' '));

                $dist=((int)$dist/1000);
                // echo $dist;
        //echo "/";
        }
  
   
    return $dist;
}



      public function create_studentsorteachers(array $stopname,array $stoptime,array $latitude,array $langitude,array $order,array $route_id,array $assigned_to,$driver_id,$bus_id,$dstnc){
        
       $config = file_get_contents("Assets/configuration.txt");
        $url=$config.'GetRouteDetails_api/createRouteStops';
        
        $ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "stop_name=".urlencode(implode(',', $stopname))."&stop_time=".urlencode(implode(',', $stoptime))."&latitude=".urlencode(implode(',', $latitude))."&langitude=".urlencode(implode(',', $langitude))."&numeric_order=".urlencode(implode(',', $order))."&route_id=".urlencode(implode(',', $route_id))."&assigned_to=".urlencode(implode(',', $assigned_to))."&driver_id=".urlencode($driver_id)."&bus_id=".urlencode($bus_id)."$route_distance=".urlencode($dstnc)."&for=create");
			$response = curl_exec($ch);
			curl_close($ch);
            return json_decode($data, true);
      }

	public function get_vehicle_Details(){
            $config = file_get_contents("Assets/configuration.txt");
            $url=$config.'BusList_api/listBuses';
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);

         }

public function get_breakdown_list($bus_id, $from_date, $to_date){
              $config = file_get_contents("Assets/configuration.txt");
                $url=$config.'BusCoordinates_api/getBreakdownBuses/bus_id/'.$bus_id.'/from_date/'.$from_date.'/to_date/'.$to_date;
                $ch = curl_init();
                $timeout = 5;
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                $data = curl_exec($ch);
                curl_close($ch);
                return json_decode($data, true);

}


	public function get_contracts(){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Contracts_api/listContract';
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);

      }

	public function send_contracts($vendor_name,$vendor_email,$contract_date,$vendor_mobile,$bus_provided,$driver_provided,$expiry_date,$addi_details,$upload_file){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Contracts_api/addContract';
             $ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "vendor_name=".urlencode($vendor_name)."&vendor_email=".urlencode($vendor_email)."&contract_date=".$contract_date."&vendor_mobile=".$vendor_mobile."&busses_provide=".$bus_provided."&driver_provide=".$driver_provided."&expiry_date=".$expiry_date."&addtional_details=".urlencode($addi_details)."&document=".$upload_file);
				$data = curl_exec($ch);
				curl_close($ch);
            return json_decode($data, true);

      }

public function update_contracts($vendor_name,$vendor_email,$contract_date,$vendor_mobile,$bus_provided,$driver_provided,$expiry_date,$addi_details,$upload_file,$contract_id){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Contracts_api/editContract/vendor_name/'.urlencode($vendor_name).'/vendor_email/'.$vendor_email.'/contract_date/'.$contract_date.'/vendor_mobile/'.$vendor_mobile.'/busses_provide/'.$bus_provided.'/driver_provide/'.$driver_provided.'/expiry_date/'.$expiry_date.'/addtional_details/'.urlencode($addi_details).'/document/'.$upload_file.'/contract_id/'.$contract_id;
            $ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "vendor_name=".urlencode($vendor_name)."&vendor_email=".urlencode($vendor_email)."&contract_date=".$contract_date."&vendor_mobile=".$vendor_mobile."&busses_provide=".$bus_provided."&driver_provide=".$driver_provided."&expiry_date=".$expiry_date."&addtional_details=".urlencode($addi_details)."&document=".$upload_file."&contract_id=".$contract_id);
			$data = curl_exec($ch);
			curl_close($ch);
            return json_decode($data, true);

      }

	public function update_driver_details($driver_name,$nationality,$IqamaNumber,$IqamaExpiryDate,$PassportNumber,$PassportExpiryDate,$mobile,$password,$data_photo,$assignbus_id,$data_iqama,$data_license,$data_passport,$LicenseNumber,$LicenseExpiryDate,$driver_id){

            $config = file_get_contents("Assets/configuration.txt");
            $url=$config.'DriverList_api/editDrivers';
           $ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "name=".urlencode($driver_name)."&nationality=".$nationality."&iqama_number=".$IqamaNumber."&iqama_expiry_date=".$IqamaExpiryDate."&passport_number=".$PassportNumber."&passport_expiry_date=".$PassportExpiryDate."&mobile=".$mobile."&password=".$password."&photo=".$data_photo."&assigned_bus=".$assignbus_id."&iqama_upload=".$data_iqama."&license_upload=".$data_license."&passport_upload=".$data_passport."&license_number=".$LicenseNumber."&license_expiry_date=".$LicenseExpiryDate."&driver_id=".$driver_id);
			$data = curl_exec($ch);
			curl_close($ch);
            return json_decode($data, true);
           

         }


	public function report_data($from, $to){
              $config = file_get_contents("Assets/configuration.txt");
              $url=$config.'BusCoordinates_api/getCoordinatesByDate/From_Date/'.$from.'/To_Date/'.$to;
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);

         }

	public function get_driver_profile(){
         $config = file_get_contents("Assets/configuration.txt");
            $url=$config.'DriverList_api/listDrivers';
              $ch = curl_init();
              $timeout = 5;
              curl_setopt($ch,CURLOPT_URL,$url);
              curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
              curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
              $data = curl_exec($ch);
              curl_close($ch);
            return json_decode($data, true);

      }
 public function populate_bus(){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'BusList_api/listBuses';
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);
      }




      public function getallStudentsDetails($trip_type){
       $config = file_get_contents("Assets/configuration.txt");
        $url=$config.'Students_api/allStudents/trip_type/'.$trip_type;

                 $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);
      }

 public function get_accident_Details(){
         $config = file_get_contents("Assets/configuration.txt");
            $url=$config.'Incidents_api/listIncident';
              $ch = curl_init();
              $timeout = 5;
              curl_setopt($ch,CURLOPT_URL,$url);
              curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
              curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
              $data = curl_exec($ch);
              curl_close($ch);
            return json_decode($data, true);

        }

	public function delete_accident_details($id){
         $config = file_get_contents("Assets/configuration.txt");
            $url=$config.'Incidents_api/deleteIncident';
              $ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "incident_id=".$id);
				$data = curl_exec($ch);
				curl_close($ch);
            return json_decode($data, true);

        }

  public function get_pettycash_details($from_date, $to_date, $driver_id){
         $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'PettyCash_api/listPettycash/from_date/'.$from_date.'/to_date/'.$to_date.'/driver_id/'.$driver_id.'/for/fuel';
              $ch = curl_init();
              $timeout = 5;
              curl_setopt($ch,CURLOPT_URL,$url);
              curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
              curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
              $data = curl_exec($ch);
              curl_close($ch);
            return json_decode($data, true);

  }
//http://al-amaanah.com/Schoooly/index.php?web_services/PettyCash_api/listPettycash/for/fuel/driver_id/0/pc_id/46
	 public function get_pettycash_edit($pc_id){
         $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'PettyCash_api/listPettycash';
               $ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "for=fuel"."&driver_id=0"."&pc_id=".$pc_id);
				$data = curl_exec($ch);
				curl_close($ch);
            return json_decode($data, true);

  }

	 public function send_pettycash($date, $driver_id, $amount){
         $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'PettyCash_api/addPettyCash';
              $ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "date=".$date."&driver_id=".$driver_id."&amount_given=".$amount."&amount_for=fuel");
				$data = curl_exec($ch);
				curl_close($ch);
            return json_decode($data, true);

      }
//PettyCash_api/editPettyCash/date/2017-01-02/driver_id/1/amount_given/220/amount_spend/200/balance/20/invoice_doc/filename.pdf/pc_id/1/amount_for/fuel
       public function update_petty($date,$driver_id,$amount_given,$amount_spend,$balance,$file_name,$pc_id){
$config = file_get_contents("Assets/configuration.txt");
      $url=$config.'PettyCash_api/editPettyCash';
       $ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "date=".$date."&driver_id=".$driver_id."&amount_given=".$amount_given."&amount_spend=".$amount_spend."&balance=".$balance."&invoice_doc=".urlencode($file_name)."&pc_id=".$pc_id."&amount_for=fuel");
$data = curl_exec($ch);
curl_close($ch);
      return json_decode($data, true);

  }

  public function delete_petty($pc_id){

     $config = file_get_contents("Assets/configuration.txt");
      $url=$config.'PettyCash_api/deletePettyCash';
       $ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "pc_id=".$pc_id);
			$data = curl_exec($ch);
			curl_close($ch);
      return json_decode($data, true);

  }


	 /*public function send_incident($incident_date, $driver_id, $bus_id, $incident_details, $file1, $fine_amount, $status, $file2){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Incidents_api/addIncident/date/'.$incident_date.'/driver_id/'.$driver_id.'/bus_id/'.$bus_id.'/details/'.urlencode($incident_details).'/report/'.$file1.'/fine_amt/'.$fine_amount.'/status/'.$status.'/document/'.$file2;
            
	$ch = curl_init();
              $timeout = 5;
              curl_setopt($ch,CURLOPT_URL,$url);
              curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
              curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
              $data = curl_exec($ch);
              curl_close($ch);
            return json_decode($data, true);

      }*/
      public function send_incident($incident_date, $driver_id, $driver_name, $bus_id, $bus_name, $incident_details, $file1, $fine_amount, $status, $file2){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Incidents_api/addIncident';
               $ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "date=".$incident_date."&driver_id=".$driver_id."&driver_name=".urlencode($driver_name)."&bus_id=".$bus_id."&bus_name=".urlencode($bus_name)."&details=".urlencode($incident_details)."&report=".$file1."&fine_amt=".$fine_amount."&status=".$status."&document=".$file2);
				$response = curl_exec($ch);
				curl_close($ch);
            return json_decode($data, true);

      }//


      public function get_studentsorget_teacher($id){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'GetRouteDetails_api/StopsListByRoute/route_id/'.$id;
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);
      }

      public function get_teachers(){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Students_api/allTeachers';
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);

      }

      public function get_students_attendance($route_id,$newDate,$trip_type){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Attendance_api/dailyReportByBus/Route_Id/'. $route_id .'/Date/'. $newDate .'/trip_type/'.$trip_type;
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);
      }

	public function vehicle_data($busid, $startdate, $enddate){

                $config = file_get_contents("Assets/configuration.txt");
                $url=$config.'BusList_api/VechicleDistanceList/bus_id/'.$busid.'/from_date/'.$startdate.'/to_date/'.$enddate;
                $ch = curl_init();
                $timeout = 5;
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                $data = curl_exec($ch);
                curl_close($ch);
                return json_decode($data, true);

         }

      public function send_msgTo($arr_MsgTo,$arr_Type,$comment){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'SendMessageFromDriver_api/insert';
             $ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "Msg=".urlencode($comment)."&MsgTo=".$arr_MsgTo."&Type=".$arr_Type);
				$data = curl_exec($ch);
				curl_close($ch);
            return json_decode($data, true);
      }

      public function get_ratings($month){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'DriverList_api/driverMeritSystem/month/'.$month;
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);
      }


	public function misbehaviour_data($busid){

                $config = file_get_contents("Assets/configuration.txt");
                $url=$config.'Attendance_api/MisbehaveByBus/bus_id/'.$busid;
                $ch = curl_init();
                $timeout = 5;
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                $data = curl_exec($ch);
                curl_close($ch);
                return json_decode($data, true);

         }

	public function send_misbehaviour($date, $bus_id, $student_id, $student_name ,$details){
          $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Attendance_api/misbehavior_insert';
            $ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "date=".$date."&bus_id=".$bus_id."&student_id=".$student_id."&name=".$student_name."&details=".urlencode($details));
			$data = curl_exec($ch);
			curl_close($ch);
                return json_decode($data, true);
            

      }


      public function get_driver_list(){
         $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'DriverList_api/listDrivers';
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);
      }

      public function get_bus_list(){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'BusList_api/listBuses';
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);
      }

      public function get_Route_with_stops(){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'GetRouteDetails_api/RoutesListStops';
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return json_decode($data, true);

      }

	public function add_new_driver($driver_name,$driver_nationality,$iq_number,$iq_exp_date,$pass_number,$pass_exp_date,$mobile,$pass,$data3,$assign_bus_id,$data,$data2,$data1,$lc_number,$lc_exp_number){
         $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'DriverList_api/addDrivers';
		
             $ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "name=".urlencode($driver_name)."&nationality=".urlencode($driver_nationality)."&iqama_number=".$iq_number.
				"&iqama_expiry_date=".$iq_exp_date."&passport_number=".$pass_number."&passport_expiry_date=".$pass_exp_date."&mobile=".$mobile."&password=".$pass."&photo=".$data3."&assigned_bus=".$assign_bus_id."&iqama_upload=".$data1."&license_number=".$lc_number."&license_expiry_date=".$lc_exp_number);
			$data = curl_exec($ch);
			curl_close($ch);
            return json_decode($data, true);
      }



      public function add_new_route($name,$type,$st_time,$end_time){
     $config = file_get_contents("Assets/configuration.txt");
      $url=$config.'GetRouteDetails_api/createRoute';
      $ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "route_name=".urlencode($name)."&trip_name=".$type."&start_time=".urlencode($st_time)."&end_time=".urlencode($end_time));
		$data = curl_exec($ch);
		curl_close($ch);
      return json_decode($data, true);
      }


	public function deletedriverdetails($Id){
      		$config = file_get_contents("Assets/configuration.txt");
      		$url=$config.'DriverList_api/deleteDriver';
      		 $ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "driver_id=".$Id);
			$data = curl_exec($ch);
			curl_close($ch);
      		return json_decode($data, true);
      }
		

      public function deleteRoute($Id){
      $config = file_get_contents("Assets/configuration.txt");
      $url=$config.'GetRouteDetails_api/deleteRoute';
       $ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "route_id=".urlencode($Id));
		$data = curl_exec($ch);
		curl_close($ch);
      return json_decode($data, true);
      }
	public function del_contct($con_del_id){
       $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Contracts_api/deleteContract';
             $ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "contract_id=".$con_del_id);
			$data = curl_exec($ch);
			curl_close($ch);
            return json_decode($data, true);

      }

      //Updating accident records

  public function update_accident($incident_id,$date,$driver_id,$driver_name,$bus_id,$bus_name,$details,$report,$fine_amt,$status,$document){

     $config = file_get_contents("Assets/configuration.txt");
      $url=$config.'Incidents_api/editIncident';
       $ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "incident_id=".$incident_id."&date=".$date."&driver_id=".$driver_id."&driver_name=".urlencode($driver_name)."&bus_id=".$bus_id."&bus_name=".urlencode($bus_name)."&details=".$details."&report=".$report."&fine_amt=".$fine_amt."&status=".$status."&document=".$document);
			$data = curl_exec($ch);
			curl_close($ch);
      return json_decode($data, true);  
  }

  //Leave related data

   public function get_pending_data($bus_id){

      $config = file_get_contents("Assets/configuration.txt");
      $url=$config.'Attendance_api/LeaveListForTransportAdmin/bus_id/'.$bus_id;
      $ch = curl_init();
      $timeout = 5;
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
      $data = curl_exec($ch);
      curl_close($ch);
      return json_decode($data, true);

  }//Attendance_api/editLeaveRequest/leave_id/1/status/2

  public function update_leave_status($leave_id, $status_id){
    $config = file_get_contents("Assets/configuration.txt");
      $url=$config.'Attendance_api/editLeaveRequest';
    $ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "leave_id=".$leave_id."&status=".$status_id."&reason=sdsd");
	$response = curl_exec($ch);
	curl_close($ch);

  
      // $ch = curl_init();
      // $timeout = 5;
      // curl_setopt($ch,CURLOPT_URL,$url);
      // curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
      // curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
      // $data = curl_exec($ch);
      // curl_close($ch);
      return json_decode($response, true);  
  }

  public function get_arrival_departure_data($busid, $startdate, $enddate){

      $config = file_get_contents("Assets/configuration.txt");
      $url=$config.'ArrivalDeparture_api/ArrivalDepartureList/bus_id/'.$busid.'/from_date/'.$startdate.'/to_date/'.$enddate;
      $ch = curl_init();
      $timeout = 5;
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
      $data = curl_exec($ch);
      curl_close($ch);
      return json_decode($data, true);          

  }

    public function get_spare_buses(){
          $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'BusList_api/listSpareBuses';
          $ch = curl_init();
          $timeout = 5;

          curl_setopt($ch,CURLOPT_URL,$url);
          curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
          curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
          $data = curl_exec($ch);
          curl_close($ch);
          return json_decode($data, true);

      } 

      public function bus_transfer_update($bus_from,$bus_to){
          $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'BusList_api/reassignBus';
           $ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "from_bus_id=".$bus_from."&to_bus_id=".$bus_to);
			$data = curl_exec($ch);
			curl_close($ch);
          return json_decode($data, true);

      } 


      public function get_incident_details($from_date, $to_date, $bus_id){
          $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Incidents_api/listIncident/from_date/'.$from_date.'/to_date/'.$to_date.'/bus_id/'.$bus_id;
              $ch = curl_init();
              $timeout = 5;
              curl_setopt($ch,CURLOPT_URL,$url);
              curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
              curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
              $data = curl_exec($ch);
              curl_close($ch);
            return json_decode($data, true);

  }

  public function get_incident_edit($id){
          $config = file_get_contents("Assets/configuration.txt");
          $url=$config.'Incidents_api/listIncidentById/id/'.$id;
              $ch = curl_init();
              $timeout = 5;
              curl_setopt($ch,CURLOPT_URL,$url);
              curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
              curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
              $data = curl_exec($ch);
              curl_close($ch);
            return json_decode($data, true);

  }
	//updalod file by API
	public function upload_file_api($upload_path,$file_tmp_name,$file_type,$file_name){
		$config = file_get_contents("Assets/configuration.txt");
		$url=$config.$upload_path;
		
		$img=curl_file_create($file_tmp_name, $file_type, basename($file_name));
		$fileData = array(
			'image' => $img
		);
		
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fileData);
		$data = curl_exec($ch);
		curl_close($ch);

		$data = json_decode($data, true);
		
		if($data['responsecode']==1){
			$data1=$data['result_arr'];
			$file_name = array_column($data1, 'file_name');
			return $file_name[0];
		}else{
			return false;
		}
	}
  
	public function get_exit_reentry_list($status){
		
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		
		$this -> db -> select('*');	 
		$this -> db -> from('exit_re_entries');
		$this -> db -> where('emp_id',$user_id);
		$this -> db -> where('emp_type',$user_type);
		if($status!=0){
			$this -> db -> where('status',$status);
		}
		$query = $this -> db -> get();

		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
}

?>  