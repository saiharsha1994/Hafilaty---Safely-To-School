
     

/* Session TimeOut Handler */
function sessionHandleCust(result){
	if(result=="SystemSessionTimeOut")
		location.href = 'Login';
}
/* Ajax Page Refresh */
function pageRefresh(){
	$.ajax({url: "", context: document.body, success: function(s,x){$(this).html(s);}});
}
function pageRefresh_new(){
	location.reload(true);
}
/* A JavaScript equivalent of PHP’s urldecode */
function urldecode(str) {
  return decodeURIComponent((str + '').replace(/%(?![\da-f]{2})/gi, function(){return '%25';}).replace(/\+/g, '%20'));
}
/* Dummy alert function */
(function(){	
	$("#parent_det").click(function () {
		alert("Feature Coming Soon Insha Allah!");
	});	
	$("#student_det").click(function () {
		alert("Feature Coming Soon Insha Allah!");
	});
	$("#bulk_up").click(function () {
		alert("Feature Coming Soon Insha Allah!");
	});
	$("#class_det").click(function () {
		alert("Feature Coming Soon Insha Allah!");
	});	
})();
/* Popup Validator */
function validate_pop_form(data){
	res_arr = data.split("&");						
	for(i=0;i<res_arr.length;i++){
		final_val = res_arr[i].split("=");				
		if($.trim(final_val[1]) == ""){
			alert("Please Fill the Mandatory Fields");				
			return false;
		}	
	}
	return true;
}	
//Print script
function printDiv(divName) {
	var printContents = document.getElementById(divName).innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
function lang_setting(lang){
	console.log(lang);
	var data = 'Lang=' +lang;	
	$.ajax({url: "Welcome/AJAX_lang_setting", type: 'post', data: data,success: function(result){
				sessionHandleCust(result);									
				console.log(result);
				setTimeout(pageRefresh,500);
			}});
}	
/* AJAX loader in all Pages */
function ajaxindicatorstart(text){
	if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
		jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="../dist/img/ajax-loader.gif"><div>'+text+'</div></div><div class="bg"></div></div>');
	}
			
	jQuery('#resultLoading').css({
		'width':'100%',
		'height':'100%',
		'position':'fixed',
		'z-index':'10000000',
		'top':'0',
		'left':'0',
		'right':'0',
		'bottom':'0',
		'margin':'auto'
	});	
			
	jQuery('#resultLoading .bg').css({
		'background':'#000000',
		'opacity':'0.7',
		'width':'100%',
		'height':'100%',
		'position':'absolute',
		'top':'0'
	});
			
	jQuery('#resultLoading>div:first').css({
		'width': '250px',
		'height':'75px',
		'text-align': 'center',
		'position': 'fixed',
		'top':'0',
		'left':'0',
		'right':'0',
		'bottom':'0',
		'margin':'auto',
		'font-size':'16px',
		'z-index':'10',
		'color':'#ffffff'
	});

	jQuery('#resultLoading .bg').height('100%');
		jQuery('#resultLoading').fadeIn(300);
		jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop(){
	jQuery('#resultLoading .bg').height('100%');
	jQuery('#resultLoading').fadeOut(300);
	jQuery('body').css('cursor', 'default');
}	
		
jQuery(document).ajaxStart(function () { ajaxindicatorstart('loading data.. please wait..'); }).ajaxStop(function () { ajaxindicatorstop(); });