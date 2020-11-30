<template>
  <div class="admin-login">
    <div class="login-wrapper">
      <div class="login-banner">Student Portal Mobile App</div>
      <div class="login-form">
        <div><h2>Admin Login</h2></div>
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
          <el-button size="medium" @click="login()">Login</el-button>
        </el-form>
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
      labelPosition: "right",
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
      this.$router.push({ name: "AdminLogin" });
    }
  }
};
</script>
