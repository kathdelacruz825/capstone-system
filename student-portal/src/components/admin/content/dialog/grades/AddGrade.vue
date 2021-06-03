<template>
  <el-dialog
    :visible.sync="showAddGrade"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Add Grade
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
        <el-divider content-position="left">Grade Details</el-divider>
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

          <el-form-item label="Grade:" prop="currGrade">
            <el-input v-model="ruleForm.Grade" type="number"></el-input>
          </el-form-item>

          <!-- <el-form-item label="Teacher:">
            <el-dropdown trigger="click" @command="selectTeacher">
              <el-button type="primary">
                {{ currentTeacher }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(teacherItem, teacherKey) in teacherList"
                  :key="teacherKey"
                  :command="teacherItem"
                >
                  {{ teacherItem.Name }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item> -->
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
      rules: {
        currGrade: [{ validator: validateCurrentGrade, trigger: "blur" }]
      },
      ruleForm: {
        StudentID: "",
        SubjectID: "",
        Quarter: "",
        Grade: "",
        FirstGrade: "",
        SecondGrade: "",
        ThirdGrade: "",
        FourthGrade: "",
        OverAllGrade: "",
        Remarks: "",
        TeacherID: ""
      },
      currentTeacher: "---Select---",
      currentSubject: "---Select---",
      currentGradingPeriod: "---Select---",
      currentGrade: "",
      teacherList: [],
      subjectList: [],
      gradingPeriodList: [],
      curTeacherID: null,
    };
  },
  methods: {
    closeDialog() {
      this.currentGradingPeriod = "---Select---";
      this.currentTeacher = "---Select---";
      this.currentSubject = "---Select---";
      this.$emit("closeAddGrade", false);
      this.$emit("updateData");
      this.$refs.ruleForm.resetFields();
    },
    selectTeacher(val) {
      this.currentTeacher = val.Name;
      this.ruleForm.TeacherID = val.AccountID;
    },
    selectSubject(val) {
      this.currentSubject = val.Title;
      this.ruleForm.SubjectID = val.SubjectID;
      this.curTeacherID = val.TeacherID;
    },
    selectGradingPeriod(val) {
      this.currentGradingPeriod = val.Title;
      this.ruleForm.Quarter = val.Title;
    },
    save() {
      if (this.ruleForm.SubjectID == "") {
        this.$message({
          type: "warning",
          message: "Select Subject!"
        });
      } else if (this.ruleForm.Quarter == "") {
        this.$message({
          type: "warning",
          message: "Select Quarter!"
        });
      } else if (this.ruleForm.Grade == "") {
        this.$message({
          type: "warning",
          message: "Enter Grade!"
        });
      } else {
        if (this.ruleForm.Quarter == "First") {
          this.ruleForm.FirstGrade = this.ruleForm.Grade;
          this.ruleForm.SecondGrade = "";
          this.ruleForm.ThirdGrade = "";
          this.ruleForm.FourthGrade = "";
        } else if (this.ruleForm.Quarter == "Second") {
          this.ruleForm.SecondGrade = this.ruleForm.Grade;
          this.ruleForm.FirstGrade = "";
          this.ruleForm.ThirdGrade = "";
          this.ruleForm.FourthGrade = "";
        } else if (this.ruleForm.Quarter == "Third") {
          this.ruleForm.ThirdGrade = this.ruleForm.Grade;
          this.ruleForm.FirstGrade = "";
          this.ruleForm.SecondGrade = "";
          this.ruleForm.FourthGrade = "";
        } else {
          this.ruleForm.FourthGrade = this.ruleForm.Grade;
          this.ruleForm.FirstGrade = "";
          this.ruleForm.SecondGrade = "";
          this.ruleForm.ThirdGrade = "";
        }
        let params = {
          request: 2,
          data: {
            StudentID: this.ruleForm.StudentID,
            SubjectID: this.ruleForm.SubjectID,
            FirstGrade: Number(
              this.ruleForm.FirstGrade ? this.ruleForm.FirstGrade : 0
            ),
            SecondGrade: Number(
              this.ruleForm.SecondGrade ? this.ruleForm.SecondGrade : 0
            ),
            ThirdGrade: Number(
              this.ruleForm.ThirdGrade ? this.ruleForm.ThirdGrade : 0
            ),
            FourthGrade: Number(
              this.ruleForm.FourthGrade ? this.ruleForm.FourthGrade : 0
            ),
            OverAllGrade: this.computeOverALL(this.ruleForm),
            Remarks: this.computeRemarks(this.ruleForm),
            TeacherID: this.curTeacherID
          }
        };
        this.http
          .post(this.api.AdminGradingService, params)
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
    computeOverALL(obj) {
      let first = Number(obj.FirstGrade ? obj.FirstGrade : 0);
      let second = Number(obj.SecondGrade ? obj.SecondGrade : 0);
      let third = Number(obj.ThirdGrade ? obj.ThirdGrade : 0);
      let fourth = Number(obj.FourthGrade ? obj.FourthGrade : 0);
      let overAll = (first + second + third + fourth) / 4;
      return overAll;
    },
    computeRemarks(obj) {
      let first = Number(obj.FirstGrade ? obj.FirstGrade : 0);
      let second = Number(obj.SecondGrade ? obj.SecondGrade : 0);
      let third = Number(obj.ThirdGrade ? obj.ThirdGrade : 0);
      let fourth = Number(obj.FourthGrade ? obj.FourthGrade : 0);
      let overAll = (first + second + third + fourth) / 4;
      return overAll >= 75 ? "Passed" : "Failed";
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
        request: 6,
        data: {
          YearLevelID: this.YearLevelID,
          SemesterID: this.SemesterID
        }
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
    getAllGradingPeriod() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.GradingPeriodService, params)
        .then(response => {
          this.gradingPeriodList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    resetFields() {
      this.currentGradingPeriod = "---Select---";
      this.currentTeacher = "---Select---";
      this.currentSubject = "---Select---";
      this.ruleForm.StudentID = "";
      this.ruleForm.SubjectID = "";
      this.ruleForm.Quarter = "";
      this.ruleForm.Grade = "";
      this.ruleForm.FirstGrade = "";
      this.ruleForm.SecondGrade = "";
      this.ruleForm.ThirdGrade = "";
      this.ruleForm.FourthGrade = "";
      this.ruleForm.OverAllGrade = "";
      this.ruleForm.Remarks = "";
      this.ruleForm.TeacherID = "";
    },
    GetSubject(StudentID) {
      var params = {
        request: 1,
        data: {
          StudentID: StudentID
        }
      };
      this.http
        .post(this.api.StudentSubjectService, params)
        .then(response => {
          this.subjectList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
  },
  props: {
    showAddGrade: {
      type: Boolean,
      default: false
    },
    studentID: {
      type: String,
      default: ""
    },
    YearLevelID: {
      type: String,
      default: ""
    },
    SemesterID: {
      type: String,
      default: ""
    },
  },
  async created() {
    await this.getAllTeacher();
    // await this.getAllSubject();
    await this.getAllGradingPeriod();
    await this.GetSubject(this.studentID);
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
</style>
