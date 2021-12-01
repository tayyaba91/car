<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
 function cardealer_content_detail(){
    $post_product_id = get_the_ID();
    ?>
    <div class="multiContent">
        <div id="sliderWrapper">
             <div class="featuredTitle"> 
             <?php echo __('Details', 'cardealer');?> 
             </div>
             <?php 
        $afieldsId = cardealer_get_fields('all');
        $totfields = count($afieldsId);
        $ametadataoptions = array();
        echo '<div class="featuredCar">';
        for ($i = 0; $i < $totfields; $i++) {
            $post_id = $afieldsId[$i];
            $ametadata = cardealer_get_meta($post_id);        
            if (!empty($ametadata[0]))
                $label = $ametadata[0];
            else
                $label = $ametadata[12];
            $field_id = 'car-'.$ametadata[12];
            $value = get_post_meta($post_product_id, $field_id, true);
             $typefield = $ametadata[1];
             if ($value != '') 
             { 
                 if ($typefield == 'checkbox')
                 {
                   if($value == 'enabled')
                     $value = __('Yes', 'cardealer');
                   else
                     $value = __('No', 'cardealer');
                 }
                  ?>
                 <div class="featuredList">             
                 <span class="multiBold"> <?php echo $label;?>: </span><?php echo '<b>'.$value.'</b>';?> 
                 </div><!-- End of featured list -->
             <?php }
              } ?>
              </div><!-- End of featured car -->      
       <div class="featuredTitle"> 
       <?php echo __('Features', 'cardealer');?> </div>     
       <div class="featuredCar">
         <?php
              $cardealer_features = trim(get_option( 'cardealer_fieldfeatures' ));
             $acardealer_features = explode(PHP_EOL, $cardealer_features);
             $qnew = count($acardealer_features);
            //  print_r($acardealer_features);
        // $post_id = trim(get_the_ID()); // trim($post->ID);      
    	for($i=0; $i < $qnew; $i++)
        {
    		// $title = $acardealer_features[$i];
            $field_name =  trim($acardealer_features[$i]);
            $field_name = str_replace(' ','_',$field_name);
            $field_id = 'car_'.$field_name;
            $meta = get_post_meta($post_product_id, $field_id, true);
            $field_name = str_replace('_',' ',$field_name);
                 if ($meta != '') { ?>
                 <div class="featuredList">             
                 <span class="carBold"> <?php echo $field_name;?>: </span><?php echo $meta;?> 
                 </div><!-- End of featured list --><?php } 
         }              
             ?>
             </div><!-- End of featured multi -->
             </div> <!-- end of Slider Content --> 
             </div> <!-- end of Slider Wrapper -->  
     <?php // }
  }    
 function cardealer_content_info () { 
   Global $CarDealer_hp_or_kw;
   ?>
 <div class="contentInfo">
         <div class="multiContent">
         	<?php  the_content(); ?>
         </div> 
         <?php
         $terms = get_the_terms( get_the_id(), 'makes');
         if(is_array($terms))
                    {
                        $term = $terms[0]; 
                         echo '<div class="featuredTitle">'; 
                         echo __('Make', 'cardealer').': ';  
                         echo esc_attr($term->name); 
                         $model = trim(get_post_meta(get_the_ID(), 'car-model', 'true'));
                         if(! empty($model)) 
                         {
                           echo '&nbsp;&nbsp;&nbsp;';
                           echo __('Model', 'cardealer').': ';  
                           echo $model;
                         } 
                         echo '</div>';
                    } 
                   else
                   {
                        $model = trim(get_post_meta(get_the_ID(), 'car-model', 'true'));
                         if(! empty($model)) 
                         {
                           echo '<div class="featuredTitle">'; 
                           echo '&nbsp;&nbsp;&nbsp;';
                           echo __('Model', 'cardealer').': ';  
                          // echo esc_attr($term1->name);
                           echo $model;
                           echo '</div>'; 
                         } 
                   } 
         ?>         
               <?php if(is_array($terms)) 
                 echo '<div class="featuredCar">'; 
                ?>  
            <div class="multiDetail">
                <div class="multiBasicRow"><span class="singleInfo"><?php echo __('Transmission', 'cardealer')?>: </span><?php echo get_post_meta(get_the_ID(), 'transmission-type', 'true'); ?></div> 
                <div class="multiBasicRow"><span class="singleInfo"><?php echo __('Fuel', 'cardealer')?>: </span><?php echo get_post_meta(get_the_ID(), 'car-fuel', 'true'); ?></div>
                <div class="multiBasicRow"><span class="singleInfo"><?php echo __(get_option('CarDealer_measure', 'Miles'), 'cardealer')?>: </span><?php echo get_post_meta(get_the_ID(), 'car-miles', 'true'); ?></div>
                <div class="multiBasicRow"><span class="singleInfo"><?php echo __('Cond', 'cardealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'car-con', 'true'); ?></div>
                <div class="multiBasicRow"><span class="singleInfo">
                  <?php
                  
                  if($CarDealer_hp_or_kw == 'hp')
                  {
                     echo __('HP', 'cardealer');
                     ?>:&nbsp; </span><?php echo get_post_meta(get_the_ID(), 'car-hp', 'true'); 
                  }
                     else
                     {
                        echo __('KW', 'cardealer');?>:&nbsp; </span><?php echo get_post_meta(get_the_ID(), 'car-hp', 'true'); 
                     }
                  ?>
                  </div>
            </div>
       <?php if(is_array($terms)) 
           echo '</div>'; 
       ?>    
</div>	 
 <?php }
function cardealer_detail() {
  echo '<div class="multi-content">';
	while ( have_posts() ) : the_post(); 
       cardealer_top_detail();
       cardealer_content_info (); 
      ?> 
     <div class="multicontentWrap">
	 <?php cardealer_content_detail (); ?>
     </div><?php
     break;
	 endwhile; // end of the loop.
     echo '</div>';
}
function cardealer_top_detail(){
global $cardealer_the_title;
   $cardealer_the_title = get_the_title();
            $price = get_post_meta(get_the_ID(), 'car-price', true);
           if ($price <> '' and $price != '0')
             { 
                $price =   number_format_i18n($price,0);
                $price = cardealer_currency() . $price;
             }
             else
                $price =  __('Call for Price', 'cardealer'); 
             $year = get_post_meta(get_the_ID(), 'car-year', 'true');
             if (!empty($year))
              $year = __('Year', 'cardealer').': '.$year;  
            ?> 
         </div>
    <div class="multi-top-container"> 
    <div class="multi-detail-title">  <?php echo SINGLE_TITLE; ?> </div>
    <div class="multi-price-single"> <?php echo $price; ?> </div>
    <div class="multi-detail-year"><?php echo $year  ?>  </div>
    <?php
                 $terms3 = get_the_terms( get_the_id(), 'locations');
                 if(isset($terms3[0])) {
                  $term3 = $terms3[0]; 
                  if(is_object($term3))
                      {
                          echo '<div class="multi-detail-location">'; 
                          echo __('Location', 'cardealer').': ';  
                          echo esc_attr($term3->name); 
                          echo '</div>';
                      } 
                 }
   ?>
  </div>         
<?php }
require_once(CARDEALERPATH . "assets/php/cardealer_mr_image_resize.php");
function CarDealer_theme_thumb($url, $width, $height=0, $align='') {
        if (get_the_post_thumbnail()=='') {
    	  	$url = CARDEALERIMAGES.'image-no-available.jpg';
		}
       return cardealer_mr_image_resize($url, $width, $height, true, $align, false);
}