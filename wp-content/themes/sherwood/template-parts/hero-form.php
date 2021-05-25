<?php
/**
 * Template Part: Hero with Form
 */

if (!isset($_GET['fbclid'])) {
	return;
}
?>
<section class="hero section dark">
	<div class="container">
		<div class="row">
			<div class="col">
				<h1 class="text-sans">A progressive wedding venue for everyone.</h1>
				<p>Fill out the form to get more information and start booking your next big event!</p>
			</div>
			<div class="col">
				<?php if (get_field('home_hero_form')) : ?>
				<div class="form-wrapper">
					<?php echo do_shortcode('[contact-form-7 id="' . get_field('home_hero_form') . '" title="Home Hero Form"]'); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>