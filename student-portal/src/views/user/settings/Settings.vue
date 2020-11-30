<template>
  <div class="settings">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false"/>
    <div class="content">
      <div class="user-info">
        <div class="user-icon">
          <van-image width="100" height="100" src="https://img.yzcdn.cn/vant/cat.jpeg" />
        </div>
        <div class="user-details">
          <span>ID number: {{ '12345' }}</span>
          <span>Name: {{ 'testuser' }}</span>
          <span>Year: {{ '1st year' }}</span>
        </div>
      </div>
      <div class="links">
        <van-cell-group>
        <van-cell icon="location-o" title="View Information" is-link />
          <van-cell icon="location-o" title="Edit Information" is-link />
          <van-cell icon="location-o" title="View Parent Information" is-link />
          <van-cell icon="location-o" title="Change Password" is-link />
        </van-cell-group>
      </div>
      <div class="logout-btn">
      <van-button type="primary" round size="normal">Logout</van-button>
      </div>
    </div>
    <Footer :activeItem="3"/>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "Settings",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: 'Settings',
    };
  }
};
</script>
