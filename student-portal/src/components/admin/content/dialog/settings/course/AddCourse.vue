<template>
  <el-dialog
    :visible.sync="showAddCourse"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Add Course
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
        <el-divider content-position="left">Course Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Code:" prop="CourseID">
            <el-input v-model="ruleForm.CourseID" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Description:" prop="CourseDescription">
            <el-input
              v-model="ruleForm.CourseDescription"
              type="text"
            ></el-input>
          </el-form-item>
          <el-form-item label="Account Type">
            <el-radio-group v-model="ruleForm.CourseStatus" size="mini">
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
        callback(new Error("Please input the course code"));
      } else {
        callback();
      }
    };
    var validateCourseDescription = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the course description"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        CourseID: [{ validator: validateCourseID, trigger: "blur" }],
        CourseDescription: [
          { validator: validateCourseDescription, trigger: "blur" }
        ]
      },
      ruleForm: {
        CourseID: "",
        CourseDescription: "",
        CourseStatus: 1 //number 1 - 2
      }
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeAddCourse", false);
      this.$refs.ruleForm.resetFields();
    },
    save() {
      this.$refs.ruleForm.validate(valid => {
        if (valid) {
          let params = {
            request: 3,
            data: {
              CourseID: this.ruleForm.CourseID,
              CourseDescription: this.ruleForm.CourseDescription,
              CourseStatus: this.ruleForm.CourseStatus
            }
          };
          this.http
            .post(this.api.CourseService, params)
            .then(response => {
              if (response.data.State == 1) {
                this.ruleForm.CourseStatus = 1;
                this.$refs.ruleForm.resetFields();
                this.updateData();
              }
              this.$message({
                type: "success",
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
    showAddCourse: {
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
