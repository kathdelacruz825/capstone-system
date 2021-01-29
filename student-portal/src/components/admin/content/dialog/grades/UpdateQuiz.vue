<template>
  <el-dialog
    :visible.sync="showUpdateQuiz"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Update Quiz
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
        <el-divider content-position="left">Quiz Details</el-divider>
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

          <el-form-item label="Grading Period:">
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

          <el-form-item label="Title:" prop="currGrade">
            <el-input v-model="studentData.Title" type="text"></el-input>
          </el-form-item>

          <el-form-item label="Description:" prop="currGrade">
            <el-input v-model="studentData.Description" type="text"></el-input>
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

          <el-form-item label="Teacher:">
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
        GradingPeriod: "",
        Title: "",
        Description: "",
        Score: "",
        OverAllItems: "",
        Remarks: "",
        TeacherID: ""
      },
      currentTeacher: "",
      currentSubject: "",
      currentGradingPeriod: "",
      currentGrade: "",
      teacherList: [],
      subjectList: [],
      gradingPeriodList: []
    };
  },
  methods: {
    closeDialog() {
      this.currentGradingPeriod = "---Select---";
      this.currentTeacher = "---Select---";
      this.currentSubject = "---Select---";
      this.$emit("closeUpdateGrade", false);
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
      // this.studentData.GradingPeriod = val.ID;
    },
    save() {
      if (this.studentData.SubjectID == "") {
        this.$message({
          type: "warning",
          message: "Select Subject!"
        });
      } else if (this.studentData.GradingPeriod == "") {
        this.$message({
          type: "warning",
          message: "Select Grading Period!"
        });
      } else if (this.studentData.Title == "") {
        this.$message({
          type: "warning",
          message: "Enter Title!"
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
      } else if (this.studentData.TeacherID == "") {
        this.$message({
          type: "warning",
          message: "Select Teacher!"
        });
      } else {
        let params = {
          request: 4,
          data: {
            ID: this.studentData.ID,
            StudentID: this.studentData.StudentID,
            SubjectID: this.parseSubject(this.currentSubject), //this.studentData.SubjectID,
            GradingPeriod: this.parseGrading(this.currentGradingPeriod), //this.studentData.GradingPeriod,
            Title: this.studentData.Title,
            Description: this.studentData.Description,
            Score: this.studentData.Score,
            OverAllItems: this.studentData.OverAllItems,
            Remarks: this.computeRemarks(this.studentData),
            TeacherID: this.parseTeacher(this.currentTeacher) //this.studentData.TeacherID
          }
        };
        this.http
          .post(this.api.AdminQuizService, params)
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
          this.currentTeacher = this.teacherList.filter(val => {
            if (val.AccountID == this.studentData.TeacherID) {
              return val;
            }
          })[0].Name;
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
          // this.studentData.GradingPeriod = this.gradingPeriodList.filter(
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
    parseTeacher(item) {
      var newItem = this.teacherList.filter(val => {
        if (val.Name == item) {
          return val;
        }
      })[0].AccountID;
      return newItem;
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
    }
  },
  props: {
    showUpdateQuiz: {
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
    await this.getAllTeacher();
    await this.getAllSubject();
    await this.getAllGradingPeriod();
  },
  mounted() {
    console.log(this.studentData);
    this.currentSubject = this.studentData.SubjectID;
    this.currentGradingPeriod = this.studentData.GradingPeriod;
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
