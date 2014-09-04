<?php
/*
Plugin Name: ViewCounter
Plugin URI: http://nichlasdam.dk/
Description: 
Author: Nichlas Dam
Version: 1.0
Author URI: http://nichlasdam.dk/
*/

function viewcounter() {
   if(is_single()) {
      global $post;
      $current_views = get_post_meta($post->ID, "viewcounter_views", true);
      if(!isset($current_views) OR empty($current_views) OR !is_numeric($current_views) ) {
         $current_views = 0;
      }
      $new_views = $current_views + 1;
      update_post_meta($post->ID, "viewcounter_views", $new_views);
      return $new_views;
   }
}

function viewcounter_get_view_count() {
   global $post;
   $current_views = get_post_meta($post->ID, "viewcounter_views", true);
   if(!isset($current_views) OR empty($current_views) OR !is_numeric($current_views) ) {
      $current_views = 0;
   }

   return $current_views;
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'nichlasdam_viewcounter/nichlasdam_viewcounter.php' ) ) {

add_action ('init', 'create_post_type');
function getPostViews($postID){
    $count_key = 'viewcounter_views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'viewcounter_views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
}
    
add_filter( 'the_content', 'viewcounter_filter');

function viewcounter_filter( $content ) {

    if ( is_single() )
            echo "Visninger: " . viewcounter_get_view_count();
    return $content;
}


?>
