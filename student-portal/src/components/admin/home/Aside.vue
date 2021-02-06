<template>
  <el-col>
    <el-menu
      :default-active="`${activeTab}`"
      class="el-menu-vertical-demo"
      @open="handleOpen"
      @close="handleClose"
      background-color="#545c64"
      text-color="#fff"
      active-text-color="#ffd04b"
    >
      <el-menu-item
        v-for="(tabItem, tabKey) in tabItems[userDetails.Role]"
        :key="tabKey"
        :index="`${tabKey}`"
        @click="selectTabContent(tabItem.name)"
      >
        <i :class="tabItem.icon"></i>
        <span>{{
          tabItem.name == "Grades" ? "Student Record" : tabItem.name
        }}</span>
      </el-menu-item>
    </el-menu>
  </el-col>
</template>

<script>
export default {
  name: "Aside",
  components: {},
  data() {
    return {
      activeTab: "0",
      tabItems: {
        '1': [
          {
            name: "Dashboard",
            icon: "el-icon-data-analysis"
          },
          {
            name: "Students",
            icon: "el-icon-user"
          },
          {
            name: "Parents",
            icon: "el-icon-s-custom"
          },
          {
            name: "Announcements",
            icon: "el-icon-date"
          },
          {
            name: "Grades",
            icon: "el-icon-medal-1"
          },
          {
            name: "Messages",
            icon: "el-icon-message"
          },
          {
            name: "Settings",
            icon: "el-icon-setting"
          }
        ],
        '2': [
          {
            name: "Dashboard",
            icon: "el-icon-data-analysis"
          },
          {
            name: "Students",
            icon: "el-icon-user"
          },
          {
            name: "Parents",
            icon: "el-icon-s-custom"
          },
          {
            name: "Announcements",
            icon: "el-icon-date"
          },
          {
            name: "Grades",
            icon: "el-icon-medal-1"
          },
          {
            name: "Messages",
            icon: "el-icon-message"
          },
          {
            name: "Settings",
            icon: "el-icon-setting"
          }
        ],
        '3': [
          {
            name: "Dashboard",
            icon: "el-icon-data-analysis"
          },
          // {
          //   name: "Students",
          //   icon: "el-icon-user"
          // },
          // {
          //   name: "Parents",
          //   icon: "el-icon-s-custom"
          // },
          // {
          //   name: "Announcements",
          //   icon: "el-icon-date"
          // },
          {
            name: "Grades",
            icon: "el-icon-medal-1"
          },
          {
            name: "Messages",
            icon: "el-icon-message"
          },
          // {
          //   name: "Settings",
          //   icon: "el-icon-setting"
          // }
        ]
      }
    };
  },
  methods: {
    handleOpen(key, keyPath) {
      console.log(key, keyPath);
    },
    handleClose(key, keyPath) {
      console.log(key, keyPath);
    },
    selectTabContent(val) {
      this.$emit("selectTabContent", val);
    }
  },
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  }
};
</script>
<style lang="scss">
.el-col {
  height: 100%;
  .el-menu {
    height: 100%;
  }
  .el-menu li {
    text-align: left;
    padding: 0px 35px !important;
  }
}
</style>
