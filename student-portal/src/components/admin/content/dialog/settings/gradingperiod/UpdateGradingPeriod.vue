<template>
  <el-dialog
    :visible.sync="showUpdateGradingPeriod"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Update Quarter
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="newGradingPeriodData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="newGradingPeriodData"
        :rules="rules"
      >
        <el-divider content-position="left">Quarter Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Title:" prop="Title">
            <el-input
              v-model="newGradingPeriodData.Title"
              type="text"
            ></el-input>
          </el-form-item>
          <el-form-item label="Status:">
            <el-radio-group v-model="newGradingPeriodData.Status" size="mini">
              <el-radio :label="'Active'" border>Active</el-radio>
              <el-radio :label="'Inactive'" border>Inactive</el-radio>
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
      newGradingPeriodData: {}
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeUpdateGradingPeriod", false);
      this.$refs.newGradingPeriodData.resetFields();
      this.updateData();
    },
    save() {
      this.$refs.newGradingPeriodData.validate(valid => {
        if (valid) {
          let params = {
            request: 4,
            data: {
              ID: this.newGradingPeriodData.ID,
              Title: this.newGradingPeriodData.Title,
              Status: this.newGradingPeriodData.Status == "Active" ? 1 : 2
            }
          };
          this.http
            .post(this.api.GradingPeriodService, params)
            .then(response => {
              if (response.data.State == 1) {
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
    showUpdateGradingPeriod: {
      type: Boolean,
      default: false
    },
    gradingPeriodData: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  created() {},
  mounted() {
    this.newGradingPeriodData = this.gradingPeriodData;
  }
};
</script>

<style lang="scss">
.add-course-content {
  .el-form-item__content {
    text-align: left;
  }
}
</style>
