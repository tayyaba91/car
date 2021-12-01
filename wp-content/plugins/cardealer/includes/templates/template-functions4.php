<?php
/**
 * @author Bill Minozzi
 * @copyright 2017
 * Template Functions for Single Modal
 */
function cardealer_detail($post_id)
{
  //  global $post_id;
    global $queried_post;




   // $post_id = 18485;
    $queried_post = get_post($post_id);

   // return var_dump($queried_post);


    $r =    cardealer_top_detail($post_id);

    $r .=  cardealer_content_info($post_id);

?>
    <div class="multicontentWrap">


        <?php
    
        $r .= cardealer_content_detail($post_id); ?>




    <?php

    // </div>

    //    break;
    //	 endwhile; // end of the loop.


    echo '</div>';

    return $r;

    
}

function cardealer_top_detail($post_id)
{
    global $cardealer_the_title;
    global $queried_post;
   // global $post_id;
    ob_start();


   // var_dump($post_id);



    $cardealer_the_title = $queried_post->post_title;

   // var_dump($cardealer_the_title);


    // $cardealer_the_title = get_the_title();

    $price = get_post_meta($post_id, 'car-price', true);


   // var_dump($price);


    if ($price <> '' and $price != '0') {
        $price =   number_format_i18n($price, 0);
        $price = cardealer_currency() . $price;
    } else
        $price =  __('Call for Price', 'cardealer');
    $year = get_post_meta($post_id, 'car-year', 'true');
    if (!empty($year))
        $year = __('Year', 'cardealer') . ': ' . $year;

    //   </div>             
?>

    <div class="multi-top-container">
        <div class="multi-detail-title"> <?php echo $cardealer_the_title; ?> </div>
        <div class="multi-price-single"> <?php echo $price; ?> </div>
        <div class="multi-detail-year"><?php echo $year  ?> </div>
        <?php
        $terms3 = get_the_terms($post_id, 'locations');
        $term3 = $terms3[0];
        if (is_object($term3)) {
            echo '<div class="multi-detail-location">';
            echo __('Location', 'cardealer') . ': ';
            echo esc_attr($term3->name);
            echo '</div>';
        }
        ?>
    </div>
<?php

    // echo  $queried_post->post_content;

    $r = ob_get_contents();
    ob_end_clean();
    return $r;
}


function cardealer_content_detail($post_id)
{

     global $afieldsId; //  = cardealer_get_fields('all');
    //global $post_ID;

   // $post_product_id = get_the_ID(); // $post_ID;

    $post_product_id = $post_id;

  //  return $post_product_id;
    


    ob_start();

    ?>
        <div class="multiContent">
            <div id="sliderWrapper">
                <div class="featuredTitle">
                    <?php echo __('Details', 'cardealer'); ?>
                </div>
                <?php


           //     $afieldsId = cardealer_get_fields('all');



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





                    $field_id = 'car-' . $ametadata[12];


                    $value = get_post_meta($post_product_id, $field_id, true);

                    $typefield = $ametadata[1];


                    //  var_dump($value);





                    if ($value != '') {
                        if ($typefield == 'checkbox') {
                            if ($value == 'enabled')
                                $value = 'Yes';
                            else
                                $value = 'No';
                        }

                ?>
                        <div class="featuredList">
                            <span class="multiBold"> <?php echo $label; ?>: </span><?php echo '<b>' . $value . '</b>'; ?>
                        </div><!-- End of featured list -->



                <?php




                    }
                } ?>
            </div><!-- End of featured car -->



            <div class="featuredTitle">
                <?php echo __('Features', 'cardealer'); ?> </div>
            <div class="featuredCar">
                <?php
                $cardealer_features = trim(get_option('cardealer_fieldfeatures'));
                $acardealer_features = explode(PHP_EOL, $cardealer_features);
                $qnew = count($acardealer_features);

                // var_dump($acardealer_features);



                // $post_id = trim(get_the_ID()); // trim($post->ID);   

                for ($i = 0; $i < $qnew; $i++) {

                    // $title = $acardealer_features[$i];
                    $field_name =  trim($acardealer_features[$i]);
                    $field_name = str_replace(' ', '_', $field_name);
                    $field_id = 'car_' . $field_name;

                    // echo '<hr>';

                    //// var_dump($field_id);

                    //  echo '<hr>';

                    // var_dump($post_product_id);


                    // echo '<hr>';

                 //   $post_product_id = 18485;


                    $meta = get_post_meta($post_product_id, $field_id, true);


                    // var_dump($meta);


                    $field_name = str_replace('_', ' ', $field_name);


                    if ($meta != '') { ?>
                        <div class="featuredList">
                            <span class="carBold"> <?php echo $field_name; ?>: </span><?php echo $meta; ?>
                        </div><!-- End of featured list --><?php }
                                                    }



                                                            ?>
            </div><!-- End of featured multi -->





        </div> <!-- end of Slider Content -->
    </div> <!-- end of Slider Wrapper -->
