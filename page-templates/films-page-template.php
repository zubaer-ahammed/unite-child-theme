<?php 
/**
 * Template Name: Films List
 */

get_header(); ?>

	<div id="primary" class="content-area col-sm-12 col-md-8 <?php echo of_get_option( 'site_layout' ); ?>">
		<main id="main" class="site-main" role="main">
		
		<?php  

		$film_args = array (
			'post_type'              => array( 'film' ),
			'post_status'            => array( 'publish' ),
			'posts_per_page'	     => -1	
		);

		// The Query
		$film_query = new WP_Query( $film_args );

		?>
		
		<?php if($film_query->have_posts()): ?>

			<?php while ( $film_query->have_posts() ) : $film_query->the_post(); ?>

				<?php get_template_part( 'content', 'film-single' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php endif; ?>	


		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>