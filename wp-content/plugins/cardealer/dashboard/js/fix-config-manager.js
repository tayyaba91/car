jQuery(document).ready(function($) {

	$('#pluginfix-wpconfig-button').click(function(evt) {
    	$modalvmaf = $('#pluginfix-wpconfig');
		$('#wpwrap').css('opacity', '.1');
		$modalvmaf.css('opacity', '1');
		$('#bill-imagewait20').hide();
		$modalvmaf.prependTo($('body')).slideDown();
		//  $modalvmaf.slideDown();
		

	});
	$(".button-cancell-wpconfig").click(function(evt) {
		if ($(".button-cancell-wpconfig").hasClass("disabled")) {
			return;
		}
		mytext = evt.target.text;
		$modalvmaf.slideUp();
		$('#wpwrap').css('opacity', '1');
		location.reload();
		return '1';
	});
	$(".button-close-wpconfig").click(function() {
		// submeteu update
		if ($(".button-close-wpconfig").hasClass("disabled")) {
			return;
		}
		$('#bill-imagewait20').show();
		$('#feedback_wpconfig').html("Please, wait ... ");
		var email = $('#email').val();
        
        
        
		var url_config = $('#url_config').val();
        //console.log(url_config);
        //alert(url_config); 
		//var key = $('#boatdealerurlkey').val();

		var server_memory = $('#server_memory').val();
        
       //console.log(key);
        
        
		$('#bill-imagewait2').css('visibility', 'visible');
		$(".button-close-wpconfig").addClass('disabled');
		$(".button-cancell-wpconfig").addClass('disabled');
		$.ajax({
			url: url_config,
			withCredentials: true,
			timeout: 60000,
			method: 'POST',
			crossDomain: true,
			data: {
				email: email,
				server_memory : server_memory
			},
			success: function(data) {
				$('#bill-imagewait20').hide();
				result = data;
				if (result == 'WP-CONFIG.PHP File updated!') {
					result = result + '\n';
					var messageundo = 'Please keep this window opened until testing the site in another window. Use the address above to DISCARD last changes. Just copy and paste it at your browser.';
					result = result + messageundo;
					$('#feedback_wpconfig').html(result);
                    $('#feedback_wpconfig').css("background", "yellow");
					alert('Just in case, we sent an email with the link to you. Check also your spam folder.')
				} else {
					$('#feedback_wpconfig').html(result);
				}
				$(".button-cancell-wpconfig").removeClass('disabled');
				$(".button-cancell-wpconfig").html('Close');
			},
			
			
			error: function (request, status, error) {
				alert(status+'  '+error);
			},
			

            /*
			error: function() {
				$('#bill-imagewait20').hide();
				result = 'Error occured, please try again later.';
				$('#feedback_wpconfig').html(result);
				$(".button-cancell-wpconfig").removeClass('disabled');
				$(".button-cancell-wpconfig").html('Close');
			},
			*/
			
			completed: function() {
				// alert('fim');
			}
		}); // end ajax  
	}); // fix-wpconfig
}); // jquery