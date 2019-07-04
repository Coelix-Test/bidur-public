<template>
  <div class="users">
    <div class="usersTable">
      <div class="heading">
        <div class="name">Name</div>
        <div class="mail">Mail</div>
        <div class="phone">Phone</div>
        <div class="status">Status</div>
        <div class="action">Action</div>
      </div>
      <div class="content">
        <div class="user">
          <div class="name">Name</div>
          <div class="mail">Mail</div>
          <div class="phone">Phone</div>
          <div class="status">Status</div>
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
          console.log( response );
        })
  }
}
</script>

<style lang="scss" scoped>
  .users {
    max-width: 1440px;
    margin:32px auto;
    padding:0 24px;
      .usersTable {
        .heading {
          width:100%;
          display: flex;
          flex-direction: row;
          flex-wrap:nowrap;
            > div {
              flex-basis:25%;
            }
        }
        .content {
          .user {
            width:100%;
            display: flex;
            flex-direction: row;
            flex-wrap:nowrap;
              > div {
                flex-basis:25%;
              }
          }
        }
      }

  }
</style>
