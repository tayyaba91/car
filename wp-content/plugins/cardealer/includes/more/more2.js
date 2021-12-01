jQuery(document).ready(function ($) {

  //  console.log('OK77');
  $('#billimagewaitfbl').hide();

  $("*").click(function (evt) {
    //  $("#toolstruthsocial").click(function (evt) {
    // evt.preventDefault();
    //var target = $( evt.target.nodeName );
    var id = $(this).attr('id');
    // var btnclass = hasClass('bill-install-now');
    var btnclass = $(this).hasClass("cd-bill-install-now")
    // console.log(btnclass );
    if (btnclass != true) {
      return;
    }
    // console.log({id});
    if (id != "antihacker" && id != "toolstruthsocial" && id != "stopbadbots" && id != "wptools" && id != "recaptcha-for-all" && id != "wp-memory") {
      Return;
    }
    alert_msg = 'Plugin Installed Successively!\nGo to ';
    if (id == "wp-memory") {
      alert_msg = alert_msg + "Dashboard => Menu => Tools => WP Memory"
    }
    else {
      alert_msg = alert_msg + "Dashboard => Menu"
    }
    $('#billimagewaitfbl').show();
    evt.preventDefault();
    //console.log(id);  
    $billmodal = $('#bill-wrap-install');
    //console.log($billmodal);
    $billmodal.prependTo($('#wpcontent')).slideDown();
    $('html, body').scrollTop(0);
    $("#billpluginslug").html(id);
    jQuery.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        'action': 'cardealer_install_plugin',
        'slug': id
      },
      success: function (data) {
        $('#billimagewaitfbl').hide();
        if (data == 'OK') {
          console.log(data);
          $('#rcwimagewaitfbl').hide();
          alert(alert_msg);
        }
        else {
          $('#billimagewaitfbl').hide();
          console.log(data);
          alert('Automatic Plugin Install Fail! Please, Install Manually');
        }
        $billmodal.slideUp();
        window.location.reload(true);
      },

      
      error: function (xhr, textStatus, errorThrown) {
        console.log(textStatus);
        var errorMessage = xhr.status + ': ' + xhr.statusText
        console.log(errorMessage);

        // console.log(data);
        alert('Automatic Plugin Install Fail! Please, Install Manually');
        $billmodal.slideUp();
        window.location.reload(true);
      }


    }); // ajax


  }); //click

});  // end jQuery  