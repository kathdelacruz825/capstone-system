<template>
  <div class="table">
    <div class="top-options">
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
    </div>
    <el-table :data="tableData" style="width: 100%" max-height="350px">
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
        :width="requestNumber == 0 ? '250' : requestNumber == 1 ? '200' : '270'"
      >
        <template>
          <el-button
            v-for="(operationItem, operationKey) in operationButtons[
              requestNumber
            ]"
            :key="operationKey"
            :type="operationItem.btnType"
            size="small"
            @click="operationAction(operationItem.name)"
          >
            {{ operationItem.name }}
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <UpdateStudent :showUpdateStudent="showUpdateStudent" @closeUpdateStudent="closeUpdateStudent($event)"/>
    <ViewInfoStudent :showViewInfoStudent="showViewInfoStudent" @closeViewInfoStudent="closeViewInfoStudent($event)" />
    <DeleteStudent :showDeleteStudent="showDeleteStudent" @closeDeleteStudent="closeDeleteStudent($event)" />
  </div>
</template>

<script>

import UpdateStudent from "@/components/admin/content/dialog/student/UpdateStudent.vue"
import ViewInfoStudent from "@/components/admin/content/dialog/student/ViewInfoStudent.vue"
import DeleteStudent from "@/components/admin/content/dialog/student/DeleteStudent.vue"

export default {
  components: {
    UpdateStudent,
    ViewInfoStudent,
    DeleteStudent
  },
  data() {
    return {
      showUpdateStudent: false,
      showViewInfoStudent: false,
      showDeleteStudent: false,
      search: "",
      operationButtons: {
        0: [
          {
            name: "View Info",
            btnType: "info"
          },
          {
            name: "Edit",
            btnType: "warning"
          },
          {
            name: "Delete",
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
        ]
      },
      tableProps: [
        {
          propName: "ID",
          propLabel: "ID",
          width: "50",
        },
        {
          propName: "AccountType",
          propLabel: "Account Type",
          width: "120"
        },
        {
          propName: "AccountStatus",
          propLabel: "Account Status",
          width: "120"
        },
        {
          propName: "AccountPending",
          propLabel: "Account Pending",
          width: "120"
        },
        {
          propName: "AccountOnlineState",
          propLabel: "Account Online State",
          width: "120"
        },
        {
          propName: "AccountID",
          propLabel: "Account ID",
          width: "120"
        },
        {
          propName: "AccountPassword",
          propLabel: "Account Password",
          width: "120"
        },
        {
          propName: "LastName",
          propLabel: "Last Name",
          width: "120"
        },
        {
          propName: "FirstName",
          propLabel: "First Name",
          width: "120"
        },
        {
          propName: "MiddleName",
          propLabel: "Middle Name",
          width: "120"
        },
        {
          propName: "ExtName",
          propLabel: "Extension Name",
          width: "120"
        },
        {
          propName: "PhoneNumber",
          propLabel: "Phone Number",
          width: "120"
        },
        {
          propName: "Email",
          propLabel: "Email",
          width: "120"
        },
        {
          propName: "Icon",
          propLabel: "Icon",
          width: "120"
        },
        {
          propName: "YearLevel",
          propLabel: "Year Level",
          width: "120"
        },
        {
          propName: "Course",
          propLabel: "Course",
          width: "120"
        },
        {
          propName: "Parent ID",
          propLabel: "Parent ID",
          width: "120"
        },
        {
          propName: "CreateTime",
          propLabel: "Create Time",
          width: "120"
        },
        {
          propName: "UpdateTime",
          propLabel: "Update Time",
          width: "120"
        }
      ],
      tableData: []
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
    operationAction(name) {
      if (name == 'View Info') {
        this.showViewInfoStudent = true;
      } else if (name == 'Edit') {
        this.showUpdateStudent = true;
      } else if (name == 'Delete') {
        this.showDeleteStudent = true;
      }
    },
    closeUpdateStudent(val) {
      this.showUpdateStudent = val;
    },
    closeViewInfoStudent(val) {
      this.showViewInfoStudent = val;
    },
    closeDeleteStudent(val) {
      this.showDeleteStudent = val;
    },
  },
  props: {
    requestNumber: {
      type: [String, Number]
    }
  },
  created() {
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
};
</script>

<style lang="scss">
.table {
  .text-style div {
    word-break: keep-all;
  }
}
</style>