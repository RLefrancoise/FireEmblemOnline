function login() {
	var req = $.ajax({
		type: "post",
		url: "home/login",
		data: $('#login_form').serialize(),
		cache: false,
		success: function(json) {
			try {
				json = jQuery.parseJSON(json);

				if(json['status'] == 'login_ok') {
					location.href = "home";
				} else {
					$('#login_info').css('color', 'red');
					$('#login_info').html( json['status'] );
				}

			} catch(e) {
				alert(e);
				alert(json);
			}

		}
	});

	req.fail(function( jqXHR, textStatus ) {
	  alert( "Request failed: " + textStatus );
	});
}