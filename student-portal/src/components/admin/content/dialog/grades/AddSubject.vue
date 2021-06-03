<template>
  <el-dialog
    :visible.sync="showAddSubject"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Add Subject
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
        <el-divider content-position="left">Subject Details</el-divider>
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

          <el-form-item label="Title:" prop="currGrade">
            <el-input v-model="ruleForm.Title" type="text"></el-input>
          </el-form-item>

          <el-form-item label="Description:" prop="currGrade">
            <el-input v-model="ruleForm.Description" type="text"></el-input>
          </el-form-item>

          <el-form-item label="Score:" prop="currGrade">
            <el-input v-model="ruleForm.Score" type="number"></el-input>
          </el-form-item>

          <el-form-item label="Over All Items:" prop="currGrade">
            <el-input v-model="ruleForm.OverAllItems" type="number"></el-input>
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
      <el-button @click="closeDialog">Close</el-button>
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
        GradingPeriod: "",
        Title: "",
        Description: "",
        Score: "",
        OverAllItems: "",
        Remarks: "",
        TeacherID: ""
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
      this.currentTeacher = "---Select---";
      this.currentSubject = "---Select---";
      this.$emit("closeAddSubject", false);
      this.$emit("updateData");
      this.$refs.ruleForm.resetFields();
    },
    selectTeacher(val) {
      this.currentTeacher = val.Name;
      this.ruleForm.TeacherID = val.AccountID;
    },
    selectSubject(val) {
      this.currentSubject = val.Title;
      this.ruleForm.SubjectID = val.ID;
    },
    selectGradingPeriod(val) {
      this.currentGradingPeriod = val.Title;
      this.ruleForm.GradingPeriod = val.ID;
    },
    save() {
      if (this.ruleForm.SubjectID == "") {
        this.$message({
          type: "warning",
          message: "Select Subject!"
        });
      } else if (this.ruleForm.GradingPeriod == "") {
        this.$message({
          type: "warning",
          message: "Select Quarter!"
        });
      } else if (this.ruleForm.Title == "") {
        this.$message({
          type: "warning",
          message: "Enter Title!"
        });
      } else if (this.ruleForm.Score == "") {
        this.$message({
          type: "warning",
          message: "Enter Score!"
        });
      } else if (this.ruleForm.OverAllItems == "") {
        this.$message({
          type: "warning",
          message: "Enter Over All Items!"
        });
      } else if (this.ruleForm.TeacherID == "") {
        this.$message({
          type: "warning",
          message: "Select Teacher!"
        });
      } else {
        let params = {
          request: 2,
          data: {
            StudentID: this.ruleForm.StudentID,
            SubjectID: this.ruleForm.SubjectID,
            GradingPeriod: this.ruleForm.GradingPeriod,
            Title: this.ruleForm.Title,
            Description: this.ruleForm.Description,
            Score: this.ruleForm.Score,
            OverAllItems: this.ruleForm.OverAllItems,
            Remarks: this.computeRemarks(this.ruleForm),
            TeacherID: this.ruleForm.TeacherID
          }
        };
        this.http
          .post(this.api.AdminQuizService, params)
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
      this.ruleForm.SubjectID = "";
      this.ruleForm.GradingPeriod = "";
      this.ruleForm.Title = "";
      this.ruleForm.Description = "";
      this.ruleForm.Score = "";
      this.ruleForm.OverAllItems = "";
      this.ruleForm.Remarks = "";
      this.ruleForm.TeacherID = "";
    }
  },
  props: {
    showAddSubject: {
      type: Boolean,
      default: false
    },
    studentID: {
      type: String,
      default: ""
    }
  },
  async created() {
    await this.getAllTeacher();
    await this.getAllSubject();
    await this.getAllGradingPeriod();
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
