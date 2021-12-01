<?php /*
Plugin Name: CarDealer 
Plugin URI: http://cardealerplugin.com
Description: Car Dealer Plugin for Car Dealer agency.
Version: 2.96
Text Domain: cardealer
Domain Path: /language
Author: Bill Minozzi
Author URI: http://billminozzi.com
License:     GPL2
Copyright (c) 2017 Bill Minozzi
Car Dealer Right Away is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
cardealer is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with cardealer. If not, see {License URI}.
Permission is hereby granted, free of charge subject to the following conditions:
The above copyright notice and this FULL permission notice shall be included in
all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
DEALINGS IN THE SOFTWARE.
*/
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
define('CARDEALERVERSION', '2.96');
define('CARDEALERPATH', plugin_dir_path(__file__));
define('CARDEALERURL', plugin_dir_url(__file__));
define('CARDEALERIMAGES', plugin_dir_url(__file__) . 'assets/images/');
define('CARDEALERHOMEURL', admin_url());
include_once (ABSPATH . 'wp-includes/pluggable.php');
$cardealer_plugin = plugin_basename(__file__);
$CarDealer_hp_or_kw = sanitize_text_field(get_option('CarDealer_hp_or_kw', 'HP'));
$CarDealer_modal_size = sanitize_text_field(get_option('CarDealer_modal_size', '900'));
$CarDealer_template_single = trim(get_option('CarDealer_template_single',  '1'));
function cardealer_plugin_settings_link($links)
{
    $settings_link = '<a href="options.php?page=cardealer_settings">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
if (is_admin()) {
    function CarDealer_add_admstylesheet()
    {
        $color = get_user_meta(get_current_user_id(), 'admin_color', true);
        wp_enqueue_style('cardealer-metabox-tabs', CARDEALERURL .
            'includes/post-type/metabox-tabs.css');
        wp_enqueue_style("cardealer-$color", CARDEALERURL .
            'includes/post-type/metabox-$color.css');
        wp_enqueue_script('cardealer-metabox-tabs', CARDEALERURL .
            'includes/post-type/metabox-tabs.js', array('jquery'));
    }
    add_action('admin_print_styles-post.php', 'CarDealer_add_admstylesheet', 1000);
   // $path = dirname(plugin_basename(__file__)) . '/language/';
    $path = basename( dirname( __FILE__ ) ) . '/language';
    $loaded = load_plugin_textdomain('cardealer', false, $path);
    if (!$loaded and get_locale() <> 'en_US') {
        if (function_exists('CarDealer_localization_init_fail'))
            add_action('admin_notices', 'CarDealer_localization_init_fail');
    }
} else {
    add_action('plugins_loaded', 'CarDealer_localization_init');
}
add_filter("plugin_action_links_$cardealer_plugin",
    'cardealer_plugin_settings_link');
require_once (CARDEALERPATH . "settings/load-plugin.php");
require_once (CARDEALERPATH . "settings/options/plugin_options_tabbed.php");
require_once (CARDEALERPATH . 'includes/help/help.php');
//add_action( 'admin_menu', 'cardealer_add_menu_gopro2' );
require_once (CARDEALERPATH . 'includes/functions/functions.php');
require_once (CARDEALERPATH . 'includes/post-type/meta-box.php');
require_once (CARDEALERPATH . 'includes/post-type/post-functions.php');
// require_once (CARDEALERPATH . 'includes/templates/template-functions.php');
require_once (CARDEALERPATH . 'includes/templates/redirect.php');
require_once (CARDEALERPATH . 'includes/widgets/widgets.php');
require_once (CARDEALERPATH . 'includes/search/search-function.php');
require_once (CARDEALERPATH . 'includes/multi/multi.php');
require_once (CARDEALERPATH . 'dashboard/main.php');
require_once (CARDEALERPATH . 'includes/contact-form/multi-contact-form.php');
require_once (CARDEALERPATH . 'includes/team/team.php');
if(is_admin())
{
  require_once (CARDEALERPATH . 'includes/functions/health.php');
  require_once (CARDEALERPATH . 'includes/functions/health_permalink.php');
}







// require_once(CARDEALERPATH . 'includes/vendor/vendor.php');













$Cardealer_template_gallery = trim(get_option('CarDealer_template_gallery',
    'yes'));

if ($Cardealer_template_gallery == 'yes')
    require_once (CARDEALERPATH . 'includes/templates/template-showroom.php');
else
    require_once (CARDEALERPATH . 'includes/templates/template-showroom1.php');



  require_once (CARDEALERPATH . 'includes/multi/multi-functions.php');


/*
if ($CarDealer_template_single == '1')         
require_once (CARDEALERPATH . 'includes/templates/template-functions.php');
if ($CarDealer_template_single == '2')         
require_once (CARDEALERPATH . 'includes/templates/template-functions2.php');
if ($CarDealer_template_single == '3')         
require_once (CARDEALERPATH . 'includes/templates/template-functions3.php');
*/

if ($CarDealer_template_single == '4')
  require_once (CARDEALERPATH . 'includes/templates/template-functions4.php');
else
  require_once (CARDEALERPATH . 'includes/templates/template-functions.php');




$cardealerurl = esc_url($_SERVER['REQUEST_URI']);


if (strpos($cardealerurl, 'product') !== false or strpos($cardealerurl, '/car/') !== false) {
    $CarDealer_overwrite_gallery = strtolower(get_option('CarDealer_overwrite_gallery',
        'yes'));
    if ($CarDealer_overwrite_gallery == 'yes')
        require_once (CARDEALERPATH . 'includes/gallery/gallery.php');
   // die('xxx');
}



add_action('wp_enqueue_scripts', 'CarDealer_add_files');
function CarDealer_add_files()
{
    wp_enqueue_style('show-room', CARDEALERURL . 'includes/templates/show-room.css');
    wp_enqueue_style('pluginStyleGeneral', CARDEALERURL .
        'includes/templates/template-style.css');
    wp_enqueue_style('pluginStyleSearch2', CARDEALERURL .
        'includes/search/style-search-box.css');
    wp_enqueue_style('pluginStyleSearchwidget', CARDEALERURL .
        'includes/widgets/style-search-widget.css');
    wp_enqueue_style('pluginStyleGeneral4', CARDEALERURL .
        'includes/gallery/css/flexslider.css');
    wp_register_style('jqueryuiSkin', CARDEALERURL . 'assets/jquery/jqueryui.css',
        array(), '1.12.1');
    wp_enqueue_style('jqueryuiSkin');
    wp_enqueue_style('bill-caricons', CARDEALERURL . 'assets/icons/icons-style.css');
    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_style('pluginStyleGeneral5', CARDEALERURL .
        'includes/contact-form/css/multi-contact-form.css');
    wp_enqueue_style('pluginTeam2', CARDEALERURL .
        'includes/team/team-custom.css'); 
    wp_enqueue_style('pluginTeam1', CARDEALERURL .
        'includes/team/team-custom-bootstrap.css');
    wp_register_style('fontawesome-css', CARDEALERURL . '/assets/fonts/font-awesome/css/font-awesome.min.css', array(), CARDEALERVERSION);
    wp_enqueue_style('fontawesome-css');

    wp_enqueue_style( 'bootstrapcss', CARDEALERURL .'assets/css/bootstrap.min.css', false, null );
    wp_enqueue_script( 'bootstapjs',  CARDEALERURL .'assets/js/bootstrap.min.js', false, null );




    // ABSPATH. 'wp-includes/js/thickbox.js'
    // ABSPATH. 'wp-includes/js/thickbox.css'


/*
    $billurl = 'http://cdn.jsdelivr.net/jquery.flot/0.8.3/jquery.flot.min.js'; 

    wp_register_script( 'thickbox-bill-js', $billurl. 'wp-includes/js/thickbox/thickbox.js', array('jquery') );
    wp_enqueue_script('thickbox-bill-js');


    $billurl = 'https://boatplugin.com/';
    wp_register_script( 'thickbox-bill-js', $billurl. 'wp-includes/js/thickbox/thickbox.js', array('jquery') );
    wp_enqueue_script('thickbox-bill-js');
 
    wp_enqueue_style( 'thickbox-bill.css', $billurl. 'wp-includes/js/thickbox/thickbox.css' );
    
*/


















}
function CarDealer_activated()
{

    // add_action('admin_notices', 'CarDealer_plugin_was_activated');

    $cardealer_plugin_version = get_site_option('cardealer_plugin_version', '');
    if ($cardealer_plugin_version < CARDEALERVERSION) {
        if ($cardealer_plugin_version < '2.3') {
            if (cardealer_howmanycars() > 0) {
                ob_start();
                cardealer_add_default_fields();
                ob_end_clean();
            }
            add_action('wp_loaded', 'cardealer_update_files');
        }
        if (!add_option('cardealer_plugin_version', CARDEALERVERSION))
            update_option('cardealer_plugin_version', CARDEALERVERSION);
    }

    /*
    if (trim(get_option('CarDealer_activated', '')) != '')
        return;
    */

    $w = update_option('CarDealer_activated', '1');
    if (!$w)
        add_option('CarDealer_activated', '1');


    $w = update_option('CarDealer_activated_message', '1');
    if (!$w)
        add_option('CarDealer_activated_message', '1');
    
    
 

    //$pointers = get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true);
    
       $pointers = ''; // str_replace( 'plugins', '', $pointers );
       update_user_meta(get_current_user_id(), 'dismissed_wp_pointers', $pointers);

 //   add_action('admin_notices', 'CarDealer_plugin_was_activated');
    

    $admin_email = get_option('admin_email');
    $old_admin_email = trim(get_option('CarDealer_recipientEmail', ''));
    if (empty($old_admin_email)) {
        $w = update_option('CarDealer_recipientEmail', $admin_email);
        if (!$w)
            add_option('CarDealer_recipientEmail', $admin_email);
    }
    $a = array(
        'CarDealer_show_make',
        'CarDealer_show_type',
        'CarDealer_show_price',
        'CarDealer_show_year',
        'CarDealer_show_condition',
        'CarDealer_show_transmission',
        'CarDealer_show_fuel',
        'CarDealer_show_orderby',
        'CarDealer_show_price');
    $q = count($a);
    for ($i = 0; $i < $q; $i++) {
        $x = trim(get_option($a[$i], ''));
        if ($x != 'yes' and $x != 'no') {
            $w = update_option($a[$i], 'yes');
            if (!$w)
                add_option($a[$i], 'yes');
        }
    }
}

 register_activation_hook(__file__, 'CarDealer_activated');





function CarDealer_localization_init()
{
    //$path = CARDEALERPATH . '/language/';
    $path = basename( dirname( __FILE__ ) ) . '/language';
    $loaded = load_plugin_textdomain('cardealer', false, $path);
}
function cardealerplugin_load_bill_stuff()
{
    wp_enqueue_script('jquery-ui-core');
    if( is_admin())
    {
       if( isset( $_GET[ 'taxonomy' ] ) ) 
          $active_tax = sanitize_text_field($_GET[ 'taxonomy' ]);
       if(isset($active_tax))
         if($active_tax == 'team')
             wp_enqueue_media();
    }    
}
add_action('wp_loaded', 'cardealerplugin_load_bill_stuff');
function cardealerplugin_load_feedback()
{
    if (is_admin()) {
        require_once (CARDEALERPATH . "includes/feedback/feedback.php");
        require_once (CARDEALERPATH . "includes/feedback/feedback-last.php");
    }
}
function cardealerplugin_load_activate()
{
    if (is_admin()) {
        require_once (CARDEALERPATH . 'includes/feedback/activated-manager.php');
    }
}
add_action('wp_loaded', 'cardealerplugin_load_feedback');

add_action('in_admin_footer', 'cardealerplugin_load_activate'); 
if (is_admin()) {
    
    if (get_option('CarDealer_activated_message', '0') == '1') {
        add_action('admin_notices', 'CarDealer_plugin_was_activated');

        
        $r = update_option('CarDealer_activated_message', '0');
        if (!$r)
            add_option('CarDealer_activated_message', '0');
        
    }
}
add_action( 'admin_menu', 'cardealer_add_menu_gopro2' );
$body_type = __('Body Type', 'cardealer');
$condition = __('Condition','cardealer');
add_filter( 'custom_menu_order', 'cardealer_submenu_order' );


/* =============================== */



function cardealer_add_menu_gopro2222()
{
    $cardealer_gopro_page = add_submenu_page(
        'car_dealer_plugin', // $parent_slug
        'Go Pro', // string $page_title
        '<font color="#FF6600">' . __('Go Pro', 'cardealer') . '</font>', // string $menu_title
        'manage_options', // string $capability
        'cardealer_my-custom-submenu-page3',
        'cardealer_gopro2_callback',
        8
    );
}



/*
$cardealer_gopro_page = add_submenu_page(
    'car_dealer_plugin', // $parent_slug
    'Go Pro', // string $page_title
    '<font color="#FF6600">' . __('Go Pro', 'cardealer') . '</font>', // string $menu_title
    'manage_options', // string $capability
    'cardealer_my-custom-submenu-page3',
    'cardealer_gopro2_callback',
    8
);
*/

/*
function cardealer_add_more_plugins()
{
    if (is_multisite()) {
        add_submenu_page(
            'car_dealer_plugin', // $parent_slug
            'More Tools Same Author', // string $page_title
            'More Tools Same Author', // string $menu_title
            'manage_options', // string $capability
            'cardealer_more_plugins', // menu slug
            'cardealer_more_plugins', // callable function
            9 // position
        );
	} else {

		add_submenu_page(
            'car_dealer_plugin', // $parent_slug
            'More Tools Same Author', // string $page_title
            'More Tools Same Author', // string $menu_title
            'manage_options', // string $capability
			// 'wptools_options39', // menu slug
			// 'wptools_new_more_plugins', // callable function
            'cardealer_new_more_plugins', // menu slug
            'cardealer_new_more_plugins', // callable function
			9 // position
		);
	}
}
*/

//  add_action('admin_menu', 'cardealer_add_more_plugins');
// add_action('admin_menu', 'cardealer_menu');

function cardealer_more_plugins() {

    echo '<script>';
    echo 'window.location.replace("'.esc_url(CARDEALERHOMEURL).'plugin-install.php?s=sminozzi&tab=search&type=author");';
    echo '</script>';
}

function cardealer_show_logo()
{
    echo '<div id="cardealers_logo" style="margin-top:10px;">';
    // echo '<br>';
    echo '<img src="';
    echo CARDEALERIMAGES . '/logo300.png';
    echo '">';
    echo '<br>';
    echo '</div>';
}

function cardealer_new_more_plugins()
{
  cardealer_show_logo();
	$plugins_to_install = array();
	$plugins_to_install[0]["Name"] = "Anti Hacker Plugin";
	$plugins_to_install[0]["Description"] = "Firewall, Scanner, Login Protect, block user enumeration and TOR, disable Json WordPress Rest API, xml-rpc (xmlrpc) & Pingback and more security tools...";
	$plugins_to_install[0]["image"] = "https://ps.w.org/cardealer/assets/icon-256x256.gif?rev=2524575";
	$plugins_to_install[0]["slug"] = "cardealer";
	$plugins_to_install[1]["Name"] = "Stop Bad Bots";
	$plugins_to_install[1]["Description"] = "Stop Bad Bots, Block SPAM bots, Crawlers and spiders also from botnets. Save bandwidth, avoid server overload and content steal. Blocks also by IP.";
	$plugins_to_install[1]["image"] = "https://ps.w.org/stopbadbots/assets/icon-256x256.gif?rev=2524815";
	$plugins_to_install[1]["slug"] = "stopbadbots";
	$plugins_to_install[2]["Name"] = "WP Tools";
	$plugins_to_install[2]["Description"] = "More than 35 useful tools! It is a swiss army knife, to take your site to the next level.";
	$plugins_to_install[2]["image"] = "https://ps.w.org/wptools/assets/icon-256x256.gif?rev=2526088";
	$plugins_to_install[2]["slug"] = "wptools";
	$plugins_to_install[3]["Name"] = "reCAPTCHA For All";
	$plugins_to_install[3]["Description"] = "Protect ALL Pages of your site against bots (spam, hackers, fake users and other types of automated abuse)
	with invisible reCaptcha V3 (Google). You can also block visitors from China.";
	$plugins_to_install[3]["image"] = "https://ps.w.org/recaptcha-for-all/assets/icon-256x256.gif?rev=2544899";
	$plugins_to_install[3]["slug"] = "recaptcha-for-all";
	$plugins_to_install[4]["Name"] = "WP Memory";
	$plugins_to_install[4]["Description"] = "Check High Memory Usage, Memory Limit, PHP Memory, show result in Site Health Page and fix php low memory limit.";
	$plugins_to_install[4]["image"] = "https://ps.w.org/wp-memory/assets/icon-256x256.gif?rev=2525936";
	$plugins_to_install[4]["slug"] = "wp-memory";
	$plugins_to_install[5]["Name"] = "Truth Social";
	$plugins_to_install[5]["Description"] = "Tools and feeds for Truth Social new social media platform and Twitter.";
	$plugins_to_install[5]["image"] = "https://ps.w.org/toolstruthsocial/assets/icon-256x256.png?rev=2629666";
	$plugins_to_install[5]["slug"] = "toolstruthsocial";
?>
	<div style="padding-right:20px;">
		<br>
		<h1>Useful FREE Plugins of the same author</h1>
		<div id="bill-wrap-install" class="bill-wrap-install" style="display:none">
			<h3>Please wait</h3>
			<big>
				<h4>
					Installing plugin <div id="billpluginslug">...</div>
				</h4>
			</big>
			<img src="/wp-admin/images/wpspin_light-2x.gif" id="billimagewaitfbl" style="display:none;margin-left:0px;margin-top:0px;" />
			<br />
		</div>
		<table style="margin-right:20px; border-spacing: 0 25px; " class="widefat" cellspacing="0" id="cardealer-more-plugins-table">
			<tbody class="cardealer-more-plugins-body">
				<?php
				$counter = 0;
				$total = count($plugins_to_install);
				for ($i = 0; $i < $total; $i++) {
					if ($counter % 2 == 0) {
						echo '<tr style="background:#f6f6f1;">';
					}
					++$counter;
					if ($counter % 2 == 1)
						echo '<td style="max-width:140px; max-height:140px; padding-left: 40px;" >';
					else
						echo '<td style="max-width:140px; max-height:140px;" >';
					echo '<img style="width:100px;" src="' . esc_url($plugins_to_install[$i]["image"]) . '">';
					echo '</td>';
					echo '<td style="width:40%;">';
					echo '<h3>' . esc_attr($plugins_to_install[$i]["Name"]) . '</h3>';
					echo esc_attr($plugins_to_install[$i]["Description"]);
					echo '<br>';
					echo '</td>';
					echo '<td style="max-width:140px; max-height:140px;" >';
					if (cardealer_plugin_installed($plugins_to_install[$i]["slug"]))
						echo '<a href="#" class="button activate-now">Installed</a>';
					else
						echo '<a href="#" id="' . esc_attr($plugins_to_install[$i]["slug"]) . '"class="button button-primary cd-bill-install-now">Install</a>';
					echo '</td>';
					if ($counter % 2 == 1) {
						echo '<td style="width; 100px; border-left: 1px solid gray;">';
						echo '</td>';
					}
					if ($counter % 2 == 0) {
						echo '</tr>';
					}
				}
				?>
			</tbody>
		</table>
	</div>
<?php
}
function cardealer_plugin_installed($slug)
{
	$all_plugins = get_plugins();
	foreach ($all_plugins as $key => $value) {
		$plugin_file = $key;
		$slash_position = strpos($plugin_file, '/');
		$folder = substr($plugin_file, 0, $slash_position);
		// match FOLDER against SLUG
		if ($slug == $folder) {
			return true;
		}
	}
	return false;
}


function cardealer_load_upsell()
{
	wp_enqueue_style('cardealer-more2', CARDEALERURL . 'includes/more/more2.css');
	wp_register_script('cardealer-more2-js', CARDEALERURL . 'includes/more/more2.js', array('jquery'));
	wp_enqueue_script('cardealer-more2-js');
    $cardealer_bill_go_pro_hide = trim(get_option('cardealer_bill_go_pro_hide'));
    // $cardealer_bill_go_pro_hide = '';
    // Debug ...
    $wtime = strtotime('-08 days');
    // update_option('cardealer_bill_go_pro_hide', $wtime);
    if(empty ($cardealer_bill_go_pro_hide)) {
        $wtime = strtotime('-05 days');
        update_option('cardealer_bill_go_pro_hide', $wtime);
        $cardealer_bill_go_pro_hide =  $wtime;
    }
    $now = time();
    $delta = $now - $cardealer_bill_go_pro_hide;
    if ($delta > (3600 * 24 * 6)) {
        require_once(CARDEALERPATH . 'includes/vendor/vendor.php');
        wp_enqueue_style('bill-css-vendor-fix', CARDEALERURL . 'includes/vendor/vendor_fix.css');
    }
    wp_register_script("bill-js-vendor", CARDEALERURL . 'includes/vendor/vendor.js', array('jquery'), CARDEALERVERSION, true);
    wp_enqueue_script('bill-js-vendor');
    wp_enqueue_style('bill-css-vendor', CARDEALERURL . 'includes/vendor/vendor.css');
}




if (!function_exists('wp_get_current_user')) {
	require_once(ABSPATH . "wp-includes/pluggable.php");
}
if (is_admin() or is_super_admin()) {
	add_action('admin_enqueue_scripts', 'cardealer_load_upsell');
	add_action('wp_ajax_cardealer_install_plugin', 'cardealer_install_plugin');
}
function cardealer_install_plugin()
{
	if (isset($_POST['slug'])) {
		$slug = sanitize_text_field($_POST['slug']);
	} else {
		echo 'Fail error (-5)';
		wp_die();
	}
	$plugin['source'] = 'repo'; // $_GET['plugin_source']; // Plugin source.
	require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // Need for plugins_api.
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; // Need for upgrade classes.
	// get plugin information
	$api = plugins_api('plugin_information', array('slug' => $slug, 'fields' => array('sections' => false)));
	if (is_wp_error($api)) {
		echo 'Fail error (-1)';
		wp_die();
		// proceed
	} else {
		// Set plugin source to WordPress API link if available.
		if (isset($api->download_link)) {
			$plugin['source'] = $api->download_link;
			$source =  $api->download_link;
		} else {
			echo 'Fail error (-2)';
			wp_die();
		}
		$nonce = 'install-plugin_' . $api->slug;
		/*
        $type = 'web';
        $url = $source;
        $title = 'wptools';
        */
		$plugin = $slug;
		// verbose...
		//    $upgrader = new Plugin_Upgrader($skin = new Plugin_Installer_Skin(compact('type', 'title', 'url', 'nonce', 'plugin', 'api')));
		class cardealer_QuietSkin extends \WP_Upgrader_Skin
		{
			public function feedback($string, ...$args)
			{ /* no output */
			}
			public function header()
			{ /* no output */
			}
			public function footer()
			{ /* no output */
			}
		}
		$skin = new cardealer_QuietSkin(array('api' => $api));
		$upgrader = new Plugin_Upgrader($skin);
		// var_dump($upgrader);
		try {
			$upgrader->install($source);
			//	get all plugins
			$all_plugins = get_plugins();
			// scan existing plugins
			foreach ($all_plugins as $key => $value) {
				// get full path to plugin MAIN file
				// folder and filename
				$plugin_file = $key;
				$slash_position = strpos($plugin_file, '/');
				$folder = substr($plugin_file, 0, $slash_position);
				// match FOLDER against SLUG
				// if matched then ACTIVATE it
				if ($slug == $folder) {
					// Activate
					$result = activate_plugin(ABSPATH . 'wp-content/plugins/' . $plugin_file);
					if (is_wp_error($result)) {
						// Process Error
						echo 'Fail error (-3)';
						wp_die();
					}
				} // if matched
			}
		} catch (Exception $e) {
			echo 'Fail error (-4)';
			wp_die();
		}
	} // activation
	echo 'OK';
	wp_die();
}


// require_once(CARDEALERPATH . 'includes/vendor/vendor.php');

/*
function cardealer_load_vendor22()
{

       wp_register_script("bill-js-vendor", CARDEALERURL . 'includes/vendor/vendor.js', array('jquery'), CARDEALERVERSION, true);
       wp_enqueue_script('bill-js-vendor');
   
       wp_enqueue_style('bill-css-vendor', CARDEALERURL . 'includes/vendor/vendor.css');
   
}
*/

  // if (is_admin() or is_super_admin()) {
//////	add_action('admin_enqueue_scripts', 'cardealer_load_vendor22');
	//add_action('wp_ajax_antihacker_install_plugin', 'antihacker_install_plugin');
//}






/*
function antihacker_show_logo()
{
    echo '<div id="antihacker_logo" style="margin-top:10px;">';
    // echo '<br>';
    echo '<img src="';
    echo ANTIHACKERIMAGES . '/logo.png';
    // https://boatplugin.com/wp-content/plugins/antihacker/assets/images/logo.png
    echo '">';
    echo '<br>';
    echo '</div>';
}
*/
// add_action('admin_menu', 'cardealer_add_menu_items9');

/*
function cardealer_add_menu_gopro2()
{
    $cardealer_gopro_page = add_submenu_page(
        'car_dealer_plugin', // $parent_slug
        'Go Pro', // string $page_title
        '<font color="#FF6600">' . __('Go Pro', 'cardealer') . '</font>', // string $menu_title
        'manage_options', // string $capability
        'cardealer_my-custom-submenu-page3',
        'cardealer_gopro2_callback',
        8
    );
}

function cardealer_add_menu_items9()
{
        $antihacker_gopro_page = add_submenu_page(
            'car_dealer_plugin', // $parent_slug
            'Go Pro', // string $page_title
            '<font color="#FF6600">Go Pro</font>', // string $menu_title
            'manage_options', // string $capability
            'antihacker_my-custom-submenu-page9',
            'antihacker_gopro_callback9',
            9
        );
}
*/

/*
function cardealer_plugin_row_meta($links, $file)
{
	if (strpos($file, 'cardealer.php') !== false) {


		if (is_multisite()) 
		    $url = CARDEALERHOMEURL . "plugin-install.php?s=sminozzi&tab=search&type=author";
     	else
	    	$url = CARDEALERHOMEURL . "admin.php?page=cardealer_new_more_plugins";


		$new_links['Pro'] = '<a href="' . $url . '" target="_blank"><b><font color="#FF6600">Click To see more plugins from same author</font></b></a>';
		$links = array_merge($links, $new_links);
	}
	return $links;
}
*/
// add_filter('plugin_row_meta', 'cardealer_plugin_row_meta', 10, 2);




/*

$billurl = 'https://boatplugin.com/';

echo $billurl. 'wp-includes/js/thickbox.js';
die();
*/

 



?>