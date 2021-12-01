<?php
/**
 * @author William Sergio Minozzi
 * @copyright 2021
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly 
?>
<div id="cardealer-notifications-page">
    <div class="cardealer-block-title">
        More Tools
    </div>
    <div id="notifications-tab">
        <div id="freebies-tab">


        <?php

        if(is_multisite())
           $url = esc_url(CARDEALERHOMEURL)  . "plugin-install.php?s=sminozzi&tab=search&type=author";
        else
           $url = esc_url(CARDEALERHOMEURL).'/admin.php?page=cardealer_new_more_plugins';



        echo '<script>';
        echo 'window.location.replace("'.$url.'");';
        // $msg .= 'window.location.replace("'.esc_url(STOPBADBOTSHOMEURL).'plugin-install.php?s=sminozzi&tab=search&type=author");';
        echo '</script>';


       ?>


            <br />
        </div>
    </div>
</div>