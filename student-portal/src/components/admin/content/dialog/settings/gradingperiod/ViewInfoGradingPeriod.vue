<template>
  <el-dialog
    :visible.sync="showViewInfoGradingPeriod"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      View Info Grading Period
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="gradingPeriodData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
      >
        <el-divider content-position="left">Grading Period Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Title:" prop="CourseDescription">
            <el-input
              v-model="gradingPeriodData.Title"
              type="text"
              readonly
            ></el-input>
          </el-form-item>
          <el-form-item label="Status:">
            <el-radio-group v-model="gradingPeriodData.Status" size="mini">
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
      this.$emit("closeViewInfoGradingPeriod", false);
    }
  },
  props: {
    showViewInfoGradingPeriod: {
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
