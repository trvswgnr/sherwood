<?php
/**
 * Page Template
 *
 * @package sherwood
 */

get_header();
?>
<article>
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		?>
		<?php
		the_post();
		?>
		<header class="hero dark">
			<div class="container">
			<?php the_title('<h1>', '</h1>'); ?>
			</div>
		</header>

		<main id="content" class="content container" role="content">
			<?php the_content(); ?>
		</main>
		<?php
	endwhile;
endif;
?>
</article>
<?php
get_footer();
