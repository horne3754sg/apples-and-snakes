<?php

function color_block_shortcode($atts, $content = null)
{
	$a = shortcode_atts(array(
		'color' => 'red',
		'title' => '',
		'link'  => ''
	), $atts);
	
	$title = str_replace('|', '<br/>', $a['title']);
	
	if (!empty($a['link']))
	{
		$html = '<a class="color_block ' . esc_attr($a['color']) . '" href="' . esc_url($a['link']) . '"><span class="block_title">' . $title . '</span></a>';
	}
	else
	{
		$html = '<div class="color_block ' . esc_attr($a['color']) . '"><span class="block_title">' . $title . '</span></div>';
	}
	
	return $html;
}

add_shortcode('color_block', 'color_block_shortcode');


function artist_resources_shortcode()
{
	ob_start();
	?>
	<div class="columns artist_resources">

		<div class="col">
			<?php dynamic_sidebar('resources-left'); ?>
		</div>

		<div class="col">
			<?php dynamic_sidebar('resources-center'); ?>
		</div>

		<div class="col">
			<?php dynamic_sidebar('resources-right'); ?>
		</div>

	</div>
	<?php
	$html = ob_get_clean();
	
	return $html;
}

add_shortcode('artist_resources', 'artist_resources_shortcode');
