<template>
  <div class="message-list">
    <Nav :title="pageTitle" :isLeftArrow="false" :isRightText="false" />
    <div class="message-list-content">
      <van-list
        v-model="loading"
        :finished="finished"
        finished-text=""
        @load="onLoad"
      >
        <van-cell
          v-for="(item, key) in teacherList"
          :key="key"
          icon="contact"
          :title="item.FirstName + ' ' + item.MiddleName + ' ' + item.LastName"
          is-link
          :to="{
            name: 'Message',
            params: { teacherid: item.AccountID, name: item.FirstName }
          }"
        />
      </van-list>
    </div>
    <Footer :activeItem="2" />
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "Message",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Message",
      teacherList: [],
      loading: false,
      finished: false
    };
  },
  methods: {
    getAllTeacher() {
      let params = {
        request: 9,
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
    onLoad() {
      setTimeout(() => {
        this.getAllTeacher();
        this.loading = false;
        this.finished = true;
      }, 1000);
    }
  },
  created() {}
};
</script>

<style>
.message-list .van-cell__title {
  text-align: left;
}
</style>
