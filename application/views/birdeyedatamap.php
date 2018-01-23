<?php //function getbirdeyeDetails(){ $config=file_get_contents("Assets/configuration.txt"); $url=$config.'BusCoordinates_api/getAllBusCoordinates'; $ch=curl_init(); $timeout=5; curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); $data=curl_exec($ch); curl_close($ch); return $data; } function getbirdeyeDetails1(){ $config=file_get_contents("Assets/configuration.txt"); $url=$config.'BusCoordinates_api/getAllBusCoordinates'; $ch=curl_init(); $timeout=5; curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); $data=curl_exec($ch); curl_close($ch); return $data; } function getallStudentsDetailsByRoute($routename_id){ $config=file_get_contents("Assets/configuration.txt"); $url=$config.'GetRouteDetails_api/StopsListByRoute/route_id/'.$routename_id; $ch=curl_init(); $timeout=5; curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); $data=curl_exec($ch); curl_close($ch); return $data; } function getallStudentsDetails($trip_type){ $config=file_get_contents("Assets/configuration.txt"); $url=$config.'Students_api/allStudents/trip_type/'.$trip_type; $ch=curl_init(); $timeout=5; curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); $data=curl_exec($ch); curl_close($ch); return $data; } function getallTeachersDetails(){ $config=file_get_contents("Assets/configuration.txt"); $url=$config.'Students_api/allTeachers'; $ch=curl_init(); $timeout=5; curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); $data=curl_exec($ch); curl_close($ch); return $data; } function getTripDetails(){ $config=file_get_contents("Assets/configuration.txt"); $url=$config.'GetRouteDetails_api/RoutesListStops'; $ch=curl_init(); $timeout=5; curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); $data=curl_exec($ch); curl_close($ch); return $data; } 
?>

<?php
function getbirdeyeDetails()
{
    $config  = file_get_contents("Assets/configuration.txt");
    $url     = $config . 'BusCoordinates_api/getAllBusCoordinates';
    $ch      = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
function getbirdeyeDetails1()
{
    $config  = file_get_contents("Assets/configuration.txt");
    $url     = $config . 'BusCoordinates_api/getAllBusCoordinates';
    $ch      = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
function getallStudentsDetailsByRoute($routename_id)
{
    $config  = file_get_contents("Assets/configuration.txt");
    $url     = $config . 'GetRouteDetails_api/StopsListByRoute/route_id/' . $routename_id;
    $ch      = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
function getallStudentsDetails($trip_type)
{
    $config  = file_get_contents("Assets/configuration.txt");
    $url     = $config . 'Students_api/allStudents/trip_type/' . $trip_type;
    $ch      = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
function getallTeachersDetails()
{
    $config  = file_get_contents("Assets/configuration.txt");
    $url     = $config . 'Students_api/allTeachers';
    $ch      = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
function getTripDetails()
{
    $config  = file_get_contents("Assets/configuration.txt");
    $url     = $config . 'GetRouteDetails_api/RoutesListStops';
    $ch      = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
?>
