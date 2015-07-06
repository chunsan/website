<?php

register_nav_menu( 'primary', __( '导航菜单', 'Always' ) );
add_theme_support( 'post-formats', array('image') );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 700, 525, true );

if (is_admin() ){
	get_template_part( 'functions/function-setting' );
}else{
	get_template_part( 'functions/function-meta' );
	get_template_part( 'functions/function-ajax' );
}
function Always_wp_title( $title, $sep ) {
	global $paged, $page;
	
	if ( is_feed() )
		return $title;
	
	//Add the site name.
	$title .= get_bloginfo( 'name' );
	
	//Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
		
	//Add a page number of necessary.
	if ( $paged >=2 || $page >=2 )
		$title = "$title $sep" . sprintf( __( 'Page %s', 'Readd' ), max( $paged, $page ) );
	
	return $title;
}
add_filter( 'wp_title', 'Always_wp_title', 10, 2 );

function Always_scripts_styles() {
	wp_enqueue_style( 'Always-style', get_template_directory_uri() . '/style.css', array(), '1.4', 'screen' );
	wp_enqueue_script( 'jquery1.10.2', get_template_directory_uri() . '/js/jquery-1.10.2.min.js', array(), '1.10.2', true);
	wp_enqueue_script( 'jplayer' , get_template_directory_uri() . '/js/jquery.jplayer.min.js', array(), '2.5.0', true);
	wp_enqueue_script( 'mousewheel' , get_template_directory_uri() . '/js/jquery.mousewheel.js', array(), '3.1.11', true);
	wp_enqueue_script( 'responsive' , get_template_directory_uri() . '/js/responsive.js', array(), '1.1', true);
	wp_enqueue_script( 'comment', get_template_directory_uri(). '/js/comment.js', array(), '1.2', true);
	wp_enqueue_script( 'audio-player', get_template_directory_uri(). '/js/audio_player.js', array(), '1.1', true);
	wp_enqueue_script( 'site-bg' , get_template_directory_uri() . '/js/bg.js', array(), '1.3', true);
	wp_enqueue_script( 'gallery' , get_template_directory_uri() . '/js/gallery.js', array(), '1.0', true);
	wp_enqueue_script( 'Always-script' , get_template_directory_uri() . '/js/index.js', array(), '1.4', true);
	wp_enqueue_script( 'site-ajax' , get_template_directory_uri() . '/js/site-ajax.js', array(), '1.4', true);
	
	$ajaxurl = home_url("/");
	$title = get_bloginfo('name');
	if ( wp_is_mobile() ){
		wp_localize_script( 'Always-script', 'Always' ,array("is_mobile" => 1,"ajaxurl" => $ajaxurl,"ajax_site_title" => $title));
	}else{
		wp_localize_script( 'Always-script', 'Always' ,array("is_mobile" => 0,"ajaxurl" => $ajaxurl,"ajax_site_title" => $title));
	}
}
add_action( 'wp_enqueue_scripts', 'Always_scripts_styles' );

function D_thumbnail($width=44, $height=44, $echo=1){
	global $post;
	$title = $post->post_title;
	$dir = get_bloginfo('template_directory');
	$post_img = '';
	if( has_post_thumbnail() ){
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$src = $timthumb_src[0];
		$post_img_src = "$dir/timthumb.php&#63;src=$src&#38;w=$width&#38;h=$height&#38;zc=1&#38;q=100";
	}else{
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$post->post_content,$matches ,PREG_SET_ORDER);
		$cnt = count( $matches );
		if($cnt>0){
			$src = $matches[0][1];
		}else{ // thumb
			$options = get_option('Always_options');
			if ( $options['thumb'] ){
				$src = $options['thumb'];
			}else{
				$src = "{$dir}/images/thumb.jpg";
			}
		}
		$post_img_src = "$dir/timthumb.php&#63;src=$src&#38;w=$width&#38;h=$height&#38;zc=1&#38;q=100";
	}
	$post_img ="<img src='$post_img_src' alt='$title' width='$width' height='$height' />";
	if($echo==1){
		echo $post_img;
	}else{
		return $post_img;
	}
}

