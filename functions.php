<?php

//Hiding WP Version
function so_remove_version() {
	return '';
}
add_filter('the_generator', 'so_remove_version');

//Disable PING
add_filter( 'xmlrpc_methods', 'so_remove_ping' );
function so_remove_ping( $methods ) {
   unset( $methods['pingback.ping'] );
   unset( $methods['pingback.extensions.getPingbacks'] );
   return $methods;
}
add_filter( 'wp_headers', 'so_remove_pingback_headers' );
function so_remove_pingback_headers( $headers ) {
   unset( $headers['X-Pingback'] );
   return $headers;
}

// Disable use XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );

// Disable X-Pingback to header
add_filter( 'wp_headers', 'disable_x_pingback' );
function disable_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );

return $headers;
}

//Disable Update Notification
function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');