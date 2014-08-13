<?php
	
	// get default fontset id
	$fontset_object = get_field('custom_fontset', 'options'); 
	
	if($fontset_object) {
		$fontset_id = $fontset_object->ID;
	} else {
		$fontset_id = 'default';
	}

	// get branding
	$styles = json_decode(get_post_meta( get_the_ID(), 'semplice_ce_branding', true ), true);

	// select boxes
	function select($arr, $active_key) {
		echo $active_key;
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
?>
<script type="text/javascript">
	/* set default fontset */
	var default_fontset = '<?php echo $fontset_id; ?>';
</script>
<div class="adder">
	<a class="start"></a>
	<ul class="types">
		<li>
			<a class="add-content p" data-content-type="content-p"></a>
			<div class="tooltip">
				<div class="tt-arrow"></div>
				<div class="tt-text">Add Paragraph</div>
			</div>
		</li>
		<li>
			<a class="add-content img" data-content-type="content-img"></a>
			<div class="tooltip">
				<div class="tt-arrow"></div>
				<div class="tt-text">Add Image</div>
			</div>
		</li>
		<li>
			<a class="add-content gallery" data-content-type="content-gallery"></a>
			<div class="tooltip">
				<div class="tt-arrow"></div>
				<div class="tt-text">Add Gallery</div>
			</div>
		</li>
		<li>
			<a class="add-content video" data-content-type="content-video"></a>
			<div class="tooltip">
				<div class="tt-arrow"></div>
				<div class="tt-text">Add Video</div>
			</div>
		</li>
		<li>
			<a class="add-content audio" data-content-type="content-audio"></a>
			<div class="tooltip">
				<div class="tt-arrow"></div>
				<div class="tt-text">Add Audio</div>
			</div>
		</li>
		<li>
			<a class="add-content oembed" data-content-type="content-oembed"></a>
			<div class="tooltip">
				<div class="tt-arrow"></div>
				<div class="tt-text">Add oEmbed</div>
			</div>
		</li>
		<li>
			<a class="add-content spacer" data-content-type="content-spacer"></a>
			<div class="tooltip">
				<div class="tt-arrow"></div>
				<div class="tt-text">Add Spacer</div>
			</div>
		</li>
		<li>
			<a class="add-content thumbnails" data-content-type="content-thumbnails"></a>
			<div class="tooltip">
				<div class="tt-arrow"></div>
				<div class="tt-text">Add Portfolio Grid</div>
			</div>
		</li>
		<li>
			<a class="add-content mc" data-content-type="multi-column"></a>
			<div class="tooltip">
				<div class="tt-arrow"></div>
				<div class="tt-text">Add Multi Column</div>
			</div>
		</li>
		<li class="unveal-options">
			<a class="show-options">Grid</a>
			<ul class="options-sub">
				<li>
					<div class="semplice-arrow"></div>
				</li>
				<li>
					<a class="show-layers border">Show Layers</a>
				</li>
				<li>
					<a class="show-grid">Show Grid</a>
				</li>
			</ul>
		</li>
		<li>
			<a class="branding">Branding</a>
			<ul class="branding-sub">
				<li>
					<div class="semplice-arrow"></div>
					<div class="ce-label">Custom Fontset</div>
					<?php
						// output select box
						$e = '';
						$e .= '<div class="ce-select-box">';
						$e .= '<select name="custom-fontset" class="custom-fontset">';
						$e .= '<option value="default">Select Fontset</option>';
						
						// args
						$args = array(
							'sort_order' => 'ASC',
							'post_type' => 'custom_fontset',
							'post_status' => 'publish'
						);

						$fonts = get_posts($args);
						
						if($fonts)
						{
							foreach($fonts as $font)
							{
							
								$e .= '<option value="' . $font->ID . '">' . $font->post_title . '</option>';
							
							}
						}
						
						$e .= '</select>';
						$e .= '</div>';
						
						// output
						echo $e;
					?>
				</li>
				<li>
					<div class="ce-label">Background Color</div>
					<?php
					
						// has color?
						$has_color = false;
					
						if(preg_match('/^#[a-f0-9]{6}$/i', $styles['background-color'])) {
							  $has_color = true;
						} 
					
					?>
					<div class="wp-color"><input type="text" value="<?php if($has_color === true) : echo $styles['background-color']; else : echo '#ffffff'; endif; ?>" class="color-picker branding-bg-color" data-default-color="#ffffff" name="branding-bg-color" />
					</div>
				</li>
				<li>
					<div id="branding-bg-image">
						<div class="ce-label">Bg Image</div>
						<a class="media-upload semplice-button bg-image-upload" data-upload-type="background" data-content-id="branding-bg-image" data-branding="branding">Upload image</a><a class="remove-media remove-bg" data-content-id="branding-bg-image" data-media="branding-bg-image"></a>
						<input type="hidden" name="branding-bg-image" class="branding-bg-image is-branding-bg-image is-bg-image" value="">
						<img src="" class="branding-bg-image-preview">
					</div>
				</li>
				<li>
					<div class="ce-label">Background Scale</div>
					<?php	
						$bg_scale = array(
							'auto' 	=> 'No Scale',
							'cover' 	=> 'Cover (full-width)'
						);
					?>
					<div class="ce-select-box">
						<select name="branding-bg-size" class="branding-bg-size select-box branding-bg-select" data-css-attribute="background-size">
							<?php select($bg_scale, $styles['background-size']); ?>
						</select>
					</div>
				</li>
				<li>
					<?php
						$bg_pos = array(
							'0% 0%' 	=> 'Top Left',
							'50% 0%' 	=> 'Top Center',
							'100% 0%' 	=> 'Top Right',
							'0% 50%' 	=> 'Middle Left',
							'50% 50%' 	=> 'Middle Center',
							'100% 50%' 	=> 'Middle Right',
							'0% 100%' 	=> 'Bottom Left',
							'50% 100%' 	=> 'Bottom Center',
							'100% 100%' => 'Bottom Right'
						); 
					?>
					<div class="ce-label">Background Position</div>
					<div class="ce-select-box">
						<select name="branding-bg-pos" class="branding-bg-pos select-box branding-bg-select" data-css-attribute="background-position">
							<?php select($bg_pos, $styles['background-position']); ?>
						</select>
					</div>
				</li>
				<li>
					<div class="ce-label">Background Repeat</div>
					<?php
						$bg_repeat = array(
							'repeat' 	=> 'Repeat horziontal and vertical',
							'repeat-x' 	=> 'Repeat horizontal',
							'repeat-y' 	=> 'Repeat vertical',
							'no-repeat' => 'No Repeat'
						);
					?>
					<div class="ce-select-box">
						<select name="background-repeat" class="branding-bg-repeat select-box branding-bg-select" data-css-attribute="background-repeat">
							<?php select($bg_repeat, $styles['background-repeat']); ?>
						</select>
					</div>
				</li>
			</ul>
		</li>		
	</ul>

	<div class="save-or-cancel">
		<a class="cancel-to-wp">Cancel</a>
		<a class="save-to-wp">Save</a>
	</div>
</div>
<div id="grid"></div>
<div id="semplice-content"></div>
<div class="loader">Working</div>
<div class="confirm">
	<div class="text">
		<h4>Confirm</h4>
		<p>Are you sure you want to<br />delete this conent?</p>
	</div>
	<ul>
		<li><a class="remove-confirm" data-content-id="" data-is-column="" data-parent-id="">Yes</a></li>
		<li><a class="remove-decline">No</a></li>
	</ul>
</div>
<div class="cancel">
	<div class="text">
		<h4>Confirm</h4>
		<p>Do you want to<br />exit without saving?</p>
	</div>
	<ul>
		<li><a class="cancel-confirm">Yes</a></li>
		<li><a class="cancel-decline">No</a></li>
	</ul>
</div>
<div class="confirm-preset">
	<div class="text">
		<h4>Are you sure?</h4>
		<p>Your current progress<br />will be overwritten!</p>
	</div>
	<ul>
		<li><a class="preset-confirm" data-preset-id="">Yes</a></li>
		<li><a class="preset-decline">No</a></li>
	</ul>
</div>
<div class="overlay"><!-- overlay --></div>
<div class="no-images"><p><strong>No Images on edit?</strong> If you can't see any images after you click on an image to edit it please import the presets.xml from your theme folder into wordpress and make sure to download the attachments!</p><br /><a class="ce-dismiss">Close</a></div>