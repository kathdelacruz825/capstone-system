<template>
  <el-dialog
    :visible.sync="showUpdateCourse"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Update Course
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="newCourseData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="newCourseData"
        :rules="rules"
      >
        <el-divider content-position="left">Course Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Code:" prop="CourseID">
            <el-input v-model="newCourseData.CourseID" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Description:" prop="CourseDescription">
            <el-input
              v-model="newCourseData.CourseDescription"
              type="text"
            ></el-input>
          </el-form-item>
          <el-form-item label="Status:">
            <el-radio-group v-model="newCourseData.CourseStatus" size="mini">
              <el-radio :label="'Active'" border>Active</el-radio>
              <el-radio :label="'Inactive'" border>Inactive</el-radio>
            </el-radio-group>
          </el-form-item>
        </div>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Cancel</el-button>
      <el-button type="primary" @click="update()">Update</el-button>
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
      newCourseData: {}
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeUpdateCourse", false);
      this.updateData();
    },
    update() {
      this.$refs.newCourseData.validate(valid => {
        if (valid) {
          let params = {
            request: 4,
            data: {
              ID: this.newCourseData.ID,
              CourseID: this.newCourseData.CourseID,
              CourseDescription: this.newCourseData.CourseDescription,
              CourseStatus: this.newCourseData.CourseStatus == "Active" ? 1 : 2
            }
          };
          this.http
            .post(this.api.CourseService, params)
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
    showUpdateCourse: {
      type: Boolean,
      default: false
    },
    courseData: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  created() {},
  mounted() {
    this.newCourseData = this.courseData;
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
