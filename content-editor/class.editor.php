<?php
/*
 * Class - content
 * semplice.theme
 * 
 */ 
 
class editor {
	
	// vars
	public $id;
	public $ccId;
	public $rom;
	public $column_id;
	public $edit_mode;
	public $parent_id;
	public $content_type;
	public $remove_gutter;
	public $is_fluid;
	public $add_column_foot;
	public $fontset_id;
	public $preset_id;
	
	function __construct() {
		
		// get the id
		$this->id = isset($_POST['id']) ? $_POST['id'] : '';
		
		// get the content container id
		$this->ccId = isset($_POST['ccId']) ? $_POST['ccId'] : '';
		
		// get the rom
		$this->rom = isset($_POST['rom']) ? $_POST['rom'] : '';
		
		// get the column id
		$this->column_id = isset($_POST['column_id']) ? $_POST['column_id'] : '';
		
		// get edit mode
		$this->edit_mode = isset($_POST['edit_mode']) ? $_POST['edit_mode'] : '';
		
		// get the parent id
		$this->parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : '';
		
		// get the field type
		$this->content_type = isset($_POST['content_type']) ? $_POST['content_type'] : '';
		
		// add column foot
		$this->add_column_foot = '</div></div></div><div class="row"><div class="span12"><div class="cc-hr"></div></div></div></div>';
		
		// get the parent id
		$this->fontset_id = isset($_POST['fontset_id']) ? $_POST['fontset_id'] : '';
		
		// get the preset id
		$this->preset_id = isset($_POST['preset_id']) ? $_POST['fontset_id'] : '';
	}
	
	// get options
	function get_option($type, $title, $name, $default, $val, $values) {

		// option head
		echo '<div class="option-left"><div class="option"><h4>' . $title . '</h4></div></div><div class="option-right"><div class="option">';
		
		// option content
		if($type === 'select') {
			if(!isset($values['options'][$name])) {
				$values['options'][$name] = $default;
			}
			echo '<div class="ce-select-box big-box"><select name="' . $name . '" class="' . $values['options_class'] . ' select-box" data-content-id="' . $values['id'] . '">';
			$this->select($val, $values['options'][$name]);
			echo '</select></div>';
		} else if($type === 'color') {
			if(!isset($values['options'][$name])) {
				$values['options'][$name] = $default;
			}
			echo '<div class="wp-color"><input type="text" value="' . $values['options'][$name] . '" class="color-picker ' . $values['options_class'] . '" data-default-color="' . $default . '" name="' . $name . '" /></div>';
		} else if($type === 'text') {
			if(!isset($values['options'][$name])) {
				$values['options'][$name] = $default;
			}
			echo '<input type="text" value="' . $values['options'][$name] . '" class="' . $values['options_class'] . '" name="' . $name . '" />';
		} else if($type === 'video') {
			if(!isset($values['options']['filename'])) {
				$values['options']['filename'] = 'Upload Video';
			}
			echo 
				'<div class="media-upload-box video-upload-box">
					<a class="media-upload semplice-button video-upload" data-content-id="' . $values['id'] . '" data-upload-type="video">' . $values['options']['filename'] . '</a><a class="remove-video remove-media" data-content-id="' . $values['id'] . '" data-media="video"></a>
					<div class="clear"></div>
					<input type="text" name="' . $name . '" class="is-content is-video" value="' . $values['options'][$name] . '">
				</div>';
		} else if($type === 'audio') {
			if(!isset($values['options']['filename'])) {
				$values['options']['filename'] = 'Upload Audio';
			}
			echo 
				'<div class="media-upload-box video-upload-box">
					<a class="media-upload semplice-button audio-upload" data-content-id="' . $values['id'] . '" data-upload-type="audio">' . $values['options']['filename'] . '</a><a class="remove-video remove-media" data-content-id="' . $values['id'] . '" data-media="audio"></a>
					<div class="clear"></div>
					<input type="text" name="' . $name . '" class="is-content is-audio" value="' . $values['options'][$name] . '">
				</div>';
		}
		
		// option footer
		echo '</div></div>';
	}
	
	// select boxes
	function select($arr, $active_key) {
		if( is_array($arr) )
		{
			foreach( $arr as $key => $value )
			{
				if($key === $active_key) {
					$selected = 'selected';
				} else {
					$selected = '';
				}
				echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
			}
		}
	}
	
	// options seperator
	function option_seperator() {
		echo '<div class="hr"></div>';
	}
	
	// container styles
	function container_styles($styles) {
								
		$css = '';

		if(isset($styles['padding-top'])) {
			$css .= 'padding-top: ' . $styles['padding-top'] . ';';
		}
		if(isset($styles['padding-bottom'])) {
			$css .= 'padding-bottom: ' . $styles['padding-bottom'] . ';';
		}
		if(isset($styles['padding-right'])) {
			$css .= 'padding-right: ' . $styles['padding-right'] . ';';
		}
		if(isset($styles['padding-left'])) {
			$css .= 'padding-left: ' . $styles['padding-left'] . ';';
		}
		if(isset($styles['background-image'])) {			
			$css .= 'background-image: url(' . $styles['background-image'] . ');';
			$css .= 'background-repeat: ' . $styles['background-repeat'] . ';';
			if(isset($styles['background-size']) && $styles['background-size'] === 'cover') {
				$css .= 'background-size: cover;';	
			} else if(isset($styles['background-repeat']) && $styles['background-repeat'] !== 'no-repeat') {
				$css .= 'background-size: auto !important;';
			}
			if(isset($styles['background-position'])) {
				$css .= 'background-position: ' . $styles['background-position'] . ';';
			} else {
				$css .= 'background-position: top center;';
			}
		}
		if(preg_match('/^#[a-f0-9]{6}$/i', $styles['background-color'])) {
			$has_color = true;
		} 
		if(isset($has_color) && $has_color === true) {
			$css .= 'background-color: ' . $styles['background-color'] . ';';
		} else {
			$css .= 'background-color: transparent;';
		}
		
		// fwt border bottom
		if(isset($styles['border-bottom'])) {
			$css .= 'border-color: ' . $styles['border-bottom'] . ' !important;';
		} 

		return $css;
	}

