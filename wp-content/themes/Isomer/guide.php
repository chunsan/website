<?php
function theme_guide(){
add_theme_page( 'Theme guide','Theme documentation','edit_themes', 'theme-documentation', 'fabthemes_theme_guide');
}
add_action('admin_menu', 'theme_guide');

function fabthemes_theme_guide(){ ?>

		
<div id="welcome-panel" class="about-wrap">
<div class="container">

<div class="row">

	<div class="col3 col">
		<img src="<?php echo get_template_directory_uri() ?>/screenshot.png" />
	</div>
	<div class="col34 col">
		<h2>Welcome to <?php echo wp_get_theme(); ?> WordPress theme!</h2>
		<p> <?php echo wp_get_theme(); ?> is a free premium responsive WordPress theme from fabthemes.com. This theme is built 
			on <b>Bootstrap 3</b> framework. This is an Agency / portfolio type of theme , that is ideal for creative professionals to showcase their work along with a blog.
			The theme supports, custom posts types, custom taxonomy, custom homepage, theme options etc.  </p>
	</div>

</div>

<div class="row">

	<div class="col col1">
		<h3>Required Plugins</h3>
		<p> The theme requires the following plugin to work as advertised.  
			You will find a notification on the admin panel prompting you to install the required plugins. 
			Please install and activate the plugins.  
		</p>
		<ol>
			<li><b> <a href="https://wordpress.org/plugins/meta-box/"> Metabox </a> </b>  - This plugin is required for the metaboxes for the portfolio entries.</li>
		</ol>
	</div>

</div>	

<div class="row">

	<div class="col col1">
		<h3>Theme setup</h3>

		<h4>1. Installing theme</h4>
		<p> Download the theme zip file from Fabthemes.com. Open your WordPress admin panel and go to <b> Appearence > Themes</b> . Click <b> Add new </b> and then <b> Upload the theme </b> to your themes directory and activate it.  </p>

		<h4>2. Install plugins</h4>
		<p> After theme activation, you will find a notification that prompts you to install and activate the required plugin listed earlier. Please install and activate them.</p>

		<h4>3. Setting up Homepage </h4>
		<p> After theme activation, go to the Pages and create a new page named "Home". In the page attribute section you can find a dropdown box for page templates. Select the "Home" template from the dropdown list. Leave the page content section empty and publish the page. </p>
		<p> Go to settings > Reading > Front page displays. Select the "static page" option and for front page select "Home" from the dropdown page list.</p>

		<h4>4. Setting up Blog page </h4>
		<p> Create a new page called Blog. Go to settings > Reading > Front page displays. Select "Blog" page front the dropdown list for posts page. </p>

		<h4>5. Create portfolio items </h4>
		<p> Click on portfolios on the admin panel and select add new item. 
		<ol>
		 	<li>Give your portfolio project a title</li>
		 	<li>Enter the portfolio description in the content area.</li>
		 	<li>Set the appropriate custom taxonomies.( Client, Genre )</li>
		 	<li>Set a featured image.</li>
		 	<li>For image project use the image metabox to insert images to the portfolio slideshow.</li>
		 	<li>For video project insert the embed code in the video metabox. </li>
		 	<li>Insert the project url in the url metabox.</li>
		 </ol> </p>

		<h4>6. Create Portfolio page</h4>
		<p>Portfolio page is the index of your portfolio items. This is a paginated grid gallery of your portfolio items. For this you need to create a page called "portfolio" and publish it. Leave the content area of this page empty. Then you can add this page item
			to your menu. This way you can access the Portfolio page.</p>

		<h4>7. Import sample data</h4>
		<p> Sample xml data is available for the theme. You can use it to test run the theme before you post your actual data. </p>

		<h4>8. Saving theme options</h4>
		<p> The theme comes with an options page. You can save the options page with its default values to see how the content is laid out. Then you can customize the options as required for your site.</p>

	</div>

</div>


<div class="row">

	<div class="col col1"> 
		<h3>Theme Options </h3>
		<p> Theme comes with an options panel to customize its settings. </p>
	 </div>
	 <div class="col col1">
	 	<h4> 1. Intro section</h4>
	 	<p> This is the intro section on the homepage below the header. You have the option to enter a custom text here. </p>
	 	
	 </div>
	 <div class="col col1">
	 	<h4> 2. Portfolio items </h4>
	 	<p> There is a portfolio grid section on the homepage. This will showcase a selected number of your portfolio items in a filterbale 4 column  grid. You can select
	 		the number of items to show in this section.</p>
	 </div>

	 <div class="col col1">
	 	<h4> 3. Recent posts </h4>
	 	<p> Select the number of posts to show on the homepage.</p>
	 </div>

	 <div class="col col1">
	 	<h4> 5. Custom styling</h4>
	 	<p> Use this options to color customize your theme.</p>
	 </div>

	 <div class="col col1">
	 	<h4> 6. Banner settings </h4>
	 	<p> Use this options to customize the banner ads on the sidebar.</p>
	 </div>

</div>

<div class="row">
	<div class="col col1">
			<?php echo file_get_contents(dirname(__FILE__) . '/FT/license-html.php'); ?>
	</div>
</div>


</div>
</div>



<style media="screen" type="text/css">

	.container{	width: 960px;}
	.row { background: #fff;  margin-bottom: 20px; padding: 20px 0px;}
	.row:before, .row:after {  display: table;  content: " ";}
	.row:after {  clear: both;	}
	.row:before, .row:after {  display: table;  content: " ";}
	.row:after { clear: both; }
	.col{ padding:0px 20px 0px 20px;  position:relative; 	 }
	.col1{ width: 920px;}
	.col2{ width: 440px; float: left;}
	.col3{ width: 280px; float: left;}
	.col34{ width: 600px; float: left;}
	.col h2{ font-weight: 700; font-size: 30px;}
	.col h3{ font-weight: 300; font-size: 24px; margin:0px 0px 20px 0px; background: #333; color:#fff; padding: 10px; }
	.col h4{ font-weight: bold; font-size: 16px; margin:10px 0px;}
	.clear{clear: both;}
	.red{color: red;}
</style>	

<?php }
