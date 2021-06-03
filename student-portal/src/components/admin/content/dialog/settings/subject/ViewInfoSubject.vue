<template>
  <el-dialog
    :visible.sync="showViewInfoSubject"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      View Info Subject
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="subjectData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
      >
        <el-divider content-position="left">Subject Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Code:" prop="Code">
            <el-input v-model="subjectData.Code" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Title:" prop="Title">
            <el-input v-model="subjectData.Title" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Description:" prop="Description">
            <el-input v-model="subjectData.Description" type="text"></el-input>
          </el-form-item>

          <el-form-item label="Teacher:">
            <el-dropdown trigger="click">
              <el-button type="primary" disabled>
                {{ this.subjectData.Teacher }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(teacherItem, teacherKey) in []"
                  :key="teacherKey"
                  :command="teacherItem"
                >
                  {{ teacherItem.Name }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item>

          <el-form-item label="Year Level:">
            <el-dropdown trigger="click">
              <el-button type="primary" disabled>
                {{ this.subjectData.YearLevel }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(yearLevelItem, yearLevelKey) in []"
                  :key="yearLevelKey"
                  :command="yearLevelItem"
                >
                  {{ yearLevelItem.YearLevel }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item>

          <el-form-item label="Semester:">
            <el-dropdown trigger="click">
              <el-button type="primary" disabled>
                {{ this.subjectData.Semester }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(semesterItem, semesterKey) in []"
                  :key="semesterKey"
                  :command="semesterItem"
                >
                  {{ semesterItem.Semester }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item>

          <el-form-item label="Status:">
            <el-radio-group v-model="subjectData.Status" size="mini">
              <el-radio :label="'Active'" border disabled>Active</el-radio>
              <el-radio :label="'Inactive'" border disabled>Inactive</el-radio>
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
    return {};
  },
  methods: {
    closeDialog() {
      this.$emit("closeViewInfoSubject", false);
    }
  },
  props: {
    showViewInfoSubject: {
      type: Boolean,
      default: false
    },
    subjectData: {
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