	function styles($values) {
		// include the legendary atts
		include('styles.php');
	}

	function custom_fontset() {
		if($this->edit_mode === 'custom-fontset') {
			$post_object = get_post($this->fontset_id);
			include('webfonts.php');
			webfonts($post_object, true);
		}
	}
	
	function load_preset() {
	
		// is edit mode load preset?
		if($this->edit_mode === 'load-preset') {
			
			// include the preset file
			include('presets/' . $this->preset_id . '.php');
			
		}
		
	}
	
	function edit_head($values) {
		
		// single edit class
		$single_edit_class = '';
		
		// is new or edit		
		if($this->edit_mode === 'new' || $this->edit_mode === 'single-edit' || $values['in_column']) {
			if($this->edit_mode === 'single-edit') {
				$single_edit_class = "single-edit-cc";
			}
			echo '<div id="' . $values['id'] . '" class="' . $values['content_type'] . ' ' . $single_edit_class . '" data-sort="1">';
		}

		if(!$values['in_column']) {
			echo '
				<div class="container edit-content fadein">';
				// sticky atts
				if($values['content_type'] === 'multi-column') {
					echo '
						<div class="sticky-mc-atts">
							<ul>
								<li><a class="save-mc" data-content-id="' . $this->id . '" data-content-type="' . $this->content_type . '"></a></li>
								<li><a class="add-column" data-content-id="' . $this->id . '">Add New Column</a></li>
							</ul>
						</div>
					';
				}
			echo '
					<div class="row">
						<div class="span12">
							<div class="atts-holder">
			';
		} else {
			echo '
				<div class="edit-content fadein column-content in-edit-mode" data-content-id="' . $values['id'] . '" data-content-type="' . $values['content_type'] . '" data-in-column="' . str_replace('#', '', $values['column_id']) . '">
					<div class="atts-holder">
			';
		}

		$this->styles($values);
		
		if(!$values['in_column']) {
			echo '
							</div>
						</div>
					</div>
			';
		} else {
			echo '
					</div>
			';

		}
	}

	function edit_foot($values) {
		// is new or edit
		if($this->edit_mode !== 'edit' || $values['in_column']) {
			echo '</div>';
		}
		echo '</div>';
	}
	
	function view_head($values) {
		
		// single edit popup
		$single_edit_popup = '';
		
		if($values['in_column']) {
			$column_pre = 'column-';
		}
		
		if(isset($values['single_edit_content_id'])) {
			$single_edit = 'data-single-edit-content-id="' . str_replace('#', '', $values['single_edit_content_id']) . '" data-single-edit-column-id="' . $values['single_edit_column_id'] . '" data-single-edit-content-type="' . $values['single_edit_content_type'] . '"';
			$single_edit_popup = '
				<div class="single-edit">
					<ul>
						<li><a class="edit-single" ' . $single_edit . '>Single Edit</a></li>
						<li><a class="edit-column">Column Edit</a></li>
					</ul>
				</div>
			';
		}
		
		// content container class
		if($this->content_type === 'multi-column') {
			$cc_class = 'mc-sub-content-container';
		} else {
			$cc_class = 'content-container';
		}
		
		// get css output
		$e = '<div class="' . $cc_class . '" style="' . $this->container_styles($values['styles']) . '" data-content-id="' . $this->id . '" data-content-type="' . $this->content_type . '">';
		$e .= $single_edit_popup;
		
		// has container?
		if($values['has_container']) {
			$e .= '<div class="container">';
			$e .= '<div class="row">';
		}
		
		// output
		echo $e;
	}
	
	function view_foot($values) {
		$e = '</div>';
		// has container?
		if($values['has_container']) {
			$e .= '</div>';
			$e .= '</div>';
		}

		//output
		echo $e;
	}
	
	// row header
	function row_header($styles, $options, $remove_gutter, $is_fluid) {

		// output
		$e = '';
	
		// inner background
		$inner_background = '';
	
		// get css output
		$e  = '<div class="mc-content-container" style="' . $this->container_styles($styles) . '" data-content-id="' . $this->id . '" data-content-type="' . $this->content_type . '">';
		
		// has inner background?
		if($options['row-inner-background']) {
			$inner_background = 'style="background-color: ' . $options['row-inner-background'] . ';"';
		}

		// check if layout is fluid or non-fluid
		if($is_fluid) {
			$container_class = '';
			// if gutter, center masonry
			if(!$remove_gutter) {
				$fit_width = 'isFitWidth: true';
				$masonry = '.masonry-full-inner';
				$container_class = 'class="masonry-full"';
			}
		} else {
			$container_class = 'class="container"';
		}

		$e .= '<div id="masonry-' . $this->id . '" ' . $container_class . ' ' . $inner_background . '>';
		
		// open masonry inner
		if($is_fluid && !$remove_gutter) {
			// masonry inner
			$e .= '<div class="masonry-full-inner">';
		}
		
		if($remove_gutter) {
			$e .= '<div class="no-gutter-grid-sizer"></div>';
			$e .= '<div class="no-gutter-gutter-sizer"></div>';
		} else {
			$e .= '<div class="row"><div class="grid-sizer"></div>';
			$e .= '<div class="gutter-sizer"></div>';
		}
		
		// output
		echo $e;
	}
	
