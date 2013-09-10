<?php
?>
//<script>
elgg.provide("elgg.pleio_template_selector");

elgg.pleio_template_selector.init = function() {
	$('.pleio-template-selector-colorpicker').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el){
			$(el).val(hex.toUpperCase());
			$(el).css("background-color", "#" + hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function(){
			var val = $(this).val();
			$(this).ColorPickerSetColor(val);
		}
	}).bind('keyup', function(){
		$(this).ColorPickerSetColor($(this).val());
	});
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
