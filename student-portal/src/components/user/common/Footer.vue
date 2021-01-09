<template>
  <div class="footer">
    <van-tabbar v-model="active">
      <van-tabbar-item
        v-for="(item, key) in footerItems[userDetails.AccountType]"
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
      userDetails: {},
      footerItems: {
        0: [],
        1: [
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
            name: "Settings",
            icon: "setting-o",
            link: "Settings"
          }
        ],
        2: [
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
      }
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
  computed: {
    // userDetails() {
    //   return this.$store.state.userDetails;
    // }
  },
  mounted() {
    this.userDetails = JSON.parse(localStorage.getItem('user'));
    this.active = this.activeItem;
  }
};
</script>
<style lang="scss">
.footer .van-tabbar {
  box-shadow: 0px 1px 5px 1px rgba(0, 0, 0, 0.25);
}
</style>