	// row footer
	function row_footer($remove_gutter, $is_fluid) {
		
		// masonry container
		$masonry = '';
		
		// masonry prefix
		$pre = '';
		
		// fit width
		$fit_width = '';
		
		// check if layout is fluid or non-fluid
		if($is_fluid && !$remove_gutter) {
			$fit_width = 'isFitWidth: true';
			$masonry = ' .masonry-full-inner';
		}
		
		// output
		$e = '';
		
		// is masrony layout mode?
		if($remove_gutter) {
			$pre = 'no-gutter-';
			$e .= '</div>';
		} else {
			$e .= '</div></div>';
		}
		
		// close masonry inner
		if($is_fluid && !$remove_gutter) {
			$e .= '</div>';	
		}
		
		// javascript
		$e .= '
		<script type="text/javascript">
			(function ($) {
				$(document).ready(function () {
					/* init masonry */
					var $container = $("#masonry-' . $this->id . $masonry . '");
					$container.imagesLoaded( function() {
						$container.masonry({
							itemSelector: ".masonry-item",
							columnWidth: ".' . $pre . 'grid-sizer",
							gutter: ".' . $pre . 'gutter-sizer",
							transitionDuration: 0,
							isResizable: true,
							' . $fit_width . '
						});
					});
				});
			})(jQuery);
		</script>
		';
		
		$e .= '</div>';
		
		// output
		echo $e;
	}
	
	// paragraph edit
	function p_edit($content, $values) {

		// edit head
		$this->edit_head($values);
		
		if(!$values['in_column'] && $this->edit_mode !== 'single-edit') {
			// width, offset
			$width = array();
			$offset = array();
			
			for($i=1; $i<=12; $i++) {
				$width['span' . $i] = $i . ' Col';
			}
			
			for($i=0; $i<=12; $i++) {
				if($i < 1) {
					$offset['no-offset'] = 'No Offset';
				} else {
					$offset['offset' . $i] = $i . ' Col';
				}
			}
			
			// options head
			echo '<div class="row"><div class="span12 options">';
			
			// options
			$this->get_option('select', 'Paragraph Width', 'span', 'span12', $width, $values);
			
			// seperator
			$this->option_seperator();
			
			// options
			$this->get_option('select', 'Paragraph Offset', 'offset', 'no-offset', $offset, $values);
			
			// seperator
			$this->option_seperator();
		} else {
			// options head
			echo '<div class="options">';
		}
		
		$wysiwyg_bg_color = array(
			'white' => 'White',
			'black' => 'Black'
		);

		// options
		$this->get_option('select', 'WYSIWYG Background Color', 'wysiwyg_bg_color', 'white', $wysiwyg_bg_color, $values);
		
		// seperator
		$this->option_seperator();
		
		if(!$values['in_column'] && $this->edit_mode !== 'single-edit') {
			// close options
			echo '</div></div>';
		} else {
			// close options
			echo '</div>';
		}

		// define e
		$e = '';
		
		// content area
		$e .= '
			<div class="ckeditor-container">
				<textarea name="' . $values['id'] . '" class="is-content">';
				if($content) {
					$e .= $content;
				} else {
					$e .= "<h3>Semplice Theme</h3><p>I'm foolish and I'm funny and I'm needy. Am I needy? Are you sure I'm not needy? 'Cause I feel needy sometimes. That coat costs more than your house! Look, you are playing adults…with fully formed libidos, not 2 young men playing grab-ass in the shower. You go buy a tape recorder and record yourself for a whole day. I think you'll be surprised at some of your phrasing. Friend of mine from college. He also has a boat tho not called the Seaward. </p>";
				}
		$e .= '
				</textarea>
			</div>
		';
		// check if editor bg is inverted
		if(isset($values['options']['wysiwyg_bg_color']) && $values['options']['wysiwyg_bg_color'] === 'black') {
			$wysiwyg_bg = '$("#cke_'. $values['id'] . ' .cke_wysiwyg_div").css("backgroundColor", "#000000");';
		} else {
			$wysiwyg_bg = '$("#cke_'. $values['id'] . ' .cke_wysiwyg_div").css("backgroundColor", "#ffffff");';
		}
		
		// initialize redactor
		$e .= '
			<script type="text/javascript">
				(function($) {
					$(document).ready(function () {
						$("textarea[name=' . $values['id'] . ']").ckeditor(function() { ' . $wysiwyg_bg . ' });
					});
				})(jQuery);
			
			</script>
		';
		
		// display paragraph
		echo $e;
		
		// edit foot
		$this->edit_foot($values);
	}
	
