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
			<background src="<?php echo get_the_post_thumbnail_url(); ?>" blur="3px"></background>
			<div class="container">
			<?php the_title('<h1>', '</h1>'); ?>
			</div>
		</header>

		<main id="content" class="content container" role="content">
			<div class="row" align="start">
				<div class="col">
					<?php the_content(); ?>
				</div>
				<div class="col">
				<h2>Find Us</h2>
				<iframe width="100%" height="500px" style="margin-top: 1rem;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBnqRKZUWWJ3b1bJSLcGKVYXbndZYn-CAI&amp;q=414%20N.%20Sherwood%20Ave.,%20Plainwell,%20MI%2049080" allowfullscreen=""></iframe>
				</div>
			</div>
		</main>
		<?php
	endwhile;
endif;
?>
</article>
<?php
get_footer();
//[contact-form-7 id="65" title="Contact form 1"]

