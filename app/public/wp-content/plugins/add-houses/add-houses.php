<?php

/**
 * Plugin Name: House Plugin
 * Description: Add house
 * Author: Elin S
 * Text Domain: add-houses
 */

function add_todo_post () {

    // $url = "https://jsonplaceholder.typicode.com/todos/";
    // $file_content = file_get_contents($url);

    $file_content = '[{
      "id": 1,
      "address": "2 Ohio Circle",
      "view_date": "10/26/2020",
      "initial_bid": "£6259467.69",
      "rooms": 13,
      "sqm": 953,
      "selected": false,
      "city": "Union"
    }, {
      "id": 2,
      "address": "33881 Florence Avenue",
      "view_date": "6/11/2020",
      "initial_bid": "£7933426.46",
      "rooms": 20,
      "sqm": 439,
      "selected": false,
      "city": "Dillon"
    }, {
      "id": 3,
      "address": "62553 Marcy Hill",
      "view_date": "6/4/2020",
      "initial_bid": "£7612932.45",
      "rooms": 12,
      "sqm": 424,
      "selected": true,
      "city": "Killeen"
    }, {
      "id": 4,
      "address": "910 Brown Pass",
      "view_date": "4/30/2020",
      "initial_bid": "£3746610.62",
      "rooms": 9,
      "sqm": 812,
      "selected": false,
      "city": "Independence"
    }, {
      "id": 5,
      "address": "29136 Village Crossing",
      "view_date": "12/11/2020",
      "initial_bid": "£2929089.92",
      "rooms": 11,
      "sqm": 865,
      "selected": true,
      "city": "Georgetown"
    }, {
      "id": 6,
      "address": "13 Michigan Pass",
      "view_date": "2/4/2021",
      "initial_bid": "£9850943.54",
      "rooms": 14,
      "sqm": 472,
      "selected": true,
      "city": "Southlake"
    }, {
      "id": 7,
      "address": "55805 Jenifer Way",
      "view_date": "12/18/2020",
      "initial_bid": "£8284918.71",
      "rooms": 6,
      "sqm": 599,
      "selected": false,
      "city": "Marble Falls"
    }, {
      "id": 8,
      "address": "7 Fallview Drive",
      "view_date": "7/16/2020",
      "initial_bid": "£7038810.37",
      "rooms": 2,
      "sqm": 171,
      "selected": false,
      "city": "Flower Mound"
    }, {
      "id": 9,
      "address": "3257 Roth Trail",
      "view_date": "10/12/2020",
      "initial_bid": "£6373047.28",
      "rooms": 12,
      "sqm": 289,
      "selected": false,
      "city": "Longview"
    }, {
      "id": 10,
      "address": "50864 Grayhawk Street",
      "view_date": "8/2/2020",
      "initial_bid": "£3977258.69",
      "rooms": 20,
      "sqm": 706,
      "selected": true,
      "city": "Cedar Park"
    }, {
      "id": 11,
      "address": "53976 North Court",
      "view_date": "11/21/2020",
      "initial_bid": "£4828650.71",
      "rooms": 16,
      "sqm": 655,
      "selected": true,
      "city": "Allen"
    }, {
      "id": 12,
      "address": "4 Dennis Circle",
      "view_date": "8/29/2020",
      "initial_bid": "£4057758.39",
      "rooms": 20,
      "sqm": 325,
      "selected": false,
      "city": "Mission"
    }, {
      "id": 13,
      "address": "50 Merchant Crossing",
      "view_date": "7/24/2020",
      "initial_bid": "£8074106.05",
      "rooms": 17,
      "sqm": 124,
      "selected": true,
      "city": "Edinburg"
    }, {
      "id": 14,
      "address": "066 Graedel Alley",
      "view_date": "7/18/2020",
      "initial_bid": "£7693351.20",
      "rooms": 14,
      "sqm": 790,
      "selected": false,
      "city": "New Braunfels"
    }, {
      "id": 15,
      "address": "3 Crest Line Hill",
      "view_date": "11/4/2020",
      "initial_bid": "£2399946.17",
      "rooms": 8,
      "sqm": 321,
      "selected": true,
      "city": "Wichita Falls"
    }, {
      "id": 16,
      "address": "055 Mayfield Park",
      "view_date": "5/1/2020",
      "initial_bid": "£3810228.39",
      "rooms": 14,
      "sqm": 472,
      "selected": false,
      "city": "Laredo"
    }, {
      "id": 17,
      "address": "9023 1st Park",
      "view_date": "8/21/2020",
      "initial_bid": "£7553049.30",
      "rooms": 6,
      "sqm": 566,
      "selected": false,
      "city": "Lubbock"
    }, {
      "id": 18,
      "address": "8841 Menomonie Trail",
      "view_date": "4/26/2020",
      "initial_bid": "£9433360.35",
      "rooms": 15,
      "sqm": 762,
      "selected": false,
      "city": "Garland"
    }, {
      "id": 19,
      "address": "2911 Sloan Plaza",
      "view_date": "11/8/2020",
      "initial_bid": "£1612939.20",
      "rooms": 13,
      "sqm": 133,
      "selected": false,
      "city": "Irving"
    }, {
      "id": 20,
      "address": "5 Jay Junction",
      "view_date": "11/3/2020",
      "initial_bid": "£2457911.27",
      "rooms": 5,
      "sqm": 849,
      "selected": false,
      "city": "Arlington"
    }]';

    $todo_data = json_decode($file_content, true);

    foreach($todo_data as $todo) {
      $args = [
        'post_type' => 'sales_item',
        'meta_key' => 'address',
        'meta_value' => $todo['address']
    ];

    $query = new WP_Query( $args );
    $existing_post = false;


    if ( $query->have_posts() ) {
        $query->the_post();
        $existing_post = get_the_ID();
    }

    if( $existing_post ) {
      $post_id = wp_update_post(
        [
            'ID'    =>  $existing_post
        ]
        );

    } else {

      $title = preg_replace('/[0-9]+/', '', $todo['address']);
    
        $post_id = wp_insert_post(
            [
                'comment_status'  => 'closed',
                'ping_status'   => 'closed',
                'post_author'   => 1,
                'post_title'    => $title,
                'post_status'   => 'publish',
                'post_type'   => 'sales_item'
            ]
            );
          }

    $bid = substr($todo['initial_bid'], 2, -3);
    $bid = (int) $bid;
    // $bid = number_format($bid);
    // $pound = substr($todo['initial_bid'], 0, 2);
    // $bidNewFormat = $pound.$bid;

    // update_post_meta( $post_id, 'address', $todo['address'], $prev_value = '' );
    // update_post_meta( $post_id, 'property_view_date', $todo['view_date'], $prev_value = '' );
    // update_post_meta( $post_id, 'number_of_rooms', $todo['rooms'], $prev_value = '' );
    // update_post_meta( $post_id, 'square_meters', $todo['sqm'], $prev_value = '' );
    update_post_meta( $post_id, 'initial_bid', $bid, $prev_value = '' );
    // update_post_meta( $post_id, 'city', $todo['city'], $prev_value = '' );
    // update_post_meta( $post_id, 'selected_item', $todo['selected'], $prev_value = '' );
    // update_post_meta( $post_id, 'city', $city['city'], $prev_value = '' );

    // $tagArray = array("fireplace", "garden", "balcony", "swimming pool", 'central', 'close to nature', 'close to metro');
    // $tags = array_rand($tagArray, 2);

    // wp_set_post_tags( $post_id, $tags, true);

}

}

// add_shortcode( 'update-house', 'add_todo_post' );


