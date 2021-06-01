<template>
  <el-dialog
    :visible.sync="showUpdateSchoolYear"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Update School Year
    </template>
    <div class="add-course-content add-school-year-content">
      <el-form
        :label-position="'left'"
        :model="newSchoolYearData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="newSchoolYearData"
        :rules="rules"
      >
        <el-divider content-position="left">School Year Details</el-divider>
        <div class="form-item-account-details">
          <div class="date-block">
            <el-form-item label="School Year From:" prop="YearFrom">
              <div class="block">
                <el-date-picker
                  v-model="newSchoolYearData.YearFrom"
                  type="year"
                  placeholder="Pick a Year From"
                >
                </el-date-picker>
              </div>
            </el-form-item>
            <el-form-item label="School Year To:" prop="YearTo">
              <div class="block">
                <el-date-picker
                  v-model="newSchoolYearData.YearTo"
                  type="year"
                  placeholder="Pick a Year To"
                >
                </el-date-picker>
              </div>
            </el-form-item>
          </div>
          <el-form-item label="Status:">
            <el-radio-group v-model="newSchoolYearData.Status" size="mini">
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
      newSchoolYearData: {}
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeUpdateSchoolYear", false);
    },
    save() {
      this.$refs.newSchoolYearData.validate(valid => {
        if (valid) {
          let params = {
            request: 4,
            data: {
              ID: this.newSchoolYearData.ID,
              YearFrom: this.formatDate(this.newSchoolYearData.YearFrom),
              YearTo: this.formatDate(this.newSchoolYearData.YearTo),
              Status: this.newSchoolYearData.Status == "Active" ? 1 : 2
            }
          };
          this.http
            .post(this.api.SchoolYearService, params)
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
    },
    formatDate(date) {
      var d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear();
      if (month.length < 2) {
        month = "0" + month;
      }
      if (day.length < 2) {
        day = "0" + day;
      }
      return `${year}`;
    }
  },
  props: {
    showUpdateSchoolYear: {
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
  created() {},
  mounted() {
    this.newSchoolYearData = this.schoolYearData;
  }
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
