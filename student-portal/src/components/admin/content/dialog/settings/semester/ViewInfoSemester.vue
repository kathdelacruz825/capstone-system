<template>
  <el-dialog
    :visible.sync="showViewInfoSchoolYear"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      View Info Year
    </template>
    <div class="add-course-content add-school-year-content">
      <el-form
        :label-position="'left'"
        :model="schoolYearData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
      >
        <el-divider content-position="left">School Year Details</el-divider>
        <div class="form-item-account-details">
          <div class="date-block">
            <el-form-item label="School Year From:" prop="YearFrom">
              <div class="block">
                <el-date-picker
                  disabled
                  v-model="schoolYearData.YearFrom"
                  type="year"
                  placeholder="Pick a Year From"
                >
                </el-date-picker>
              </div>
            </el-form-item>
            <el-form-item label="School Year To:" prop="YearTo">
              <div class="block">
                <el-date-picker
                  disabled
                  v-model="schoolYearData.YearTo"
                  type="year"
                  placeholder="Pick a Year To"
                >
                </el-date-picker>
              </div>
            </el-form-item>
          </div>
          <el-form-item label="Status:">
            <el-radio-group v-model="schoolYearData.Status" size="mini">
              <el-radio :label="'Active'" border disabled>Active</el-radio>
              <el-radio :label="'Inactive'" border disabled>Inactive</el-radio>
            </el-radio-group>
          </el-form-item>
        </div>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Cancel</el-button>
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
      this.$emit("closeViewInfoSchoolYear", false);
    }
  },
  props: {
    showViewInfoSchoolYear: {
      type: Boolean,
      default: false
    },
    schoolYearData: {
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
