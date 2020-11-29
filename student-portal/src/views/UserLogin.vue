<template>
  <div class="user-login">
    <div class="login-wrapper">
      <div class="login-banner">
        <h2>Student Portal Mobile App</h2>
      </div>
      <div class="login-form">
        <div class="user-select">
          <van-grid :column-num="2" :gutter="10">
            <van-grid-item icon="photo-o" text="Student" />
            <van-grid-item icon="photo-o" text="Parent" />
          </van-grid>
        </div>
        <van-form @submit="onSubmit">
          <van-field
            v-model="username"
            name="Username"
            label="Username"
            placeholder="Username"
            :rules="[{ required: true, message: 'Username is required' }]"
          />
          <van-field
            v-model="password"
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
      username: '',
      password: '',
    };
  },
  methods: {
    onSubmit(values) {
      console.log('submit', values);
    },
  },
};
</script>
