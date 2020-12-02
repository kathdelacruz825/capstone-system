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
          name: "Subjects",
          icon: "notes-o",
          link: ""
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