	// image edit
	function img_edit($content, $values) {

		// output
		$e = '';
	
		// edit head
		$this->edit_head($values);
		
		//image scale
		$img_scale = array(
			'none' => 'None',
			'full_width' => 'Full Width'
		);

		//image align
		$img_align = array(
			'left' => 'Left',
			'center' => 'Center',
			'right' => 'Right'
		); 
		
		// exclude from responsive scaling
		$resp_exclude = array(
			'no' => 'No',
			'yes' => 'Yes'
		);
		
		if($values['content_type'] !== 'column-content-img') {
			// options head
			echo '<div class="row"><div class="span12 options">';
		} else {
			echo '<div class="options">';
		}

		// options
		$this->get_option('select', 'Image Scale', 'img-scale', 'none', $img_scale, $values);
		
		// seperator
		$this->option_seperator();
		
		// options
		$this->get_option('select', 'Image Align', 'img-align', 'left', $img_align, $values);
		
		// seperator
		$this->option_seperator();
		
		// options
		$this->get_option('text', 'Image Link', 'img-link', '', '', $values);
		
		// seperator
		$this->option_seperator();
		
		// options
		$this->get_option('select', 'Exclude from Responsive Scaling', 'responsive-exclude', 'no', $resp_exclude, $values);
		
		// seperator
		$this->option_seperator();
		
		// close options
		if($values['content_type'] !== 'column-content-img') {
			echo '</div></div>';
		} else {
			echo '</div>';
		}
		
		// image id
		$image = wp_get_attachment_image_src($content, 'full');
		
		// content area
		$e .= '
			<div class="edit-elements">
				<div class="media-upload-box">
					<a class="media-upload semplice-button image-upload" data-content-id="' . $values['id'] . '" data-upload-type="image">Upload image</a><a class="remove-image remove-media" data-content-id="' . $values['id'] . '" data-media="image"></a>
					<div class="clear"></div>
					<img class="image image-preview" src="' . $image[0] . '">
					<input type="hidden" name="img" class="is-content is-image" value="' . $content . '">
				</div>
			</div>
		';
		
		// display paragraph
		echo $e;
		
		// edit foot
		$this->edit_foot($values);
	}
	
	// gallery edit
	function gallery_edit($content, $values) {
	
		// edit head
		$this->edit_head($values);
		
		//image scale
		$img_scale = array(
			'none' => 'None',
			'full_width' => 'Full Width'
		);
		
		// auto play
		$autoplay = array(
			'true' => 'On',
			'false' => 'Off'
		);
		
		if($values['content_type'] !== 'column-content-gallery') {
			// options head
			echo '<div class="row"><div class="span12 options">';
		} else {
			echo '<div class="options">';
		}

		// options
		$this->get_option('select', 'Image Scale', 'img-scale', 'none', $img_scale, $values);
		
		// seperator
		$this->option_seperator();
		
		// options
		$this->get_option('select', 'Autoplay', 'autoplay', 'true', $autoplay, $values);
		
		// seperator
		$this->option_seperator();
		
		// options
		$this->get_option('text', 'Autoplay timeout between images (in ms)', 'timeout', '4000', $autoplay, $values);
		
		// seperator
		$this->option_seperator();
		
		// close options
		if($values['content_type'] !== 'column-content-gallery') {
			echo '</div></div>';
		} else {
			echo '</div>';
		}
		
		// output
		$e = '';
		
		// content area
		$e .= '
			<div class="edit-elements">
				<ul data-gallery-id="' . $values['id'] . '" class="gallery-images">';
				
				if($content) {
					$images = explode(',', $content);
					foreach($images as $image) {
						$thumbnail = wp_get_attachment_image_src($image, 'thumbnail');
						$e .= '<li id="' . $image . '">';
						$e .= '<a class="remove-gallery-image"></a><img src="' . $thumbnail[0] . '" alt="gallery-image" />';
						$e .= '</li>';
					}
				}
				
				$e .= '
				</ul>
				
				<script type="text/javascript">
					(function ($) {
						$(document).ready(function () {
							/* start sortable */
							$("[data-gallery-id=' . $values['id'] . ']").sortable({
								update: function(event, ui) {
								
									/* get array of ids */
									var sortIDs = $("[data-gallery-id=' . $values['id'] . '] li").map(function () { return this.id; }).get();
									
									/* append ids to val */
									$("#' . $values['id'] . '").find("input[name=gallery]").val(sortIDs);
								}
							});
							/* remove items */
							$("#' . $values['id'] . '").find(".remove-gallery-image").click(function() {
					
								$(this).parent().transition({ opacity: 0 }, 400, "ease", function() {
								
									/* remove item */
									var removeItem = $(this).attr("id");
								
									/* remove from DOM */
									$(this).remove();
									
									/* get array of ids */
									var sortIDs = $("[data-gallery-id=' . $values['id'] . '] li").map(function () { return this.id; }).get();
									
									/* append ids to val */
									$("#' . $values['id'] . '").find("input[name=gallery]").val(sortIDs);
									
								}); 
							
							});
						});
					})(jQuery); 
				</script>
				
				<div class="media-upload-box">
					<a class="media-upload semplice-button image-upload" data-content-id="' . $values['id'] . '" data-upload-type="gallery">Upload image</a><a class="remove-image remove-media" data-content-id="' . $values['id'] . '" data-media="image"></a>
					<div class="clear"></div>
					<input type="hidden" name="gallery" class="is-content is-image" value="' . $content . '">
				</div>
			</div>
		';
		
		// display paragraph
		echo $e;
		
		// edit foot
		$this->edit_foot($values);
	
	}
	
	// video
	function video_edit($content, $values) {

		// output
		$e = '';
	
		// edit head
		$this->edit_head($values);
		
		if($values['content_type'] !== 'column-content-video') {
			// options head
			echo '<div class="row"><div class="span12 options">';
		} else {
			echo '<div class="options">';
		}
		
		// options
		
		$values['options']['video_url'] = $content;
		
		$this->get_option('video', 'Upload Video (or link to file)', 'video_url', '', '', $values);
		
		echo '<div class="clear"></div>';
		
		// close options
		if($values['content_type'] !== 'column-content-video') {
			echo '</div></div>';
		} else {
			echo '</div>';
		}
		
		// display paragraph
		echo $e;
		
		// edit foot
		$this->edit_foot($values);
	}
	
