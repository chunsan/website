		</div><!--main-->
		<?php $options = get_option('Always_options');?>
		<footer id="main-footer">
			<?php if ( $options['footer_widget'] == 0 ): ?>
				<div id="footer-widget">
					<aside id="footer-comments" class="foo-widget">
						<h3>最新评论</h3>
						<?php recent_comments(4); ?>
					</aside>
					<aside id="footer-tags" class="foo-widget">
						<h3>热门标签</h3>
						<?php popular_tags(); ?>
					</aside>
					<aside id="footer-readwall" class="foo-widget readwall">
						<h3>留言墙</h3>
						<?php the_readerwall(6); ?>
					</aside>
				</div>
			<?php elseif ( $options['footer_widget'] == 1 ): ?>
				<div id="full-footer-widget">
					<aside id="full-footer-readwall" class="readwall">
						<?php the_readerwall(60); ?>
					</aside>
				</div>
			<?php endif; ?>
			<div id="footer-copy">
				copyright &copy;&nbsp;<?php echo date( 'Y' ).'&nbsp;'.get_bloginfo( 'name' ); ?>&nbsp;&nbsp;<?php if ( $options['registration'] ){echo $options['registration']. '&nbsp;&nbsp;';} ?>theme by <a href="http://www.dearzd.com/" target="_blank">咚门</a>
			</div>
			<div class="clear"></div>
		</footer><!--footer-->
	</div>
	
	<nav id="narrow-menu">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
	</nav>
	
	<div id="loading-wrap">
		<div class="loading">
			<div class="loading-bar">
				<div class="bar1"></div>
				<div class="bar2"></div>
				<div class="bar3"></div>
				<div class="bar4"></div>
			</div>
			<div class="loading-text">loading</div>
		</div>
	</div><!--loading-->
	
	<div id="jquery_jplayer" class="jp-jplayer"></div>
	
	
	
	<?php wp_footer(); ?>
</body>
</html>