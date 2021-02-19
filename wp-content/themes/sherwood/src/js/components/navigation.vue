<template>
	<nav id="primaryNav" role="navigation">
		<div class="container">
			<a class="brand" :href="theme.siteUrl" v-html="logoHtml"></a>
			<div class="toggle"><i class="far fa-bars"></i></div>
			<ul>
				<li><a href="#">Sherwood Gardens House</a></li>
				<li><a href="#">Carriage House</a></li>
				<li><a href="#">Event Barn</a></li>
				<li><a href="#">Weddings</a></li>
				<li><a href="#">Rates</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
		</div>
	</nav>
</template>
<script>
export default {
	props: {
		logoHtml: String
	},
	data() {
		return {
			theme
		}
	}
}
</script>
<style scoped lang="scss">
@import "../../sass/_variables.scss";

nav {
	padding-top: 0.75rem;
	padding-bottom: 0.75rem;
	position: sticky;
	top: 0;
	z-index: 1000;
	background-color: $light;

	&.scrolled {
		box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.15);
	}
}

.toggle {
	display: block;
	font-size: 1.7rem;

	@media (min-width: $md) {
		display: none;
	}
}

.container {
	display: flex;
	justify-content: space-between;
	align-items: center;
}

ul {
	display: none;
	align-items: center;
	list-style: none;
	margin: 0 -1rem;

	@media (min-width: $md) {
		display: flex;
	}
}

li {
	text-align: center;
	font-weight: 400;

	a {
		display: block;
		padding: 0.5rem 1rem;
	}
}

.brand {
	width: 100%;
	max-width: 150px;

	@media (min-width: $md) {
		width: 100%;
		max-width: 220px;
		transition: max-width 0.2s;

		.scrolled & {
			max-width: 120px;
		}
	}
}
</style>
