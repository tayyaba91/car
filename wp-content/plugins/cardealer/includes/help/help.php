<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
if (is_admin()) {
    add_action('current_screen', 'cardealer_this_screen');

    function cardealer_this_screen()
    {
        // removed add_filter('contextual_help', 'CarDealer_contextual_help_fields', 10, 3);
        // called functions...directly

        require_once ABSPATH . 'wp-admin/includes/screen.php';
        $current_screen = get_current_screen();


        if ($current_screen->id === "edit-cardealerfields") {
            CarDealer_contextual_help_fields($current_screen);

        } elseif ($current_screen->id === "cars") {
            CarDealer_contextual_help_cars($current_screen);
        } elseif ($current_screen->id === "edit-team") {
            CarDealer_contextual_help_agents($current_screen);
        } elseif ($current_screen->id === "edit-locations") {
            CarDealer_contextual_help_locations($current_screen);
        } elseif ($current_screen->id === "edit-makes") {
            CarDealer_contextual_help_makes($current_screen);
        } elseif ($current_screen->id === "toplevel_page_car_dealer_plugin" or $current_screen->id === "admin_page_cardealer_settings") {
             CarDealer_main_help($current_screen);
        } else {
            if (isset($_GET['page'])) {
                if (sanitize_text_field($_GET['page']) == 'car_dealer_plugin') {
                    CarDealer_main_help($current_screen);
                }
            }
        }


    }
}
function CarDealer_main_help($screen)
{
    $myhelp = '<br> The easiest way to manage, list and sell yours cars online.';
    $myhelp .= '<br />';
    $myhelp .= 'Follow the 3 steps in the Dashboard screen (Car Dealer => Dashboad) after install the plugin. <br />';
    $myhelp .= '<br />';
    $myhelp .= 'You will find Context Help in many screens.';
    $myhelp .= '<br />';
    $myhelp .= 'You can find also our complete OnLine Guide  <a href="http://cardealerplugin.com/help/index.html" target="_self">here.</a>';
    $myhelpdemo = '<br />';
    $myhelpdemo .= 'If you want to import demo data, download the demo data from this link:';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= 'http://cardealerplugin.com/demo-data/download-demo.php';
    $myhelpdemo .= '<br /><br />';
    $myhelpdemo .= 'After download:';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '1. Log in to that site as an administrator. ';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '2. Go to Tools: Import in the WordPress admin panel.';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '3. Install the "WordPress" importer from the list.';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '4. Activate & Run Importer.';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '5. Upload the file downloaded using the form provided on that page.';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '6. You will first be asked to map the authors in this export file to users';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= 'on the site. For each author, you may choose to map to an';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= 'existing user on the site or to create a new user. ';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '7. WordPress will then import the demo data into you site.';
    $myhelpdemo .= '<br />';
    $screen->add_help_tab(array(
        'id' => 'CarDealer-overview-tab',
        'title' => __('Overview', 'cardealer'),
        'content' => '<p>' . $myhelp . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'import-demo',
        'title' => __('Import Demo Data', 'cardealer'),
        'content' => '<p>' . $myhelpdemo . '</p>',
    ));
    return;
    // $contextual_help;
}
function CarDealer_contextual_help_fields($screen)
{
    $myhelp = 'In the FIELDS screen you can manage the main table fields.
    This fields will show up
    in your main cars form management, search bar and search widget.
    <br />
    Each row represents one field.
    <br />
    For example:
    <br />
    <ul>
    <li>Number Doors</li>
    <li>Number Passengers</li>
    <li>Alarm</li>
    <li>And So On</li>
    </ul>
    <br />
    You don\'t need include this fields: Price, Year, Miles, HP, Transmission Type, Fuel Type, Condition and Featured.
     <br />    <br />
    Technical WordPress guys call this of Metadata.
    <br />
    Don\'t create 2 fields with the same name.
    <br />
    <br />
    ';
    $myhelpAdd = 'To add fields in the table, click the button Add New. This can open the empty window to include your information:
     <br />
    <ul>
    <li>Field Name</li>
    <li>Field Label</li>
    <li>Field Order</li>
    <li>Show in Search Bar (your frontpage)</li>
    <li>Show in Search Widget (your frontpage)</li>
    <li>Type of Field</li>
    <li>And So On</li>
    </ul>
    In that screen, move the mouse pointer over each field to get help about that field.
    <br />
    Just fill out and click OK button.
    <br />
     ';
    $myhelpTypes = 'You have available this types of fields (Control Types):
    <br />
    <ul>
    <li>Text (Used by text and numbers). It is not possible include this type of field in Search Bars.</li>
    <li>CheckBox</li>
    <li>Drop Down (also called select box)</li>
    <li>Range Select (you can define de value min, max and step)</li>
    <!-- <li>Range Slider (you can define de value min, max and step)</li>  -->
    </ul>
    <br />
    For more details about HTML input types, please, check this page:
<a href="https://www.w3schools.com/html/html_form_input_types.asp ">https://www.w3schools.com/html/html_form_input_types.asp
</a>
   <br />
';
    $myhelpEdit = 'You can manage the table, i mean, Add, Edit and Trash Fields.
    <br />
    At the Add Fields and Edit Fields forms, put the mouse over each row and the menu show up. Then, click over Edit or Trash.
    <br />
    To know more about Edit Fields, please, check the Add Fields Form Option at this help menu.
     ';
    $screen->add_help_tab(array(
        'id' => 'CarDealer-overview-tab',
        'title' => __('Overview', 'cardealer'),
        'content' => '<p>' . $myhelp . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'CarDealer-field-types',
        'title' => __('Field Types', 'cardealer'),
        'content' => '<p>' . $myhelpTypes . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'CarDealer-overview-add',
        'title' => __('Add Fields Form', 'cardealer'),
        'content' => '<p>' . $myhelpAdd . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'CarDealer-field-edit',
        'title' => __('Edit and Trash Fields', 'cardealer'),
        'content' => '<p>' . $myhelpEdit . '</p>',
    ));
    return;
}
function CarDealer_contextual_help_cars($screen)
{
    $myhelp = 'In the CARS screen you can manage (include, edit or delete) items in your Cars table.
    This cars will show up in your site front page.
    <br />
    We suggest you take some time to complete your Field table before this step.
    <br />
    Dashboard => CarDealer => Fields Table.
    <br />
    You will find some fields automatically included by the system (Price, Year, Miles, HP, Transmission type, Type, Fuel, Condition and Featured).
).
    Just add your cars in this table.
    <br />
    ';
    $myhelpAdd = 'To add fields in the table, click the button Add New. This can open the empty window to include your information:
     <br />
    <ul>
    <li>Field Name</li>
    <li>Field Label</li>
    <li>Field Order</li>
    <li>Show in Search Bar (your frontpage)</li>
    <li>Show in Search Widget (your frontpage)</li>
    <li>Type of Field</li>
    <li>And So On</li>
    </ul>
    In that screen, move the mouse pointer over each field to get help about that field.
    <br />
    Just fill out and click OK button.
    <br />
     ';
    $myhelpAgents = 'Use the Team control it is optional. To add new members, go to:
    <br />
    Dashboard=> Car Dealer => Team
    <br />
    <br />
