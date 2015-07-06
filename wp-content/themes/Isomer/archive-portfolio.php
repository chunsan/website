<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package fabthemes
 */

get_header(); ?>

<header class="title-header">
	<div class="container"><div class="row"> 
		<div class="col-md-12"> 
		<h1><?php _e( 'Our Portfolio', 'fabthemes' ); ?></h1>
		</div>
	</div></div>
</header><!-- .entry-header -->

<div class="container"><div class="row"> 
	<div class="col-md-12">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="portfolio-box">
		<?php if ( have_posts() ) : ?>
			<div class="row">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
					<div class="folio-item col-md-3 col-sm-6">
					<div class="portfolio-thumb">
						<?php 
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
						$image = aq_resize( $img_url, 768, 768, true,true,true ); //resize & crop the image
						?>
						<?php if($image) : ?>

							<div class="folio-pic">
								<div class="folio-overlay">
									<h3> <a href="<?php the_permalink();?>"> <?php the_title(); ?> </a></h3>
									<?php echo get_the_term_list( $post->ID, 'genre', 'Genre: ', ', ' ); ?>
								</div>
								<a href="<?php the_permalink();?>"> <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" /> </a>
							</div>
							
						<?php endif; ?>
						
					</div>
					</div>
			<?php endwhile; ?>
			</div>
		</div>
			<?php fabthemes_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	</div>

</div></div>
<?php get_footer(); ?>
