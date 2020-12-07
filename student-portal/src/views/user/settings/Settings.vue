<template>
  <div class="settings">
    <Nav :title="pageTitle" :isLeftArrow="false" :isRightText="false" />
    <div class="content">
      <div class="user-info">
        <div class="user-icon">
          <van-image width="100" height="100" fit="contain" :src="userDetails.Icon" @click="showUpload = true"/>
        </div>
        <div class="user-details">
          <span>Account ID: {{ userDetails.AccountID }}</span>
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
          <span>Year: {{ userDetails.YearLevel }}</span>
          <span
            >Account Type:
            {{ userDetails.AccountType == 1 ? "Student" : "Parent" }}</span
          >
        </div>
      </div>
      <div class="links">
        <van-cell-group>
          <van-cell icon="todo-list-o" title="View Records" is-link />
          <van-cell icon="edit" title="Edit Information" is-link />
          <van-cell icon="manager-o" title="View Parent Information" is-link />
          <van-cell icon="service-o" title="Student Service" is-link />
          <van-cell icon="records" title="Change Password" is-link />
        </van-cell-group>
      </div>
      <div class="logout-btn">
        <van-button type="primary" round size="normal" @click="logout()">
          Logout
        </van-button>
      </div>
    </div>
        <van-action-sheet v-model="showUpload" @cancel="onCancel" cancel-text="Cancel">
              <van-cell-group>
                  <div class="upload-line">
                    <van-uploader
                      :after-read="uploadImage"
                      :max-count="1">
                      <van-cell title="Select from album"/>
                    </van-uploader>
                  </div>
                  <div>
                    <van-uploader
                      capture="camera"
                      :after-read="uploadImage"
                      accept="image/png,image/jpeg">
                      <van-cell title="Take Picture"/>
                    </van-uploader>
                  </div>
              </van-cell-group>
        </van-action-sheet>
    <Footer :activeItem="3" />
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "Settings",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Settings",
      showUpload: false
    };
  },
  methods: {
    logout() {
      this.$store.dispatch("setLogin", false);
      this.$router.push({ name: "UserLogin" });
    },
    uploadImage(file) {
      this.showUpload = false;
      this.userDetails.Icon = file.content;
    },
    onCancel() {
      this.showUpload = false;
    }
  },
  computed: {
    currentUserType() {
      return this.$store.state.userType;
    },
    userDetails() {
      return this.$store.state.userDetails;
    }
  },
  mounted() {
    console.log(this.userDetails);
  }
};
</script>
