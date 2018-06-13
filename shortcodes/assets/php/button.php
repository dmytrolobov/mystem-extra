<?php if ( ! defined( 'ABSPATH' ) ) exit;
	/**
		* Icon generator
		*
		* @package     Shortcode Set
		* @subpackage  Admin
		* @copyright   Copyright (c) 2015, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	?>
	<div id="wow-icons">
	<div class="box">
		<div class="iconrow">
			<div class="iconcol">
				<div class="iconrow">
					<div class="iconcol">
						<?php _e('Select Icon', 'wow-shortcodes'); ?>:<br/>
						<select class="select_icon" name="font_icon" id="icongenerate" onchange="generateiconcode();">
							<?php
								$icons = mystem_fontawesome_icons();
								foreach ($icons as $icon){
									echo '<option>'.$icon.'</option>';
								}
							?>
						</select>
					</div>
					<div class="iconcol">
						<?php _e('Icon shape', 'wow-shortcodes'); ?>:<br/>
						<select class="select_icon" name='icon_shape' id="icon_shape" onchange="generateiconcode();">
							<option value="none"><?php _e('none', 'wow-shortcodes'); ?></option>
							<option value="fas fa-circle"><?php _e('circle', 'wow-shortcodes'); ?></option>
							<option value="far fa-circle"><?php _e('circle', 'wow-shortcodes'); ?></option>
							<option value="fas fa-square"><?php _e('square', 'wow-shortcodes'); ?></option>
							<option value="far fa-square"><?php _e('square', 'wow-shortcodes'); ?></option>
							<option value="fas fa-square-full"><?php _e('square', 'wow-shortcodes'); ?></option>
							<option value="fas fa-ban" selected><?php _e('square', 'wow-shortcodes'); ?></option>
						</select>
					</div>
				</div>
				<div class="iconrow">
					<div class="iconcol">
						<?php _e('Icon color', 'wow-shortcodes'); ?>:<br/>
						<input type='text' class="wp-color-picker-field" data-alpha="true" name='color_icon' id="color_icon" value="#383838"/>
					</div>
					<div class="iconcol">
						<?php _e('Shape color', 'wow-shortcodes'); ?>:<br/>
						<input type='text' class="wp-color-picker-field" data-alpha="true" name='color_shape' id="color_shape" value="#dd3333" />
					</div>
				</div>
				<div class="iconrow">
					<div class="iconcol">
						<?php _e('Icon size', 'wow-shortcodes'); ?>(px):<br/>
						<input type='text' name='size_icon' id='size_icon' value="24" onkeyup="generateiconcode();" />
					</div>
					<div class="iconcol">
						<?php _e('Icon Align', 'wow-shortcodes'); ?>:<br/>
						<select name="icon_align" id="icon_align" onchange="generateiconcode();">
							<option value="none">None</option>
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
							<option value="center">Center</option>
						</select>
					</div>
				</div>
			</div>
			<div class="iconcol">
				<div class="iconrow">
					<div class="iconcol">
						<b><?php _e('Shortcode', 'wow-shortcodes'); ?>:</b><br/>
						<span id="set_code_icon"></span>
					</div>
				</div>
				<div class="iconrow">
					<div class="iconcol">
						<b><?php _e('Preview', 'wow-shortcodes'); ?>:</b><br/>
						<span id="set_preview_icon"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="iconrow">
			<div class="iconcol">
				<input type="button" value="<?php _e( 'Insert Icon', 'wow-shortcodes' ); ?>" name="icoinsert" id="iconinsert" class="btn" onclick="insertgenerateiconcode();" />
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>
