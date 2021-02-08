<template>
  <div class="settings-teacher">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddUser = true">
        Add User
      </el-button>
    </div>
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
    <el-table :data="tableData" style="width: 100%" max-height="370">
      <el-table-column
        v-for="(propItem, propKey) in tableProps"
        :key="propKey"
        :prop="propItem.propName"
        :label="propItem.propLabel"
        :width="propItem.width"
        class-name="text-style"
      >
      </el-table-column>
      <el-table-column fixed="right" label="Operations" :width="'230'">
        <template slot-scope="scope">
          <el-button
            class="operationItem-button"
            size="small"
            type="info"
            @click.native.prevent="
              operationAction('View Info', tableData[scope.$index])
            "
          >
            {{ "View Info" }}
          </el-button>
          <el-button
            class="operationItem-button"
            size="small"
            type="warning"
            @click.native.prevent="
              operationAction('Update', tableData[scope.$index])
            "
          >
            {{ "Update" }}
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <AddUser
      v-if="showAddUser"
      :showAddUser="showAddUser"
      @CloseAddUser="CloseAddUser($event)"
      @updateData="updateData()"
    />
    <ViewInfoUser
      v-if="showViewInfoUsers"
      :userData="userData"
      :showViewInfoUsers="showViewInfoUsers"
      @CloseViewUser="CloseViewUser($event)"
    />

    <UpdateTeacher
      v-if="showUpdateTeacher"
      :userData="userData"
      @updateData="updateData()"
      :showUpdateTeacher="showUpdateTeacher"
      @closeUpdateTeacher="closeUpdateTeacher($event)"
    />
  </div>
</template>

<script>
import AddUser from "@/components/admin/content/dialog/settings/user/AddUser1.vue";
import ViewInfoUser from "@/components/admin/content/dialog/settings/user/ViewInfoUser1.vue";
import UpdateTeacher from "@/components/admin/content/dialog/settings/teacher/UpdateTeacher.vue";

import { tableProps } from "@/components/admin/content/settings/tableProps_Users.js";

export default {
  components: {
    AddUser,
    ViewInfoUser,
    UpdateTeacher
  },
  data() {
    return {
      showAddUser: false,
      search: "",
      tableProps: tableProps,
      tableData: [],
      userData: {},
      showViewInfoUsers: false,
      showUpdateTeacher: false,
      userDetails: {}
    };
  },
  methods: {
    changeVal(val) {
      console.log(val);
    },
    operationAction(name, itemData) {
      this.userData = itemData;
      switch (name) {
        case "View Info":
          this.showViewInfoUsers = true;
          break;
        case "Update":
          this.showUpdateTeacher = true;
          break;
        default:
          console.log("Invalid Option");
      }
    },
    getUsers() {
      let params = {
        request: 1,
        data: {
          myID: this.userDetails.AccountID
        }
      };
      this.http
        .post(this.api.UserService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    CloseAddUser(val) {
      this.showAddUser = val;
    },
    CloseViewUser(val) {
      this.showViewInfoUsers = val;
    },
    closeUpdateTeacher(val) {
      this.showUpdateTeacher = val;
    },
    updateData() {
      this.getUsers();
    }
  },
  props: {},
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
    this.getUsers();
  },
  mounted() {}
};
</script>

<style lang="scss">
.settings {
  .text-style div {
    word-break: keep-all;
  }
  .el-button.operationItem-button {
    padding: 5px;
  }
}
</style>
