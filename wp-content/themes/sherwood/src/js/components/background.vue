<template>
	<div class="bg" v-html="imgHtml"></div>
</template>
<script>
export default {
	props: {
		img: String,
		src: String,
		srcset: String,
		alt: String,
		blur: String
	},
	computed: {
		imgHtml() {
			if (this.img) {
				return this.img;
			}
			const atts = [
				this.$options._scopeId,
			];
			const img = {
				src: this.src,
				alt: this.alt,
				srcset: this.srcset,
				style: this.blur ? `filter: blur(${this.blur})` : false
			};
			Object.entries(img).forEach(([prop, value]) => !value || atts.push(`${prop}="${value}"`));
			return `<img ${atts.join(' ')}>`;
		}
	}
}
</script>
<style scoped lang="scss">
.bg,
.bg::after,
.bg img{
	content: "";
	display: block;	
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	object-fit: cover;
}

.bg {
	overflow: hidden;
}

.bg::after {
	background-color: rgba(#000, 0.6);
}

.bg img {
	filter: blur(5px);
	transform: scale(1.02);
}
</style>
