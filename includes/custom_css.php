<?php
/*
 * custom css
 * semplice.theme
 * 
 */
 
// output css var
$output_css = ''; 
 
#---------------------------------------------------------------------------#
# Custom Header																#
#---------------------------------------------------------------------------#
 
if(get_field('cover_visibility') === 'visible') {
	
	if(get_field('cover_bg_color')) {
		$output_css .= '#fullscreen-cover, .cover-image { background-color: ' . get_field('cover_bg_color') . '!important; }';
	}
	// is image or video
	if(get_field('cover_bg_type') === 'image') {
		if(get_field('cover_bg_image')) {
			$output_css .= '.cover-image { background-image: url(' . get_field('cover_bg_image') . '); }';
			$output_css .= '.cover-image { opacity: '. get_field('cover_bg_image_opacity') .'; }';
			$output_css .= '.cover-image { background-repeat: ' . get_field('cover_bg_image_repeat') . ' !important; }';
			
			if(get_field('cover_bg_image_scale') === 'full-screen') {
				$output_css .= '.cover-image { background-size: cover; }';
			} else if(get_field('cover_bg_image_repeat') !== 'no-repeat') {
				$output_css .= '.cover-image { background-size: auto !important; }';
			}
			if(get_field('cover_bg_image_align')) {
				$output_css .= '.cover-image { background-position: ' . get_field('cover_bg_image_align') . '; }';
			} else {
				$output_css .= '.cover-image { background-position: top center; }';
			}
		}
	} else {
		$output_css .= '.cover-video-responsive { background-image: url(' . get_field('video_fallback_bg') . '); }';
		$output_css .= '.cover-video-responsive { background-position: 50% 0; }';
		if(get_field('cover_video_opacity')) {
			$output_css .= '.cover-video { opacity: '. get_field('cover_video_opacity') . '}';
			$output_css .= '#fullscreen-cover { background: '. get_field('cover_bg_color') . '}';
		}
	}
		
	if(get_field('cover_headline_color')) {
		$output_css .= '.cover-headline h1 { color: '. get_field('cover_headline_color') . '!important; }';
	}
	
	if(get_field('cover_headline_fontsize')) {
		$font_size = get_field('cover_headline_fontsize');
		cover_heading_fontsize($font_size);
	}
	
	if(get_field('cover_headline_text_transform')) {
		$output_css .= '.title h1 { text-transform: '. get_field('cover_headline_text_transform') . '!important; }';
	}

	if(get_field('loader_bar_color')) {
		$output_css .= '.bar { background: ' . get_field('loader_bar_color') . '!important; }';
	}
	
	if(get_field('cover_scroll') === 'visible') {
		if(get_field('cover_scroll_text_color')) {
			$output_css .= '.see-more .text { color: ' . get_field('cover_scroll_text_color') . '!important; }';
		}
		if(get_field('cover_scroll_color')) {
			$output_css .= '.see-more .icon svg polyline { stroke: ' . get_field('cover_scroll_color') . '!important; }';
		}
	}

}
#---------------------------------------------------------------------------#
# Custom Navbar																#
#---------------------------------------------------------------------------#

// get custom navbar post object
if(get_field('custom_navbar')) {
	$custom_navbar = get_field('custom_navbar');
} else if(get_field('so_custom_navbar', 'options')) {
	$custom_navbar = get_field('so_custom_navbar', 'options');
} else {
	$custom_navbar = '';
}

// hex to rgb
function HexToRGB($hex) {
	$hex = str_replace("#", "", $hex);
	$color = array();
	 
	if(strlen($hex) == 3) {
		$color['r'] = hexdec(substr($hex, 0, 1) . $r);
		$color['g'] = hexdec(substr($hex, 1, 1) . $g);
		$color['b'] = hexdec(substr($hex, 2, 1) . $b);
	}
	else if(strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}
	 
	return $color;
}

