<template>
  <el-dialog
    :visible.sync="showAddGradingPeriod"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Add Grading Period
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="ruleForm"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="ruleForm"
        :rules="rules"
      >
        <el-divider content-position="left">Grading Period Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Title:" prop="Title">
            <el-input v-model="ruleForm.Title" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Status:">
            <el-radio-group v-model="ruleForm.Status" size="mini">
              <el-radio :label="1" border>Active</el-radio>
              <el-radio :label="2" border>Inactive</el-radio>
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
    var validateCourseID = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the grading period title"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        Title: [{ validator: validateCourseID, trigger: "blur" }]
      },
      ruleForm: {
        Title: "",
        Status: 2 //number 1 - 2
      }
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeAddGradingPeriod", false);
      this.$refs.ruleForm.resetFields();
    },
    save() {
      this.$refs.ruleForm.validate(valid => {
        if (valid) {
          let params = {
            request: 3,
            data: {
              Title: this.ruleForm.Title,
              Status: this.ruleForm.Status
            }
          };
          this.http
            .post(this.api.GradingPeriodService, params)
            .then(response => {
              if (response.data.State == 1) {
                this.ruleForm.Status = 2;
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
    }
  },
  props: {
    showAddGradingPeriod: {
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
</style>
