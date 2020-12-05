<template>
  <div class="examinations">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="examinations-content">
      <div class="examinations-list">
        <van-cell-group>
          <van-cell
            class="examinations-item"
            v-for="(examItem, examKey) in examinationsItem" :key="examKey"
            :title="examItem"
            is-link
            @click="goPage(examItem)">
            <template #title>
              <van-tag class="tag" color="#7232dd" type="danger"></van-tag>
              <span class="custom-title">{{ examItem }}</span>
            </template>
          </van-cell>
        </van-cell-group>
      </div>
    </div>
    <Footer :activeItem="1" />
  </div>
</template>

<script>
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "Examinations",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Examinations",
      examinationsItem: [
        'First Grading Period',
        'Second Grading Period',
        'Third Grading Period',
        'Fourth Grading Period',
      ]
    };
  },
  methods: {
    goPage(pageTitle) {
      this.$router.push({name: 'ExamView', params: { pageTitle: pageTitle } })
    }
  }
};
</script>
<style lang="scss">
.examinations {
  .examinations-content {
    height: calc(100vh - 96px);
    overflow: hidden;
    // padding: 50px 10px 10px;
    padding: 10px;
    overflow-y: auto;
    
    // .quiz-list {
    //   border: 1px solid #ccc;
    //   padding: 10px;
    //   .van-cell-group::after {
    //     display: none;
    //   }
    // }

    .examinations-item {
      height: 50px;
      line-height: 50px;
      width: 100%;
      text-align: center;
      font-weight: 600;
      text-align: left;
      display: flex;
      align-items: center;
      
      .van-cell__title {
        display: flex;
        align-items: center;
        .tag {
          height: 20px;
          width: 20px;
          margin-right: 10px;
        }
      }
    }

    .examinations-item:not(:last-child) {
      margin-bottom: 10px;
    }


  }
}
</style>
