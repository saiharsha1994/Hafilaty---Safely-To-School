
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADMIN:Login</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet"  href="<?php echo base_url();?>css/main.css">
    <script src="<?php echo base_url('Assets/Javascripts/sessionUtility.js');?>"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
      .form-control{border-color: #3399ff;height: 45px;}
      .input-group-addon{border-color: #3399ff;background-color: white;}
    </style>
  </head>

<body class="landing" background="<?php echo base_url('Assets/images/landing.png');?>">
    <div class="container" >
        <div class="col-sm-4" ></div>
            <div class="col-sm-4"  style="background-color: white ;border-radius: 10px;opacity:0.9;color: black;text-shadow: none;margin-top:150px" >
            <br>
             <h6 style="color:rgb(90,90,90);text-align:center;font-size:30px;font-family: sans-serif">Transport</h6>
            <h6 style="color:rgb(90,90,90);text-align:center;font-size:25px;font-family: Verdana">Admin</h6>
            <form style="margin-top: 40px" method="POST" action="<?php echo site_url("Welcome/login"); ?>">
              <div class="form-group">
                    <div class="input-group">
                          <span class="input-group-addon" >
                            <img src="<?php echo base_url('Assets/images/username.png');?>" width="20px" height="20px">
                                </span>
                            <input type="text" id="username" name="email" name="names" class="form-control" aria-describedby="basic-addon1" placeholder="Username/Email Id">
                    </div>
                    <div id="checkemail" style="color:red;font-size:15px;">
                      
                    </div>
              </div>
    

              <div class="form-group">
                    <div class="input-group">
                          <span class="input-group-addon" >
                            <img src="<?php echo base_url('Assets/images/password.png');?>" width="20px" height="20px">
                          </span>
                            <input type="password" id="password" name="password" class="form-control" aria-describedby="basic-addon1" placeholder="Password">
                    </div>
                    <div id="checkpassword" style="color:red;font-size:15px;"></div>
              </div>

                          <button id="demo" type="submit" onclick="return validateUser()" class="btn btn-primary btn-block" value="submit" style="height:45px">LOGIN</button>      
            </form>
                <br><br><br>
          </div>
        <div class="col-sm-4" ></div>
    </div>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>
        <script type="text/javascript">
            $('#username').on('keyup', function () {
              $('#checkemail').html('');
            });

            $('#password').on('keyup', function () {
              $('#checkpassword').html('');
            });
        </script>
</html>