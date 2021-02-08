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
          <el-dropdown-item :command="1">Change Password</el-dropdown-item>
          <el-dropdown-item :command="2">Log out</el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
    </div>
    <UpdateAccount 
      v-if="showUpdateUser"
      :showUpdateUser="showUpdateUser"
      :userData="userDetails"
      @CloseUpdateUser="CloseUpdateUser($event)"/>

    <UpdatePassword 
      v-if="showUpdatePass"
      :showUpdatePass="showUpdatePass"
      :userData="userDetails"
      @successUpdate="successUpdate($event)"
      @closePassword="closePassword($event)"/>

    <el-dialog
      title="System Info"
      :visible.sync="centerDialogVisible"
      width="30%"
      center>
      <span>Password successfully changed, please log in again</span>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="logout()">Confirm</el-button>
      </span>
    </el-dialog>


  </div>
</template>
<script>
import UpdateAccount from '@/components/admin/content/header/UpdateAccount';
import UpdatePassword from '@/components/admin/content/header/UpdatePassword';

export default {
  name: "Header",
  components: {
    UpdateAccount,
    UpdatePassword
  },
  data() {
    return {
      userDetails: {},
      showUpdateUser: false,
      showUpdatePass: false,
      centerDialogVisible: false,
    };
  },
  methods: {
    errorHandler() {
      return true;
    },
    selectAction(val) {
      if (val == 0) {
        this.showUpdateUser = true;
      } else if (val == 1) {
        this.showUpdatePass = true;
      } else {
        this.logout();
      }
    },
    logout() {
      this.$store.dispatch("setLogin", false);
      localStorage.removeItem("user");
      this.$router.push({ name: "AdminLogin" });
    },
    CloseUpdateUser(val) {
      this.showUpdateUser = val;
    },
    closePassword(val) {
      this.showUpdatePass = val;
    },
    successUpdate(val) {
      this.centerDialogVisible = val;
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
