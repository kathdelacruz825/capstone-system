<template>
  <div class="class">
    <Nav :title="pageTitle" :isLeftArrow="false" :isRightText="false" />
    <div class="class-content">
      <div class="class-content-wrapper">
        <div class="class-item" v-for="(item, key) in itemClass" :key="key" @click="goPage(item.link)">
          {{ item.name }}
        </div>
      </div>
    </div>
    <Footer :activeItem="1" />
  </div>
</template>

<script>
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "Class",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Class",
      itemClass: [
        {
          name: 'Grades',
          link: 'Grades'
        },
        {
          name: 'Quizzes',
          link: 'Quizzes'
        },
        {
          name: 'Examinations',
          link: 'Examinations'
        },
        {
          name: 'Attendance',
          link: 'Attendance'
        },
        {
          name: 'Schedule',
          link: 'Schedule'
        },
      ],
    };
  },
  methods: {
    goPage(url) {
      this.$router.push({name: url});
    }
  }
};
</script>
<style lang="scss">
.class {
  .class-content {
    height: calc(100vh - 96px);
  }

  .class-content-wrapper {
    height: 100%;
    overflow-y: auto;
    padding: 50px 10px 10px;
  }

  .class-item {
    border: 1px solid #ccc;
    height: 50px;
    line-height: 50px;
    width: 100%;
    text-align: center;
    font-weight: 600;
    width: 80%;
    margin: 0px auto;
    border-radius: 7px;
    box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.25);
  }

  .class-item:not(:last-child) {
    margin-bottom: 10px;
  }
}
</style>
