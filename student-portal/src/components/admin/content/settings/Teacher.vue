<template>
  <div class="settings-teacher">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddYearLevel = true">
        Add Teacher
      </el-button>
    </div>
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
        :align="propKey == 2 ? 'left' : 'center'"
        class-name="text-style"
      >
      </el-table-column>
      <el-table-column fixed="right" label="Operations" :width="'230'">
        <template slot="header" slot-scope="scope">
          <el-input
            v-model="search"
            size="mini"
            placeholder="Type to search"/>
        </template>
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

    <AddTeacher
      :showAddYearLevel="showAddYearLevel"
      @closeAddCourse="closeAddCourse($event)"
      @updateData="updateData()"
    />

    <ViewInfoTeacher
      :teacherData="teacherData"
      :showViewInfoYearLevel="showViewInfoYearLevel"
      @closeViewInfoYearLevel="closeViewInfoYearLevel($event)"
    />

    <UpdateTeacher
      v-if="showUpdateTeacher"
      :teacherData="teacherData"
      @updateData="updateData()"
      :showUpdateTeacher="showUpdateTeacher"
      @closeUpdateTeacher="closeUpdateTeacher($event)"
    />
  </div>
</template>

<script>
import AddTeacher from "@/components/admin/content/dialog/settings/teacher/AddTeacher.vue";
import ViewInfoTeacher from "@/components/admin/content/dialog/settings/teacher/ViewInfoTeacher.vue";
import UpdateTeacher from "@/components/admin/content/dialog/settings/teacher/UpdateTeacher.vue";

import { tableProps } from "@/components/admin/content/settings/tableProps_Teacher.js";

export default {
  components: {
    AddTeacher,
    ViewInfoTeacher,
    UpdateTeacher
  },
  data() {
    return {
      showAddYearLevel: false,
      search: "",
      tableProps: tableProps,
      tableData: [],
      teacherData: {},
      showSetActive: false,
      showSetInActive: false,
      showViewInfoYearLevel: false,
      showUpdateTeacher: false
    };
  },
  methods: {
    changeVal(val) {
      console.log(val);
    },
    operationAction(name, itemData) {
      this.teacherData = itemData;
      switch (name) {
        case "View Info":
          this.showViewInfoYearLevel = true;
          break;
        case "Update":
          this.showUpdateTeacher = true;
          break;
        default:
          console.log("Invalid Option");
      }
    },
    getAllTeacher() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.TeacherService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    closeAddCourse(val) {
      this.showAddYearLevel = val;
    },
    closeViewInfoYearLevel(val) {
      this.showViewInfoYearLevel = val;
    },
    closeUpdateTeacher(val) {
      this.showUpdateTeacher = val;
    },
    updateData() {
      this.getAllTeacher();
    }
  },
  computed: {
    searchTable: function() {
      if (this.search == "") return this.tableData;
      return this.tableData.filter(item => {
        return item.AccountID.indexOf(this.search) > -1 
        || item.Name.indexOf(this.search) > -1
        || item.Position.indexOf(this.search) > -1
        || item.Status.indexOf(this.search) > -1;
      });
    }
  },
  props: {},
  created() {
    this.getAllTeacher();
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
