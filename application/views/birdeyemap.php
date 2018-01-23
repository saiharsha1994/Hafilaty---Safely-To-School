<?php $school=$school[0]; $rad=$rad[0]; $speed_lmt=$speedlimit[0]; $schoolName=$scname[0]; 
//echo $school.'<br/>'.$rad.'<br/>'.$speed_lmt.'<br/>'.$schoolName.'<br/>';
?>
<?php include 'birdeyedatamap.php';?>
<!DOCTYPE html>
<html>
 <head>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
     <link href="<?php echo base_url('Assets/CSS/sidebar.css')?>" rel="stylesheet">
 </head>
 <body onload="active()">
    <div id="wrapper">
       <?php include 'sidebar.php' ?>
        <section class="main-section">
<div class="content">
<div class="form-group">
<button id="menuToggler" style="background-color:white;border-color:transparent"><span class="glyphicon glyphicon-list" style="color:#2196f3;margin-right:10px"></span><strong style="font-size:18px">DASHBOARD</strong></button>
</div>
</div>
</section>
    <div class="container-fluid" >
        <div class="col-sm-3" >
            <div class="col-sm-12" style="height:35px;background:steelblue;margin-bottom:10px;font-size:18px; border-radius: 5px;
                color:white">BUS LIST</div>
                <div class="jumbotron" id="one" style="font-size:16px;">
                    <script type="text/javascript">
                    function mydiv(){
						
						for(var a=0;a<markers.length;a++)
							dynDiv=document.createElement("div"),
							dynDivnew=document.createElement("div"),
							dynDiv.id="divDyna"+a,
							dynDiv.class="col-sm-12",
							dynDivnew.class="col-sm-12",
							dynDiv.innerHTML=" VEHICLE ID : "+markers[a].driver_id+
											"<br> DRIVER : "+markers[a].driver_name+
											"<br> MOBILE : "+markers[a].driver_mobile,
							dynDivnew.innerHTML=" Route Details",
							dynDivnew.style.color="white",
							dynDiv.style.overflow="hidden",
							dynDiv.style.padding="10px",
							dynDivnew.style.overflow="hidden",
							dynDiv.style.margin="0px 0px 10px 0px",
							dynDiv.style.backgroundColor="white",
							dynDiv.style.fontSize="15px",
							dynDivnew.style.fontSize="20px",
							dynDivnew.style.textAlign="center",
							dynDivnew.style.borderRadius="0px 0px 0px 0px",
							dynDivnew.style.margin="5px 0px 0px 0px",
							dynDivnew.style.backgroundColor="#39ac39",
							dynDiv.style.border="solid #39ac39",
							dynDiv.style.borderRadius="0px 0px 5px 5px",
							document.getElementById("one").appendChild(dynDivnew),
							document.getElementById("one").appendChild(dynDiv)
					}
					var dynDiv,dynDivnew;
        </script>
    </div>
