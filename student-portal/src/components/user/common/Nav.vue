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
    }
  },
  methods: {
    onClickLeft() {
      this.$router.go(-1);
    },
    logout() {
      this.$router.push({ name: "UserLogin" });
      // Toast('Button');
    }
  }
};
</script>
