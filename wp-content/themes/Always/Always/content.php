<?php if( is_singular() ): ?>
<article id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<h1><?php the_title(); ?></h1>
	</header>
	
	<div class="entry-content">
		<p align="center">
		<?php 
			if ( has_post_thumbnail() ){
				the_post_thumbnail();
			}
		?>
		</p>
		<?php the_content( __( '','Always' ) ); ?>
	</div>
	
	<footer class="entry-footer">
		<?php if(get_the_tags()): ?>
			<div class="meta-tag">Tags:<?php the_tags('','&nbsp;,&nbsp;',''); ?></div>
		<?php endif; ?>
		<div class="meta-author">文 / <?php echo get_the_author(); ?></div>
		<div class="share">
			<ul class="share-ul">
				<li><a href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" rel="nofollow" class="twitter-share" title="Twitter"></a></li>
				<li><a href="http://facebook.com/share.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>" target="_blank" rel="nofollow" class="facebook-share" title="facebook"></a></li>
				<li><a href="http://v.t.sina.com.cn/share/share.php?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" rel="nofollow" class="sina-share" title="新浪微博"></a></li>
				<li><a href="http://v.t.qq.com/share/share.php?title=<?php the_title(); ?>&url=<?php the_permalink(); ?>&site=<?php bloginfo('url');?>" target="_blank" rel="nofollow" class="tencent-share" title="腾讯微博"></a></li>
				<li><a href="http://www.douban.com/recommend/?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" rel="nofollow" class="douban-share" title="豆瓣网"></a></li>
				<li><a href="http://fanfou.com/sharer?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>" target="_blank" rel="nofollow" class="fanfou-share" title="饭否网"></a></li>
				<li><a href="http://share.renren.com/share/buttonshare?link=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" rel="nofollow" class="renren-share" title="人人网"></a></li>
				<li><a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" rel="nofollow" class="qzone-share" title="QQ空间"></a></li>
			</ul>
			<span class="share-c">分享到</span>
		</div>
	</footer>
	<div class="clear"></div>
	
</article><!--post-->
<?php else: ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<div class="article-wrap">

		<header class="entry-header">
			<h1>
				<a href="<?php the_permalink(); ?>" rel="bookmark" class="post-title" title = "<?php the_title(); ?>">
					<?php the_title(); ?>
					<?php if (is_sticky()) {echo '[置顶]';} ?>
				</a>
				<span class="meta-time"><?php the_time('m月d日'); ?></span>
			</h1>
			
		</header>
		
		<div class="entry-content">
			<?php 
				$options = get_option('Always_options');
				if ( has_post_thumbnail() ){
						echo '<p><a href="' .get_permalink(). '" class="post-title" title="' .get_the_title(). '" rel="bookmark" >' .get_the_post_thumbnail(). '</a></p>';
						echo '<p>'.mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,155).'...</p>';
					
					}elseif ( $options['layout'] == 0 ){
					//首图摘要
					preg_match_all('/\<img.+?src="(.+?)".*?\/>/',$post->post_content,$matches ,PREG_SET_ORDER);
					
					$output = mb_strimwidth(apply_filters('the_content',$post->post_content),0,500).'...';
					preg_match_all('/\<embed.+?/',$output,$matches2 ,PREG_SET_ORDER);
					preg_match_all('/\<iframe.+?/',$output,$matches3 ,PREG_SET_ORDER);
					preg_match_all('/\<span.+?rel="(.+?)".+?title="play".*?/',apply_filters('the_content',$post->post_content),$matches4 ,PREG_SET_ORDER);
					if ( $matches4[0][1] ){
						$audio_player =  '<div id="jp_container" class="jp-audio">
											<span rel="' .$matches4[0][1]. '" class="play-switch play"  title="play"></span>
											<span class="play-switch stop"  title="stop"></span>
											<span rel="0"class="auto" ></span>
											<div class="length-bar">
												<div class="seek-bar">
													<div class="play-bar"></div>
												</div>
											</div>
											<span class="current-time">00:00</span>
										</div>';
					}
					if ( $matches[0][1] ){
						//显示图片
						echo '<p><a href="' .get_permalink(). '" class="post-title" title="' .get_the_title(). '" rel="bookmark" ><img src="' .$matches [0][1]. '" /></a></p>';
						if ( $matches4[0][1] ){ 
							echo $audio_player;
						}else{
							echo '<p>'.mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,155).'...</p>';
						}
					}elseif($matches2[0][0]){
						//显示优酷embed视频
						preg_match_all('/\<embed.+?\>/',apply_filters('the_content',$post->post_content),$matches2 ,PREG_SET_ORDER);
						echo $matches2[0][0];
					}elseif($matches3[0][0]){
						//显示优酷iframe视频
						preg_match_all('/(<(iframe)[^>]*>)(.*?)(<\/\\2>)/',apply_filters('the_content',$post->post_content),$matches3 ,PREG_SET_ORDER);
						echo $matches3[0][0];
					}else{
						if ( $options['thumb'] ){
							echo '<p><a href="' .get_permalink(). '" class="post-title" title="' .get_the_title(). '" rel="bookmark" ><img src="' .$options['thumb']. '" /></a></p>';
						}else{
							echo '<p><a href="' .get_permalink(). '" class="post-title" title="' .get_the_title(). '" rel="bookmark" ><img src="' .get_bloginfo('template_url'). '/images/thumb.jpg" /></a></p>';
						}
						if ( $matches4[0][1] ){ 
							echo $audio_player;
						}else{
							echo '<p>'.mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,155).'...</p>';
						}
					}
					
				}elseif ( $options['layout'] == 1 ){
					//缩略图摘要
					echo '<p><a href="' .get_permalink(). '" class="post-title" title="' .get_the_title(). '" rel="bookmark" >' .D_thumbnail( 546,410,0 ). '</a></p>';
					
					$output = apply_filters('the_content',$post->post_content);
					preg_match_all('/\<span.+?rel="(.+?)".+?title="play".*?/',$output,$matches4 ,PREG_SET_ORDER);
					if ( $matches4[0][1] ){
						$audio_player =  '<div id="jp_container" class="jp-audio">
											<span rel="' .$matches4[0][1]. '" class="play-switch play"  title="play"></span>
											<span class="play-switch stop"  title="stop"></span>
											<span rel="0"class="auto" ></span>
											<div class="length-bar">
												<div class="seek-bar">
													<div class="play-bar"></div>
												</div>
											</div>
											<span class="current-time">00:00</span>
										</div>';
						echo $audio_player;
					}else{
						echo '<p>'.mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,155).'...</p>';
					}
				}elseif ( $options['layout'] == 2 ){
					//more标签
					if ( has_post_thumbnail() ){
						echo '<p><a href="' .get_permalink(). '" class="post-title" title="' .get_the_title(). '" rel="bookmark" >' .get_the_post_thumbnail(). '</a></p>';
					}else{
						the_content( __( '','Always' ) );
					}
				}
			?>
		</div>
		
		
	</div>
</article><!--post-index-->
<?php endif; ?>
