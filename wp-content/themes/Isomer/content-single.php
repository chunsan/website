<?php
/**
 * @package fabthemes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<?php 
	$thumb = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
	$image = aq_resize( $img_url, 960, 460, true,true,true ); //resize & crop the image
	?>
	<?php if($image) : ?>
		<img class="postimg" src="<?php echo $image ?>" alt="<?php the_title(); ?>" /> 
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'fabthemes' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="row">
			<div class="col-md-6 footer-meta">
				<div> 
					<i class="fa fa-user"></i> <?php the_author(); ?> 
				</div>
				<div>
					<i class="fa fa-clock-o"></i> <?php the_time('j F Y'); ?>
				</div>				
			</div>
			<div class="col-md-6 footer-meta">
				<div>
					<i class="fa fa-tag"></i> <?php the_category(', '); ?>
				</div>
				<div>
					 <i class="fa fa-comment"></i> <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?>
				</div>				
			</div>

			<div class="clear"></div>

			<div class="col-md-12">
				<div class="author clearfix">
					 <h3><?php _e( 'About', 'fabthemes'); ?> <?php the_author();?> </h3>
					<?php the_author_meta('description'); ?>
				</div>
			</div>

		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
