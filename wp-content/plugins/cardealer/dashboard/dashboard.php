<?php

/**

 * @author William Sergio Minozzi

 * @copyright 2017

 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

   // var_dump(__LINE__);

?>

<div id="cardealer-dashboard-wrap">


   <div id="cardealer-dashboard-left">


   <div id="cardealer-services3">

     <div class="cardealer-block-title">

      Server Check

    </div>



   <div class="cardealer-help-container1">

        <div class="cardealer-help-column cardealer-help-column-1">

          <h3>Memory Status</h3>

            <?php 

            $ds = 256;

            $du = 60;

 $cardealer_memory = cardealer_check_memory();

    if ( $cardealer_memory['msg_type'] == 'notok')

       {

        echo 'Unable to get your Memory Info';

    }

    else

    {

              $ds = $cardealer_memory['wp_limit'];

              $du = $cardealer_memory['usage'];

            if ($ds > 0)

                $perc = number_format(100 * $du / $ds, 2);

            else

                $perc = 0;

            if ($perc > 100)

                $perc = 100;

            $color = '#e87d7d';

            $color = '#029E26';

            if ($perc > 50)

                $color = '#e8cf7d';

            if ($perc > 70)

                $color = '#ace97c';

            if ($perc > 50)

                $color = '#F7D301';

            if ($perc > 70)

                $color = '#ff0000';

            ;

            echo '<p><li style="max-width:50%;font-weight:bold;padding:5px 15px;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;background-color:#0073aa;margin-left:13px;color:white;">' .

                'Memory Usage' . '<div style="border:1px solid #ccc;background:white;width:100%;margin:2px 5px 2px 0;padding:1px">' .

                '<div style="width: ' . $perc . '%;background-color:' . $color .

                ';height:6px"></div></div>' . $du . ' of ' . $ds . ' MB Usage' . '</li>'; ?>

                       <br /> <br />

           For details, click the Memory Checkup Tab above.

           <br /> <br /> 

       <?php } ?>

       </div>  

       <!-- "Column1">  --> 

        <div class="cardealer-help-column cardealer-help-column-2">

            <h3>Permalink Settingss</h3>

            

            

      <?php      

      $permalinkopt = get_option('permalink_structure');

      //echo $permalinkopt;

      //echo '<br />';

        if ($permalinkopt != '/%postname%/')

           { ?>

           

                     <img alt="aux" width="40px" src="<?php echo CARDEALERURL?>assets/images/noktick.png" />

             <br />

 

                     <br />

                     Wrong Permalink settings !

                     <br />

                     Please, fix it to avoid 404 error page.

                     <br />

                     To correct, just follow this steps:

                     <br />

                     Dashboard => Settings => Permalinks => Post Name (check)

                     <br />  

                     Click Save Changes

                      <?php

           }

        else

          echo '<img alt="aux" width="40px" src="'.CARDEALERURL.'assets/images/oktick.png" />';

        

        

      ?>

          

            

            

            

            

            

            

   

             <br /> <br /> 

        </div> <!-- "columns 2">  -->

        <div class="cardealer-help-column cardealer-help-column-3">

             

             

             <h3 style="color:red;">Premium Version Disabled.</h3>

             Get more Grid template
             <br />

             Get more 2 single page templates.
             <br />

             Get Color Options, more shortcodes:

<br />

- Filter Cars for Type (Van, Sedan, and so on)

<br />

- Last Cars

<br />

- Featured Cars

<br />

- Order by Price/Year Ascending/Descending

<br />

- Create Blocks type Gallery or Page List

<br />

- Combine Shortcodes

<br />

- Number of Cars to show

<br />

- Show or Hide Pagination

<br />

- Show or Hide Search Box

<br />





          

             

           <?php $site = 'http://cardealerplugin.com/premium/'; ?>

           <a href="<?php echo $site; ?>" class="button button-primary">Learn More</a>

        </div> 

        <!-- "Column 3">  --> 

    </div> <!-- "Container 1 " -->

</div>





   <div id="cardealer-steps3">

       <div class="cardealer-block-title"> 

           <img alt="aux" src="<?php echo CARDEALERURL?>assets/images/3steps.png" />

           <br />   <br />

           Follow this 3 steps after install the plugin:

       </div>

    <div class="cardealer-help-container1">

        <div class="cardealer-help-column cardealer-help-column-1">

        <img alt="aux" src="<?php echo CARDEALERURL?>assets/images/step1.png" />

          <h3>Configurate Settings</h3>

          Go to <br />

          Dashboard=>Car Dealer=>Settings

          <br />

          <em>Fill out the information</em>:

           <br />

          - Your Currency

           <br />

          - Miles - Km  

           <br />

           - Your Contact eMail

           <br />

           - And So On ...

           <br /> <br />

           <strong>Import Demo Data:</strong>

           <br />

           If you want import demo data, click the Help Button at top right corner

           and take a look Import Demo Data or, if you are using our theme, you can import together with theme demo import.

           <br />

           If you import demo data, you can skip step 2. 



       </div> <!-- "Column1">  -->      

        <div class="cardealer-help-column cardealer-help-column-2">

            <img alt="aux" src="<?php echo CARDEALERURL?>assets/images/step2.png" />

            <h3>Fill Out the Fields and Car Tables</h3>

            <b>Go to Fields Table:</b><br /> 

            Dashboard=>Car Dealer=>Fields Table

            <br />

            They are the fields to show up at your cars form.

            For example: 

            <br />  

            - Number of Doors

            <br />

            - Passenger Capacity

            <br />

            - Body Color

            <br />

            - And So On. 

            <br /><br />

            You don't need include this fields: Price, Year, Miles, HP, Transmission Type, Fuel Type, Condition and Featured.



            <br /><br />

            <b>Go to Cars Table:</b><br /> 

            Dashboard=>Car Dealer=>Cars table 

            <br /> 

            And fill out this table with yours products.

            <br /> 

            For example:

            <br />

            - Cars

            - Vans

            - And So On.

            

        </div> <!-- "columns 2">  --> 

       <div class="cardealer-help-column cardealer-help-column-3">

            <img alt="aux" src="<?php echo CARDEALERURL?>assets/images/step3.png" />

            <h3>Paste the code  in your page:</h3>

            Go to your page and copy and paste this code:

            <br />

            [car_dealer]

            

            <br /><br />

            To create one Team page, just past this shortcode in your page:

            <br />

             [cardealer_team]

           

            <br /><br />

            To show only the Search Bar, just past this shortcode in your page:

            <br />

            [car_dealer onlybar="yes"]

           

           

           

            <br /><br />

            <strong>The Premium Version have dozens of extra codes and colors control.</strong>

            <br /><br />

            

        </div> 

        <!-- "Column 3">  --> 

    </div> <!-- "Container 1 " -->    

   </div> <!-- "cardealer-steps3"> -->

   <div id="cardealer-services3">

     <div class="cardealer-block-title">

      Help, Demo, Support, Troubleshooting:

    </div>

    <div class="cardealer-help-container1">

        <div class="cardealer-help-column cardealer-help-column-1">

           <img alt="aux" src="<?php echo CARDEALERURL?>assets/images/support.png" />

          <h3>Help and more tips</h3>

          Just click the HELP button at top right corner this page for context help. Also <em>Tooltip</em> available in Fields form.

          <br /><br />

       </div> <!-- "Column1">  -->   

        <div class="cardealer-help-column cardealer-help-column-2">

            <img alt="aux" src="<?php echo CARDEALERURL?>assets/images/service_configuration.png" />

          <h3>OnLine Guide, Support, Demo, Demo Video, Faq...</h3>  

          You will find our complete and updated OnLine guide, demo, demo video, faqs page, link to support page and more usefull stuff in our site.

          <br /><br />

          <?php $site = 'http://cardealerplugin.com'; ?>

         <a href="<?php echo $site;?>" class="button button-primary">Go</a>

        </div> <!-- "columns 2">  --> 

       <div class="cardealer-help-column cardealer-help-column-3">

 

 

          <img alt="aux" src="<?php echo CARDEALERURL?>assets/images/system_health.png" />

          <h3>Troubleshooting Guide</h3>  

          Use old WordPress version, Low memory, some plugin with Javascript error, wrong permalink settings are some possible problems. Read this and fix it quickly!

          <br /><br />

          <a href="http://siterightaway.net/troubleshooting/" class="button button-primary">Troubleshooting Page</a>


       </div> <!-- "Column 3">  --> 

    </div> <!-- "Container1 ">  -->   

   </div> <!-- "services"> -->

    </div> <!-- "cardealer-dashboard-left"> -->

    <div id="cardealer-dashboard-right"> 

    <div id="containerright-dashboard">
    <?php require_once (CARDEALERPATH . "dashboard/mybanners.php"); ?>
    </div> 
    

    </div> <!-- "cardealer-dashboard-right"> -->



   </div> <!-- "car-dealer-dashboard-wrap"> -->
