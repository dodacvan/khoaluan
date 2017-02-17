
$(document).ready(function() {
     $('#dataTables-example').DataTable({
                responsive: true
      });
});
$('div .alert').delay(3000).slideUp();
$('a#del').click(function(){
           $(this).parents('#gradeX').css({"color": "red", "border": "2px solid red"});
		
});


function nameofhnc($value,$id){
    $("#edittxthnc").val($value);
    $("#idhnc").val($id);
}

function nameofdetai($value,$id){
    $("#edittxtdetai").val($value);
    $("#iddetai").val($id);
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
        		$('#addnghiencuu').modal('hide');
                window.setTimeout(function(){location.reload()},3000)
            }
        	else
        		$("#errorMessage").show().delay(1000).slideUp();
        },
        error: function (request, status, error) {
        	alert(request.responseText);        	
    	}
    });	
});

$('#edithncform').on( 'submit', function(e) {
  e.preventDefault();
  $.ajax({
        type: "POST",
        url: '/dangky/admin/giaovien/edithnc',
        //data: {"txthnc":txthnc, "_token":_token,"giaovien_id":giaovien_id},
        data: $("#edithncform").serialize(),
        success: function( response ) {
            if(response.success == 'true'){
                $("#editmessage").show().delay(1000).slideUp();
                $('#edithncform')[0].reset();
                $('#edithnc').modal('hide');
                window.setTimeout(function(){location.reload()},3000)
            }
            else
                $("#errorMessage2").show().delay(1000).slideUp();
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
        	if(response.success == 'true'){
        		$("#successdetai").show().delay(1000).slideUp();
        		$('#adddetaiform')[0].reset();
        		$('#adddetai').modal('hide');
                window.setTimeout(function(){location.reload()},3000)
            }
        	else
        		$("#errorMessage3").show().delay(1000).slideUp();
        },
        error: function (request, status, error) {
        	alert(request.responseText);
        	
    	}
    });
 	
});

$('#editdetaiform').on( 'submit', function(e) {
  e.preventDefault();
  $.ajax({
        type: "POST",
        url: '/dangky/admin/giaovien/editdetai',
        //data: {"txthnc":txthnc, "_token":_token,"giaovien_id":giaovien_id},
        data: $("#editdetaiform").serialize(),
        success: function( response ) {
            if(response.success == 'true'){
                $("#editdetai").show().delay(1000).slideUp();
                $('#editdetaiform')[0].reset();
                $('#editdetaimodal').modal('hide');
                window.setTimeout(function(){location.reload()},3000)
            }
            else
                $("#errorMessage4").show().delay(1000).slideUp();
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
            else
                 $("#erroraddsv").show().delay(1000).slideUp();
        },
        error: function(request){}
    });
    
});
