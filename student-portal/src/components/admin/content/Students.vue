<template>
  <div class="students">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddStudent = true">
        Add Student
      </el-button>
    </div>
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
    <AddStudent :showAddStudent="showAddStudent" @closeAddStudent="closeAddStudent($event)"/>
  </div>
</template>

<script>
import Table from "@/components/admin/content/students/Table.vue";
import AddStudent from "@/components/admin/content/dialog/student/AddStudent.vue"

export default {
  components: {
    Table,
    AddStudent,
  },
  data() {
    return {
      activeTab: 0,
      panelItems: ["Active", "Inactive", "Pending"],
      showAddStudent: false,
    };
  },
  methods: {
    selectTab(val) {
      console.log(val);
    },
    closeAddStudent(val) {
      this.showAddStudent = val;
    }
  },
  props: {},
  created() {}
};
</script>

<style lang="scss">
.students {

  .button-options {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    margin-bottom: 10px;

    .el-button {
      padding: 10px;
    }

  }

}
</style>