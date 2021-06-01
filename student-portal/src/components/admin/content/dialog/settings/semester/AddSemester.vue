<template>
  <el-dialog
    :visible.sync="showAddSemester"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Add Semester
    </template>
    <div class="add-course-content add-school-year-content">
      <el-form
        :label-position="'left'"
        :model="ruleForm"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="ruleForm"
        :rules="rules"
      >
        <el-divider content-position="left">Semester Details</el-divider>
        <div class="form-item-account-details">
          <div class="date-block">
            <el-form-item label="Semester:" prop="Semester">
              <el-input v-model="ruleForm.Semester" type="text"></el-input>
            </el-form-item>
          </div>
          <el-form-item label="Status:">
            <el-radio-group v-model="ruleForm.Status" size="mini">
              <el-radio :label="1" border disabled>Active</el-radio>
              <el-radio :label="2" border disabled>Inactive</el-radio>
            </el-radio-group>
          </el-form-item>
        </div>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Cancel</el-button>
      <el-button type="primary" @click="save()">Save</el-button>
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
      ruleForm: {
        Semester: "",
        Status: 2 //number 1 - 2
      }
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeAddSemester", false);
      this.$refs.ruleForm.resetFields();
    },
    save() {
      this.$refs.ruleForm.validate(valid => {
        if (valid) {
          let params = {
            request: 2,
            data: {
              Semester: this.ruleForm.Semester,
              Status: this.ruleForm.Status
            }
          };
          this.http
            .post(this.api.SemesterService, params)
            .then(response => {
              if (response.data.State == 1) {
                this.$refs.ruleForm.resetFields();
                this.updateData();
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
    showAddSemester: {
      type: Boolean,
      default: false
    }
  },
  created() {}
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
