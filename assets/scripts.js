function post_query( url, name, data ) {

	var str = '';


	$.each( data.split('.'), function(k, v) {
		str += '&' + v + '=' + $('#' + v).val();
	} );
	$.ajax({

		url : '/' + url,
		type: 'POST',
		data: name + '_f=1' + str,
		cache: false,
		success: function( result ) {

			obj = jQuery.parseJSON( result );
			if ( obj.go ) go( obj.go );
			else if ( obj.select ) cform();
			else if( obj.like ) likes(obj.like);
			else if( obj.message ) showModal(obj.message);
		}

	});
}




function go( url ) {
	window.location.href='/' + url;
}

function likes( like ) {
	/*$.ajax({
    url: "like.php",
    type: "POST",
    data: id,
	}).done(function(answer){
	      $('.LikeBlock').replaceWith(answer);
	});*/
	data=like.split('_');
	data1=data[0];
	data2=data[1];
	data3=data[2];
	if (data3 == 0) {
		var $block = $('.fa-heart');
    	$block.addClass(data1).removeClass('fa-heart');
	} else {
		var $block = $('.fa-heart-o');
    	$block.addClass(data1).removeClass('fa-heart-o');
	}
	$('.LikeBlock2').html(data2);
	
	
}

function cform() {
	$('.cl').val('');
}

function showModal(message) {

$.magnificPopup.open({
items: {
      src: '<div class="white-popup">'+ message +'</div>',
      type: 'inline'
  },
  closeBtnInside: true
});

}


function schet(min, max) {
var text = document.getElementById('subject');
var content = text.value;
var dlina = content.length;
var divx = document.getElementById('WordCounter');
if (dlina < min) {
	$('#WordCounter').addClass('text_error');
} else if (dlina > max){
	$('#WordCounter').addClass('text_error');
} else {
	$('#WordCounter').removeClass('text_error');
}
divx.innerHTML = 'Вы ввели: ' + dlina;
}