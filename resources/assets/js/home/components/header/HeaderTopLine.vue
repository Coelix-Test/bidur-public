<template>
  <div class="top-row">
      <div class="top-row-inner">
          <div class="menu-col-wrap">
              <div class="logo-wrap">
                  <router-link :to="{ name: 'index'}">
                      <img src="/img/logo-yellow.png" alt="">
                  </router-link>
              </div>
              <ul class="menu-list menu">
                  <li><router-link :to="{ name: 'index'}">דף הבית</router-link></li>
                  <li><router-link :to="{ name: 'about-us'}">אודות</router-link></li>
                  <li><router-link :to="{ name: 'contact-us'}">צור קשר</router-link></li>
              </ul>
          </div>

          <div class="socials-wrap">
              <a href="#" class="telegram"></a>
              <a href="#" class="youtube"></a>
              <a href="#" class="facebook"></a>
              <a href="#" class="instagram"></a>
          </div>

          <div class="auth-btns">
              <template v-if="isLoggedIn">
                <a href="#" class="btn-common btn-red">logout</a>
              </template>
              <template v-else>
                <a href="#" class="btn-common btn-gold-gradient" @click="$root.$root.openReg">הרשמה</a>
                <a href="#" class="btn-common btn-gold-text" @click="$root.$root.openLogin">
                  <span>כניסה</span>
                </a>
              </template>
          </div>

      </div>

      <div class="top-row-inner-mob">
          <div class="menu-wrap">
              <div class="menu-btn toggle-mnu toggle-nav item-menu-nav">
                  <span></span>
              </div>


              <div id="nav-panel" class="main-nav modal fade">
      			<div class="modal-content">
      				<div class="main-nav-content">
      					<ul id="menu-primary-menu" class="menu">
                  <li class="menu-item">
                    <router-link :to="{ name: 'index'}">
                      <img src="/img/logo-gradient.png" width="124px" alt="">
                    </router-link>
                  </li>
      						<li class="menu-item">
      							<router-link :to="{ name: 'index'}">דף הבית</router-link>
      						</li>
      						<li class="menu-item">
      							<router-link :to="{ name: 'about-us'}">אודות</router-link>
      						</li>
      						<li class="menu-item">
      							<router-link :to="{ name: 'contact-us'}">צור קשר</router-link>
      						</li>
                  <li class="menu-item">
                    <a href="#" class="btn-common btn-gold-gradient" @click="$root.$root.openReg">הרשמה</a>
                    <a href="#" class="btn-common btn-gold-text" @click="$root.$root.openLogin">
                      <span>כניסה</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <div class="socials-wrap">
                      <a href="#" class="telegram"></a>
                      <a href="#" class="youtube"></a>
                      <a href="#" class="facebook"></a>
                      <a href="#" class="instagram"></a>
                    </div>
                  </li>
      					</ul>
      				</div>
      			</div>
      		</div>


          </div>
          <router-link :to="{ name: 'index'}" class="logo-wrap">
            <img src="/img/logo-yellow.png" alt="">
          </router-link>

      </div>
  </div><!-- top row end -->
</template>

<script>
export default {
  data(){
    return {
      isLoggedIn: false
    }
  },
  created() {
    // axios
    //   .post('/')
    //     .then(res => {
    //       console.log(res);
    //       if(res. ==) {
    //         this.isLoggedIn = true;
    //       }
    //     });
  }
}
</script>

<style lang="css" scoped>
</style>
