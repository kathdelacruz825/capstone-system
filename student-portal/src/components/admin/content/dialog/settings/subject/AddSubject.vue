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
          <el-form-item label="Code:" prop="Code">
            <el-input v-model="ruleForm.Code" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Title:" prop="Title">
            <el-input v-model="ruleForm.Title" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Description:" prop="Description">
            <el-input v-model="ruleForm.Description" type="text"></el-input>
          </el-form-item>

          <el-form-item label="Teacher:">
            <el-dropdown trigger="click" @command="selectTeacher">
              <el-button type="primary">
                {{ currTeacher }}
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

          <el-form-item label="Year Level:">
            <el-dropdown trigger="click" @command="selectYearLevel">
              <el-button type="primary">
                {{ currYearLevel }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(yearLevelItem, yearLevelKey) in yearLevelList"
                  :key="yearLevelKey"
                  :command="yearLevelItem"
                >
                  {{ yearLevelItem.YearLevel }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item>

          <el-form-item label="Semester:">
            <el-dropdown trigger="click" @command="selectSemester">
              <el-button type="primary">
                {{ currSemester }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(semesterItem, semesterKey) in semesterList"
                  :key="semesterKey"
                  :command="semesterItem"
                >
                  {{ semesterItem.Semester }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item>

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
    var validateCode = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the subject code"));
      } else {
        callback();
      }
    };
    var validateTitle = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the subject title"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        Code: [{ validator: validateCode, trigger: "blur" }],
        Title: [{ validator: validateTitle, trigger: "blur" }]
      },
      ruleForm: {
        Code: "",
        Title: "",
        Description: "",
        TeacherID: "",
        YearLevelID: "",
        SemesterID: "",
        Status: 1 //number 1 - 2,
      },
      teacherList: [],
      currTeacher: "---Select---",
      semesterList: [],
      currSemester: "---Select---",
      yearLevelList: [],
      currYearLevel: "---Select---",
    };
  },
  methods: {
    selectTeacher(val) {
      this.ruleForm.TeacherID = val.ID;
      this.currTeacher = val.Name;
    },
    selectSemester(val) {
      this.ruleForm.SemesterID = val.ID;
      this.currSemester = val.Semester;
    },
    selectYearLevel(val) {
      this.ruleForm.YearLevelID = val.ID;
      this.currYearLevel = val.YearLevel;
    },
    closeDialog() {
      this.$emit("closeAddSubject", false);
      this.$refs.ruleForm.resetFields();
    },
    save() {
      this.$refs.ruleForm.validate(valid => {
        if (valid) {

          if (this.currTeacher == '---Select---') {
            this.$message({
              type: "danger",
              message: "Select Teacher!!"
            });
          } else if (this.currSemester == '---Select---') {
            this.$message({
              type: "danger",
              message: "Select Semester!!"
            });
          } else if (this.currYearLevel == '---Select---') {
            this.$message({
              type: "danger",
              message: "Select Year Level!!"
            });
          } else {
            let params = {
              request: 3,
              data: {
                Code: this.ruleForm.Code,
                Title: this.ruleForm.Title,
                Description: this.ruleForm.Description,
                TeacherID: this.ruleForm.TeacherID,
                YearLevelID: this.ruleForm.YearLevelID,
                SemesterID: this.ruleForm.SemesterID,
                Status: this.ruleForm.Status
              }
            };

            this.http
              .post(this.api.SubjectService, params)
              .then(response => {
                if (response.data.State == 1) {
                  this.ruleForm.Status = 1;
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
          }
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
      this.currTeacher = "---Select---";
      this.currSemester = "---Select---";
      this.currYearLevel = "---Select---";
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
    GetSemester() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.SemesterService, params)
        .then(response => {
          this.semesterList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getAllYearLevel() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.YearLevelService, params)
        .then(response => {
          this.yearLevelList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
  },
  props: {
    showAddSubject: {
      type: Boolean,
      default: false
    }
  },
  created() {
    this.getAllTeacher();
    this.GetSemester();
    this.getAllYearLevel();
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
