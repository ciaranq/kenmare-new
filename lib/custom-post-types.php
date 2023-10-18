<?php
$custom_post_types_includes = array(
  'lib/custom-post-types/crosslink.php',
);

foreach ($custom_post_types_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'nw'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

