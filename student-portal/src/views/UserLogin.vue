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
              icon="photo-o"
              @click="selectUser(key)"
              :class="item == currentUserType ? 'active' : null"
              :text="item"
            />
          </van-grid>
        </div>
        <van-form @submit="login()">
          <van-field
            v-model="userDetails.username"
            name="Username"
            label="Username"
            placeholder="Username"
            :rules="[{ required: true, message: 'Username is required' }]"
          />
          <van-field
            v-model="userDetails.password"
            type="password"
            name="Password"
            label="Password"
            placeholder="Password"
            :rules="[{ required: true, message: 'Password is required' }]"
          />
          <div style="margin: 16px;">
            <van-button round block type="info" native-type="submit">
              Login
            </van-button>
          </div>
        </van-form>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src

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
    login() {
      this.$store.dispatch("setUserDetails", this.userDetails);
      this.$router.push({ name: "UserHome" });
    }
  },
  computed: {
    currentUserType() {
      return this.$store.state.userType;
    }
  }
};
</script>
