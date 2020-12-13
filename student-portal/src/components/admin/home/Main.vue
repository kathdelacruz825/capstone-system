<template>
  <div class="main">
    <component :is="tabContent"></component>
  </div>
</template>

<script>
export default {
  components: {
    Dashboard: resolve => {
      require(["@/components/admin/content/Dashboard.vue"], resolve);
    },
    Students: resolve => {
      require(["@/components/admin/content/Students.vue"], resolve);
    },
    Parents: resolve => {
      require(["@/components/admin/content/Parents.vue"], resolve);
    },
    Schedule: resolve => {
      require(["@/components/admin/content/Schedule.vue"], resolve);
    },
    Grades: resolve => {
      require(["@/components/admin/content/Grades.vue"], resolve);
    },
    Messages: resolve => {
      require(["@/components/admin/content/Messages.vue"], resolve);
    },
    Settings: resolve => {
      require(["@/components/admin/content/Settings.vue"], resolve);
    }
  },
  data() {
    return {};
  },
  methods: {},
  props: {
    tabContent: {
      type: String,
      default: "Dashboard"
    }
  },
  created() {}
};
</script>

<style lang="scss">
.main {
  padding: 10px;
  background: #fff;
  height: 100%;
}
</style>
