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
    ?>
    <?php get_search_form(); ?>
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
                            <p class = "card-info">£<?php echo number_format(get_post_meta(get_the_ID(), 'initial_bid', true)); ?> </p>
                            <p class = "card-info"><?php echo get_post_meta(get_the_ID(), 'square_meters', true); ?> sqm</p>
                            <p class = "card-info rooms"><?php echo get_post_meta(get_the_ID(), 'number_of_rooms', true); ?> rooms</p>
                            <?php echo the_category(); ?>
                            <?php the_tags("<div class = 'tag-wrapper'>", ',', '</div>'); ?>
                            <p class = "card-info date"><?php echo get_the_date(); ?><p>
                        </div>
                    </div>
                <?php endwhile;
                ?>
            </div>
            <h1 class = "selected-item-h1">All listings</h1>
            <div class = "grid-container">
            <?php
            wp_reset_query();
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            if (have_posts()) :
                while (have_posts()) : the_post(); ?>
                    <div class = "card">
                    <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(); ?> </a>
                        <div class = "info-container">
                            <h2 class = "card-title"><a href="<?php the_permalink(); ?>" title="Read"><?php the_title(); ?></a></h2>
                            <p class = "card-info">£<?php echo number_format(get_post_meta(get_the_ID(), 'initial_bid', true)); ?> </p>
                            <p class = "card-info"><?php echo get_post_meta(get_the_ID(), 'square_meters', true); ?> sqm</p>
                            <p class = "card-info rooms"><?php echo get_post_meta(get_the_ID(), 'number_of_rooms', true); ?> rooms</p>
                            <?php echo the_category(); ?>
                            <?php the_tags("<div class = 'tag-wrapper'>", ',', '</div>'); ?>
                            <p class = "card-info date"><?php echo get_the_date(); ?><p>
                        </div>
                    </div>
                <?php endwhile;
                endif;
                ?>
            
            </div>
            <div class = "pagination">
                <?php
                    echo paginate_links(array(
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'current' => $paged,
                        'format' => '?page=%#%',
                    ));
                ?> 
            </div>
            <?php
        else :
            get_template_part('template-parts/content', 'none');

            // http://realestate.local/page/1/?s

        endif;
        ?>
        

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
