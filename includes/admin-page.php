<?php  // content shown on settings page 
	function beca_options_page() {
		global $beca_options;

		// start HTML
		ob_start(); ?>
		<div class="wrap">	
			<h2>Easy Content Adder Options</h2>
			<form method="post" action="options.php">
				<?php settings_fields('beca_settings_group'); ?>

				<h4><?php _e('Enable', 'beca_domain' ); ?></h4>
				<p>
					<?php 
						// If "Turn content on" is not selected, set input value to
						if ( ! isset( $beca_options['enable'] ) )
							$beca_options['enable'] = 0;
						?>
					<input id="beca_settings[enable]" name="beca_settings[enable]" type="checkbox" value="1" <?php checked($beca_options['enable'], '1', true ); ?> />
					<label class="description" for="beca_settings[enable]">
						<?php _e('Turn content on.', 'beca_domain'); ?>
					</label>

				</p>

				<hr class="beca_divider" />

				<h4><?php _e('Select which type of pages to display content on.', 'beca_domain' ); ?></h4>
				<?php // get all post types that are public
					$post_types = get_post_types(array('public' => true));

					foreach ( $post_types as $post_type ) { 
					   // If no post type is selected, set input value to 0
						if ( ! isset( $beca_options[$post_type] ) )
							$beca_options[$post_type] = 0;
						?>
					<input id="beca_settings[<?php echo $post_type ?>]" name="beca_settings[<?php echo $post_type ?>]" type="checkbox" value="1" <?php checked($beca_options[$post_type], '1', true ); ?> />
					<label class="description" for="beca_settings[<?php echo $post_type ?>]">
						<?php _e($post_type, 'beca_domain'); ?>
					</label>
					<br/>
					<?php }
				?>
				<hr class="beca_divider" />

				<h4><?php _e('Select whether to add to top or bottom of post/pages. You can also select both to have the content show at the top and bottom.', 'beca_domain' ); ?></h4>
				<p>
					<?php 
						// If "Turn content on" is not selected, set input value to
						if ( ! isset( $beca_options['top'] ) )
							$beca_options['top'] = 0;
						if ( ! isset( $beca_options['bottom'] ) )
							$beca_options['bottom'] = 0;
						?>
					<input id="beca_settings[top]" name="beca_settings[top]" type="checkbox" value="1" <?php checked($beca_options['top'], '1', true ); ?> />
					<label class="description" for="beca_settings[top]">
						<?php _e('Add to top', 'beca_domain'); ?>
					</label>
					<br/>
					<input id="beca_settings[bottom]" name="beca_settings[bottom]" type="checkbox" value="1" <?php checked($beca_options['bottom'], '1', true ); ?> />
					<label class="description" for="beca_settings[bottom]">
						<?php _e('Add to bottom', 'beca_domain'); ?>
					</label>

				</p>

				<hr class="beca_divider" />

				

				<h4><?php _e('Enter content below', 'beca_domain' ); ?></h4>
				<?php 
					$content = 'beca_settings[added_content]';
					$args = array("textarea_name" => "beca_settings[added_content]");
					$editor_id = 'added_content';

					// If editor is has no content, set the content area to blank
					if ( ! isset( $beca_options['added_content'] ) ) {
						$beca_options['added_content'] = " ";
					}

					wp_editor(  $beca_options['added_content'], $editor_id, $args ); 
				?>
				<p class="submit">
					<input type="submit" class="button-primary" vale="<?php _e('Save Options', 'beca_domain');  ?> "/>
				</p>
			</form>
		</div>
	

		<?php 
		// Outpout HTML
		echo ob_get_clean();
		}

	// create options page under settings menu
	function beca_add_options_link() {
		add_options_page('Easy Content Adder Options', 'Easy Content Adder', 'manage_options', 'beca-options','beca_options_page' );
	}
	add_action('admin_menu', 'beca_add_options_link');

	// register options page under settings menu
	function beca_register_settings(){
		register_setting('beca_settings_group', 'beca_settings');
	}
	add_action('admin_init', 'beca_register_settings');
?>