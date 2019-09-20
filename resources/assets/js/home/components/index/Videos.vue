<template>
  <div class="videos" v-if="$store.getters['main-page/videos'].length">
		<div class="header">
			<div class="background">
				<img src="/img/videos-stars-bg.svg">
			</div>
			<div class="name">
				ישראל בידור VOD
			</div>
		</div>
		<div class="body">

			<carousel
				ref="carousel"
				:perPage="1"
				@page-change="onPageChange"
        rtl
        :paginationEnabled="false"
      >
        <slide
					v-for="item in $store.getters['main-page/videos']"
					:key="item.id"
					@slide-click="toggle"
				>
					<video :src="item.video" ref="video" :poster="item.thumbnail" loop/>
					<div class="overlay">
						<div class="info">
							<p class="name">
								{{ item.title }}
							</p>
							<div class="time">
								{{ item.author }} |
								{{ new Date(item.created_at) | formatDate }}
							</div>
						</div>
						<button v-if="!is_play" type="button" class="play-btn">
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
								<path d="M256,0C114.617,0,0,114.615,0,256s114.617,256,256,256s256-114.615,256-256S397.383,0,256,0z M344.48,269.57l-128,80
									c-2.59,1.617-5.535,2.43-8.48,2.43c-2.668,0-5.34-0.664-7.758-2.008C195.156,347.172,192,341.82,192,336V176
									c0-5.82,3.156-11.172,8.242-13.992c5.086-2.836,11.305-2.664,16.238,0.422l128,80c4.676,2.93,7.52,8.055,7.52,13.57
									S349.156,266.641,344.48,269.57z"/>
							</svg>
						</button>
					</div>
        </slide>
      </carousel>

			<div class="panel">
				<button type="button" class="button prev" @click="slide($event, 'next')">
					<svg width="22" height="36" viewBox="0 0 22 36" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M19.5876 33.6779L18.8805 32.9707L19.5876 33.6779C19.1858 34.0797 18.6664 34.287 18.1162 34.287C17.5659 34.287 17.0465 34.0797 16.6447 33.6779L17.3518 32.9707L16.6447 33.6779L2.4385 19.4716C1.62627 18.6594 1.62627 17.341 2.4385 16.5288L16.6447 2.32255C17.4569 1.51032 18.7754 1.51032 19.5876 2.32255C20.3998 3.13478 20.3998 4.45322 19.5876 5.26545L6.85285 18.0002L19.5876 30.735C20.3998 31.5472 20.3998 32.8656 19.5876 33.6779Z" fill="white" stroke="white" stroke-width="2"/>
					</svg>
				</button>
				<button type="button" class="button next" @click="slide($event, 'prev')">
					<svg width="22" height="34" viewBox="0 0 22 34" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M2.4124 1.32215L3.1195 2.02925L2.4124 1.32215C2.81422 0.920322 3.33361 0.712976 3.88384 0.712976C4.43408 0.712976 4.95346 0.920322 5.35529 1.32215L4.64819 2.02925L5.35529 1.32215L19.5615 15.5284C20.3737 16.3406 20.3737 17.659 19.5615 18.4712L5.35529 32.6774C4.54306 33.4897 3.22462 33.4897 2.4124 32.6774C1.60017 31.8652 1.60017 30.5468 2.4124 29.7346L15.1472 16.9998L2.4124 4.26505C1.60017 3.45282 1.60017 2.13438 2.4124 1.32215Z" fill="white" stroke="white" stroke-width="2"/>
					</svg>
				</button>
			</div>
		</div>
  </div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';

export default {
	data() {
		return {
			is_play: false,
		};
	},
	components: {
		Carousel,
		Slide,
	},
	methods: {
		toggle() {
			if(this.is_play) {
				this.$refs.video[this.page].pause();
				this.is_play = false;
			} else {
				this.$refs.video[this.page].play();
				this.is_play = true;
			}
		},
		onPageChange(page) {
			this.page = page;
			this.is_play = false;
			for (let video of this.$refs.video) {
				video.pause();
			}
		},
		slide(e, value) {
	    const carousel = this.$refs['carousel'];
	    const currentPage = carousel.currentPage;
	    const pageCount = carousel.pageCount;
	    if (value == 'prev') {
        currentPage != 0 ? carousel.goToPage(currentPage - 1) : carousel.goToPage(pageCount - 1);
	    } else {
        currentPage < pageCount - 1 ? carousel.goToPage(currentPage + 1) : carousel.goToPage(0);
	    }

			e.stopPropagation();
		},
		onChange(e) {
			console.log(e);
		}
	},
	created() {
		this.page = 0;
	},
	mounted() {

	}
}
</script>

<style lang="scss" scoped>

.videos {
	width: 100%;
	color: #FFFFFF;
	padding: 20px 0;

	display: flex;
	flex-direction: column;
	align-items: stretch;
	justify-content: flex-start;

	.header {
		position: relative;
		padding: 10px 0;
		width: 100%;
		background: linear-gradient(303.94deg, #EDB72A 6.16%, #FDD55D 99.09%);

		.background {
			position: absolute;
			left: 50%;
			transform: translateX(-50%);
			top: 0;
			width: 100%;
			height: auto;
			z-index: 20;
			pointer-events: none;
			user-select: none;
			min-width: 450px;

			img {
				width: 100%;

			}
		}
		.name {

			display: flex;
			align-items: center;
			justify-content: center;

			position: relative;
			font-weight: 800;
			font-size: 45px;

			@media(max-width: 767px) {
				font-size: 30px;
			}
		}
	}

	.body {
		position: relative;
		flex-grow: 1;
		width: 100%;
		height: 100%;

		display: flex;
		align-items: center;
		justify-content: center;

		.VueCarousel {
			width: 100%;
		}

		.play-btn {
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			width: 100px;
			height: 100px;
			z-index: 11;
			background: transparent;
			border: 0;

			display: flex;
			align-items: center;
			justify-content: center;

			svg {
				width: 100%;
				height: 100%;
				fill: #fff;
			}
		}

		.VueCarousel-slide {
			position: relative;
			max-height: 500px;
	    min-height: 350px;
			video {
				height: 100%;
				width: 100%;
				object-fit: cover;
			}

			.overlay {
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				z-index: 10;
				background: linear-gradient(2.55deg, #B08228 2.83%, rgba(252, 215, 126, 0.24) 60.66%);

				.info {
					height: 120px;
					width: 100%;
					position: absolute;
					left: 0;
					bottom: 0;

					display: flex;
					flex-direction: column;
					justify-content: center;
					align-items: center;

					.name {
						font-weight: bold;
						font-size: 36px;
						line-height: 100%;
						text-align: center;
						text-overflow: ellipsis;
						white-space: nowrap;
						overflow: hidden;
						max-width: 100%;
						padding: 0 50px;
						margin: 0;
						width: 100%;
					}
					.time {
						font-size: 18px;
					}
				}
			}
		}

		.panel {

			position: absolute;
			bottom: 0;
			width: 100%;
			left: 0;
			height: 120px;
			text-align: center;

			display: flex;
			align-items: center;
			justify-content: center;

			.button {
				position: absolute;
				top: 50%;
				transform: translateY(-50%);
				width: 50px;
				height: 50px;
				padding: 0;
				background: transparent;
				border: 0;

				display: flex;
				justify-content: center;
				align-items: center;

				&.prev {
					left: 10px;
				}

				&.next {
					right: 10px;
				}
			}
		}
	}
}

</style>
