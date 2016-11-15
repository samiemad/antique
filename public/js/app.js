$('.publish').on('click', function(event){
	$('#publish-modal').modal();
});

$('#modal-save').on('click', function(event){
	console.log('click modal-save');
	$.ajax({
		method: 'POST',
		url: urlPublish,
		data: { name: 			$('#name').val(),
				description: 	$('#description').val(),
				price: 			$('#price').val(),
				_token: token}
	}).done(function(msg){
		console.log(msg);
		$('#edit-modal').modal('hide');
	});
});
