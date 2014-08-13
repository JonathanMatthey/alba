<?php
/*
 * Content Editor 2.0
 * semplice.theme
 * 
 */

// include content class
include('class.editor.php'); 

// get content type
$content_type = isset($_POST['content_type']) ? $_POST['content_type'] : '';

// get edit mode
$edit_mode = isset($_POST['edit_mode']) ? $_POST['edit_mode'] : ''; 

// is column content?
$is_column_content = isset($_POST['is_column_content']) ? $_POST['is_column_content'] : ''; 
 
// content class
$editor = new editor();

// init content
if($edit_mode === 'new') {
	$editor->rom['content'] = '';
}

// Edit mode
if($edit_mode === 'edit' || $edit_mode === 'new' || $edit_mode === 'single-edit') {
	
	// normal values
	$values = array(
		'styles'		=> isset($editor->rom['styles']) ? $editor->rom['styles'] : '', 
		'style_class'	=> 'is-style', 
		'in_column'		=> false, 
		'id'			=> $editor->id,
		'column_id'		=> $editor->column_id,
		'content_type'	=> $editor->content_type,
		'options'		=> isset($editor->rom['options']) ? $editor->rom['options'] : '',
		'options_class' => 'is-option'
	);
	
	if($is_column_content) {
		$values['styles'] = isset($editor->rom['columns'][$editor->column_id]['#' . $editor->id]['styles']) ? $editor->rom['columns'][$editor->column_id]['#' . $editor->id]['styles'] : '';
		$values['style_class'] = 'is-cc-style';
		$values['in_column'] = true;
		$values['options_class'] = 'is-cc-option';
		$values['options'] = isset($editor->rom['columns'][$editor->column_id]['#' . $editor->id]['options']) ? $editor->rom['columns'][$editor->column_id]['#' . $editor->id]['options'] : '';
	}

	// single edit styles and column mode
	if($edit_mode === 'single-edit') {
		$values['styles'] = isset($editor->rom['styles']) ? $editor->rom['styles'] : '';
		$values['style_class'] = 'is-cc-style';
		$values['in_column'] = false;
		$values['options_class'] = 'is-cc-option';
		$values['options'] = isset($editor->rom['options']) ? $editor->rom['options'] : '';
	}
	
	#----------------------------------
	# paragraph
	#----------------------------------
		
	if($content_type === 'content-p' || $content_type === 'column-content-p') {
		$editor->p_edit(stripslashes($editor->rom['content']), $values);
	}
	
	#----------------------------------
	# image
	#----------------------------------
	
	if($content_type === 'content-img' || $content_type === 'column-content-img') {
		$editor->img_edit($editor->rom['content'], $values);
	}
	
	#----------------------------------
	# gallery
	#----------------------------------
	
	if($content_type === 'content-gallery' || $content_type === 'column-content-gallery') {
		$editor->gallery_edit($editor->rom['content'], $values);
	}
	
	#----------------------------------
	# video
	#----------------------------------
	
	if($content_type === 'content-video' || $content_type === 'column-content-video') {
		$editor->video_edit($editor->rom['content'], $values);
	}
	
	#----------------------------------
	# audio
	#----------------------------------
	
	if($content_type === 'content-audio' || $content_type === 'column-content-audio') {
		$editor->audio_edit($editor->rom['content'], $values);
	}
	
	#----------------------------------
	# oembed
	#----------------------------------
	
	if($content_type === 'content-oembed' || $content_type === 'column-content-oembed') {
		$editor->oembed_edit($values);
	}
	
	#----------------------------------
	# thumbnails
	#----------------------------------
	
	if($content_type === 'content-thumbnails') {
		$editor->thumbnails_edit($values);
	}
	
	#----------------------------------
	# spacer
	#----------------------------------
	
	if($content_type === 'content-spacer' || $content_type === 'column-content-spacer') {
		$editor->spacer_edit($values);
	}
	
	#----------------------------------
	# multi column
	#----------------------------------
	
	if($content_type === 'multi-column') {
		$editor->mc_edit($values);
	}
	
	#----------------------------------
	# add column
	#----------------------------------
	
	if($content_type === 'add-column') {
		$editor->add_column($editor->id, $editor->parent_id, 'span6');
	}
	
} elseif ($edit_mode === 'custom-fontset') {
	
	// get custom fontset
	$editor->custom_fontset();
	
} elseif ($edit_mode === 'load-preset') {
	
	// load semplice preset
	$editor->load_preset();

} else {
	
	// normal values
	$view_values = array(
		'has_container'	=> true,
		'id'			=> $editor->id,
		'styles'		=> isset($editor->rom['styles']) ? $editor->rom['styles'] : '',
		'options'		=> isset($editor->rom['options']) ? $editor->rom['options'] : '',
		'in_column'		=> false
	);
	
	#----------------------------------
	# paragraph view
	#----------------------------------
	
	if($content_type === 'content-p') {
		$editor->p_view(stripslashes($editor->rom['content']), $view_values);
	}
	
	#----------------------------------
	# image view
	#----------------------------------
	
	if($content_type === 'content-img') {
		$editor->img_view($editor->rom['content'], $view_values);
	}
	
	#----------------------------------
	# gallery view
	#----------------------------------
	
	if($content_type === 'content-gallery') {
		$editor->gallery_view($editor->rom['content'], $view_values);
	}
	
	#----------------------------------
	# video view
	#----------------------------------
	
	if($content_type === 'content-video') {
		$editor->video_view($editor->rom['content'], $view_values);
	}
	
	#----------------------------------
	# audio view
	#----------------------------------
	
	if($content_type === 'content-audio') {
		$editor->audio_view($editor->rom['content'], $view_values);
	}
	
	#----------------------------------
	# oembed view
	#----------------------------------
	
	if($content_type === 'content-oembed') {
		$editor->oembed_view($view_values);
	}
	
	#----------------------------------
	# thumbnails view
	#----------------------------------
	
	if($content_type === 'content-thumbnails') {
		$editor->thumbnails_view($view_values);
	}
	
	#----------------------------------
	# spacer view
	#----------------------------------
	
	if($content_type === 'content-spacer') {
		$editor->spacer_view($view_values);
	}
	
	#----------------------------------
	# multi column Views
	#----------------------------------
	
	if($content_type === 'multi-column') {
	
		// masonry prefix
		$pre = '';
	
		// remove gutter and fluid layout
		$remove_gutter = filter_var($editor->rom['options']['remove-gutter'], FILTER_VALIDATE_BOOLEAN);
		$is_fluid = filter_var($editor->rom['options']['show-fullscreen'], FILTER_VALIDATE_BOOLEAN);
	
		if($remove_gutter) {
			$pre = 'masonry-';
		}

		// row container head
		$editor->row_header($editor->rom['styles'], $editor->rom['options'], $remove_gutter, $is_fluid );
		
		foreach($editor->rom['columns'] as $mc_column_id => $mc_columns) {
		
			// column width
			$column_width = $mc_columns['options']['column-width'];

			// column div open
			echo '<div class="' . $pre . $column_width . ' masonry-item remove-gutter-' . $remove_gutter . '">';
			
			foreach($mc_columns as $mc_content_id => $mc_content) {
				
				if(!isset($mc_content['content_type'])) {
					$mc_content['content_type'] = '';
				}
				
				// single edit values
				$view_se_values = array( 
					'has_container' 		 	=> false,
					'id'						=> $mc_content_id,
					'options'					=> isset($mc_content['options']) ? $mc_content['options'] : '',
					'styles' 				 	=> isset($mc_content['styles']) ? $mc_content['styles'] : '', 
					'in_column'	 			 	=> true, 
					'single_edit_content_id' 	=> $mc_content_id, 
					'single_edit_column_id'  	=> $mc_column_id, 
					'single_edit_content_type'	=> $mc_content['content_type']
				);

				#----------------------------------
				# multi column paragraph view
				#----------------------------------

				if($mc_content['content_type'] === 'column-content-p') {
					$editor->p_view(stripslashes($mc_content['content']), $view_se_values);
				}
				
				#----------------------------------
				# multi column image view
				#----------------------------------

				if($mc_content['content_type'] === 'column-content-img') {
					$editor->img_view($mc_content['content'], $view_se_values);
				}
				
				#----------------------------------
				# multi column gallery view
				#----------------------------------

				if($mc_content['content_type'] === 'column-content-gallery') {
					$editor->gallery_view($mc_content['content'], $view_se_values);
				}
				
				#----------------------------------
				# multi column video view
				#----------------------------------

				if($mc_content['content_type'] === 'column-content-video') {
					$editor->video_view($mc_content['content'], $view_se_values);
				}
				
				#----------------------------------
				# multi column audio view
				#----------------------------------

				if($mc_content['content_type'] === 'column-content-audio') {
					$editor->audio_view($mc_content['content'], $view_se_values);
				}
				
				#----------------------------------
				# multi column oembed view
				#----------------------------------

				if($mc_content['content_type'] === 'column-content-oembed') {
					$editor->oembed_view($view_se_values);
				}
				
				#----------------------------------
				# multi column spacer view
				#----------------------------------

				if($mc_content['content_type'] === 'column-content-spacer') {
					$editor->spacer_view($view_se_values);
				}
				
			}
			
			// column div close
			echo '</div>';
		}
		
		// row container footer
		$editor->row_footer($remove_gutter, $is_fluid);
		
	}
}

