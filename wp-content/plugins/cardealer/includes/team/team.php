<?php /**
 * @author Bill Minozzi
 * @copyright 2018
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
function cardealer_show_team()
{
    $cardealerTeam = cardealer_reorder_terms();
    $qagents = count($cardealerTeam);
    $output = '';
    $output .= '<div class="container cardealer_wrapteam">';
    if ($qagents > 0) {
         $i = 0;
        foreach ($cardealerTeam as $term) {
          if($i % 3 == 0 or $i == 0)  
             $output .= '<div class="row align-items-start">'; // row
            $image = $term['image'];
           // $image = aq_resize( $image, 800, 400, true ); //resize & crop the image
            if (empty($image)) {
                $image = CARDEALERIMAGES . 'image-no-available-800x400_br.jpg';
                //$image = str_replace("-", "", $image);
            }
            $name = $term['name'];
            $description = $term['description'];
            $function = $term['function'];
            $phone = $term['phone'];
            $email = $term['email'];
            $skype = $term['skype'];
            $skype = $term['skype'];
            $facebook = $term['facebook'];
            $twitter = $term['twitter'];
            $linkedin = $term['linkedin'];
            $vimeo = $term['vimeo'];
            $instagram = $term['instagram'];
            $youtube = $term['youtube'];
            // 6 divide 50%
            // 4  33%
            $output .= '<div class="col-md-4 col-lg-4 cardealer_wrapindividual">'; // start single member
            $output .= '<div class="reatestateimg-team">';
            $output .= '<img class="reatestateimg-img_team" src="' . $image . '" />';
            $output .= '</div>'; //image
            $output .= '<div class="cardealer_nameteam">';
            $output .= $name;
            $output .= '</div>'; //title
            $output .= '<div class="cardealer_team_function">';
            $output .= $function;
            $output .= '</div>'; //function
            $output .= '<div class = "cardealer_descriptionteam">';
            $output .= substr($description, 0, 140);
            $output .= '</div>';
            if (!empty($phone)) {
                $output .= '<div class = "cardealer_phone_team">';
                $output .= '<i class="fa fa-phone" aria-hidden="true"></i>';
                $output .= '&nbsp;' . $phone;
                $output .= '</div>';
            }
            if (!empty($skype)) {
                $output .= '<div class = "cardealer_skype_team">';
                $output .= '<i class="fa fa-skype" aria-hidden="true"></i>';
                $output .= '&nbsp;' . $skype;
                $output .= '</div>';
            }
            if (!empty($email)) {
                $output .= '<div class = "cardealer_email_team">';
                $output .= '<i class="fa fa-envelope-o" aria-hidden="true"></i>';
                $output .= '&nbsp;' . $email;
                $output .= '</div>';
            }
            $output .= '<div class = "cardealer_iconswrap">';
            if (!empty($facebook)) {
                $output .= '<div class = "cardealer_iconsteam">';
                $output .= ' <a href="http://facebook.com/' . $facebook .
                    '"><i class="fa fa-facebook" aria-hidden="true"></i></a> ';
                $output .= '</div>';
            }
            if (!empty($twitter)) {
                $output .= '<div class = "cardealer_iconsteam">';
                $output .= ' <a href="http://twitter.com/' . $twitter .
                    '"><i class="fa fa-twitter" aria-hidden="true"></i></a> ';
                $output .= '</div>';
            }
            if (!empty($linkedin)) {
                $output .= '<div class = "cardealer_iconsteam">';
                $output .= ' <a href="http://linkedin.com/' . $linkedin .
                    '"><i class="fa fa-linkedin" aria-hidden="true"></i></a> ';
                $output .= '</div>';
            }
            if (!empty($instagram)) {
                $output .= '<div class = "cardealer_iconsteam">';
                $output .= ' <a href="http://instagram.com/' . $instagram .
                    '"><i class="fa fa-instagram" aria-hidden="true"></i></a> ';
                $output .= '</div>';
            }
            if (!empty($vimeo)) {
                $output .= '<div class = "cardealer_iconsteam">';
                $output .= ' <a href="http://vimeo.com/' . $vimeo .
                    '"><i class="fa fa-vimeo" aria-hidden="true"></i></a> ';
                $output .= '</div>';
            }
            if (!empty($youtube)) {
                $output .= '<div class = "cardealer_iconsteam">';
                $output .= ' <a href="http://youtube.com/' . $youtube .
                    '"><i class="fa fa-youtube" aria-hidden="true"></i></a> ';
                $output .= '</div>';
            }
            $output .= '</div>'; //icons wrap
            $output .= '</div>'; //Single
         $i++;
         if($i % 3 == 0 or $i >= $qagents )
            $output .= '</div>'; // row; 
        }
    } else {
        $output .= __("No Team Member Added!", "cardealer") ;
    }
    $output .= '</div>'; //container
    return $output;
}
add_shortcode('cardealer_team', 'cardealer_show_team'); ?>