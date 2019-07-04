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
          <div v-if="user.status == 'online'" class="status online"><span>{{user.status}}</span></div>
          <div v-if="user.status == 'offline'" class="status offline"><span>{{user.status}}</span></div>
          <div class="action">
            <button type="submit" @click="deleteUser(user.id)">D</button>
            <button type="submit" @click="updateUser(user.id,user.name,user.email,user.phone)">S</button>
            <button type="submit" @click="makeUserAdmin(user.id)">A</button>
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
          // console.log( response.data );
          this.users = response.data;
        })
  },
  methods : {
    updateUser(id, name, email, phone) {
      console.log(id, name, email, phone);

    },
    deleteUser(id) {
      console.log(id);
      axios
        .post('/deleteAdmin', { userId : id})
          .then(res => {
            console.log(res);
          });
    },
    makeUserAdmin(id) {
      console.log(id);
      axios
        .post('/makeUserAdmin', { userId : id})
          .then(res => {
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
