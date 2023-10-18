<?php
get_header();
global $this_page;

$news_page_id = get_option('page_for_posts');
$news_page_post = get_post($news_page_id);
?>

<div class="main">
		<section class="panel-layout">
			<div class="panel-content">


				<?php
				echo $news_page_post->post_content;
				?>


				<?php
				if (have_posts()){
					?>

					<div class="display-posts-listing grid">
						<?php
						while (have_posts()){
							the_post();
							?>
							<div class="listing-item">
								<a class="image" href="<?php echo get_permalink()?>">
									<?php
									$attr = array(
										'class'	=> 'wp-post-image',
									);
									$img = get_the_post_thumbnail($post, 'imgsize-medium-600x350', $attr);
									echo $img;
									?>
								</a>
								
								<a class="title" href="<?php echo get_permalink()?>">
										<?php the_title()?>
								</a>
							</div>

							<?php
						}
						?>
					</div>

					<div class="post-page-links">
						<?php
						the_posts_pagination( array(
							'prev_text' => '&laquo;',
							'next_text' => '&raquo;',
						) );
						?>
					</div>

					<?php
				} else {
					esc_html_e( 'No news items found', 'kenmare_td' ); 
				}
				?>

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

</div>



</div>

<?php get_footer(); ?>