	// audio
	function audio_edit($content, $values) {

		// output
		$e = '';
	
		// edit head
		$this->edit_head($values);
		
		if($values['content_type'] !== 'column-content-audio') {
			// options head
			echo '<div class="row"><div class="span12 options">';
		} else {
			echo '<div class="options">';
		}
		
		// options
		
		$values['options']['audio_url'] = $content;
		
		$this->get_option('audio', 'Upload Audio File (or link to file)', 'audio_url', '', '', $values);
		
		echo '<div class="clear"></div>';
		
		// close options
		if($values['content_type'] !== 'column-content-audio') {
			echo '</div></div>';
		} else {
			echo '</div>';
		}
		
		// display paragraph
		echo $e;
		
		// edit foot
		$this->edit_foot($values);
	}
	
	// oembed
	function oembed_edit($values) {
		
		// edit head
		$this->edit_head($values);
		
		if($values['content_type'] !== 'column-content-oembed') {
			// options head
			echo '<div class="row"><div class="span12 options">';
		} else {
			echo '<div class="options">';
		}
		
		// options
		
		$this->get_option('text', 'oEmbed Link (<a href="https://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">Supported Sites</a>)', 'oembed', 'https://www.youtube.com/watch?v=TwaMFVfXPwA', '', $values);
		
		echo '<div class="clear"></div>';
		
		// close options
		if($values['content_type'] !== 'column-content-oembed') {
			echo '</div></div>';
		} else {
			echo '</div>';
		}
		
		// edit foot
		$this->edit_foot($values);
	}
	
	// spacer
	function spacer_edit($values) {

		// edit head
		$this->edit_head($values);
		
		if($values['content_type'] !== 'column-content-spacer') {
			// options head
			echo '<div class="row"><div class="span12 options">';
		} else {
			echo '<div class="options">';
		}
		
		$width = array(
			'content_width' => 'Content Width',
			'full_width' => 'Full Width'
		);
		
		// options		
		$this->get_option('text', 'Height (0px to just show the margin)', 'height', '1px', '', $values);
		
		// seperator
		$this->option_seperator();
		
		// options		
		$this->get_option('select', 'Width', 'width', 'content_width', $width, $values);
		
		// seperator
		$this->option_seperator();
		
		// options		
		$this->get_option('color', 'Color', 'color', '#ffffff', '', $values);
		
		// seperator
		$this->option_seperator();
		
		// options		
		$this->get_option('text', 'Margin Top', 'margin_top', '64px', '', $values);
		
		// seperator
		$this->option_seperator();
		
		// options		
		$this->get_option('text', 'Margin Bottom', 'margin_bottom', '64px', '', $values);
		
		// seperator
		$this->option_seperator();
		
		// close options
		if($values['content_type'] !== 'column-content-spacer') {
			echo '</div></div>';
		} else {
			echo '</div>';
		}
		
		// edit foot
		$this->edit_foot($values);
	}
	
	// thumbnails
	function thumbnails_edit($values) {

		// edit head
		$this->edit_head($values);

		// title visibility
		$title_visibility = array(
			'visible' => 'Show both title and category', 
			'visible_title' => 'Show title and hide category',
			'hidden' => 'Hide both'
		);
		
		// remove Gutter
		$remove_gutter = array('no' => 'No', 'yes' => 'Yes');
		
		// show fullscreen
		$fluid = array('no' => 'No', 'yes' => 'Yes');
		
		// fwt
		$fwt = array('no' => 'No', 'yes' => 'Yes');
		
		// options
		$this->get_option('select', 'Thumbnail Project Title Visibility ', 'title-visibility', 'visible', $title_visibility, $values);
		
		// seperator
		$this->option_seperator();
		
		// options		
		$this->get_option('color', 'Project Title Color', 'title-color', '#000000', '', $values);
		
		// seperator
		$this->option_seperator();
		
		// options		
		$this->get_option('color', 'Project Category Color', 'category-color', '#999999', '', $values);
		
		// seperator
		$this->option_seperator();
		
		// options
		$this->get_option('select', 'Fluid Grid Layout', 'fluid', 'no', $fluid, $values);

		// seperator
		$this->option_seperator();
		
		// options
		$this->get_option('select', 'Remove Gutter', 'remove-gutter', 'no', $remove_gutter, $values);
		
		// seperator
		$this->option_seperator();
		
		// options
		$this->get_option('select', 'Full Width Thumbnails', 'fwt', 'no', $fwt, $values);
		
		// seperator
		$this->option_seperator();
		
		// edit foot
		$this->edit_foot($values);

	}
	
