<template>
  <div class="nav">
    <van-nav-bar
      :title="title"
      :left-text="isLeftArrow ? 'Back' : ''"
      :right-text="isRightText ? 'Logout' : ''"
      :left-arrow="isLeftArrow"
      @click-left="onClickLeft"
      @click-right="logout"
    />
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: "Nav",
  components: {},
  data() {
    return {};
  },
  props: {
    title: {
      type: String,
      default: ""
    },
    isLeftArrow: {
      type: Boolean,
      default: false
    },
    isRightText: {
      type: Boolean,
      default: false
    },
    showRefresh: {
      type: Boolean,
      default: false
    },
  },
  methods: {
    onClickLeft() {
      this.$router.go(-1);
    },
    logout() {
      this.$router.push({ name: "UserLogin" });
      // Toast('Button');
    },
    refresh() {
      console.log("test");
    }
  }
};
</script>
<style lang="scss">
.nav .van-nav-bar__content {
  box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.25);
}
</style>
