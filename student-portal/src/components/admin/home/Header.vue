<template>
  <div class="header">
    <div class="header-left">
      <h3>Student Portal Administrator</h3>
    </div>
    <div class="header-right">
      <el-dropdown trigger="click" @command="selectAction">
        <span class="el-dropdown-link">
          <el-avatar :size="40" :src="userDetails.Icon" @error="errorHandler">
            <img
              src="https://cube.elemecdn.com/e/fd/0fc7d20532fdaf769a25683617711png.png"
            />
          </el-avatar>
          <i class="el-icon-arrow-down el-icon--right"></i>
        </span>
        <el-dropdown-menu slot="dropdown">
          <!-- <el-dropdown-item>Notifications</el-dropdown-item> -->
          <el-dropdown-item :command="0">Edit Account</el-dropdown-item>
          <el-dropdown-item :command="1">Log out</el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
    </div>
  </div>
</template>
<script>
export default {
  name: "Header",
  components: {},
  data() {
    return {
      userDetails: {}
    };
  },
  methods: {
    errorHandler() {
      return true;
    },
    selectAction(val) {
      if (val === 0) {
        console.log(val);
      } else {
        this.logout();
      }
    },
    logout() {
      this.$store.dispatch("setLogin", false);
      localStorage.removeItem("user");
      this.$router.push({ name: "AdminLogin" });
    }
  },
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  }
};
</script>
<style lang="scss">
.header {
  display: flex;
  flex-direction: row;
  align-items: center;
  height: 100%;
  & > div {
    flex: 1;
  }

  .header-left {
    text-align: left;
  }

  .header-right {
    text-align: right;
    display: flex;
    align-items: center;
    justify-content: flex-end;
  }

  .el-dropdown-link {
    display: flex;
    align-items: center;
  }
}
</style>
