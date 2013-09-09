<?php
?>
//<script>
	$(document).ready(function(){
		$('#pleio_template_selector_admin_settings_form input[name="params[colorset]"]').change(function(){
			var value = $(this).val();
			
			if(value != "custom"){
				$('#pleio_template_selector_admin_colorset_colorpicker').hide();
			} else {
				$('#pleio_template_selector_admin_colorset_colorpicker').show();
			}
		});
	
		$('#custom_color_1, #custom_color_2, #custom_color_3, #custom_color_4, #custom_color_5').ColorPicker({
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
	});
	
	function pleio_template_selector_change_sitelogo(elm){
		var value = $(elm).val();
	
		switch(value){
			case "none":
				$('#pleio_template_selector_admin_logo_preview').hide();
				$('#pleio_template_selector_admin_logo_custom_wrapper').hide();
				break;
			case "custom":
				$('#pleio_template_selector_admin_logo_preview').show();
				$('#pleio_template_selector_admin_logo_custom_wrapper').show();
	
				$('#pleio_template_selector_admin_logo_preview img:first').attr("src", elgg.get_site_url() + "template_selector/custom_sitelogo/logo.png");
				break;
			default:
				$('#pleio_template_selector_admin_logo_preview').show();
				$('#pleio_template_selector_admin_logo_custom_wrapper').hide();
	
				$('#pleio_template_selector_admin_logo_preview img:first').attr("src", elgg.get_site_url() + "mod/pleio_template_selector/_graphics/sitelogos/" + value + ".png");
				break;
		}
	}
	
	function pleio_template_selector_change_sitelogo_align(elm){
		var value = $(elm).val();
	
		switch(value){
			case "custom":
				$('#pleio_template_selector_admin_logo_align_custom').show();
				break;
			default:
				$('#pleio_template_selector_admin_logo_align_custom').hide();
				break;
		}
	}
