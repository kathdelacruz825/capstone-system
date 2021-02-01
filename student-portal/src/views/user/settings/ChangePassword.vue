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
import { Toast } from "vant";

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
    async changPassword() {
      if (this.newPass == this.confirmPass) {
        let params = {
          request: this.userDetails.AccountType == "1" ? 9 : 11,
          data: {
            ID: this.userDetails.AccountID,
            currPassword: this.currPass,
            newPass: this.newPass
          }
        };
        await this.http
          .post(
            this.userDetails.AccountType == "1"
              ? this.api.StudentService
              : this.api.ParentService,
            params
          )
          .then(response => {
            if (response.data.State == 1) {
              Dialog.alert({
                title: "Change Password",
                message: response.data.Message,
                confirmButtonText: "Confirm"
              }).then(() => {
                this.$store.dispatch("setLogin", false);
                localStorage.removeItem("user");
                this.$router.push({ name: "UserLogin" });
              });
            } else {
              Toast(response.data.Message);
            }
          })
          .catch(error => {
            Toast("Connection Error");
            console.log(error);
          });
      } else {
        Toast("New password and confirm password does not match.");
      }
    }
  },
  computed: {},
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  }
};
</script>
