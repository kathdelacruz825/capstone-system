<template>
  <el-dialog
    title="Update Parent"
    :visible.sync="showUpdateStudent"
    @close="closeDialog"
    :destroy-on-close="true"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
  >
    <div class="add-student-content" v-if="newStudentData">
      <el-form
        :label-position="'left'"
        :model="newStudentData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="newStudentData"
        :rules="{}"
      >
        <el-divider content-position="left">Account Details</el-divider>
        <div class="form-item-account-details">
          <div class="detail-row1">
            <div class="icon">
              <el-upload
                class="avatar-uploader"
                action="#"
                :auto-upload="false"
                :show-file-list="false"
                list-type="picture-card"
              >
                <img
                  v-if="newStudentData.Icon"
                  width="148"
                  height="148"
                  :src="newStudentData.Icon"
                  class="avatar"
                />
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
              </el-upload>
            </div>
            <div class="radio">
              <el-form-item label="Account Type">
                <el-radio-group
                  v-model="newStudentData.AccountType"
                  size="mini"
                >
                  <el-radio label="Student" border disabled>Student</el-radio>
                  <el-radio label="Parent" border>Parent</el-radio>
                </el-radio-group>
              </el-form-item>
              <el-form-item label="Account Status">
                <el-radio-group
                  v-model="newStudentData.AccountStatus"
                  size="mini"
                >
                  <el-radio label="Active" border>Active</el-radio>
                  <el-radio label="Inactive" border>Inactive</el-radio>
                </el-radio-group>
              </el-form-item>
            </div>
          </div>
          <div class="detail-row2">
            <el-form-item label="Account ID" prop="AccountID">
              <el-input
                v-model="newStudentData.AccountID"
                type="text"
              ></el-input>
            </el-form-item>
            <el-form-item label="Password" prop="AccountPassword">
              <el-input
                v-model="newStudentData.AccountPassword"
                type="password"
              ></el-input>
            </el-form-item>
          </div>
        </div>
        <el-divider content-position="left">Personal Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Last Name:" prop="LastName">
            <el-input v-model="newStudentData.LastName" type="text"></el-input>
          </el-form-item>
          <el-form-item label="First Name:" prop="FirstName">
            <el-input v-model="newStudentData.FirstName" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Middle Name:" prop="MiddleName">
            <el-input
              v-model="newStudentData.MiddleName"
              type="text"
            ></el-input>
          </el-form-item>
          <el-form-item label="Extension Name:">
            <el-input v-model="newStudentData.ExtName" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Phone Number:">
            <el-input
              v-model="newStudentData.PhoneNumber"
              type="text"
            ></el-input>
          </el-form-item>
          <el-form-item label="Email:">
            <el-input v-model="newStudentData.Email" type="email"></el-input>
          </el-form-item>
        </div>
        <el-divider content-position="left">School Details</el-divider>
        <el-form-item label="Student ID:" prop="StudentID">
          <el-input v-model="newStudentData.StudentID" type="text"></el-input>
        </el-form-item>
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
    return {
      fileList: [],
      newStudentData: {}
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeUpdateStudent", false);
    },
    update() {
      let paramsStudent = {
        request: 6,
        data: {
          AccountID: this.newStudentData.StudentID
        }
      };
      this.http
        .post(this.api.StudentService, paramsStudent)
        .then(response => {
          if (response.data[0].State == 1) {
            let params = {
              request: 4,
              data: {
                ID: this.newStudentData.ID,
                AccountType:
                  this.newStudentData.AccountType == "Student" ? 1 : 2,
                AccountStatus:
                  this.newStudentData.AccountStatus == "Active" ? 1 : 2,
                AccountPending:
                  this.newStudentData.AccountPending == "Approved"
                    ? 1
                    : this.newStudentData.AccountPending == "Pending"
                    ? 2
                    : 3,
                AccountOnlineState: this.newStudentData.AccountOnlineState,
                AccountID: this.newStudentData.AccountID,
                AccountPassword: this.newStudentData.AccountPassword,
                LastName: this.newStudentData.LastName,
                FirstName: this.newStudentData.FirstName,
                MiddleName: this.newStudentData.MiddleName,
                ExtName: this.newStudentData.ExtName,
                PhoneNumber: this.newStudentData.PhoneNumber,
                Email: this.newStudentData.Email,
                Icon: "",
                StudentID: this.newStudentData.StudentID,
                CreateTime: this.newStudentData.CreateTime,
                UpdateTime: this.createTime()
              }
            };
            this.http
              .post(this.api.ParentService, params)
              .then(response => {
                if (response.data[0].State == 1) {
                  this.updateData();
                  this.$message({
                    type: "success",
                    message: response.data[0].Message
                  });
                }
              })
              .catch(error => {
                console.log(error);
              });
          } else {
            this.$message({
              type: "error",
              message: "Student Account ID not exist!"
            });
          }
        })
        .catch(error => {
          this.$message({
            type: "danger",
            message: "Connection Error!"
          });
          console.log(error);
        });
    },
    updateData() {
      this.$emit("updateData");
    },
    createTime() {
      let today = new Date();
      let currdate =
        today.getFullYear() +
        "-" +
        (today.getMonth() + 1) +
        "-" +
        (today.getDate() < 10 ? "0" + today.getDate() : today.getDate());
      let currHour =
        today.getHours() < 10 ? "0" + today.getHours() : today.getHours();
      let currMinutes =
        today.getMinutes() < 10 ? "0" + today.getMinutes() : today.getMinutes();
      let currSeconds =
        today.getSeconds() < 10 ? "0" + today.getSeconds() : today.getSeconds();
      let timePeriod = today.getHours() < 13 ? "AM" : "PM";
      let currtime =
        currdate +
        " " +
        currHour +
        ":" +
        currMinutes +
        ":" +
        currSeconds +
        " " +
        timePeriod;
      return currtime;
    }
  },
  props: {
    showUpdateStudent: {
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
  // watch: {
  //   studentData: (newVal, oldVal) => {
  //     console.log(newVal, oldVal);
  //   }
  // },
  mounted() {
    this.newStudentData = this.studentData;
  }
};
</script>
