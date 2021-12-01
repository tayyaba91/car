<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action('wp_enqueue_scripts', 'CarDealerregister_slider');
function CarDealerregister_slider()
{
    wp_register_script('search-slider', CARDEALERURL .
        'includes/search/search_slider.js', array('jquery'), null, true);
    wp_enqueue_script('search-slider');
}
function CarDealer_search($is_show_room)
{
    global $postNumber, $wp, $post, $page_id, $meta_make, $meta_year;
    $my_title = __("Search", 'cardealer');
    if ($is_show_room == '0') // widget
        {
        $searchlabel = 'search-label-widget';
        $selectboxmeta = 'select-box-meta-widget';
        $selectbox = 'select-box-widget';
        $inputbox = 'input-box-widget';
        $searchItem = 'searchItem-widget';
        $searchItem2 = 'searchItem2-widget';
        $CarDealersubmitwrap = 'CarDealer-submitBtn-widget';
        $CarDealer_search_box = 'CarDealer-search-box-widget';
        $current_page_url = esc_url(home_url() . '/CarDealer_show_room_2/');
        $CarDealer_search_type = 'search-widget';
        $afieldsId = cardealer_get_fields('widget');
    } elseif ($is_show_room == '1') // pag
    {
        $searchlabel = 'search-label';
        $selectboxmeta = 'select-box-meta';
        $selectbox = 'select-box';
        $inputbox = 'input-box';
        $searchItem = 'searchItem';
        $searchItem2 = 'searchItem';
        $CarDealersubmitwrap = 'CarDealer-submitBtn';
        $CarDealer_search_box = 'CarDealer-search-box';
        $current_page_url = home_url(esc_url(add_query_arg(null, null)));
        $CarDealer_search_type = 'page';
        $afieldsId = cardealer_get_fields('search');
    } elseif ($is_show_room == '2') // search result
    {
        $searchlabel = 'search-label';
        $selectboxmeta = 'select-box-meta';
        $selectbox = 'select-box';
        $inputbox = 'input-box';
        $searchItem = 'searchItem';
        $searchItem2 = 'searchItem';
        $CarDealersubmitwrap = 'CarDealer-submitBtn';
        $CarDealer_search_box = 'CarDealer-search-box';
        $current_page_url = esc_url(home_url() . '/CarDealer_show_room_2/');
        $CarDealer_search_type = 'search-widget';
        $afieldsId = cardealer_get_fields('search');
    }
      //  $showsubmit = false; 
        $totfields = count($afieldsId);
        $ametadataoptions = array();
        $output = '<div class="' . $CarDealer_search_box . '">';
        $output .= '<div class="CarDealer-search-cuore">';
        $output .= '<div class="CarDealer-search-cuore-fields">';
        $output .= '<form method="get" id="searchform3" action="' . $current_page_url . '">';
        if (isset($page_id)) {
            if ($page_id <> '0') {
                $output .= '        <input type="hidden" name="page_id" value="' . $page_id .
                    '" />';
            }
        } 
    $showsubmit = false;
    // Make
    if ((trim(get_option('CarDealer_show_make', 'yes')) == 'yes' and $is_show_room !=
        0) or (trim(get_option('CarDealer_widget_show_make', 'yes')) == 'yes' and $is_show_room ==
        0)) {
        $showsubmit = true;
        $output .= '	 
     					<div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Make', 'cardealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= ' 
                            <select class="' . $selectboxmeta .
            '" name="meta_make">
    							<option ' . (($meta_make == '') ? 'selected="selected"' : '') .
            ' value =""> ' . __('Any', 'cardealer') . ' </option>';
        $amakes = car_get_makes();
        $qmakes = count($amakes);
        for ($i = 0; $i < $qmakes; $i++) {
          //  die('$make');
            $output .= '<option ' . (($meta_make == trim($amakes[$i])) ? 'selected="selected"' :
                '') . '  value ="' . $amakes[$i] . '"> ' . $amakes[$i] . '</option>';
        }
        $output .= '</select></div>';
    }
   // end make
    // year
    if ((trim(get_option('CarDealer_show_year', 'yes')) == 'yes' and $is_show_room !=
        0) or (trim(get_option('CarDealer_widget_show_year', 'yes')) == 'yes' and $is_show_room ==
        0)) {
        $showsubmit = true;
        $output .= ' 
    					<div class="' . $searchItem2 . '">
    						<span class="' . $searchlabel . '">' . __('Year', 'cardealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= '           <select class="' . $selectboxmeta . '" name="meta_year">
    							<option value =""> ' . __('Any', 'cardealer') . ' </option>';
        $_year = date("Y")+1;
        $w = 50;
        for ($i = 0; $i <= $w; $i++) {
            $year = $_year - $i;
            $output .= '<option ';
            if ($meta_year == $year)
              $output .= 'selected="selected"';
            $output .= 'value ="';
            $output .= $year;
            $output .= '">';
            $output .= $year;
            $output .= '</option>';
        }
        $output .= '</select>
    					</div><!--end of item -->';
    }
    // Transmission
    if ((trim(get_option('CarDealer_show_transmission', 'yes')) == 'yes' and $is_show_room !=
        0) or (trim(get_option('CarDealer_widget_show_transmission', 'yes')) == 'yes' and
        $is_show_room == 0)) {
        $showsubmit = true;
        if (isset($_GET['meta_trans']))
            $cardealer_meta_trans = sanitize_text_field($_GET['meta_trans']);
        else
            $cardealer_meta_trans = '';
        $cardealer_meta_trans = sanitize_text_field($cardealer_meta_trans);
        $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Transmission', 'cardealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= '<select class="' . $selectboxmeta . '" name="meta_trans">
    							<option ' . (($cardealer_meta_trans == '') ? 'selected="selected"' :
            '') . ' value =""> ' . __('Any', 'cardealer') . ' </option>
    							<option ' . (($cardealer_meta_trans ==  __("Automatic", "cardealer")  ) ?
            'selected="selected"' : '') . '  value ="'.__("Automatic", "cardealer").'"> ' . __('Automatic',
            'cardealer') . '</option>
    							<option ' . (($cardealer_meta_trans == __("Manual", "cardealer")) ?
            'selected="selected"' : '') . '  value ="'.__("Manual", "cardealer").'"> ' . __('Manual', 'cardealer') .
            '</option>
    							<option ' . (($cardealer_meta_trans == __("Tiptronic", "cardealer")) ?
            'selected="selected"' : '') . '  value ="'.__("Tiptronic", "cardealer").'"> ' . __('Tiptronic',
            'cardealer') . '</option>
    						</select>  
    					</div>';
    }
    // Fuel
    if ((trim(get_option('CarDealer_show_fuel', 'yes')) == 'yes' and $is_show_room !=
        0) or (trim(get_option('CarDealer_widget_show_fuel', 'yes')) == 'yes' and $is_show_room ==
        0)) {
        $showsubmit = true;
        if (isset($_GET['meta_fuel']))
            $cardealer_meta_fuel = sanitize_text_field($_GET['meta_fuel']);
        else
            $cardealer_meta_fuel = '';
        $cardealer_meta_fuel = sanitize_text_field($cardealer_meta_fuel);
        $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Fuel', 'cardealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= '<select class="' . $selectboxmeta . '" name="meta_fuel">
    							<option ' . (($cardealer_meta_fuel == '') ? 'selected="selected"' :
            '') . ' value =""> ' . __('Any', 'cardealer') . ' </option>
    							<option ' . (($cardealer_meta_fuel == __("Diesel", "cardealer")) ?
            'selected="selected"' : '') . '  value ="'.__("Diesel", "cardealer").'"> ' . __('Diesel', 'cardealer') .
            '</option>
    							<option ' . (($cardealer_meta_fuel == __("Gasoline", "cardealer")) ?
            'selected="selected"' : '') . '  value ="'.__("Gasoline", "cardealer").'"> ' . __('Gasoline',
            'cardealer') . '</option>
    							<option ' . (($cardealer_meta_fuel == __("Hybrid", "cardealer")) ?
            'selected="selected"' : '') . '  value ="'.__("Hybrid", "Hybrid").'"> ' . __('Hybrid', 'cardealer') .
            '</option>
    							<option ' . (($cardealer_meta_fuel == __("Electric", "cardealer")) ?
            'selected="selected"' : '') . '  value ="'.__("Electric", "cardealer").'"> ' . __('Electric',
            'cardealer') . '</option>
     							<option ' . (($cardealer_meta_fuel == __("Biodiesel", "cardealer")) ?
            'selected="selected"' : '') . '  value ="'.__("Biodiesel", "cardealer").'"> ' . __('Biodiesel',
            'cardealer') . '</option>       
      							<option ' . (($cardealer_meta_fuel == 'CNG') ?
            'selected="selected"' : '') . '  value ="CNG"> ' . __('CNG', 'cardealer') .
            '</option>        
      							<option ' . (($cardealer_meta_fuel == __("Ethanol", "cardealer")) ?
            'selected="selected"' : '') . '  value ="'.__("Ethanol", "cardealer").'"> ' . __('Ethanol', 'cardealer') .
            '</option>        
    							<option ' . (($cardealer_meta_fuel == __("Other", "cardealer")) ?
            'selected="selected"' : '') . '  value ="'.__("Other", "cardealer").'"> ' . __('Other', 'cardealer') .
            '</option>
    						</select>  
    					</div>';
    }
    for ($i = 0; $i < $totfields; $i++) {
        $post_id = $afieldsId[$i];
        $ametadata = cardealer_get_meta($post_id);
        $field_value = array(
            'field_label', // 0
            'field_typefield', // 1
            'field_drop_options', // 2
            'field_searchbar', // 3
            'field_searchwidget', //4
            'field_rangemin', // 5
            'field_rangemax', //6
            'field_rangestep', // 7
            'field_slidemin', // 8
            'field_slidemax', // 9
            'field_slidestep', // 10
            'field_order', // 11
            'field_name'); // 12
        if (!empty($ametadata[0]))
            $search_label = $ametadata[0];
        else
            $search_label = $ametadata[12];
        $search_name = $ametadata[12];
        $meta = 'meta_'.$ametadata[12];
        if (!isset($_GET[$search_name])) {
            $_GET[$search_name] = '';
        }
       if (isset($_GET[$meta]))
          $cardealer_meta_con = trim(sanitize_text_field($_GET[$meta]));
       else
          $cardealer_meta_con = ' '; 
        $typefield = $ametadata[1];
        // Dropdown
        if ($typefield == 'dropdown') {
            $showsubmit = true;
            $output .= '<div class="' . $searchItem . '">';
            $output .= '<span class="' . $searchlabel . '">' . __($search_label,'cardealer') . ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '<select class="' . $selectboxmeta . '" name="'.$meta.'">';
            $options = explode("\n", $ametadata[2]);
            $output .= '<option value="All">'. __('Any', 'cardealer') .'</option>';
            foreach ($options as $option) {
                $output .= '<option ';
                if(trim($cardealer_meta_con) == trim($option))
                  {
                    $output .= ' selected="selected" ';
                   }  
                $output .= '>' . __($option,'cardealer') . '</option>';
            }
            $output .= '</select>';
            $output .= '</div>'; // SearchItem;
        } // end Dropdown
        // Select Range
        if ($typefield == 'rangeselect') {
            $showsubmit = true;
            $output .= '<div class="' . $searchItem . '">';
            $output .= '<span class="' . $searchlabel . '">' . $search_label . ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '<select class="' . $selectboxmeta . '" name="'.$meta.'">';
            $init = $ametadata[5];
            $max = $ametadata[6];
            $step = $ametadata[7];
            $options = array();
            $output .= '<option value="All">'. __('Any', 'cardealer') .'</option>';
            for ($z = $init; $z <= $max; $z += $step) {
                $option = $z;
                $output .= '<option ' . ($cardealer_meta_con == $option ?
                        ' selected="selected"' : '') . '>' . $option . '</option>';
            }
            $output .= '</select>';
            $output .= '</div>'; // SearchItem;
        } // end Dropdown       
         // Checkbox
        if ($typefield == 'checkbox') {
            $showsubmit = true;
            if (isset($_GET[$meta]))
                $cardealer_meta_con = sanitize_text_field($_GET[$meta]);
            else
                $cardealer_meta_con = ' ';
            $output .= '<div class="' . $searchItem . '">';
            $output .= '<span class="' . $searchlabel . '">' . $search_label . ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '<select class="' . $selectboxmeta .'" name="'.$meta.'">';
                $output .= '<option value = "All" ' . ($cardealer_meta_con == 'All' ? ' selected="selected"' : '') . '>'. __('Any', 'cardealer') .'</option>';
                $output .= '<option value = "enabled" ' . ($cardealer_meta_con == "enabled"  ? ' selected="selected"' : '') . '>Yes</option>';
                $output .= '<option value = "" ' . ($cardealer_meta_con == '' ? ' selected="selected"' : '') . '>No</option>';
            $output .= '</select>';
            $output .= '</div>'; // SearchItem;
        } // end Checkbox
    } // end Loop 
     // Order by
    if ((trim(get_option('CarDealer_show_orderby', 'yes')) == 'yes' and $is_show_room !=
        0) or (trim(get_option('CarDealer_widget_show_orderby', 'yes')) == 'yes' and $is_show_room ==
        0)) {
        $showsubmit = true;
        if (isset($_GET['meta_order']))
            $cardealer_meta_order = sanitize_text_field($_GET['meta_order']);
        else
            $cardealer_meta_order = '';
        $cardealer_meta_order = sanitize_text_field($cardealer_meta_order);
        $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Order By', 'cardealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= '<select class="' . $selectboxmeta .
            '" name="meta_order" style="min-width: 120px;">
    							<option ' . (($cardealer_meta_order == '') ? 'selected="selected"' :
            '') . ' value =""> ' . __('Any', 'cardealer') . ' </option>
    							<option ' . (($cardealer_meta_order == 'year_high') ?
            'selected="selected"' : '') . '  value ="year_high"> ' . __('Year newest first',
            'cardealer') . '</option>
    							<option ' . (($cardealer_meta_order == 'year_low') ?
            'selected="selected"' : '') . '  value ="year_low"> ' . __('Year oldest first',
            'cardealer') . '</option>
    							<option ' . (($cardealer_meta_order == 'price_high') ?
            'selected="selected"' : '') . '  value ="price_high"> ' . __('Price higher first',
            'cardealer') . '</option>
    							<option ' . (($cardealer_meta_order == 'price_low') ?
            'selected="selected"' : '') . '  value ="price_low"> ' . __('Price lower first',
            'cardealer') . '</option>
    							<option ' . (($cardealer_meta_order == 'mileage_high') ?
            'selected="selected"' : '') . '  value ="mileage_high"> ' . __('Mileage higher first',
            'cardealer') . '</option>
    							<option ' . (($cardealer_meta_order == 'mileage_low') ?
            'selected="selected"' : '') . '  value ="mileage_low"> ' . __('Mileage lower first',
            'cardealer') . '</option>
    						</select>  
    					</div>';
    }   
    // Slider
    
    if($is_show_room == '0')
      $showslider =  trim(get_option('CarDealer_widget_show_price', 'yes'));
    else
      $showslider =  trim(get_option('CarDealer_show_price', 'yes'));
  
    
    if ($showslider == 'yes') {        
        
        
         $showsubmit = true;  
         $max_car_value = cardealer_get_max();
        if ($is_show_room != '0') // no widget
           {
            $output .= '<div class="cardealer-price-slider">';
            $output .= '<span class="cardealerlabelprice">' . __('Price Range', 'cardealer') . ':</span>';
            $output .= '<input type="text" name="meta_price" id="meta_price" readonly>';
            // slider
            if ($is_show_room == '1')
                $output .= '<div id="cardealer_meta_price" class="cardealerslider" ></div>';
            else
                $output .= '<div id="cardealer_meta_price" class="cardealerslider" style="margin-top:0px;" ></div>';
            $output .= '<input type="hidden" name="meta_price_max" id="meta_price_max" value="'.$max_car_value.'">';
            if(isset($_GET['meta_price']))
              $price = sanitize_text_field($_GET['meta_price']);
            else
              $price = '';
            $pos = strpos($price, '-');
            if ($pos === false)
                $price = '';
            else {
                $priceMin = trim(substr($price, 0, $pos - 1));
                $priceMax = trim(substr($price, $pos + 1));
                $output .= '<input type="hidden" name="choice_price_min" id="choice_price_min" value="' .
                    $priceMin . '">';
                $output .= '<input type="hidden" name="choice_price_max" id="choice_price_max" value="' .
                    $priceMax . '">';
            }
            $output .= '</div>';
         }  // show room != 0 
        if ($is_show_room == '0') // widget
           {
            $output .= '<div class="cardealer-price-slider2">';
            $output .= '<span class="cardealerlabelprice2">' . __('Price', 'cardealer') . ':</span>';
            $output .= '<input type="text" name="meta_price2" id="meta_price2" readonly>';
                $output .= '<div id="cardealer_meta_price2" class="cardealerslider" "></div>';
            $output .= '<input type="hidden" name="meta_price_max2" id="meta_price_max2" value="'.$max_car_value.'">';
            if(isset($_GET['meta_price2']))
              $price = sanitize_text_field($_GET['meta_price2']);
            else
              $price = '';
            $pos = strpos($price, '-');
            if ($pos === false)
                $price = '';
            else {
                $priceMin = trim(substr($price, 0, $pos - 1));
                $priceMax = trim(substr($price, $pos + 1));
                $output .= '<input type="hidden" name="choice_price_min2" id="choice_price_min2" value="' .
                    $priceMin . '">';
                $output .= '<input type="hidden" name="choice_price_max2" id="choice_price_max2" value="' .
                    $priceMax . '">';
            }
            $output .= '</div>';
         }  // show room = 0 
    } // End Slider    
    // Submit
    if ($showsubmit) {
        $output .= '<div class="CarDealer-submitBtnWrap">';
        $output .= '<input type="submit" name="submit" id="' . $CarDealersubmitwrap .
            '" value=" ' . __('Search', 'cardealer') . '" />';
        $output .= '</div>';
        $output .= '<input type="hidden" name="CarDealer_post_type" value="cars" />';
        $output .= '<input type="hidden" name="postNumber" value="' . $postNumber .
            '" />';
        $output .= '<input type="hidden" name="CarDealer_search_type" value="' . $CarDealer_search_type .
            '" />';
    }
    $output .= '</form></div></div></div>  <!-- end of Basic -->';
    return $output;
} ?>