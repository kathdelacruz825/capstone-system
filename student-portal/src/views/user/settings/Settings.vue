<template>
  <div class="settings">
    <Nav :title="pageTitle" :isLeftArrow="false" :isRightText="false" />
    <div class="content">
      <div class="user-info">
        <div class="user-icon">
          <van-image
            width="100"
            height="100"
            fit="fill"
            :src="userDetails.Icon"
            @click="showUpload = true"
          />
        </div>
        <div class="user-details">
          <!-- <span>Account ID: {{ userDetails.AccountID }}</span> -->
          <span v-if="userDetails.ExtName != ''"
            >Name:
            {{
              userDetails.FirstName +
                " " +
                userDetails.MiddleName +
                " " +
                userDetails.LastName +
                ", " +
                userDetails.ExtName
            }}
          </span>
          <span v-if="userDetails.ExtName == ''"
            >Name:
            {{
              userDetails.FirstName +
                " " +
                userDetails.MiddleName +
                " " +
                userDetails.LastName
            }}
          </span>
          <span v-if="userDetails.AccountType == 1"
            >Course: {{ userDetails.Course }}</span
          >
          <span v-if="userDetails.AccountType == 1"
            >Year: {{ userDetails.YearLevel }}</span
          >
          <!-- <span
            >Account Type:
            {{ userDetails.AccountType == 1 ? "Student" : "Parent" }}</span
          > -->
        </div>
      </div>
      <div class="links">
        <van-cell-group v-if="userDetails.AccountType == 1">
          <!-- <van-cell
            icon="todo-list-o"
            title="View Records"
            is-link
            :to="{ name: 'ViewRecords' }"
          /> -->
          <van-cell
            icon="manager-o"
            title="View Parent Information"
            is-link
            :to="{ name: 'ParentInfo' }"
          />
          <van-cell
            icon="edit"
            title="Edit Information"
            is-link
            :to="{ name: 'EditInfo' }"
          />
          <van-cell
            icon="records"
            title="Change Password"
            is-link
            :to="{ name: 'ChangePassword' }"
          />
          <!-- <van-cell
            icon="info-o"
            title="About"
            is-link
            :to="{ name: 'About' }"
          /> -->
        </van-cell-group>
        <van-cell-group v-if="userDetails.AccountType == 2">
          <van-cell
            icon="manager-o"
            title="View Child Information"
            is-link
            :to="{ name: 'ChildInfoView' }"
          />
          <!-- <van-cell icon="service-o" title="Parent Service" is-link /> -->
          <van-cell
            icon="edit"
            title="Edit Information"
            is-link
            :to="{ name: 'EditInfo' }"
          />
          <van-cell
            icon="records"
            title="Change Password"
            is-link
            :to="{ name: 'ChangePassword' }"
          />
          <!-- <van-cell
            icon="info-o"
            title="About"
            is-link
            :to="{ name: 'About' }"
          /> -->
        </van-cell-group>
      </div>
      <div class="logout-btn">
        <van-button type="danger" round size="normal" @click="logout()">
          Logout
        </van-button>
      </div>
    </div>
    <van-action-sheet
      v-model="showUpload"
      @cancel="onCancel"
      cancel-text="Cancel"
    >
      <van-cell-group>
        <div class="upload-line">
          <van-uploader :after-read="uploadImage" :max-count="1">
            <van-cell title="Select from album" />
          </van-uploader>
        </div>
        <div>
          <van-uploader
            capture="camera"
            :after-read="uploadImage"
            accept="image/png,image/jpeg"
          >
            <van-cell title="Take Picture" />
          </van-uploader>
        </div>
      </van-cell-group>
    </van-action-sheet>
    <Footer :activeItem="Number(userDetails.AccountType) === 1 ? 2 : 3" />
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";
import { Toast } from "vant";

export default {
  name: "Settings",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Settings",
      showUpload: false,
      userDetails: {}
    };
  },
  methods: {
    logout() {
      this.$store.dispatch("setLogin", false);
      localStorage.removeItem("user");
      this.$router.push({ name: "UserLogin" });
    },
    async uploadImage(file) {
      let params = {
        request: this.userDetails.AccountType == "1" ? 7 : 14,
        data: {
          ID: this.userDetails.ID,
          Icon: file.content
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
          console.log(response);
          this.showUpload = false;
          if (response.data.State == 1) {
            // Toast(response.data.Message);
            this.login();
          }
        })
        .catch(error => {
          Toast("Connection Error");
          console.log(error);
        });
    },
    async login() {
      var params = {
        request: 2,
        data: {
          AccountID: this.userDetails.AccountID,
          AccountPassword: this.userDetails.AccountPassword
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
          if (response.data.length > 0) {
            this.$store.dispatch("setUserDetails", response.data[0]);
            localStorage.setItem("user", JSON.stringify(response.data[0]));
            this.userDetails = JSON.parse(localStorage.getItem("user"));
          } else {
            Toast("Connection Error");
          }
        })
        .catch(error => {
          Toast("Connection Error");
          console.log(error);
        });
    },
    onCancel() {
      this.showUpload = false;
    }
  },
  computed: {},
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
    console.log(this.userDetails);
  }
};
</script>
