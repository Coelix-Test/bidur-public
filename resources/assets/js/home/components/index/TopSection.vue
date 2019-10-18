<template>
  <div
		class="top-section"
		:class="{ 'is-sunday': $store.getters['main-page/isSunday'] }"
	>

    <TopSectionFirst/>

    <Adsense
      data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
      data-ad-slot="1853214598"
      data-ad-format="fluid"
      data-ad-layout-key="-fb+5w+4e-db+86"
    />

    <TopSectionSecond/>

  </div>
</template>

<script>
import TopSectionFirst from './TopSectionFirst'
import TopSectionSecond from './TopSectionSecond'

export default {
  components: {
    TopSectionFirst,
    TopSectionSecond,
  },
}
</script>

<style lang="scss" scoped>

.top-section {
  width: 100%;

  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: flex-start;

  padding-bottom: 30px;

  @media(max-width: 767px) {
    flex-direction: column;
    padding: 8px;
    align-items: stretch;

		&.is-sunday {
			order: 5; // remove in future
	    margin-bottom: -20px; // temp shit
		}
  }

  @media (max-width: 556px){
    .top-section .post.first .title .main{
      font-size: 26px;
    }
  }

}

</style>
