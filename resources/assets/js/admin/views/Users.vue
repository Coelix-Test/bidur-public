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
        <div v-if="users" v-for="user in users" :key="" class="user">
          <div class="name"><input name="username" :value="user.name"></div>
          <div class="mail"><input name="mail" :value="user.email"></div>
          <div class="phone"><input name="phone" :value="user.phone"></div>
          <div v-if="user.status == 'online'" class="status online"><span>{{user.status}}</span></div>
          <div v-if="user.status == 'offline'" class="status offline"><span>{{user.status}}</span></div>
          <div class="action">Action</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users : null
    }
  },
  mounted() {
    axios
      .post('/showAllAdmins')
        .then(response => {
          console.log( response.data );
          this.users = response.data;
        })
  },
  methods : {
    updateUser() {
      console.log('update');
    },
    deleteUser() {
      console.log('delete');
    },
    makeUserAdmin() {
      console.log('make user admin');
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
