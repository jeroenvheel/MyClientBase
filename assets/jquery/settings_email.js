$(document).ready(function(){

	toggle_display();

	$('#email_protocol').change(function() {

		toggle_display();

	});

	function toggle_display() {

		var value = $('#email_protocol').val();

		if (value == 'php_mail_function') {

			$('.smtp').hide();

			$('.sendmail').hide();

		}

		else if (value == 'sendmail') {

			$('.smtp').hide();

			$('.sendmail').show();

		}

		else if (value == 'smtp') {

			$('.smtp').show();

			$('.sendmail').hide();

		}

	}

});