	// paragraph edit
	function mc_edit($values) {
		
		// edit head
		$this->edit_head($values);

		// remove Gutter
		$remove_gutter = array('no' => 'No', 'yes' => 'Yes');
		
		// show fullscreen
		$show_fullscreen = array('no' => 'No', 'yes' => 'Yes');
		
		// sticky atts
		echo '<div class="sticky-atts-beginn"></div>';
		
		// options
		$this->get_option('select', 'Remove Gutter', 'remove-gutter', 'no', $remove_gutter, $values);
		
		// seperator
		$this->option_seperator();
		
		// options
		$this->get_option('select', 'Fluid Layout', 'show-fullscreen', 'no', $show_fullscreen, $values);
		
		// seperator
		$this->option_seperator();
		
		// row inner background
		$this->get_option('color', 'Row Inner Background', 'row-inner-background', '#ffffff', false, $values);
		
		// content area
		echo '
			<div class="row">
				<div class="span12">
					<div class="edit-elements">
						<div class="add-column-box">
							<a class="add-column semplice-button" data-content-id="' . $this->id . '">Add New Column</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row"><div class="span12"><div class="hr"></div></div></div>
			<div class="row">
				<div class="span12">
					<div class="columns">';
						
						if($this->edit_mode === 'edit') {

							foreach($this->rom['columns'] as $mc_column_id => $mc_columns) {
								
								// add columns
								$this->add_column($mc_column_id, $this->id, $mc_columns['options']['column-width']);
								
								foreach($mc_columns as $mc_content_id => $mc_content) {
									
									// indexes
									if(!isset($mc_content['content_type'])) {
										$mc_content['content_type'] = '';
									}
									
									// values
									$values = array(
										'styles'		=> isset($mc_content['styles']) ? $mc_content['styles'] : '', 
										'options'		=> isset($mc_content['options']) ? $mc_content['options'] : '',
										'style_class'	=> 'is-cc-style', 
										'in_column'		=> true, 
										'id'			=> str_replace('#', '', $mc_content_id),
										'column_id'		=> $mc_column_id,
										'content_type'	=> $mc_content['content_type'],
										'options_class' => 'is-cc-option'
									);

									// edit paragraph
									if($mc_content['content_type'] === 'column-content-p') {
										// add content
										$this->p_edit(stripslashes($mc_content['content']), $values);
									}
									
									// edit image
									if($mc_content['content_type'] === 'column-content-img') {
										// add content
										$this->img_edit($mc_content['content'], $values);
									}
									
									// edit gallery
									if($mc_content['content_type'] === 'column-content-gallery') {
										// add content
										$this->gallery_edit($mc_content['content'], $values);
									}
									
									// edit video
									if($mc_content['content_type'] === 'column-content-video') {
										// add content
										$this->video_edit($mc_content['content'], $values);
									}
									
									// edit audio
									if($mc_content['content_type'] === 'column-content-audio') {
										// add content
										$this->audio_edit($mc_content['content'], $values);
									}
									
									// edit oembed
									if($mc_content['content_type'] === 'column-content-oembed') {
										// add content
										$this->oembed_edit($values);
									}
									
									// edit spacer
									if($mc_content['content_type'] === 'column-content-spacer') {
										// add content
										$this->spacer_edit($values);
									}
									
								}
								
								// show add column footer
								echo $this->add_column_foot;
							}
						}
					echo '
					</div>
				</div>
			</div>
		';
		
		// edit foot
		$this->edit_foot($values);
	}
	
	// add column
	function add_column($column_id, $parent_id, $column_width) {

		// col width
		$col_width = array();
		
		for($i=1; $i<=12; $i++) {
			$col_width['span' . $i] = $i . ' Col';
		}
		
		echo '
			<div id="' . str_replace('#', '', $column_id) . '" class="column" data-sort="1">
				<div class="container nbp fadein ntp">
					<div class="row">
						<div class="span8 offset1">
							<h5 class="semibold column-title">Column</h5>
						</div>
						<div class="span2">
							<div class="column-sort">
								<a class="column-up" data-content-id="' . str_replace('#', '', $column_id) . '"></a>
								<a class="column-down" data-content-id="' . str_replace('#', '', $column_id) . '"></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="span10 offset1">
							<div class="column-content-adder adder">
								<ul class="types">
									<li>
										<a class="remove-column" data-content-id="' . str_replace('#', '', $parent_id) . '" data-column-id="' . str_replace('#', '', $column_id) . '" data-parent-id="' . $parent_id . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Remove</div>
										</div>
									</li>
									<li>
										<a class="add-column-content p" data-content-id="' . str_replace('#', '', $parent_id) . '" data-content-type="column-content-p" data-column-id="' . str_replace('#', '', $column_id) . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add Paragraph</div>
										</div>
									</li>
									<li>
										<a class="add-column-content img" data-content-id="' . str_replace('#', '', $parent_id) . '" data-content-type="column-content-img" data-column-id="' . str_replace('#', '', $column_id) . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add Image</div>
										</div>
									</li>
									<li>
										<a class="add-column-content gallery" data-content-id="' . str_replace('#', '', $parent_id) . '" data-content-type="column-content-gallery" data-column-id="' . str_replace('#', '', $column_id) . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add Gallery</div>
										</div>
									</li>
									<li>
										<a class="add-column-content video" data-content-id="' . str_replace('#', '', $parent_id) . '" data-content-type="column-content-video" data-column-id="' . str_replace('#', '', $column_id) . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add Video</div>
										</div>
									</li>
									<li>
										<a class="add-column-content audio" data-content-id="' . str_replace('#', '', $parent_id) . '" data-content-type="column-content-audio" data-column-id="' . str_replace('#', '', $column_id) . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add Audio</div>
										</div>
									</li>
									<li>
										<a class="add-column-content oembed" data-content-id="' . str_replace('#', '', $parent_id) . '" data-content-type="column-content-oembed" data-column-id="' . str_replace('#', '', $column_id) . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add oEmbed</div>
										</div>
									</li>
									<li>
										<a class="add-column-content spacer" data-content-id="' . str_replace('#', '', $parent_id) . '" data-content-type="column-content-spacer" data-column-id="' . str_replace('#', '', $column_id) . '"></a>
										<div class="tooltip">
											<div class="tt-arrow"></div>
											<div class="tt-text">Add Spacer</div>
										</div>
									</li>
									<li class="adder-last">
										<div class="set-col-width">
											<h4>Width</h4>';
											if(!isset($column_width)) {
												$column_width = 'span6';
											}
											echo '<div class="ce-select-box col-width-box"><select name="column-width" class="is-option select-box">';
											$this->select($col_width, $column_width);
											echo '</select></div>';
										echo '
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="span10 offset1 column-inner">
		';
		
		// is new or edit
		if($this->edit_mode !== 'edit') {
			// show column foot on new content
			echo $this->add_column_foot;
		}
	}
	
