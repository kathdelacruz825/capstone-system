<template>
  <el-dialog
    :visible.sync="showViewInfoSemester"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      View Info Semester
    </template>
    <div class="add-course-content add-school-year-content">
      <el-form
        :label-position="'left'"
        :model="semesterData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
      >
        <el-divider content-position="left">Semester Details</el-divider>
        <div class="form-item-account-details">
          <div class="date-block">
          <div class="date-block">
            <el-form-item label="Semester:" prop="Semester">
              <el-input v-model="semesterData.Semester" type="text" readonly></el-input>
            </el-form-item>
          </div>
          </div>
          <el-form-item label="Status:">
            <el-radio-group v-model="semesterData.Status" size="mini">
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
      this.$emit("closeViewInfoSemester", false);
    }
  },
  props: {
    showViewInfoSemester: {
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
