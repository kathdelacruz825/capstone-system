<template>
  <el-dialog
    title="View User"
    :visible.sync="showViewInfoUsers"
    @close="closeDialog"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <div class="add-student-content">
      <el-form
        :label-position="'left'"
        :model="ruleForm"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="ruleForm"
        :rules="rules"
      >
        <el-divider content-position="left">User Details</el-divider>
        <div class="form-item-account-details">
          <div class="detail-row1">
            <div class="icon">
              <el-upload
                class="avatar-uploader"
                action="#"
                :auto-upload="false"
                :show-file-list="false"
                list-type="picture-card"
                :on-change="handleAvatarSuccess"
              >
                <img
                  v-if="ruleForm.Icon"
                  width="148"
                  height="148"
                  :src="ruleForm.Icon"
                  class="avatar"
                />
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
              </el-upload>
            </div>
            <div class="radio">
              <el-form-item label="Role:">
                <el-dropdown trigger="click" @command="selectAccType">
                  <el-button type="primary">
                    {{ currType }}
                    <i class="el-icon-arrow-down el-icon--right"></i>
                  </el-button>
                  <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item
                      v-for="(typeItem, typeKey) in typeList"
                      :key="typeKey"
                      :command="typeItem"
                    >
                      {{ typeItem.Role }}
                    </el-dropdown-item>
                  </el-dropdown-menu>
                </el-dropdown>
              </el-form-item>

              <el-form-item label="Account Status">
                <el-radio-group v-model="ruleForm.AccountStatus" size="mini">
                  <el-radio :label="1" border>Active</el-radio>
                  <el-radio :label="2" border>Inactive</el-radio>
                </el-radio-group>
              </el-form-item>
            </div>
          </div>
          <div class="detail-row2">
            <el-form-item label="Account ID:" prop="AccountID">
              <el-input v-model="ruleForm.AccountID" type="text"></el-input>
            </el-form-item>

            <el-form-item label="Account Name:" prop="AccountName">
              <el-input v-model="ruleForm.AccountName" type="text"></el-input>
            </el-form-item>

            <el-form-item label="Password:" prop="AccountPassword">
              <el-input
                v-model="ruleForm.AccountPassword"
                type="password"
              ></el-input>
            </el-form-item>

            <el-form-item label="Last Name:" prop="LastName">
              <el-input v-model="ruleForm.LastName" type="text"></el-input>
            </el-form-item>

            <el-form-item label="First Name:" prop="FirstName">
              <el-input v-model="ruleForm.FirstName" type="text"></el-input>
            </el-form-item>

            <el-form-item label="Middle Name:" prop="MiddleName">
              <el-input v-model="ruleForm.MiddleName" type="text"></el-input>
            </el-form-item>

            <el-form-item label="Extension Name:" prop="ExtName">
              <el-input v-model="ruleForm.ExtName" type="text"></el-input>
            </el-form-item>
          </div>
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
    var validateAccountID = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the account ID"));
      } else {
        callback();
      }
    };
    var validateAccName = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the account name"));
      } else {
        callback();
      }
    };
    var validatePass = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the password"));
      } else {
        callback();
      }
    };
    var validateLastName = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the last name"));
      } else {
        callback();
      }
    };
    var validateFirstName = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the first name"));
      } else {
        callback();
      }
    };
    var validateMiddleName = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the middle name"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        AccountID: [{ validator: validateAccountID, trigger: "blur" }],
        AccountName: [{ validator: validateAccName, trigger: "blur" }],
        AccountPassword: [{ validator: validatePass, trigger: "blur" }],
        LastName: [{ validator: validateLastName, trigger: "blur" }],
        FirstName: [{ validator: validateFirstName, trigger: "blur" }],
        MiddleName: [{ validator: validateMiddleName, trigger: "blur" }]
      },
      ruleForm: {
        AccountID: "",
        AccountName: "",
        AccountPassword: "",
        LastName: "",
        FirstName: "",
        MiddleName: "",
        ExtName: "",
        Role: "",
        AccountStatus: 1,
        Icon: ""
      },
      fileList: [],
      typeList: [],
      currType: "---Select---"
    };
  },
  methods: {
    closeDialog() {
      this.$emit("CloseAddUser", false);
    },
    submitUpload() {
      this.$refs.upload.submit();
    },
    save() {
      if (this.ruleForm.Role == "") {
        this.$message({
          type: "warning",
          message: "Please select role!"
        });
      } else {
        this.$refs.ruleForm.validate(valid => {
          if (valid) {
            let params = {
              request: 2,
              data: {
                AccountID: this.ruleForm.AccountID,
                AccountName: this.ruleForm.AccountName,
                AccountPassword: this.ruleForm.AccountPassword,
                LastName: this.ruleForm.LastName,
                FirstName: this.ruleForm.FirstName,
                MiddleName: this.ruleForm.MiddleName,
                ExtName: this.ruleForm.ExtName,
                Role: this.ruleForm.Role,
                AccountStatus: this.ruleForm.AccountStatus,
                Icon: this.ruleForm.Icon
              }
            };
            this.http
              .post(this.api.UserService, params)
              .then(response => {
                if (response.data.State == 1) {
                  this.resetFields();
                  this.updateData();
                  this.$message({
                    type: "success",
                    message: response.data.Message
                  });
                } else {
                  this.$message({
                    type: "danger",
                    message: response.data.Message
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
          } else {
            console.log("error submit!!");
            return false;
          }
        });
      }
    },
    getRole() {
      let params = {
        request: 3,
        data: {}
      };
      this.http
        .post(this.api.UserService, params)
        .then(response => {
          this.typeList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    selectAccType(val) {
      this.ruleForm.Role = val.ID;
      this.currType = val.Role;
    },
    handleAvatarSuccess(file) {
      this.getBase64(file.raw).then(res => {
        this.ruleForm.Icon = res;
      });
    },
    getBase64(file) {
      return new Promise(function(resolve, reject) {
        let reader = new FileReader();
        let imgResult = "";
        reader.readAsDataURL(file);
        reader.onload = function() {
          imgResult = reader.result;
        };
        reader.onerror = function(error) {
          reject(error);
        };
        reader.onloadend = function() {
          resolve(imgResult);
        };
      });
    },
    updateData() {
      this.$emit("updateData");
    },
    handleRemove(file, fileList) {
      console.log(file, fileList);
    },
    handlePreview(file) {
      console.log(file);
      console.log(this.fileList);
    },
    resetFields() {
      this.$refs.ruleForm.resetFields();
      this.ruleForm.ExtName = "";
      this.ruleForm.Icon = "";
      this.ruleForm.Role = "";
      this.ruleForm.AccountStatus = 1;
      this.currType = "---Select---";
    }
  },
  props: {
    showViewInfoUsers: {
      type: Boolean,
      default: false
    },
    userData: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  created() {
    this.getRole();
  },
  mounted() {
    console.log(this.userData)
  }
};
</script>

<style lang="scss">
.el-dialog__body {
  padding: 0px 15px 15px;
  .avatar {
    object-fit: cover;
  }
  .el-form {
    .form-item-account-details .detail-row1 {
      display: flex;
      flex-direction: row;
      align-items: center;
      margin-bottom: 15px;

      .icon {
        margin-right: 25px;
      }

      .radio .el-form-item {
        margin-bottom: 15px;
      }

      .radio .el-form-item__label {
        line-height: 28px;
      }
    }

    .form-item-account-details .detail-row2 {
      margin-bottom: 40px;
    }
  }

  .el-form-item {
    .el-form-item__content {
      display: flex;
      justify-content: flex-start;
      .el-radio {
        width: 100px;
      }
    }

    .upload-demo {
      width: 100%;
      display: flex;
      flex-direction: column;
      text-align: left;

      .el-upload {
        text-align: left;
      }
    }
  }
}

.el-dialog__footer {
  text-align: center;
}
</style>
