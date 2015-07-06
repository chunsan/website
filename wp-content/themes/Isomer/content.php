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
		<a href="<?php the_permalink();?>"> <img class="postimg" src="<?php echo $image ?>" alt="<?php the_title(); ?>" /> </a>
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="row">
		<div class="col-md-4 entry-meta">
			<div> 
				<i class="fa fa-user"></i> <?php the_author(); ?> 
			</div>
			<div>
				<i class="fa fa-clock-o"></i> <?php the_time('j F Y'); ?>
			</div>
			<div>
				<i class="fa fa-tag"></i> <?php the_category(', '); ?>
			</div>
			<div>
				 <i class="fa fa-comment"></i> <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?>
			</div>
			
		</div>
		<div class="col-md-8">
			<div class="entry-content">
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink();?>" class="readmore"> <?php _e( 'Read more', 'fabthemes' ); ?> </a>
			</div><!-- .entry-content -->
		</div>
	</div>

</article><!-- #post-## -->
