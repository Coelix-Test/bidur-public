<template>
  <div class="edit-profile">
    <h1>הגדרות פרופיל</h1>
    <div v-if="userData" class="edit-profile-wrapper">
      <div class="personal-info">
        <h2>מידע אישי</h2>
        <form  action="">
          <div class="form-group">
            <label for="name">שם מלא</label>
            <input type="text" id="name" name="name" v-model="userData.name" maxlength="20">
          </div>
          <div class="form-group">
            <label for="name">מספר טלפון</label>
            <input type="text" id="phone" name="phone" v-model="userData.phone" maxlength="15" dir="ltr" style="text-align:right;">
          </div>
          <button type="submit" @click="updatePersonalInfo" class="submit-button">שמור</button>
        </form>
      </div>
      <div class="password">
        <h2>שנה סיסמה</h2>
        <form action="">
          <div class="form-group">
            <label for="current_password">סיסמה נוכחית</label>
            <input type="password" id="current_password" name="current_password" v-model="oldPass">
          </div>
          <div class="form-group">
            <label for="new_password">סיסמה חדשה</label>
            <input type="password" id="new_password" name="new_password" v-model="newPass" minlength="6" maxlength="20">
          </div>
          <div class="form-group">
            <label for="confirm_password">אימות סיסמה</label>
            <input type="password" id="confirm_password" name="confirm_password" v-model="confirmPass" minlength="6" maxlength="20">
          </div>
          <button type="submit" @click="changePassword" class="submit-button">שמור</button>
        </form>
      </div>
    </div>
    <div v-if="userData == null" class="notice">
      עליך להתחבר כדי לראות דף זה!
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      userData : null,
      oldPass : null,
      newPass : null,
      confirmPass : null,
    }
  },
  created() {
    axios
      .post('/getPersonalInfo')
        .then(res => {

          if(res.data.success == false) {
            this.userData = null;
          }else {
            this.userData = res.data;
          }
        });
  },
  methods : {
    updatePersonalInfo(e) {
      e.preventDefault();
      axios
        .post('/changePersonalInfo',{ name : this.userData.name, phone : this.userData.phone})
          .then(res => {
              // console.log(res);
              if(res.data.success == true) {
                alert('Data was successfully edited!')
              }
            });
    },
    changePassword(e) {
      e.preventDefault();
      let oldPass = this.oldPass;
      let newPass = this.newPass;
      let confirmPass = this.confirmPass;
      if(newPass === confirmPass && newPass != null && newPass.length >= 5) {
        axios
          .post('/checkPassword', { oldPassword : oldPass })
            .then(res => {
              // console.log(res);
              if(res.data.success == true) {
                axios
                  .post('/changePassword',{ password : newPass })
                    .then(res=>{
                       // console.log(res);
                       alert('סיסמא שונתה!');
                    })
              }else if(res.data.success == false){
                alert('הסיסמה הישנה אינה תואמת');
              }
            })
      }else {
        alert('הסיסמה החדשה אינה תואמת');
      }

    }
  },
}
</script>

<style lang="scss" scoped>
  .edit-profile {
    max-width:1440px;
    margin:0 auto;
    padding: 32px 24px;
    color:#333;
    box-sizing: border-box;
    h1 {
      font-weight: 700;
      text-align: center;
      margin-bottom: 16px;
    }
    .edit-profile-wrapper {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: flex-start;
      > div {
        padding:0 12px;
        width:320px;
        box-sizing: border-box;
        h2 {
          font-weight: 700;
        }
        form {
          .form-group {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            input {
              padding:6px 12px;
              font-size: 16px;
              color:#333;
              border-radius: 5px;
              border: 1px solid #333;
              width: 100%;
            }
          }
          button {
            width:100%;
            padding:12px 16px;
            font-size: 20px;
            border-width:0;
            background: linear-gradient(294.72deg, #D3A01D 1.57%, #F2C94C 98.82%);
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
            border-radius: 5px;
            color:#fff;
          }
        }
      }
    }
  }
  @media (max-width:768px) {
    .edit-profile {
      padding:24px 12px;
      .edit-profile-wrapper {
        flex-direction: column;
        > div {
          width:100%;
          margin-bottom: 24px;
        }
      }
    }
  }
</style>
