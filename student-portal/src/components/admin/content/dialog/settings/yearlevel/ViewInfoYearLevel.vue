<template>
  <el-dialog
    :visible.sync="showViewInfoCourse"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      View Info Course
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="courseData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
      >
        <el-divider content-position="left">Course Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Code:" prop="CourseID">
            <el-input
              v-model="courseData.CourseID"
              type="text"
              readonly
            ></el-input>
          </el-form-item>
          <el-form-item label="Description:" prop="CourseDescription">
            <el-input
              v-model="courseData.CourseDescription"
              type="text"
              readonly
            ></el-input>
          </el-form-item>
          <el-form-item label="Status:">
            <el-radio-group v-model="courseData.CourseStatus" size="mini">
              <el-radio :label="'Active'" border disabled>Active</el-radio>
              <el-radio :label="'Inactive'" border disabled>Inactive</el-radio>
            </el-radio-group>
          </el-form-item>
        </div>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Close</el-button>
    </span>
  </el-dialog>
</template>

<script>
export default {
  components: {},
  data() {
    return {};
  },
  methods: {
    closeDialog() {
      this.$emit("closeViewInfoCourse", false);
    }
  },
  props: {
    showViewInfoCourse: {
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
