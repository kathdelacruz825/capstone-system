<template>
  <div class="user-home">
    <Nav :title="pageTitle" :isLeftArrow="false" :isRightText="false" />
    <div class="content">
      <div class="content-wrapper">
        <van-tabs v-model="active">
          <van-tab
            v-for="(tabItem, key) in tabOptions"
            :key="key"
            :title="tabItem"
          >
            <van-pull-refresh
              v-model="refreshing"
              @refresh="onRefresh"
              loosing-text="Loose to refresh..."
              loading-text="Loading..."
            >
              <van-list
                v-model="loading"
                :finished="finished"
                finished-text="Finished"
                loading-text="Loading..."
                @load="onLoad"
              >
                <Notification
                  v-for="(notifItem, notifKey) in 5"
                  :key="notifKey"
                />
              </van-list>
            </van-pull-refresh>
          </van-tab>
        </van-tabs>
      </div>
    </div>
    <Footer :activeItem="0" />
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";
import Notification from "@/components/user/userHome/Notification.vue";

export default {
  name: "UserHome",
  components: {
    Nav,
    Footer,
    Notification
  },
  data() {
    return {
      pageTitle: "Home",
      list: [],
      loading: false,
      finished: false,
      refreshing: false,
      active: 0,
      tabOptions: ["Notification"]
    };
  },
  methods: {
    onLoad() {
      setTimeout(() => {
        if (this.refreshing) {
          this.list = [];
          this.refreshing = false;
        }

        for (let i = 0; i < 10; i++) {
          this.list.push(this.list.length + 1);
        }
        this.loading = false;

        if (this.list.length >= 40) {
          this.finished = true;
        }
      }, 1000);
    },
    onRefresh() {
      this.finished = false;
      this.loading = true;
      this.onLoad();
    }
  },
  computed: {
    userDetails() {
      return this.$store.state.userDetails;
    }
  },
  mounted() {
    console.log(this.userDetails);
  }
};
</script>

<style lang="scss">
.content {
  height: calc(100vh - 96px);
  overflow: hidden;

  .content-wrapper {
    height: 100%;
  }

  .van-tabs__content {
    height: calc(100vh - 96px - 44px);
    overflow: hidden;
    overflow-y: auto;
  }

  .van-list {
    height: 100%;
    padding: 10px 10px 0px;
    overflow-y: auto;
    .notification {
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .notification:not(:last-child) {
      margin-bottom: 10px;
    }
  }
}
</style>
