<template>
  <div class="user-home">
    <Nav :title="pageTitle" :isLeftArrow="false" :isRightText="true" />
    <div class="content">
      <button type="" @click="test()">get data</button>
    </div>
    <Footer :activeItem="0" />
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "UserHome",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Home"
    };
  },
  methods: {
    test() {
      var params = {
        request: 1
        // data: {
        //   username: 'keanu',
        //   password: 'keanu',
        // }
      };
      this.http
        .post(this.api.MessageService, params)
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
