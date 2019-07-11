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
              <a href="https://t.me/Israelbidurofficial" class="telegram"></a>
              <a href="https://www.israel-bidur.co.il/%D7%90%D7%95%D7%93%D7%95%D7%AA" class="youtube"></a>
              <a href="https://www.facebook.com/%D7%99%D7%A9%D7%A8%D7%90%D7%9C-%D7%91%D7%99%D7%93%D7%95%D7%A8-353719708444460/" class="facebook"></a>
              <a href="https://www.instagram.com/israel_bidur/" class="instagram"></a>
          </div>

          <div class="auth-btns">
              <template v-if="isLoggedIn">
                <div class="my-account-wrap">
                  <div class="my-account">
                    <router-link class="my-account-link" :to="{ name: 'my-account' }">Hey, {{ user.name }}</router-link>
                    <ul class="profile-nav">
                      <li>
                        <router-link
                          class="profile-settings"
                          :to="{ name: 'edit-profile' }">
                          Profile settings
                        </router-link>
                      </li>
                      <li>
                        <router-link
                          class="favourite-posts"
                          :to="{ name: 'my-account' }">
                          Favourite posts
                        </router-link>
                      </li>
                    </ul>
                  </div>
                </div>

                <a href="#" @click="logout" class="logout-btn">Exit</a>
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
              <div class="menu-btn toggle-mnu toggle-nav item-menu-nav">
                  <span></span>
              </div>

              <div id="nav-panel" class="main-nav modal fade">
      			<div class="modal-content">
      				<div class="main-nav-content">
      					<ul id="menu-primary-menu" class="menu">
                  <li class="menu-item">
                    <router-link :to="{ name: 'index'}">
                      <img src="/img/logo-gradient.png" width="148px" alt="">
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

                    <div class="auth-btns">
                        <template v-if="isLoggedIn">
                          <a href="#" @click="logout" class="btn-common btn-gold-gradient logout"><span>להתנתק</span></a>
                          <a href="./#/my-account" class="btn-common btn-gold-text my-account"><span>החשבון שלי</span></a>
                        </template>
                        <template v-else>
                          <a href="#" class="btn-common btn-gold-gradient" @click="$root.$root.openReg">הרשמה</a>
                          <a href="#" class="btn-common btn-gold-text" @click="$root.$root.openLogin">
                            <span>כניסה</span>
                          </a>
                        </template>
                    </div>
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
          <span class="header-text">הבית של הבידור הישראלי</span>
          <router-link :to="{ name: 'index'}" class="logo-wrap">
            <img src="/img/logo-yellow.png" alt="">
          </router-link>

      </div>
      <div v-if="this.$env.mobile" class="fixedMobileAd">
        Mobile ads
      </div>
  </div><!-- top row end -->
</template>

<script>
export default {
  data(){
    return {
      isLoggedIn: false,
      user: {},
    }
  },
  created() {
    axios
      .post('/getUserData')
        .then(res => {
          if(res.data.login == true) {
            this.isLoggedIn = true;
            console.log();
          }
          this.$root.is_user_logged_in = res.data.login;
          this.user = res.data.data;
        });
  },
  methods : {
    logout() {
      axios
        .get('/logout')
          .then(res => {
            document.location.reload(true);
          });
    }
  }
}
</script>

<style lang="scss" scoped>
  .fixedMobileAd {
    position: fixed;
    bottom:0;
    left:0;
    right:0;
    height:60px;
    width:100%;
    z-index:2;
    background-color: #eee;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
