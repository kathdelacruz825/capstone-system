<template>
  <el-dialog
    :visible.sync="showAddSchedule"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Add Schedule
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="ruleForm"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="ruleForm"
        :rules="rules"
      >
        <el-divider content-position="left">Schedule Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Day:">
            <el-dropdown trigger="click" @command="selectDay">
              <el-button type="primary">
                {{ currentDay }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(dayItem, dayKey) in dayList"
                  :key="dayKey"
                  :command="dayItem"
                >
                  {{ dayItem.Day }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
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
                  {{ subjectItem.Title }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item>

          <el-form-item label="Start Time:">
            <el-time-select
              placeholder="Start time"
              v-model="ruleForm.StartTime"
              :picker-options="{
                start: '07:30',
                step: '01:00',
                end: '18:30'
              }"
            >
            </el-time-select>
          </el-form-item>

          <el-form-item label="End Time:">
            <el-time-select
              placeholder="End time"
              v-model="ruleForm.EndTime"
              :picker-options="{
                start: '07:30',
                step: '01:00',
                end: '18:30',
                minTime: ruleForm.StartTime
              }"
            >
            </el-time-select>
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
      ruleForm: {
        StudentID: "",
        SubjectID: "",
        DayID: "",
        StartTime: "",
        EndTime: ""
      },
      currentSubject: "---Select---",
      currentDay: "---Select---",
      subjectList: [],
      dayList: []
    };
  },
  methods: {
    closeDialog() {
      this.currentSubject = "---Select---";
      this.$emit("closeAddSchedule", false);
      this.$emit("updateData");
      this.$refs.ruleForm.resetFields();
    },
    selectSubject(val) {
      this.currentSubject = val.Title;
      this.ruleForm.SubjectID = val.ID;
    },
    selectDay(val) {
      this.currentDay = val.Day;
      this.ruleForm.DayID = val.id;
    },
    save() {
      if (this.ruleForm.DayID == "") {
        this.$message({
          type: "warning",
          message: "Select Day!"
        });
      } else if (this.ruleForm.SubjectID == "") {
        this.$message({
          type: "warning",
          message: "Select Subject!"
        });
      } else if (this.ruleForm.StartTime == "") {
        this.$message({
          type: "warning",
          message: "Select Start Time!"
        });
      } else if (this.ruleForm.EndTime == "") {
        this.$message({
          type: "warning",
          message: "Select End Time!"
        });
      } else {
        let params = {
          request: 3,
          data: {
            ScheduleDayID: this.ruleForm.DayID,
            SubjectID: this.ruleForm.SubjectID,
            ScheduleTimeStart: this.parseTime(this.ruleForm.StartTime),
            ScheduleTimeEnd: this.parseTime(this.ruleForm.EndTime),
            AccountID: this.ruleForm.StudentID
          }
        };
        this.http
          .post(this.api.ScheduleService, params)
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
    getAllSubject() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.SubjectService, params)
        .then(response => {
          this.subjectList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getDay() {
      let params = {
        request: 2,
        data: {}
      };
      this.http
        .post(this.api.ScheduleService, params)
        .then(response => {
          this.dayList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    resetFields() {
      this.currentSubject = "---Select---";
      this.currentDay = "---Select---";
      this.ruleForm.SubjectID = "";
      this.ruleForm.DayID = "";
      this.ruleForm.StartTime = "";
      this.ruleForm.EndTime = "";
    }
  },
  props: {
    showAddSchedule: {
      type: Boolean,
      default: false
    },
    studentID: {
      type: String,
      default: ""
    }
  },
  async created() {
    await this.getAllSubject();
    await this.getDay();
  },
  mounted() {
    this.ruleForm.StudentID = this.studentID;
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
