<template>
  <div class="settings-course">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddCourse = true">
        Add Course
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
        :align="propKey == 2 ? 'left' : 'center'"
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
          <el-button
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
          </el-button>
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
  </div>
</template>

<script>
import AddCourse from "@/components/admin/content/dialog/settings/course/AddCourse.vue";
import { tableProps } from "@/components/admin/content/settings/tableProps_Course.js";

export default {
  components: {
    AddCourse
  },
  data() {
    return {
      showAddCourse: false,
      search: "",
      tableProps: tableProps,
      tableData: [],
      courseData: {}
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
          break;
        case "Update":
          break;
        // case "Delete":
        //   break;
        case "Set Active":
          break;
        case "Set Inactive":
          break;
        default:
          console.log("Invalid Option");
      }
    },
    getAllCourse() {
      let params = {
        request: 1,
        data: {}
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
    closeAddCourse(val) {
      this.showAddCourse = val;
    },
    updateData() {
      this.getAllCourse();
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
