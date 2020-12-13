<template>
  <el-dialog
    title="Add Student"
    :visible.sync="showAddStudent"
    @close="closeDialog"
    :show-close="false"
  >
    <div class="add-student-content">
      <el-form
        :label-position="labelPosition"
        label-width="100px"
        :model="formLabelAlign"
      >
        <el-form-item label="Account Type">
          <el-radio-group v-model="AccountType" size="medium">
            <el-radio label="Student" border>Student</el-radio>
            <el-radio label="Parent" border disabled>Parent</el-radio>
          </el-radio-group>
        </el-form-item>
        <el-form-item label="Account Status">
          <el-radio-group v-model="AccountStatus" size="medium">
            <el-radio label="Active" border>Active</el-radio>
            <el-radio label="Inactive" border>Inactive</el-radio>
          </el-radio-group>
        </el-form-item>
        <el-form-item label="Account ID">
          <el-input v-model="studentDetails.AccountID" type="text"></el-input>
        </el-form-item>
        <el-form-item label="Password">
          <el-input v-model="studentDetails.AccountPassword" type="password"></el-input>
        </el-form-item>
        <el-form-item label="Confirm Password">
          <el-input v-model="AccountConfirmPassword" type="password"></el-input>
        </el-form-item>
        <el-form-item label="Last Name:">
          <el-input v-model="studentDetails.LastName" type="text"></el-input>
        </el-form-item>
        <el-form-item label="First Name:">
          <el-input v-model="studentDetails.FirstName" type="text"></el-input>
        </el-form-item>
        <el-form-item label="Middle Name:">
          <el-input v-model="studentDetails.MiddleName" type="text"></el-input>
        </el-form-item>
        <el-form-item label="Extension Name:">
          <el-input v-model="studentDetails.ExtName" type="text"></el-input>
        </el-form-item>
        <el-form-item label="Phone Number:">
          <el-input v-model="studentDetails.PhoneNumber" type="text"></el-input>
        </el-form-item>
        <el-form-item label="Email:">
          <el-input v-model="studentDetails.Email" type="email"></el-input>
        </el-form-item>
        <el-form-item label="Icon:">
          <el-upload
            class="upload-demo"
            ref="upload"
            action="https://jsonplaceholder.typicode.com/posts/"
            :auto-upload="false">
            <el-button slot="trigger" size="small" type="primary">select file</el-button>
            <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">upload to server</el-button>
            <div class="el-upload__tip" slot="tip">jpg/png files with a size less than 500kb</div>
          </el-upload>
        </el-form-item>
        <el-form-item label="Course:">
          <el-dropdown>
            <el-button type="primary">
              Dropdown List<i class="el-icon-arrow-down el-icon--right"></i>
            </el-button>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>Action 1</el-dropdown-item>
              <el-dropdown-item>Action 2</el-dropdown-item>
              <el-dropdown-item>Action 3</el-dropdown-item>
              <el-dropdown-item>Action 4</el-dropdown-item>
              <el-dropdown-item>Action 5</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </el-form-item>
        <el-form-item label="Year Level:">
          <el-dropdown>
            <el-button type="primary">
              Dropdown List<i class="el-icon-arrow-down el-icon--right"></i>
            </el-button>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>Action 1</el-dropdown-item>
              <el-dropdown-item>Action 2</el-dropdown-item>
              <el-dropdown-item>Action 3</el-dropdown-item>
              <el-dropdown-item>Action 4</el-dropdown-item>
              <el-dropdown-item>Action 5</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </el-form-item>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Cancel</el-button>
      <el-button type="primary">Save</el-button>
    </span>
  </el-dialog>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      AccountType: 'Student',
      AccountStatus: 'Active',
      AccountConfirmPassword: '',
      fileList: [],
      labelPosition: "left",
      formLabelAlign: {
        name: "",
        region: "",
        type: ""
      },
      studentDetails: {
        ID: "",
        AccountType: "",
        AccountStatus: "",
        AccountPending: "",
        AccountOnlineState: "",
        AccountID: "",
        AccountPassword: "",
        LastName: "",
        FirstName: "",
        MiddleName: "",
        ExtName: "",
        PhoneNumber: "",
        Email: "",
        Icon: "",
        YearLevel: "",
        Course: "",
        ParentID: "",
        CreateTime: "",
        UpdateTime: "",
      }
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeAddStudent", false);
    },
    submitUpload() {
      this.$refs.upload.submit();
    }
  },
  props: {
    showAddStudent: {
      type: Boolean,
      default: false
    }
  },
  created() {}
};
</script>
