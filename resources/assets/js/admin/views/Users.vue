<template>
  <div class="users">
    <div class="search">
      <input type="text" @input="renderSearch" v-model="searchQuery" placeholder="שם משתמש">
    </div>
    <div class="usersTable">
      <div class="heading">
        <div class="name">שם משתמש</div>
        <div class="mail">תאריך</div>
        <div class="phone">טלפון</div>
        <div class="status">סטטוס</div>
        <div class="action">סוג משתמש</div>
      </div>
      <div v-if="users" class="content">
        <div v-if="users && user.id != 1" v-for="user in users" :key="user.id" class="user">
          <div class="name"><input type="text" name="username" v-model="user.name" minlength="2" required></div>
          <div class="mail"><input type="email" name="mail" v-model="user.email" minlength="2" required></div>
          <div class="phone"><input type="text" name="phone" v-model="user.phone" minlength="2" required></div>
          <div v-if="user.status == 'online'" class="status online">
            <span v-if="user.is_admin == true" class="is_admin">Admin</span>
            <span>{{user.status}}</span>
          </div>
          <div v-if="user.status == 'offline'" class="status offline">
            <span v-if="user.is_admin == true" class="is_admin">Admin</span>
            <span>{{user.status}}</span>
          </div>
          <div class="action">
            <button v-if="user.is_current_user == null" type="submit" @click="deleteUser(user.id)">מחיקה</button>
            <button type="submit" @click="updateUser(user.id,user.name,user.email,user.phone)">שמור</button>
            <button v-if="user.is_current_user == null" type="submit" @click="makeUserAdmin(user.id)">הגדר כמנהל</button>
          </div>
        </div>
      </div>
      <div v-if="users == null" class="notice">
        משתמשים לא נמצאו!
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users : null,
      user : null,
      searchQuery : null,
    }
  },
  mounted() {
    axios
      .post('/api/showAllAdmins')
        .then(response => {
          this.users = response.data;
          console.log(this.users);
        })
  },
  methods : {
    updateUser(id, name, email, phone) {
      axios
        .post('/api/editAdmin', { userId : id, email : email, name : name , phone : phone})
          .then(res => {
            this.users = res.data;
            alert('User saved');
          });
    },
    deleteUser(id) {
      let result = confirm('מחק משתמש?');
      if(result == true) {
        axios
          .post('/api/deleteAdmin', { userId : id})
            .then(res => {
              this.users = res.data;
            });
      }
    },
    makeUserAdmin(id) {
      axios
        .post('/api/makeUserAdmin', { userId : id})
          .then(res => {
            this.users = res.data;
          });
    },
    renderSearch() {
      axios
        .post('/api/userSearch', { search : this.searchQuery })
          .then(res => {
            if(res.data.success != false) {
              this.users = res.data;
            }else {
              this.users = null;
            }
          })
          .catch(error => this.users = null);
    }
  }
}
</script>

<style lang="scss" scoped>
  .users {
    max-width: 1440px;
    margin:32px auto;
    padding:0 24px;
    .search {
      padding:0 24px 16px;
      display: flex;
      flex-direction: row;
      justify-content: center;
      input {
        width:300px;
        padding:6px 16px;
        font-size: 16px;
        color:#333;
      }
    }
      .usersTable {
        border: 1px solid #F2F2F2;
        box-sizing: border-box;
        .heading {
          width:100%;
          display: flex;
          flex-direction: row;
          flex-wrap:nowrap;
          padding:6px 12px;
          color:#333;
            > div.action {
              flex-basis:20%;
            }
            > div.phone {
              direction: ltr;
              text-align: right;
            }
            > div {
              flex-basis:20%;
              padding-left: 16px;
              overflow:hidden;
            }
        }
        .content {
          .user {
            width:100%;
            padding:6px 12px;
            display: flex;
            flex-direction: row;
            flex-wrap:nowrap;
              > div.action {
                flex-basis:20%;
                  button {
                    border-width:0;
                    background-color: transparent;
                    color:#828282;
                    font-weight: 900;
                      &:hover {
                        color:#EB5757;
                      }
                  }
              }
              > div.phone {
                direction: ltr;
                text-align: right;
                  input {
                    text-align: right;
                  }
              }
              > div.status {
                  span {
                    background: #BDBDBD;
                    color:#fff;
                    border-radius: 10px;
                    padding: 4px 12px;
                    text-transform: capitalize;
                      &.is_admin {
                        background: #0088cc!important;
                      }
                  }
                  &.online {
                    span {
                      background:limegreen;
                      color:#fff;
                      padding: 4px 12px;
                      border-radius: 10px;
                      text-transform: capitalize;
                    }
                  }

              }
              > div {
                flex-basis:20%;
                padding-left: 16px;
                overflow:hidden;
                padding-top: 4px;
                  input {
                    border-color:transparent;
                    border-style: solid;
                    padding:4px;
                      &:hover {
                        border-color: #eee;
                      }
                  }
              }
          }
        }
      }

  }
</style>
