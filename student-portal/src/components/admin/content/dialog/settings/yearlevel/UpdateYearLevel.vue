<template>
  <el-dialog
    :visible.sync="showViewUpdateYearLevel"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Update Year Level
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="YearLevelData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="YearLevelData"
        :rules="rules"
      >
        <el-divider content-position="left">Year Level Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Year Level:" prop="YearLevel">
            <el-input v-model="YearLevelData.YearLevel" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Status:">
            <el-radio-group v-model="YearLevelData.YearLevelStatus" size="mini">
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
    var validateYearLevel = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the year level"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        YearLevel: [{ validator: validateYearLevel, trigger: "blur" }]
      }
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeUpdateYearLevel", false);
      this.$refs.YearLevelData.resetFields();
      this.updateData();
    },
    save() {
      this.$refs.YearLevelData.validate(valid => {
        if (valid) {
          let params = {
            request: 4,
            data: {
              ID: this.YearLevelData.ID,
              YearLevel: this.YearLevelData.YearLevel,
              YearLevelStatus:
                this.YearLevelData.YearLevelStatus == "Active" ? 1 : 2
            }
          };
          this.http
            .post(this.api.YearLevelService, params)
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
    showViewUpdateYearLevel: {
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
