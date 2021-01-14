<template>
  <div class="students">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddStudent = true">
        Add Parent
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
          @updateData="updateData()"
          :tableData="tableData"
        ></component>
      </el-tab-pane>
    </el-tabs>
    <AddParent
      @updateData="updateData()"
      :showAddStudent="showAddStudent"
      @closeAddStudent="closeAddStudent($event)"
    />
  </div>
</template>

<script>
import AddParent from "@/components/admin/content/dialog/parent/AddParent.vue";

export default {
  components: {
    AddParent,
    Active: resolve => {
      require(["@/components/admin/content/parent/Table.vue"], resolve);
    },
    Inactive: resolve => {
      require(["@/components/admin/content/parent/Table.vue"], resolve);
    },
    Pending: resolve => {
      require(["@/components/admin/content/parent/Table.vue"], resolve);
    },
    Rejected: resolve => {
      require(["@/components/admin/content/parent/Table.vue"], resolve);
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
    updateData() {
      if (this.activeTab == 0) {
        this.getStudentData();
      } else if (this.activeTab == 1) {
        this.getStudentInactiveData();
      } else if (this.activeTab == 2) {
        this.getStudentPendingData();
      } else {
        this.getStudentRejectedData();
      }
    },
    getStudentData() {
      var params = {
        request: 7,
        data: {
          AccountStatus: 1,
          AccountPending: 1
        }
      };
      this.http
        .post(this.api.ParentService, params)
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
        request: 7,
        data: {
          AccountStatus: 2,
          AccountPending: 1
        }
      };
      this.http
        .post(this.api.ParentService, params)
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
        request: 7,
        data: {
          AccountStatus: 1,
          AccountPending: 2
        }
      };
      this.http
        .post(this.api.ParentService, params)
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
        request: 7,
        data: {
          AccountStatus: 1,
          AccountPending: 3
        }
      };
      this.http
        .post(this.api.ParentService, params)
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
