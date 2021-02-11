<?php
/**
 * Page Template
 *
 * @package sherwood
 */

get_header();
?>
<article id="content" class="content" role="content">

	<div class="container mw-md py-5">
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
	</div>

</article>
<?php
get_footer();
