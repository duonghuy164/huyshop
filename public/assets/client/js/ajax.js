$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
	$('.qty').blur(function(){
		let rowid=$(this).data('id');
		$.ajax({
			url:'cart/'+rowid,
			type :'put',
			dataType:'json',
			data:{
				qty :$(this).val(),
			},
			success : function(data){
				toastr.success(data.result,'Thongbao',{timeOut:5000});
				location.reload();
			}

		});

	});

	$('.close1').click(function(){
		
		let rowid =$(this).data('id');
		$.ajax({
			url: 'cart/'+rowid,
			type:'delete',
			dataType:'json',
			success : function(data){
				toastr.success(data.result,'Thongbao',{timeOut:5000});
				location.reload();
			}

		});
		

	});

	// add customer   lỗi 403 ec ec
	$('.errorEmail').hide();
	$('.errorPhone').hide();
	$('.errorAddress').hide();
	$('.addAdress').click(function(){
		var active = '';
		if($('.actives').prop('checked')){
			active = 'on';
		}else{
			active = 'off';
		}
		$.ajax({
			url : 'customer',
			type : 'post',
			data : {
				email : $('.email').val(),
				phone : $('.phone').val(),
				address : $('.address').val(),
				active : active,
			},
			dataType : 'json',
			success : function(data){
				$('#address').modal('hide');
				toastr.success(data, 'Thông báo', {timeOut: 5000});
				location.reload();
			},
			
		});
	});


	// payment
	$('.payment').click(function(){

		let email = '';
		let phone = '';
		let address = '';
		let name = '';
		var note =  $('.note').val();
		var paytotal = $('.paytotal').text();
		paytotal = paytotal.replace('VND','');
		var rdoAddress = $('input[name=rdoaddress]');
		$.each(rdoAddress,function(key,value){
			if(value.checked == true){
				email = value.value;
				phone = $('.phone'+key).text();
				address = $('.address'+key).text();
				name = $('.name'+key).text();
			}
		});
		



		// da  lay du du lieu  

	     
		$.ajax({
			url : 'cart',
			data : {
				email : email,
				phone : phone,
				address : address,
				message : note,
				monney : paytotal,
				name : name,
			},
			dataType : 'json',
			type : 'post',
			success : function(data){
				toastr.success(data, 'Thông báo', {timeOut: 5000});
				location.href = '/';
			}
		});

	});

});

