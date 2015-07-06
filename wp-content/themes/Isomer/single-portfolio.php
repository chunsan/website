<?php
/**
 * The template for displaying all single posts.
 *
 * @package fabthemes
 */

get_header(); ?>

<header class="title-header">
	<div class="container"><div class="row"> 
		<div class="col-md-12"> 
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</div></div>
</header><!-- .entry-header -->

<div class="container"><div class="row">

<div class="col-md-12">

	<?php $images = rwmb_meta('rw_gallery', 'type=image');

	echo'<div id="slider-box" class="flexslider">';
	echo '<div class="ul slides">';
	foreach ( $images as $image )
	{
		$port_image = aq_resize( $image['full_url'], 960, 460, true,true,true );	
	    echo "<li><a href='{$image['full_url']}' title='{$image['title']}' rel='thickbox'><img src='$port_image' alt='{$image['alt']}' /></a></li>";
	}
	echo '</div>';
	echo '</div>';

	?>

	<?php $video = rwmb_meta('rw_video','type=text'); 
		echo'<div id="video-box">';
		echo wp_oembed_get($video);
		echo '</div>';
	?>


</div>

	<div class="col-md-8">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>


			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="portfolio-content">
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'fabthemes' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->


			</article><!-- #post-## -->


				<?php fabthemes_post_nav(); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
	
	<div class="col-md-4">
		<div id="secondary">
		<div class="portfolio-meta">

			<div> <i class="fa fa-clock-o"></i> <?php _e( 'Date: ', 'fabthemes' );?> <?php the_time('j F Y'); ?></div>
			<div> <i class="fa fa-tag"></i> <?php echo get_the_term_list( $post->ID, 'genre', 'Genre: ', ', ' ); ?>	</div>
			<div> <i class="fa fa-suitcase"></i> <?php echo get_the_term_list( $post->ID, 'client', 'Client: ', ', ' ); ?>  </div>
			<div> <i class="fa fa-link"></i> <?php _e( 'Url: ', 'fabthemes' );?><?php echo  rwmb_meta( 'rw_url', 'type=text' ); ?></div>
			
		</div>
		</div>
	</div>


</div></div>
<?php get_footer(); ?>