if($custom_navbar) {
	
	$post = $custom_navbar;
    setup_postdata($post);
	
	// navbar output
	$output_navbar = '';

	if(get_field('navbar_bar_bg_color')) {
		$output_navbar .= '#navbar-bg { background: ' . get_field('navbar_bar_bg_color') . '!important; }';
	}
	
	if(get_field('menu_bg_color')) {
		$rgba = HexToRGB(get_field('menu_bg_color'));
		$output_navbar .= '#fullscreen-menu { background: rgb(' . $rgba['r'] . ', ' . $rgba['g'] . ', ' . $rgba['b'] . '); background: rgba(' . $rgba['r'] . ', ' . $rgba['g'] . ', ' . $rgba['b'] . ', ' . get_field('menu_bg_opacity') . '); }';
	}
	
	$output_navbar .= '#navbar-bg { opacity: ' . get_field('navbar_bar_bg_opacity') . '; }';
	
	if(get_field('navbar_bar_border_bottom_color')) {
		$output_navbar .= '#navbar { border-bottom: 1px solid ' . get_field('navbar_bar_border_bottom_color') . '!important; }';
	}	
	
	if(get_field('navbar_transparent')) {
		$output_navbar .= '.transparent { opacity: 0 !important; }';
		$output_navbar .= '@media (max-width: 767px) {';
		$output_navbar .= '.transparent { background: ' . get_field('navbar_bar_bg_color') . '!important; }';
		$output_navbar .= '}';
	}

	if(get_field('navbar_bar_menu_button_color')) {
		$output_navbar .= 'div.controls a, .search-button svg { fill: ' . get_field('navbar_bar_menu_button_color') . '!important; }';
		$output_navbar .= 'span.close, .archives-button svg path, .archives-button svg line { stroke: ' . get_field('navbar_bar_menu_button_color') . '!important; }';
	}
	
	if(get_field('menu_link_color')) {
		$output_navbar .= '#fullscreen-menu .menu-inner nav ul li a, .follow-links ul li a svg, nav.standard ul li a { color: ' . get_field('menu_link_color') . '!important; }';
		$output_navbar .= '.follow-links ul li a svg { fill: ' . get_field('menu_link_color') . '!important; }';
	}
	
	if(get_field('menu_hover_color')) {
		$output_navbar .= '#fullscreen-menu .menu-inner nav ul li a:hover, .follow-links ul li a svg, nav.standard ul li a:hover { color: ' . get_field('menu_hover_color') . '!important; }';
		$output_navbar .= '.follow-links ul li a:hover svg { fill: ' . get_field('menu_hover_color') . '!important; }';
	}
	
	if(get_field('menu_hover_bg_color')) {
		$output_navbar .= '#fullscreen-menu .menu-inner nav ul li a:hover { background: ' . get_field('menu_hover_bg_color') . '!important; }';
	}
	
	if(get_field('menu_border_bottom')) {
		$output_navbar .= '#fullscreen-menu .menu-inner nav ul li a { border-color: ' . get_field('menu_border_bottom') . '!important; }';
	}
	
	// standard menu fontsize
	if(get_field('standard_menu_fontsize')) {
		$output_css .= 'nav.standard ul li a { font-size: ' . get_field('standard_menu_fontsize') . ' !important; }';
	}
	
	// is sticky?
	if(get_field('sticky_navbar') === 'normal') {
		$output_css .= 'header { position: absolute; }';
	}
	
	// get logo height and define header height
	if (get_field('logo_format') !== 'text') {
		if(get_field('logo_format') === 'svg') {
			if(get_field('navbar_padding') === 'fourty') {
				$header_height = get_field('logo_svg_height') + 80; #40 top and 40 bottom padding
			} else {
				$header_height = get_field('logo_svg_height') + 40;
			}
			$menu_icon_margin = $header_height / 2 - 12;
			$output_navbar .= '.logo svg { fill: ' . get_field('logo_svg_color') . ' !important; }';
		}else if(get_field('logo_format') === 'image') {
			$logo = wp_get_attachment_image_src(get_field('logo_img_upload'), 'full');
			if(get_field('navbar_padding') === 'fourty') {
				$header_height = $logo[2] + 80;
			} else {
				$header_height = $logo[2] + 40;
			}
			
			$menu_icon_margin = $header_height / 2 - 12;
		}
		$output_navbar .= 'header { top: -' . $header_height . 'px; }';
		$output_navbar .= '#fullscreen-menu { top: ' . $header_height . 'px; }';
		$output_navbar .= '#navbar, #navbar-bg, .controls a, .controls a span { height: ' . $header_height . 'px; }';
		$output_navbar .= '.controls a svg, div.header-icon { margin-top: ' . round($menu_icon_margin) . 'px; }';
		$output_navbar .= '#content { margin-top: ' . $header_height . 'px !important; }';
		$output_navbar .= '#fullscreen-cover { margin-top: -' . $header_height . 'px !important; }';
		$output_navbar .= '.menu-style-nobutton ul li a, nav.standard ul li a { line-height: ' . $header_height . 'px !important; }';
		$output_navbar .= '.title-top { top: ' . $header_height . 'px; }';
	} else {
		smp_text_logo();
	}
	// output
	echo $output_navbar;
} else {
	smp_text_logo();
}
// reset postdata
wp_reset_postdata();

