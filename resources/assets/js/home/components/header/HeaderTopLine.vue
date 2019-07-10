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
              <a href="https://www.instagram.com/israel_bidur/" class="facebook"></a>
              <a href="https://www.facebook.com/%D7%99%D7%A9%D7%A8%D7%90%D7%9C-%D7%91%D7%99%D7%93%D7%95%D7%A8-353719708444460/" class="instagram"></a>
          </div>

          <div class="auth-btns">
              <template v-if="isLoggedIn">
                <button
                  @click="logout"
                  class="btn-common th-btn-gold"
                >להתנתק</button>
                <a href="./#/my-account" class="btn-common btn-gold-text my-account">החשבון שלי</a>
              </template>
              <template v-else>
                <button
                  class="btn-common th-btn-gold"
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
                          <a href="#" @click="logout" class="btn-common btn-gold-gradient logout">להתנתק</a>
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
          <span class="header-text">הבית של הבידור הישראל</span>
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
    axios
      .post('/getUserData')
        .then(res => {
          if(res.data.login == true) {
            this.isLoggedIn = true;
          }
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
  .menu-list {
    a {
      white-space: nowrap;
    }
  }
  .my-account {
    color:#fff;
  }
  @media (max-width:768px) {
    .auth-btns {
      justify-content: center;
      a.logout {
        // margin:0 auto;
        margin-left: 10px!important;
        // margin-right: auto!important;
      }

    }
    .top-row-inner-mob {
      justify-content: center;
      .header-text {
        font-weight: 600;
        flex-grow:2;
        text-align: center;
        overflow:hidden;
      }
    }
    .header-main .top-row-inner .btn-common:first-child,
    .header-main .top-row-inner-mob .btn-common:first-child {
      margin-right: 0!important;
    }
  }
</style>
