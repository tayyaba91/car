<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
function cardealer_RecentWidget() {
	register_widget( 'cardealer_RecentWidget' );
}
add_action( 'widgets_init', 'cardealer_RecentWidget' );
class cardealer_RecentWidget extends WP_Widget {
       public function __construct() {
        parent::__construct(
        'RecentWidget',         
        'Recent cars',                
        array( 'description' => __('A list of Recent cars', 'cardealer'), ) 
        );
    }   
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'amount' => '','Fwidth' => '','Fheight' => '') );
        if(isset($instance['Ramount']))
          {$Ramount = $instance['Ramount'];}
        else
          {$Ramount = 3;}
		echo '<p>
			<label for="'.$this->get_field_id('Ramount').'">
				Number of cars to show: <input maxlength="1" size="1" id="'. $this->get_field_id('Ramount') .'" name="'. $this->get_field_name('Ramount') .'" type="text" value="'. esc_attr($Ramount) .'" />
			</label>
		</p>';
	}
	function update($new_instance, $old_instance) { 
		$instance = $old_instance;
        if(is_numeric($new_instance['Ramount']))
		    {$instance['Ramount'] = $new_instance['Ramount'];}
      	return $instance;
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$Ramount = empty($instance['Ramount']) ? ' ' : apply_filters('widget_title', $instance['Ramount']); 
		if($Ramount == '') {$Ramount = 3; }
        ?>
	    <div class="sideTitle"> <?php echo __('New Arrivals', 'cardealer');?> </div><?php 
		$args = array(
			'post_type'      => 'cars',
			'order'    => 'DESC',
			'showposts' => $Ramount,
		);
        $_query3 = new WP_Query( $args );
    $output = '<div class="CarDealer-listing-wrap"> <div class="multiGallery">';
	while ($_query3->have_posts()) : $_query3->the_post();
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id,'medium', true);	
        $price = get_post_meta(get_the_ID(), 'car-price', true);
        if($price == '0')
          $price = '';
            if (!empty($price))
                 {$price =   number_format_i18n($price,0);}
		$image = str_replace("-".$image_url[1]."x".$image_url[2], "", $image_url[0]);
		$featured = trim(get_post_meta(get_the_ID(), 'car-featured', true));
    $CarDealer_thumbs_format = trim(get_option('CarDealer_thumbs_format', '1'));
    if ($CarDealer_thumbs_format == '2')
        $thumb = CarDealer_theme_thumb($image, 300, 225, 'br'); // Crops from bottom right
    else
        $thumb = CarDealer_theme_thumb($image, 400, 200, 'br'); // Crops from bottom right
        $year = get_post_meta(get_the_ID(), 'car-year', true);
            $output .= '<div>';
            $output .=  '<a href="' . get_permalink() . '">';
            $output .= '<div class="CarDealer_gallery_2016_widget">';
            $output .=  '<img class="CarDealer_caption_img_widget" src="' . $thumb .'" alt="'. get_the_title() . '" />';
            $output .= '<div class="CarDealer_caption_text_widget">';
            $output .= ($price <> '' ? cardealer_currency() . $price : __('Call for Price', 'cardealer'));
            $output .= '<br />';
            $output .= ($year <> '' ? __('Year', 'cardealer') .': '. $year.'<br />' : '');
            $output .= '</div>';
            $output .= '<div class="multiTitle-widget">' . get_the_title() . '</div>';
            $output .= '</div>';
            $output .= '</a>';
            $output .= '</div>';     
            $output .= '<br />';        
		endwhile; 
        $output .= '</div></div>'; 
        echo $output;
	}
}
function cardealer_FeaturedWidget() {
	register_widget( 'cardealer_FeaturedWidget' );
}
add_action( 'widgets_init', 'cardealer_FeaturedWidget' );
class cardealer_featuredWidget extends WP_Widget {
    public function __construct() {
        parent::__construct(
        'FeaturedWidget',         
        'Featured cars',                
        array( 'description' => __('A list of Featured car-s', 'cardealer'), ) 
        );
    } 
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'amount' => '') );
		$amount = $instance['amount'];
		echo '<p>
			<label for="'.$this->get_field_id('amount').'">
				Number of cars to show: <input maxlength="1" size="1" id="'. $this->get_field_id('amount') .'" name="'. $this->get_field_name('amount') .'" type="text" value="'. esc_attr($amount) .'" maxlength="3" size="3" />
			</label>
		</p>';
	}
	function update($new_instance, $old_instance) { 
		$instance = $old_instance;
        if(is_numeric($new_instance['amount']))
		    {$instance['amount'] = $new_instance['amount'];}       
		return $instance;
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$amount = empty($instance['amount']) ? ' ' : apply_filters('widget_title', $instance['amount']); 
		if($amount == '') {$amount = 3; }
    ?>
        <div class="sideTitle"> 
        <?php echo __('Featured cars', 'cardealer');?> 
        </div><?php 
		$args = array(
			'post_type'      => 'cars',
			'order'    => 'DESC',
			'showposts' => $amount,
			'meta_query' => array(
								array(
										'key' => 'car-featured',
										'value' => 'enabled',
									  )
								   )
		);
        $_query2 = new WP_Query( $args );
		$output = '<div class="CarDealer-listing-wrap"> <div class="multiGallery">';
		while ($_query2->have_posts()) : $_query2->the_post();
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id,'medium', true);	
        $price = trim(get_post_meta(get_the_ID(), 'car-price', true));
        if($price == '0')
          $price = '';
        if(! empty($price))
           $price = number_format_i18n($price);
        $image = str_replace("-".$image_url[1]."x".$image_url[2], "", $image_url[0]);
        $featured = get_post_meta(get_the_ID(), 'car-featured', true);
     $CarDealer_thumbs_format = trim(get_option('CarDealer_thumbs_format', '1'));
    if ($CarDealer_thumbs_format == '2')
        $thumb = CarDealer_theme_thumb($image, 300, 225, 'br'); // Crops from bottom right
    else
        $thumb = CarDealer_theme_thumb($image, 400, 200, 'br'); // Crops from bottom right
        $year = get_post_meta(get_the_ID(), 'car-year', true);
            $output .= '<div>';
            $output .=  '<a href="' . get_permalink() . '">';
            $output .= '<div class="CarDealer_gallery_2016_widget">';
            $output .=  '<img class="CarDealer_caption_img_widget" src="' . $thumb .'" alt="'. get_the_title() . '" />';
            $output .= '<div class="CarDealer_caption_text_widget">';
            $output .= ($price <> '' ? cardealer_currency() . $price : __('Call for Price', 'cardealer'));
            $output .= '<br />';
            $output .= ($year <> '' ? __('Year', 'cardealer') .': '. $year : '');
            $output .= '</div>';
            $output .= '<div class="multiTitle-widget">' . get_the_title() . '</div>';
            $output .= '</div>';
            $output .= '</a>';
            $output .= '</div>';     
            $output .= '<br />';
        endwhile; 
        $output .= '</div></div>'; 
        echo $output;
	}
}
//add_action( 'widgets_init', create_function('', 'return register_widget("cardealer_SearchWidget");') );
if (version_compare(phpversion(), '7.02.00', '>=')) 
 add_action( 'widgets_init', function() {return register_widget("cardealer_SearchWidget");} );