</div>
    
    <div class="col-sm-9">
        <script type="text/javascript">
           function detectmob(){navigator.userAgent.match(/Android/i)||navigator.userAgent.match(/webOS/i)||navigator.userAgent.match(/iPhone/i)||navigator.userAgent.match(/iPad/i)||navigator.userAgent.match(/iPod/i)||navigator.userAgent.match(/BlackBerry/i)||navigator.userAgent.match(/Windows Phone/i),$("#wrapper").toggleClass("toggled")}var data,markers,zoom_track=0,map,markers_track_count=0,marker,myLatlng,infoWindow,mapOptions,loc,divchild,x,y,latlngbounds,trafficLayer,bounds,data,schoolLoc,sum,c,color_child,rad,scname,driverimage,geocoder,infowindow,markerSc,gmarkers=[];
            function myFunction() {active(),rad="<?php echo $rad; ?>",scname="<?php echo $schoolName; ?>";var school="<?php echo $school; ?>",res=school.split(","),data_test={result_arr:[{latitude:res[0],langitude:res[1]}]};schoolLoc=data_test.result_arr;
                    data = <?php echo getbirdeyeDetails(); ?>;
                 1==data.responsecode?(markers=[],zoom_track=0,markers=data.result_arr):(zoom_track=1,markers=data_test.result_arr),mydiv(),LoadMap(markers);
                    
            }
            window.onload=function(){detectmob(),myFunction()};
       function LoadMap(a){mapOptions={center:new google.maps.LatLng(a[0].latitude,a[0].langitude),Zoom:16,mapTypeId:google.maps.MapTypeId.ROADMAP},map=new google.maps.Map(document.getElementById("dvMap"),mapOptions),map.setOptions({minZoom:3}),loc=[],divchild=[],x=0,y=1,infoWindow=new google.maps.InfoWindow,latlngbounds=new google.maps.LatLngBounds,trafficLayer=new google.maps.TrafficLayer,trafficLayer.setMap(map);new google.maps.Circle({strokeColor:"#FF0000",strokeOpacity:.8,strokeWeight:2,fillColor:"#ffffff",fillOpacity:.35,opacity:.9,map:map,center:new google.maps.LatLng(schoolLoc[0].latitude,schoolLoc[0].langitude),radius:rad*1000});markerSc=new google.maps.Marker({position:new google.maps.LatLng(schoolLoc[0].latitude,schoolLoc[0].langitude),map:map,title:scname}),setMarker()}function setMarker(){for(var a=0;a<markers.length;a++){data=markers[a],myLatlng=new google.maps.LatLng(data.latitude,data.langitude),loc[a]=myLatlng,x+=y,divchild[a]=x,y<2&&y++;var b=new Date,c=b.getDate(),d=b.getMonth()+1,e=b.getFullYear();c<10&&(c="0"+c),d<10&&(d="0"+d);var b=e+"-"+d+"-"+c;data.date===b?(cur_speed=data.cur_speed,getDistanceFromLatLonInKm(data.latitude,data.langitude,schoolLoc[0].latitude,schoolLoc[0].langitude)>"<?php echo $rad; ?>"?(marker=new google.maps.Marker({position:myLatlng,map:map,icon:"<?php echo base_url('Assets/images/rred_bus.png');?>"}),gmarkers.push(marker)):cur_speed>parseInt("<?php echo $speed_lmt;?>")?(marker=new google.maps.Marker({position:myLatlng,map:map,icon:"<?php echo base_url('Assets/images/rred_bus.png');?>"}),gmarkers.push(marker)):(marker=new google.maps.Marker({position:myLatlng,map:map,icon:"<?php echo base_url('Assets/images/green_bus.png');?>"}),gmarkers.push(marker)),cur_speed>parseInt("<?php echo $speed_lmt;?>")&&alert("Driver Exceeded Speed limit. \nCurrent speed is "+cur_speed)):(marker=new google.maps.Marker({position:myLatlng,map:map,icon:"<?php echo base_url('Assets/images/gray_bus.png');?>"}),gmarkers.push(marker)),function(a,c){geocoder=new google.maps.Geocoder,infowindow=new google.maps.InfoWindow,sum=0,1==zoom_track&&map.setZoom(15),google.maps.event.addListener(a,"click",function(d){var e=c.trip_type;e="2"===e?"Drop":"Pick Up",geocoder.geocode({location:a.position},function(d,f){var g="http://demo.schoooly.com/uploads/driver_image/";c.date===b?infowindow.setContent("photo : <img class='center-block' src='"+g.concat(c.driver_image)+"' width='100px' height='80px'><br><b>Driver Name : </b>"+c.driver_name+"<br><b>Driver Mobile : </b> "+c.driver_mobile+"<br><b>Trip Type : </b>"+e+"<br><b>Total Students : </b> "+c.no_of_students+"<br><b>Present : </b>"+c.no_of_present+"<br><b>Absent : </b>"+c.no_of_absent+"<br><b>Current Speed : </b>"+c.cur_speed+" KMPH"):infowindow.setContent("photo : <img class='center-block' src='"+g.concat(c.driver_image)+"' width='100px' height='80px'><br><b>Driver name :</b> "+c.driver_name+"<br><b>Driver Mobile : </b> "+c.driver_mobile+"<br><b>STATUS : </b>TODAY - BUS NOT STARTED YET"),infowindow.open(map,a)})}),google.maps.event.addListener(a,"mouseout",function(a){infowindow.close()})}(marker,data),latlngbounds.extend(marker.position),1==zoom_track&&marker.setZoom(15)}bounds=new google.maps.LatLngBounds,map.fitBounds(latlngbounds,map.getBoundsZoomLevel(latlngbounds))}setInterval(function(){markers=[],$.ajax({url:"<?php echo site_url('Welcome/coordinateUpdate')?>",type:"GET",dataType:"JSON",success:function(a){for(i=0;i<gmarkers.length;i++)gmarkers[i].setMap(null);markers=[],loc=[],markers=a.result_arr,setMarker()},error:function(a,b,c){}})},5e3);
  
           
    </script>

        <div style="height:35px;color:white;background:steelblue;"><p style="margin-left:10px;font-size:20px">LIVE MAP</p></div>
        <div id="dvMap" style="width: 100%;height: 550px;border:1px solid steelblue">
        </div>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLD7VGVRwDdigtG23zFKUyVfN0g5e0Lz8&callback=initMap">
    </script>
            </div>
        </div>
        <h5 style="text-align:center">copyright@VT</h5>
    </div>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
<script type="text/javascript">
    function active(){$(".main-nav li").removeClass("active"),$("#dashboardid").addClass("active")}function getDistanceFromLatLonInKm(a,b,c,d){var f=deg2rad(c-a),g=deg2rad(d-b),h=Math.sin(f/2)*Math.sin(f/2)+Math.cos(deg2rad(a))*Math.cos(deg2rad(c))*Math.sin(g/2)*Math.sin(g/2);return 2*Math.atan2(Math.sqrt(h),Math.sqrt(1-h))*6371}function deg2rad(a){return a*(Math.PI/180)}$(document).ready(function(){appMaster.menuToggler(),appMaster.anotherFunction()});
    </script>
 </body>
</html>