<template>
  <div class="top-row">
      <div class="top-row-inner">
          <div class="menu-col-wrap">
              <div class="logo-wrap">
                  <router-link :to="{ name: 'index'}">
                      <img src="/img/new-logo-yellow.png" alt="">
                  </router-link>
              </div>
              <ul class="menu-list menu">
                  <li><router-link :to="{ name: 'index'}">דף הבית</router-link></li>
                  <li><router-link :to="{ name: 'about-us'}">אודות</router-link></li>
                  <li><router-link :to="{ name: 'contact-us'}">צור קשר</router-link></li>
              </ul>
          </div>

          <div class="socials-wrap">
              <a href="https://t.me/Israelbidurofficial" class="telegram"></a>
              <a href="https://www.youtube.com/channel/UCOLazqXMJrjGVWW1vLmylsw" class="youtube"></a>
              <a href="https://www.facebook.com/%D7%99%D7%A9%D7%A8%D7%90%D7%9C-%D7%91%D7%99%D7%93%D7%95%D7%A8-353719708444460/" class="facebook"></a>
              <a href="https://www.instagram.com/israel_bidur/" class="instagram"></a>
          </div>

          <div class="auth-btns">
              <search-form class="search-form"></search-form>

              <template v-if="isLoggedIn">
                <div class="my-account-wrap">
                  <div class="my-account">
                    <router-link class="my-account-link" :to="{ name: 'my-account' }">היי, {{ user.name }}</router-link>
                    <ul class="profile-nav">
                      <li>
                        <router-link
                          class="profile-settings"
                          :to="{ name: 'edit-profile' }">
                          הגדרות פרופיל
                        </router-link>
                      </li>
                      <li>
                        <router-link
                          class="favourite-posts"
                          :to="{ name: 'my-account' }">
                          כתבות מועדפות
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </div>

                <a href="#" @click="logout" class="logout-btn">להתנתק</a>
              </template>
              <template v-else>
                <button
                  class="btn-common btn-gold-gradient"
                  @click="$root.openReg"
                >הרשמה</button>
                <a href="#" class="btn-common btn-gold-text" @click="$root.openLogin">
                  <span>כניסה</span>
                </a>
              </template>
          </div>

      </div>

      <div class="top-row-inner-mob">
        <div class="menu-wrap">
            <div class="menu-btn toggle-mnu toggle-nav item-menu-nav"
              :class="{active: menuActive}"
              @click="menuActive = !menuActive">
                <span></span>
            </div>

            <div id="nav-panel" class="main-nav modal fade">
        			<div class="modal-content">
        				<div class="main-nav-content">
        					<ul id="menu-primary-menu" class="menu">
                    <li class="menu-item">
                      <router-link :to="{ name: 'index'}">
                        <img src="/img/new-logo-yellow.png" width="200px" alt="">
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
                    <template v-if="isLoggedIn">
                      <li class="menu-item">
                        <router-link :to="{ name: 'my-account'}">כתבות מועדפות</router-link>
                      </li>
                      <li class="menu-item">
                        <router-link :to="{ name: 'edit-profile'}">הגדרות פרופיל</router-link>
                      </li>
                      <li class="menu-item">
                        <div class="auth-btns">
                          <a href="#" @click="logout" class="btn-common btn-gold-gradient logout"><span>להתנתק</span></a>
                          <!-- <a href="./#/my-account" class="btn-common btn-gold-text my-account"><span>החשבון שלי</span></a> -->
                        </div>
                      </li>
                    </template>
                    <template v-else>
                      <li class="menu-item">
                        <div class="auth-btns">
                          <a href="#" class="btn-common btn-gold-gradient" @click="$root.$root.openReg">הרשמה</a>
                          <a href="#" class="btn-common btn-gold-text" @click="$root.$root.openLogin">
                            <span>כניסה</span>
                          </a>
                        </div>
                      </li>
                    </template>
                    <li class="menu-item">
                      <div class="socials-wrap">
                        <a href="https://t.me/Israelbidurofficial" class="telegram"></a>
                        <a href="https://www.youtube.com/channel/UCOLazqXMJrjGVWW1vLmylsw" class="youtube"></a>
                        <a href="https://www.facebook.com/%D7%99%D7%A9%D7%A8%D7%90%D7%9C-%D7%91%D7%99%D7%93%D7%95%D7%A8-353719708444460/" class="facebook"></a>
                        <a href="https://www.instagram.com/israel_bidur/" class="instagram"></a>
                      </div>
                    </li>
        					</ul>
        				</div>
        			</div>
        		</div>

          </div>
          <search-form-mob class="search-form-mob"></search-form-mob>
          <span class="header-text">הבית של הבידור הישראלי</span>
          <router-link :to="{ name: 'index'}" class="logo-wrap">
            <img src="/img/new-logo-yellow.png" alt="">
          </router-link>

      </div>
  </div><!-- top row end -->
</template>

<script>
import SearchForm from './SearchForm.vue';
import SearchFormMob from './SearchFormMob.vue';

export default {
  data(){
    return {
      menuActive: false,
      isLoggedIn: false,
      user: {},
    }
  },
  components: {
    SearchForm,
    SearchFormMob,
  },
  created() {
    axios
      .post('/api/getUserData')
        .then(res => {
          if(res.data.login == true) {
            this.isLoggedIn = true;
            console.log();
          }
          this.user = res.data.data;
          this.$root.is_user_logged_in = res.data.login;
          this.$root.user = this.user;
        });
  },
  methods : {
    logout() {
      axios
        .get('/api/logout')
          .then(res => {
            document.location.reload(true);
          });
    }
  },
  watch: {
    '$route' () {
      this.menuActive = false;
    }
  }
}
</script>

<style lang="scss" scoped>
.fixedMobileAd {
  position: fixed;
  bottom: 0;
  bottom: env(safe-area-inset-bottom);
  left:0;
  right:0;
  height: 90px;
  overflow: hidden;
  max-height: 90px;
  width:100%;
  z-index:2;
  background-color: #eee;
  display: flex;
  justify-content: center;
  align-items: center;

  .adswrapper {
    width: 100%;
    height: 90px;
  }
}
</style>
