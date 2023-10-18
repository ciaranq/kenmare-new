<?php
/***
* SINGLE NEWS PAGE
***/
get_header();
$news_page_id = get_option('page_for_posts');

?>
<div class="main">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post();?>
		<section class="panel-layout">
			<div class="panel-content-post-text ">
				<p class="news-single-date"><?php echo get_the_date('j F Y')?></p>
				<h3 class="news-single-title"><?php the_title();?></h3>
				<?php
                    // $intro = get_field('post_intro');
					$intro = (  '' !== get_field('post_intro') ) ? get_field('post_intro') : null;
                    if ($intro) {
                        echo $intro;
                    }
                    ?>
					</div>
				</section>
				<?php
            $img_id = get_post_thumbnail_id($post);
						if ($img_id){
							$md = wp_get_attachment_metadata($img_id);
							$width = $md['width']; //original width
							$height = $md['height']; //original height
							if (($height / $width) < 0.8) { // don't make it full width if it's very square - would be too tall on page
									$class = "news-single-img-full-width";
							} else {
									$class = "";
							}
							$attr = array(
									'class'	=> 'news-single-img '.$class ,
							);
							$img = get_the_post_thumbnail($post, 'large', $attr);
						}
            if ($img) {
               ?>
							<section class="panel-layout-post-image panel-layout">
								<div class="panel-content panel-text-content-mid">
									<?php echo $img; ?>
								</div>
							</section>
							<?php
            }
            ?>
				<section class="panel-layout-post-text">
					<div class="panel-content panel-text-content-wide">
						<?php the_content();?>
					</div>
				</section>

<?php endwhile; ?>
<?php endif; ?>
	
	<section class="panel-layout">
		<div class="panel-content">
			<a href="<?php echo get_permalink($news_page_id)?>" class="news-single-back-btn btn"><?php  echo esc_html_e( 'All Press', 'kenmare_td' ); ?></a>
		</div>
	</section>

	<?php
	//get the following as if this was the 'news landing' page
	global $post;
	$post = get_post($news_page_id, OBJECT);
	setup_postdata($post);

	get_template_part('template-parts/content-panels');
	
	wp_reset_postdata();
	?>

	<?php get_footer(); ?>
