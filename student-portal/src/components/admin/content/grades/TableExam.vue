<template>
  <div class="table-grades">
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
            type="warning"
            icon="el-icon-edit"
            @click.native.prevent="
              operationAction('Edit', tableData[scope.$index])
            "
          ></el-button>
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
      title="Delete Exam"
      :visible.sync="showDeleteGrade"
      width="20%"
      :show-close="false"
      :close-on-press-escape="false"
      :close-on-click-modal="false"
      top="50px"
    >
      <span>Are you sure you want to delete?</span>
      <span slot="footer" class="dialog-footer">
        <el-button @click="showDeleteGrade = false">Cancel</el-button>
        <el-button type="primary" @click="deleteData()">Delete</el-button>
      </span>
    </el-dialog>

    <UpdateExam
      v-if="showUpdateExam"
      :studentData="studentData"
      @updateData="updateData"
      @closeUpdateExam="closeUpdateExam($event)"
      :showUpdateExam="showUpdateExam"
    />
  </div>
</template>

<script>
import { tableProps } from "@/components/admin/content/grades/tableProps_TableExam.js";
import UpdateExam from "@/components/admin/content/dialog/grades/UpdateExam.vue";

export default {
  components: {
    UpdateExam
  },
  data() {
    return {
      tableProps: tableProps,
      studentData: {},
      showDeleteGrade: false,
      showUpdateExam: false
    };
  },
  methods: {
    operationAction(name, itemData) {
      this.studentData = {};
      this.studentData = itemData;
      switch (name) {
        case "Edit":
          this.showUpdateExam = true;
          break;
        case "Delete":
          this.showDeleteGrade = true;
          break;
        default:
          console.log("Invalid Option");
      }
    },
    deleteData() {
      let params = {
        request: 5,
        data: {
          ID: this.studentData.ID
        }
      };
      this.http
        .post(this.api.AdminExamService, params)
        .then(response => {
          if (response.data.State == 1) {
            this.showDeleteGrade = false;
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
    closeUpdateExam(val) {
      this.showUpdateExam = val;
    }
  },
  props: {
    tableData: {
      type: Array,
      default: () => {
        return [];
      }
    }
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
