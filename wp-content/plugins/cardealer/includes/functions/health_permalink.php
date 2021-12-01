<?php

global $wp_version;

if (version_compare($wp_version, '5.2') >= 0) {
    cardealer_health_permalink();
} else {
    return;
}

function cardealer_health_permalink()
{
    function cardealer_add_permalink_test($tests)
    {
        $tests['direct']['permalink'] = array(
            'label' => __('Wrong Permalink', 'cardealer'),
            'test' => 'cardealer_permalink_test',
        );
        return $tests;
    }
  
   $cardealerurl = esc_url($_SERVER['REQUEST_URI']);
	if (strpos($cardealerurl, '/options-permalink.php') === false) {
		$permalinkopt = get_option('permalink_structure');
		if ($permalinkopt != '/%postname%/')
				add_filter('site_status_tests', 'cardealer_add_permalink_test');
	}
  
    
    function cardealer_permalink_test()
    {


        $result = array(
            'badge' => array(
                'label' => __('Critical', 'cardealer'), // Performance
                'color' => 'red', // orange',
            ),
            'test2' => 'Bill_plugin',
            'status' => 'critical',
            'label' => __('Wrong Permalink Settings', 'cardealer'),
            'description' =>  sprintf(
                '<p>%s</p>',
                __('Please, fix it to avoid 404 error page.
                     To correct, just go to 
                     Dashboard => Settings => Permalinks => Post Name (check)
                     Then, click Save Changes.','cardealer')
            ),
        );
        return $result;
    }
}
