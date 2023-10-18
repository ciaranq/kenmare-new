<?php
get_header();
?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post();?>
		
		
		<div class="main">
		  

		  <section class="panel-layout">
				<div class="panel-content">

					<p><?php get_search_form(); ?></p>
					
				</div>
		  </section>
		  
			<?php get_template_part('template-parts/content-panels'); ?>
			
		</div>

		
	<?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>
