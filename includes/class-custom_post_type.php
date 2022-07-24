<?php
//class custom_post_type{
class custom_post_type
{

      public static function coin_post_register()
      {

            //public static 
            function coins_post()
            {
                  $supports = array(
                        'title', // post title
                        'editor', // post content
                        'author', // post author
                        'thumbnail', // featured images
                        'excerpt', // post excerpt
                        'revisions', // post revisions
                  );
                  $labels = array(
                        'name' => 'coins',
                        'singular_name' => 'coins',
                        'menu_name' => 'Coins',
                        'name_admin_bar' => 'Coins',
                        'add_new' => 'Add New',
                        'add_new_item' => 'Add New coins',
                        'new_item' => 'New coins',
                        'edit_item' => 'Edit coins',
                        'view_item' => 'View coins',
                        'all_items' => 'All coins',
                        'search_items' => 'Search coins',
                        'not_found' => 'No coins found.',
                  );
                  $args = array(
                        'supports' => $supports,
                        'labels' => $labels,
                        'public' => true,
                        'query_var' => true,
                        'rewrite' => array('slug' => 'coins'),
                        'has_archive' => true,
                        'hierarchical' => true,
                  );
                  register_post_type('coins', $args);
            }

            add_action('init', 'coins_post', 30);
      }
}