';
    $myhelpLocation = 'Use the Location control it is optional. Maybe you want use it if you have more than one location.
    To add new locations, go to:
    <br />
    Dashboard=> Car Dealer => Locations
    <br />
    If you are, for example, in Florida, maybe you want add:
    <ul>
    <li>Fort Lauderdale</li>
    <li>Miami</li>
    <li>And So On...</li>
    </ul>
    <br />
   <br />
';
    $myhelpMake = 'Use the Makes control it is optional.
    To add new makes, go to:
    <br />
    Dashboard=> Car Dealer => Makes
    <br />
    Maybe you want add:
    <ul>
    <li>Ford</li>
    <li>Toyota</li>
    <li>And So On...</li>
    </ul>
    <br />
   <br />
';
    $myhelpEdit = 'You can manage the table, i mean, Add, Edit and Trash Cars.
    <br />
    Use the Add New Buttom or to Edit, put the mouse over each row and the menu will show up. Then, click over Edit or Trash.
    <br />
     ';
    $myhelpFeatured = 'You can add one main image to each car.
    In the Cars Form, click the button Set Featured Image at bottom right corner.
    <br />
    Read below Images and Gallery menu voice about how to create a Image\'s gallery with many images to show up at the top of your car\'s page.
    <br />
    <br />
     ';
    $myhelpGallery = 'You can add many Images or one gallery for each car.
    Just go to Cars Form and add the images (or the gallery) in the main description field (click the Add Media buttom).
    <br />
    Use the default WordPress Gallery or our plugin will create automatically one nice slider gallery. To enable the plugin gallery, go to
    <br />
    Dashboard => Car Dealer => Settings
    <br />
    and look for <em>Replace the Wordpress Gallery with Flexslider Gallery</em>?
    <br />
    Then, check Yes and Save Changes.
    <br />
    This images and gallery will be visible in single car page.
    <br />
    Look <a href="http://cardealerplugin.com/upload-images/">our demo</a> about how to upload and crop images easily (less than 2 minutes).
    <br />
    To get more info about galleries, <a href="https://en.support.wordpress.com/gallery/" target="_blank">visit WordPress Help site.</a>.
    <br />
     ';
    $screen->add_help_tab(array(
        'id' => 'CarDealer-overview-tab',
        'title' => __('Overview', 'cardealer'),
        'content' => '<p>' . $myhelp . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'CarDealer-cars-agents',
        'title' => __('Team', 'cardealer'),
        'content' => '<p>' . $myhelpAgents . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'CarDealer-cars-location',
        'title' => __('Location', 'cardealer'),
        'content' => '<p>' . $myhelpLocation . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'CarDealer-cars-makes',
        'title' => __('Makes', 'cardealer'),
        'content' => '<p>' . $myhelpMake . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'CarDealer-cars-edit',
        'title' => __('Edit and Trash Cars', 'cardealer'),
        'content' => '<p>' . $myhelpEdit . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'CarDealer-cars-featured',
        'title' => __('Featured Image', 'cardealer'),
        'content' => '<p>' . $myhelpFeatured . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'CarDealer-cars-gallery',
        'title' => __('Images and Gallery', 'cardealer'),
        'content' => '<p>' . $myhelpGallery . '</p>',
    ));
    return;
}
function CarDealer_contextual_help_agents($screen)
{
    $myhelpAgents = 'Use the Team table it is optional.
    <br />
';
    $screen->add_help_tab(array(
        'id' => 'CarDealer-overview-tab',
        'title' => __('Overview', 'cardealer'),
        'content' => '<p>' . $myhelpAgents . '</p>',
    ));
    return;
}
function CarDealer_contextual_help_locations($screen)
{
    $myhelpLocation = 'Use the Location table it is optional. Maybe you want use it if you have more than one location.
    <br />
    If you are, for example, in Florida, maybe you want add:
    <ul>
    <li>Fort Lauderdale</li>
    <li>Miami</li>
    <li>And So On...</li>
    </ul>
   <br />
';
    $screen->add_help_tab(array(
        'id' => 'CarDealer-overview-tab',
        'title' => __('Overview', 'cardealer'),
        'content' => '<p>' . $myhelpLocation . '</p>',
    ));
    return;
}
function CarDealer_contextual_help_makes($screen)
{
    $myhelpMake = 'Use the Makes control it is optional.
    To add new makes, go to:
    <br />
    Dashboard=> Car Dealer => Makes
    <br />
    Maybe you want add:
    <ul>
    <li>Ford</li>
    <li>Toyota</li>
    <li>And So On...</li>
    </ul>
    <br />
   <br />
';
    $screen->add_help_tab(array(
        'id' => 'CarDealer-overview-tab',
        'title' => __('Overview', 'cardealer'),
        'content' => '<p>' . $myhelpMake . '</p>',
    ));
    return;
}
/////////// Pointers ////////////////
add_action('admin_enqueue_scripts', 'cardealer_adm_enqueue_scripts2');
function cardealer_adm_enqueue_scripts2()
{
    global $bill_current_screen;
    // wp_enqueue_style( 'wp-pointer' );
    wp_enqueue_script('wp-pointer');
    require_once ABSPATH . 'wp-admin/includes/screen.php';
    $myscreen = get_current_screen();
    $bill_current_screen = $myscreen->id;
    if ($bill_current_screen == 'cars' or $bill_current_screen == 'toplevel_page_car_dealer_plugin' or $bill_current_screen == 'edit-cardealerfields') 
    {} else {
        return;
    }
    $dismissed = explode(',', (string) get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true));
    if (in_array($bill_current_screen, $dismissed)) {
        return;
    }
    if (get_option('CarDealer_activated', '0') == '1') 
        add_action('admin_print_footer_scripts', 'cardealer_admin_print_footer_scripts');
}
function cardealer_admin_print_footer_scripts()
{
    global $bill_current_screen;
    $pointer_content = '<h3>Help Available for this Window!</h3>';
    $pointer_content .= '<p>Just Click Help Button to get content help for this window.';
    ?>
        <script type="text/javascript">
        //<![CDATA[
            // setTimeout( function() { this_pointer.pointer( 'close' ); }, 400 );
        jQuery(document).ready( function($) {
            $('#contextual-help-link').pointer({
                content: '<?php echo $pointer_content; ?>',
                position: {
                        edge: 'top',
                        align: 'right'
                    },
                close: function() {
                    // Once the close button is hit
                    $.post( ajaxurl, {
                            pointer: '<?php echo $bill_current_screen; ?>',
                            action: 'dismiss-wp-pointer'
                        });
                }
            }).pointer('open');
            /* $('.wp-pointer-undefined .wp-pointer-arrow').css("right", "50px"); */
        });
        //]]>
        </script>
        <?php
}
?>
