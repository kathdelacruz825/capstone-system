<template>
  <el-dialog
    :visible.sync="showUpdateExam"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Update Examination
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
        <el-divider content-position="left">Examination Details</el-divider>
        <div class="form-item-account-details">
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

          <el-form-item label="Quarter:">
            <el-dropdown trigger="click" @command="selectGradingPeriod">
              <el-button type="primary">
                {{ currentGradingPeriod }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(gradingItem, gradingKey) in gradingPeriodList"
                  :key="gradingKey"
                  :command="gradingItem"
                >
                  {{ gradingItem.Title }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item>

          <el-form-item label="Score:" prop="currGrade">
            <el-input v-model="studentData.Score" type="number"></el-input>
          </el-form-item>

          <el-form-item label="Over All Items:" prop="currGrade">
            <el-input
              v-model="studentData.OverAllItems"
              type="number"
            ></el-input>
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
    var validateCurrentGrade = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the grade"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        currGrade: [{ validator: validateCurrentGrade, trigger: "blur" }]
      },
      ruleForm: {
        StudentID: "",
        SubjectID: "",
        GradingPeriodID: "",
        Score: "",
        OverAllItems: "",
        Remarks: ""
      },
      currentTeacher: "---Select---",
      currentSubject: "---Select---",
      currentGradingPeriod: "---Select---",
      currentGrade: "",
      teacherList: [],
      subjectList: [],
      gradingPeriodList: []
    };
  },
  methods: {
    closeDialog() {
      this.currentGradingPeriod = "---Select---";
      this.currentSubject = "---Select---";
      this.$emit("closeUpdateExam", false);
      this.$emit("updateData");
      this.$refs.ruleForm.resetFields();
    },
    selectTeacher(val) {
      this.currentTeacher = val.Name;
      // this.studentData.TeacherID = val.AccountID;
    },
    selectSubject(val) {
      this.currentSubject = val.Title;
      // this.studentData.SubjectID = val.ID;
    },
    selectGradingPeriod(val) {
      this.currentGradingPeriod = val.Title;
      // this.studentData.GradingPeriodID = val.ID;
    },
    save() {
      if (this.studentData.SubjectID == "") {
        this.$message({
          type: "warning",
          message: "Select Subject!"
        });
      } else if (this.studentData.GradingPeriodID == "") {
        this.$message({
          type: "warning",
          message: "Select Quarter!"
        });
      } else if (this.studentData.Score == "") {
        this.$message({
          type: "warning",
          message: "Enter Score!"
        });
      } else if (this.studentData.OverAllItems == "") {
        this.$message({
          type: "warning",
          message: "Enter Over All Items!"
        });
      } else {
        let params = {
          request: 4,
          data: {
            ID: this.studentData.ID,
            StudentID: this.studentData.StudentID,
            SubjectID: this.parseSubject(this.currentSubject), //this.studentData.SubjectID,
            GradingPeriodID: this.parseGrading(this.currentGradingPeriod), //this.studentData.GradingPeriodID,
            Score: this.studentData.Score,
            OverAllItems: this.studentData.OverAllItems,
            Remarks: this.computeRemarks(this.ruleForm)
            // TeacherID: this.ruleForm.TeacherID,
          }
        };
        this.http
          .post(this.api.AdminExamService, params)
          .then(response => {
            if (response.data.State == 1) {
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
    computeRemarks(obj) {
      var Score = Number(obj.Score);
      var OverAllItems = Number(obj.OverAllItems) / 2;
      return Score >= OverAllItems ? "Passed" : "Failed";
    },

    getAllTeacher() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.TeacherService, params)
        .then(response => {
          this.teacherList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
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
          // this.studentData.SubjectID = this.subjectList.filter(val => {
          //   if (val.Title == this.studentData.SubjectID) {
          //     return val;
          //   }
          // })[0].ID;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getAllGradingPeriod() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.GradingPeriodService, params)
        .then(response => {
          this.gradingPeriodList = response.data;
          // this.studentData.GradingPeriodID = this.gradingPeriodList.filter(
          //   val => {
          //     if (val.Title == this.studentData.GradingPeriod) {
          //       return val;
          //     }
          //   }
          // )[0].ID;
        })
        .catch(error => {
          console.log(error);
        });
    },
    parseSubject(item) {
      var newItem = this.subjectList.filter(val => {
        if (val.Title == item) {
          return val;
        }
      })[0].ID;
      return newItem;
    },
    parseGrading(item) {
      var newItem = this.gradingPeriodList.filter(val => {
        if (val.Title == item) {
          return val;
        }
      })[0].ID;
      return newItem;
    },
    resetFields() {
      this.currentGradingPeriod = "---Select---";
      this.currentSubject = "---Select---";
      this.ruleForm.StudentID = "";
      this.ruleForm.SubjectID = "";
      this.ruleForm.GradingPeriodID = "";
      this.ruleForm.Score = "";
      this.ruleForm.OverAllItems = "";
      this.ruleForm.Remarks = "";
    }
  },
  props: {
    showUpdateExam: {
      type: Boolean,
      default: false
    },
    studentData: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  async created() {
    // await this.getAllTeacher();
    await this.getAllSubject();
    await this.getAllGradingPeriod();
  },
  mounted() {
    console.log(this.studentData);
    this.currentSubject = this.studentData.SubjectID;
    this.currentGradingPeriod = this.studentData.GradingPeriodID;
  }
};
</script>

<style lang="scss">
.add-course-content {
  .el-form-item__content {
    text-align: left;
  }
}
</style>
