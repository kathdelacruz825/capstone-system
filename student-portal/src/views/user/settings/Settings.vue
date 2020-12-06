<template>
  <div class="settings">
    <Nav :title="pageTitle" :isLeftArrow="false" :isRightText="false" />
    <div class="content">
      <div class="user-info">
        <div class="user-icon">
          <van-image
            width="100"
            height="100"
            :src="userDetails.Icon"
          />
        </div>
        <div class="user-details">
          <span>Account ID: {{ userDetails.AccountID }}</span>
          <span v-if="userDetails.ExtName != ''">Name: 
            {{ userDetails.FirstName + ' ' + userDetails.MiddleName + ' ' + userDetails.LastName + ', ' + userDetails.ExtName}}
          </span>
          <span v-if="userDetails.ExtName == ''">Name: 
            {{ userDetails.FirstName + ' ' + userDetails.MiddleName + ' ' + userDetails.LastName }}
          </span>
          <span>Year: {{ userDetails.YearLevel }}</span>
          <span>Account Type: {{ userDetails.AccountType == 0 ? 'Student' : 'Parent' }}</span>
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
        <van-button type="primary" round size="normal" @click="logout()">Logout</van-button>
      </div>
    </div>
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
    };
  },
  methods: {
    logout() {
      this.$store.dispatch("setLogin", false);
      this.$router.push({ name: "UserLogin" });
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
