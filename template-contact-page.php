<!-- /////////////////////////////////////////////////////////////////////// -->
<?php
/*
Template Name: Contact Page
*/
get_header();
?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post();?>
<?php
// $text = get_field('contact_text');
// $img_id = get_field('contact_image');
// $title = get_field('contact_map_title');
// $iframe = get_field('contact_map');



$pID = get_the_ID();
if ( function_exists( 'get_fields' )  ) {
	$fields        = get_fields( $pID );
}
$text = ( isset( $fields['contact_text'] ) && '' !== $fields['contact_text'] ) ? $fields['contact_text'] : null;
$img_id = ( isset( $fields['contact_image'] ) && '' !== $fields['contact_image'] ) ? $fields['contact_image'] : null;
$title = ( isset( $fields['contact_map_title'] ) && '' !== $fields['contact_map_title'] ) ? $fields['contact_map_title'] : null;
$iframe = ( isset( $fields['contact_map'] ) && '' !== $fields['contact_map'] ) ? $fields['contact_map'] : null;
 ?>
<div class="main">
  <section class="panel-layout">
    <div class="panel-content">
      <div class="ti-panel-contents ti-panel-contents-text-left">
        <div class="ti-panel-image-block">
          <div class="ti-panel-image-items">
            <?php
              if ($img_id) {
                  ?>
            <div class="ti-panel-image-item">
              <?php
               $img = wp_get_attachment_image($img_id, 'medium', false, array('class'=>'ti-panel-img'));
               echo $img; ?>
            </div>
            <?php
                        }
                        ?>
          </div>
        </div>
        <div class="ti-panel-text-block">
          <?php echo do_shortcode(wpautop($text)); ?>
        </div>
      </div>
    </div>
  </section>
  <section class="panel-layout panel-contact-map">
    <div class="panel-content">
      <h3> <?php echo $title ?> </h3>
      <?php echo do_shortcode(wpautop($iframe)); ?>
    </div>
  </section>
  <section class="panel-layout panel-style-Background2 ">
    <h3>
      <?php
    //   $form_title = get_field('contact_form_title');
	   $form_title = ( isset( $fields['contact_form_title'] ) && '' !== $fields['contact_form_title'] ) ? $fields['contact_form_title'] : null;
      if ($form_title) {
          echo html_entity_decode($form_title);
      }
      ?>
    </h3>
    <div class="panel-contact-form form-cols">
      <?php
        // $form_shortcode = get_field('contact_form_shortcode');
		$form_shortcode = ( isset( $fields['contact_form_shortcode'] ) && '' !== $fields['contact_form_shortcode'] ) ? $fields['contact_form_shortcode'] : null;
        if ($form_shortcode) {
            echo do_shortcode($form_shortcode);
        }
      ?>
    </div>
  </section>

  <?php get_template_part('template-parts/content-panels'); ?>

</div>



<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
