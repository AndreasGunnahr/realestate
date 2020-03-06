<?php
/**
 * The template for displaying archive pages.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
get_header();
?>

	<div id="primary" class="content-area <?php echo esc_attr(get_theme_mod('palmeria_blog_layout', PALMERIA_BLOG_LAYOUT_2)); ?>">
		<main id="main" class="site-main">
        <?php
            $page_object = get_queried_object();
            $tag_id = get_tag_ID($_GET['tag']);
        ?>
		<?php $query = new WP_Query(
            array(
                'post_type' => 'sales_item',
                // 'paged' => $paged,
                'category__and' => $page_object->cat_ID,
                'tag__in' => $tag_id,
                'post_status' => 'publish',
                'posts_per_page' => -5,
                ));
        ?>
		<?php if ($query->have_posts()) : ?>

			<header class="page-header">
				<?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
			</header><!-- .page-header -->

            <div class = "grid-container">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class = "card">
                    <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(); ?> </a>
                        <div class = "info-container">
                            <h2 class = "card-title"><a href="<?php the_permalink(); ?>" title="Read"><?php the_title(); ?></a></h2>
                            <p class = "card-info"><?php echo get_post_meta(get_the_ID(), 'initial_bid', true); ?> </p>
                            <p class = "card-info"><?php echo get_post_meta(get_the_ID(), 'square_meters', true); ?> sqm</p>
                            <?php echo the_category(); ?>
                            <p class = "card-info"><?php echo get_the_date(); ?><p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>	<!-- 
            // /* Start the Loop */
            // while ($query->have_posts()) :
            //     $query->the_post();
                // echo the_post();
                // echo $query->get_post_type();
                // $query->get_post_type();
                //  * Include the Post-Type-specific template for the content.
                //  * If you want to override this in a child theme, then include a file
                //  * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                //  */
                // get_template_part('template-parts/content-loop', get_post_type());

        <<?php

        else :

            get_template_part('template-parts/content', 'none');

        endif;
        ?> -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
