<template>
  <div class="exam-view">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="exam-view-content">
      <div class="exam-list">
        <div
          class="exam-item"
          v-for="(examItem, examKey) in examData"
          :key="examKey"
        >
          <div class="left">
            <van-tag class="tag" color="#7232dd" type="danger"></van-tag
            >{{ examItem.subjectName }}
          </div>
          <div class="right">{{ examItem.score }}</div>
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
  name: "ExamView",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "",
      examData: [
        {
          subjectName: "Science",
          score: "50/50"
        },
        {
          subjectName: "English",
          score: "50/50"
        },
        {
          subjectName: "Filipino",
          score: "50/50"
        },
        {
          subjectName: "Mathematics",
          score: "50/50"
        },
        {
          subjectName: "Mapeh",
          score: "50/50"
        }
      ]
    };
  },
  methods: {},
  mounted() {
    this.pageTitle = this.$route.params.pageTitle;
  }
};
</script>
<style lang="scss">
.exam-view {
  .exam-view-content {
    height: calc(100vh - 96px);
    overflow: hidden;
    padding: 10px;
    overflow-y: auto;

    .exam-item {
      display: flex;
      flex-direction: row;
      padding: 0px 10px;
      height: 40px;
      line-height: 40px;
      div {
        flex: 1;
      }
      .left {
        text-align: left;
        display: flex;
        align-items: center;
        .tag {
          height: 20px;
          width: 20px;
          margin-right: 10px;
        }
      }
      .right {
        text-align: right;
      }
    }
    .exam-item:not(:last-child) {
      margin-bottom: 5px;
    }
  }
}
</style>
