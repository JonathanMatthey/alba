<?php 
/*
 * footer
 * semplice.theme
 */
?>
			<!-- content -->
			</div>
		<!-- wrapper -->
		</div>
		<div class="to-the-top">
			<a class="top-button"><?php echo setIcon('arrow_up'); ?></a>
		</div>
		<div class="overlay fade"></div>
		<?php wp_footer(); # include wordpress footer ?>
		<?php if(get_post_type( $post->ID ) === 'post') :?>
			<script type="text/javascript">
				(function($) {
					$(document).ready(function () {
						$("a[rel=semplice-gallery]").fancybox({
							'transitionIn'	: 'elastic',
							'transitionOut': 'none'
						});
					});
				})(jQuery); 
			</script>
		<?php endif; ?>
	</body>
</html>