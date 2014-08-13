<?php
	
	// include content class
	include(get_template_directory() . '/content-editor/class.editor.php');
	 
	// content class
	$editor = new editor();
	
	// vars
	$thumbs = '';
	$index = 0;
	$is_fluid = filter_var($options['fluid'], FILTER_VALIDATE_BOOLEAN);
	$is_fwt  = filter_var($options['fwt'], FILTER_VALIDATE_BOOLEAN);
	$remove_gutter = filter_var($options['removegutter'], FILTER_VALIDATE_BOOLEAN);
	$hide_title = false;

	// title and category color
	if($options['titlevisibility'] === 'visible') {
		$title_color = 'style="color:' . $options['titlecolor'] . ';"';
		$category_color = 'style="color:' . $options['categorycolor'] . ';"';
		$margin_fix = 'style="margin-bottom: 30px !important"';
	} elseif($options['titlevisibility'] === 'visible_title') {
		$title_color = 'style="color:' . $options['titlecolor'] . ';"';
		$category_color = 'style="display: none;"';
		$margin_fix = 'style="margin-bottom: 30px !important"';
	} else {
		$margin_fix = 'style="line-height: 0 !important; font-size: 0 !important;"';
		$hide_title = true;
	}

	// is remove gutter?
	if($remove_gutter) {
		$pre = 'no-gutter-';
		$thumb_class = 'remove-gutter-yes masonry-span';
	} else {
		$pre = '';
		$thumb_class = 'span';
	}

	$e = '';

	$e .= '<section id="thumbnails">';

	// query args
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'work'
	);

	// pass args
	$query = new WP_Query( $args );

	// query posts and get thumbnails
	if ( $query->have_posts() ) {	
		while ( $query->have_posts() ) {
			$query->the_post();
			
			// is fwt?
			if($is_fwt) {
				
				// get fwt styles
				if($is_fwt) {
					$styles = array();
					$styles['background-color'] = get_field('background_color');
					$styles['background-image'] = get_field('background_image');
					$styles['background-size'] = get_field('background_scale');
					$styles['background-repeat'] = get_field('background_repeat');
					$styles['border-bottom'] = get_field('border_bottom');
				}
				
				//fwt header
				$e .= '<a href="' . get_permalink() . '" class="fwt-link" title="' . get_the_title() . '">';
				$e .= '<div class="fwt" style="' . $editor->container_styles($styles) . ' padding: 0px !important;">';
				$e .= '<div class="container">';
				$e .= '<div class="row">';
			
				// title format
				if(get_field('fwt_title_format') === 'image') {
					if(get_field('fwt_image')) {
						// get fwt thumbnail
						$image = wp_get_attachment_image_src(get_field('fwt_image'), 'full');
						$e .= '<div class="span12 fwt-solo-img"><img class="middle" src="' . $image[0] . '" /></div>';
					}
				} else {
					if(filter_var(get_field('fwt_hide_title'), FILTER_VALIDATE_BOOLEAN) === FALSE) {
						$e .= '<div class="fwt-inner span12 ' . get_field('fwt_title_hor') . ' ' . get_field('fwt_title_ver') . '">';
						$e .= '<h2 class="' . get_field('fwt_title_weight') . '" style="color: ' . get_field('fwt_title_color') . ' !important;">' . get_the_title();
						$e .= '<span class="secondary" style="display: block; color: ' . get_field('fwt_category_color') . ' !important;">' . get_field('category') . '</span>';
						$e .= '</h2></div>';
					}
				}
				
				// fwt footer
				$e .= '</div></div></div></a>';
				
			} else {
				// get thumbnail
				$thumbnail = wp_get_attachment_image_src(get_field('thumbnail_image'), 'full');
				
				#---------------------------------------------------------------------------#
				# Hover																		#
				#---------------------------------------------------------------------------#

				$hover_background = '';
				$hover_h3 = '';
				$hover_h3_span = '';
				
				if(get_field('custom_hover') !== 'enabled') {
					$thumb_options = 'options';
				} else {
					$thumb_options = '';
				}	

				if(get_field('hover_bg_color', $thumb_options)) {
					$rgba = HexToRGB(get_field('hover_bg_color', $thumb_options));
					$hover_background .=  'background-color: rgb(' . $rgba['r'] . ', ' . $rgba['g'] . ', ' . $rgba['b'] . ') !important; background-color: rgba(' . $rgba['r'] . ', ' . $rgba['g'] . ', ' . $rgba['b'] . ', ' . get_field('hover_bg_opacity', $thumb_options) . ') !important;';
				}

				if(get_field('hover_bg_image', $thumb_options)) {
					$hover_h3 .= 'display: none;';
					$hover_background .= 'background-image: url(' . get_field('hover_bg_image', $thumb_options) . '); background-repeat: no-repeat; background-position: center center; !important;';
				}

				if(get_field('hover_title_color', $thumb_options)) {
					$hover_h3 .= 'color: ' . get_field('hover_title_color', $thumb_options) . ' !important;';
				}

				if(get_field('hover_category_color', $thumb_options)) {
					$hover_h3_span .= 'color: ' . get_field('hover_category_color', $thumb_options) . ' !important;';
				}

				if(get_field('hover_title_visibility', $thumb_options) === 'hide_both') {
					$hover_h3 .= 'display: none;';
				} elseif(get_field('hover_title_visibility', $thumb_options) === 'hide_category') {
					$hover_h3_span .= 'display: none !important;';
				}
				
				// font-weight title
				if(get_field('hover_title_font_weight', $thumb_options)) {
					$title_weight = get_field('hover_title_font_weight', $thumb_options);
				} else {
					$title_weight = 'light';
				}
				
				// font-weight category
				if(get_field('hover_category_font_weight', $thumb_options)) {
					$category_weight = get_field('hover_category_font_weight', $thumb_options);
				} else {
					$category_weight = 'light';
				}
				
				// string for jquery masonry
				$thumbs .= '<div ' . $margin_fix . ' class="thumb thumb-' . $index . ' masonry-item ' . $thumb_class . get_field('thumbnail_width') . '" data-thumb-src="' . $thumbnail[0] . '">';
				$thumbs .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
				$thumbs .= '<div class="thumb-inner">';
				$thumbs .= '<div class="thumb-hover" style="' . $hover_background . '"><h3 class="' . $title_weight . '" style="' . $hover_h3 . '">' . get_the_title() . '<br /><span class="' . $category_weight . '" style="' . $hover_h3_span . '">' . get_field('category') . '</span></h3></div>';
				if($thumbnail) {
					$thumbs .= '<img alt="thumbnail" src="' . $thumbnail[0] . '" width="500" height="500" />';
				} else {
					$thumbs .= '<img alt="thumbnail" height="500" src="' . get_bloginfo('template_directory') . '/images/no_thumb.png" />';
				}
				$thumbs .= '</div>';
				if(!$hide_title) {
					$thumbs .= '<h3 ' . $title_color . '>' . get_the_title() . '<br /><span ' . $category_color . '>' . get_field('category') . '</span></h3>';
				}
				$thumbs .= '</a>';
				$thumbs .= '</div>';
				
				$index ++;
				
			}
		}
	}

	// if normal thumbs append items to jquery
	if(!$is_fwt) {
		
		// masrony id
		$masonry = '#masonry-thumbs';
		
		// fit width
		$fit_width = '';
		
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
		
		// output masonry container
		$e .= '<div id="masonry-thumbs" ' . $container_class . '>';
		
		if($is_fluid && !$remove_gutter) {
			// masonry inner
			$e .= '<div class="masonry-full-inner">';
		}
		
		// remove gutter
		if($remove_gutter) {
			$e .= '<div class="no-gutter-grid-sizer"></div>';
			$e .= '<div class="no-gutter-gutter-sizer"></div>';
		} else {
			$e .= '<div class="grid-sizer"></div>';
			$e .= '<div class="gutter-sizer"></div>';
		}
		
		// close masonry inner
		if($is_fluid && !$remove_gutter) {
			$e .= '</div>';	
		}

		// index
		$index = $index - 1;
		
		// close masonry container
		$e .= '</div>';
		
		// thumb container
		$e .= '<div id="thumbsHolder">' . $thumbs . '</div>';

		// javascript
		$e .= '
		<script type="text/javascript">
			(function ($) {
				$(document).ready(function () {
					
					/* init masonry */
					var $container = $("' . $masonry . '");
					$container.masonry({
						itemSelector: ".thumb",
						columnWidth: ".' . $pre . 'grid-sizer",
						gutter: ".' . $pre . 'gutter-sizer",
						transitionDuration: 0,
						isResizable: true,
						' . $fit_width . '
					});
					
					/* masonry data */
					var msnry = $container.data("masonry");
					
					/* get thumbs */
					$thumbs = $("#thumbsHolder").find(".thumb");
					
					/* remove thumbHolder */
					$("#thumbsHolder").remove();
					
					/* append thumbs to the masonry container */
					$("' . $masonry . '").append( $thumbs );
					
					var index = 0;
					var size = ' . $index . ';

					function loadThumb(index) {
						$(".thumb-" + index).find("img").imagesLoaded().done(function() {
							if(index <= size) {
								msnry.appended($(".thumb-" + index));
								$(".thumb-" + index).css("opacity", 1);
								loadThumb(index + 1);
							}
						});
					}
					
					/* add thumbs to masonry */
					loadThumb(index);
				});
			})(jQuery);
		</script>
		';
	} else {
		// fade in fwt
		$e .= '<script type="text/javascript">(function($){$(document).ready(function(){$(".fwt").showdelay($(".fwt").length);});})(jQuery);</script>';
	}

	// close section
	$e .= '</section>';

	// output
	return $e;
		
	// reset postdata
	wp_reset_postdata();
?>