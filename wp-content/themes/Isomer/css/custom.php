<?php
	header("Content-type: text/css;");
	
	if( file_exists('../../../../wp-load.php') ) :
		include '../../../../wp-load.php';
	else:
		include '../../../../../wp-load.php';
	endif;
?>

<?php
	// Styles	
	$primary 	= ft_of_get_option('fabthemes_primary_color','#769A38');
	$secondary	= ft_of_get_option('fabthemes_secondary_color','');
	$link 		= ft_of_get_option('fabthemes_link_color','');
	$hover 		= ft_of_get_option('fabthemes_hover_color','');
	
?>
#masthead,
.site-footer,
.blog-home .home-post .home-post-content .readmore,
.hentry .entry-content a.readmore,
#comments #respond p.form-submit input,
#secondary .widget_tag_cloud a
{
	background: <?php echo $primary ?>!important;
}


#comments #respond p.form-submit input
{
	border-color:<?php echo $primary ?>!important;
}

#footer-widgets,
.welcome-box,
.portfolio-home,
.title-header,
.hentry .entry-footer,
#secondary .widget,
.portfolio-meta
{
	background: <?php echo $secondary ?>;
}



/* Links */

a, .hentry .entry-header .entry-meta span {
	color: <?php echo $link ?>;
}

a:visited {
	color: <?php echo $link ?>;
}

a:hover,
a:focus,
a:active {
	color:<?php echo $hover ?>;
	text-decoration: none;
}


