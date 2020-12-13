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
import AddStudent from "@/components/admin/content/dialog/student/AddStudent.vue";

export default {
  components: {
    AddStudent,
    Active: resolve => {
      require(["@/components/admin/content/students/Table.vue"], resolve);
    },
    Inactive: resolve => {
      require(["@/components/admin/content/students/Table.vue"], resolve);
    },
    Pending: resolve => {
      require(["@/components/admin/content/students/Table.vue"], resolve);
    },
    Rejected: resolve => {
      require(["@/components/admin/content/students/Table.vue"], resolve);
    }
  },
  data() {
    return {
      activeTab: 0,
      panelItems: ["Active", "Inactive", "Pending", "Rejected"],
      showAddStudent: false,
      tableData: []
    };
  },
  methods: {
    selectTab(val) {
      if (val == 0) {
        this.getStudentData();
      } else if (val == 1) {
        this.getStudentInactiveData();
      } else if (val == 2) {
        this.getStudentPendingData();
      } else {
        this.getStudentRejectedData();
      }
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
        .post(this.api.AdminService, params)
        .then(response => {
          this.tableData = [];
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getStudentInactiveData() {
      var params = {
        request: 2,
        data: {}
      };
      this.http
        .post(this.api.AdminService, params)
        .then(response => {
          this.tableData = [];
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getStudentPendingData() {
      var params = {
        request: 3,
        data: {}
      };
      this.http
        .post(this.api.AdminService, params)
        .then(response => {
          this.tableData = [];
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getStudentRejectedData() {
      var params = {
        request: 4,
        data: {}
      };
      this.http
        .post(this.api.AdminService, params)
        .then(response => {
          this.tableData = [];
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  props: {},
  created() {
    if (this.activeTab == 0) {
      this.getStudentData();
    }
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
