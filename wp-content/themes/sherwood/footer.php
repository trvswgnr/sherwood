<?php
/**
 * Theme Footer
 *
 * @package sherwood
 */

?>
<footer class="dark">
	<div class="container info">
		<div class="row" align="start">
			<div class="col">
				<div class="address">
					<h4 class="text-sans">Sherwood Gardens</h4>
					<p><a href="https://goo.gl/maps/NmUYggyERJ1TXsPC6">414 N. Sherwood Ave.<br>
					Plainwell, MI 49080</a></p>
				</div>
			</div>
			<div class="col">
				<h4 class="text-sans">Navigation</h4>
				<ul class="list-unstyled">
					<li><a href="<?php echo site_url('/accommodations'); ?>">Accommodations</a></li>
					<li><a href="<?php echo site_url('/weddings'); ?>">Weddings</a></li>
					<li><a href="<?php echo site_url('/rates'); ?>">Rates</a></li>
					<li><a href="<?php echo site_url('/contact'); ?>">Contact Us</a></li>
				</ul>
			</div>
			<div class="col">
				<h4 class="text-sans">Contact</h4>
				<ul class="list-unstyled">
					<li><strong>Phone:</strong> <a href="tel:">(269) 512-5857</a></li>
					<li><strong>Email:</strong> <a href="mailto:gardens.at.sherwood@gmail.com">gardens.at.sherwood@gmail.com</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container site-credit">
		<p>Copyright © <?php echo date('Y'); ?> Sherwood Gardens</p>
		<p>Website by <a href="#">TAW Digital</a></p>
	</div>
</footer>
</main><!-- #main -->
<?php wp_footer(); ?>
</body>
</html>
