<?php 	 
/****************************
* Our display functions for outputting info
****************************/

function beca_add_content($content){

	global $beca_options;
	$post_types = get_post_types(array('public' => true));

	if ( ! isset( $beca_options['enable'] ) ) {
			$beca_options['enable'] = 0;
	}

	if ( ! isset( $beca_options['top'] ) ) {
							$beca_options['top'] = 0;
	}
	if ( ! isset( $beca_options['bottom'] ) ) {
		$beca_options['bottom'] = 0;
	}
	// check to see which post types have been selected and store them into the array $selected_post_types
	$selected_post_types = array();
	foreach ( $post_types as $post_type ) { 

		if ( ! isset( $beca_options[$post_type] ) ) {
			$beca_options[$post_type] = 0;
		}

		if($beca_options[$post_type] == 1) {
			$selected_post_types[] =  $post_type;
		}
	 }

	 $page_conditionals = is_single() || is_page() || is_attachment();
	
	// display content if a post type is chosen and if the enable option is selected
	if( in_array(get_post_type(), $selected_post_types) && $beca_options['enable'] == 1 && $page_conditionals  ){

		// display content at top or bottom of content....or both top and bottom
		if ($beca_options['bottom'] == 1 && $beca_options['top'] == 0 ){
			$content .= $beca_options['added_content'];
		}	
		elseif( $beca_options['top'] == 1 && $beca_options['bottom'] == 0 ){
			$content = $beca_options['added_content'] . $content;
		}
		elseif( $beca_options['top'] == 1 && $beca_options['bottom'] == 1 ){
			$content = $beca_options['added_content'] . $content . $beca_options['added_content'];
		} else {
			$content = $content;
		}
	}

		

		// add to top of content
		// 	

	return $content;
}

add_filter('the_content', 'beca_add_content' );
?>