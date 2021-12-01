<?php /**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// $aurl = CARDEALERURL . 'includes/contact-form/processForm.php';
$aurl = "#";
$CarDealer_recipientEmail = trim(get_option('CarDealer_recipientEmail', ''));
if ( ! is_email($CarDealer_recipientEmail)) {
        $CarDealer_recipientEmail = '';
        update_option('CarDealer_recipientEmail', '');
    }
if (empty($CarDealer_recipientEmail))
    $CarDealer_recipientEmail = get_option('admin_email'); ?>
<?php Global $cardealer_the_title; ?>  
<form id="CarDealer_contactForm" style="display: none;">
<!-- action="<?php echo $aurl; ?>" method="post"> -->
  <input type="hidden" name="CarDealer_recipientEmail" id="CarDealer_recipientEmail" value="<?php echo
$CarDealer_recipientEmail; ?>" />
  <input type="hidden" name="cardealer_the_title" id="cardealer_the_title" value="<?php echo $cardealer_the_title; ?>" />
  <h2><?php 
  echo __('Request Information', 'cardealer'); 
  ?>...</h2>
  <ul>
    <li>
      <label for="CarDealer_senderName" class="CarDealer_contact" ><?php echo __('Your Name',
'cardealer'); ?>:&nbsp;</label>
      <input type="text" name="CarDealer_senderName" id="CarDealer_senderName" placeholder="<?php echo
__('Please type your name', 'cardealer'); ?>" required="required" maxlength="40" />
    </li>
    <li>
      <label for="CarDealer_senderEmail" class="CarDealer_contact"><?php echo __('Your Email',
'cardealer'); ?>:&nbsp;</label>
      <input type="email" name="CarDealer_senderEmail" id="CarDealer_senderEmail" placeholder="<?php echo
__('Please type your email', 'cardealer'); ?>" required="required" maxlength="50" />
    </li>
    <li>
      <label for="CarDealer_sendermessage" class="CarDealer_contact" style="padding-top: .5em;"><?php echo
__('Your Message', 'cardealer'); ?>:&nbsp;</label>
      <textarea name="CarDealer_sendermessage" id="CarDealer_sendermessage" placeholder="<?php echo
__('Please type your message', 'cardealer'); ?>" required="required"  maxlength="10000"></textarea>
    </li>
  </ul>
<br />
  <div id="formButtons">
    <input type="submit" id="CarDealer_sendMessage" name="sendMessage" value="<?php echo
__('Send', 'cardealer'); ?>" />
    <input type="button" id="CarDealer_cancel" name="cancel" value="<?php echo __('Cancel',
'cardealer'); ?>" />
  </div>
<?php  wp_nonce_field('cardealer_cform'); ?> 
</form>
<div id="CarDealer_sendingMessage" class="CarDealer_statusMessage" style="display: none; z-index:999;" ><p><?php esc_attr_e('Sending your message. Please wait...' , 'cardealer' ); ?></p></div>
<div id="CarDealer_successMessage" class="CarDealer_statusMessage" style="display: none;  z-index:999;"><p><?php esc_attr_e( 'Thanks for your message! We\'ll get back to you shortly.' , 'cardealer' ); ?></p></div>
<div id="CarDealer_failureMessage" class="CarDealer_statusMessage" style="display: none;  z-index:999;"><p><?php esc_attr_e( 'There was a problem sending your message. Please try again.' , 'cardealer' ); ?></p></div>
<div id="CarDealer_email_error" class="CarDealer_statusMessage" style="display: none; z-index:999;"><p><?php esc_attr_e( 'Please enter one valid email address.' , 'cardealer' ); ?></p></div>
<div id="CarDealer_incompleteMessage" class="CarDealer_statusMessage" style="display: none; z-index:999;"><p><?php esc_attr_e( 'Please complete all the fields in the form before sending.' , 'cardealer' ); ?></p></div>
<div id="CarDealer_name_error" class="CarDealer_statusMessage" style="display: none; z-index:999;"><p><?php esc_attr_e( 'Name Error. Use only alpha.' , 'cardealer' ); ?></p></div>
<div id="CarDealer_message_error" class="CarDealer_statusMessage" style="display: none; z-index:999;"><p><?php esc_attr_e( 'Message Error. Only Use only alpha and numbers.' , 'cardealer' ); ?> </p></div>