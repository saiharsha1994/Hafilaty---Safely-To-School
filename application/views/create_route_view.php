<?php 
foreach ($routename as $row) {
    $routename_id=$row;
}
foreach ($type as $row) {
    $trip_type=$row;
}
foreach ($school as $row) {
   $school=$row;
}

foreach ($cur_bus as $row) {
   $bus_cur=$row;
  
}
foreach ($cur_driver as $row) {
   $driver_cur=$row;
   
}
$schoolName=$scname[0];


 ?>

<?php include 'birdeyedatamap.php';?>
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
    <link href="<?php echo base_url('Assets/CSS/sidebar.css')?>" rel="stylesheet">

    <style type="text/css">
/*style the box*/  
         .gm-style .gm-style-iw {
            
        font-family: 'Open Sans Condensed', sans-serif;
   font-size: 13px;
            padding: 10px;
            
         }    
     
         /*style the p tag*/
         .gm-style .gm-style-iw #google-popup p{
            padding: 10px;
         }
        .main-nav > li:hover{background-color:#1976d2;}
        li.active {background: #1976d2;}
        .btn-md {width: 100%;}
        .jumbotron{background: white}
        .panel{border-radius:0px;}
        .panel-heading{border-radius:0px;}
        #scrollbox3 {
            overflow: auto;
            height: 300px;
            padding: 0 5px;
            border: 1px solid white;
        }
    </style>
    
  
  </head>
  <body>
        <div id="wrapper">
        <?php include 'sidebar.php' ?>
          <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">CREATE ROUTE</strong></button>
                </div>
            </div>
        </section>
        <div class="container-fluid">
            <div class="col-sm-9">
                
                <script type="text/javascript">
            var data;var markers;var loc = [];var markers_track;var asain;
            var student_track;var clickmarkertrack=[];var updateFinally=[];var infoWindow;var schoolLoc;
            var teacher_track;var f=0;var markerSc;var scname;var mouseoutTrack=0;var count_li=0;
            var addordel=0;
            function detectmob() { 
                if( navigator.userAgent.match(/Android/i)
                    || navigator.userAgent.match(/webOS/i)
                    || navigator.userAgent.match(/iPhone/i)
                    || navigator.userAgent.match(/iPad/i)
                    || navigator.userAgent.match(/iPod/i)
                    || navigator.userAgent.match(/BlackBerry/i)
                    || navigator.userAgent.match(/Windows Phone/i)
                ){
                    $('#wrapper').toggleClass('toggled');
                }
                else {
                    $('#wrapper').toggleClass('toggled');
                }
            }
            function myFunction() {
                var school="<?php echo $school; ?>";
                        var res = school.split(",");
                        var data_test={"result_arr":[{"latitude":res[0],"langitude":res[1]}]};
            schoolLoc=data_test['result_arr'];
            scname="<?php echo $schoolName; ?>";
                data=[];
                /*
                for detecting students/teacher already in route
                */
                data1 = <?php echo getallStudentsDetailsByRoute($routename_id); ?>;
                if(data1['responsecode'] == 1){
                    data=data1['result_arr'];
                    /*
                        for all students
                    */
                    data2= <?php echo getallStudentsDetails($trip_type); ?>;
                    /*
                        for all teacher
                    */
                    data3= <?php echo getallTeachersDetails(); ?>;
                    /*
                        getting trip detaills
                    */
                    data4=<?php echo getTripDetails(); ?>;
                    data_trip=data4['result_arr'];
                    for(var j=0;j<data_trip.length;j++){
                        var data_trip_track=data_trip[j];
                        if(data_trip_track.route_id == <?php echo $routename_id;?>){
                            if(data_trip_track.trip_type==1){
                                asain=1;
                            }else{
                                asain=2;
                            }
                        }
                    }
                

                    if(asain==1){
                    data2['result_arr'].sort(function(a, b){
                        return a.pickup_route_id-b.pickup_route_id
                    })
                    data3['result_arr'].sort(function(a, b){
                        return a.pickup_route_id-b.pickup_route_id
                    })
                }else{
                    data2['result_arr'].sort(function(a, b){
                        return a.drop_route_id-b.drop_route_id
                    })
                    data3['result_arr'].sort(function(a, b){
                        return a.drop_route_id-b.drop_route_id
                    })
                }
				
                    console.log("Heiai it is gere");
                    console.log(JSON.stringify(data2['result_arr']));
                    markers_track=Object.keys(data).length;
                    markers_test=data.concat(data2['result_arr']);
                    markers_track_data3=Object.keys(markers_test).length;
                    markers=markers_test.concat(data3['result_arr']);
                    

                }else{

                    data2= <?php echo getallStudentsDetails($trip_type); ?>;
                    data3= <?php echo getallTeachersDetails(); ?>;
                    data4=<?php echo getTripDetails(); ?>;
                    data_trip=data4['result_arr'];
					
					console.log("myfunction",data_trip.length);
                    for(var k=0;k<data_trip.length;k++){
                        var data_trip_track=data_trip[k];
                        if(data_trip_track.route_id == <?php echo $routename_id;?>){
                            if(data_trip_track.trip_type == 1){
                                asain=1;
                            }else{
                                asain=2;
                            }
                        }
                    }
                    if(asain==1){
                    data2['result_arr'].sort(function(a, b){
                        return a.pickup_route_id-b.pickup_route_id
                    })
                    data3['result_arr'].sort(function(a, b){
                        return a.pickup_route_id-b.pickup_route_id
                    })
                }else{
                    data2['result_arr'].sort(function(a, b){
                        return a.drop_route_id-b.drop_route_id
                    })
                    data3['result_arr'].sort(function(a, b){
                        return a.drop_route_id-b.drop_route_id
                    })
                }

                var data2_check=data2['result_arr'];
                var data2_check_count=data2_check[0];
                var add;
                if(asain==1 && data2_check_count.pickup_route_id == 0){
                    markers_track=0;
                    markers=data2['result_arr'].concat(data3['result_arr']);
                    markers_track_data3=Object.keys(data2['result_arr']).length;
                }
                if(asain==1 && data2_check_count.pickup_route_id!=0){
                    markers_track=0;
                    markers=data3['result_arr'].concat(data2['result_arr']);
                    markers_track_data3=Object.keys(data3['result_arr']).length;
                }
                if(asain==2 && data2_check_count.drop_route_id == 0 ){
                    markers_track=0;
                    markers=data2['result_arr'].concat(data3['result_arr']);
                    markers_track_data3=Object.keys(data2['result_arr']).length;
                }
                if(asain==2 && data2_check_count.drop_route_id!=0){
                    markers_track=0;
                    markers=data3['result_arr'].concat(data2['result_arr']);
                    markers_track_data3=Object.keys(data3['result_arr']).length;
                }

                    

                }
                    LoadMap();
                    
            }
            window.onload = function () {
                    detectmob();
                    myFunction();
            }
            
            function LoadMap() {
                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;
                    var mapOptions = {
                         center: new google.maps.LatLng(markers[0].latitude, markers[0].langitude),
                    zoom: 6,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
            };
                    directionsDisplay.setMap(map);
                    var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
                    var divchild=[];
                    var x=0;y=1;
                    var infoWindow = new google.maps.InfoWindow();
                    var latlngbounds = new google.maps.LatLngBounds();
                    var trafficLayer = new google.maps.TrafficLayer();
                    trafficLayer.setMap(map);
					
					
                    //console.log("marker test",JSON.stringify(markers));
                    markerSc = new google.maps.Marker({
                                position: new google.maps.LatLng(schoolLoc[0].latitude,schoolLoc[0].langitude),
                                map: map,
                                 title:scname
                        });

                    
					//console.log("LoadMap",markers.length);
					
                    for (var i = 0; i < markers.length; i++) {
                        var data = markers[i];
                        
                        var myLatlng = new google.maps.LatLng(data.latitude, data.langitude);
                        loc[i]=new google.maps.LatLng(markers[i].latitude, markers[i].langitude);
                        var marker;
                        x=x+y;divchild[i]=x;
                        if(y<2){y++;}
					
                    if(asain == 1){
                        if(data.pickup_route_id!=0  && i<markers_track){
							marker = new google.maps.Marker({
								position: myLatlng,
								map: map,
								title:(i+1).toString(),
								icon: "<?php echo base_url('Assets/images/green_map.png');?>"
							});
						}

						
						
                    if(data.pickup_route_id == 0  && i>=markers_track && i<markers_track_data3){
                        
						if(data.hasOwnProperty('student_id')){
                        
						marker = new google.maps.Marker({
                            position: myLatlng,
                            map: map,
                            icon: "<?php echo base_url('Assets/images/selected_gray.png');?>"
                        });
						console.log(myLatlng);
						
                     }else{
                        marker = new google.maps.Marker({
                            position: myLatlng,
                            map: map,
                       
                            icon: "<?php echo base_url('Assets/images/teacher_icon.png');?>"
                        });
                     }
                    }

                    if(data.pickup_route_id == 0  && i>=markers_track_data3){
                        marker = new google.maps.Marker({
                            position: myLatlng,
                            map: map,
                            
                            icon: "<?php echo base_url('Assets/images/teacher_icon.png');?>"
                        });
                      }

                    }else{

                        if(data.drop_route_id!=0  && i<(markers_track) ){
                         marker = new google.maps.Marker({
                            position: myLatlng,
                            map: map,
                            title:(i+1).toString(),
                            icon: "<?php echo base_url('Assets/images/green_map.png');?>"
                        });
                     }


                    if(data.drop_route_id == 0  && i<=(markers_track_data3)){
                        if(data.hasOwnProperty('student_id')){
                        marker = new google.maps.Marker({
                            position: myLatlng,
                            map: map,
                            
                            icon: "<?php echo base_url('Assets/images/selected_gray.png');?>"
                        });

                     }else{
                        marker = new google.maps.Marker({
                            position: myLatlng,
                            map: map,
                            
                            icon: "<?php echo base_url('Assets/images/teacher_icon.png');?>"
                        });
                     }
                    }

                    if(data.drop_route_id == 0  && i>=markers_track_data3){
                        marker = new google.maps.Marker({
                            position: myLatlng,
                            map: map,
                          
                            icon: "<?php echo base_url('Assets/images/teacher_icon.png');?>"
                        });
                        }
                    }

            (function (marker, data) {
                var geocoder = new google.maps.Geocoder;
                var infowindow = new google.maps.InfoWindow;
                var sum=0;
               
                var stuteachr;
                var countersloc=0;var counterupdatepanel=0;
                var infoWindow = new google.maps.InfoWindow();
                stuteachr=data2['result_arr'].concat(data3['result_arr']);
                google.maps.event.addListener(marker, "click", function (e) {
                     clickmarkertrack=[];
                counterupdatepanel=0;
                var markerClicked=JSON.stringify(marker.position);
                var exist=0;

                 for(var k=0;k<stuteachr.length;k++){
                        clickmarkertrack[k]=new google.maps.LatLng(stuteachr[k].latitude, stuteachr[k].langitude);
                        if( JSON.stringify(marker.position) === JSON.stringify(clickmarkertrack[k])){
                                                updateFinally[counterupdatepanel]=clickmarkertrack[k];
                                                counterupdatepanel++;
                                                    
                            }
                    }
                    //alert(counterupdatepanel);
                 
                    if(sum==0){
                        
                        for(var j=0;j<=(markers_track-1);j++){
                            
                        if(JSON.stringify(marker.position) === JSON.stringify(loc[j])){
                            exist=1;
                            break;
                            }
                        }
                        if(exist==0){          
                                    if(counterupdatepanel==1){
                                        if(document.getElementById(data.assigned_to)===null){
                                                marker.setIcon("<?php echo base_url('Assets/images/green_map.png');?>");
                                        var textMore = "<input type='hidden' name='name_details[]' value='"+data.name+"' id='del'/><br/>";
                                            $("#ul").append("<li class=list-group-item id="+data.assigned_to+">"+data.name+textMore+"</li>");
                                            sum++;
                                        }
                                        
                                    }

                           if(counterupdatepanel>1){
                                        for(var x=0;x<(stuteachr.length);x++){
                                                if(JSON.stringify(marker.position) == JSON.stringify(clickmarkertrack[x])){
                                                    if(document.getElementById(stuteachr[x].assigned_to)===null){
                                                            var textMore = "<input type='hidden' name='name_details[]' value='"+stuteachr[x].name+"' id='del'/><br/>";
                                                    $("#ul").append("<li class=list-group-item id="+stuteachr[x].assigned_to+">"+stuteachr[x].name+textMore+"</li>");
                                                    marker.setIcon("<?php echo base_url('Assets/images/green_map.png');?>");
                                                    }
                                                    
                                                }
                                        }
                                        
                                        sum++;
                                        
                                    }
                                    // e.stopImmediatePropagation();
                    }else{
                         
                    

                                if (confirm("already in route.want to remove from current route?once deleted ,not possible to add again here!") == true) {

                                     if(counterupdatepanel==1){


                                        for(var x=0;x<(stuteachr.length);x++){
                                                                if(JSON.stringify(marker.position) == JSON.stringify(clickmarkertrack[x])){

                                                                    if(document.getElementById(stuteachr[x].assigned_to)!=null){
                                                                            $("#"+stuteachr[x].assigned_to).remove();
                                        marker.setIcon("<?php echo base_url('Assets/images/selected_gray.png');?>");
                                                 
                                                                    }


                                                                   //alert(stuteachr[x].assigned_to);
                                                                                       
                                                                }
                                                        }
                                        
                                        

                                        sum = 0;
                                        //e.stopImmediatePropagation();
                                        
                                    }else{
                                            for(var x=0;x<(stuteachr.length);x++){
                                                                if(JSON.stringify(marker.position) == JSON.stringify(clickmarkertrack[x])){

                                                                    if(document.getElementById(stuteachr[x].assigned_to)!=null){
                                                                            $("#"+stuteachr[x].assigned_to).remove();
                                                                     marker.setIcon("<?php echo base_url('Assets/images/selected_gray.png');?>");
                                                                    }
                                                                   
                                                                    
                                                                    
                                                                }
                                                        }
                                              
                                             sum = 0;
                                             //e.stopImmediatePropagation();
                                            

                                        }

                                        
                                } else {

               
                                }

                                                                   

                    }

                     //e.stopImmediatePropagation();
                    }else{
                        //alert("already added");

                        if(counterupdatepanel==1){

                            if(document.getElementById(data.assigned_to)!=null){
                                    $("#"+data.assigned_to).remove();
                        marker.setIcon("<?php echo base_url('Assets/images/selected_gray.png');?>");
                        //
                        sum = 0;
                            }

                                
                        
                        
                        }else{


                            for(var x=0;x<(stuteachr.length);x++){
                                                if(JSON.stringify(marker.position) == JSON.stringify(clickmarkertrack[x])){

                                                    if(document.getElementById(stuteachr[x].assigned_to)!=null){
                                                            $("#"+stuteachr[x].assigned_to).remove();
                                                     marker.setIcon("<?php echo base_url('Assets/images/selected_gray.png');?>");
                                                    }
                                                    //alert(stuteachr[x].assigned_to);
                                                                 
                                                    
                                                  
                                                    
                                                }
                                        }
                              
                             sum = 0;
                             //e.stopImmediatePropagation();

                             

                        }


                         
                        
                 }
                  
            });


google.maps.event.addListener(marker, "mouseover", function (e) {


                 infowindow = new google.maps.InfoWindow;
                 counterupdatepanel=0;
                 var countInfo=[];
                 var countInfotrack=0;
                // var markerClicked=JSON.stringify(marker.position);
                clickmarkertrack=[];
               
                    var k=0;
                    var infodata="";
                    var photo;
console.log("Heiai it is student teacher");
                         console.log(JSON.stringify(stuteachr));
                    while(k<stuteachr.length){
                        
                       clickmarkertrack[k]=new google.maps.LatLng(stuteachr[k].latitude, stuteachr[k].langitude);

                        if( JSON.stringify(marker.position) === JSON.stringify(clickmarkertrack[k])){


                                        if(stuteachr[k].hasOwnProperty('student_id')){
                                                photo="http://demo.schoooly.com/uploads/student_image/";
                                                stuteachr[k].contact_num=stuteachr[k].contact_num;
                                        }
                                        if(stuteachr[k].hasOwnProperty('teacher_id')){
                                        
                                                photo="http://demo.schoooly.com/uploads/teacher_image/";
                                                stuteachr[k].contact_num=stuteachr[k].mobile;
                                        }

                                        if(stuteachr[k].class_name===null || !stuteachr[k].class_name){
                                            stuteachr[k].class_name="---";
                                        }
                                        
                                        
                                        if(stuteachr[k].section_name===null || !stuteachr[k].section_name){
                                            stuteachr[k].section_name="---";
                                        }
                                        if(stuteachr[k].contact_num===null || !stuteachr[k].contact_num){
                                            stuteachr[k].contact_num="---";
                                        }

                                        var windowdata=""+"<img class='img-circle center-block' src='"+photo.concat(stuteachr[k].photo)+"' width='50px' height='50px'>"+"<br>"+"<b>Name :</b> "+stuteachr[k].name+"<br>"+"<b>Class :</b> "+stuteachr[k].class_name+" "+"<b>Section : </b>"+stuteachr[k].section_name+"<br>"+"<b>Contact Number :</b> "+stuteachr[k].contact_num+"<br>"+"----------------------------------<br>";
                                        infodata=infodata+windowdata;

                                         mouseoutTrack++;
                                            
                                                    
                            }
                            // console.log(k +infodata);
                            k++;
                    }
                     infowindow.setContent(infodata); 
                                         infowindow.open(map, marker); 
                 
                     
                   
            });
            

                google.maps.event.addListener(marker, "mouseout", function (e) {
                 infowindow.close();    
            });
               

            })(marker, data);
                latlngbounds.extend(marker.position);
                map.setCenter(new google.maps.LatLng(schoolLoc[0].latitude,schoolLoc[0].langitude));

        }


       

        var directionsService = new google.maps.DirectionsService();
       var newArray = loc.slice();
               if(asain==1){
                var i=0;
                var counter_arr=data1['result_arr'].length;
               }else{
                var i=0;
                var counter_arr=data1['result_arr'].length;
               }
       var origin = null;
        var destination = null;
        var waypts = [];
        var waypts1 = [];
    var tracker_c=Math.round(counter_arr/2);
       for(;i<=tracker_c;i++){
                    if(JSON.stringify(loc[i])!=JSON.stringify(loc[i+1])){
                    waypts.push({
                            location: loc[i],
                            stopover: true
                        });
                }
       }
       for(var k=tracker_c;k<counter_arr;k++){
                    if(JSON.stringify(loc[i])!=JSON.stringify(loc[i+1])){
                    waypts1.push({
                            location: loc[k],
                            stopover: true
                        });
                }
       }
     //    for(;i<=counter_arr;i++){
     //     if(i==data1['result_arr'].length-1 && asain==1){
     //         newArray[i+1]=new google.maps.LatLng(schoolLoc[0].latitude,schoolLoc[0].langitude);
     //     }


     //     if(i==-1 && asain!=1){
     //         newArray[-1]=new google.maps.LatLng(schoolLoc[0].latitude,schoolLoc[0].langitude);
     //     }
            // if(JSON.stringify(newArray[i])!=JSON.stringify(newArray[i+1])){
                for(var j=0;j<2;j++){
                    if(j==0){
                        var directionsDisplay = new google.maps.DirectionsRenderer({
    map: map,
    preserveViewport: true
  });
  
  directionsService.route({
        origin: loc[0],
        waypoints: waypts,
        destination: loc[tracker_c],
        travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      // directionsDisplay.setDirections(response);
      var polyline = new google.maps.Polyline({
        path: [],
        strokeColor: '#0000FF',
        strokeWeight: 3
      });
      var bounds = new google.maps.LatLngBounds();


      var legs = response.routes[0].legs;
      for (i = 0; i < legs.length; i++) {
        var steps = legs[i].steps;
        for (j = 0; j < steps.length; j++) {
          var nextSegment = steps[j].path;
          for (k = 0; k < nextSegment.length; k++) {
            polyline.getPath().push(nextSegment[k]);
            bounds.extend(nextSegment[k]);
          }
        }
      }

      polyline.setMap(map);
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
                    }else{

                        var directionsDisplay = new google.maps.DirectionsRenderer({
    map: map,
    preserveViewport: true
  });
  
  directionsService.route({
    origin: loc[tracker_c],
        waypoints: waypts1,
        destination: loc[counter_arr-1],
        travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      // directionsDisplay.setDirections(response);
      var polyline = new google.maps.Polyline({
        path: [],
        strokeColor: '#0000FF',
        strokeWeight: 3
      });
      var bounds = new google.maps.LatLngBounds();


      var legs = response.routes[0].legs;
      for (i = 0; i < legs.length; i++) {
        var steps = legs[i].steps;
        for (j = 0; j < steps.length; j++) {
          var nextSegment = steps[j].path;
          for (k = 0; k < nextSegment.length; k++) {
            polyline.getPath().push(nextSegment[k]);
            bounds.extend(nextSegment[k]);
          }
        }
      }

      polyline.setMap(map);
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
                    }
                
}

//              }else{

//              }
// }

                var bounds = new google.maps.LatLngBounds();
                map.setCenter(latlngbounds.getCenter());
                map.fitBounds(latlngbounds);
    }


            
    </script>

        <div style="height:35px;color:white;background:steelblue;"><p style="margin-left:10px;font-size:20px">LIVE MAP</p></div>
        <div id="dvMap" style="width: 100%;height: 550px;border:1px solid steelblue">
        </div>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLD7VGVRwDdigtG23zFKUyVfN0g5e0Lz8&callback=initMap">
    </script>
            </div>
            <div class="col-sm-3">
                
                    <div class="panel panel-primary" id="bodyDiv">
    <div class="panel-heading">Panel Heading</div>
    </div>
    <form class="form-horizontal" method="POST" action="<?php echo site_url('Welcome/updatedetailsinroute');?>">
    <input type="hidden" name="route_id_details" value=<?php echo $routename_id;?>>
    <input type="hidden" name="sc_lat_lon" value=<?php echo $school;?>>

    <div id="scrollbox3" style="margin-bottom:20px">
    <ul class="list-group" style="border:0px 1px 0px 0px" id="ul">
        <?php  
        $counter_for_list=0;
            foreach ($names as $row){

                ?>


                <script type="text/javascript">
                var id="<?php echo $assigned_to[$counter_for_list];?>";
                    var counter="<?php echo $row;?>";
                    var textMore = "<input type='hidden' name='name_details[]' value='"+counter+"' id='del'/><br/>";


                    $("#ul").append("<li class=list-group-item id='"+id+"' >"+counter+textMore+"</li>");
                    count_li++;

                </script>
                    <!-- <li class="list-group-item">
                
                <?php
                echo $row;
                ?>
                <input type="hidden" name="name_details[]" value='<?php echo $row; ?>'>
                
                </li> -->
                <?php
                $counter_for_list++;
            }
        ?>
</ul>
    </div>
    <div class="panel-heading">
                            <div class="form-group">
                            <select class="form-control" id="selectdriver" name="driver_name" onchange="alertCustomdriver()">
                            <option style="display: none;"><?php echo $driver_cur;?></option>
                              <?php 
                                  foreach ($h as $row) {
                              ?>
                                  <option><?php echo $row; ?></option>
                              <?php
                                  }
                              ?>
                            </select>
                           
                            </div>

                            <div class="form-group">
                            
                            <select class="form-control" id="selectbus" name="bus_id" onchange="alertCustombus()">
                            <option style="display: none;"><?php echo $bus_cur;?></option>
                              <?php 
                                  foreach ($h1 as $row) {
                              ?>
                                  <option><?php echo $row; ?></option>
                              <?php
                                  }
                              ?>
                            </select>
                            
                            </div>
                            
        </div>
<div class="col-sm-6">
        <button class="btn btn-primary btn-md" id="save"  >SAVE</button></div>
        </form>
        <div class="col-sm-6">
        <a href="<?php echo site_url("Welcome/routes"); ?>">
        <button class="btn btn-primary btn-md">CANCEL</button>
        </a>
        </div>

            </div>
            

        </div>

        </div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
<script>

        $(document).ready(function() {
            // Call Menu Toggler
            appMaster.menuToggler();
            // Example Call anotherFunction
            appMaster.anotherFunction();
        });

        function alertCustomdriver() {
            document.getElementById('selectdriver').style.border="1px solid red";
          alert("you are going to change the current driver");
        }
        function alertCustombus() {
            document.getElementById('selectbus').style.border="1px solid red";
          alert("you are going to change the current bus");
        }
    </script>
    <script type="text/javascript">
        /* $('#scrollbox2').enscroll({
            showOnHover: true,
            verticalTrackClass: 'track3',
    verticalHandleClass: 'handle3'
}); */
    </script>
  </body>
  </html>