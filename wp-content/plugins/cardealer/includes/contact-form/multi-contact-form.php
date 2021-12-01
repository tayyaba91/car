<?php /**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
function CarDealer_contact_form()
{
    wp_enqueue_script('contact-form-js', CARDEALERURL .
        'includes/contact-form/js/multi-contact-form.js', array('jquery'));
}
add_action('wp_loaded', 'CarDealer_contact_form');
function cardealer_form_ajaxurl()
{
//    echo '<script type="text/javascript">
//                var ajaxformurl = "' . admin_url('admin-ajax.php') . '";
//              </script>';


?>
    <script type="text/javascript">
        var ajax_object = {};
        ajax_object.ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
<?php
}

add_action('wp_head', 'cardealer_form_ajaxurl');

//add_action('wp_ajax_nopriv_cardealer_process_form', 'cardealer_process_form');

if(is_user_logged_in())
   add_action('wp_ajax_cardealer_process_form', 'cardealer_process_form');
else
   add_action('wp_ajax_nopriv_cardealer_process_form', 'cardealer_process_form');




function cardealer_process_form()
{
    check_ajax_referer('cardealer_cform'); // , 'security', false );
    $Car_name = isset($_POST['cardealer_the_title']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/",
        "", sanitize_text_field($_POST['cardealer_the_title'])) : "";
    define("RECIPIENT_NAME", "WordPress");
    define("EMAIL_SUBJECT", "Visitor Message From CarDealer Plugin About: " . $Car_name);
    $success = false;
    if (isset($_POST['CarDealer_recipientEmail'])) {
        $recipient_email = sanitize_email($_POST['CarDealer_recipientEmail']);
    } else
        $recipient_email = '';
    $senderName = isset($_POST['CarDealer_senderName']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/",
        "", sanitize_text_field($_POST['CarDealer_senderName'])) : "";
    $senderEmail = isset($_POST['CarDealer_senderEmail']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/",
        "", sanitize_text_field($_POST['CarDealer_senderEmail'])) : "";
    if (isset($_POST['title']))
        $message = sanitize_text_field($_POST['title'] . PHP_EOL);
    else
        $message = 'Message: ';
    $message .= isset($_POST['CarDealer_sendermessage']) ? preg_replace("/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/",
        "", sanitize_text_field($_POST['CarDealer_sendermessage'])) : "";
    if ($senderName && $senderEmail && $message && $recipient_email) {
        $recipient = RECIPIENT_NAME . " <" . $recipient_email . ">";
        $mydomain = preg_replace('/www\./i', '', sanitize_text_field($_SERVER['SERVER_NAME']));
        $message = 'eMail: ' . $senderEmail . PHP_EOL . $message;
        $message = 'Name: ' . $senderName . PHP_EOL . $message;
       
        
        $headers = "eMail: WordPress Site < WordPress@" . $mydomain . " >\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();

        if (trim(get_option('CarDealer_enable_contact_form', 'no') == 'yes'))
            $success = wp_mail($recipient_email, EMAIL_SUBJECT, $message, $headers);

    }
    echo $success ? "success" : "error";
    wp_die();
} ?>