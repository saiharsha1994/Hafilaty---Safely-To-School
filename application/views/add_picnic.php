<!DOCTYPE html>
<html>
<head>
  <?php echo $map['js']; ?>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
  <!-- font Awesome CSS -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <!-- Main Styles CSS -->
  <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
  
  <link href="<?php echo base_url('Assets/CSS/sidebar.css')?>" rel="stylesheet">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">




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
<body onload="initialize()">
    <div id="wrapper">
        <?php include 'sidebar.php' ?>
        <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">ADD PICNIC</strong></button>
                </div>
            </div>
        </section>
        <div class="container-fluid">
            <div class="col-md-7">

                <div style="display: flex;align-items: center;margin-bottom: 15px">
                    <label class="control-label col-md-1" style="text-align: center;">Search</label>
                    <div class="col-md-11" >

                    <input type="text" class="form-control" name="search" id='search'>
                    </div>
                </div>
                <div style="height:40px;color:white;background:steelblue;"><div id="mytext" style="font-size: 20px;margin-left: 10px; position: relative; top: 50%; transform: translateY(-50%); -webkit-transform: translateY(-50%);">Select Location</div></div>
                <div id="dvMap" style="width: 100%;height: 600px;border:1px solid steelblue">
                    <?php echo $map['html']; ?> 
                </div>


            </div>
            <div class="col-md-5" style="border:1px solid steelblue;margin-bottom: 10px">



                <form class="form-horizontal" method="POST" action="<?php echo site_url('Welcome/add_new_picnic');?>">

                    <div class="form-group" style="margin-top: 20px">
                        <label class="control-label col-sm-4">Title</label>
                        <div class="col-sm-6">          
                            <input type="text" class="form-control" name="title"  required>
                        </div>
                        <div class="col-sm-2"></div>

                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-4">From Date</label>
                        <div class="col-sm-6">          
                            <input type="text" class="form-control" name="from_date" id="from_date"  required>
                        </div>
                        <div class="col-sm-2"></div>

                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-4">To Date</label>
                        <div class="col-sm-6">          
                            <input type="text" class="form-control" name="to_date" id="to_date"  required>
                        </div>
                        <div class="col-sm-2"></div>

                    </div>
                    <hr></hr>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Pickup Time</label>
                        <div class="col-sm-6">          
                        </div>
                        <div class="col-sm-2"></div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-5">From Time</label>
                        <div class="col-sm-5">          
                            <input  class="form-control timepicker timepicker-with-dropdown" name="pickup_from_time"  required>
                        </div>
                        <div class="col-sm-2"></div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-5">To Time</label>
                        <div class="col-sm-5">          
                            <input  class="form-control timepicker timepicker-with-dropdown" name="pickup_to_time"  required>
                        </div>
                        <div class="col-sm-2"></div>

                    </div>
                    <hr></hr>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Drop Time</label>
                        <div class="col-sm-6">          
                        </div>
                        <div class="col-sm-2"></div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-5">From Time</label>
                        <div class="col-sm-5">          
                            <input  class="form-control timepicker timepicker-with-dropdown" name="drop_from_time"  required>
                        </div>
                        <div class="col-sm-2"></div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-5">To Time</label>
                        <div class="col-sm-5">

                            <input  class="form-control timepicker timepicker-with-dropdown" name="drop_to_time"  required>
                        </div>
                        <div class="col-sm-2"></div>
                        </div>

                        <hr></hr>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Location</label>
                        <div class="col-sm-6">          
                        </div>
                        <div class="col-sm-2"></div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-5">Latitude</label>
                        <div class="col-sm-5">          
                            <input type="text" class="form-control" name="latitude" id='latitude' required>
                        </div>
                        <div class="col-sm-2"></div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-5">Longitude</label>
                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="longitude" id='longitude' required>
                        </div>
                        <div class="col-sm-2"></div>
                        </div>


                  <div class="col-md-6">
                    <button class="btn btn-primary btn-md" id="save" type='submit' >Submit</button></div>
                </form>
                <div class="col-md-6">
                    <a href="<?php echo site_url("Welcome/manage_picnic"); ?>">
                        <button class="btn btn-primary btn-md" style="margin-bottom: 10px">Cancel</button>
                    </a>
                </div>




            </div>

        </div>
    </div>
    

    <!-- Bootstrap JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="<?php echo base_url('Assets/Javascripts/main.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/custom.js');?>"></script>
    <script src="<?php echo base_url('Assets/Javascripts/script.js');?>"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    
    <script>

        $(document).ready(function() {
            // Call Menu Toggler
            appMaster.menuToggler();
            
            

            $('.timepicker').timepicker({
                timeFormat: 'hh:mm p',
                interval: 60,
                minTime: '03:00am',
                maxTime: '10:00pm',
                defaultTime: '04:00an',
                dynamic: true,
                dropdown: true,
                scrollbar: true
            });

            $("#from_date").datepicker();

            $("#to_date").datepicker();


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
        var geocoder;
        function initialize() {
            geocoder = new google.maps.Geocoder();
             $('#wrapper').toggleClass('toggled');
        }
        var markers=[];
        function makemarker(lat,lng,latLng){
            clearmarkers();
            alert(latLng);

            var markerOptions = {
                map: map,
                position: latLng      
            };

            new_marker1 = createMarker_map(markerOptions);
            markers.push(new_marker1);
            document.getElementById('latitude').value=lat;
            document.getElementById('longitude').value=lng;
        }



        function clearmarkers(){
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers.length = 0;
        }


        function makemarkertext(){
            clearmarkers();

            var add=document.getElementById('search').value;


            geocoder.geocode( { 'address': add}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                alert(results[0].geometry.location);
            //alert(results[0].geometry.location.lat());
            var markerOptions = {
                map: map,
                position: results[0].geometry.location      
            };

            new_marker1 = createMarker_map(markerOptions);
            markers.push(new_marker1);
            document.getElementById('latitude').value=results[0].geometry.location.lat();
            document.getElementById('longitude').value=results[0].geometry.location.lng();
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
        // var markerOptions = {
        //     map: map,
        //     position: add     
        // };

        //  new_marker1 = createMarker_map(markerOptions);
        //  markers.push(new_marker1);
    }
</script>
</body>
</html>


