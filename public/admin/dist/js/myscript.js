
$(document).ready(function() {
     $('#dataTables-example').DataTable({
                responsive: true
      });
});
$('div .alert').delay(3000).slideUp();
$('a#del').click(function(){
           $(this).parents('#gradeX').css({"color": "red", "border": "2px solid red"});
		
});
function xacnhanxoa(msg){
 	if(window.confirm(msg)){
		return true;
	}
	return false;
}
$('#addhuongnghiencuu').on( 'submit', function(e) {
	e.preventDefault(); 
  
  $.ajax({
        type: "POST",
        url: '/dangky/admin/giaovien/addhnc',
        //data: {"txthnc":txthnc, "_token":_token,"giaovien_id":giaovien_id},
        data: $("#addhuongnghiencuu").serialize(),
        success: function( response ) {
        	if(response.success == 'true'){
        		$("#successMessage").show().delay(1000).slideUp();
        		$('#addhuongnghiencuu')[0].reset();
        		$('#addnghiencuu').modal('hide');}
        	else
        		$("#errorMessage").show().delay(1000).slideUp();
        },
        error: function (request, status, error) {
        	alert(request.responseText);
        	
    	}
    });
 	
});
$('#adddetaiform').on( 'submit', function(e) {
    e.preventDefault(); 
  $.ajax({
        type: "POST",
        url: '/dangky/admin/giaovien/adddetai',
        //data: {"txthnc":txthnc, "_token":_token,"giaovien_id":giaovien_id},
        data: $("#adddetaiform").serialize(),
        success: function( response ) {
        	// if(response.success == 'true'){
        	// 	$("#successMessage").show().delay(1000).slideUp();
        	// 	$('#addhuongnghiencuu')[0].reset();
        	// 	$('#addnghiencuu').modal('hide');}
        	// else
        	// 	$("#errorMessage").show().delay(1000).slideUp();
        },
        error: function (request, status, error) {
        	alert(request.responseText);
        	
    	}
    });
 	
});
$('.access').on('click',function(){
    var value = $(this).val();
    var token = $(this).data('token');
    var value = $(this).data('value');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "post",
        url: '/dangky/admin/giaovien/listyeucau',
        data: { 'value': value.value,'action':value.action},
        success: function(response){
            if(response.success == 'true')
            window.location = window.location.pathname;
        },
        error: function(request){}
    });
    
});
