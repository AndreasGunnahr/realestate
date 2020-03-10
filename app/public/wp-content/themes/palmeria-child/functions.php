<?php

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function my_theme_enqueue_styles()
{
    $parent_style = 'parent-style';

    wp_enqueue_style($parent_style, get_template_directory_uri().'/style.css');
    wp_enqueue_style('child-style',
        get_stylesheet_directory_uri().'/style.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}

add_filter('the_content', 'prefix_add_content');

add_action('get_tag_ID', 'get_tag_ID');

function get_tag_ID($tag_name)
{
    $tag = get_term_by('slug', $tag_name, 'post_tag');
    if ($tag) {
        return $tag->term_id;
    } else {
        return 0;
    }
}

add_action('get_category_ID', 'get_category_ID');

function get_category_ID($category_name)
{
    $category = get_term_by('name', $category_name, 'category');
    if ($category) {
        return $category->term_id;
    } else {
        return 0;
    }
}

// adds custom content to sales_item
function prefix_add_content($content)
{
    global $post;
    if ($post->post_type == 'sales_item') {
        $number_of_rooms = get_post_meta(get_the_ID(), 'number_of_rooms', true);
        $square_meters = get_post_meta(get_the_ID(), 'square_meters', true);
        $address = get_post_meta(get_the_ID(), 'address', true);
        $initial_bid = get_post_meta(get_the_ID(), 'initial_bid', true);
        $view_date = get_post_meta(get_the_ID(), 'property_view_date', true);
        $city = get_post_meta(get_the_ID(), 'city', true);

        $str = $view_date;
        $str = $str[0].$str[1].$str[2].$str[3].'/'.$str[4].$str[5].'/'.$str[6].$str[7];
        $propert_view_date = date('F jS', strtotime($str));

        // make bid more readable
        $bid = number_format($initial_bid);
        $bidNewFormat = '£'.$bid;

        $before = '<h3 class="address">'.$address.', '.$city.'</h3>';
        $before .= '<ul class="estateInfo"><li><dl><dt>'.$number_of_rooms.'</dt><dd>rooms</dd></dl></li>';
        $before .= '<li><dl><dt>'.$square_meters.'<span class="sqm">sqm</span></dt><dd>interior</dd></dl></li>';
        $before .= '<li><dl><dt>'.$bidNewFormat.'</dt><dd>initial bid</dd></dl></li>';
        $before .= '<li><dl><dt class="date">'.$propert_view_date.'</dt><dd>viewing</dd></dl></li></ul>';

        $after = '';
        $content = $before.$content.$after;
    }

    return $content;
}

function my_cptui_add_post_types_to_archives($query)
{
    // We do not want unintended consequences.
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_category() || is_tag() && empty($query->query_vars['suppress_filters'])) {
        $cptui_post_types = cptui_get_post_type_slugs();

        $query->set(
            'post_type',
            array_merge(
                array('post'),
                $cptui_post_types
            )
        );
    }
}
add_filter('pre_get_posts', 'my_cptui_add_post_types_to_archives');

function addPagination($query)
{
    if (!is_admin() && $query->is_main_query()) {
        if (is_home()) {
            $query->set('post_type', 'sales_item');
            $query->set('posts_per_page', 5);
            $query->set('post_status', 'publish');
        }
    }
}
add_action('pre_get_posts', 'addPagination');
