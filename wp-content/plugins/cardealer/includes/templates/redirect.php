<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action("template_redirect", 'CarDealer_template_redirect');
function CarDealer_template_redirect()
{
    global $wp;
    global $query;
    global $wp_query;
    if (isset($_GET['CarDealer_search_type'])) {
        $CarDealer_search_type = sanitize_text_field($_GET['CarDealer_search_type']);
         $Cardealer_template_gallery = trim(get_option('CarDealer_template_gallery',
            'yes'));
        if ($Cardealer_template_gallery == 'yes')
            require_once (CARDEALERPATH . 'includes/templates/template-showroom2.php');
        else
            require_once (CARDEALERPATH . 'includes/templates/template-showroom3.php');
        die();
    }
   if (is_single()) {
        $cardealerurl = esc_url($_SERVER['REQUEST_URI']); 
        if (strpos($cardealerurl, '/product/') === false and strpos($cardealerurl, '/car/') === false ) 
            return;
        if (isset($wp->query_vars["post_type"])) {


            if ($wp->query_vars["post_type"] == "cars") {
                if (have_posts()) {


                    include (CARDEALERPATH . 'includes/templates/template-single.php');
                    die();
                }
            }
        }
    }
}