<template>
  <div class="admin-login admin-theme-main">
    <div class="admin-login-container">
      <div class="login-wrapper admin-theme-secondary">
        <!-- <div class="login-banner">Student Portal Mobile App</div> -->
        <div class="login-form">
          <div class="title"><h2>Administrator Login</h2></div>
          <el-form
            :label-position="labelPosition"
            label-width="100px"
            :model="formLabelAlign"
          >
            <el-form-item label="Username">
              <el-input v-model="ruleForm.user" type="text"></el-input>
            </el-form-item>
            <el-form-item label="Password">
              <el-input v-model="ruleForm.pass" type="password"></el-input>
            </el-form-item>
            <el-button size="medium" type="success" @click="login()"
              >Login</el-button
            >
          </el-form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: "AdminLogin",
  components: {},
  data() {
    return {
      labelPosition: "top",
      formLabelAlign: {
        name: "",
        region: "",
        type: ""
      },
      ruleForm: {
        user: "",
        pass: ""
      }
    };
  },
  methods: {
    login() {
      this.$router.push({ name: "AdminHome" });
    }
  }
};
</script>
<style lang="scss">
.admin-login {
  .admin-login-container {
    min-height: 100vh;
    min-width: 1200px;
    display: flex;
    justify-content: center;
    align-items: center;

    .login-wrapper {
      height: auto;
      width: 390px;
      padding: 30px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
      .title {
        margin-bottom: 15px;
      }

      form .el-form-item {
        text-align: left;
        margin-bottom: 15px;

        .el-form-item__label {
          line-height: 20px;
        }
      }

      .el-button {
        width: 100%;
        margin-top: 10px;
      }
    }
  }
}
</style>
