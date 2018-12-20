<?php
//start session
function register_ep_session(){
	if( !session_id() ){
		session_start();
		//session_set_cookie_params(3600,"/");
	}
}
add_action('template_redirect', 'register_ep_session');
/**
 * Include Theme Functions
 *
 * @package Spotlight Child Theme
 * @subpackage Functions
 * @version 1.0.0
 */

/**
 * Setup Child Theme
 */
function csco_setup_child_theme() {
	// Add Child Theme Text Domain.
	load_child_theme_textdomain( 'spotlight', get_stylesheet_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'csco_setup_child_theme', 99 );

/**
 * Enqueue Child Theme Assets
 */
function csco_child_assets() {
	if ( ! is_admin() ) {
		$version = wp_get_theme()->get( 'Version' );
		wp_enqueue_style( 'csco_child_css', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array(), $version, 'all' );
	}
}

add_action( 'wp_enqueue_scripts', 'csco_child_assets', 99 );

/**
 * Add your custom code below this comment.
 */
function disable_ep_membership_plugin($plugins){

    // check if you are on the certain page
    global $pagenow;
    if( $pagenow == 'post.php' ) {

        // check if it's right CPT
        if( isset($_GET['post_type']) && $_GET['post_type'] == 'cpt_epm_form') {

            // search the plugin to disable among active plugins
            // Warning! Check the plugin directory and name
            $key = array_search( 'energy-pages-membership/epm.php' , $plugins );

            // if found, unset it from the active plugins array
            if ( false !== $key ) {
                unset( $plugins[$key] );
            }
        }
    }

    return $plugins;
}
add_filter( 'option_active_plugins', 'disable_ep_membership_plugin' );

//Geocode google maps
function prettyAddress($address) {

    $location = array();

    if (empty($address))

        return $location;



    $address = str_replace(" ", "+", $address);

    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyCntthdn3101F8RC8RLzv9QxF_tmCvdqNg";



    $cache_path = get_stylesheet_directory().'/geocode-cache/';

    $filename = $cache_path.md5($url);



    // && ( time() - 84600 < filemtime($filename) )

    if( file_exists($filename) ){

        $result = json_decode(file_get_contents($filename), true);



        if (!isset($result['results'][0]['address_components']))

            return $location;

        $components = $result['results'][0]['address_components'];

        foreach ($result['results'][0]['address_components'] as $component) {

            switch ($component['types']) {

                case in_array('street_number', $component['types']):

                    $location['street_number'] = $component['long_name'];

                    break;

                case in_array('route', $component['types']):

                    $location['street'] = $component['long_name'];

                    break;

                case in_array('sublocality', $component['types']):

                    $location['sublocality'] = $component['long_name'];

                    break;

                case in_array('locality', $component['types']):

                    $location['city'] = $component['long_name'];

                    break;

                case in_array('administrative_area_level_2', $component['types']):

                    $location['admin_2'] = $component['long_name'];

                    break;

                case in_array('administrative_area_level_1', $component['types']):

                    $location['state'] = $component['long_name'];

                    $location['state_code'] = $component['short_name'];

                    break;

                case in_array('postal_code', $component['types']):

                    $location['postal_code'] = $component['long_name'];

                    break;

                case in_array('country', $component['types']):

                    $location['country'] = $component['long_name'];

                    $location['country_code'] = $component['short_name'];

                    break;

            }

        }

    }

    else {

        $result  = file_get_contents($url);

        file_put_contents($filename, $result );

        $result  = json_decode($result , true);



        if (!isset($result['results'][0]['address_components']))

            return $location;

        $components = $result['results'][0]['address_components'];

        foreach ($result['results'][0]['address_components'] as $component) {

            switch ($component['types']) {

                case in_array('street_number', $component['types']):

                    $location['street_number'] = $component['long_name'];

                    break;

                case in_array('route', $component['types']):

                    $location['street'] = $component['long_name'];

                    break;

                case in_array('sublocality', $component['types']):

                    $location['sublocality'] = $component['long_name'];

                    break;

                case in_array('locality', $component['types']):

                    $location['city'] = $component['long_name'];

                    break;

                case in_array('administrative_area_level_2', $component['types']):

                    $location['admin_2'] = $component['long_name'];

                    break;

                case in_array('administrative_area_level_1', $component['types']):

                    $location['state'] = $component['long_name'];

                    $location['state_code'] = $component['short_name'];

                    break;

                case in_array('postal_code', $component['types']):

                    $location['postal_code'] = $component['long_name'];

                    break;

                case in_array('country', $component['types']):

                    $location['country'] = $component['long_name'];

                    $location['country_code'] = $component['short_name'];

                    break;

            }

        }

    }

    return $location;

}

function matchAddress($search, $db, $count = 0) {

    $match = false;

    if (isset($db['country'])) {

        if (strlen($db['country']) > 2) {

            if (stripos($db['country'], $search['country']) !== FALSE)

                $match = TRUE;

            else

                $match = FALSE;

        } else {

            if (stripos($db['country'], $search['country_code']) !== FALSE)

                $match = TRUE;

            else

                $match = FALSE;

        }

    }

    if ($count == 1)

        return $match;

    if (isset($db['state'])) {

        if (strlen($db['state']) > 2) {

            if (stripos($db['state'], $search['state']) !== FALSE)

                $match = TRUE;

            else

                $match = FALSE;

        } else {

            if (stripos($db['state'], $search['state_code']) !== FALSE)

                $match = TRUE;

            else

                $match = FALSE;

        }

    }

    if ($count == 2)

        return $match;

    if (isset($db['city'])) {

        if (stripos($db['city'], $search['city']) !== FALSE)

            $match = TRUE;

        else

            $match = FALSE;

    }

    return $match;

}