<template>
  <div class="table">
    <!-- <div class="top-options">
      <div>
        <div style="margin-top: 15px;">
          <el-input
            placeholder="Please input to search"
            v-model="search"
            @input="changeVal"
          >
            <template slot="append">
              <i class="el-icon-search"></i>
            </template>
          </el-input>
        </div>
      </div>
    </div> -->
    <el-table :data="searchTable" style="width: 100%" max-height="370">
      <el-table-column
        v-for="(propItem, propKey) in tableProps"
        :key="propKey"
        :prop="propItem.propName"
        :label="propItem.propLabel"
        :width="propItem.width"
        align="center"
        class-name="text-style"
      >
      </el-table-column>
      <el-table-column
        fixed="right"
        label="Operations"
        :width="
          requestNumber == 0
            ? '290'
            : requestNumber == 1
            ? '200'
            : requestNumber == 2
            ? '270'
            : '210'
        "
      >
        <template slot="header" slot-scope="scope">
          <el-input
            v-model="search"
            size="mini"
            placeholder="Type to search"/>
        </template>
        <template slot-scope="scope">
          <el-button
            class="operationItem-button"
            v-for="(operationItem, operationKey) in operationButtons[
              requestNumber
            ]"
            :key="operationKey"
            :type="operationItem.btnType"
            size="small"
            @click.native.prevent="
              operationAction(operationItem.name, tableData[scope.$index])
            "
          >
            {{ operationItem.name }}
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <UpdateParent
      v-if="showUpdateStudent"
      :showUpdateStudent="showUpdateStudent"
      @updateData="updateData()"
      @closeUpdateStudent="closeUpdateStudent($event)"
      :studentData="studentData"
    />
    <ViewInfoStudent
      :showViewInfoStudent="showViewInfoStudent"
      @closeViewInfoStudent="closeViewInfoStudent($event)"
      :studentData="studentData"
    />
    <DeleteStudent
      :showDeleteStudent="showDeleteStudent"
      @closeDeleteStudent="closeDeleteStudent($event)"
      @updateData="updateData()"
      :studentData="studentData"
    />

    <StatusParent
      :showInActiveStudent="showInActiveStudent"
      :statusTitle="statusTitle"
      :request="request"
      @closeInActiveStudent="closeInActiveStudent($event)"
      @updateData="updateData()"
      :studentData="studentData"
    />

    <PendingParent
      :showPendingStudent="showPendingStudent"
      :pendingTitle="pendingTitle"
      :request="request"
      @closePendingStudent="closePendingStudent($event)"
      @updateData="updateData()"
      :studentData="studentData"
    />
  </div>
</template>

<script>
import UpdateParent from "@/components/admin/content/dialog/parent/UpdateParent.vue";
import ViewInfoStudent from "@/components/admin/content/dialog/parent/ViewInfoStudent.vue";
import DeleteStudent from "@/components/admin/content/dialog/parent/DeleteStudent.vue";
import StatusParent from "@/components/admin/content/dialog/parent/StatusParent.vue";
import PendingParent from "@/components/admin/content/dialog/parent/PendingParent.vue";

import { tableProps } from "@/components/admin/content/parent/tablesettings";

export default {
  components: {
    UpdateParent,
    ViewInfoStudent,
    DeleteStudent,
    StatusParent,
    PendingParent
  },
  data() {
    return {
      showUpdateStudent: false,
      showViewInfoStudent: false,
      showDeleteStudent: false,
      showInActiveStudent: false,
      showPendingStudent: false,
      statusTitle: "",
      pendingTitle: "",
      request: null,
      search: "",
      operationButtons: {
        0: [
          {
            name: "View Info",
            btnType: "info"
          },
          {
            name: "Update",
            btnType: "warning"
          },
          // {
          //   name: "Delete",
          //   btnType: "danger"
          // },
          {
            name: "Set Inactive",
            btnType: "danger"
          }
        ],
        1: [
          {
            name: "View Info",
            btnType: "info"
          },
          {
            name: "Set Active",
            btnType: "warning"
          }
        ],
        2: [
          {
            name: "View Info",
            btnType: "info"
          },
          {
            name: "Approve",
            btnType: "warning"
          },
          {
            name: "Reject",
            btnType: "danger"
          }
        ],
        3: [
          {
            name: "View Info",
            btnType: "info"
          },
          {
            name: "Re-approve",
            btnType: "warning"
          }
        ]
      },
      tableProps: tableProps,
      studentData: {}
    };
  },
  methods: {
    editItem(val) {
      console.log(val);
    },
    deleteItem(val) {
      console.log(val);
    },
    changeVal(val) {
      console.log(val);
    },
    operationAction(name, itemData) {
      this.studentData = itemData;
      switch (name) {
        case "View Info":
          this.showViewInfoStudent = true;
          break;
        case "Update":
          this.showUpdateStudent = true;
          break;
        case "Delete":
          this.showDeleteStudent = true;
          break;
        case "Set Active":
          this.request = 9;
          this.statusTitle = "Active";
          this.showInActiveStudent = true;
          break;
        case "Set Inactive":
          this.request = 9;
          this.statusTitle = "Inactive";
          this.showInActiveStudent = true;
          break;
        case "Approve":
          this.request = 10;
          this.showPendingStudent = true;
          this.pendingTitle = "Approve";
          break;
        case "Reject":
          this.request = 10;
          this.showPendingStudent = true;
          this.pendingTitle = "Reject";
          break;
        case "Re-approve":
          this.request = 10;
          this.showPendingStudent = true;
          this.pendingTitle = "Re-approve";
          break;
        default:
          console.log("Invalid Option");
      }
    },
    closeUpdateStudent(val) {
      this.updateData();
      this.studentData = {};
      this.showUpdateStudent = val;
    },
    closeViewInfoStudent(val) {
      this.showViewInfoStudent = val;
    },
    closeDeleteStudent(val) {
      this.showDeleteStudent = val;
    },
    closeInActiveStudent(val) {
      this.showInActiveStudent = val;
    },
    closePendingStudent(val) {
      this.showPendingStudent = val;
    },
    updateData() {
      this.$emit("updateData");
    }
  },
  props: {
    requestNumber: {
      type: [String, Number]
    },
    tableData: {
      type: Array,
      default: () => {
        return [];
      }
    }
  },
  computed: {
    searchTable: function() {
      if (this.search == "") return this.tableData;
      return this.tableData.filter(item => {
        return item.AccountID.indexOf(this.search) > -1 
        || item.FirstName.indexOf(this.search) > -1
        || item.LastName.indexOf(this.search) > - 1
        || item.StudentID.indexOf(this.search) > - 1
        || item.MiddleName.indexOf(this.search) > -1;
      });
    }
  },
  created() {}
};
</script>

<style lang="scss">
.table {
  .text-style div {
    word-break: keep-all;
  }
  .el-button.operationItem-button {
    padding: 5px;
  }
}
</style>
