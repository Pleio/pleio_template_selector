<?php
/**
 * Displays the default shortcut icon
 */

$lastcache = elgg_get_config("lastcache");
?>
<link rel="SHORTCUT ICON" href="<?php echo elgg_get_site_url(); ?>template_selector/favicon?lc=<?php echo $lastcache; ?>" />