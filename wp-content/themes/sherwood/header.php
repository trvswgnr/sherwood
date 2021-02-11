<?php
/**
 * Template Header
 *
 * @package sherwood
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<main id="main">
		<nav class="navbar navbar-expand-lg navbar-light position-absolute z-2 w-100" id="navbar">
			<div class="container-fluid navbar-container z-1">
				<a class="navbar-brand position-lg-fixed" href="<?php echo site_url(); ?>">
					<img width="180" src="<?php echo get_theme_mod( 'theme_logo' ); ?>" />
				</a>
				<button
					class="navbar-toggler"
					type="button"
					data-bs-toggle="collapse"
					data-bs-target="#primaryNav"
					aria-controls="primaryNav"
					aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="bars"><span></span><span></span></span>
				</button>
				<div class="collapse navbar-collapse justify-content-end" id="primaryNav">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo get_post_type_archive_link('project'); ?>">Projects</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo site_url('/about'); ?>">About</a>
						</li>
						<li id="navItemRequestProposal" class="nav-item">
							<a class="nav-link fw-bold" href="<?php echo site_url('/request-proposal'); ?>">Request Proposal</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
