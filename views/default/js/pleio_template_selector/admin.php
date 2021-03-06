<?php
?>
//<script>
elgg.provide("elgg.pleio_template_selector");

elgg.pleio_template_selector.init = function() {
	$colorpickers = $('.pleio-template-selector-colorpicker');
	if ($colorpickers.length > 0) {
		$colorpickers.ColorPicker({
			onSubmit: function(hsb, hex, rgb, el){
				$(el).val(hex.toUpperCase());
				$(el).css("background-color", "#" + hex);
				$(el).ColorPickerHide();
				$('#pleio_template_selector_admin_colorset_options [name="params[colorset]"][value="custom"]').attr("checked", "checked");
			},
			onBeforeShow: function(){
				var val = $(this).val();
				$(this).ColorPickerSetColor(val);
			}
		}).bind('keyup', function(){
			$(this).ColorPickerSetColor($(this).val());
			$('#pleio_template_selector_admin_colorset_options [name="params[colorset]"][value="custom"]').attr("checked", "checked");
		});
	}
	
	$('#pleio_template_selector_admin_colorset_options [name="params[colorset]"]').live("click", elgg.pleio_template_selector.switch_colorset);
}

elgg.pleio_template_selector.switch_colorset = function (){
	var selected_colorset = $(this).val();
	if (pleio_colors[selected_colorset]) {
		for (i = 1; i < 6; i++) {
			var colorset_color_index = "custom_color_" + i;
			if (colorset_color = pleio_colors[selected_colorset][colorset_color_index]) {
				$("#pleio-template-selector-colorset-wrapper [name='custom_color[" + i + "]']").val(colorset_color).css("background-color", "#" + colorset_color);
			}
		}
	}
}

elgg.pleio_template_selector.sitelogo_change = function(elm) {
	var value = $(elm).val();
	
	$preview = $('#pleio-template-selector-admin-logo-preview');
	$custom_wrapper = $('#pleio-template-selector-admin-logo-custom-wrapper');

	switch(value){
		case "none":
			$preview.hide();
			$custom_wrapper.hide();
			break;
		case "custom":
			$preview.show();
			$custom_wrapper.show();

			$preview.find('img').attr("src", elgg.get_site_url() + "template_selector/custom_sitelogo/logo.png");
			break;
		default:
			$preview.show();
			$custom_wrapper.hide();

			$preview.find('img').attr("src", elgg.get_site_url() + "mod/pleio_template_selector/_graphics/sitelogos/" + value + ".png");
			break;
	}
}

elgg.pleio_template_selector.sitelogo_change_align = function(elm) {
	switch($(elm).val()){
		case "custom":
			$('#pleio-template-selector-admin-logo-align-custom').show();
			break;
		default:
			$('#pleio-template-selector-admin-logo-align-custom').hide();
			break;
	}
}

elgg.register_hook_handler('init', 'system', elgg.pleio_template_selector.init);
