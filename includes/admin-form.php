<?php

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function admin_form( $stsm_options ){
	?>	
		<table class="form-table stsm-settings-table">
			<tr>
				<th><label for="stsm-select-style">Select style</label></th>
				<td>
					<p>
					<input type="radio" name="stsm_options[stsm-select-style]" value="horizontal-with-count" <?php checked( $stsm_options['stsm-select-style'], 'horizontal-with-count' ); ?>>
					<img src="<?php echo plugins_url( '../images/horizontal-with-count.png' , __FILE__ ); ?>">
					</p>
					<p>
					<input type="radio" name="stsm_options[stsm-select-style]" value="small-buttons" <?php checked( $stsm_options['stsm-select-style'], 'small-buttons' ); ?>>
					<img src="<?php echo plugins_url( '../images/small-buttons.png' , __FILE__ ); ?>">
					</p>
					<p>
					<input type="radio" name="stsm_options[stsm-select-style]" value="horizontal-w-c-square" <?php checked( $stsm_options['stsm-select-style'], 'horizontal-w-c-square' ); ?>>
					<img src="<?php echo plugins_url( '../images/horizontal-w-c-square.png' , __FILE__ ); ?>">
					</p>
					<p>
					<input type="radio" name="stsm_options[stsm-select-style]" value="horizontal-w-c-r-border" <?php checked( $stsm_options['stsm-select-style'], 'horizontal-w-c-r-border' ); ?>>
					<img src="<?php echo plugins_url( '../images/horizontal-w-c-r-border.png' , __FILE__ ); ?>">
					</p>
					<p>
					<input type="radio" name="stsm_options[stsm-select-style]" value="horizontal-w-c-circular" <?php checked( $stsm_options['stsm-select-style'], 'horizontal-w-c-circular' ); ?>>
					<img src="<?php echo plugins_url( '../images/horizontal-w-c-circular.png' , __FILE__ ); ?>">
					</p>
				</td>
			</tr>
			<tr>
				<th><label for="stsm-select-style">Select services</label></th>
				<td>
					<?php
						foreach ($stsm_options['stsm-available-services'] as $service) {
							?>
							<input type="checkbox" name="stsm_options[stsm-selected-services][]" value="<?php echo $service ; ?>" <?php checked( in_array( $service, (array)$stsm_options['stsm-selected-services'] ) ); ?> /> <?php echo $service; ?>
							<input type="hidden" name="stsm_options[stsm-available-services][]" value="<?php echo $service ; ?>" />
							<br>
							<?php
						}
					?>
				</td>
			</tr>
			<tr>
				<th><label for="stsm-select-postion">Select Position</label></th>
				<td>
					<input type="checkbox" name="stsm_options[stsm-select-position][]" value="before-content" <?php checked( in_array( 'before-content', (array)$stsm_options['stsm-select-position'] ) ); ?>>
					Before Content
					<br>
					<input type="checkbox" name="stsm_options[stsm-select-position][]" value="after-content" <?php checked( in_array( 'after-content', (array)$stsm_options['stsm-select-position'] ) ); ?>>
					After Content
					<br/>
					<p>
					You can place the shortcode <code>[share-to-sm]</code> wherever you want to display the buttons.
				</p>
				</td>
			</tr>
			<tr>
				<th><label for="stsm-select-postion">Show on</label></th>
				<td>
					<input type="checkbox" name="stsm_options[stsm-show-on][]" value="home" <?php checked( in_array( 'home', (array)$stsm_options['stsm-show-on'] ) ); ?>>
					Home Page
					<br>
					<input type="checkbox" name="stsm_options[stsm-show-on][]" value="pages" <?php checked( in_array( 'pages', (array)$stsm_options['stsm-show-on'] ) ); ?>>
					Pages
					<br>
					<input type="checkbox" name="stsm_options[stsm-show-on][]" value="posts" <?php checked( in_array( 'posts', (array)$stsm_options['stsm-show-on'] ) ); ?>>
					Posts
					<br/>
					<input type="checkbox" name="stsm_options[stsm-show-on][]" value="archive" <?php checked( in_array( 'archive', (array)$stsm_options['stsm-show-on'] ) ); ?>>
					Archives
				</td>
			</tr>
			<tr>
				<th><label for="stsm-exclude-on">Exclude on</label></th>
				<td>
					<input type="text" name="stsm_options[stsm-exclude-on]" value="<?php echo $stsm_options['stsm-exclude-on']; ?>">
					<small><em>Comma seperated post id's Eg: </em><code>1207,1222</code></small>
				</td>
			</tr>
			<tr class="tr-select-animation">
				<th><label for="stsm-select-animations">Select Animations</label></th>
				<td>
					<input type="checkbox" name="stsm_options[stsm-select-animations][]" value="tooltip" <?php checked( (!empty($stsm_options['stsm-select-animations']) && in_array( 'tooltip', $stsm_options['stsm-select-animations'] )) ); ?>>
					Tooltip Animation
					<br>
					<input type="checkbox" name="stsm_options[stsm-select-animations][]" value="360-rotation" <?php checked( (!empty($stsm_options['stsm-select-animations']) && in_array( '360-rotation', $stsm_options['stsm-select-animations'] )) ); ?>>
					360d Rotation <small><em>(Looks good only for circular icons)</em></small>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
		</p>
	</form>
<?php
}
?>