//mp3 player
function mp3link($atts, $content=null){
	extract(shortcode_atts(array("auto"=>'0',"replay"=>'0',),$atts));
	return '
	<div id="jp_container" class="jp-audio">
		<span rel="' .$content. '" class="play-switch play"  title="play"></span>
		<span class="play-switch stop"  title="stop"></span>
		<span rel=" '.$auto.' "class="auto" ></span>
		<div class="length-bar">
			<div class="seek-bar">
				<div class="play-bar"></div>
			</div>
		</div>
		<span class="current-time">00:00</span>
	</div>';
}
add_shortcode('mp3','mp3link');

//文章分页
function pagenavi($range = 6){
	global $paged, $wp_query;
	//宽度不够时显示不显示数字分页
	if ( $wp_query -> max_num_pages < 2 ) return;
	
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){
		if(!$paged){$paged = 1;}
		echo '<nav id="wide-page-navi" class="page-navi">';
		//if($paged > 1) { echo "<a href='" . get_pagenum_link(1) . "'title='跳转到首页' class='first'><</a>"; }
		if($max_page > $range){
			if($paged <= $range){
				for($i = 1; $i <= ($range + 1); $i++){
					if($i==$paged) echo "<span class='current'>".$i."</span>";
					else echo"<a href='" . get_pagenum_link($i) ."'title='page" .$i."'>".$i."</a>";
				}
				echo "…<a href='" . get_pagenum_link($max_page) . "'title='最后一页' class='last'>".$max_page."</a>";
			}
			elseif($paged > $range && $paged < ($max_page - $range)){
				echo "<a href='" . get_pagenum_link(1) . "'title='首页' class='first'>1</a>…";
				for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
					if($i==$paged) echo "<span class='current'>".$i."</span>";
					else echo"<a href='" . get_pagenum_link($i) ."'title='page" .$i."'>".$i."</a>";
				}
				echo "…<a href='" . get_pagenum_link($max_page) . "'title='最后一页' class='last'>".$max_page."</a>";
			}
			elseif($paged >= ($max_page - $range)){
				echo "<a href='" . get_pagenum_link(1) . "'title='跳转到首页' class='first'>1</a>…";
				for($i = $max_page - $range-1; $i <= $max_page; $i++){
					if($i==$paged) echo "<span class='current'>".$i."</span>";
					else echo"<a href='" . get_pagenum_link($i) ."'title='page" .$i."'>".$i."</a>";
				}
			}
		}
		else{
			for($i = 1; $i <= $max_page; $i++){
				if($i==$paged) echo "<span class='current'>".$i."</span>";
				else echo"<a href='" . get_pagenum_link($i) ."'title='page" .$i."'>".$i."</a>";
			}
		}
		echo "</nav>";
	}
	
	?>
	<nav id="narrow-page-navi" class="page-navi">
		
		<?php if ( get_previous_posts_link() ): ?>
			<div class="nav-previous"><?php previous_posts_link('上一页'); ?></div>
		<?php endif; ?>
		
		<?php if ( get_next_posts_link() ): ?>
			<div class="nav-next"><?php next_posts_link('下一页'); ?></div>
		<?php endif; ?>
		
	</nav>
	<?php
}

//评论列表
function commentlist( $comment, $args, $depth){
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="author"><?php echo get_avatar($comment,'38'); ?></div>
			<span class="time"><?php echo time_ago(); ?></span>
			<div class="commlist-middle">
				<span class="name"><?php echo get_comment_author_link(); ?></span>
				<div class="reply"><?php comment_reply_link(array_merge( $args, array( 'reply_text' => '回复', 'depth' =>$depth, 'max_depth' =>$args['max_depth'] ) ) ); ?></div>
				<div class="text">
					<?php
						if ($comment->comment_parent):
							$parent_id = $comment->comment_parent;
							$comment_parent = get_comment($parent_id);
					?>
						<span class="comment-to"><span>@<?php echo $comment_parent->comment_author; ?></span></span>
						<?php echo get_comment_text(); ?>
					<?php else: comment_text(); ?>
					<?php endif; ?>
				</div>
			</div>
			
			
			<?php if ( $comment->comment_approved == '0'): ?>
				<em><span class="moderation"><?php _e('Your comment is avaiting moderation.'); ?></span></em>
			<?php endif; ?>
		</div>
<?php
}

//评论时间
function time_ago( $type = 'commennt', $day = 30 ) {
	$d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
	$timediff = time() - $d('U');
	if ($timediff <= 60*60*24*$day){
		echo  human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前';
	}
	if ($timediff > 60*60*24*$day){
		echo  date('Y/m/d',get_comment_date('U'));
	};
}

