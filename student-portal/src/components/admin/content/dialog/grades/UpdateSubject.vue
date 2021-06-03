<template>
  <el-dialog
    :visible.sync="showUpdateSubject"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Update Subject
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

          <el-form-item label="Title:" prop="currGrade">
            <el-input v-model="studentData.Title" type="text" readonly></el-input>
          </el-form-item>

          <el-form-item label="Teacher:" prop="currGrade">
            <el-input v-model="studentData.Teacher" type="text" readonly=""></el-input>
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
        Title: "",
        Teacher: "",
      },
      currentSubject: "",
      subjectList: [],
    };
  },
  methods: {
    closeDialog() {
      this.currentSubject = "---Select---";
      this.$emit("closeUpdateGrade", false);
      this.$emit("updateData");
      this.$refs.ruleForm.resetFields();
    },

    selectSubject(val) {
      this.currentSubject = val.Title;
    },
    save() {
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
  },
  props: {
    showUpdateSubject: {
      type: Boolean,
      default: false
    },
    studentData: {
      type: Object,
      default: () => {
        return {};
      }
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
    await this.getAllSubject();
  },
  mounted() {
    console.log(this.studentData);
    this.currentSubject = this.studentData.Title;
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
