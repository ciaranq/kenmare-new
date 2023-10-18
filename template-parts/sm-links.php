<?php
$smsites = array(
	'facebook',
	'twitter',
	'youtube',
	'instagram',
	'linkedin',
);

if ($smsites){
	?>
	<div class="sm-links">
	<?php
	foreach($smsites as $smsite) {
		$link = get_theme_mod('nw_'.$smsite.'_url');
		if (!filter_var($link, FILTER_VALIDATE_URL) === FALSE) {
			?>
			<a class="sm-link" href="<?php echo $link?>" target="_blank" rel="noopener"><?php require get_template_directory().'/assets/svg/_'.$smsite.'-svg.php';?></a>
			<?php
		}
	}
	?>
	</div>
	<?php
}
?>
