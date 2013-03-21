<?php 
// custom header height
$layout_header_height = elgg_get_plugin_setting("layout_header_height", "pleio_template_selector");
if(!empty($layout_header_height)){
	?>
.elgg-page-default .elgg-page-header > .elgg-inner {
	height: <?php echo $layout_header_height; ?>px;
}
	<?php 
}
	
$show_logo_footer = elgg_get_plugin_setting("show_logo_footer", "pleio_template_selector");
	
if($show_logo_footer == "no"){
	
	?>
.elgg-page-theme-footer {
	height: 10px;
}
	<?php 
}
// Custom Css
echo elgg_get_plugin_setting("custom_css", "pleio_template_selector");
	