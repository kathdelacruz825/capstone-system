<template>
  <div class="table-grades">
    <el-table :data="tableData" style="width: 100%" max-height="300">
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
          <!-- <el-button
            type="warning"
            icon="el-icon-edit"
            @click.native.prevent="
              operationAction('Edit', tableData[scope.$index])
            "
          ></el-button> -->
          <el-button
            type="danger"
            icon="el-icon-delete"
            @click.native.prevent="
              operationAction('Delete', tableData[scope.$index])
            "
          ></el-button>
        </template>
      </el-table-column>
    </el-table>

    <el-dialog
      title="Delete Subject"
      :visible.sync="showDeleteSubject"
      width="20%"
      :show-close="false"
      :close-on-press-escape="false"
      :close-on-click-modal="false"
      top="50px"
    >
      <span>Are you sure you want to delete?</span>
      <span slot="footer" class="dialog-footer">
        <el-button @click="showDeleteSubject = false">Cancel</el-button>
        <el-button type="primary" @click="deleteData()">Delete</el-button>
      </span>
    </el-dialog>

    <UpdateSubject
      v-if="showUpdateSubject"
      :studentData="studentData"
      @updateData="updateData"
      @closeUpdateGrade="closeUpdateGrade($event)"
      :showUpdateSubject="showUpdateSubject"
      :YearLevelID="YearLevelID"
      :SemesterID="SemesterID"
    />
  </div>
</template>

<script>
import { tableProps } from "@/components/admin/content/grades/tableProps_TableSubject.js";
import UpdateSubject from "@/components/admin/content/dialog/grades/UpdateSubject.vue";

export default {
  components: {
    UpdateSubject
  },
  data() {
    return {
      tableProps: tableProps,
      studentData: {},
      showDeleteSubject: false,
      showUpdateSubject: false
    };
  },
  methods: {
    operationAction(name, itemData) {
      this.studentData = {};
      this.studentData = itemData;
      switch (name) {
        case "Edit":
          this.showUpdateSubject = true;
          break;
        case "Delete":
          this.showDeleteSubject = true;
          break;
        default:
          console.log("Invalid Option");
      }
    },
    deleteData() {
      let params = {
        request: 4,
        data: {
          ID: this.studentData.ID
        }
      };
      this.http
        .post(this.api.StudentSubjectService, params)
        .then(response => {
          if (response.data.State == 1) {
            this.showDeleteSubject = false;
            this.$emit("updateData");
            this.$message({
              type: "success",
              message: response.data.Message
            });
          } else {
            this.$message({
              type: "warning",
              message: response.data.Message
            });
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    updateData() {
      this.$emit("updateData");
    },
    closeUpdateGrade(val) {
      this.showUpdateSubject = val;
    }
  },
  props: {
    tableData: {
      type: Array,
      default: () => {
        return [];
      }
    },
    YearLevelID: {
      type: String,
      default: ""
    },
    SemesterID: {
      type: String,
      default: ""
    },
  },
  created() {},
  mounted() {}
};
</script>

<style lang="scss">
.table-grades .cell {
  word-break: keep-all;
  text-align: center;
}
</style>