#---------------------------------------------------------------------------#
# Text Logo																	#
#---------------------------------------------------------------------------#

function smp_text_logo() {
	
	$output_textlogo = '';
	
	if(get_field('logo_text_color')) {
		$output_textlogo .= 'div.logo a { color: ' . get_field('logo_text_color') . '!important; }';
	}
	$output_textlogo .= 'header { top: -70px; }';
	$output_textlogo .= '#fullscreen-menu { top: 70px; }';
	$output_textlogo .= '#navbar, .controls a, div.loader, div.header-icon, #navbar-bg, .controls a span { height: 70px !important; }';
	$output_textlogo .= 'div.logo h1 { line-height: 70px !important; }';
	$output_textlogo .= '.controls a svg, div.header-icon { margin-top: 23px !important; }';
	$output_textlogo .= '#content { margin-top: 70px !important; }';
	$output_textlogo .= '#fullscreen-cover { margin-top: -70px !important; }';
	$output_textlogo .= '.menu-style-nobutton ul li a, nav.standard ul li a { line-height: 70px !important; }';
	$output_textlogo .= '.title-top { top: 70px; }';
	$output_textlogo .= '.logo svg { margin-top: 24px; }';
	
	echo $output_textlogo;
}


#---------------------------------------------------------------------------#
# Custom Title Fontsize														#
#---------------------------------------------------------------------------#

function cover_heading_fontsize($font_size) {
	// 1170px
	$output_titlesize = '';
	$output_titlesize .= '.cover-headline h1 { font-size: '. $font_size . 'px !important; line-height: '. ($font_size + 15) . 'px !important; }';
	$output_titlesize .= '';
	// 940px
	$output_titlesize .= '@media (min-width: 980px) and (max-width: 1199px) {';
	$output_titlesize .= '.cover-headline h1 { font-size: '. ($font_size / 1.5) . 'px !important; line-height: '. ($font_size / 1.3) . 'px !important; }';
	$output_titlesize .= '}';
	// 768-979px
	$output_titlesize .= '@media (min-width: 768px) and (max-width: 979px) {';
	$output_titlesize .= '.cover-headline h1 { font-size: '. ($font_size / 1.7) . 'px !important; line-height: '. ($font_size / 1.4) . 'px !important; }';
	$output_titlesize .= '}';
	// 767 (tablet)
	$output_titlesize .= '@media (max-width: 767px) {';
	$output_titlesize .= '.cover-headline h1 { font-size: '. ($font_size / 2.6) . 'px !important; line-height: '. ($font_size / 2.2) . 'px !important; }';
	$output_titlesize .= '}';
	// mobile
	$output_titlesize .= '@media (max-width: 567px) {';
	$output_titlesize .= '.cover-headline h1 { font-size: '. ($font_size / 3.4) . 'px !important; line-height: '. ($font_size / 3) . 'px !important; }';
	$output_titlesize .= '}';
	
	echo $output_titlesize;
	
}

