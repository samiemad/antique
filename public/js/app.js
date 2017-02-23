$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$('.like').on('click', function(event){
	event.preventDefault();
	var href = $(this).attr('href');
	var itemid = event.target.parentNode.dataset['itemid'];
	console.log('clicked'+href+" itemid = "+itemid);
	$.ajax({
		method: 'POST',
		url: likeUrl,
		data: {
			itemid: itemid,
			type: href,
		}
	}).done(function(msg){
		msg = $.parseJSON(msg);
		console.log('done: '+msg);
		console.log('type: '+msg.liketype);
		if(event.target.previousElementSibling==null){
			var likeBtn = event.target;
		}else{
			var likeBtn = event.target.previousElementSibling;
		}
		var dislikeBtn = likeBtn.nextElementSibling;
		if(msg.liketype=="Like"){
			likeBtn.innerText = "Liked";
			dislikeBtn.innerText = "Dislike";
			$(likeBtn).addClass("active");
			$(dislikeBtn).removeClass("active");
		}else if(msg.liketype=="Dislike"){
			likeBtn.innerText = "Like";
			dislikeBtn.innerText = "Disliked";
			$(dislikeBtn).addClass("active");
			$(likeBtn).removeClass("active");
		}else{
			likeBtn.innerText = "Like";
			dislikeBtn.innerText = "Dislike";
			$(likeBtn).removeClass("active");
			$(dislikeBtn).removeClass("active");
		}
	});
});

// $('.publish').on('click', function(event){
// 	$('#publish-modal').modal();
// });

// $('#modal-save').on('click', function(event){
// 	console.log('click modal-save');
// 	$.ajax({
// 		method: 'POST',
// 		url: urlPublish,
// 		data: { name: 			$('#name').val(),
// 				description: 	$('#description').val(),
// 				price: 			$('#price').val(),
// 				_token: token}
// 	}).done(function(msg){
// 		console.log(msg);
// 		$('#edit-modal').modal('hide');
// 	});
// });
