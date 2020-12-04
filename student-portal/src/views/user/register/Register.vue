<template>
  <div class="user-home">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="content">
      <button type="" @click="test()">test</button>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";

export default {
  name: "Register",
  components: {
    Nav
  },
  data() {
    return {
      pageTitle: "Register"
    };
  },
  methods: {
    test() {
      var params = {
        request: 2,
        data: {
          AccountID: "12345",
          AccountPassword: "1"
        }
      };
      this.http
        .post(this.api.StudentService, params)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
