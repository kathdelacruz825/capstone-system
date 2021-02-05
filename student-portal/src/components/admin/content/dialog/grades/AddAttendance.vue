<template>
  <el-dialog
    :visible.sync="showAddAttendance"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Add Attendance
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="ruleForm"
        :rules="rules"
      >
        <el-divider content-position="left">Attendance Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Date:">
            <el-date-picker
              v-model="AttendanceDate"
              type="date"
              placeholder="Pick a day"
            >
            </el-date-picker>
          </el-form-item>

          <el-form-item label="Day:" prop="currGrade">
            <span>{{ Day }}</span>
          </el-form-item>

          <el-form-item label="Subject:">
            <el-dropdown trigger="click" @command="selectSubject">
              <el-button type="primary">
                {{ currentSubject }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(subjectItem, subjectKey) in subjectList"
                  :key="subjectKey"
                  :command="subjectItem"
                >
                  {{ subjectItem.SubjectID }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item>

          <el-form-item label="Start Time:" prop="currGrade">
            <span>{{ StartTime }}</span>
          </el-form-item>

          <el-form-item label="End Time:" prop="currGrade">
            <span>{{ EndTime }}</span>
          </el-form-item>

          <el-form-item label="Remarks:">
            <el-dropdown trigger="click" @command="selectRemark">
              <el-button type="primary">
                {{ currentRemark }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(remarkItem, remarkKey) in remarkList"
                  :key="remarkKey"
                  :command="remarkItem"
                >
                  {{ remarkItem.Remarks }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
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
    var validateCurrentGrade = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the grade"));
      } else {
        callback();
      }
    };
    return {
      value1: [new Date(), new Date()],
      rules: {
        currGrade: [{ validator: validateCurrentGrade, trigger: "blur" }]
      },
      ScheduleID: "",
      RemarksID: "",
      AttendanceDate: "",
      Day: "",
      StartTime: "",
      EndTime: "",
      currentSubject: "---Select---",
      currentRemark: "---Select---",
      subjectList: [],
      dayList: [],
      remarkList: []
    };
  },
  methods: {
    closeDialog() {
      this.currentSubject = "---Select---";
      this.currentRemark = "---Select---";
      this.$emit("closeAddAttendance", false);
      this.$emit("updateData");
    },
    selectSubject(val) {
      this.currentSubject = val.SubjectID;
      this.ScheduleID = val.ID;
      this.StartTime = val.ScheduleTimeStart;
      this.EndTime = val.ScheduleTimeEnd;
    },
    selectRemark(val) {
      this.currentRemark = val.Remarks;
      this.RemarksID = val.ID;
    },
    save() {
      if (this.AttendanceDate == "") {
        this.$message({
          type: "warning",
          message: "Select Date!"
        });
      } else if (this.ScheduleID == "") {
        this.$message({
          type: "warning",
          message: "Select Subject!"
        });
      } else if (this.RemarksID == "") {
        this.$message({
          type: "warning",
          message: "Select Remarks!"
        });
      } else {
        let params = {
          request: 3,
          data: {
            ScheduleID: this.ScheduleID,
            RemarksID: this.RemarksID,
            AttendanceDate: this.formatDate(this.AttendanceDate),
            AccountID: this.studentID
          }
        };
        this.http
          .post(this.api.AttendanceService, params)
          .then(response => {
            if (response.data.State == 1) {
              this.resetFields();
              this.$emit("updateData");
              this.$message({
                type: "success",
                message: response.data.Message
              });
            } else {
              this.$message({
                type: "warning",
                message: response.data.Message
              });
            }
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    parseTime(time) {
      let newtime = time;
      let splitTime = time.split(":");
      return splitTime[0] > 12 ? newtime + " PM" : newtime + " AM";
    },
    formatDate(date) {
      let yyyy = date.getFullYear();
      let mm =
        date.getMonth() + 1 > 10
          ? date.getMonth() + 1
          : "0" + (date.getMonth() + 1);
      let dd = date.getDate() > 10 ? date.getDate() : "0" + date.getDate();
      return `${yyyy}-${mm}-${dd}`;
    },
    getDay(id) {
      let params = {
        request: 9,
        data: {
          ID: id
        }
      };
      this.http
        .post(this.api.ScheduleService, params)
        .then(response => {
          this.dayList = response.data;
          this.Day = this.dayList[0].Day;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getSchedule(ScheduleDayID) {
      let params = {
        request: 8,
        data: {
          AccountID: this.studentID,
          ScheduleDayID: ScheduleDayID
        }
      };
      this.http
        .post(this.api.ScheduleService, params)
        .then(response => {
          this.subjectList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getRemarks() {
      let params = {
        request: 8,
        data: {}
      };
      this.http
        .post(this.api.AttendanceService, params)
        .then(response => {
          this.remarkList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    resetFields() {
      this.ScheduleID = "";
      this.RemarksID = "";
      this.AttendanceDate = "";
      this.Day = "";
      this.StartTime = "";
      this.EndTime = "";
      this.currentSubject = "---Select---";
      this.currentRemark = "---Select---";
    }
  },
  watch: {
    AttendanceDate: function(val) {
      if (val) {
        let dayNum = val.getDay();
        this.getDay(dayNum);
        this.getSchedule(dayNum);
      }
    }
  },
  props: {
    showAddAttendance: {
      type: Boolean,
      default: false
    },
    studentID: {
      type: String,
      default: ""
    }
  },
  async created() {
    // await this.getAllSubject();
    // await this.getDay();
    await this.getRemarks();
  },
  mounted() {
    // this.ruleForm.StudentID = this.studentID;
  }
};
</script>

<style lang="scss">
.add-course-content {
  .el-form-item__content {
    text-align: left;
  }
}

.el-date-editor .el-range-separator {
  width: 10%;
}
</style>
