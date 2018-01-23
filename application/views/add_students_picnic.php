<!DOCTYPE html>
<html>
<head>

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
<body >
    <div id="wrapper">
        <?php include 'sidebar.php' ?>
        <section class="main-section">
            <div class="content">
                <div class="form-group">
                    <button id="menuToggler" style="background-color: white;border-color: transparent;"><span class="glyphicon glyphicon-list" style="color: #2196f3;margin-right:10px"></span><strong style="font-size:18px">ADD STUDENTS FOR PICNIC</strong></button>
                </div>
            </div>
        </section>
        <?php $picnic= $this->db->get_where('picnic' , array('picnic_id' => $picnic_id))->result_array();
        foreach ($picnic as $row) {
            $title= $row['title'];
            $location= $row['latitude'].', '.$row['longitude'];
            $total_students= $row['total_students'];
        }
        ?>

        <div class="container-fluid" >
            <div class="panel panel-primary">
                <div class="panel-heading" style="height: 40px">
                    <div id="mytext" style="font-size: 20px;margin-left: 10px; position: relative; top: 50%; transform: translateY(-50%); -webkit-transform: translateY(-50%);">Picnic Details</div>
                </div>
                <div class="panel-body">
                    <form class="form-inline" method="POST" action="<?php echo site_url('Welcome/AddRoute');?>">
                        <div class="form-group col-md-4">
                            <label style="margin-right:5px;margin-left:5px">Title:</label>
                            <input class="form-control" style="margin-right:5px;margin-left:5px;width: 100%" type="text" name="title"  disabled value="<?php echo $title;?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label style="margin-right:5px;margin-left:5px">Location:</label>
                            <input class="form-control" style="margin-right:5px;margin-left:5px;width: 100%" type="text" name="location"  value="<?php echo $location;?>" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label style="margin-right:5px;margin-left:5px">Total Students:</label>
                            <input class="form-control" style="margin-right:5px;margin-left:5px;width: 100%" type="text" name="total_students"  value="<?php echo $total_students;?>" disabled>
                        </div>
                    </form>   

                </div>
            </div>

        </div>

        <div class="container-fluid" >
            <div class="panel panel-primary">
                <div class="panel-heading" style="height: 40px">
                    <div id="mytext" style="font-size: 20px;margin-left: 10px; position: relative; top: 50%; transform: translateY(-50%); -webkit-transform: translateY(-50%);">Select Criteria</div>
                </div>
                <div class="panel-body">
                    <form class="form-inline" action="">
                        <div class="form-group col-md-4">
                            <label style="margin-right:5px;margin-left:5px">Class:</label>
                            <select name="class" id='class' class="form-control" style="width:100%;"  onchange="return get_class_sections(this.value)">
                                <option value="">Select Class</option>
                                <?php 
                                $class = $this->db->get('class')->result_array();
                                foreach($class as $row2):
                                    ?>
                                <option value="<?php echo $row2['class_id'];?>"><?php echo $row2['name'];?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label style="margin-right:5px;margin-left:5px">Section:</label>
                            <select name="section" class="form-control" style="width:100%;" id='section'  disabled>
                                <option value="">Select Class First</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label style="margin-right:5px;margin-left:5px"></label>
                            <button id="addRoute" type="button" onclick="call_ajax()" class="btn btn-primary btn-md" >Get Students</button>
                        </div>
                    </form>   

                </div>
            </div>

        </div>
        

        <div class="container-fluid" >
            <form method="POST" action="<?php echo site_url('Welcome/picnic_insert_selected');?>">
              <div class="table-responsive">
                <div class="col-md-12" style="height:40px;background-color:steelblue;color:white">
                  <div id="mytext" style="font-size: 20px;margin-left: 10px; position: relative; top: 50%; transform: translateY(-50%); -webkit-transform: translateY(-50%);">Select Students</div>
              </div>
              <table class="table table-bordered" id="docsTable" style="text-align:center">
                  <thead>
                     <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">
                         <input type="checkbox"  name='select_all' id='checkAll' value='' /></td> 
                         <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">ID</td>
                         <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Name</td>
                         <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Class</td>
                         <td style="text-align:center;background:#4da6ff;color:white;opacity:0.8">Section</td>

                     </thead>
                     <tbody id='students_table'>

                     </table>
                 </div>
                 <input type="text" name="picnic_id" id="picnic_id" hidden value="<?php echo $picnic_id;?>">
                 <button type="submit" id="transferbtn" class="btn btn-primary pull-left col-md-2" disabled>Add Students</button>
                 

             </form>
             <a href="<?php echo site_url("Welcome/manage_picnic"); ?>">
                        <button class="btn btn-primary  pull-left col-md-2" style="margin-bottom: 10px; margin-right:20px; margin-left: 20px">Cancel</button>
                    </a>
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

            call_ajax_initial();


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

        function call_ajax(){

          var class_id=document.getElementById('class').value;
          var section_id=document.getElementById('section').value;
          var picnic_id=document.getElementById('picnic_id').value;
          //alert(class_id+section_id);
          var c = "class_id=" + class_id + "&section_id=" + section_id + "&picnic_id=" + picnic_id;
          $.ajax({
             url: "<?php echo site_url('Welcome/get_students_picnic')?>/",
             type: "POST",
             data: c,
             dataType:"JSON",
             success: function(a) {

              //$("#students_table").empty();
              if("nodata" == a[0].response){
                alert("No Data Found!")
              }
              else if("exists" == a[0].response){
                alert("All students from class already selected")
              }
              else
               drawTable(a)
          },
          error: function(a, b, c) {
             alert("Error get data from ajax")
         }
     });
    }

    function drawTable(a) {
        for (var b = 0; b < a.length; b++) drawRow(a[b])
    }

    function drawRow(a) { 

        var c = (a.student_id, $("<tr />"));
        var x= a.student_id +','+a.class_id+','+a.section_id;

        $("#students_table").append(c), c.append($("<td><input type='checkbox' id='check' name='checkbox[]' onclick='EnableTransbtn()' value='" + x + "'/></td>")), c.append($("<td>" + a.student_id + "</td>")), c.append($("<td>" + a.name + "</td>")), c.append($("<td>" + a.class_name + "</td>")), c.append($("<td>" + a.section_name + "</td>"));
    }


    function call_ajax_initial(){

          // var class_id=document.getElementById('class').value;
          var picnic_id=document.getElementById('picnic_id').value;
          //alert(picnic_id);
          // alert(class_id+section_id);
          var c = "picnic_id=" + picnic_id;
          $.ajax({
             url: "<?php echo site_url('Welcome/get_students_picnic_selected')?>/",
             type: "POST",
             data: c,
             dataType:"JSON",
             success: function(a) {

              //$("#students_table").empty();
              "nodata" == a[0].response ? alert("No Data Found!") : drawTable2(a);
              EnableTransbtn();
          },
          error: function(a, b, c) {
             alert("Error get data from ajax")
         }
     });
    }

    function drawTable2(a) {
        for (var b = 0; b < a.length; b++) drawRow2(a[b])
    }

    function drawRow2(a) { 

        var c = (a.student_id, $("<tr />"));
        var x= a.student_id +','+a.class_id+','+a.section_id;

        $("#students_table").append(c), c.append($("<td><input type='checkbox' checked id='check' name='checkbox[]' onclick='EnableTransbtn()' value='" + x + "'/></td>")), c.append($("<td>" + a.student_id + "</td>")), c.append($("<td>" + a.name + "</td>")), c.append($("<td>" + a.class_name + "</td>")), c.append($("<td>" + a.section_name + "</td>"));
    }


    function EnableTransbtn(){console.log($('input[type="checkbox"]:checked').serialize());
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
    1==checkedOne?document.getElementById("transferbtn").disabled=!1:document.getElementById("transferbtn").disabled=!0;  }

    $("#checkAll").click(function () {
       $('input:checkbox').not(this).prop('checked', this.checked);
       EnableTransbtn();
    });

</script>

<script type="text/javascript">
    function get_class_sections(class_id) {
        //alert(class_id);
        
        $.ajax({
            url: '<?php echo site_url();?>/Welcome/get_class_section/' + class_id ,
            async:false,
            success: function(response)
            {     
                //alert(response);          
                jQuery('#section').html(response);
                $("#section").prop("disabled",false);
            }
        });
    }

    function test() {

        var class_id=document.getElementById('class').value;
        var section_id=document.getElementById('section').value;
        alert(class_id);
        
        
    }
</script>
</body>
</html>


