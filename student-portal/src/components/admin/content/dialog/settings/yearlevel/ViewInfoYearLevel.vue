<template>
  <el-dialog
    :visible.sync="showViewInfoYearLevel"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      View Info Year Level
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="YearLevelData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
      >
        <el-divider content-position="left">Year Level Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Year Level:" prop="YearLevel">
            <el-input
              v-model="YearLevelData.YearLevel"
              type="text"
              readonly
            ></el-input>
          </el-form-item>
          <el-form-item label="Status:">
            <el-radio-group v-model="YearLevelData.YearLevelStatus" size="mini">
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
      this.$emit("closeViewInfoYearLevel", false);
    }
  },
  props: {
    showViewInfoYearLevel: {
      type: Boolean,
      default: false
    },
    YearLevelData: {
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
