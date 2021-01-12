<template>
  <div class="settings">
    <el-breadcrumb separator="/">
      <!-- <el-breadcrumb-item :to="{ path: '/' }">homepage</el-breadcrumb-item> -->
      <el-breadcrumb-item>{{ titlePage }}</el-breadcrumb-item>
      <el-breadcrumb-item>{{ activeTabName }}</el-breadcrumb-item>
    </el-breadcrumb>
    <el-tabs v-model="activeTabKey" @tab-click="handleClick(activeTabKey)">
      <el-tab-pane
        v-for="(item, key) in tabItems"
        :key="key"
        :label="item.name"
        :name="`${key}`"
      >
        <component
          v-if="activeTabKey == key"
          :is="tabItems[activeTabKey].component"
        ></component>
      </el-tab-pane>
    </el-tabs>
  </div>
</template>

<script>
export default {
  components: {
    Course: resolve => {
      require(["@/components/admin/content/settings/Course.vue"], resolve);
    },
    Subject: resolve => {
      require(["@/components/admin/content/settings/Subject.vue"], resolve);
    },
    System: resolve => {
      require(["@/components/admin/content/settings/System.vue"], resolve);
    },
    YearLevel: resolve => {
      require(["@/components/admin/content/settings/YearLevel.vue"], resolve);
    },
    SchoolYear: resolve => {
      require(["@/components/admin/content/settings/SchoolYear.vue"], resolve);
    },
    GradingPeriod: resolve => {
      require([
        "@/components/admin/content/settings/GradingPeriod.vue"
      ], resolve);
    }
  },
  data() {
    return {
      titlePage: "Settings",
      activeTabKey: 0,
      activeTabName: "Course",
      tabItems: [
        { name: "Course", component: "Course" },
        { name: "Subject", component: "Subject" },
        { name: "Year Level", component: "YearLevel" },
        { name: "Grading Period", component: "GradingPeriod" },
        { name: "School Year", component: "SchoolYear" }
        // { name: "System", component: "System" }
      ]
    };
  },
  methods: {
    handleClick(tab) {
      this.activeTabKey = tab;
      this.activeTabName = this.tabItems[tab].name;
    }
  },
  props: {},
  created() {},
  mounted() {}
};
</script>

<style lang="scss">
.settings {
  .button-options {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    margin-bottom: 10px;

    .el-button {
      padding: 10px;
    }
  }

  .text-style div {
    word-break: keep-all;
  }
  .el-button.operationItem-button {
    padding: 5px;
  }
}
</style>
