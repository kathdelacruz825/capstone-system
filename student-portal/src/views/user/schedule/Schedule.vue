<template>
  <div class="schedule">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="schedule-content">
      <van-tabs v-model="active" animated>
        <van-tab
          v-for="(dayItem, dayKey) in dayItems"
          :key="dayKey"
          :title="dayItem"
          :name="dayItem"
        >
          <ScheduleItem :scheduleData="scheduleData[dayItem]" />
        </van-tab>
      </van-tabs>
    </div>
    <Footer :activeItem="1" />
  </div>
</template>

<script>
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";
import ScheduleItem from "@/components/user/schedule/ScheduleItem.vue";

export default {
  name: "Schedule",
  components: {
    Nav,
    Footer,
    ScheduleItem
  },
  data() {
    return {
      pageTitle: "Schedule",
      active: "Monday",
      dayItems: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
      scheduleData: {
        Monday: [
          {
            subjectName: "Biology",
            start: "7:00am",
            end: "8:30am"
          },
          {
            subjectName: "Filipino",
            start: "8:30am",
            end: "10:00am"
          }
        ],
        Tuesday: [
          {
            subjectName: "Biology",
            start: "7:00am",
            end: "8:30am"
          },
          {
            subjectName: "Filipino",
            start: "8:30am",
            end: "10:00am"
          }
        ],
        Wednesday: [
          {
            subjectName: "Biology",
            start: "7:00am",
            end: "8:30am"
          },
          {
            subjectName: "Filipino",
            start: "8:30am",
            end: "10:00am"
          }
        ],
        Thursday: [
          {
            subjectName: "Biology",
            start: "7:00am",
            end: "8:30am"
          },
          {
            subjectName: "Filipino",
            start: "8:30am",
            end: "10:00am"
          }
        ],
        Friday: [
          {
            subjectName: "Biology",
            start: "7:00am",
            end: "8:30am"
          },
          {
            subjectName: "Filipino",
            start: "8:30am",
            end: "10:00am"
          }
        ]
      }
    };
  },
  methods: {}
};
</script>
<style lang="scss">
.schedule {
  .schedule-content {
    height: calc(100vh - 96px);
    padding: 10px;
    overflow: hidden;
  }
}
</style>
