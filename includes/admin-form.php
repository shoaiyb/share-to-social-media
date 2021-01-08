<?php
function admin_form( $ss_options ){
	?>	
		<table class="form-table ss-settings-table">
			<tr>
				<th><label for="ss-select-style">Select style</label></th>
				<td>
					<p>
					<input type="radio" name="ss_options[ss-select-style]" value="horizontal-with-count" <?php checked( $ss_options['ss-select-style'], 'horizontal-with-count' ); ?>>
					<img src="<?php echo plugins_url( '../images/horizontal-with-count.png' , __FILE__ ); ?>">
					</p>
					<p>
					<input type="radio" name="ss_options[ss-select-style]" value="small-buttons" <?php checked( $ss_options['ss-select-style'], 'small-buttons' ); ?>>
					<img src="<?php echo plugins_url( '../images/small-buttons.png' , __FILE__ ); ?>">
					</p>
					<p>
					<input type="radio" name="ss_options[ss-select-style]" value="horizontal-w-c-square" <?php checked( $ss_options['ss-select-style'], 'horizontal-w-c-square' ); ?>>
					<img src="<?php echo plugins_url( '../images/horizontal-w-c-square.png' , __FILE__ ); ?>">
					</p>
					<p>
					<input type="radio" name="ss_options[ss-select-style]" value="horizontal-w-c-r-border" <?php checked( $ss_options['ss-select-style'], 'horizontal-w-c-r-border' ); ?>>
					<img src="<?php echo plugins_url( '../images/horizontal-w-c-r-border.png' , __FILE__ ); ?>">
					</p>
					<p>
					<input type="radio" name="ss_options[ss-select-style]" value="horizontal-w-c-circular" <?php checked( $ss_options['ss-select-style'], 'horizontal-w-c-circular' ); ?>>
					<img src="<?php echo plugins_url( '../images/horizontal-w-c-circular.png' , __FILE__ ); ?>">
					</p>
				</td>
			</tr>
			<tr>
				<th><label for="ss-select-style">Select services</label></th>
				<td>
					<?php
						foreach ($ss_options['ss-available-services'] as $service) {
							?>
							<input type="checkbox" name="ss_options[ss-selected-services][]" value="<?php echo $service ; ?>" <?php checked( in_array( $service, (array)$ss_options['ss-selected-services'] ) ); ?> /> <?php echo $service; ?>
							<input type="hidden" name="ss_options[ss-available-services][]" value="<?php echo $service ; ?>" />
							<br>
							<?php
						}
					?>
				</td>
			</tr>
			<tr>
				<th><label for="ss-select-postion">Select Position</label></th>
				<td>
					<input type="checkbox" name="ss_options[ss-select-position][]" value="before-content" <?php checked( in_array( 'before-content', (array)$ss_options['ss-select-position'] ) ); ?>>
					Before Content
					<br>
					<input type="checkbox" name="ss_options[ss-select-position][]" value="after-content" <?php checked( in_array( 'after-content', (array)$ss_options['ss-select-position'] ) ); ?>>
					After Content
					<br/>
					<p>
					You can place the shortcode <code>[ss-share]</code> wherever you want to display the buttons.
				</p>
				</td>
			</tr>
			<tr>
				<th><label for="ss-select-postion">Show on</label></th>
				<td>
					<input type="checkbox" name="ss_options[ss-show-on][]" value="home" <?php checked( in_array( 'home', (array)$ss_options['ss-show-on'] ) ); ?>>
					Home Page
					<br>
					<input type="checkbox" name="ss_options[ss-show-on][]" value="pages" <?php checked( in_array( 'pages', (array)$ss_options['ss-show-on'] ) ); ?>>
					Pages
					<br>
					<input type="checkbox" name="ss_options[ss-show-on][]" value="posts" <?php checked( in_array( 'posts', (array)$ss_options['ss-show-on'] ) ); ?>>
					Posts
					<br/>
					<input type="checkbox" name="ss_options[ss-show-on][]" value="archive" <?php checked( in_array( 'archive', (array)$ss_options['ss-show-on'] ) ); ?>>
					Archives
				</td>
			</tr>
			<tr>
				<th><label for="ss-exclude-on">Exclude on</label></th>
				<td>
					<input type="text" name="ss_options[ss-exclude-on]" value="<?php echo $ss_options['ss-exclude-on']; ?>">
					<small><em>Comma seperated post id's Eg: </em><code>1207,1222</code></small>
				</td>
			</tr>
			<tr class="tr-select-animation">
				<th><label for="ss-select-animations">Select Animations</label></th>
				<td>
					<input type="checkbox" name="ss_options[ss-select-animations][]" value="tooltip" <?php checked( (!empty($ss_options['ss-select-animations']) && in_array( 'tooltip', $ss_options['ss-select-animations'] )) ); ?>>
					Tooltip Animation
					<br>
					<input type="checkbox" name="ss_options[ss-select-animations][]" value="360-rotation" <?php checked( (!empty($ss_options['ss-select-animations']) && in_array( '360-rotation', $ss_options['ss-select-animations'] )) ); ?>>
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