#---------------------------------------------------------------------------#
# Project Panel															#
#---------------------------------------------------------------------------#

if(get_post_type($post->ID) === 'work') {
	
	// thumbnav css
	if(get_field('project_panel_background', 'options')) {
		$output_css .= '.project-panel { background: ' . get_field('project_panel_background', 'options') . ' !important; }';
	}
	
	if(get_field('project_panel_title_color', 'options')) {
		$output_css .= '.project-panel h3 { color: ' . get_field('project_panel_title_color', 'options') . ' !important; }';
		$output_css .= 'div.close-project-panel svg { stroke: ' . get_field('project_panel_title_color', 'options') . ' !important; }';
	}
	
	if(get_field('project_panel_link_color', 'options')) {
		$output_css .= '.project-panel-thumb h3 { color: ' . get_field('project_panel_link_color', 'options') . ' !important; }';
	}
	
	if(get_field('project_panel_category_color', 'options')) {
		$output_css .= '.project-panel-thumb h3 span { color: ' . get_field('project_panel_category_color', 'options') . ' !important; }';
	}
	
	if(get_field('project_panel_title_visibility', 'options') !== 'visible') {
		$output_css .= '.project-panel-title h3 { opacity: 0; }';
	}
}

#---------------------------------------------------------------------------#
# Sharebox																	#
#---------------------------------------------------------------------------#

if(get_post_type($post->ID) === 'post') {
	$share_options = 'options';
} else {
	$share_options = '';
}

// share bg color
if(get_field('share_bg_color')) {
	$output_css .= '.share-box { background: ' . get_field('share_bg_color') . ' !important; }';
}

// share button bg color
if(get_field('share_button_bg_color', $share_options)) {
	$output_css .= '.semplice-share .text { background: ' . get_field('share_button_bg_color', $share_options) . ' !important; }';
}

// share text color
if(get_field('share_button_text_color', $share_options)) {
	$output_css .= '.semplice-share .text { color: ' . get_field('share_button_text_color', $share_options) . ' !important; }';
}

// share button border color
if(get_field('share_button_border_color', $share_options)) {
	$output_css .= '.share-box .semplice-share .text { border-color: ' . get_field('share_button_border_color', $share_options) . ' !important; }';
}

#---------------------------------------------------------------------------#
# Theme Options																#
#---------------------------------------------------------------------------#

// default text color
if(get_field('skinoptions_text_color', 'options')) {
	$output_css .= '.wysiwyg, .wysiwyg p, .wysiwyg pre, .post-heading h2, p.quote, .wysiwyg h1, .wysiwyg h2, .wysiwyg h3, .wysiwyg h4, .wysiwyg h5, .wysiwyg h6, #category-archives h4, h4#comments, .comment-autor, .comment-autor a, .comment-time, .comment-content p, h3#reply-title, .comments-pagination, .meta p a, section#comment h3#comments, .no-results, blockquote p, .quote-container p { color: ' . get_field('skinoptions_text_color', 'options') . '!important ;}';
	$output_css .= '.archives-close svg { stroke: ' . get_field('skinoptions_text_color', 'options') . '!important ;}';
	$output_css .= 'abbr, acronym { border-color: ' . get_field('skinoptions_text_color', 'options') . '!important;}';
}

// default link color
if(get_field('skinoptions_link_color', 'options')) {
	$output_css .= '#post .wysiwyg  a, #post .wysiwyg p a, p.quote a, .next p a, .previous p a, a.page-numbers, #category-archives nav ul li a { color: ' . get_field('skinoptions_link_color', 'options') . '!important ;}';
	$output_css .= '#post .wysiwyg { border-color: ' . get_field('skinoptions_link_color', 'options') . '!important ;}';
	// make share buttons white again 
	$output_css .= '#post .semplice-share .button a { color: white !important; }';
}

