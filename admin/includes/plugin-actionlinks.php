<?php

add_filter('plugin_action_links', 'imgus_plugin_admin_action_links', 10, 2);

function imgus_plugin_admin_action_links($links, $file) {
  if ($file === imgus_BASENAME) {
    $settings_link = '<a href="admin.php?page=imageus">Settings</a>';
    array_unshift($links, $settings_link);
  }
  return $links;
}
