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
        <!-- <Table :requestNumber="activeTab" /> -->
        <component
          :is="panelItems[activeTab]"
          :requestNumber="activeTab"
          :tableData="tableData"
        ></component>
      </el-tab-pane>
    </el-tabs>
    <AddStudent
      :showAddStudent="showAddStudent"
      @closeAddStudent="closeAddStudent($event)"
    />
  </div>
</template>

<script>
// import Table from "@/components/admin/content/students/Table.vue";
import AddStudent from "@/components/admin/content/dialog/student/AddStudent.vue";

export default {
  components: {
    // Table,
    AddStudent,
    Active: resolve => {
      require(["@/components/admin/content/students/Table.vue"], resolve);
    },
    Inactive: resolve => {
      require(["@/components/admin/content/students/Table.vue"], resolve);
    },
    Pending: resolve => {
      require(["@/components/admin/content/students/Table.vue"], resolve);
    }
  },
  data() {
    return {
      activeTab: 0,
      panelItems: ["Active", "Inactive", "Pending"],
      showAddStudent: false,
      tableData: [],
    };
  },
  methods: {
    selectTab(val) {
      console.log(val);
      this.getStudentData();
    },
    closeAddStudent(val) {
      this.showAddStudent = val;
    },
    getStudentData() {
      var params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.StudentService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  props: {},
  created() {
    this.getStudentData();
  }
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