//邮件回复
function comment_mail_notify($comment_id) {
	$admin_notify = '1';
	$admin_email = get_bloginfo ('admin_email');
	$comment = get_comment($comment_id);
	$comment_author_email = trim($comment->comment_author_email);
	$parent_id = $comment->comment_parent ? $comment->comment_parent : '';
	global $wpdb;
	if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
		$wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
	if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
		$wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
	$notify = $parent_id ? '1' : '0';
	$spam_confirmed = $comment->comment_approved;
	if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
		$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
		$to = trim(get_comment($parent_id)->comment_author_email);
		$subject = '你在' . get_option("blogname") . '的留言有了回复';
		$message = '
		<div id="mailtou" style="width:39em;max-width:90%;height:auto;margin-top:10px;margin-bottom:48px;margin-left:auto;margin-right:auto;padding:40px;border:1px solid #ededed;font-size:13px;line-height:14px;">
			<p class="mail_title" style="font-size:15px;color:#df846c;margin-bottom:30px;">你在&#8968; '. get_the_title($comment->comment_post_ID) .' &#8971;留言：</p>
			<p style="border:1px solid #EEE;overflow:auto;padding:10px;margin:1em 0;"><span style="color:#df846c;">'. trim(get_comment($parent_id)->comment_author) .'</span>:'. trim(get_comment($parent_id)->comment_content) .'</p>
			<p style="border:1px solid #EEE;overflow:auto;padding:10px;margin:1em 0 1em 60px;"><span style="color:#df846c;">'. trim($comment->comment_author) .'</span>:'. trim($comment->comment_content) .'</p>
			<p style="margin-bottom:10px">点击<a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" style="color:#df846c;text-decoration:none;outline:none;">查看完整内容</a></p>
			<p style="margin-bottom:10px">(此邮件由系统发出,无需回复.)</p>
		</div>';
		$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
		$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
		wp_mail( $to, $subject, $message, $headers );
	}
}
add_action('comment_post', 'comment_mail_notify');

//评论作者新标签打开
function hu_popuplinks($text) {
	$text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank'>", $text);
	return $text;
}
add_filter('get_comment_author_link', 'hu_popuplinks', 6);

//最新评论
function recent_comments($limit_number=5){
	$limit = $limit_number;
	$my_email = get_bloginfo( 'admin_email' );
	$rc_comms = get_comments( array('status' => 'approve') );
	$output = '';
	$output = '<ul>';
	foreach ($rc_comms as $rc_comm){
		$id = $rc_comm -> comment_ID;
		$name = $rc_comm ->comment_author;
		$email = $rc_comm -> comment_author_email;
		$content = $rc_comm -> comment_content;
		$date = $rc_comm -> comment_date;
		$post = $rc_comm -> post_title;
		$avatar = get_avatar($email,$size='32');
		if( $email != $my_email ){
			$output .='
				<li>
					<span class="recent-comments-avatar">' .$avatar. '</span>
					<a href="' .esc_url( get_comment_link($id) ). '" title="' .$name. '在' .$post. '发表的评论">' .mb_strimwidth(strip_tags(apply_filters( 'the_coment', $content )),0,30,''). '</a>
				</li>
			';
			$limit -= 1;
		}
		if ( $limit <= 0 ) break;
	}
	$output .= '</ul>';
	echo $output;
}

//热门标签
function popular_tags(){
	echo '<ul>' .wp_tag_cloud( array('unit' => 'px', 'smallest' => 12, 'largest' => 12, 'number' => 20, 'format' => 'list', 'orderby' => 'count', 'order' => 'DESC') ). '</ul>';
}

/*
 *
 *缓存版读者墙
 *
 */
