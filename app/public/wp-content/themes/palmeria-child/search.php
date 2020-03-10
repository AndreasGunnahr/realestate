<?php
/**
 * The template for displaying search results pages.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 */
get_header();
?>
	<?php get_search_form(); ?>
	<section id="primary" class="content-area <?php echo esc_attr(get_theme_mod('palmeria_blog_layout', PALMERIA_BLOG_LAYOUT_2)); ?>">
		<main id="main" class="site-main">

		<?php

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $big = 99999999999;
        if (isset($_GET['min_room'])) {
            $min_room = sanitize_text_field(wp_unslash($_GET['min_room']));
        }
        if (isset($_GET['max_room'])) {
            $max_room = sanitize_text_field(wp_unslash($_GET['max_room']));
        }
        if (isset($_GET['min_price'])) {
            $min_price = sanitize_text_field(wp_unslash($_GET['min_price']));
        }
        if (isset($_GET['max_price'])) {
            $max_price = sanitize_text_field(wp_unslash($_GET['max_price']));
        }
        if (isset($_GET['s']) && $_GET['s'] != '') {
            $search_input = sanitize_text_field(wp_unslash($_GET['s']));
        }
        if ('' === $max_room) {
            $max_room = $big;
        }
        if ('' === $max_price) {
            $max_price = $big;
        }

        $query = new WP_Query(array(
            'post_type' => 'sales_item',
            's' => $search_input,
            'post_status' => 'publish',
            'paged' => $paged,
            'posts_per_page' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'number_of_rooms',
                    'value' => array($min_room, $max_room),
                    'type' => 'numeric',
                    'compare' => 'BETWEEN',
                ),
                array(
                    'key' => 'initial_bid',
                    'value' => array($min_price, $max_price),
                    'type' => 'numeric',
                    'compare' => 'BETWEEN',
                ),
            ),
        ));
        ?>


		<?php if ($query->have_posts()) : ?>

			<header class="page-header">
				<h1 class="page-title">
				<div class = "header-container">
                    <h1><?php echo $query->found_posts; ?> objects found</h1>
                </div>
			</header><!-- .page-header -->

            <div class = "grid-container">
			<?php while ($query->have_posts()) : $query->the_post(); ?>
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
			<?php endwhile; ?>
		</div>
		<div class = "pagination">
			<?php

                echo paginate_links(array(
                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                    'total' => $query->max_num_pages,
                    'current' => $paged,
                    'format' => '?page=%#%',
                ));
            ?> 
		</div>
		<?php
        else : ?>
			<header class="page-header archive-header">
                <h1 class="page-title"><?php esc_html_e('Nothing Found', 'palmeria'); ?></h1>
            </header><!-- .page-header -->
            <p class = "error-text"><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Please try agian.', 'palmeria'); ?></p>
       <?php endif;
        ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
