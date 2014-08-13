<?php
/*
 * shortcodes
 * semplice.theme
 */

// image shortcode
function ceimage_func($options) {

	//vars
	$e = '';
	$image_link = '';
	$neg_margin = '';

	// get image src
	$image_src = wp_get_attachment_image_src($options['id'], 'full');

	// has image link?
	if(isset($options['data_image_link'])) {
		$image_link = 'data-is-image-link="true" data-image-link="' . $options['data_image_link'] . '"';
	}
	
	// has neg margin?
	if(isset($options['style'])) {
		$neg_margin = 'style="' . $options['style'] . '"';
	}

	$e .= '<img class="' . $options['class'] . '" src="' . $image_src[0] . '" alt="' . $options['alt'] . '" ' . $image_link . ' ' . $neg_margin . ' />';
	
	return $e;
}

// video shortcode
function cevideo_func($options) {
	
	//output
	$e = '';

	$e .= '<video class="video" style="max-width: 100%;" preload="none">';
	$e .= '<source src="' . $options['src'] . '" type="' . $options['type'] . '">';
	$e .= '<p>If you are reading this, it is because your browser does not support the HTML5 video element.</p>';
	$e .= '</video>';
	
	return $e;
}

// audio shortcode
function ceaudio_func($options) {

	//output
	$e = '';

	$e .= '<audio class="audio" style="max-width: 100%;" preload="none">';
	$e .= '<source src="' . $options['src'] . '" type="' . $options['type'] . '">';
	$e .= '<p>If you are reading this, it is because your browser does not support the HTML5 audio element.</p>';
	$e .= '</audio>';
	
	return $e;
}

// Gallery
function cegallery_func($options) {

	//output
	$e = '';

	$e .= '<ul class="slider" id="' . $options['id'] . '" data-timeout="' . $options['data_timeout'] . '" data-autoplay="' . $options['data_autoplay'] . '">';
	
	$images = explode(',', $options['images']);
	
	foreach($images as $image) {
	
		$img = wp_get_attachment_image_src($image, 'full');
		
		$e .= '<li>';
		$e .= '<img src="' . $img[0] . '" alt="gallery-image" />';
		$e .= '</li>';
	}
	
	$e .= '</ul>';
	
	return $e;
}

// Thumbnails Shortcode
function thumbnails_func($options){
	require get_template_directory() . '/includes/thumbnails.php';
	return $e;
}

add_shortcode( 'thumbnails', 'thumbnails_func' );
add_shortcode( 'ceimage', 'ceimage_func' );
add_shortcode( 'cevideo', 'cevideo_func' );
add_shortcode( 'ceaudio', 'ceaudio_func' );
add_shortcode( 'cegallery', 'cegallery_func' );

?>