// default hover color
if(get_field('skinoptions_hover_color', 'options')) {
	$output_css .= '#post .wysiwyg a:hover, #post .wysiwyg p a:hover, .post-heading p a:hover, p.quote a:hover, #post .wysiwyg a.more-link:hover, .description a.more-link:hover, .next p a:hover, .previous p a:hover, #category-archives nav ul li a:hover, a.comment-edit-link:hover, a.comment-reply-link:hover, a.page-numbers:hover, section#category-archives nav ul li a:hover { color: ' . get_field('skinoptions_hover_color', 'options') . '!important ;}';
	// make share buttons white again 
	$output_css .= '#post .semplice-share .button a:hover { color: white !important; }';
}

// heading color
if (get_field('skinoptions_heading_color', 'options')) {
	$output_css .= '.post-heading h2 a, .result-header h3, #category-archives h2 { color: ' . get_field('skinoptions_heading_color', 'options') . '!important ;}';
}

// default heading subline color
if(get_field('skinoptions_heading_color_subline', 'options')) {
	$output_css .= '.post-heading p, .post-heading p a { color: ' . get_field('skinoptions_heading_color_subline', 'options') . '!important ;}';
}

/*
if(get_field('blog_bg_color', 'options') && get_post_type($post->ID) === 'post') {
	$output_css .= 'body.blog-bg { background-color: ' . get_field('blog_bg_color', 'options') . ' !important;}';
}
*/

// blog comments bg color
if(get_field('blog_comments_bg', 'options')) {
	$output_css .= '#comment { background-color: ' . get_field('blog_comments_bg', 'options') . ' !important;}';
}

// blog comments textarea bg color
if(get_field('blog_comments_input_bg', 'options')) {
	$output_css .= 'form#commentform textarea, form#commentform input { background-color: ' . get_field('blog_comments_input_bg', 'options') . ' !important;}';
}

if(get_field('blog_comments_input_text_color', 'options')) {
	$output_css .= 'form#commentform #submit, form#commentform input, form#commentform textarea { color: ' . get_field('blog_comments_input_text_color', 'options') . '!important; }';
	$output_css .= 'form#commentform textarea::-webkit-input-placeholder { color: ' . get_field('blog_comments_input_text_color', 'options') . '!important; opacity: .5 !important;}';
	$output_css .= 'form#commentform textarea::-moz-placeholder { color: ' . get_field('blog_comments_input_text_color', 'options') . '!important; opacity: .5 !important;}';
	$output_css .= 'form#commentform textarea:-ms-input-placeholder { color: ' . get_field('blog_comments_input_text_color', 'options') . '!important; opacity: .5 !important;}';
	$output_css .= 'form#commentform textareainput:-moz-placeholder { color: ' . get_field('blog_comments_input_text_color', 'options') . '!important; opacity: .5 !important;}';
	$output_css .= 'form#commentform input::-webkit-input-placeholder { color: ' . get_field('blog_comments_input_text_color', 'options') . '!important; opacity: .5 !important;}';
	$output_css .= 'form#commentform input::-moz-placeholder { color: ' . get_field('blog_comments_input_text_color', 'options') . '!important; opacity: .5 !important;}';
	$output_css .= 'form#commentform input:-ms-input-placeholder { color: ' . get_field('blog_comments_input_text_color', 'options') . '!important; opacity: .5 !important;}';
	$output_css .= 'form#commentform inputinput:-moz-placeholder { color: ' . get_field('blog_comments_input_text_color', 'options') . '!important; opacity: .5 !important;}';
}

// blog comments border color
if(get_field('blog_comments_input_border', 'options')) {
	$output_css .= 'form#commentform textarea, form#commentform input { border-color: ' . get_field('blog_comments_input_border', 'options') . ' !important;}';
}

