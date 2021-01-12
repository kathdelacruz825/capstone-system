<template>
  <el-dialog
    :visible.sync="showAddSchoolYear"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Add School Year
    </template>
    <div class="add-course-content add-school-year-content">
      <el-form
        :label-position="'left'"
        :model="ruleForm"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="ruleForm"
        :rules="rules"
      >
        <el-divider content-position="left">School Year Details</el-divider>
        <div class="form-item-account-details">
          <div class="date-block">
          <el-form-item label="School Year From:" prop="YearFrom">
            <div class="block">
              <el-date-picker
                v-model="ruleForm.YearFrom"
                type="year"
                placeholder="Pick a Year From">
              </el-date-picker>
            </div>
          </el-form-item>
          <el-form-item label="School Year To:" prop="YearTo">
            <div class="block">
              <el-date-picker
                v-model="ruleForm.YearTo"
                type="year"
                placeholder="Pick a Year To">
              </el-date-picker>
            </div>
          </el-form-item>
          </div>
          <el-form-item label="Status:">
            <el-radio-group v-model="ruleForm.Status" size="mini">
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
    var validateYearFrom = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the Year From"));
      } else {
        callback();
      }
    };
    var validateYearTo = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the Year To"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        YearFrom: [{ validator: validateYearFrom, trigger: "blur" }],
        YearTo: [{ validator: validateYearTo, trigger: "blur" }]
      },
      ruleForm: {
        YearFrom: "",
        YearTo: "",
        Status: 2 //number 1 - 2
      }
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeAddAddSchoolYear", false);
      this.$refs.ruleForm.resetFields();
    },
    save() {
      this.$refs.ruleForm.validate(valid => {
        if (valid) {
          let params = {
            request: 3,
            data: {
              YearFrom: this.formatDate(this.ruleForm.YearFrom),
              YearTo: this.formatDate(this.ruleForm.YearTo),
              Status: this.ruleForm.Status
            }
          };
          this.http
            .post(this.api.SchoolYearService, params)
            .then(response => {
              if (response.data.State == 1) {
                this.ruleForm.Status = 2;
                this.$refs.ruleForm.resetFields();
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
    },
    formatDate(date) {
      var d = new Date(date),
          month = '' + (d.getMonth() + 1),
          day = '' + d.getDate(),
          year = d.getFullYear();
      if (month.length < 2) {
        month = '0' + month;
      }
      if (day.length < 2) {
        day = '0' + day;
      }
      return `${year}`;
    }
  },
  props: {
    showAddSchoolYear: {
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
