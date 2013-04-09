<?php 

	// allowed values
	$allowed_colorsets = array("navy", "mint", "magenta", "yellow", "purple", "violet", "pink", "orange", "sand", "green", "custom");
	$allowed_logos = array("none", "blank", "defensie", "rijksoverheid", "custom");

	// configured settings
	$colorset = elgg_get_plugin_setting("colorset", "pleio_template_selector");
	$logo = elgg_get_plugin_setting("sitelogo", "pleio_template_selector");
	$show_title = elgg_get_plugin_setting("show_title", "pleio_template_selector");
	$show_search = elgg_get_plugin_setting("show_search", "pleio_template_selector");
	$show_login_dropdown = elgg_get_plugin_setting("show_login_dropdown", "pleio_template_selector");
	$show_logo_footer = elgg_get_plugin_setting("show_logo_footer", "pleio_template_selector");
	$logo_align = elgg_get_plugin_setting("sitelogo_align", "pleio_template_selector");
	$logo_align_top = (int) elgg_get_plugin_setting("sitelogo_align_top", "pleio_template_selector");
	$logo_align_left = (int) elgg_get_plugin_setting("sitelogo_align_left", "pleio_template_selector");
	$header_height = (int) elgg_get_plugin_setting("layout_header_height", "pleio_template_selector");
	
	if(empty($colorset) || !is_array($allowed_colorsets)){
		$colorset = "navy";
	}
	
	// build colorset selector
	$colorset_contents = "";
	$preview_colorset = "";
	
	$yesno_options = array(
		"yes" => elgg_echo("option:yes"),
		"no" => elgg_echo("option:no")		
	);
	
	$logo_align_options = array(
		"center" => elgg_echo("pleio_template_selector:sitelogo:align:center"),
		"left" => elgg_echo("pleio_template_selector:sitelogo:align:left"),
		"right" => elgg_echo("pleio_template_selector:sitelogo:align:right"),
		"custom" => elgg_echo("pleio_template_selector:sitelogo:align:custom"),
	);
	
	foreach($allowed_colorsets as $set){
		$title_text = elgg_echo("pleio_template_selector:forms:admin:colorset:" . $set);
		$colorset_contents .= "<div title='" . $title_text . "'>";
		
		if($set == $colorset){
			$preview_colorset = $set;
			$checked = "checked='checked'";
		} else {
			$checked = "";
		}
		
		$colorset_contents .= "<input type='radio' name='params[colorset]' value='" . $set . "' " . $checked . " />\n";
		$colorset_contents .= $title_text;
		
		$colorset_contents .= "</div>";
	}
	
	if(empty($preview_colorset) || $preview_colorset == "custom"){
		$preview_colorset = $allowed_colorsets[0];
	}
	
	if($colorset == "custom"){
		$hide_colorset_preview = "style='display:none;'";
		$show_colorset_custom = "style='display:block;'";
	}
	
	// build logo selector
	$logo_options = "";
	
	foreach($allowed_logos as $alogo){
		if($alogo == $logo){
			$selected = "selected='selected'";
		} else {
			$selected = "";
		}
		
		$logo_options .= "<option value='" . $alogo . "' " . $selected . ">" . elgg_echo("pleio_template_selector:forms:admin:logo:" . $alogo) . "</option>\n";
	}
	
	if($logo == "custom"){
		$show_custom_logo = "style='display:block;'";
	}
	
	$logo_url = pleio_template_selector_get_site_logo();
	
?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo $vars["url"]; ?>mod/pleio_template_selector/vendors/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="<?php echo $vars["url"]; ?>mod/pleio_template_selector/vendors/colorpicker/js/colorpicker.js"></script>

<script type="text/javascript">
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

				$('#pleio_template_selector_admin_logo_preview img:first').attr("src", "<?php echo $vars["url"]; ?>template_selector/custom_sitelogo/logo.png");
				break;
			default:
				$('#pleio_template_selector_admin_logo_preview').show();
				$('#pleio_template_selector_admin_logo_custom_wrapper').hide();

				$('#pleio_template_selector_admin_logo_preview img:first').attr("src", "<?php echo $vars["url"]; ?>mod/pleio_template_selector/_graphics/sitelogos/" + value + ".png");
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
	
</script>

