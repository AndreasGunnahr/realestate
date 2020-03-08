<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
get_header();
?>
    <?php
        $querySelected = new WP_Query(array(
            'post_type' => 'sales_item',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => 'selected_item',
                    'value' => '1',
                ),
            ),
            'posts_per_page' => 3,
        ));

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $query = new WP_Query(array(
            'post_type' => 'sales_item',
            'paged' => $paged,
            'post_status' => 'publish',
            'posts_per_page' => 5,
            'ignore_sticky_posts' => true,
        ));
    ?>
    <!-- <div class = "search-bar"> -->
    <?php echo do_shortcode('[searchandfilter fields="search,category,post_tag"]'); ?>
	<!-- </div> -->
	<div id="primary" class="content-area <?php echo esc_attr(get_theme_mod('palmeria_blog_layout', PALMERIA_BLOG_LAYOUT_2)); ?>">
		<main id="main" class="site-main">

		<?php

        if (have_posts()) :

            if (is_home() && !is_front_page()) :
                ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
            endif; ?>
        
            <h1 class = "selected-item-h1">Our favorites</h1>
            <div class = "grid-container">
                <?php while ($querySelected->have_posts()) : $querySelected->the_post(); ?>
                    <div class = "card">
                    <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(); ?> </a>
                        <div class = "info-container">
                            <h2 class = "card-title"><a href="<?php the_permalink(); ?>" title="Read"><?php the_title(); ?></a></h2>
                            <p class = "card-info"><?php echo get_post_meta(get_the_ID(), 'initial_bid', true); ?> </p>
                            <p class = "card-info"><?php echo get_post_meta(get_the_ID(), 'square_meters', true); ?> sqm</p>
                            <?php echo the_category(); ?>
                            <?php the_tags("<div class = 'tag-wrapper'>", ',', '</div>'); ?>
                            <p class = "card-info"><?php echo get_the_date(); ?><p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <h1 class = "selected-item-h1">All listings</h1>
            <div class = "grid-container">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class = "card">
                    <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(); ?> </a>
                        <div class = "info-container">
                            <h2 class = "card-title"><a href="<?php the_permalink(); ?>" title="Read"><?php the_title(); ?></a></h2>
                            <p class = "card-info"><?php echo get_post_meta(get_the_ID(), 'initial_bid', true); ?> </p>
                            <p class = "card-info"><?php echo get_post_meta(get_the_ID(), 'square_meters', true); ?> sqm</p>
                            <?php echo the_category(); ?>
                            <?php the_tags("<div class = 'tag-wrapper'>", ',', '</div>'); ?>
                            <p class = "card-info"><?php echo get_the_date(); ?><p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class = "pagination">
                <?php

                    echo paginate_links(array(
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'total' => $query->max_num_pages - 2,
                        'current' => $paged,
                        'format' => '?paged=%#%',
                        'show_all' => false,
                        'type' => 'plain',
                        'end_size' => 2,
                        'mid_size' => 1,
                        // 'prev_next' => true,
                        // 'prev_text' => sprintf('<i></i> %1$s', __('Newer Posts', 'text-domain')),
                        // 'next_text' => sprintf('%1$s <i></i>', __('Older Posts', 'text-domain')),
                        // 'add_args' => false,
                        // 'add_fragment' => '',
                    ));
                ?> 
            </div>

                <?php
            // echo do_shortcode("[post_grid id='367']");
            /* Start the Loop */
            // have_posts()
            // the_post()
            // while ($query->have_posts()) :
            //         $query->the_post();
            //         // $post_id = get_the_ID();
            //         // echo $post_id;
            //         // echo "<br>";

            //     /*
            //      * Include the Post-Type-specific template for the content.
            //      * If you want to override this in a child theme, then include a file
            //      * called content-___.php (where ___ is the Post Type name) and that will be used instead.
            //      */
            //     get_template_part('template-parts/content-loop', get_post_type());

            // endwhile;

            // palmeria_posts_pagination();

        else :

            get_template_part('template-parts/content', 'none');

        endif;
        ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
