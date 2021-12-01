jQuery(document).ready(function() {
	var messageDelay = 3000;
	jQuery("#CarDealer_sendMessage").click(function(evt) {
		evt.preventDefault();
		var CarDealer_contactForm = jQuery(this);
        var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
    	var uemail = jQuery('#CarDealer_senderEmail').val();
		if (!jQuery('#CarDealer_senderName').val() || !jQuery('#CarDealer_senderEmail').val() || !jQuery('#CarDealer_sendermessage').val()) {
            jQuery('#CarDealer_incompleteMessage').fadeIn().delay(messageDelay).fadeOut();
            CarDealer_contactForm.fadeOut().delay(messageDelay).fadeIn();
			// jQuery('#CarDealer_senderName').css('border', '1px solid red');
            return false;
    	} 
        else if(!re.test(uemail))
        {
              jQuery('#CarDealer_email_error').fadeIn().delay(messageDelay).fadeOut();
              return false;
        }
  		var uname = jQuery('#CarDealer_senderName').val();
        var umessage = jQuery('#CarDealer_sendermessage').val();
        if(!onlyalpha (uname))
        {
           jQuery('#CarDealer_name_error').fadeIn().delay(messageDelay).fadeOut();
           return false;     
        }
        /*
        if( ! alphanumeric(umessage) )
        {
           jQuery('#CarDealer_message_error').fadeIn().delay(messageDelay).fadeOut();
           return false; 
        }
        */
        umessage = sanitarize (umessage);
        /* alert(umessage); */
        //else {
			jQuery('#CarDealer_sendingMessage').fadeIn();
			CarDealer_contactForm.fadeOut();
            var nonce = jQuery('#_wpnonce').val();
            form_content = jQuery('#CarDealer_contactForm').serialize();
              jQuery.ajax({
                type: "POST",
				url: ajax_object.ajax_url,
				data: form_content + '&action=cardealer_process_form' + '&security=' + _wpnonce,
				    timeout: 20000,
                    error: function(jqXHR, textStatus, errorThrown) {
                      // alert('errorThrown');
                  		jQuery('#CarDealer_sendingMessage').hide();
                        CarDealer_contactForm.fadeIn();
                        alert('Fail to Connect with Data Base (9).\nPlease, try again later.');
                    }, 
                success: submitFinished
			});          
		// }
		return false;
	});
	jQuery(init_CarDealer_form);
	function init_CarDealer_form() {
		jQuery('#CarDealer_contactForm').hide(); //.submit( submitForm ).addClass( 'CarDealer_positioned' );
		jQuery('#CarDealer_sendingMessage').hide();
		jQuery('#CarDealer_successMessage').hide();
		jQuery('#CarDealer_failureMessage').hide();
		jQuery('#CarDealer_incompleteMessage').hide();
		jQuery("#CarDealer_cform").click(function() {
			jQuery('#CarDealer_cform').hide();
			jQuery('#CarDealer_contactForm').addClass('CarDealer_positioned');
			jQuery('#CarDealer_contactForm').css('opacity', '1');
			jQuery('#CarDealer_contactForm').fadeIn('slow', function() {
				jQuery('#CarDealer_senderName').focus();
			})
			return false;
		});
		// When the "Cancel" button is clicked, close the form
		jQuery('#CarDealer_cancel').click(function() {
			jQuery('#CarDealer_contactForm').fadeOut();
			jQuery('#content2').fadeTo('slow', 1);
            jQuery("#CarDealer_cform").fadeIn()
		});
		// When the "Escape" key is pressed, close the form
		jQuery('#CarDealer_contactForm').keydown(function(event) {
			if (event.which == 27) {
				jQuery('#CarDealer_contactForm').fadeOut();
				jQuery('#content2').fadeTo('slow', 1);
                jQuery("#CarDealer_cform").fadeIn()
			}
		});
	}
	function submitFinished(response) {
		response = jQuery.trim(response);
		jQuery('#CarDealer_sendingMessage').fadeOut();
		if (response == "success") {
			jQuery('#CarDealer_successMessage').fadeIn().delay(messageDelay).fadeOut();
			jQuery('#CarDealer_senderName').val("");
			jQuery('#CarDealer_senderEmail').val("");
			jQuery('#CarDealer_sendermessage').val("");
			jQuery('#content2').delay(messageDelay + 1000).fadeTo('slow', 1);
			jQuery('#CarDealer_contactForm').fadeOut();
            jQuery("#CarDealer_cform").fadeIn()
		} else {
			jQuery('#CarDealer_failureMessage').fadeIn().delay(messageDelay).fadeOut();
			jQuery('#CarDealer_contactForm').delay(messageDelay + 1000).fadeIn();
		}
	}
    function alphanumeric(inputtext)
    {
         if( /[^a-zA-Z0-9 ]/.test( inputtext ) ) {
           return false;
         }
        return true;
	}
	function alphanumericext1(inputtxt)
	{
		var iChars = "&()[]/{}|<>";
		for (var i = 0; i < inputtxt.length; i++) {
			if (iChars.indexOf(inputtxt.charAt(i)) != -1) {
			  return false;
			}
		}
		if (inputtxt.match(/script/gi))
		{
			return false;
		}
		  return true;
	} 
function sanitarize(str) {
    var map = {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
		"\"": "&quot;",
		"[": "&#91;",
		"]": "&#93;",
		"{": "&#123;",
		"}": "&#125;",
        "'": "&#39;" // ' -> &apos; for XML only
    };
    return str.replace(/[&<>"']/g, function(m) { return map[m]; });
}
    function onlyalpha(inputtext)
    {
     if( /[^a-zA-Z ]/.test( inputtext ) ) {
       return false;
     }
      return true;
    }
}); // end jQuery ready