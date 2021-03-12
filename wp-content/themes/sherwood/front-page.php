<?php
/**
 * The template for displaying the home page
 *
 * @package sherwood
 */

get_header();
?>
<article id="content" class="content content-home" role="content">
	<section class="hero section dark">
		<background src="<?php echo get_cdn_url('behind-house.png'); ?>"></background>
		<div class="container container-md">
			<h1>A Place to Gather</h1>
			<p>Sherwood Gardens is situated on 10 acres and is eagerly awaiting your next wedding, gathering or celebration. The 1903 historic home is fully equipped with everything you would need for your stay including 5 bedrooms, 3 bathrooms, and 2 glassed-in sun porches.</p>
			<p>The Event Barn has a main floor and upstairs for celebrating, and can accommodate up to 150 guests. The spacious grounds encompass beautiful flower and vegetable gardens along with mature trees.</p>
			<a href="#" class="btn">Book Your Event</a>
		</div>
	</section>
	<section class="section">
		<div class="container">
			<figure>
				<img src="https://02f0a56ef46d93f03c90-22ac5f107621879d5667e0d7ed595bdb.ssl.cf2.rackcdn.com/sites/1632/photos/730141/fall_wedding_2017_21220171109-32253-lscsgf_x435.JPG" alt="Behind House" />
				<figcaption>
					<h2>Our Vision</h2>
					<p>We started Sherwood Gardens to create a serene environment for all to enjoy. There's nothing more important to us than making sure your special day is just that—special.</p>
					<a href="#" class="btn">View Gallery</a>
				</figcaption>
			</figure>
		</div>
	</section>
	<section class="section dark">
		<background src="https://02f0a56ef46d93f03c90-22ac5f107621879d5667e0d7ed595bdb.ssl.cf2.rackcdn.com/sites/1632/photos/730303/ea3a67e0-a052-40be-9c04-1ce4d8ec63e0_x435.jpg" blur="3px"></background>
		<div class="container container-md">
			<h2 class="h1">An Unforgettable Experience</h2>
			<p>Sherwood Gardens provides an intimate and memorable setting for Weddings, Receptions, Rehearsal dinners, Memorials, Vacations, Slumber parties, Family gatherings, Reunions, & Retreats.</p>
			<a href="#" class="btn">Book Your Event</a>
		</div>
	</section>
	<section class="section">
		<div class="container">
			<figure>
				<figcaption>
					<h2 style="font-size: calc(1rem + 1vw);">Southwest Michigan's Best Kept Secret</h2>
					<p>Sherwood Gardens is proud to offer a completely renovated 1903 Colonial home and grounds presented in a warm and unique style. The entire estate is available for Weekend Rental.</p>
					<a href="#" class="btn">See Our Accomodations</a>
				</figcaption>
				<img src="https://02f0a56ef46d93f03c90-22ac5f107621879d5667e0d7ed595bdb.ssl.cf2.rackcdn.com/sites/1632/photos/730141/fall_wedding_2017_21220171109-32253-lscsgf_x435.JPG" alt="Behind House" />
			</figure>
		</div>
	</section>
	<div class="the-content">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
	</div>
</article>
<?php
get_footer();
