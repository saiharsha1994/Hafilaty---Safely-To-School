

function validateUser() {
                var email  = document.getElementById("username").value;
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(email == ""){
                    $('#checkemail').html('username cannot be left blank');
                    return false;
                }
                if(!email.match(re)){
                    $('#checkemail').html('Invalid username');
                    return false;
                }


                var password = document.getElementById("password").value;
                if(password==""){
                    $('#checkpassword').html('please enter your password');
                    return false;
                }
  
                if(password.length<8){
                    document.getElementById("checkpassword").innerHTML="password should be atleast 8 character long";
                    return false;
                }  
               
                var data = null;

var xhr = new XMLHttpRequest();
xhr.withCredentials = true;
dataType:'jsonp';
xhr.addEventListener("readystatechange", function () {
  if (this.readyState === 4) {
    console.log(this.responseText);
   
  }
});

xhr.open("GET", "http://al-amaanah.com/Tifly_Pro/index.php?web_services/Transport_Admin_Login_api/Login/Email/harsha@valuetechsa.com/Password/test@123");
xhr.setRequestHeader("cache-control", "no-cache");
xhr.setRequestHeader("postman-token", "9d92c89e-81ea-b991-0f50-0d1f98c6dc3e");
xhr.send(data);
           }

//                  $.ajax({
//                        type: "GET",
//                        url: "http://al-amaanah.com/Tifly_Pro/index.php?web_services/Transport_Admin_Login_api/Login/Email/harsha@valuetechsa.com/Password/test@123/GCM_RegId/1234", 
//                        contentType: "application/json",
//                        timeout: 60000, // in milliseconds
//                        success: function(data) {
//                                   alert("success post");
// 					// //alert(JSON.stringify(data));

//      //                              var strstatus= "" + data.Status;
//      //                              var strtype= "" + data.Type;
//      //                              var strloginstat = "" + data.loginstatuss;

//      //                              if (strloginstat == "successful") {
                                    
//      //                                   //successful login
//      //                                   //alert("Login Successful " + strstatus + ":" + strtype + ":" + strloginstat);
//      //                                   storeUser(uname);
//      //                                   storeType(strtype);
//      //                                   storeStatus(strstatus);
//      //                                   //window.location.assign="index1.html";
                                       
//      //                                   window.location.assign("index1.html");



//                                   }

//                                   else {
//                                       //fail to login
//                                       //alert("Login Failure");
//                                       $('#statuss').html('username/password is incorrect').css('color','red');
//                                   }                                       
                        
//                          },
            
//                         error: function(request, status, err) {
//                         	// $('#statuss').html('username does not exist').css('color','red');
//                  alert("error");
                 
                 
//                         }
             
//                   });

// 	}


// // function clearUser() {


// //    sessionStorage.uname=null;
// //    sessionStorage.ustatus=null;
// //    sessionStorage.utype=null;

// // } 


// function storeUser(uvalue) {

//   sessionStorage.uname=uvalue;

// }

// function storeType(param) {
   
//   sessionStorage.utype=param;
// }

// function storeStatus(param) {
   
//   sessionStorage.ustatus=param;
// }

// function fetchStatus() {

//    return sessionStorage.ustatus;

// }

// function fetchType() {

//    return sessionStorage.utype;

// }


// function fetchUser() {

//    return sessionStorage.uname;

// }
	
	
		
	