<form id="pleio_template_selector_admin_settings_form" action="<?php echo $vars["url"]; ?>action/template_selector/settings" method="post" enctype="multipart/form-data">
	<?php echo elgg_view("input/securitytoken"); ?>
	
	<div id="pleio_template_selector_admin_colorset_container" class="elgg-module elgg-module-inline">
		<div class="elgg-head">
			<h3><?php echo elgg_echo("pleio_template_selector:forms:admin:colorset:header"); ?></h3>
		</div>
		<div class="elgg-body">
			<div id="pleio_template_selector_admin_colorset_options">
				<?php echo $colorset_contents; ?>
			</div>
		
			<div id="pleio_template_selector_admin_colorset_wrapper">
				<div id="pleio_template_selector_admin_colorset_colorpicker" <?php echo $show_colorset_custom; ?>>
					<div>
						<input type="text" name="custom_color[1]" value="<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_1; ?>" id="custom_color_1" size="7" maxlength="6" style="background-color:#<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_1; ?>;" />
						<?php echo elgg_echo("pleio_template_selector:forms:admin:colorset:custom:1"); ?>
					</div>
					<div>
						<input type="text" name="custom_color[2]" value="<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_2; ?>" id="custom_color_2" size="7" maxlength="6" style="background-color:#<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_2; ?>;" />
						<?php echo elgg_echo("pleio_template_selector:forms:admin:colorset:custom:2"); ?>
					</div>
					<div>
						<input type="text" name="custom_color[3]" value="<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_3; ?>" id="custom_color_3" size="7" maxlength="6" style="background-color:#<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_3; ?>;" />
						<?php echo elgg_echo("pleio_template_selector:forms:admin:colorset:custom:3"); ?>
					</div>
					<div>
						<input type="text" name="custom_color[4]" value="<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_4; ?>" id="custom_color_4" size="7" maxlength="6" style="background-color:#<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_4; ?>;" />
						<?php echo elgg_echo("pleio_template_selector:forms:admin:colorset:custom:4"); ?>
					</div>
					<div>
						<input type="text" name="custom_color[5]" value="<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_5; ?>" id="custom_color_5" size="7" maxlength="6" style="background-color:#<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_5; ?>;" />
						<?php echo elgg_echo("pleio_template_selector:forms:admin:colorset:custom:5"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="pleio_template_selector_admin_logo_container" class="elgg-module elgg-module-inline">
		<div class="elgg-head">
			<h3><?php echo elgg_echo("pleio_template_selector:forms:admin:logo:header"); ?></h3>
		</div>
		<div class="elgg-body">
			<div id="pleio_template_selector_admin_logo_wrapper">
				<div id="pleio_template_selector_admin_logo_options">
					<select name="params[sitelogo]" onchange="pleio_template_selector_change_sitelogo(this);">
						<?php echo $logo_options; ?>
					</select>
				</div>
				
				<div id="pleio_template_selector_admin_logo_preview">
					<img src="<?php echo $logo_url; ?>" />
				</div>
				
				<div class="clearfloat"></div>
				
				<div>
					<?php echo elgg_echo("pleio_template_selector:forms:admin:logo:align"); ?>
					<?php echo elgg_view("input/dropdown", array("name" => "params[sitelogo_align]", "value" => $logo_align, "options_values" => $logo_align_options, "js" => "onchange='pleio_template_selector_change_sitelogo_align(this);'")); ?>
				</div>
				
				<div id="pleio_template_selector_admin_logo_align_custom">
					<?php echo elgg_echo("pleio_template_selector:forms:admin:logo:align:custom:top"); ?> <input type="text" name="params[sitelogo_align_top]" size="3" maxlength="3" value="<?php echo $logo_align_top; ?>" /> px
					<?php echo elgg_echo("pleio_template_selector:forms:admin:logo:align:custom:left"); ?> <input type="text" name="params[sitelogo_align_left]" size="3" maxlength="3" value="<?php echo $logo_align_left; ?>" /> px
				</div>
				
				<div>
					<?php echo elgg_echo("pleio_template_selector:forms:admin:logo:footer"); ?>
					<?php echo elgg_view("input/dropdown", array("name" => "params[show_logo_footer]", "value" => $show_logo_footer, "options_values" => $yesno_options)); ?>
				</div>
				
			</div>
			
			<div id="pleio_template_selector_admin_logo_custom_wrapper" <?php echo $show_custom_logo; ?>>
				<label><?php echo elgg_echo("pleio_template_selector:forms:admin:logo:custom:label"); ?></label>
				<div class="elgg-subtext"><?php echo elgg_echo("pleio_template_selector:forms:admin:logo:custom:description"); ?></div>
				<input type="file" name="custom_sitelogo" />
			</div>
		</div>
	</div>
	
	<div id="pleio_template_selector_admin_misc_container" class="elgg-module elgg-module-inline">
		<div class="elgg-head">
			<h3><?php echo elgg_echo("pleio_template_selector:forms:admin:misc:header"); ?></h3>
		</div>
		<div class="elgg-body">
			<div>
				<?php echo elgg_echo("pleio_template_selector:forms:admin:misc:show_title"); ?>
				<?php echo elgg_view("input/dropdown", array("name" => "params[show_title]", "value" => $show_title, "options_values" => $yesno_options)); ?>
			</div>
			<div>
				<?php echo elgg_echo("pleio_template_selector:forms:admin:misc:show_search"); ?>
				<?php echo elgg_view("input/dropdown", array("name" => "params[show_search]", "value" => $show_search, "options_values" => $yesno_options)); ?>
			</div>
			<div>
				<?php echo elgg_echo("pleio_template_selector:forms:admin:misc:show_login_dropdown"); ?>
				<?php echo elgg_view("input/dropdown", array("name" => "params[show_login_dropdown]", "value" => $show_login_dropdown, "options_values" => $yesno_options)); ?>
			</div>
			<div>
				<?php echo elgg_echo("pleio_template_selector:forms:admin:misc:layout_header_height"); ?>&nbsp;
				<input type="text" name="params[layout_header_height]" value="<?php echo $header_height; ?>" size="3" maxlength="3" /> px
			</div>
		</div>
	</div>
	
	<div id="pleio_template_selector_admin_misc_container" class="elgg-module elgg-module-inline">
		<div class="elgg-head">
			<h3><?php echo elgg_echo("pleio_template_selector:forms:admin:custom_css:header"); ?></h3>
		</div>
		<div class="elgg-body">
			<?php 
				echo elgg_view("input/plaintext", array("name" => "params[custom_css]", "value" => elgg_get_plugin_setting("custom_css", "pleio_template_selector")));
			 	echo "<div class='elgg-subtext'>". elgg_echo("pleio_template_selector:forms:admin:custom_css:disclaimer") . "</div>"; 
			 ?>
		</div>	
	</div>
	
	<?php echo elgg_view("input/submit", array("value" => elgg_echo("save"))); ?>
	
</form>