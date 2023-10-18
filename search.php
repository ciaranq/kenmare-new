<?php get_header();?>

	<div class="main">
			
			<section class="panel-layout">
				<div class="panel-content">

					<h3><?php  echo esc_html_e( 'Search Results for:', 'kenmare_td' ); ?> <?php echo esc_attr(get_search_query()); ?></h3>
		
					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post();?>
							
							<?php
							if (get_the_title($post->post_parent) != '' && get_the_title($post->post_parent) != get_the_title()) {
								$parent_title = get_the_title($post->post_parent).' - ';
							} else {
								$parent_title = '';
							}
							?>
							
							<a class="search-result-item" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<h5><?php echo $parent_title; ?><?php the_title(); ?></h5>
								<?php
								$text = nw_truncate_string(strip_tags(strip_shortcodes(get_the_content())),200);
								echo '<p>'.$text.'</p>';
								?>
							</a>
							
						<?php endwhile; ?>
				
						
						<?php
						$prev_link = get_previous_posts_link(__('&laquo; Prev'));
						$next_link = get_next_posts_link(__('Next &raquo;'));
						
						echo $prev_link;
						if ($prev_link && $next_link) {
							echo ' / ';
						}
						echo $next_link;
						?>
					<?php else : ?>
						<p><?php  echo esc_html_e( 'Sorry, No Results. Try another search.', 'kenmare_td' ); ?></p>
					<?php endif; ?>
				
			</div>
		</section>
		
		<section class="panel-layout">
			<div class="panel-content">
				
				<p><?php get_search_form(); ?></p>
				
			</div>
		</section>
		
	</div>

<?php get_footer(); ?>
