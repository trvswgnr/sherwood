<?php
/**
 * Default Template
 *
 * @package sherwood
 */

get_header();
?>
<article id="content" class="content container-fluid" role="content">
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		?>
		<?php
		the_post();
		the_content();
		?>
		<?php
	endwhile;
endif;
?>
</article>
<?php
get_footer();