<?php // }

    $r = ob_get_contents();
    ob_end_clean();
    return $r;
}


function strip_shortcode_gallery($content)
{
    preg_match_all('/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER);

    if (!empty($matches)) {
        foreach ($matches as $shortcode) {
            if ('gallery' === $shortcode[2]) {
                $pos = strpos($content, $shortcode[0]);
                if (false !== $pos) {
                    return substr_replace($content, '', $pos, strlen($shortcode[0]));
                }
            }
        }
    }

    return $content;
}


function cardealer_content_info($post_id)
{
    global $CarDealer_hp_or_kw;

   // global $post_id;
    global $queried_post;

    //return 'xxxxxxxxxxxxxxxxxxxxxxx';

    ob_start();

    // echo 'xxxxxxxxxxxxxxxxxxxxxxx';


   // $post_id = 18485;
    $queried_post = get_post($post_id);
    $title = $queried_post->post_title;
    //echo $title;

    // echo $queried_post->post_content;



    /*
$r = ob_get_contents();
ob_end_clean();
return $r;
*/



?>
    <div class="contentInfo">
        <div class="multiContent">
            <?php

            // the_content();


            // $post_id = 18485;
            // $queried_post = get_post($post_id);
            // $title = $queried_post->post_title;
            // echo $title;




            // $text =  $queried_post->post_content;
            $text = strip_shortcode_gallery($queried_post->post_content);

            $gallery = get_post_gallery($post_id);



            echo $gallery;


            // echo wp_autop($text);

            echo str_replace("\r", "<br />", $text);








            ?>
        </div>


        <?php



        // var_dump(__LINE__);








        $terms = get_the_terms($post_id, 'makes');


        // debug();





        if (is_array($terms)) {
            $term = $terms[0];
            echo '<div class="featuredTitle">';
            echo __('Make', 'cardealer') . ': ';
            echo esc_attr($term->name);
            $model = trim(get_post_meta($post_id, 'car-model', 'true'));
            if (!empty($model)) {
                echo '&nbsp;&nbsp;&nbsp;';
                echo __('Model', 'cardealer') . ': ';
                echo $model;
            }
            echo '</div>';
        } else {
            $model = trim(get_post_meta($post_id, 'car-model', 'true'));
            if (!empty($model)) {
                echo '<div class="featuredTitle">';
                echo '&nbsp;&nbsp;&nbsp;';
                echo __('Model', 'cardealer') . ': ';
                // echo esc_attr($term1->name);
                echo $model;
                echo '</div>';
            }
        }


        // echo __('Transmission', 'cardealer');
        // echo get_post_meta($post_id, 'transmission-type', 'true'); 


        /*
                  $r = ob_get_contents();
                   ob_end_clean();
                   return $r;  
*/

        ?>


        <?php




        if (is_array($terms))
            echo '<div class="featuredCar">';
        ?>

        <div class="multiDetail">
            <div class="multiBasicRow"><span class="singleInfo"><?php echo __('Transmission', 'cardealer') ?>:
                </span><?php echo get_post_meta($post_id, 'transmission-type', 'true'); ?></div>
            <div class="multiBasicRow"><span class="singleInfo"><?php echo __('Fuel', 'cardealer') ?>:
                </span><?php echo get_post_meta($post_id, 'car-fuel', 'true'); ?></div>
            <div class="multiBasicRow"><span class="singleInfo"><?php echo __(get_option('CarDealer_measure', 'Miles'), 'cardealer') ?>:
                </span><?php echo get_post_meta($post_id, 'car-miles', 'true'); ?></div>
            <div class="multiBasicRow"><span class="singleInfo"><?php echo __('Cond', 'cardealer'); ?>:
                </span><?php echo get_post_meta($post_id, 'car-con', 'true'); ?></div>
            <div class="multiBasicRow"><span class="singleInfo">
                    <?php

                    if ($CarDealer_hp_or_kw == 'hp') {
                        echo __('HP', 'cardealer');
                    ?>:&nbsp; </span><?php echo get_post_meta($post_id, 'car-hp', 'true');
                                            } else {
                                                echo __('KW', 'cardealer'); ?>:&nbsp; </span><?php echo get_post_meta($post_id, 'car-hp', 'true');
                                                                            }
                                                                                ?>
            </div>
        </div>

        <?php if (is_array($terms))
            echo '</div>';




        ?>



    </div>




<?php

    $r = ob_get_contents();
    ob_end_clean();
    return $r;
}





require_once(CARDEALERPATH . "assets/php/cardealer_mr_image_resize.php");


function CarDealer_theme_thumb($url, $width, $height=0, $align='') {
    if (get_the_post_thumbnail()=='') {
          $url = CARDEALERIMAGES.'image-no-available.jpg';
    }
   return cardealer_mr_image_resize($url, $width, $height, true, $align, false);
}


?>