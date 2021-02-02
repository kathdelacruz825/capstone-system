<template>
  <div class="edit-info user-home">
    <Nav :title="'Edit Information'" :isLeftArrow="true" :isRightText="false" />
    <van-form @submit="update">
      <div>
        <van-divider>Personal Details</van-divider>
        <van-field
          v-model="userDetails.LastName"
          name="Last Name"
          label="Last Name"
          type="text"
          placeholder="Enter last name"
          :rules="[{ required: true, message: 'Last name is required' }]"
        />
        <van-field
          v-model="userDetails.FirstName"
          name="First Name"
          label="First Name"
          type="text"
          placeholder="Enter first name"
          :rules="[{ required: true, message: 'First name is required' }]"
        />
        <van-field
          v-model="userDetails.MiddleName"
          name="Middle Name"
          label="Middle Name"
          type="text"
          placeholder="Enter middle name"
          :rules="[{ required: true, message: 'Middle name is required' }]"
        />
        <van-field
          v-model="userDetails.ExtName"
          name="Extension Name"
          label="Extension Name"
          type="text"
          placeholder="Enter extension name"
          :rules="[{ required: false }]"
        />
        <van-field
          v-model="userDetails.PhoneNumber"
          name="Phone Number"
          label="Phone Number"
          type="number"
          placeholder="Enter phone number"
          :rules="[{ required: false }]"
        />
        <van-field
          v-model="userDetails.Email"
          name="Email"
          label="Email"
          type="email"
          placeholder="Enter email"
          :rules="[{ required: false }]"
        />
        <van-divider v-if="userDetails.AccountType == '1'"
          >School Details</van-divider
        >
        <van-cell
          v-if="userDetails.AccountType == '1'"
          title="Course"
          is-link
          :value="currentCourse"
          @click="showCourse = true"
        />
        <van-cell
          v-if="userDetails.AccountType == '1'"
          title="Year Level"
          is-link
          :value="currentYearLevel"
          @click="show = true"
        />
        <van-action-sheet
          v-if="userDetails.AccountType == '1'"
          v-model="showCourse"
          :actions="courseActions"
          cancel-text="Cancel"
          description="Select Course"
          @select="selectCourse"
          close-on-click-action
        />
        <van-action-sheet
          v-if="userDetails.AccountType == '1'"
          v-model="show"
          :actions="yearLevelActions"
          cancel-text="Cancel"
          description="Select Year Level"
          @select="selectYearLevel"
          close-on-click-action
        />
      </div>
      <div style="margin: 26px 16px;">
        <van-button round block type="info" native-type="submit">
          Update
        </van-button>
      </div>
    </van-form>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
import { Toast } from "vant";

export default {
  name: "Settings",
  components: {
    Nav
  },
  data() {
    return {
      userDetails: {},
      show: false,
      showCourse: false,
      yearLevelActions: [],
      currentYearLevel: "",
      courseActions: [],
      currentCourse: ""
    };
  },
  methods: {
    update() {
      let params = {
        request: this.userDetails.AccountType == "1" ? 12 : 4,
        data: this.userDetails
      };
      this.http
        .post(
          this.userDetails.AccountType == "1"
            ? this.api.AdminService
            : this.api.ParentService,
          params
        )
        .then(response => {
          if (response.data[0].State == 1) {
            this.getStudent();
            Toast(response.data[0].Message);
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    async getStudent() {
      let params = {
        request: this.userDetails.AccountType == "1" ? 10 : 13,
        data: {
          ID: this.userDetails.ID
        }
      };
      await this.http
        .post(
          this.userDetails.AccountType == "1"
            ? this.api.StudentService
            : this.api.ParentService,
          params
        )
        .then(response => {
          this.$store.dispatch("setUserDetails", response.data[0]);
          localStorage.setItem("user", JSON.stringify(response.data[0]));
        })
        .catch(error => {
          console.log(error);
        });
    },
    selectYearLevel(yearLevelVal) {
      this.currentYearLevel = yearLevelVal.name;
      this.userDetails.YearLevel = yearLevelVal.id;
    },
    selectCourse(courseVal) {
      this.currentCourse = courseVal.name;
      this.userDetails.Course = courseVal.id;
    },
    async getAllCourse() {
      let params = {
        request: 1,
        data: {}
      };
      await this.http
        .post(this.api.CourseService, params)
        .then(response => {
          response.data.map(val => {
            let temp = {};
            temp.id = val.ID;
            temp.name = val.CourseID;
            temp.nameDescription = val.CourseDescription;
            temp.status = val.CourseStatus;
            this.courseActions.push(temp);
          });
          this.userDetails.Course = this.courseActions[0].id;
          this.currentCourse = this.courseActions[0].name;
        })
        .catch(error => {
          console.log(error);
        });
    },
    async getAllYearLevel() {
      let params = {
        request: 1,
        data: {}
      };
      await this.http
        .post(this.api.YearLevelService, params)
        .then(response => {
          response.data.map(val => {
            let temp = {};
            temp.id = val.ID;
            temp.name = val.YearLevel;
            temp.status = val.YearLevelStatus;
            this.yearLevelActions.push(temp);
          });
          this.userDetails.YearLevel = this.yearLevelActions[0].id;
          this.currentYearLevel = this.yearLevelActions[0].name;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  computed: {},
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  },
  mounted() {
    if (this.userDetails.AccountType == "1") {
      this.getAllCourse();
      this.getAllYearLevel();
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
  .van-cell__title {
    text-align: left;
  }
}
</style>
