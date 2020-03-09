<?php
/**
 * The template for displaying search results pages.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 */
get_header();
?>
	<?php echo do_shortcode('[searchandfilter fields="search,category,post_tag"]'); ?>
	<section id="primary" class="content-area <?php echo esc_attr(get_theme_mod('palmeria_blog_layout', PALMERIA_BLOG_LAYOUT_2)); ?>">
		<main id="main" class="site-main">

		<?php

        // echo is_numeric(get_search_query());
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $query = new WP_Query(array(
            'post_type' => 'sales_item',
            's' => get_search_query(),
            'post_status' => 'publish',
            'posts_per_page' => 5,
            'paged' => $paged,
        ));
        ?>

		<?php if ($query->have_posts()) : ?>

			<header class="page-header">
				<h1 class="page-title">
				<div class = "header-container">
                    <h1><?php echo $query->found_posts; ?> objects found for: <?php echo get_search_query(); ?></h1>
                </div>
					<!-- <?php
                    /* translators: %s: search query. */
                    printf(esc_html__('Search Results for: %s', 'palmeria'), '<span>'.get_search_query().'</span>');
                    ?>
				</h1> -->
			</header><!-- .page-header -->

            <div class = "grid-container">
			<?php while ($query->have_posts()) : $query->the_post(); ?>
				<div class = "card">
				<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(); ?> </a>
					<div class = "info-container">
						<h2 class = "card-title"><a href="<?php the_permalink(); ?>" title="Read"><?php the_title(); ?></a></h2>
						<p class = "card-info"><?php echo get_post_meta(get_the_ID(), 'initial_bid', true); ?> </p>
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
