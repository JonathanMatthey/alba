<?php

// add mobile detection
$detect = new Mobile_Detect;

// is linked to a project?
if(filter_var(get_field('cover_link'), FILTER_VALIDATE_BOOLEAN) === TRUE) {
	$is_link = true;
	$link_open = '<a href="' . get_field('link') . '">';
	$link_close = '</a>';
} else {
	$is_link = false;
}

// bg data
if(get_field('cover_bg_image') && get_field('cover_bg_type') === 'image') {
	$bg_data = 'image';
} elseif (get_field('cover_bg_type') === 'video') {
	$bg_data = 'video';
} else {
	$bg_data = 'color';
}

if($is_link) : echo $link_open; endif;
echo '<div id="fullscreen-cover" data-bg-type="' . $bg_data . '">';
	if(get_field('cover_bg_type') === 'image') : ?>
		<div class="cover-image" <?php if(get_field('cover_bg_image_scale') === 'actual-size') : echo 'data-bg-align="' . get_field('cover_bg_image_align') . '"'; endif; ?>></div>
	<?php else : ?>
		<?php if($detect->isMobile()) : ?>
			<div class="cover-video-responsive" data-has-bg="true"></div>
		<?php else : ?>
		<?php $video_type = get_field('cover_videotype'); ?>
			<div class="cover-video">
				<video id="fs-video" width="<?php echo get_field('video_width'); ?>" height="<?php echo get_field('video_height'); ?>" preload="none" autoplay loop muted>
					<?php if(get_field($video_type . '_mp4')) : ?><source src="<?php echo get_field($video_type . '_mp4'); ?>" type="video/mp4"><?php endif; ?>
					<?php if(get_field($video_type . '_ogv')) : ?><source src="<?php echo get_field($video_type . '_ogv'); ?>" type="video/ogg"><?php endif; ?>
					<p>If you are reading this, it is because your browser does not support the HTML5 video element.</p>
				</video>
			</div>
		<?php endif; ?>
	<?php endif; ?>
<?php if($is_link) : echo $link_close; endif; ?>
	<?php if(filter_var(get_field('hide_cover_headline'), FILTER_VALIDATE_BOOLEAN) !== TRUE) : ?>
		<div class="container">
			<div class="row">
				<div class="span12">
					<?php if($is_link) : echo $link_open; endif; ?>
						<div class="row <?php if(get_field('cover_headline_format') === 'image') : echo 'format-image'; endif; ?>">
							<div class="cover-headline span12 <?php echo get_field('cover_headline_ver_align'); ?> <?php echo get_field('cover_headline_hor_align'); ?>" data-headline-format="<?php echo get_field('cover_headline_format'); ?>">
								<?php if(get_field('cover_headline_format') === 'text') : ?>
									<h1 class="<?php echo get_field('cover_headline_weight'); ?>"><?php echo get_field('cover_headline'); ?></h1>
								<?php else: ?>
									<img class="headline-image" src="<?php echo get_field('cover_headline_image'); ?>" alt="<?php the_title(); ?>" />
								<?php endif; ?>
							</div>
						</div>
					<?php if($is_link) : echo $link_close; endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if(get_field('cover_scroll') === 'visible') : ?>
		<div class="see-more">
			<div class="icon"><?php echo setIcon('big_arrow'); ?></div>
		</div>
	<?php endif; ?>
</div>