else
 add_action( 'widgets_init', create_function('', 'return register_widget("cardealer_SearchWidget");') );
class cardealer_SearchWidget extends WP_Widget {
public function __construct() {
        parent::__construct(
        'SearchWidget',         
        'Search cars',                
        array( 'description' => __('Search cars', 'cardealer'), ) 
        );
}     
	function SearchWidget()	{
		$widget_ops = array('classname' => 'SearchWidget', 'description' => 'Search Cars' );
		$this->WP_Widget('SearchWidget', 'Search Widget', $widget_ops);
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'CarDealer_search_name' => '') );
		$CarDealer_search_name = $instance['CarDealer_search_name'];
		echo '<p>
			<label for="'.$this->get_field_id('CarDealer_search_name').'">';
				echo __('Title', 'cardealer');
                echo ': <input class="widefat" id="'. $this->get_field_id('CarDealer_search_name') .'" name="'. $this->get_field_name('CarDealer_search_name') .'" type="text" value="'. esc_attr($CarDealer_search_name) .'" />
			</label>
		</p>';
	}
	function update($new_instance, $old_instance) { 
		$instance = $old_instance;
		$instance['CarDealer_search_name'] = $new_instance['CarDealer_search_name'];
		return $instance;
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$CarDealer_search_name = empty($instance['CarDealer_search_name']) ? ' ' : apply_filters('widget_title', $instance['CarDealer_search_name']); 
		if(trim($CarDealer_search_name) == '') {$CarDealer_search_name = __('Search', 'cardealer'); }        
        echo '<div class="sideTitle">';
        echo $CarDealer_search_name;
        echo '</div>';        
		echo CarDealer_search(0);
	}   
}