// read more text color
if(get_field('skinoptions_blog_read_more_text_color', 'options')) {
	$output_css .= '#post .wysiwyg a.more-link, .description a.more-link { color: ' . get_field('skinoptions_blog_read_more_text_color', 'options') . '!important; }';
}

// read more button border color
if(get_field('skinoptions_blog_read_more_border_color', 'options')) {
	$output_css .= '#post .wysiwyg a.more-link, .description a.more-link { border-color: ' . get_field('skinoptions_blog_read_more_border_color', 'options') . '!important ;}';
}

// reply buttons text color
if(get_field('skinoptions_blog_reply_text_color', 'options')) {
	$output_css .= '.edit-reply a { color: ' . get_field('skinoptions_blog_reply_text_color', 'options') . '!important ;}';
}

// reply buttons border color
if(get_field('skinoptions_blog_reply_border_color', 'options')) {
	$output_css .= '.edit-reply a { border-color: ' . get_field('skinoptions_blog_reply_border_color', 'options') . '!important ;}';
}

// post divider color
if (get_field('skinoptions_hr_color', 'options')) {
	$output_css .= '.post-divider { background: ' . get_field('skinoptions_hr_color', 'options') . '!important ;}';
	$output_css .= '.post-password-form input, .result-header, #category-archives h4, .comment-content, pre, tt, code, kbd, blockquote, .wysiwyg table, .description table, .wysiwyg-ce table , .wysiwyg table th, .wysiwyg table td, .description table th, .description table td, .wysiwyg-ce table th, .wysiwyg-ce table td { border-color: ' . get_field('skinoptions_hr_color', 'options') . '!important ;}';
}

// blog searchbox background
if (get_field('skinoptions_blog_search_bg_color', 'options')) {
	$output_css .= '.search-field { background: ' . get_field('skinoptions_blog_search_bg_color', 'options') . '!important ;}';
}

// blog searchbox border-color
if (get_field('skinoptions_blog_search_border_color', 'options')) {
	$output_css .= '.search-field { border-color: ' . get_field('skinoptions_blog_search_border_color', 'options') . '!important ;}';
}

// blog searchbox text-color
if (get_field('skinoptions_blog_search_text_color', 'options')) {
	$output_css .= '.search-field { color: ' . get_field('skinoptions_blog_search_text_color', 'options') . '!important ;}';
}

// blog searchbox placeholder
if (get_field('skinoptions_blog_search_placeholder_color', 'options')) {
	$output_css .= '.close-search svg { stroke: ' . get_field('skinoptions_blog_search_placeholder_color', 'options') . '!important;}';
	$output_css .= '.search-form input::-webkit-input-placeholder { color: ' . get_field('skinoptions_blog_search_placeholder_color', 'options') . '!important; opacity: 1;}';
	$output_css .= '.search-form input::-moz-placeholder { color: ' . get_field('skinoptions_blog_search_placeholder_color', 'options') . '!important; opacity: 1;}';
	$output_css .= '.search-form input:-ms-input-placeholder { color: ' . get_field('skinoptions_blog_search_placeholder_color', 'options') . '!important; opacity: 1;}';
}

#---------------------------------------------------------------------------#
# Skinoptions Body Background												#
#---------------------------------------------------------------------------#

function get_background($prepend, $options) {

	$output_background = '';

	$output_background .= 'body {';
	if(get_field($prepend . '_bg_image', $options)) {
		$output_background .= 'background-image: url(' . get_field($prepend . '_bg_image', $options) . ') !important;';
		$output_background .= 'background-repeat: ' . get_field($prepend . '_bg_image_repeat', $options) . ' !important;';
		if(get_field($prepend . '_bg_image_position', $options)) {
			$output_background .= 'background-position: ' . get_field($prepend . '_bg_image_position', $options) . ' !important;';
		} else {
			$output_background .= 'background-position: top center !important;';
		}
	}
	if(get_field($prepend . '_bg_color', $options)) {
		$output_background .= 'background-color: ' . get_field($prepend . '_bg_color', $options) . ' !important;';
	}
	$output_background .= '}';
	
	echo $output_background;
}

