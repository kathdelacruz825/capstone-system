<template>
  <div class="settings-course">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddCourse = true">
        Add Course
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
          <!-- <el-button
            class="operationItem-button"
            size="small"
            type="danger"
            v-if="tableData[scope.$index].CourseStatus == 'Active'"
            @click.native.prevent="
              operationAction('Set Inactive', tableData[scope.$index])
            "
          >
            {{ "Set Inactive" }}
          </el-button>
          <el-button
            class="operationItem-button"
            size="small"
            type="success"
            v-if="tableData[scope.$index].CourseStatus == 'Inactive'"
            @click.native.prevent="
              operationAction('Set Active', tableData[scope.$index])
            "
          >
            {{ "Set Active" }}
          </el-button> -->
          <!-- <el-button
            class="operationItem-button"
            v-for="(operationItem, operationKey) in operationButtons"
            :key="operationKey"
            :type="operationItem.btnType"
            size="small"
            @click.native.prevent="
              operationAction(operationItem.name, tableData[scope.$index])
            "
          >
            {{ operationItem.name }}
          </el-button> -->
        </template>
      </el-table-column>
    </el-table>

    <AddCourse
      :showAddCourse="showAddCourse"
      @closeAddCourse="closeAddCourse($event)"
      @updateData="updateData()"
    />

    <ViewInfoCourse
      :courseData="courseData"
      :showViewInfoCourse="showViewInfoCourse"
      @closeViewInfoCourse="closeViewInfoCourse($event)"
    />

    <UpdateCourse
      v-if="showUpdateCourse"
      :courseData="courseData"
      :showUpdateCourse="showUpdateCourse"
      @updateData="updateData()"
      @closeUpdateCourse="closeUpdateCourse($event)"
    />

    <el-dialog
      title="Course Status"
      :visible.sync="showSetActive"
      width="22%"
      :show-close="false"
      :close-on-press-escape="false"
      :close-on-click-modal="false"
      top="50px"
    >
      <span>Are you sure you want to set Active?</span>
      <span slot="footer" class="dialog-footer">
        <el-button @click="showSetActive = false">Cancel</el-button>
        <el-button type="primary" @click="setActiveCourse(courseData.ID)"
          >Set Active</el-button
        >
      </span>
    </el-dialog>

    <el-dialog
      title="Course Status"
      :visible.sync="showSetInActive"
      width="22%"
      :show-close="false"
      :close-on-press-escape="false"
      :close-on-click-modal="false"
      top="50px"
    >
      <span>Are you sure you want to set Inactive?</span>
      <span slot="footer" class="dialog-footer">
        <el-button @click="showSetInActive = false">Cancel</el-button>
        <el-button type="danger" @click="setInActiveCourse(courseData.ID)"
          >Set Inactive</el-button
        >
      </span>
    </el-dialog>
  </div>
</template>

<script>
import AddCourse from "@/components/admin/content/dialog/settings/course/AddCourse.vue";
import ViewInfoCourse from "@/components/admin/content/dialog/settings/course/ViewInfoCourse.vue";
import UpdateCourse from "@/components/admin/content/dialog/settings/course/UpdateCourse.vue";

import { tableProps } from "@/components/admin/content/settings/tableProps_Course.js";

export default {
  components: {
    AddCourse,
    ViewInfoCourse,
    UpdateCourse
  },
  data() {
    return {
      showAddCourse: false,
      search: "",
      tableProps: tableProps,
      tableData: [],
      courseData: {},
      showSetActive: false,
      showSetInActive: false,
      showViewInfoCourse: false,
      showUpdateCourse: false
      // operationButtons: [
      //   {
      //     name: "View Info",
      //     btnType: "info"
      //   },
      //   {
      //     name: "Update",
      //     btnType: "warning"
      //   },
      //   // {
      //   //   name: "Delete",
      //   //   btnType: "danger"
      //   // },
      //   {
      //     name: "Set Active",
      //     btnType: "success"
      //   },
      //   {
      //     name: "Set Inactive",
      //     btnType: "danger"
      //   }
      // ],
    };
  },
  methods: {
    changeVal(val) {
      console.log(val);
    },
    operationAction(name, itemData) {
      this.courseData = itemData;
      switch (name) {
        case "View Info":
          this.showViewInfoCourse = true;
          break;
        case "Update":
          this.showUpdateCourse = true;
          break;
        // case "Delete":
        //   break;
        case "Set Active":
          this.showSetActive = true;
          break;
        case "Set Inactive":
          this.showSetInActive = true;
          break;
        default:
          console.log("Invalid Option");
      }
    },
    getAllCourse() {
      let params = {
        request: 1,
        data: {
          CourseStatus: ""
        }
      };
      this.http
        .post(this.api.CourseService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    setActiveCourse(ID) {
      let params = {
        request: 6,
        data: {
          ID: ID
        }
      };
      this.http
        .post(this.api.CourseService, params)
        .then(response => {
          this.showSetActive = false;
          this.updateData();
          this.$message({
            type: response.data.State == 1 ? "success" : "danger",
            message: response.data.Message
          });
        })
        .catch(error => {
          console.log(error);
        });
    },
    setInActiveCourse(ID) {
      let params = {
        request: 7,
        data: {
          ID: ID
        }
      };
      this.http
        .post(this.api.CourseService, params)
        .then(response => {
          this.showSetInActive = false;
          this.updateData();
          this.$message({
            type: response.data.State == 1 ? "success" : "danger",
            message: response.data.Message
          });
        })
        .catch(error => {
          console.log(error);
        });
    },
    closeAddCourse(val) {
      this.showAddCourse = val;
    },
    closeViewInfoCourse(val) {
      this.showViewInfoCourse = val;
    },
    closeUpdateCourse(val) {
      this.showUpdateCourse = val;
    },
    updateData() {
      this.getAllCourse();
    }
  },
  computed: {
    searchTable: function() {
      if (this.search == "") return this.tableData;
      return this.tableData.filter(item => {
        return item.CourseDescription.indexOf(this.search) > -1 
        || item.CourseID.indexOf(this.search) > -1
        || item.CourseStatus.indexOf(this.search) > -1;
      });
    }
  },
  props: {},
  created() {
    this.getAllCourse();
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
