<template>
  <div class="user-login">
    <div class="login-wrapper">
      <div class="login-banner">
        <h2>STUDENT PORTAL</h2>
        <h3>MOBILE APP</h3>
      </div>
      <div class="login-form">
        <div class="user-select">
          <van-grid :column-num="2" :gutter="30">
            <van-grid-item
              v-for="(item, key) in userType"
              :key="key"
              @click="selectUser(key)"
              :class="item == currentUserType ? 'active' : null"
              :text="item"
            >
            <van-image
              width="100px"
              height="100px"
              fit="contain"
              :src="require('@/assets/'+item+'.jpg')"
            />
            <span>{{ item }}</span>
            </van-grid-item>
          </van-grid>
        </div>
        <van-form @submit="login()">
          <van-field
            v-model="userDetails.userID"
            name="Username"
            label="Account ID"
            placeholder="Enter Account ID"
            :rules="[{ required: true, message: 'Username is required' }]"
          />
          <van-field
            v-model="userDetails.password"
            type="password"
            name="Password"
            label="Password"
            placeholder="Enter password"
            :rules="[{ required: true, message: 'Password is required' }]"
          />
          <div style="margin: 16px;">
            <van-button round block type="info" native-type="submit">
              Login
            </van-button>
          </div>
        </van-form>
        <div class="other-options">
          <!-- <div @click="goPage('ForgotPassword')">Forgot Password?</div> -->
          <div
            @click="goPage('Register')"
            style="margin-top: 40px; text-align: center; padding: 0px 16px;"
          >
            Register
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import { Toast } from "vant";
export default {
  name: "UserLogin",
  components: {},
  data() {
    return {
      username: "",
      password: "",
      activeUser: 0,
      userType: ["Student", "Parent"],
      userDetails: {
        username: "",
        userID: "",
        password: ""
      }
    };
  },
  methods: {
    selectUser(index) {
      this.activeUser = index;
      this.$store.dispatch("setUserType", this.userType[this.activeUser]);
    },
    async login() {
      var params = {
        request: 2,
        data: {
          AccountID: this.userDetails.userID,
          AccountPassword: this.userDetails.password
        }
      };
      await this.http
        .post(
          this.currentUserType == "Student"
            ? this.api.StudentService
            : this.api.ParentService,
          params
        )
        .then(response => {
          if (response.data.length > 0) {
            this.$store.dispatch("setUserDetails", response.data[0]);
            localStorage.setItem("user", JSON.stringify(response.data[0]));
            // localStorage.setItem("isLogin", true);
            this.$store.dispatch("setLogin", true);
            this.goPage("UserHome");
          } else {
            Toast("Invalid Account");
          }
        })
        .catch(error => {
          Toast("Connection Error");
          console.log(error);
        });
    },
    goPage(url) {
      this.$router.push({ name: url });
    }
  },
  computed: {
    currentUserType() {
      return this.$store.state.userType;
    }
  }
};
</script>
