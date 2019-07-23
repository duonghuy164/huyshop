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

});

