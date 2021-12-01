<?php

/**
 * @author Bill Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
function cardealer_reorder_terms()
{
    global $wpdb;
    $args = array(
        'taxonomy' => 'team',
        'hide_empty' => false,
    );
    $terms = get_terms($args);
    $qteam = count($terms);
    $Cardealerteam = array();
    if ($qteam > 0) {
        $i = 0;
        foreach ($terms as $term) {
            $id = $term->term_id;
            $termMeta = get_option('team_' . $id);
            $Cardealerteam[$i]['name'] =  $term->name;
            $Cardealerteam[$i]['description'] =  $term->description;
            $Cardealerteam[$i]['image'] = $termMeta['image'];
            $Cardealerteam[$i]['function'] = $termMeta['function'];
            $Cardealerteam[$i]['phone'] = $termMeta['phone'];
            $Cardealerteam[$i]['email'] = $termMeta['email'];
            $Cardealerteam[$i]['skype'] = $termMeta['skype'];
            $Cardealerteam[$i]['facebook'] = $termMeta['facebook'];
            $Cardealerteam[$i]['twitter'] = $termMeta['twitter'];
            $Cardealerteam[$i]['linkedin'] = $termMeta['linkedin'];
            $Cardealerteam[$i]['vimeo'] = $termMeta['vimeo'];
            $Cardealerteam[$i]['instagram'] = $termMeta['instagram'];
            $Cardealerteam[$i]['youtube'] = $termMeta['youtube'];
            $Cardealerteam[$i]['myorder'] = $termMeta['myorder'];
            $i++;
        }
        function cmp($a, $b)
        {
            return strcmp($a["myorder"], $b["myorder"]);
        }
        if ($i > 1)
            usort($Cardealerteam, "cmp");
    }
    return $Cardealerteam;
}
function cardealer_message_low_memory()
{
    echo '<div class="notice notice-warning">
                     <br />
                     <b>
                     Car Dealer Plugin Warning: You need increase the WordPress memory limit!
                     <br />
                     Please, check 
                     <br />
                     Dashboard => Car Dealer => (tab) Memory Checkup
                     <br /><br />
                     </b>
                     </div>';
}
function cardealer_check_memory()
{
    global $cardealer_memory;
    $cardealer_memory['limit'] = (int) ini_get('memory_limit');
    $cardealer_memory['usage'] = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 0) : 0;
    if (!defined("WP_MEMORY_LIMIT")) {
        $cardealer_memory['msg_type'] = 'notok';
        return;
    }
    $cardealer_memory['wp_limit'] =  trim(WP_MEMORY_LIMIT);
    if ($cardealer_memory['wp_limit'] > 9999999)
        $cardealer_memory['wp_limit'] = ($cardealer_memory['wp_limit'] / 1024) / 1024;
    if (!is_numeric($cardealer_memory['usage'])) {
        $cardealer_memory['msg_type'] = 'notok';
        return;
    }
    if (!is_numeric($cardealer_memory['limit'])) {
        $cardealer_memory['msg_type'] = 'notok';
        return;
    }
    if ($cardealer_memory['usage'] < 1) {
        $cardealer_memory['msg_type'] = 'notok';
        return;
    }
    $wplimit = $cardealer_memory['wp_limit'];
    $wplimit = substr($wplimit, 0, strlen($wplimit) - 1);
    $cardealer_memory['wp_limit'] = $wplimit;
    $cardealer_memory['percent'] = $cardealer_memory['usage'] / $cardealer_memory['wp_limit'];
    $cardealer_memory['color'] = 'font-weight:normal;';
    if ($cardealer_memory['percent'] > .7) $cardealer_memory['color'] = 'font-weight:bold;color:#E66F00';
    if ($cardealer_memory['percent'] > .85) $cardealer_memory['color'] = 'font-weight:bold;color:red';
    $cardealer_memory['msg_type'] = 'ok';
    return $cardealer_memory;
}
function cardealer_howmanycars()
{
    global $wpdb;
    $posts = get_posts(array(
        'post_type'            => 'cars'
    ));
    $number = 0;
    if ($posts) {
        foreach ($posts as $post) {
            $number++;
        }
    }
    return $number;
}
add_action('wp_loaded', 'car_get_makes');
function car_get_makes()
{
    global $wpdb;
    $carmake = array();
    $args = array(
        'taxonomy'               => 'makes',
        'orderby'                => 'name',
        'order'                  => 'ASC',
        'hide_empty'             => false,
    );
    $the_query = new WP_Term_Query($args);
    foreach ($the_query->get_terms() as $term) {
        $carmake[] = $term->name;
    }
    $qtypes = count($carmake);
    if ($qtypes < 1) {
        $atypes = array("Dodge", "Ford", "Mercedes", "Other");
        $parent_term = term_exists('makes', 'cars'); // array is returned if taxonomy is given
        $parent_term_id = $parent_term['term_id']; // get numeric term id
        for ($i = 0; $i < 4; $i++) {
            wp_insert_term(
                $atypes[$i],
                'makes',
                array(
                    'slug' =>  $atypes[$i],
                )
            );
        }
        $carmake = $atypes;
    }
    return $carmake;
}
function cardealer_update_files()
{
    global $wpdb;
    $args = array('post_type' => 'cars');
    $posts = get_posts($args);
    foreach ($posts as $post) {
        $post_id = $post->ID;
        $value = get_post_meta($post_id, 'body_color', true);
        if (!empty($value))
            update_post_meta($post_id, 'car-body_color', $value);
    }
}
function cardealer_check_field_exist($field_id)
{
    $afieldsId = cardealer_get_fields('all');
    $totfields = count($afieldsId);
    $ametadataoptions = array();
    for ($i = 0; $i < $totfields; $i++) {
        $post_id = $afieldsId[$i];
        $ametadata = cardealer_get_meta($post_id);
        if (trim($ametadata[12]) == trim($field_id))
            return true;
    }
    return false;
}
function cardealer_add_new_field($fields, $fieldsv)
{
    $mypost = array(
        'post_title' => sanitize_text_field($fieldsv[12]),
        'post_type' => 'cardealerfields',
        'post_status' => 'publish',
    );
    $post_id = wp_insert_post($mypost);
    $tot = count($fields);
    for ($i = 0; $i < ($tot) - 1; $i++) {
        $meta_key = $fields[$i];
        $meta_value = trim($fieldsv[$i]);
        update_post_meta($post_id, $meta_key, $meta_value);
    }
}
function cardealer_add_default_fields()
{
    $fields = array(
        'field-label',
        'field-typefield',
        'field-drop_options',
        'field-searchbar',
        'field-searchwidget',
        'field-rangemin',
        'field-rangemax',
        'field-rangestep',
        'field-slidemin',
        'field-slidemax',
        'field-slidestep',
        'field-order',
        'field-name'
    );
    $atypes = array(
        __("Coupe", "cardealer"),
        __("Luxury Car", "cardealer"),
        __("Sedan", "cardealer"),
        __("Sports Car", "cardealer"),
        __("Sport Utility Vehicle", "cardealer"),
        __("Van", "cardealer"),
        __("Wagon", "cardealer"),
        __("Other", "cardealer")
    );
    $n = count($atypes);
    $bodytypes = '';
    for ($j = 0; $j < $n; $j++) {
        $bodytypes .= $atypes[$j];
        if (($j + 1) < $n)
            $bodytypes .= PHP_EOL;
    }
    $acondition = 'New';
    $acondition .= PHP_EOL;
    $acondition .= 'Used';
    $acondition .= PHP_EOL;
    $acondition .= 'Damaged';
    $allfields = array(
        $fieldsv = array(
            'Body Type',
            'dropdown',
            $bodytypes,
            // '',
            '1',
            '1',
            '',
            '',
            '',
            '',
            '',
            '',
            '10',
            'type'
        ),
        $fieldsv = array(
            'Condition',
            'dropdown',
            $acondition,
            '1',
            '1',
            '',
            '',
            '',
            '',
            '',
            '',
            '11',
            'con'
        ),
        $fieldsv = array(
            'Model',
            'text',
            '',
            '0',
            '0',
            '',
            '',
            '',
            '',
            '',
            '',
            '12',
            'model'
        ),
        $fieldsv = array(
            'Engine',
            'text',
            '',
            '0',
            '0',
            '',
            '',
            '',
            '',
            '',
            '',
            '13',
            'engine'
        ),
        $fieldsv = array(
            'Body Color',
            'text',
            '',
            '0',
            '0',
            '',
            '',
            '',
            '',
            '',
            '',
            '14',
            'body_color'
        ),
        $fieldsv = array(
            'Passenger Capacity',
            'text',
            '',
            '0',
            '0',
            '',
            '',
            '',
            '',
            '',
            '',
            '15',
            'capacity'
        ),
        $fieldsv = array(
            'Interior Color',
            'text',
            '',
            '0',
            '0',
            '',
            '',
            '',
            '',
            '',
            '',
            '16',
            'int'
        ),
        $fieldsv = array(
            'Interior Material',
            'text',
            '',
            '0',
            '0',
            '',
            '',
            '',
            '',
            '',
            '',
            '17',
            'mat'
        )
    ); // end all fields
    $totnewfields = count($allfields);
    for ($i = 0; $i < $totnewfields; $i++) {
        if (!cardealer_check_field_exist($allfields[$i][12])) {
            cardealer_add_new_field($fields, $allfields[$i]);
        }
    }
}
function cardealer_get_fields($type)
{
    global $wpdb;
    if (!function_exists('get_userdata()')) {
        include(ABSPATH . "/wp-includes/pluggable.php");
    }
    if ($type == 'search') {
        $args = array(
            'post_status' => 'publish',
            'post_type' => 'cardealerfields',
            'meta_key' => 'field-order',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(array('key' => 'field-searchbar', 'value' => '1'))
        );
    } elseif ($type == 'all') {
        $args = array(
            'post_status' => 'publish',
            'post_type' => 'cardealerfields',
            'meta_key' => 'field-order',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC'
        );
    } elseif ($type == 'widget') {
        $args = array(
            'post_status' => 'publish',
            'post_type' => 'cardealerfields',
            'meta_key' => 'field-order',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(array('key' => 'field-searchwidget', 'value' => '1'))
        );
    }
    query_posts($args);
    $afields = array();
    $afieldsid = array();
    while (have_posts()) :
        the_post();
        $afieldsid[] = esc_attr(get_the_ID());
    endwhile;
    ob_start();
    wp_reset_query();
    ob_end_clean();
    return $afieldsid;
} // end Funcrions
function cardealer_get_meta($post_id)
{
    $fields = array(
        'field-label',
        'field-typefield',
        'field-drop_options',
        'field-searchbar',
        'field-searchwidget',
        'field-rangemin',
        'field-rangemax',
        'field-rangestep',
        'field-slidemin',
        'field-slidemax',
        'field-slidestep',
        'field-order',
        'field-name'
    );
    $tot = count($fields);
    for ($i = 0; $i < $tot; $i++) {
        $field_value[$i] = esc_attr(get_post_meta($post_id, $fields[$i], true));
    }
    $field_value[$tot - 1] = esc_attr(get_the_title($post_id));
    return $field_value;
}
/*
function cardealer_get_types()
{
global $wpdb;
$productmake = array();  
$args = array(
'taxonomy'               => 'team',
'orderby'                => 'name',
'order'                  => 'ASC',
'hide_empty'             => false,
);
$the_query = new WP_Term_Query($args);
$productmake = array();  
foreach($the_query->get_terms() as $term){ 
$productmake[] = $term->name;
}
return $productmake; 
}
*/
function cardealer_get_max()
{
    global $wpdb;
    $args = array(
        'numberposts' => 1,
        'post_type' => 'cars',
        'meta_key' => 'car-price',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
    );
    $posts = get_posts($args);
    foreach ($posts as $post) {
        $x = get_post_meta($post->ID, 'car-price', true);
        if (!empty($x)) {
            $x = (int)$x;
            if (is_int($x)) {
                $x = ($x) * 1.2;
                $x = round($x, 0, PHP_ROUND_HALF_EVEN);
                //return $x;
            }
        }
        if ($x < 1)
            return '100000';
        else
            return $x;
    }
}
//add_action( 'wp_loaded', 'cardealer_get_types' );
function cardealer_currency()
{
    $currency =  get_option('CarDealercurrency');
    if ($currency == 'AUD') {
        return "AUD";
    }
    //  Bulgarian Bulgarian lev BGN
    if ($currency == 'Bulgarian') {
        return "lev BGN";
    }
    if ($currency == 'Dollar') {
        return "$";
    }
    if ($currency == 'Euro') {
        return "&euro;";
    }
    if ($currency == 'Forint') {
        return "Ft"; /* Ft or HUF is also perfect for me. */
    }
    if ($currency == 'Indian') {
        return "₹";
    }
    if ($currency == 'Naira') {
        return "₦";
    }
    if ($currency == 'Pound') {
        return "&pound;";
    }
    if ($currency == 'Krone') {
        return "kr";
    }
    if ($currency == 'Kuna') {
        return "HRK";
    }
    if ($currency == 'Malaysia') {
        return "MYR";
    }
    if ($currency == 'Philippine') {
        // ₱
        return "&#8369;";
    }
    if ($currency == 'Pound') {
        return "&pound;";
    }
    if ($currency == 'Real') {
        return "R&#36;";
    }
    if ($currency == 'Swiss') {
        return "CHF";
    }
    if ($currency == 'Thai Bath') {
        return "฿";
    }
    if ($currency == 'Yen') {
        return "&yen;";
    }
    // Afric Sul
    if ($currency == 'Zar') {
        return "R"; /* Ft or HUF is also perfect for me. */
    }
    if ($currency == 'Universal') {
        return "&curren;";
    }
}
function CarDealer_localization_init_fail()
{
    echo '<div class="error notice">
                     <br />
                     cardealerPlugin: Could not load the localization file (Language file).
                     <br />
                     Please, take a look the online Guide item Plugin Setup => Language.
                     <br /><br />
                     </div>';
}
function CarDealer_Show_Notices1()
{
    echo '<div class="update-nag notice"><br />';
    echo 'Warning: Upload directory not found (CarDealer Plugin). Enable debug for more info.';
    echo '<br /><br /></div>';
}
function CarDealer_plugin_was_activated()
{
    echo '<div class="updated"><p>';
    //$bd_msg = '<img src="' . CARDEALERURL . 'assets/images/infox350.png" />';
    $bd_msg = '<h2>CarDealer Plugin was activated! </h2>';
    $bd_msg .= '<h3>For details and help, take a look at Car Dealer Dashboard at your left menu <br />';
    $bd_url = '  <a class="button button-primary" href="admin.php?page=car_dealer_plugin">or click here</a>';
    $bd_msg .= $bd_url;
    echo $bd_msg;
    echo "</p></h3></div>";
    $Multidealerplugin_installed = trim(get_option('Multidealerplugin_installed', ''));
    if (empty($Multidealerplugin_installed)) {
        add_option('Multidealerplugin_installed', time());
        update_option('Multidealerplugin_installed', time());
    }
}
/*
if (is_admin()) {
    if (get_option('CarDealer_activated', '0') == '1') {
        add_action('admin_notices', 'CarDealer_plugin_was_activated');
        $r = update_option('CarDealer_activated', '0');
        if (!$r)
            add_option('CarDealer_activated', '0');
    }
}
*/
if (!function_exists('write_log')) {
    function write_log($log)
    {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}
add_filter('plugin_row_meta', 'cardealer_custom_plugin_row_meta', 10, 2);
function cardealer_custom_plugin_row_meta($links, $file)
{
    if (strpos($file, 'cardealer.php') !== false) {
        $new_links = array(
            'OnLine Guide' =>
            '<a href="http://cardealerplugin.com/guide/" target="_blank">OnLine Guide</a>',
            'Pro' => '<a href="http://cardealerplugin.com/premium/" target="_blank"><b><font color="#FF6600">Go Pro</font></b></a>'
        );
        $links = array_merge($links, $new_links);
    }
    return $links;
}
function cardealer_get_page()
{
    $page = 1;
    $url = esc_url($_SERVER['REQUEST_URI']);
    $pieces = explode("/", $url);
    for ($i = 0; $i < count($pieces); $i++) {
        if ($pieces[$i] == 'page' and ($i + 1) < count($pieces)) {
            $page = $pieces[$i + 1];
            if (is_numeric($page))
                return $page;
        }
    }
    return $page;
}
function CarDealer_wrong_permalink()
{
    echo '<div class="notice notice-warning">
                     <br />
                     Car Dealer Plugin: Wrong Permalink settings !
                     <br />
                     Please, fix it to avoid 404 error page.
                     <br />
                     To correct, just follow this steps:
                     <br />
                     Dashboard => Settings => Permalinks => Post Name (check)
                     <br />  
                     Click Save Changes
                     <br /><br />
                     </div>';
}


$cardealerurl = esc_url($_SERVER['REQUEST_URI']);
if (strpos($cardealerurl, '/options-permalink.php') === false) {
    $permalinkopt = get_option('permalink_structure');
    if ($permalinkopt != '/%postname%/')
        add_action('admin_notices', 'CarDealer_wrong_permalink');
}


ob_start();
$num_fields = count(cardealer_get_fields('all'));
$num_cars = cardealer_howmanycars();
$updated_version =  trim(get_option('CarDealer_updated', ''));
if ($num_fields < 8 and $num_cars > 0) {
    if ($updated_version < 2) {
        $w = update_option('CarDealer_updated', '2');
        if (!$w)
            add_option('CarDealer_updated', '2');
        cardealer_add_default_fields();
    }
}
ob_end_clean();
function cardealer_control_availablememory()
{
    $cardealer_memory = cardealer_check_memory();
    if ($cardealer_memory['msg_type'] == 'notok')
        return;
    if ($cardealer_memory['percent'] > .7)
        add_action('admin_notices', 'cardealer_message_low_memory');
}
if (wp_get_theme() <> 'KarDealer')
    add_action('wp_loaded', 'cardealer_control_availablememory');
function cardealer_change_note_submenu_order($menu_ord)
{
    global $submenu;
    function cardealer_str_replace_json($search, $replace, $subject)
    {
        return json_decode(str_replace($search, $replace, json_encode($subject)), true);
    }
    $key = 'Car Dealer';
    $val =  __('Dashboard', 'cardealer');
    $submenu = cardealer_str_replace_json($key, $val, $submenu);
}
add_filter('custom_menu_order', 'cardealer_change_note_submenu_order');
function cardealer_submenu_order($menu_ord)
{
    global $submenu;
    // Enable the next line to see all menu orders
    // echo '<pre>'.print_r($submenu['car_dealer_plugin'],true).'</pre>';
    $arr = array();
    $arr[] = $submenu['car_dealer_plugin'][0];     //my original order was 5,10,15,16,17,18
    $arr[] = $submenu['car_dealer_plugin'][6];
    $arr[] = $submenu['car_dealer_plugin'][1];
    $arr[] = $submenu['car_dealer_plugin'][2];
    $arr[] = $submenu['car_dealer_plugin'][3];
    $arr[] = $submenu['car_dealer_plugin'][4];
    $arr[] = $submenu['car_dealer_plugin'][5];
    $arr[] = $submenu['car_dealer_plugin'][7];
    $submenu['car_dealer_plugin'] = $arr;
    return $menu_ord;
}
function cardealer_gopro2_callback()
{
    $urlgopro = "http://cardealerplugin.com/premium/";
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo $urlgopro; ?>";
        -->
    </script>
<?php
}
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
?>