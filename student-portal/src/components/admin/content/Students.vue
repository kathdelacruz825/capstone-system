<template>
  <div class="students">
    <div><el-button>Add Student</el-button></div>
    <el-tabs
      type="border-card"
      v-model="activeTab"
      @tab-click="selectTab(activeTab)"
    >
      <el-tab-pane
        v-for="(panelItem, panelKey) in panelItems"
        :key="panelKey"
        :label="panelItem"
      >
        <Table :requestNumber="activeTab" />
      </el-tab-pane>
    </el-tabs>
  </div>
</template>

<script>
import Table from "@/components/admin/content/students/Table.vue";

export default {
  components: {
    Table
  },
  data() {
    return {
      activeTab: 0,
      panelItems: ["Active", "Inactive", "Pending"]
    };
  },
  methods: {
    selectTab(val) {
      console.log(val);
    }
  },
  props: {},
  created() {}
};
</script>
