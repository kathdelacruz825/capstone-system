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
        :model="newSubjectData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="newSubjectData"
        :rules="rules"
      >
        <el-divider content-position="left">Subject Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Code:" prop="Code">
            <el-input v-model="newSubjectData.Code" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Title:" prop="Title">
            <el-input v-model="newSubjectData.Title" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Description:" prop="Description">
            <el-input
              v-model="newSubjectData.Description"
              type="text"
            ></el-input>
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
            <el-radio-group v-model="newSubjectData.Status" size="mini">
              <el-radio :label="'Active'" border>Active</el-radio>
              <el-radio :label="'Inactive'" border>Inactive</el-radio>
            </el-radio-group>
          </el-form-item>
        </div>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Cancel</el-button>
      <el-button type="primary" @click="update()">Update</el-button>
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
      newSubjectData: {},
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
      this.currTeacher = val.Name;
    },
    selectSemester(val) {
      this.currSemester = val.Semester;
    },
    selectYearLevel(val) {
      this.currYearLevel = val.YearLevel;
    },
    closeDialog() {
      this.$emit("closeUpdateSubject", false);
      this.updateData();
    },
    update() {
      this.$refs.newSubjectData.validate(valid => {
        if (valid) {
          let params = {
            request: 4,
            data: {
              ID: this.newSubjectData.ID,
              Code: this.newSubjectData.Code,
              Title: this.newSubjectData.Title,
              Description: this.newSubjectData.Description,
              TeacherID: this.parseTeacher(this.currTeacher)[0].ID,
              YearLevelID: this.parseYearLevel(this.currYearLevel)[0].ID,
              SemesterID: this.parseSemester(this.currSemester)[0].ID,
              Status: this.newSubjectData.Status == "Active" ? 1 : 2
            }
          };
          this.http
            .post(this.api.SubjectService, params)
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
    parseTeacher(item) {
      return this.teacherList.filter(val => {
        return val.Name == item;
      });
    },
    parseSemester(item) {
      return this.semesterList.filter(val => {
        return val.Semester == item;
      });
    },
    parseYearLevel(item) {
      return this.yearLevelList.filter(val => {
        return val.YearLevel == item;
      });
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
    showUpdateSubject: {
      type: Boolean,
      default: false
    },
    subjectData: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  created() {
    this.getAllTeacher();
    this.GetSemester();
    this.getAllYearLevel();
  },
  mounted() {
    console.log(this.subjectData);
    this.newSubjectData = this.subjectData;
    this.currTeacher = this.subjectData.Teacher;
    this.currSemester = this.subjectData.Semester;
    this.currYearLevel = this.subjectData.YearLevel;
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
