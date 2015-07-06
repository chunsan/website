<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 Template name: Home
 * @package fabthemes
 */

get_header(); ?>

<div class="welcome-box">
	<div class="container"><div class="row">
		<div class="col-md-12">
			<h2 class="welcome-message">
				<?php echo ft_of_get_option('fabthemes_intro','Welcome to Our website'); ?>
			</h2>
		</div>
	</div></div>
</div>

<div class="portfolio-home">
	<div class="container"><div class="row">

		<div class="col-md-12">
			<ul id="folio-filter">
			<?php
	            $terms = get_terms("genre");
	            $count = count($terms);
	                echo '<li class="active"><a href="javascript:void(0)" title="" data-filter=".all">All</a></li>';
	            if ( $count > 0 ){
	 
	                foreach ( $terms as $term ) {
	 
	                    $termname = strtolower($term->name);
	                    $termname = str_replace(' ', '-', $termname);
	                    echo '<li><a href="javascript:void(0)" title="" data-filter=".'.$termname.'">'.$term->name.'</a></li>';
	                }
	            }
	        ?>
	        </ul>
		</div>

		<div class="clear"></div>

		<div class="portfolio-box">
			<?php 
				$pcount = ft_of_get_option('fabthemes_folio_count','8');
	       		$args = array( 'post_type' => 'portfolio', 'posts_per_page' => $pcount);
	       		$loop = new WP_Query( $args );
	         	while ( $loop->have_posts() ) : $loop->the_post(); 

				$terms = get_the_terms( $post->ID, 'genre' );	
				     if ( $terms && ! is_wp_error( $terms ) ) : 
				 
				         $links = array();
				 
				         foreach ( $terms as $term ) {
				             $links[] = $term->name;
				         }
				 
				         $tax_links = join( " ", str_replace(' ', '-', $links));          
				         $tax = strtolower($tax_links);
				     else :	
					 $tax = '';					
				     endif; 
				 

	         ?>
				<div class="folio-item col-md-3 col-xs-6 <?php echo $tax ?>">
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
	</div></div>
</div>


<div class="blog-home">
	<div class="container"> <div class="row"> 
			<?php 
				$pcount = ft_of_get_option('fabthemes_post_count','6');
				$args = array( 'posts_per_page' => $pcount );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); 
			?>

				<div class="col-md-12 home-post">
					<div class="row">
						<div class="col-md-6 home-post-title">
							<h2> <a href="<?php the_permalink();?>"> <?php the_title(); ?> </a></h2>
							<div class="home-post-meta">
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
						</div>
						<div class="col-md-6 home-post-content">

							<?php 
							$thumb = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
							$image = aq_resize( $img_url, 960, 460, true,true,true ); //resize & crop the image
							?>
							<?php if($image) : ?>
								<a href="<?php the_permalink();?>"> <img class="postimg" src="<?php echo $image ?>" alt="<?php the_title(); ?>" /> </a>
							<?php endif; ?>
							
							<?php the_excerpt(); ?>
							
							<a href="<?php the_permalink();?>" class="readmore"> <?php _e( 'Read more', 'fabthemes' ); ?> </a>

						</div>
					</div>
				</div>

			<?php 
				endwhile;
			    wp_reset_postdata();
			?>
	</div></div>	
</div>


<?php get_footer(); ?>
