<?php
/**
 * Elgg header logo
 */

$site = elgg_get_site_entity();
$site_name = $site->name;
$site_url = elgg_get_site_url();

if (elgg_get_plugin_setting("show_title", "pleio_template_selector") != "no") {
	?>
	<h1>
		<a class="elgg-heading-site" href="<?php echo $site_url; ?>">
			<?php echo $site_name; ?>
		</a>
	</h1>
	<?php
}

if ($logo_url = pleio_template_selector_get_site_logo()) {
	$alignment = elgg_get_plugin_setting("sitelogo_align", "pleio_template_selector");
	switch ($alignment) {
		case "left":
			$class = "elgg-heading-site-logo-left";
			break;
		case "right":
			$class = "elgg-heading-site-logo-right";
			break;
		case "custom":
			$class = "";
			$top = elgg_get_plugin_setting("sitelogo_align_top", "pleio_template_selector");
			$left = elgg_get_plugin_setting("sitelogo_align_left", "pleio_template_selector");
			break;
		default:
			$class = "elgg-heading-site-logo-center";
			break;
	}
	
	$style = "";
	if (empty($class)) {
		$style = "style='top: ". $top . "px; left: " . $left . "px;'";
	}
?>
	<div class="elgg-heading-site-logo <?php echo $class; ?>" <?php echo $style; ?>>
		<a href="<?php echo elgg_get_site_url(); ?>" title="<?php echo $vars['config']->sitename; ?>"><img src="<?php echo $logo_url;?>" alt="<?php echo $vars['config']->sitename; ?>" /></a>
	</div>
<?php
}
		