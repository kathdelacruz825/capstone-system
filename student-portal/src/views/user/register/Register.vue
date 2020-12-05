<template>
  <div class="user-home">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="content">
      <van-form @submit="register">
      <van-divider>Login Details</van-divider>
        <van-field name="radio" label="Account Type">
          <template #input>
            <van-radio-group v-model="accountType" direction="horizontal">
              <van-radio name="Student" @click="selectAccountType('Student')">Student</van-radio>
              <van-radio name="Parent" @click="selectAccountType('Parent')">Parent</van-radio>
            </van-radio-group>
          </template>
        </van-field>
        <div v-if="accountType == 'Student'">
          <van-field
            v-model="studentDetails.accountID"
            name="Account ID"
            label="Account ID"
            type="text"
            placeholder="Enter account ID"
            :rules="[{ required: true, message: 'Account ID is required' }]"/>
          <van-field
            v-model="studentDetails.AccountPassword"
            type="password"
            name="Password"
            label="Password"
            placeholder="Enter password"
            :rules="[{ required: true, message: 'Password is required' }]"/>
          <van-field
            v-model="studentConfirmPassword"
            type="password"
            name="Confirm Password"
            label="Confirm Password"
            placeholder="Enter confirm password"
            :rules="[{ required: true, message: 'Confirm password is required' }]"/>
          <van-divider>Personal Details</van-divider>
          <van-field
            v-model="studentDetails.LastName"
            name="Last Name"
            label="Last Name"
            type="text"
            placeholder="Enter last name"
            :rules="[{ required: true, message: 'Last name is required' }]"/>
          <van-field
            v-model="studentDetails.FirstName"
            name="First Name"
            label="First Name"
            type="text"
            placeholder="Enter first name"
            :rules="[{ required: true, message: 'First name is required' }]"/>
          <van-field
            v-model="studentDetails.MiddleName"
            name="Middle Name"
            label="Middle Name"
            type="text"
            placeholder="Enter middle name"
            :rules="[{ required: true, message: 'Middle name is required' }]"/>
          <van-field
            v-model="studentDetails.ExtName"
            name="Extension Name"
            label="Extension Name"
            type="text"
            placeholder="Enter extension name"
            :rules="[{ required: false }]"/>
          <van-field
            v-model="studentDetails.PhoneNumber"
            name="Phone Number"
            label="Phone Number"
            type="number"
            placeholder="Enter phone number"
            :rules="[{ required: false }]"/>
          <van-field
            v-model="studentDetails.Email"
            name="Email"
            label="Email"
            type="email"
            placeholder="Enter email"
            :rules="[{ required: false }]"/>
          <van-divider>School Details</van-divider>
          <van-field
            v-model="studentDetails.Course"
            name="Course"
            label="Course"
            type="text"
            placeholder="Enter course"
            :rules="[{ required: true, message: 'Course is required' }]"/>
          <van-cell title="Year Level" is-link :value="studentDetails.YearLevel" @click="show = true"/>
          <van-action-sheet
            v-model="show"
            :actions="actions"
            cancel-text="Cancel"
            description="Select Year Level"
            @select="selectYearLevel"
            close-on-click-action/>
        </div>
        <div v-if="accountType == 'Parent'">
          <van-field
            v-model="parentDetails.accountID"
            name="Account ID"
            label="Account ID"
            type="text"
            placeholder="Enter account ID"
            :rules="[{ required: true, message: 'Account ID is required' }]"/>
          <van-field
            v-model="parentDetails.AccountPassword"
            type="password"
            name="Password"
            label="Password"
            placeholder="Enter password"
            :rules="[{ required: true, message: 'Password is required' }]"/>
          <van-field
            v-model="parentConfirmPassword"
            type="password"
            name="Confirm Password"
            label="Confirm Password"
            placeholder="Enter confirm password"
            :rules="[{ required: true, message: 'Confirm password is required' }]"/>
          <van-divider>Personal Details</van-divider>
          <van-field
            v-model="parentDetails.LastName"
            name="Last Name"
            label="Last Name"
            type="text"
            placeholder="Enter last name"
            :rules="[{ required: true, message: 'Last name is required' }]"/>
          <van-field
            v-model="parentDetails.FirstName"
            name="First Name"
            label="First Name"
            type="text"
            placeholder="Enter first name"
            :rules="[{ required: true, message: 'First name is required' }]"/>
          <van-field
            v-model="parentDetails.MiddleName"
            name="Middle Name"
            label="Middle Name"
            type="text"
            placeholder="Enter middle name"
            :rules="[{ required: true, message: 'Middle name is required' }]"/>
          <van-field
            v-model="parentDetails.ExtName"
            name="Extension Name"
            label="Extension Name"
            type="text"
            placeholder="Enter extension name"
            :rules="[{ required: false }]"/>
          <van-field
            v-model="parentDetails.PhoneNumber"
            name="Phone Number"
            label="Phone Number"
            type="number"
            placeholder="Enter phone number"
            :rules="[{ required: false }]"/>
          <van-field
            v-model="parentDetails.Email"
            name="Email"
            label="Email"
            type="email"
            placeholder="Enter email"
            :rules="[{ required: false }]"/>
          <van-divider>School Details</van-divider>
          <van-field
            v-model="parentDetails.studentID"
            name="Student ID"
            label="Student ID"
            type="text"
            placeholder="Enter child school ID"
            :rules="[{ required: true, message: 'Child schoold ID is required' }]"/>
        </div>
        <div style="margin: 16px;">
          <van-button round block type="info" native-type="submit">
            Register
          </van-button>
        </div>
      </van-form>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
// import { Toast } from 'vant';
export default {
  name: "Register",
  components: {
    Nav
  },
  data() {
    return {
      pageTitle: "Register",
      studentConfirmPassword: '',
      parentConfirmPassword: '',
      accountType: 'Student',
      studentDetails: {
        AccountType: '',
        accountID: '',
        AccountPassword: '',
        LastName: '',
        FirstName: '',
        MiddleName: '',
        ExtName: '',
        PhoneNumber: '',
        Email: '',
        YearLevel: 'First Year',
        Course: '',
      },
      parentDetails: {
        AccountType: '',
        accountID: '',
        AccountPassword: '',
        LastName: '',
        FirstName: '',
        MiddleName: '',
        ExtName: '',
        PhoneNumber: '',
        Email: '',
        studentID: '',
      },
      show: false,
      actions: [
        { name: 'First Year' },
        { name: 'Second Year' },
        { name: 'Third Year'},
        { name: 'Fourth Year'},
      ],
    };
  },
  methods: {
    selectAccountType(val) {
      if (this.accountType == 'Student') {
        this.studentDetails.AccountType = val;
      } else {
        this.parentDetails.AccountType = val;
      }
    },
    selectYearLevel(val) {
      this.studentDetails.YearLevel = val.name;
    },
    register() {
      if (this.accountType == 'Student') {
        console.log(this.studentDetails);
      } else {
        console.log(this.parentDetails);
      }
    }
  },
  mounted() {
    if (this.accountType == 'Student') {
      this.studentDetails.AccountType = 'Student';
    } else {
      this.parentDetails.AccountType = 'Parent';
    }
  }
};
</script>
<style lang="scss">
.user-home {
  .content {
    height: calc(100vh - 46px);
    overflow: hidden;
    overflow-y: auto;
  }
}
</style>