if(get_field('use_semplice') !== 'active' && get_post_type($post->ID) !== 'work') {
	get_background('skinoptions', 'options');
}

#---------------------------------------------------------------------------#
# Content Editor Body Background Branding									#
#---------------------------------------------------------------------------#

$ce_branding = json_decode(get_post_meta( get_the_ID(), 'semplice_ce_branding', true ), true);

if(get_field('use_semplice') === 'active' || get_post_type($post->ID) === 'work') {
	if($ce_branding) {
		$output_css .= '#content-holder {';
		if($ce_branding['background-image']) {			
			$output_css .= 'background-image: url(' . $ce_branding['background-image'] . ') !important;';
			$output_css .= 'background-repeat: ' . $ce_branding['background-repeat'] . ' !important;';
			if($ce_branding['background-size'] === 'cover') {
				$output_css .= 'background-size: cover !important;';	
			} else if($ce_branding['background-repeat'] !== 'no-repeat') {
				$output_css .= 'background-size: auto !important;';
			}
			if($ce_branding['background-position']) {
				$output_css .= 'background-position: ' . $ce_branding['background-position'] . ' !important;';
			} else {
				$output_css .= 'background-position: top center !important;';
			}
		}
		if($ce_branding['background-color']) {
			$output_css .= 'background-color: ' . $ce_branding['background-color'] . ' !important;';
		}
		$output_css .= '}';
	}
}

#---------------------------------------------------------------------------#
# Custom CSS																#
#---------------------------------------------------------------------------#

if(get_field('skinoptions_custom_css', 'options')) {
	$output_css .= get_field('skinoptions_custom_css', 'options');
}

if(get_field('pb_custom_css')) {
	$output_css .= get_field('pb_custom_css');
}

if(get_field('page_custom_css')) {
	$output_css .= get_field('page_custom_css');
}

#---------------------------------------------------------------------------#
# No Site Transitions														#
#---------------------------------------------------------------------------#

if(get_field('site_transitions', 'options') === 'disabled') {

	// fade in all hidden content
	if(get_field('cover_visibility') === 'visible') {
		$output_css .= '#fullscreen-cover, #fullscreen-cover .cover-headline { opacity: 1; }';
		$output_css .= '#fullscreen-cover .cover-video { display: block; }';
	}
	
	// headers
	$output_css .= 'header { top: 0px !important; opacity: 1; }';
	$output_css .= '.fade-content, #project-panel-footer, #blog { opacity: 1 }';
}

#---------------------------------------------------------------------------#
# masonry no gutter percentage grid											#
#---------------------------------------------------------------------------#

$output_css .= '.no-gutter-grid-sizer { width: 8.3333% !important; }';
$output_css .= '.no-gutter-gutter-sizer { width: 0px; }';
$output_css .= '.remove-gutter-yes { margin: 0px !important; }';

for($i=0; $i<=12; $i++) {
	$breite = 100 / 12 * $i;
	$breite = round($breite, 4);
	$output_css .= '.masonry-span' . $i . '{ width: ' . $breite . '% !important; }';
}

// masonry tablet
$output_css .= '@media (max-width: 767px) {';
$output_css .= '.masonry-span1, .masonry-span2, .masonry-span3, .masonry-span4, .masonry-span5, .masonry-span6, .masonry-span7, .masonry-span8, .masonry-span9, .masonry-span10, .masonry-span11, .masonry-span12 { width: 50% !important; }';
$output_css .= '}';
// masonry mobile
$output_css .= '@media (max-width: 567px) {';
$output_css .= '.masonry-span1, .masonry-span2, .masonry-span3, .masonry-span4, .masonry-span5, .masonry-span6, .masonry-span7, .masonry-span8, .masonry-span9, .masonry-span10, .masonry-span11, .masonry-span12 { width: 100% !important; }';
$output_css .= '}';

// output css
echo $output_css;

// semplice, out
?>