<template>
  <div class="grades">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="grades-content">
      <div class="general-average">
        <div>General Average</div>
        <div>87.00</div>
      </div>
      <div class="grade-items">
        <van-collapse v-model="activeNames">
          <van-collapse-item
            v-for="(gradeItem, gradeKey) in gradeData"
            :key="gradeKey"
            :name="gradeKey"
          >
            <template #title>
              <div class="left">{{ gradeItem.subjectName }}</div>
              <div class="right">{{ gradeItem.grade }}</div>
            </template>
            <template #default>
              <div>Teacher: {{ gradeItem.teacher }}</div>
              <div>other details</div>
              <div>other details</div>
            </template>
          </van-collapse-item>
        </van-collapse>
      </div>
    </div>
    <Footer :activeItem="1" />
  </div>
</template>

<script>
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "Grades",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Grades",
      activeNames: [],
      gradeData: [
        {
          subjectName: "Science",
          grade: "80.50",
          teacher: "Pepito Manalastas"
        },
        {
          subjectName: "English",
          grade: "81.75",
          teacher: "Bayani ni Juan"
        },
        {
          subjectName: "Filipino",
          grade: "81.75",
          teacher: "Notpa Aquino"
        },
        {
          subjectName: "Mathematics",
          grade: "81.75",
          teacher: "Me Tabbil"
        },
        {
          subjectName: "Mapeh",
          grade: "81.75",
          teacher: "I am Kung Fu"
        }
      ]
    };
  },
  methods: {}
};
</script>
<style lang="scss">
.grades {
  .grades-content {
    height: calc(100vh - 96px);
    padding: 10px;
    overflow: hidden;
  }

  .general-average {
    display: flex;
    flex-direction: row;
    border: 1px solid #ccc;
    margin-bottom: 15px;

    div {
      flex: 1;
      height: 45px;
      line-height: 45px;
    }
  }

  .grade-items {
    height: 100%;
    overflow-y: auto;
    .van-cell__title {
      display: flex;
      flex-direction: row;
      div {
        flex: 1;
      }

      .left {
        text-align: left;
      }

      .right {
        text-align: right;
      }
    }

    .van-collapse-item__content {
      text-align: left;
    }

    .van-cell::after {
      // display: none;
    }
  }
}
</style>
