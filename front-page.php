<?php
get_header();
?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post();?>
		
		<div class="main">
			
			<?php get_template_part('template-parts/home-content-panels'); ?>
			
		</div>
		
	<?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>