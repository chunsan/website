<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package fabthemes
 */

get_header(); ?>

<header class="title-header">
	<div class="container"><div class="row"> 
		<div class="col-md-12"> 
		<h1> <?php _e( 'Oops! That page can&rsquo;t be found.', 'fabthemes' ); ?> </h1>
		</div>
	</div></div>
</header><!-- .entry-header -->

<div class="container"> <div class="row"> 
	<div class="col-md-12">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'fabthemes' ); ?></p>
				
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
	</div>
</div></div>
<?php get_footer(); ?>
