<template>
  <div class="edit-profile">
    <h1>ערוך פרופיל</h1>
    <div class="edit-profile-wrapper">
      <div class="personal-info">
        <h2>מידע אישי</h2>
        <form action="">
          <div class="form-group">
            <label for="name">שם מלא</label>
            <input type="text" id="name" name="name">
          </div>
        </form>
      </div>
      <div class="password">
        <h2>שנה סיסמא</h2>
        <form action="">

        </form>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      userData : null,
    }
  },
  created() {
    axios
      .post('/getPersonalInfo')
        .then(res => {
          console.log(res.data);
        });
  }
}
</script>

<style lang="scss" scoped>
  .edit-profile {
    max-width:1440px;
    margin:0 auto;
    padding: 32px 24px;
    .edit-profile-wrapper {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: flex-start;
    }
  }
</style>
