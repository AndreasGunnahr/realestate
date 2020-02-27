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
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $query = new WP_Query(array(
            'post_type' => 'sales_item',
            // 'paged' => $paged,
            'post_status' => 'publish',
            'posts_per_page' => -5,
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
            endif;
            echo do_shortcode("[post_grid id='367']");
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
