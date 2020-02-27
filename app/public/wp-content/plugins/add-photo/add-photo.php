<?php

/**
 * Plugin Name: Add Photo Plugin
 * Description: Add photo
 * Author: Elin S
 * Text Domain: add-phto
 */

// only need these if performing outside of admin environment
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');

function add_photo (){
    // example image

$file_content = '[{
    "id": 1,
    "address": "2 Ohio Circle",
    "view_date": "10/26/2020",
    "initial_bid": "£6259467.69",
    "rooms": 13,
    "sqm": 953,
    "selected": false
  }, {
    "id": 2,
    "address": "33881 Florence Avenue",
    "view_date": "6/11/2020",
    "initial_bid": "£7933426.46",
    "rooms": 20,
    "sqm": 439,
    "selected": false
  }, {
    "id": 3,
    "address": "62553 Marcy Hill",
    "view_date": "6/4/2020",
    "initial_bid": "£7612932.45",
    "rooms": 12,
    "sqm": 424,
    "selected": true
  }, {
    "id": 4,
    "address": "910 Brown Pass",
    "view_date": "4/30/2020",
    "initial_bid": "£3746610.62",
    "rooms": 9,
    "sqm": 812,
    "selected": false
  }, {
    "id": 5,
    "address": "29136 Village Crossing",
    "view_date": "12/11/2020",
    "initial_bid": "£2929089.92",
    "rooms": 11,
    "sqm": 865,
    "selected": true
  }, {
    "id": 6,
    "address": "13 Michigan Pass",
    "view_date": "2/4/2021",
    "initial_bid": "£9850943.54",
    "rooms": 14,
    "sqm": 472,
    "selected": true
  }, {
    "id": 7,
    "address": "55805 Jenifer Way",
    "view_date": "12/18/2020",
    "initial_bid": "£8284918.71",
    "rooms": 6,
    "sqm": 599,
    "selected": false
  }, {
    "id": 8,
    "address": "7 Fallview Drive",
    "view_date": "7/16/2020",
    "initial_bid": "£7038810.37",
    "rooms": 2,
    "sqm": 171,
    "selected": false
  }, {
    "id": 9,
    "address": "3257 Roth Trail",
    "view_date": "10/12/2020",
    "initial_bid": "£6373047.28",
    "rooms": 12,
    "sqm": 289,
    "selected": false
  }, {
    "id": 10,
    "address": "50864 Grayhawk Street",
    "view_date": "8/2/2020",
    "initial_bid": "£3977258.69",
    "rooms": 20,
    "sqm": 706,
    "selected": true
  }, {
    "id": 11,
    "address": "53976 North Court",
    "view_date": "11/21/2020",
    "initial_bid": "£4828650.71",
    "rooms": 16,
    "sqm": 655,
    "selected": true
  }, {
    "id": 12,
    "address": "4 Dennis Circle",
    "view_date": "8/29/2020",
    "initial_bid": "£4057758.39",
    "rooms": 20,
    "sqm": 325,
    "selected": false
  }, {
    "id": 13,
    "address": "50 Merchant Crossing",
    "view_date": "7/24/2020",
    "initial_bid": "£8074106.05",
    "rooms": 17,
    "sqm": 124,
    "selected": true
  }, {
    "id": 14,
    "address": "066 Graedel Alley",
    "view_date": "7/18/2020",
    "initial_bid": "£7693351.20",
    "rooms": 14,
    "sqm": 790,
    "selected": false
  }, {
    "id": 15,
    "address": "3 Crest Line Hill",
    "view_date": "11/4/2020",
    "initial_bid": "£2399946.17",
    "rooms": 8,
    "sqm": 321,
    "selected": true
  }, {
    "id": 16,
    "address": "055 Mayfield Park",
    "view_date": "5/1/2020",
    "initial_bid": "£3810228.39",
    "rooms": 14,
    "sqm": 472,
    "selected": false
  }, {
    "id": 17,
    "address": "9023 1st Park",
    "view_date": "8/21/2020",
    "initial_bid": "£7553049.30",
    "rooms": 6,
    "sqm": 566,
    "selected": false
  }, {
    "id": 18,
    "address": "8841 Menomonie Trail",
    "view_date": "4/26/2020",
    "initial_bid": "£9433360.35",
    "rooms": 15,
    "sqm": 762,
    "selected": false
  }, {
    "id": 19,
    "address": "2911 Sloan Plaza",
    "view_date": "11/8/2020",
    "initial_bid": "£1612939.20",
    "rooms": 13,
    "sqm": 133,
    "selected": false
  }, {
    "id": 20,
    "address": "5 Jay Junction",
    "view_date": "11/3/2020",
    "initial_bid": "£2457911.27",
    "rooms": 5,
    "sqm": 849,
    "selected": false
  }]';


      $todo_data = json_decode($file_content, true);

      $index = 0;
    
      foreach($todo_data as $todo) {
        $args = [
          'post_type' => 'sales_item',
          'meta_key' => 'address',
          'meta_value' => $todo['address']
      ];
  
      $query = new WP_Query( $args );
      $post_id = false;
  
  
      if ( $query->have_posts() ) {
        $query->the_post();
        $existing_post = get_the_ID();
    }

    if( $existing_post ) {
        // update post, not only post meta
        $title = preg_replace('/[0-9]+/', '', $todo['address']);
        $post_id = wp_update_post(
            [
                'ID'    =>  $existing_post,
                'post_title' => $title
            ]
            );

            $image = array('https://images.pexels.com/photos/186077/pexels-photo-186077.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/1029599/pexels-photo-1029599.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 
            'https://images.pexels.com/photos/1396122/pexels-photo-1396122.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/2102587/pexels-photo-2102587.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/1643389/pexels-photo-1643389.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/1396132/pexels-photo-1396132.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/2079234/pexels-photo-2079234.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/1370704/pexels-photo-1370704.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/53610/large-home-residential-house-architecture-53610.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/208736/pexels-photo-208736.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/186077/pexels-photo-186077.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/1029599/pexels-photo-1029599.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940', 
            'https://images.pexels.com/photos/1396122/pexels-photo-1396122.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/2102587/pexels-photo-2102587.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/1643389/pexels-photo-1643389.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/1396132/pexels-photo-1396132.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/2079234/pexels-photo-2079234.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/1370704/pexels-photo-1370704.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/53610/large-home-residential-house-architecture-53610.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
            'https://images.pexels.com/photos/208736/pexels-photo-208736.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'
        );
        // magic sideload image returns an HTML image, not an ID
        $media = media_sideload_image($image[$index], $post_id);
                // therefore we must find it so we can set it as featured ID
                if(!empty($media) && !is_wp_error($media)){
                    $args = array(
                        'post_type' => 'attachment',
                        'posts_per_page' => -1,
                        'post_status' => 'any',
                        'post_parent' => $post_id
                    );
        
                    // reference new image to set as featured
                    $attachments = get_posts($args);
        
                    if(isset($attachments) && is_array($attachments)){
                        foreach($attachments as $attachment){
                            // grab source of full size images (so no 300x150 nonsense in path)
                            $image = wp_get_attachment_image_src($attachment->ID, 'full');
                            // determine if in the $media image we created, the string of the URL exists
                            if(strpos($media, $image[0]) !== false){
                                // if so, we found our image. set it as thumbnail
                                set_post_thumbnail($post_id, $attachment->ID);
                                // only want one image
                                break;
                            }
                        }
                    }
                }
        $index++;
        }
    }

    
}

// add_shortcode( 'add-photo', 'add_photo' );