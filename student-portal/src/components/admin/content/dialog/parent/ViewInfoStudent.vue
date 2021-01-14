<template>
  <el-dialog
    :visible.sync="showViewInfoStudent"
    @close="closeDialog()"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Parent Info
    </template>
    <div class="add-student-content">
      <el-form
        :label-position="'left'"
        :model="studentData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="studentData"
        :rules="{}"
      >
        <el-divider content-position="left">Account Details</el-divider>
        <div class="form-item-account-details">
          <div class="detail-row1">
            <div class="icon">
              <el-upload
                disabled
                class="avatar-uploader"
                action="#"
                :auto-upload="false"
                :show-file-list="false"
                list-type="picture-card"
              >
                <img
                  v-if="studentData.Icon"
                  width="148"
                  height="148"
                  :src="studentData.Icon"
                  class="avatar"
                />
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
              </el-upload>
            </div>
            <div class="radio">
              <el-form-item label="Account Type">
                <el-radio-group v-model="studentData.AccountType" size="mini">
                  <el-radio label="Student" border disabled>Student</el-radio>
                  <el-radio label="Parent" border disabled>Parent</el-radio>
                </el-radio-group>
              </el-form-item>
              <el-form-item label="Account Status">
                <el-radio-group v-model="studentData.AccountStatus" size="mini">
                  <el-radio label="Active" border disabled>Active</el-radio>
                  <el-radio label="Inactive" border disabled>Inactive</el-radio>
                </el-radio-group>
              </el-form-item>
            </div>
          </div>
          <div class="detail-row2">
            <el-form-item label="Account ID" prop="AccountID">
              <el-input
                v-model="studentData.AccountID"
                type="text"
                :readonly="true"
              ></el-input>
            </el-form-item>
            <el-form-item label="Password" prop="AccountPassword">
              <el-input
                v-model="studentData.AccountPassword"
                type="password"
                :readonly="true"
              ></el-input>
            </el-form-item>
          </div>
        </div>
        <el-divider content-position="left">Personal Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Last Name:" prop="LastName">
            <el-input
              v-model="studentData.LastName"
              type="text"
              :readonly="true"
            ></el-input>
          </el-form-item>
          <el-form-item label="First Name:" prop="FirstName">
            <el-input
              v-model="studentData.FirstName"
              type="text"
              :readonly="true"
            ></el-input>
          </el-form-item>
          <el-form-item label="Middle Name:" prop="MiddleName">
            <el-input
              v-model="studentData.MiddleName"
              type="text"
              :readonly="true"
            ></el-input>
          </el-form-item>
          <el-form-item label="Extension Name:">
            <el-input
              v-model="studentData.ExtName"
              type="text"
              :readonly="true"
            ></el-input>
          </el-form-item>
          <el-form-item label="Phone Number:">
            <el-input
              v-model="studentData.PhoneNumber"
              type="text"
              :readonly="true"
            ></el-input>
          </el-form-item>
          <el-form-item label="Email:">
            <el-input
              v-model="studentData.Email"
              type="email"
              :readonly="true"
            ></el-input>
          </el-form-item>
        </div>
        <el-divider content-position="left">School Details</el-divider>
        <el-form-item label="Student ID:" prop="StudentID">
          <el-input v-model="studentData.StudentID" type="text"></el-input>
        </el-form-item>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Close</el-button>
    </span>
  </el-dialog>
</template>

<script>
export default {
  components: {},
  data() {
    return {};
  },
  methods: {
    closeDialog() {
      this.$emit("closeViewInfoStudent", false);
    }
  },
  props: {
    showViewInfoStudent: {
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
  created() {}
};
</script>

<style lang="scss">
.el-dialog__body {
  padding: 0px 15px 15px;

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