	// paragraph view
	function p_view($content, $values) {
		
		$e = '';
		$span = '';
		$offset = '';
		
		// offset
		isset($this->rom['options']['offset']) ? $offset = $this->rom['options']['offset'] : '';
		
		// span
		isset($this->rom['options']['span']) ? $span = $this->rom['options']['span'] : '';
		
		// cs header
		$this->view_head($values);
		$e .= '<div data-content-id="' . $this->id . '" data-paragraph-id="' . $this->id . '" data-content-type="' . $this->content_type . '" class="wysiwyg-ce ' . $offset . ' ' . $span . '">';
		$e .= $content;
		$e .= '</div>';
		
		// display paragraph
		echo $e;
		
		//cs footer
		$this->view_foot($values);
	}
	
	// image view
	function img_view($content, $values) {
		
		$image_link = $values['options']['img-link'];
		$scale = $values['options']['img-scale'];
		$align = $values['options']['img-align'];
		$has_neg_margin = '';
		$neg_margin = '';
		
		$e = '';
				
		if($image_link) {
			$image_link = 'data_is_image_link="true" data_image_link="' . $image_link . '"';
		}
		
		// image id
		$image = wp_get_attachment_image_src($content, 'full');
		
		// image attechment id
		$attachment_id = get_post($content);
		
		// image alt
		$image_alt = get_post_meta($attachment_id->ID, '_wp_attachment_image_alt', true);
		
		// exclude from responsive scaling
		$scaling = $values['options']['responsive-exclude'];
		
		if(!$image_alt) {
			$image_alt = $attachment_id->post_title;
		}

		if($scale === 'full_width' && !$values['in_column']) {
			// set has_container to false
			$values['has_container'] = false;
			// output image container
			$this->view_head($values);
			$e .= '<div class="image full">';
			$e .= do_shortcode('[ceimage class="ce-image" id="' . $content . '" alt="' . $image_alt . '" ' . $image_link . '][/ceimage]');
			$e .= '[ceimage class="live-image" id="' . $content . '" alt="' . $image_alt . '" ' . $image_link . '][/ceimage]';
			$e .= '</div>';
		} elseif (!$values['in_column']) {
			if($image[1] >= 1170) {
				$has_neg_margin = 'has-neg-margin';
				$neg_margin = 'style="margin-left: -' . ($image[1] - 1170) / 2 . 'px;"';
			}
			// output image container
			$this->view_head($values);
			$e .= '<div class="span12 image ' . $scaling . ' ' . $align . ' ' . $has_neg_margin . '">';
			$e .= do_shortcode('[ceimage class="ce-image" ' . $neg_margin . ' id="' . $content . '" alt="' . $image_alt . '" ' . $image_link . '][/ceimage]');
			$e .= '[ceimage class="live-image" ' . $neg_margin . ' id="' . $content . '" alt="' . $image_alt . '" ' . $image_link . '][/ceimage]';
			$e .= '</div>';
		} else {
			// output image container
			$this->view_head($values);
			if($scale === 'full_width') {
				$col_img_scale = 'column-img-full';
			} else {
				$col_img_scale = $scaling;
			}
			$e .= '<div class="column-image ' . $col_img_scale . ' ' . $align . '">';
			$e .= do_shortcode('[ceimage class="ce-image" id="' . $content . '" alt="' . $image_alt . '" ' . $image_link . '][/ceimage]');
			$e .= '[ceimage class="live-image" id="' . $content . '" alt="' . $image_alt . '" ' . $image_link . '][/ceimage]';
			$e .= '</div>';
		}
		
		// output
		echo $e;
		
		// footer
		$this->view_foot($values);
		
	}

	// gallery view
	function gallery_view($content, $values) {
		
		$scale = $values['options']['img-scale'];
		
		$e = '';
		
		if($scale === 'full_width') {
			// output image container
			$values['has_container'] = false;
			$this->view_head($values);
			$e = $this->slider($content, $values);
			echo $e;
			$this->view_foot($values);
		} elseif(!$values['in_column']) {
			// output image container
			$this->view_head($values);
			$e .= '<div class="span12">';
			$e .= $this->slider($content, $values);
			$e .= '</div>';
			echo $e;
			$this->view_foot($values);
		} else {
			// output image container
			$this->view_head($values);
			$e .= $this->slider($content, $values);
			echo $e;
			$this->view_foot($values);
		}
	
	}
	
	// get slider for gallery
	function slider($content, $values) {
				
		$output = '';
		
		$images = explode(',', $content);
		
		// preview image
		$preview = wp_get_attachment_image_src($images[0], 'full');
		
		if($images) { 
			$output .= '<div class="slider-wrapper">';
			$output .= '<div class="is-gallery"></div>';
			$output .= '<div class="gallery-preview"><img src="' . $preview[0] . '" /></div>';
			$output .= '[cegallery id="slider-' . str_replace('#', '', $values['id']) . '" data_timeout="' . $values['options']['timeout'] . '" data_autoplay="' . $values['options']['autoplay'] . '" images="' . $content . '"][/cegallery]';
			$output .= '</div>';
		}
		
		return $output;
	}
	
