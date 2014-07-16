$('#feed_input_text').keypress(function(e){
    if(e.which==13){
        var message = $(this).val();
        $(this).val('');
        $(this).focus();
		var latitude = $('#input_lat_hidden').val();
		var longitude = $('#input_long_hidden').val();

        
        $.ajax({
            url: '/index.php/feed/add_feed/'+message,
            context: this,
            type: 'POST',
            data: {latitude: latitude, longitude: longitude},
            success: function(data){
                alert("Success!");
            }
        });
        
    }
});

$('.like_buttons').click(function(e){
	var itemname = $(this).parent().attr('id');
	var id = itemname.substr(10);
	//alert(id);
	
	$.ajax({
		url: '/index.php/feed/spread_feed/'+id,
		context: this,
		success: function(data){
			alert("Successfully Spread!");
			$(this).hide();
			$(this).parent().append('<span class="afterlike_messages">You&#39;ve Spread The Word!</span>');
		}
	});
	

	
});

function getLocation(){
	if (navigator.geolocation) {
		//alert("Geo");
		navigator.geolocation.getCurrentPosition(showMap, showError);
	} else {
		alert("Geolocation is not supported by this browser.");
	}
}
function showMap(position) {
	//alert("sds");
	$('#input_lat_hidden').val(position.coords.latitude);
	$('#input_long_hidden').val(position.coords.longitude);
	$.ajax({
		url: '/index.php/feed/add_ip/',
		type: 'POST',
		data: {latitude: position.coords.latitude, longitude: position.coords.longitude},
		context: this,
		success: function(data){
			alert(data);
		}
	});
}

function showError(error) {
	switch(error.code) {
		case error.PERMISSION_DENIED:
			alert("User denied the request for Geolocation.");
			break;
		case error.POSITION_UNAVAILABLE:
			alert("Location information is unavailable.");
			break;
		case error.TIMEOUT:
			alert("The request to get user location timed out.");
			break;
		case error.UNKNOWN_ERROR:
			alert("An unknown error occurred.");
			break;
	}
}

getLocation();