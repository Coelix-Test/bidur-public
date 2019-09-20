<template>
  <main>

		<div class="cards-container">
			<vs-card v-for="item in data" :key="item.id" class="card">
	      <div slot="header">
	        <h3>
	          {{ item.title }}
	        </h3>
	      </div>
	      <div slot="media">
	        <img :src="item.thumbnail">
	      </div>
	      <div slot="footer">
	        <vs-row vs-justify="flex-end">
	          <vs-button @click="remove(item)" size="small" color="danger" icon="delete">
							Delete
						</vs-button>
	        </vs-row>
	      </div>
	    </vs-card>
		</div>

		<vs-divider>New</vs-divider>

		<vs-row vs-type="flex">
			<vs-col vs-type="flex" vs-justify="center" vs-w="4">
				<vs-upload
					style="width: 215px; height: 215px; overflow: hidden;"
					text="Uplaod thumbnail"
					@change="updateThumbnail"
					:limit="1"
					accept="image/*"
				/>
		  </vs-col>
			<vs-col vs-type="flex" vs-justify="center" vs-w="4">
				<vs-upload
					style="width: 215px; height: 215px; overflow: hidden;"
					@change="updateVideo"
					text="Uplaod video"
					accept="video/*"
					:limit="1"
				/>
		  </vs-col>
			<vs-col vs-type="flex" vs-align="center" vs-justify="center" vs-w="4">
				<div class="end-container">
					<vs-input label-placeholder="Title" v-model="title"/>
					<vs-input-number v-model="order_num" label="Order"/>
					<vs-button
						icon="cloud_upload"
						type="line"
						@click="create"
						size="large"
					>Upload</vs-button>
				</div>
		  </vs-col>
		</vs-row>

  </main>
</template>

<script>

export default {
  data() {
    return {
      data: [],
      thumbnail: null,
			video: null,
			title: '',
			order_num: 0,
    };
  },
  methods: {
    updateThumbnail(path, file) {
      this.thumbnail = file[0];
    },
		updateVideo(path, file) {
      this.video = file[0];
    },
    sync() {
      return axios.get('/api/admin/video').then(res => {
        this.data = res.data;
      });
    },
    remove(item) {
      return axios.delete('/api/admin/video/' + item.id).then(res => {
        this.sync();
        return res;
      });
    },
    create() {

      this.$vs.loading();

      let data = new FormData();
      data.append('video', this.video);
			data.append('thumbnail', this.thumbnail);
      data.append('title', this.title);
			data.append('order_num', this.order_num);

      return axios.post('/api/admin/video', data, {
				headers: {
					'Content-Type': 'multipart/form-data',
				}
			}).then(res => {
        this.sync();
				this.$vs.notify({
					title: 'Okay',
					text: 'Video successfully added!',
					color: 'success'
				});
        return res;
      }).finally(() => {
				this.$vs.loading.close();
			}).catch(err => {
				this.$vs.notify({
					title: 'Oops!',
					text: err.response.data.err ? err.response.data.err : 'Server error',
					color: 'danger'
				});
			});
    }
  },
  created() {
    this.sync();
  },
}
</script>

<style lang="scss" scoped>

main {

  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;

	max-width: 1000px;
	padding: 0 20px;
	padding-bottom: 50px;
	margin: 0 auto;

	.end-container {

		height: 100%;

		display: flex;
		flex-direction: column;
		justify-content: space-between;
		align-items: center;
	}

	.cards-container {

		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: flex-start;
		flex-wrap: wrap;

		.card {
			width: 300px;
			margin: 10px;
		}
	}

}

</style>
