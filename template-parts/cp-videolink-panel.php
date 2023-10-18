<?php
/***
* VIDEOLINK PANEL
***/
// $imgid = get_sub_field('videolink_preview_image');
// $title = get_sub_field('videolink_overlay_title');
// $video_url = get_sub_field('videolink_video_url');
// $width = get_sub_field('video_width');

$imgid = (  '' !== get_sub_field('videolink_preview_image') ) ? get_sub_field('videolink_preview_image') : null;
$title = (  '' !== get_sub_field('videolink_overlay_title') ) ? get_sub_field('videolink_overlay_title') : null;
$video_url = (  '' !== get_sub_field('videolink_video_url') ) ? get_sub_field('videolink_video_url') : null;
$width = (  '' !== get_sub_field('video_width') ) ? get_sub_field('video_width') : null;


if ($imgid) {
    $img = wp_get_attachment_image($imgid, 'large', false, array('class'=>'lightbox-video-img'));
    if ($width == 'padding') {
        ?>

<div class="panel-layout-video  panel-style-top-bg">
  <?php
    } ?>
  <div class="lightbox-video-panel  lightbox-<?php echo $width?>">
    <?php
        if ($video_url) {
            ?>
    <a href="<?php echo $video_url?>" class="lightbox-video lightbox-panel-video">
      <?php
        } ?>

      <div class="lightbox-video-image-box">
        <?php echo $img?>
      </div>
      <?php if ($title) {
            ?>
      <div class="lightbox-video-button"><?php echo esc_html_e( 'Play Video', 'kenmare_td' ); ?></div>
      <h4 class="lightbox-video-title"><?php echo $title?></h4>
      <?php
        } ?>

      <?php
        if ($video_url) {
            ?>

    </a>
    <?php
        } ?>
  </div>
  <?php
    if ($width == 'padding') {
        ?>


</div>
<?php
    }
}
?>
