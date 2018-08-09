<?php get_header(); ?>

<div id="ajax-content">
	<?php
	set_query_var( 'type', (is_post_type_archive('portfolio') || is_tax('works') || is_front_page() ? 'portfolio' : 'post') );
	get_template_part( 'partials/loop' );
	?>
</div>

<?php get_footer(); ?>