function the_readerwall($limit_number=16){
	//if( $mostactive = get_option( 'mostactive' ) ){
	//	echo $mostactive;
	//}else{
		$comments = get_comments( array('status' => 'approve') );//获取评论
		$my_email = get_bloginfo( 'admin_email' );
		$mostactive = array();
		$tmp = array();
		$comment_date = array();
		
		foreach( $comments as $comment ){//计算每个人评论数
			$id = $comment -> comment_ID;
			$author = $comment -> comment_author;
			$email = $comment -> comment_author_email;
			$url = $comment -> comment_author_url;
			$date = $comment -> comment_date;
			$content = $comment -> comment_content;
			$comment_year = explode("-" ,$date);
			//if ( $comment_year[0] < date("Y") ){//今年的评论
			//	break;
			//}
			if( $email != $my_email ){
				$i = -1;
				$index = -1;
				foreach( $mostactive as $item => $comm ){
					if( $email == $comm["email"] ){
						$index = $item;
						break;
					}
				}
				if( $index > -1 ){
					$mostactive[$index]["number"] += 1;
				}else{
					array_push($mostactive,array( "recent_id" => $id, "author" => $author, "email" => $email, "url" => $url, "date" => $date, "number" => 1 ,"content" => $content ));
				}
			}
		}
		
		//数组按评论数逆序排序
		foreach( $mostactive as $item => $comm){
			$tmp[$item] = $comm['number'];
			$comment_date[$item] = $comm['date'];
		}
		array_multisort( $tmp, SORT_DESC, $comment_date, SORT_ASC, $mostactive );//评论数相同时按照最后评论时间升序排序
		
		if( empty($mostactive) ){
			$output = '<ul><li>none data.</li></ul>';
		}else{
			$output = '<ul>';
			foreach( $mostactive as $item => $comm){
				$avatar = get_avatar($comm["email"], 46);
				$author = $comm["author"];
				$url = $comm["url"];
				$number = $comm["number"];
				$recent_id = $comm["recent_id"];
				$content = $comm["content"];
				$time = $comm["date"];
				$output.='<li>' . '<a href="'. $url . '" target="_blank" >' . $avatar .'</a><span class="author" style="display:none"></span>
							<div class="detail">
								<a href="'. $url . '" target="_blank" class="author">' .$avatar.$author. '</a>
								<span class="count">总评论数：'. $number .'</span>
								<a href="'. esc_url( get_comment_link($recent_id) ) . '" class="recent-comment">最后留言：'. mb_strimwidth(strip_tags(apply_filters( 'the_coment', $content )),0,50,'') . '</a>
								<span>（这家伙已经"' .human_time_diff( mysql2date('U', $time, 'true'), current_time('timestamp') ) . '"没有留言了！）</span>
								<div class="triangle"><div></div></div>
							</div>
						</li>';
				$limit_number--;
				if ( $limit_number <= 0 ){
					break;
				}
			}
			$output .= '</ul>';
		}
		echo $output;
	//	update_option('mostactive', $output);
	//}
}
//function clear_mostactive(){
//	delete_option('mostactive');
//}
//add_action('comment_post', 'clear_mostactive');
//add_action('edit_comment', 'clear_mostactive');



//文章归档
function the_archives(){
	$the_query = new WP_Query( array( 'posts_per_page' => -1, 'ignore_sticky_posts ' => 1) );
	$year = 0;
	$month = 0;
	$day = 0;
	$date = array();
	echo '<div id="archives">';
	//The Loop
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$year_temp = get_the_time('Y');
			$month_temp = get_the_time('n');
			if ( $month != $month_temp && $month > 0 ) echo '</ul></div>';
			if ( $year != $year_temp ) {
				$year = $year_temp;
				$date[$year] =array();
			}
			if ( $month != $month_temp) {
				$month = $month_temp;
				array_push( $date[$year], $month );
				echo '<div class="archive-content" id="archive-'.$year.'-'.$month.'"><h3 class="archive-month">' .get_the_time('Y年 m月'). '</h3><ul>';
			}
			echo '<li><span>' .get_the_time("d日"). '</span><a href="' .get_permalink(). '" >' .get_the_title(). '</a><span class="msg">&#40;' ;if(function_exists('the_views')){the_views();} echo'&#41;</span></li>';
		}
	}else{
		echo '<div>none data.</div>';
	}
	wp_reset_postdata();
	echo '</ul></div></div>';
	
	//echo date-nav
	$output = '<div id="archive-nav"><div  class="archive-nav"><span>Map</span><ul>';
	$year_now = date("Y");
	foreach( $date as $key => $value ){
		$output .='<li class="one-year" id="'.$key.'"><ul><li class="year" id="year-'.$key.'">' .$key. '年</li>';
		foreach( $value as $item => $m ){
			$output .='<li class="month" id="m-'.$key.'-'.$m.'">' .$m. '月</li>';
		}
		$output .='</ul></li>';
	}
	$output .= '</ul></div></div>';
	
	echo $output; 
}

//调用https头像
function get_ssl_avatar($avatar) {
	$avatar = preg_replace('/http:\/\/\d\.gravatar\.com/','https://secure.gravatar.com',$avatar);
	return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');










?>