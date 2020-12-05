<template>
  <div class="footer">
    <van-tabbar v-model="active">
      <van-tabbar-item
        v-for="(item, key) in footerItems"
        :key="key"
        @click="goPage(item.link)"
        :icon="item.icon"
      >
        {{ item.name }}
      </van-tabbar-item>
    </van-tabbar>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: "Footer",
  components: {},
  data() {
    return {
      active: 0,
      footerItems: [
        {
          name: "Home",
          icon: "home-o",
          link: "UserHome"
        },
        {
          name: "Class",
          icon: "notes-o",
          link: "Class"
        },
        {
          name: "Message",
          icon: "comment-o",
          link: "MessageList"
        },
        {
          name: "Settings",
          icon: "setting-o",
          link: "Settings"
        }
      ]
    };
  },
  props: {
    activeItem: {
      type: Number,
      default: 0
    }
  },
  methods: {
    goPage(url) {
      this.$router.push({ name: url });
    }
  },
  mounted() {
    this.active = this.activeItem;
  }
};
</script>
<style lang="scss">
.footer .van-tabbar {
  box-shadow: 0px 1px 5px 1px rgba(0, 0, 0, 0.25);
}
</style>
