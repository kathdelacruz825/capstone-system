<template>
  <div class="quizzes">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="quizzes-content">
      <div class="quiz-list">
        <van-cell-group>
          <van-cell
            class="quiz-item"
            v-for="(quizItem, quizKey) in quizItems"
            :key="quizKey"
            :title="quizItem.Title"
            @click="goPage(quizItem.Code, quizItem.ID)"
          >
            <template #title>
              <van-tag
                class="tag"
                :color="
                  colors[
                    Number(quizItem.ID) > 0
                      ? Number(quizItem.ID)
                      : Number(quizItem.ID) - 1
                  ]
                "
                type="danger"
              ></van-tag>
              <span class="custom-title">{{ quizItem.Title }}</span>
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
  name: "Quizzes",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Quizzes",
      quizItems: [],
      colors: [
        "#8B00FF",
        "#2E2B5F",
        "#0000FF",
        "#00FF00",
        "#FFFF00",
        "#FF7F00",
        "#FF0000"
      ]
    };
  },
  methods: {
    getAllSubject() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.SubjectService, params)
        .then(response => {
          this.quizItems = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    goPage(subject, subjectid) {
      this.$router.push({
        name: "QuizView",
        params: { subject: subject, subjectid: subjectid }
      });
    }
  },
  created() {
    this.getAllSubject();
  }
};
</script>
<style lang="scss">
.quizzes {
  .quizzes-content {
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

    .quiz-item {
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

    .quiz-item:not(:last-child) {
      margin-bottom: 10px;
    }
    .custom-title {
      line-height: 20px;
    }
  }
}
</style>
