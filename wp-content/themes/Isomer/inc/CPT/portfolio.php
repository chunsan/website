<?php

// Register Custom Post type

$portfolio = new CPT('portfolio', array(
    'supports' => array('title','editor','thumbnail','comments'),
     'has_archive'         => true,
     'publicly_queryable'  => true,
     'capability_type'     => 'post'
));

// Register Taxonomy

$portfolio->register_taxonomy(array(
    'taxonomy_name' => 'genre',
    'singular' => 'Genre',
    'plural' => 'Genres',
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'genre' ),
));

$portfolio->register_taxonomy(array(
    'taxonomy_name' => 'client',
    'singular' => 'Client',
    'plural' => 'Clients',
     'query_var'         => true,
    'rewrite'           => array( 'slug' => 'clients' ),
));

// define the columns to appear on the admin edit screen

$portfolio->columns(array(
    'cb' => '<input type="checkbox" />',
    'icon' => __('Icon'),
    'title' => __('Title'),
    'genre' => __('Genres'),
    'client' => __('Client'),
    'date' => __('Date')
));

// Set post type Dashicon

$portfolio->menu_icon("dashicons-images-alt2");

// Get portfolio items

function get_portfolio_items($count){
	global $post;
	 $args = array(
        'posts_per_page' => $count,  // Limit to 5 posts
        'post_type' => 'portfolio',  // Query for the default Post type
    );

	$loop = new WP_Query( $args );
	echo "<ul class='portfolio-list'>";
	while ( $loop->have_posts() ) : $loop->the_post(); ?>

	<li class="portfolio-item">
		<figure class="portfolio-thumb"> 
			   <?php echo get_the_post_thumbnail( $post->ID, 'full' );  ?> 
		</figure>
  	  	<h2>  <?php the_title(); ?> </h2>
  	  	<span> <?php echo get_the_term_list( $post->ID, 'genre', 'Genre: ', ', ', '' ) ?> </span>
  	  	<span> <?php echo get_the_term_list( $post->ID, 'client','Client: ', ', ', '' ) ?></span>
	</li>

    <?php endwhile;
    echo "</ul>";
    wp_reset_postdata();
}


// Portfolio Shortcode

function portfolio_shortcode( $atts ) {
	$count = 3 ;
	if( function_exists( 'get_portfolio_items' ) ) {
			// Attributes
			extract( shortcode_atts(
				array(
					'count' => $count,
				), $atts )
			);

		    if( $count != NULL ) {
		    return get_portfolio_items($count);
			}
		}
	}
add_shortcode( 'portfolio', 'portfolio_shortcode' );