	// video view
	function video_view($content, $values) {
		
		// output
		$e = '';
		
		$this->view_head($values);
		
		if($values['has_container']) {
			$e = '<div class="span12">';
		}
		
		// get the video url
		$video_url = $content;
		
		// video extension
		$video_ext = $video_url;
		
		// get the string length
		$length = strlen($video_ext);
		
		// extension length
		$ext = 3;
		
		// start with the last 3 chars
		$start = $length - $ext;
		
		// get the video extension
		$video_ext = substr($video_ext, $start ,$ext);
		
		if($video_ext === 'ogv') {
			$video_ext = 'ogg';
		} elseif ($video_ext === 'ebm') {
			$video_ext = 'webm';
		}
		
		// upload, link or embed
		$e .= '<div class="video-edit"><div class="is-video"></div></div>';
		$e .= '<div class="live-video" style="width: 100%; max-width: 100%">';
		$e .= '[cevideo src="' . $content . '" type="video/' . $video_ext . '"][/cevideo]';
		$e .= '</div>';
		
		if($values['has_container']) {
			$e .= '</div>';
		}
		
		echo $e;
		
		// cs footer
		$this->view_foot($values);
	}
	
	// audio view
	function audio_view($content, $values) {
		
		// output
		$e = '';
		
		$this->view_head($values);
		
		if($values['has_container']) {
			$e = '<div class="span12">';
		}
		
		// get the audio url
		$audio_url = $content;
		
		// video extension
		$audio_ext = $audio_url;
		
		// get the string length
		$length = strlen($audio_ext);
		
		// extension length
		$ext = 3;
		
		// start with the last 3 chars
		$start = $length - $ext;
		
		// get the video extension
		$audio_ext = substr($audio_ext, $start ,$ext);
		
		if($audio_ext === 'ogg') {
			$audio_ext = 'ogg';
		} elseif ($audio_ext === 'mp3') {
			$audio_ext = 'mpeg';
		} elseif ($audio_ext === 'wav') {
			$audio_ext = 'wav';
		}
		
		// upload, link or embed
		$e .= '<div class="audio-edit"><div class="is-audio"></div></div>';
		$e .= '<div class="live-audio audio-container" style="width: 100%; max-width: 100%">';
		$e .= '[ceaudio src="' . $content . '" type="audio/' . $audio_ext . '"][/ceaudio]';
		$e .= '</div>';
		
		if($values['has_container']) {
			$e .= '</div>';
		}
		
		echo $e;
		
		// cs footer
		$this->view_foot($values);
	}
	
	// oembed view
	function oembed_view($values) {
		
		$this->view_head($values);
		
		if($values['has_container']) {
			$e = '<div class="span12 responsive-video">';
		} else {
			$e = '<div class="responsive-video">';
		}
		
		// get the audio url
		$url = $values['options']['oembed'];

		//$htmlcode = wp_oembed_get($url);
		
		$e .= '<div class="oembed-edit"><div class="is-oembed"></div></div>';
		$e .= '<div class="oembed-content">[embed]' . $url . '[/embed]</div>';
		
		$e .= '</div>';
		
		echo $e;
		
		// cs footer
		$this->view_foot($values);
	}
	
	// hr
	function spacer_view($values) {	
		if($values['options']['width'] === 'content_width' && !$values['in_column']) {
		
			$this->view_head($values);
			$e = '<div class="spacer span12" style="' . $this->hr_styles($values) . '"><!-- Horizontal Rule --></div>';
			echo $e;
			$this->view_foot($values);
		} else {
			$values['has_container'] = false;
			$this->view_head($values);
			$e  = '<div class="hr-container" style="">';
			$e .= '<div class="spacer spacer-full-width" style="' . $this->hr_styles($values) . '"><!-- Horizontal Rule --></div>';
			$e .= '</div>';
			echo $e;
			$this->view_foot($values);
		}
	}
	
	// thumbnails view
	function thumbnails_view($values) {

		// output
		$e = '';
	
		// is fluid?
		$values['has_container'] = false;
	
		// cs header
		$this->view_head($values);
		
		// hidden shortcode
		$e .= '<div class="thumbs-content">[thumbnails masonryid="' . $values['id'] . '" styles="' . implode(', ', $values['styles']) . '" titlevisibility="' . $values['options']['title-visibility'] . '" titlecolor="' . $values['options']['title-color'] . '" categorycolor="' . $values['options']['category-color'] . '" fluid="' . $values['options']['fluid'] . '" removegutter="' . $values['options']['remove-gutter'] . '" fwt="' . $values['options']['fwt'] . '"][/thumbnails]</div>';
		
		// live view shortcode
		$e .= '<div class="container"><div class="row"><div class="span12"><div class="thumbnails-edit"><div class="is-thumbnails"></div></div></div></div></div>';
		
		// display paragraph
		echo $e;
		
		//cs footer
		$this->view_foot($values);
	}

	// horizontal rule styles
	function hr_styles($values) {
		
		$css = '';
		
		if($values['options']['height']) {
			$css .= 'height:' . $values['options']['height'] . ';';
		}
		if($values['options']['margin_top']) {
			$css .= 'margin-top:' . $values['options']['margin_top'] . ';';
		}
		if($values['options']['margin_bottom']) {
			$css .= 'margin-bottom:' . $values['options']['margin_bottom'] . ';';
		}
		if($values['options']['color']) {
			$css .= 'background-color:' . $values['options']['color'] . ';';
		}
		
		return $css;
	}
}
?>