<template>
  <el-dialog
    :visible.sync="showUpdateSemester"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Update Semester
    </template>
    <div class="add-course-content add-school-year-content">
      <el-form
        :label-position="'left'"
        :model="newSemesterData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="newSemesterData"
        :rules="rules"
      >
        <el-divider content-position="left">Semester Details</el-divider>
        <div class="form-item-account-details">
          <div class="date-block">
            <el-form-item label="Semester:" prop="Semester">
              <el-input v-model="newSemesterData.Semester" type="text"></el-input>
            </el-form-item>
          </div>
          <el-form-item label="Status:">
            <el-radio-group v-model="newSemesterData.Status" size="mini">
              <el-radio :label="'Active'" border disabled>Active</el-radio>
              <el-radio :label="'Inactive'" border disabled>Inactive</el-radio>
            </el-radio-group>
          </el-form-item>
        </div>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Cancel</el-button>
      <el-button type="primary" @click="save()">Update</el-button>
    </span>
  </el-dialog>
</template>

<script>
export default {
  components: {},
  data() {
    var validateSemester = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the Semester"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        Semester: [{ validator: validateSemester, trigger: "blur" }],
      },
      newSemesterData: {}
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeUpdateSemester", false);
      this.updateData();
    },
    save() {
      this.$refs.newSemesterData.validate(valid => {
        if (valid) {
          let params = {
            request: 3,
            data: {
              ID: this.newSemesterData.ID,
              Semester: this.newSemesterData.Semester,
            }
          };

          this.http
            .post(this.api.SemesterService, params)
            .then(response => {
              if (response.data.State == 1) {
                this.closeDialog();
              }
              this.$message({
                type: response.data.State == 1 ? "success" : "danger",
                message: response.data.Message
              });
            })
            .catch(error => {
              console.log(error);
            });
        } else {
          this.$message({
            type: "danger",
            message: "error submit!!"
          });
          return false;
        }
      });
    },
    updateData() {
      this.$emit("updateData");
    },
  },
  props: {
    showUpdateSemester: {
      type: Boolean,
      default: false
    },
    semesterData: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  created() {},
  mounted() {
    this.newSemesterData = this.semesterData;
  }
};
</script>

<style lang="scss">
.add-course-content {
  .el-form-item__content {
    text-align: left;
  }
}

.add-school-year-content {
  .el-form-item__content {
    display: flex;
    // .block:first-child {
    //   margin-right: 10px;
    // }
    .demonstration {
      margin: 0px 10px;
    }
  }
}
</style>
