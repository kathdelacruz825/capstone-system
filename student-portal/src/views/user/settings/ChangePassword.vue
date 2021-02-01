<template>
  <div class="about">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <van-form @submit="changPassword">
      <div style="margin-top: 10px;">
        <van-field
          v-model="currPass"
          type="password"
          name="Password"
          label="Current Password:"
          placeholder="Enter password"
          :rules="[
            { required: true, message: 'Enter current password is required' }
          ]"
        />
        <van-field
          v-model="newPass"
          type="password"
          name="New Password"
          label="New Password:"
          placeholder="Enter New password"
          :rules="[
            { required: true, message: 'Enter new password is required' }
          ]"
        />

        <van-field
          v-model="confirmPass"
          type="password"
          name="Confirm Password"
          label="Confirm Password:"
          placeholder="Enter confirm password"
          :rules="[
            { required: true, message: 'Enter confirm password is required' }
          ]"
        />

        <div style="margin: 16px;">
          <van-button round block type="info" native-type="submit">
            Change Password
          </van-button>
        </div>
      </div>
    </van-form>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
// import Footer from "@/components/user/common/Footer.vue";
import { Dialog } from "vant";

export default {
  name: "ChangePassword",
  components: {
    Nav
    // Footer
  },
  data() {
    return {
      pageTitle: "Change Password",
      userDetails: {},
      currPass: "",
      newPass: "",
      confirmPass: ""
    };
  },
  methods: {
    changPassword() {
      Dialog.alert({
        title: "Change Password",
        message: "Your Password has been changed! Please login again.",
        confirmButtonText: "Confirm"
      }).then(() => {
        this.$store.dispatch("setLogin", false);
        localStorage.removeItem("user");
        this.$router.push({ name: "UserLogin" });
      });
    }
  },
  computed: {},
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  }
};
</script>
