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


?>
