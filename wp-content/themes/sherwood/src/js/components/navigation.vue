<template>
	<header id="primaryNav" role="navigation">
		<div class="container">
			<a class="brand" :href="theme.siteUrl" v-html="logoHtml"></a>
			<div class="toggle" @click="toggle"><i class="far fa-bars"></i></div>
			<nav :class="toggleClass">
				<ul>
					<li><a :href="theme.siteUrl + '/accommodations'">Accommodations</a></li>
					<li><a :href="theme.siteUrl + '/weddings'">Weddings</a></li>
					<li><a :href="theme.siteUrl + '/rates'">Rates</a></li>
					<li><a :href="theme.siteUrl + '/contact'" class="btn btn-primary">Contact Us</a></li>
				</ul>
			</nav>
		</div>
	</header>
</template>
<script>
export default {
	props: {
		logoHtml: String
	},
	data() {
		return {
			theme,
			toggleState: false
		}
	},
	computed: {
		toggleClass() {
			return this.toggleState ? 'active' : '';
		}
	},
	methods: {
		toggle() {
			this.toggleState = !this.toggleState;
		}
	}
}
</script>
<style scoped lang="scss">
@import "../../sass/_variables.scss";

header {
	padding-top: 0.75rem;
	padding-bottom: 0.75rem;
	position: sticky;
	top: 0;
	z-index: 1000;
	background-color: $light;
	background-color: rgba(255, 255, 255, 0.6);
    -webkit-backdrop-filter: blur(10px);
    backdrop-filter: blur(10px);

	&.scrolled {
		box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.15);
	}
}

.no-backdrop-filter header {
	background-color: #fff;
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

	flex-wrap: wrap;
}

nav {
	display: none;

	@media (min-width: $md) {
		display: block;
	}
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

.active {
	display: block;
	width: 100%;

	ul {
		display: block;
		margin: 0;
		padding: 0;
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

.btn-primary {
	font-size: 13px;

	@media (min-width: $md) {
		margin-left: 1rem;
	}
}
</style>
