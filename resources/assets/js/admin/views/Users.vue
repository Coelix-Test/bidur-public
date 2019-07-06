<template>
  <div class="users">
    <div class="usersTable">
      <div class="heading">
        <div class="name">Name</div>
        <div class="mail">Mail</div>
        <div class="phone">Phone</div>
        <div class="status">Status</div>
        <div class="action">Actions</div>
      </div>
      <div class="content">
        <div v-if="users" v-for="user in users" :key="user.id" class="user">
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
            <button v-if="user.is_current_user == null" type="submit" @click="deleteUser(user.id)">D</button>
            <button type="submit" @click="updateUser(user.id,user.name,user.email,user.phone)">S</button>
            <button v-if="user.is_current_user == null" type="submit" @click="makeUserAdmin(user.id)">A</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users : null,
      user : null
    }
  },
  mounted() {
    axios
      .post('/showAllAdmins')
        .then(response => {
          this.users = response.data;
          console.log(this.users);
        })
  },
  methods : {
    updateUser(id, name, email, phone) {
      axios
        .post('/editAdmin', { userId : id, email : email, name : name , phone : phone})
          .then(res => {
            this.users = res.data;
            alert('User saved');
          });
    },
    deleteUser(id) {
      axios
        .post('/deleteAdmin', { userId : id})
          .then(res => {
            this.users = res.data;
          });
    },
    makeUserAdmin(id) {
      axios
        .post('/makeUserAdmin', { userId : id})
          .then(res => {
            this.users = res.data;
            console.log(res);
          });
    }
  }
}
</script>

<style lang="scss" scoped>
  .users {
    max-width: 1440px;
    margin:32px auto;
    padding:0 24px;
      .usersTable {
        border: 1px solid #F2F2F2;
        box-sizing: border-box;
        .heading {
          width:100%;
          display: flex;
          flex-direction: row;
          flex-wrap:nowrap;
          padding:6px 12px;
          color:#BDBDBD;
            > div.action {
              flex-basis:10%;
            }
            > div.phone {
              direction: ltr;
              text-align: right;
            }
            > div {
              flex-basis:25%;
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
                flex-basis:10%;
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
                        background: limegreen!important;
                      }
                  }
                  &.online {
                    span {
                      background:#EB5757;
                      color:#fff;
                      padding: 4px 12px;
                      border-radius: 10px;
                      text-transform: capitalize;
                    }
                  }

              }
              > div {
                flex-basis:25%;
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
